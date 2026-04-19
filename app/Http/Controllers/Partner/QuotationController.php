<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $quotations = Quotation::with(['customer', 'company'])
            ->whereHas('customer', fn ($q) => $q->where('channel_partner_id', Auth::id()))
            ->latest()
            ->paginate(20);

        return view('partner.quotations.index', compact('quotations'));
    }

    public function show(Quotation $quotation)
    {
        $this->authorizeAccess($quotation);
        $quotation->load(['customer', 'company', 'items']);
        return view('partner.quotations.show', compact('quotation'));
    }

    public function pdf(Quotation $quotation)
    {
        $this->authorizeAccess($quotation);
        $quotation->load(['customer', 'company', 'items', 'creator']);

        $pdf = Pdf::loadView('quotations.pdf.layout', [
            'quotation' => $quotation,
            'company' => $quotation->company,
            'customer' => $quotation->customer,
            'items' => $quotation->items,
        ])->setPaper('A4', 'portrait');

        $filename = 'Quotation-' . str_replace(['/', '\\', ' '], '-', $quotation->reference_number ?? $quotation->id) . '.pdf';
        return $pdf->stream($filename);
    }

    protected function authorizeAccess(Quotation $quotation): void
    {
        $quotation->loadMissing('customer');
        abort_unless(
            $quotation->customer && (int) $quotation->customer->channel_partner_id === (int) Auth::id(),
            403
        );
    }
}
