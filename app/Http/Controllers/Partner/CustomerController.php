<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Mail\CustomerPortalWelcome;
use App\Models\Customer;
use App\Models\CustomerKyc;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::where('channel_partner_id', auth()->id())
            ->with(['installation', 'loan', 'subsidy']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%$s%")->orWhere('phone', 'like', "%$s%"));
        }

        $customers = $query->latest()->paginate(15);
        return view('partner.customers.index', compact('customers'));
    }

    public function create()
    {
        $packages = Package::where('is_active', true)->get();
        return view('partner.customers.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'email')],
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'installation_location' => 'nullable|string',
            'system_capacity_kw' => 'nullable|numeric|min:0.1',
            'package_selected' => 'nullable|string',
            'installation_type' => 'required|in:domestic,commercial',
            'payment_method' => 'required|in:cash,loan',
        ]);

        $validated['channel_partner_id'] = auth()->id();
        $validated['status'] = 'registration_completed';

        $plainPassword = Str::password(14);

        $customer = DB::transaction(function () use ($validated, $plainPassword) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($plainPassword),
                'role' => 'customer',
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'is_active' => true,
            ]);

            $validated['user_id'] = $user->id;

            return Customer::create($validated);
        });

        $loginUrl = url('/login');
        try {
            Mail::to($customer->email)->send(new CustomerPortalWelcome(
                $customer->name,
                $customer->email,
                $plainPassword,
                $loginUrl,
            ));
            $message = 'Customer added. Portal login details have been sent to their email.';
        } catch (\Throwable $e) {
            report($e);
            $message = 'Customer and portal account were created, but the email could not be sent. Check mail settings (e.g. SMTP) or share login details manually.';
        }

        return redirect()->route('partner.customers.show', $customer)->with('success', $message);
    }

    public function show(Customer $customer)
    {
        abort_if($customer->channel_partner_id !== auth()->id(), 403);
        $customer->load(['kycDocuments', 'loan', 'installation', 'subsidy', 'payments']);
        return view('partner.customers.show', compact('customer'));
    }

    public function uploadKyc(Request $request, Customer $customer)
    {
        abort_if($customer->channel_partner_id !== auth()->id(), 403);

        $request->validate([
            'document_type' => 'required|in:aadhaar_card,pan_card,address_proof,electricity_bill,property_ownership,bank_details',
            'document' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        $file = $request->file('document');
        $path = $file->store('kyc/' . $customer->id, 'public');

        CustomerKyc::create([
            'customer_id' => $customer->id,
            'document_type' => $request->document_type,
            'file_path' => $path,
            'original_filename' => $file->getClientOriginalName(),
        ]);

        if ($customer->status === 'registration_completed') {
            $customer->update(['status' => 'kyc_pending']);
        }

        return back()->with('success', 'KYC document uploaded.');
    }
}
