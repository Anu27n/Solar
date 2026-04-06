<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with(['customer', 'package', 'creator'])
            ->latest()
            ->paginate(20);

        return view('admin.quotations.index', compact('quotations'));
    }

    public function create(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $packages = Package::where('is_active', true)->get();
        $selectedCustomer = $request->customer_id ? Customer::find($request->customer_id) : null;

        return view('admin.quotations.create', compact('customers', 'packages', 'selectedCustomer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'package_id' => 'nullable|exists:packages,id',
            'total_price' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'send_email' => 'boolean',
            'send_whatsapp' => 'boolean',
            'send_sms' => 'boolean',
        ]);

        $quotation = Quotation::create([
            'customer_id' => $validated['customer_id'],
            'package_id' => $validated['package_id'] ?? null,
            'total_price' => $validated['total_price'],
            'details' => $validated['details'] ?? null,
            'sent_email' => false,
            'sent_whatsapp' => $request->boolean('send_whatsapp'),
            'sent_sms' => $request->boolean('send_sms'),
            'created_by' => auth()->id(),
        ]);

        if ($request->boolean('send_email')) {
            $this->sendQuotationEmail($quotation);
        }

        return redirect()->route('admin.quotations.index')->with('success', 'Quotation created' . ($quotation->sent_email ? ' and emailed.' : '.'));
    }

    public function send(Quotation $quotation)
    {
        $this->sendQuotationEmail($quotation);
        return back()->with('success', 'Quotation emailed to customer.');
    }

    private function sendQuotationEmail(Quotation $quotation)
    {
        $quotation->load(['customer', 'package']);
        $customer = $quotation->customer;

        if (!$customer->email) {
            return;
        }

        try {
            Mail::send([], [], function ($message) use ($quotation, $customer) {
                $body = "Dear {$customer->name},\n\n";
                $body .= "Thank you for choosing U.P.R. Solar Green Energy.\n\n";
                $body .= "QUOTATION DETAILS\n";
                $body .= "─────────────────\n";
                if ($quotation->package) {
                    $body .= "Package: {$quotation->package->name}\n";
                    $body .= "System Size: {$quotation->package->system_size_kw} kW\n";
                }
                $body .= "Total Price: ₹" . number_format($quotation->total_price, 2) . "\n";
                if ($quotation->details) {
                    $body .= "\nAdditional Details:\n{$quotation->details}\n";
                }
                $body .= "\n\nFor queries, contact us at +91-9412452844\n";
                $body .= "U.P.R. Solar Green Energy™\n";

                $message->to($customer->email, $customer->name)
                    ->subject('Solar Quotation from U.P.R. Solar - #' . $quotation->id)
                    ->text($body);
            });

            $quotation->update(['sent_email' => true]);
        } catch (\Exception $e) {
            // Silently fail - quotation is still saved
        }
    }
}
