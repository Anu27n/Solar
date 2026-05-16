<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $query = Quotation::with(['customer', 'company', 'creator'])->latest();

        if ($request->filled('company')) {
            $query->whereHas('company', fn ($q) => $q->where('code', $request->company));
        }

        $quotations = $query->paginate(20)->withQueryString();
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        return view('admin.quotations.index', compact('quotations', 'companies'));
    }

    public function create(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $packages = Package::where('is_active', true)->get();
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();
        $selectedCustomer = $request->customer_id ? Customer::find($request->customer_id) : null;

        if ($companies->isEmpty()) {
            return redirect()
                ->route('admin.company-profiles.index')
                ->with('error', 'No company letterheads are set up yet. Run: php artisan db:seed --class=Database\\Seeders\\CompanyProfileSeeder (or full db:seed), then refresh this page.');
        }

        return view('admin.quotations.create', compact('customers', 'packages', 'companies', 'selectedCustomer'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateQuotation($request);

        $company = CompanyProfile::findOrFail($validated['company_profile_id']);

        $quotation = DB::transaction(function () use ($validated, $company, $request) {
            $reference = $company->generateNextReference();

            $quotation = Quotation::create([
                'customer_id' => $validated['customer_id'],
                'company_profile_id' => $company->id,
                'reference_number' => $reference,
                'location' => $validated['location'] ?? null,
                'subject' => $validated['subject'] ?? null,
                'kind_attn' => $validated['kind_attn'] ?? null,
                'package_id' => $validated['package_id'] ?? null,
                'gst_percent' => $validated['gst_percent'],
                'validity_days' => $validated['validity_days'],
                'payment_terms' => $validated['payment_terms'] ?? null,
                'delivery_terms' => $validated['delivery_terms'] ?? null,
                'warranty_terms' => $validated['warranty_terms'] ?? null,
                'freight' => $validated['freight'] ?? null,
                'jurisdiction' => $validated['jurisdiction'] ?? $company->default_jurisdiction,
                'notes' => $validated['notes'] ?? null,
                'cover_letter' => $validated['cover_letter'] ?? null,
                'details' => $validated['notes'] ?? null,
                'total_price' => 0,
                'subtotal' => 0,
                'gst_amount' => 0,
                'grand_total' => 0,
                'sent_email' => false,
                'sent_whatsapp' => $request->boolean('send_whatsapp'),
                'sent_sms' => $request->boolean('send_sms'),
                'created_by' => auth()->id(),
            ]);

            $this->syncItems($quotation, $validated['items']);
            $quotation->load('items');
            $quotation->recalcTotals();

            return $quotation;
        });

        if ($request->boolean('send_email')) {
            $this->sendQuotationEmail($quotation);
        }

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation ' . $quotation->reference_number . ' created' . ($quotation->sent_email ? ' and emailed.' : '.'));
    }

    public function edit(Quotation $quotation)
    {
        $quotation->load(['items', 'company']);
        $customers = Customer::orderBy('name')->get();
        $packages = Package::where('is_active', true)->get();
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        return view('admin.quotations.edit', compact('quotation', 'customers', 'packages', 'companies'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $this->validateQuotation($request);

        DB::transaction(function () use ($validated, $quotation, $request) {
            // Company change allowed but reference_number stays (historical record).
            $quotation->update([
                'customer_id' => $validated['customer_id'],
                'company_profile_id' => $validated['company_profile_id'],
                'location' => $validated['location'] ?? null,
                'subject' => $validated['subject'] ?? null,
                'kind_attn' => $validated['kind_attn'] ?? null,
                'package_id' => $validated['package_id'] ?? null,
                'gst_percent' => $validated['gst_percent'],
                'validity_days' => $validated['validity_days'],
                'payment_terms' => $validated['payment_terms'] ?? null,
                'delivery_terms' => $validated['delivery_terms'] ?? null,
                'warranty_terms' => $validated['warranty_terms'] ?? null,
                'freight' => $validated['freight'] ?? null,
                'jurisdiction' => $validated['jurisdiction'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'cover_letter' => $validated['cover_letter'] ?? null,
                'details' => $validated['notes'] ?? null,
            ]);

            $this->syncItems($quotation, $validated['items']);
            $quotation->load('items');
            $quotation->recalcTotals();
        });

        if ($request->boolean('send_email')) {
            $this->sendQuotationEmail($quotation->fresh(['customer', 'company', 'items']));
        }

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation ' . $quotation->reference_number . ' updated.');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load(['customer', 'company', 'items', 'creator']);
        return view('admin.quotations.show', compact('quotation'));
    }

    public function pdf(Quotation $quotation)
    {
        $pdf = $this->buildPdf($quotation);
        $filename = 'Quotation-' . str_replace(['/', '\\', ' '], '-', $quotation->reference_number ?? $quotation->id) . '.pdf';
        return $pdf->stream($filename);
    }

    public function send(Quotation $quotation)
    {
        $this->sendQuotationEmail($quotation);
        return back()->with('success', 'Quotation emailed to customer.');
    }

    protected function validateQuotation(Request $request): array
    {
        return $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'company_profile_id' => 'required|exists:company_profiles,id',
            'package_id' => 'nullable|exists:packages,id',
            'location' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:500',
            'kind_attn' => 'nullable|string|max:255',
            'gst_percent' => 'required|numeric|min:0|max:100',
            'validity_days' => 'required|integer|min:1|max:365',
            'payment_terms' => 'nullable|string',
            'delivery_terms' => 'nullable|string',
            'warranty_terms' => 'nullable|string',
            'freight' => 'nullable|string|max:100',
            'jurisdiction' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'cover_letter' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.hsn_code' => 'nullable|string|max:20',
            'items.*.quantity' => 'required|numeric|min:0',
            'items.*.unit' => 'required|string|max:20',
            'items.*.rate' => 'required|numeric|min:0',
            'send_email' => 'boolean',
            'send_whatsapp' => 'boolean',
            'send_sms' => 'boolean',
        ]);
    }

    protected function syncItems(Quotation $quotation, array $items): void
    {
        $existingIds = $quotation->items()->pluck('id')->all();
        $keepIds = [];

        foreach (array_values($items) as $index => $row) {
            $quantity = (float) $row['quantity'];
            $rate = (float) $row['rate'];
            $attrs = [
                'position' => $index + 1,
                'description' => trim($row['description']),
                'hsn_code' => $row['hsn_code'] ?? null,
                'quantity' => $quantity,
                'unit' => $row['unit'],
                'rate' => $rate,
                'amount' => round($quantity * $rate, 2),
            ];

            if (!empty($row['id']) && in_array((int) $row['id'], $existingIds, true)) {
                $item = QuotationItem::find($row['id']);
                $item->fill($attrs)->save();
                $keepIds[] = (int) $row['id'];
            } else {
                $created = $quotation->items()->create($attrs);
                $keepIds[] = $created->id;
            }
        }

        $toDelete = array_diff($existingIds, $keepIds);
        if ($toDelete) {
            QuotationItem::whereIn('id', $toDelete)->delete();
        }
    }

    protected function buildPdf(Quotation $quotation)
    {
        $quotation->load(['customer', 'company', 'items', 'creator']);

        return Pdf::loadView('quotations.pdf.layout', [
            'quotation' => $quotation,
            'company' => $quotation->company,
            'customer' => $quotation->customer,
            'items' => $quotation->items,
        ])->setPaper('A4', 'portrait');
    }

    protected function sendQuotationEmail(Quotation $quotation): void
    {
        $quotation->load(['customer', 'company', 'items']);
        $customer = $quotation->customer;
        $company = $quotation->company;

        if (!$customer?->email) {
            return;
        }

        $pdf = $this->buildPdf($quotation);
        $pdfBinary = $pdf->output();
        $filename = 'Quotation-' . str_replace(['/', '\\', ' '], '-', $quotation->reference_number ?? $quotation->id) . '.pdf';
        $companyName = $company?->name ?? 'U.P.R. Group';

        try {
            Mail::send([], [], function ($message) use ($quotation, $customer, $companyName, $pdfBinary, $filename) {
                $body = "Dear {$customer->name},\n\n";
                $body .= "Thank you for considering {$companyName}.\n\n";
                $body .= "Please find attached our quotation ({$quotation->reference_number}).\n";
                if ($quotation->location) {
                    $body .= "Location: {$quotation->location}\n";
                }
                if ($quotation->subject) {
                    $body .= "Subject: {$quotation->subject}\n";
                }
                $body .= "Grand Total: Rs. " . number_format((float) $quotation->grand_total, 2) . " (incl. GST @ " . rtrim(rtrim(number_format((float) $quotation->gst_percent, 2), '0'), '.') . "%)\n\n";
                $body .= "For any clarification, please contact us at +91-{$quotation->company?->signatory_phone}.\n\n";
                $body .= "Regards,\n";
                $body .= ($quotation->company?->signatory_name ?? 'Sales Team') . "\n";
                $body .= $companyName . "\n";

                $message->to($customer->email, $customer->name)
                    ->subject('Quotation ' . $quotation->reference_number . ' - ' . $companyName)
                    ->text($body)
                    ->attachData($pdfBinary, $filename, ['mime' => 'application/pdf']);
            });

            $quotation->update(['sent_email' => true]);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
