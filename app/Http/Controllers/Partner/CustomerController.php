<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerKyc;
use App\Models\Package;
use Illuminate\Http\Request;

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
            'email' => 'nullable|email',
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

        $customer = Customer::create($validated);
        return redirect()->route('partner.customers.show', $customer)->with('success', 'Customer added.');
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
