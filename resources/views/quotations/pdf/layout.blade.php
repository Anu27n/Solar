<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation {{ $quotation->reference_number }}</title>
    <style>
        @page { margin: 28mm 16mm 20mm 16mm; }
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; color: #1e293b; font-size: 10.5px; line-height: 1.45; margin: 0; }

        .letterhead { border-bottom: 2px solid #0f172a; padding-bottom: 6px; margin-bottom: 10px; }
        .letterhead .name { font-size: 20px; font-weight: bold; color: #0f172a; letter-spacing: 0.5px; text-align: center; }
        .letterhead .tagline { font-size: 9.5px; font-style: italic; color: #334155; text-align: center; margin-top: 3px; }
        .letterhead .addr { font-size: 9.5px; color: #334155; text-align: center; margin-top: 5px; }
        .letterhead .contacts { font-size: 9.5px; color: #334155; text-align: center; margin-top: 3px; }

        .meta-bar { margin-top: 8px; width: 100%; border-collapse: collapse; }
        .meta-bar td { padding: 3px 0; font-size: 10.5px; vertical-align: top; }
        .meta-bar .right { text-align: right; }
        .meta-bar .label { color: #64748b; font-weight: bold; text-transform: uppercase; font-size: 9px; letter-spacing: 0.5px; }

        .section-title { font-size: 11.5px; font-weight: bold; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin: 14px 0 6px 0; border-bottom: 1px solid #cbd5e1; padding-bottom: 3px; }

        .customer-block { background: #f8fafc; border: 1px solid #e2e8f0; padding: 8px 10px; margin-top: 10px; border-radius: 4px; }
        .customer-block .to { font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold; margin-bottom: 2px; }
        .customer-block .name { font-weight: bold; font-size: 11px; color: #0f172a; }
        .customer-block .line { font-size: 10px; color: #334155; margin-top: 1px; }

        .cover { margin-top: 10px; text-align: justify; }

        table.items { width: 100%; border-collapse: collapse; margin-top: 6px; }
        table.items th, table.items td { border: 1px solid #cbd5e1; padding: 5px 6px; vertical-align: top; font-size: 10px; }
        table.items thead th { background: #0f172a; color: #fff; text-align: left; font-size: 9.5px; text-transform: uppercase; letter-spacing: 0.3px; }
        table.items .num { text-align: right; }
        table.items .center { text-align: center; }
        table.items tfoot td { background: #f1f5f9; font-weight: bold; }
        table.items tfoot .grand { background: #0f172a; color: #fff; font-size: 11.5px; }

        .terms { margin-top: 12px; }
        .terms p { margin: 3px 0; }
        .terms .k { display: inline-block; width: 120px; font-weight: bold; color: #0f172a; }

        .bank { background: #f8fafc; border: 1px dashed #94a3b8; padding: 7px 10px; margin-top: 10px; font-size: 10px; border-radius: 4px; }
        .bank .k { display: inline-block; width: 90px; color: #64748b; font-weight: bold; text-transform: uppercase; font-size: 9px; letter-spacing: 0.4px; }

        .signature { margin-top: 20px; }
        .signature .line { margin: 1px 0; }
        .signature .name { font-weight: bold; }

        .small { font-size: 9.5px; color: #64748b; }
        .footer { position: fixed; bottom: -8mm; left: 0; right: 0; text-align: center; font-size: 8.5px; color: #94a3b8; }
        .page-brk { page-break-after: always; }
    </style>
</head>
<body>

    @include('quotations.pdf._letterhead', ['company' => $company])

    <table class="meta-bar">
        <tr>
            <td><span class="label">Ref. No.</span><br><strong>{{ $quotation->reference_number }}</strong></td>
            <td class="right"><span class="label">Date</span><br><strong>{{ $quotation->created_at?->format('d M Y') }}</strong></td>
        </tr>
    </table>

    <div class="customer-block">
        <div class="to">To,</div>
        <div class="name">M/s {{ $customer->name ?? '' }}</div>
        @if($customer?->address)<div class="line">{{ $customer->address }}</div>@endif
        @if($customer?->city || $customer?->state)
            <div class="line">{{ trim(($customer->city ?? '') . ($customer->state ? ', ' . $customer->state : '')) }}</div>
        @endif
        @if($quotation->location)<div class="line"><strong>Project/Site:</strong> {{ $quotation->location }}</div>@endif
        @if($quotation->kind_attn)<div class="line" style="margin-top:4px;"><strong>Kind Attn:</strong> {{ $quotation->kind_attn }}</div>@endif
    </div>

    @if($quotation->subject)
        <p style="margin-top:10px;"><strong>Subject:</strong> {{ $quotation->subject }}</p>
    @endif

    <div class="cover">
        <p>Dear Sir / Madam,</p>
        <p>{{ $quotation->cover_letter ?: ($company->default_cover_letter ?: '') }}</p>
    </div>

    <div class="section-title">Annexure I - Scope &amp; Pricing</div>
    <table class="items">
        <thead>
            <tr>
                <th style="width:5%">S.No</th>
                <th style="width:45%">Description</th>
                <th style="width:9%">HSN</th>
                <th style="width:8%" class="num">Qty</th>
                <th style="width:8%" class="center">Unit</th>
                <th style="width:12%" class="num">Rate (Rs.)</th>
                <th style="width:13%" class="num">Amount (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $idx => $item)
                <tr>
                    <td class="center">{{ $idx + 1 }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="center">{{ $item->hsn_code ?: '-' }}</td>
                    <td class="num">{{ rtrim(rtrim(number_format((float) $item->quantity, 2), '0'), '.') }}</td>
                    <td class="center">{{ $item->unit }}</td>
                    <td class="num">{{ number_format((float) $item->rate, 2) }}</td>
                    <td class="num">{{ number_format((float) $item->amount, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="center small">No items</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="num">Subtotal</td>
                <td class="num">{{ number_format((float) $quotation->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="6" class="num">GST @ {{ rtrim(rtrim(number_format((float) $quotation->gst_percent, 2), '0'), '.') }}%</td>
                <td class="num">{{ number_format((float) $quotation->gst_amount, 2) }}</td>
            </tr>
            <tr class="grand">
                <td colspan="6" class="num">Grand Total</td>
                <td class="num">Rs. {{ number_format((float) $quotation->grand_total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="section-title">Terms &amp; Conditions</div>
    <div class="terms">
        <p><span class="k">Validity</span>: Our offer shall remain valid for {{ $quotation->validity_days }} days from the date of this offer.</p>
        <p><span class="k">Price Basis</span>: Above prices are ex-factory. GST @ {{ rtrim(rtrim(number_format((float) $quotation->gst_percent, 2), '0'), '.') }}% as shown.</p>
        @if($quotation->freight)<p><span class="k">Freight</span>: {{ $quotation->freight }}</p>@endif
        @if($quotation->jurisdiction)<p><span class="k">Jurisdiction</span>: All matters are subject to {{ $quotation->jurisdiction }} jurisdiction.</p>@endif
        @if($quotation->delivery_terms)<p><span class="k">Delivery</span>: {{ $quotation->delivery_terms }}</p>@endif
        @if($quotation->payment_terms)<p><span class="k">Payment</span>: {{ $quotation->payment_terms }}</p>@endif
        @if($quotation->warranty_terms)<p><span class="k">Warranty</span>: {{ $quotation->warranty_terms }}</p>@endif
        @if($quotation->notes)<p><span class="k">Notes</span>: {{ $quotation->notes }}</p>@endif
    </div>

    @if($company->bank_ac_no)
        <div class="section-title">Bank Details (RTGS / NEFT)</div>
        <div class="bank">
            <p><span class="k">Bank</span> {{ $company->bank_name }}@if($company->bank_branch), {{ $company->bank_branch }}@endif</p>
            <p><span class="k">A/C Name</span> {{ $company->name }}</p>
            <p><span class="k">A/C No.</span> {{ $company->bank_ac_no }}</p>
            <p><span class="k">IFSC</span> {{ $company->bank_ifsc }}</p>
            @if($company->bank_pin)<p><span class="k">PIN</span> {{ $company->bank_pin }}</p>@endif
        </div>
    @endif

    <div class="signature">
        <p>Thanking you,</p>
        <p style="margin-top:14px;">Truly Yours,</p>
        <p class="line name">For {{ $company->name }}</p>
        <p class="line" style="margin-top:28px;"><strong>{{ $company->signatory_name }}</strong></p>
        @if($company->signatory_title)<p class="line small">({{ $company->signatory_title }})</p>@endif
        @if($company->signatory_phone)<p class="line small">Mobile: +91-{{ $company->signatory_phone }}</p>@endif
    </div>

    <div class="footer">{{ $company->name }}</div>

</body>
</html>
