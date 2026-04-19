@php
    $company = $quotation->company;
    $customer = $quotation->customer;
    $items = $quotation->items;
@endphp

<div class="max-w-4xl mx-auto">
    <article class="bg-white text-slate-900 rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10" style="font-family: 'Inter', system-ui, sans-serif;">
        <header class="text-center border-b-2 border-slate-900 pb-4">
            <h1 class="text-2xl font-extrabold tracking-wide uppercase">{{ $company->name }}</h1>
            @if($company->tagline)
                <p class="italic text-xs text-slate-600 mt-1">{{ $company->tagline }}</p>
            @endif
            <p class="text-xs text-slate-700 mt-2">
                <strong>Office:</strong> {{ $company->address_office }}
                @if($company->address_factory)
                    <br><strong>Factory:</strong> {{ $company->address_factory }}
                @endif
            </p>
            <p class="text-xs text-slate-700 mt-1">
                @if($company->email)<strong>Email:</strong> {{ $company->email }}@endif
                @if($company->phonesList()) &nbsp;|&nbsp; <strong>Phones:</strong> {{ $company->phonesList() }} @endif
                @if($company->gstin) &nbsp;|&nbsp; <strong>GSTIN:</strong> {{ $company->gstin }} @endif
            </p>
        </header>

        <div class="flex items-center justify-between mt-4 text-xs">
            <div>
                <div class="text-slate-500 uppercase tracking-wider font-semibold">Ref. No.</div>
                <div class="font-bold text-slate-900 text-sm">{{ $quotation->reference_number }}</div>
            </div>
            <div class="text-right">
                <div class="text-slate-500 uppercase tracking-wider font-semibold">Date</div>
                <div class="font-bold text-slate-900 text-sm">{{ $quotation->created_at?->format('d M Y') }}</div>
            </div>
        </div>

        <div class="mt-4 bg-slate-50 border border-slate-200 rounded-lg p-4 text-sm">
            <div class="text-[10px] uppercase tracking-wider font-semibold text-slate-500">To,</div>
            <div class="font-bold text-slate-900">M/s {{ $customer?->name ?? '—' }}</div>
            @if($customer?->address)<div class="text-slate-700 text-xs">{{ $customer->address }}</div>@endif
            @if($customer?->city || $customer?->state)
                <div class="text-slate-700 text-xs">{{ trim(($customer->city ?? '') . ($customer->state ? ', ' . $customer->state : '')) }}</div>
            @endif
            @if($quotation->location)<div class="text-slate-800 text-xs mt-1"><strong>Project/Site:</strong> {{ $quotation->location }}</div>@endif
            @if($quotation->kind_attn)<div class="text-slate-800 text-xs mt-1"><strong>Kind Attn:</strong> {{ $quotation->kind_attn }}</div>@endif
        </div>

        @if($quotation->subject)
            <p class="mt-4 text-sm"><strong>Subject:</strong> {{ $quotation->subject }}</p>
        @endif

        <div class="mt-4 text-sm text-slate-800 leading-relaxed">
            <p>Dear Sir / Madam,</p>
            <p class="mt-2 text-justify">{{ $quotation->cover_letter ?: $company->default_cover_letter }}</p>
        </div>

        <h3 class="mt-6 text-xs font-bold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1">Annexure I - Scope &amp; Pricing</h3>
        <div class="overflow-x-auto mt-2">
            <table class="w-full text-xs border border-slate-300">
                <thead>
                    <tr class="bg-slate-900 text-white">
                        <th class="p-2 text-left">S.No</th>
                        <th class="p-2 text-left">Description</th>
                        <th class="p-2 text-left">HSN</th>
                        <th class="p-2 text-right">Qty</th>
                        <th class="p-2 text-center">Unit</th>
                        <th class="p-2 text-right">Rate</th>
                        <th class="p-2 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $i => $item)
                        <tr class="border-t border-slate-200">
                            <td class="p-2 text-center">{{ $i + 1 }}</td>
                            <td class="p-2 whitespace-pre-line">{{ $item->description }}</td>
                            <td class="p-2 text-center">{{ $item->hsn_code ?: '—' }}</td>
                            <td class="p-2 text-right tabular-nums">{{ rtrim(rtrim(number_format((float) $item->quantity, 2), '0'), '.') }}</td>
                            <td class="p-2 text-center">{{ $item->unit }}</td>
                            <td class="p-2 text-right tabular-nums">{{ number_format((float) $item->rate, 2) }}</td>
                            <td class="p-2 text-right tabular-nums">{{ number_format((float) $item->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="p-4 text-center text-slate-400">No items</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-slate-100 font-semibold">
                        <td colspan="6" class="p-2 text-right">Subtotal</td>
                        <td class="p-2 text-right tabular-nums">{{ number_format((float) $quotation->subtotal, 2) }}</td>
                    </tr>
                    <tr class="bg-slate-100 font-semibold">
                        <td colspan="6" class="p-2 text-right">GST @ {{ rtrim(rtrim(number_format((float) $quotation->gst_percent, 2), '0'), '.') }}%</td>
                        <td class="p-2 text-right tabular-nums">{{ number_format((float) $quotation->gst_amount, 2) }}</td>
                    </tr>
                    <tr class="bg-slate-900 text-white font-bold">
                        <td colspan="6" class="p-2 text-right">Grand Total</td>
                        <td class="p-2 text-right tabular-nums">Rs. {{ number_format((float) $quotation->grand_total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <h3 class="mt-6 text-xs font-bold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1">Terms &amp; Conditions</h3>
        <div class="text-xs mt-2 space-y-1 text-slate-800">
            <p><strong class="inline-block w-24">Validity</strong>: {{ $quotation->validity_days }} days from date of this offer.</p>
            @if($quotation->freight)<p><strong class="inline-block w-24">Freight</strong>: {{ $quotation->freight }}</p>@endif
            @if($quotation->jurisdiction)<p><strong class="inline-block w-24">Jurisdiction</strong>: {{ $quotation->jurisdiction }}</p>@endif
            @if($quotation->delivery_terms)<p><strong class="inline-block w-24">Delivery</strong>: {{ $quotation->delivery_terms }}</p>@endif
            @if($quotation->payment_terms)<p><strong class="inline-block w-24">Payment</strong>: {{ $quotation->payment_terms }}</p>@endif
            @if($quotation->warranty_terms)<p><strong class="inline-block w-24">Warranty</strong>: {{ $quotation->warranty_terms }}</p>@endif
            @if($quotation->notes)<p><strong class="inline-block w-24">Notes</strong>: {{ $quotation->notes }}</p>@endif
        </div>

        @if($company->bank_ac_no)
            <h3 class="mt-6 text-xs font-bold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1">Bank Details (RTGS / NEFT)</h3>
            <div class="mt-2 text-xs border border-dashed border-slate-400 rounded-lg p-3 bg-slate-50">
                <p><strong class="inline-block w-20 text-slate-500 uppercase text-[10px]">Bank</strong> {{ $company->bank_name }}@if($company->bank_branch), {{ $company->bank_branch }}@endif</p>
                <p><strong class="inline-block w-20 text-slate-500 uppercase text-[10px]">A/C Name</strong> {{ $company->name }}</p>
                <p><strong class="inline-block w-20 text-slate-500 uppercase text-[10px]">A/C No.</strong> {{ $company->bank_ac_no }}</p>
                <p><strong class="inline-block w-20 text-slate-500 uppercase text-[10px]">IFSC</strong> {{ $company->bank_ifsc }}</p>
                @if($company->bank_pin)<p><strong class="inline-block w-20 text-slate-500 uppercase text-[10px]">PIN</strong> {{ $company->bank_pin }}</p>@endif
            </div>
        @endif

        <div class="mt-8 text-sm text-slate-800">
            <p>Thanking you,</p>
            <p class="mt-3">Truly Yours,</p>
            <p class="font-semibold">For {{ $company->name }}</p>
            <p class="mt-10 font-bold">{{ $company->signatory_name }}</p>
            @if($company->signatory_title)<p class="text-xs text-slate-600">({{ $company->signatory_title }})</p>@endif
            @if($company->signatory_phone)<p class="text-xs text-slate-600">Mobile: +91-{{ $company->signatory_phone }}</p>@endif
        </div>
    </article>
</div>
