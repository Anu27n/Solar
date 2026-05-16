@php
    if (! isset($quotation)) {
        $quotation = null;
    }
    $isEdit = $quotation && $quotation->exists;
    $companyDefaults = [];
    foreach ($companies as $c) {
        $companyDefaults[$c->id] = [
            'payment_terms' => $c->default_payment_terms,
            'delivery_terms' => $c->default_delivery_terms,
            'warranty_terms' => $c->default_warranty_terms,
            'freight' => $c->default_freight,
            'jurisdiction' => $c->default_jurisdiction,
            'gst_percent' => (float) $c->default_gst_percent,
            'validity_days' => (int) $c->default_validity_days,
            'cover_letter' => $c->default_cover_letter,
            'ref_preview' => $c->ref_prefix . '/' . str_pad((string) $c->next_quotation_seq, 2, '0', STR_PAD_LEFT) . '/' . ($c->ref_year_mode === 'fiscal' ? now()->month >= 4 ? (now()->year . '-' . substr(now()->addYear()->year, -2)) : ((now()->year - 1) . '-' . substr(now()->year, -2)) : now()->year),
        ];
    }
    $existingItems = [];
    if ($isEdit) {
        foreach ($quotation->items as $it) {
            $existingItems[] = [
                'id' => $it->id,
                'description' => $it->description,
                'hsn_code' => $it->hsn_code,
                'quantity' => (float) $it->quantity,
                'unit' => $it->unit,
                'rate' => (float) $it->rate,
            ];
        }
    }
    if (empty($existingItems) && !old('items')) {
        $existingItems = [[
            'id' => null, 'description' => '', 'hsn_code' => '', 'quantity' => 1, 'unit' => 'Nos', 'rate' => 0,
        ]];
    }
    if (old('items')) {
        $existingItems = collect(old('items'))->map(fn ($r) => [
            'id' => $r['id'] ?? null,
            'description' => $r['description'] ?? '',
            'hsn_code' => $r['hsn_code'] ?? '',
            'quantity' => (float) ($r['quantity'] ?? 1),
            'unit' => $r['unit'] ?? 'Nos',
            'rate' => (float) ($r['rate'] ?? 0),
        ])->all();
    }

    $companyId = old('company_profile_id', $quotation?->company_profile_id ?? ($companies->first()->id ?? null));
    $gstPercent = (float) old('gst_percent', $quotation?->gst_percent ?? 18);
    $validityDays = (int) old('validity_days', $quotation?->validity_days ?? 60);
    $paymentTerms = old('payment_terms', $quotation?->payment_terms ?? '');
    $deliveryTerms = old('delivery_terms', $quotation?->delivery_terms ?? '');
    $warrantyTerms = old('warranty_terms', $quotation?->warranty_terms ?? '');
    $freight = old('freight', $quotation?->freight ?? '');
    $jurisdiction = old('jurisdiction', $quotation?->jurisdiction ?? 'Kanpur');
    $coverLetter = old('cover_letter', $quotation?->cover_letter ?? '');
@endphp

<form
    method="POST"
    action="{{ $isEdit ? route('admin.quotations.update', $quotation) : route('admin.quotations.store') }}"
    class="space-y-6"
    x-data='quotationForm(@json([
        "companyDefaults" => $companyDefaults,
        "items" => $existingItems,
        "gstPercent" => $gstPercent,
        "companyId" => $companyId,
        "isEdit" => $isEdit,
    ]))'
>
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- Company selector --}}
    <div class="glass rounded-2xl p-5 sm:p-6">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-semibold t-primary">Company</h3>
            @unless($isEdit)
                <span class="text-[11px] t-muted">Next reference: <strong class="t-secondary" x-text="currentRefPreview()"></strong></span>
            @else
                <span class="text-[11px] t-muted">Ref #<strong class="t-secondary">{{ $quotation->reference_number }}</strong></span>
            @endunless
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @foreach($companies as $c)
                <label class="cursor-pointer">
                    <input type="radio" name="company_profile_id" value="{{ $c->id }}" class="peer sr-only"
                        @checked((int) $companyId === $c->id)
                        x-on:change="applyCompanyDefaults({{ $c->id }})">
                    <div class="rounded-xl border border-theme bg-input p-4 transition peer-checked:border-solar-500 peer-checked:bg-solar-500/10 peer-checked:ring-2 peer-checked:ring-solar-500/30 hover:border-solar-500/50">
                        <div class="text-[11px] t-faint uppercase tracking-wider">{{ $c->ref_prefix }}</div>
                        <div class="font-semibold t-primary text-sm mt-1">{{ $c->name }}</div>
                        @if($c->tagline)
                            <div class="text-[10px] t-muted mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($c->tagline, 100) }}</div>
                        @endif
                    </div>
                </label>
            @endforeach
        </div>
    </div>

    {{-- Customer + meta --}}
    <div class="glass rounded-2xl p-5 sm:p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div class="sm:col-span-2">
            <label for="customer_id" class="block text-xs font-medium t-muted mb-1.5">Customer <span class="text-red-500">*</span></label>
            <select name="customer_id" id="customer_id" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                <option value="">Select customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(old('customer_id', $quotation?->customer_id ?? ($selectedCustomer->id ?? '')) == $customer->id)>
                        {{ $customer->name }}@if($customer->city) — {{ $customer->city }}@endif
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="location" class="block text-xs font-medium t-muted mb-1.5">Location (site / project)</label>
            <input type="text" name="location" id="location" value="{{ old('location', $quotation?->location ?? '') }}" maxlength="255"
                placeholder="Project site / city"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
        </div>

        <div>
            <label for="kind_attn" class="block text-xs font-medium t-muted mb-1.5">Kind Attn (optional)</label>
            <input type="text" name="kind_attn" id="kind_attn" value="{{ old('kind_attn', $quotation?->kind_attn ?? '') }}" maxlength="255"
                placeholder="Mr. / Ms. ..."
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
        </div>

        <div class="sm:col-span-2">
            <label for="subject" class="block text-xs font-medium t-muted mb-1.5">Subject</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject', $quotation?->subject ?? '') }}" maxlength="500"
                placeholder="TECHNO COMMERCIAL OFFER FOR ..."
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
        </div>

        <div class="sm:col-span-2">
            <label for="cover_letter" class="block text-xs font-medium t-muted mb-1.5">Cover letter / Intro paragraph</label>
            <textarea name="cover_letter" id="cover_letter" rows="3" x-model="coverLetter"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ $coverLetter }}</textarea>
            <p class="mt-1 text-[11px] t-faint">Default comes from company settings; edit per quote if needed.</p>
        </div>

        <div>
            <label for="package_id" class="block text-xs font-medium t-muted mb-1.5">Package (optional)</label>
            <select name="package_id" id="package_id" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                <option value="">— none —</option>
                @foreach($packages as $package)
                    <option value="{{ $package->id }}" data-price="{{ $package->price }}"
                        @selected(old('package_id', $quotation?->package_id ?? '') == $package->id)>
                        {{ $package->name }} — {{ $package->system_size_kw }} kW — ₹{{ number_format($package->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Items table --}}
    <div class="glass rounded-2xl p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
            <div>
                <h3 class="text-sm font-semibold t-primary">Line items</h3>
                <p class="text-[11px] t-muted mt-0.5">Use one row per equipment / service line</p>
            </div>
            <button type="button" x-on:click="addItem" class="inline-flex items-center gap-1.5 rounded-xl bg-solar-500 px-3 py-2 text-xs font-semibold text-dark-900 hover:bg-solar-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Add row
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b border-theme">
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider">#</th>
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider">Description</th>
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider">HSN</th>
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider">Qty</th>
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider">Unit</th>
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider">Rate (₹)</th>
                        <th class="py-2 pr-2 text-[11px] font-semibold t-faint uppercase tracking-wider text-right">Amount</th>
                        <th class="py-2 text-[11px] font-semibold t-faint"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, idx) in items" :key="idx">
                        <tr class="border-b border-subtle align-top">
                            <td class="py-2 pr-2 t-muted tabular-nums" x-text="idx + 1"></td>
                            <td class="py-2 pr-2">
                                <input type="hidden" :name="`items[${idx}][id]`" :value="item.id || ''">
                                <textarea :name="`items[${idx}][description]`" x-model="item.description" rows="2" required
                                    class="w-full rounded-lg bg-input border border-theme t-primary px-2.5 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-solar-500"
                                    placeholder="Equipment / service description"></textarea>
                            </td>
                            <td class="py-2 pr-2">
                                <input type="text" :name="`items[${idx}][hsn_code]`" x-model="item.hsn_code" maxlength="20"
                                    class="w-20 rounded-lg bg-input border border-theme t-primary px-2.5 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-solar-500">
                            </td>
                            <td class="py-2 pr-2">
                                <input type="number" step="0.01" min="0" :name="`items[${idx}][quantity]`" x-model.number="item.quantity" required
                                    class="w-20 rounded-lg bg-input border border-theme t-primary px-2.5 py-1.5 text-xs text-right focus:outline-none focus:ring-2 focus:ring-solar-500">
                            </td>
                            <td class="py-2 pr-2">
                                <select :name="`items[${idx}][unit]`" x-model="item.unit" class="w-20 rounded-lg bg-input border border-theme t-primary px-2 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-solar-500">
                                    <template x-for="u in unitOptions" :key="u">
                                        <option :value="u" x-text="u"></option>
                                    </template>
                                </select>
                            </td>
                            <td class="py-2 pr-2">
                                <input type="number" step="0.01" min="0" :name="`items[${idx}][rate]`" x-model.number="item.rate" required
                                    class="w-28 rounded-lg bg-input border border-theme t-primary px-2.5 py-1.5 text-xs text-right focus:outline-none focus:ring-2 focus:ring-solar-500">
                            </td>
                            <td class="py-2 pr-2 text-right font-medium t-secondary tabular-nums" x-text="formatAmount(item.quantity * item.rate)"></td>
                            <td class="py-2 text-right">
                                <button type="button" x-on:click="removeItem(idx)" x-show="items.length > 1"
                                    class="p-1.5 rounded-lg text-red-500 hover:bg-red-500/10 transition" title="Remove row">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
                <tfoot>
                    <tr class="border-t border-theme">
                        <td colspan="6" class="py-2 pr-2 text-right text-xs t-muted">Subtotal</td>
                        <td class="py-2 pr-2 text-right font-semibold t-primary tabular-nums" x-text="formatAmount(subtotal())"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2 pr-2 text-right text-xs t-muted">
                            GST
                            <input type="number" step="0.01" min="0" max="100" name="gst_percent" x-model.number="gstPercent"
                                class="inline-block w-16 ml-1 rounded-lg bg-input border border-theme t-primary px-2 py-1 text-xs text-right focus:outline-none focus:ring-2 focus:ring-solar-500">%
                        </td>
                        <td class="py-2 pr-2 text-right t-secondary tabular-nums" x-text="formatAmount(gstAmount())"></td>
                        <td></td>
                    </tr>
                    <tr class="border-t border-theme">
                        <td colspan="6" class="py-2 pr-2 text-right text-sm font-semibold t-primary">Grand Total</td>
                        <td class="py-2 pr-2 text-right text-base font-bold text-solar-600 dark:text-solar-400 tabular-nums" x-text="'₹' + formatAmount(grandTotal())"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Terms --}}
    <div class="glass rounded-2xl p-5 sm:p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label for="validity_days" class="block text-xs font-medium t-muted mb-1.5">Validity (days)</label>
            <input type="number" min="1" max="365" name="validity_days" id="validity_days" value="{{ $validityDays }}" required
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
        </div>
        <div>
            <label for="freight" class="block text-xs font-medium t-muted mb-1.5">Freight</label>
            <input type="text" name="freight" id="freight" x-model="freight" value="{{ $freight }}" maxlength="100"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
        </div>
        <div>
            <label for="jurisdiction" class="block text-xs font-medium t-muted mb-1.5">Jurisdiction</label>
            <input type="text" name="jurisdiction" id="jurisdiction" x-model="jurisdiction" value="{{ $jurisdiction }}" maxlength="100"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
        </div>
        <div class="sm:col-span-2">
            <label for="payment_terms" class="block text-xs font-medium t-muted mb-1.5">Payment terms</label>
            <textarea name="payment_terms" id="payment_terms" rows="2" x-model="paymentTerms"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ $paymentTerms }}</textarea>
        </div>
        <div class="sm:col-span-2">
            <label for="delivery_terms" class="block text-xs font-medium t-muted mb-1.5">Delivery terms</label>
            <textarea name="delivery_terms" id="delivery_terms" rows="2" x-model="deliveryTerms"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ $deliveryTerms }}</textarea>
        </div>
        <div class="sm:col-span-2">
            <label for="warranty_terms" class="block text-xs font-medium t-muted mb-1.5">Warranty terms</label>
            <textarea name="warranty_terms" id="warranty_terms" rows="2" x-model="warrantyTerms"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ $warrantyTerms }}</textarea>
        </div>
        <div class="sm:col-span-2">
            <label for="notes" class="block text-xs font-medium t-muted mb-1.5">Additional notes (optional)</label>
            <textarea name="notes" id="notes" rows="2"
                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ old('notes', $quotation?->notes ?? '') }}</textarea>
        </div>
    </div>

    <div class="glass rounded-2xl p-5 sm:p-6 space-y-3">
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="send_email" value="1" {{ old('send_email') ? 'checked' : '' }}
                class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
            <span class="text-sm t-secondary">Email PDF to customer after {{ $isEdit ? 'update' : 'create' }}</span>
        </label>
        @unless($isEdit)
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="send_whatsapp" value="1" {{ old('send_whatsapp') ? 'checked' : '' }}
                class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
            <span class="text-sm t-secondary">Mark as sent via WhatsApp (manual)</span>
        </label>
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="send_sms" value="1" {{ old('send_sms') ? 'checked' : '' }}
                class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
            <span class="text-sm t-secondary">Mark as sent via SMS (manual)</span>
        </label>
        @endunless
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-400 transition">
            {{ $isEdit ? 'Save changes' : 'Create quotation' }}
        </button>
        <a href="{{ route('admin.quotations.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">Cancel</a>
    </div>
</form>

<script>
    function quotationForm(config) {
        return {
            items: config.items,
            companyDefaults: config.companyDefaults,
            companyId: config.companyId,
            isEdit: config.isEdit,
            gstPercent: config.gstPercent,
            paymentTerms: @json($paymentTerms),
            deliveryTerms: @json($deliveryTerms),
            warrantyTerms: @json($warrantyTerms),
            freight: @json($freight),
            jurisdiction: @json($jurisdiction),
            coverLetter: @json($coverLetter),
            unitOptions: ['Nos', 'Set', 'Lot', 'Pair', 'Meter', 'Meters', 'Kg', 'Ltr', 'Job', 'Hrs', 'Bag'],

            addItem() {
                this.items.push({ id: null, description: '', hsn_code: '', quantity: 1, unit: 'Nos', rate: 0 });
            },
            removeItem(idx) {
                if (this.items.length === 1) return;
                this.items.splice(idx, 1);
            },
            subtotal() {
                return this.items.reduce((s, it) => s + (parseFloat(it.quantity || 0) * parseFloat(it.rate || 0)), 0);
            },
            gstAmount() {
                return Math.round(this.subtotal() * (parseFloat(this.gstPercent || 0) / 100) * 100) / 100;
            },
            grandTotal() {
                return Math.round((this.subtotal() + this.gstAmount()) * 100) / 100;
            },
            formatAmount(v) {
                return (Math.round((v || 0) * 100) / 100).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            },
            applyCompanyDefaults(id) {
                this.companyId = id;
                const d = this.companyDefaults[id];
                if (!d) return;
                if (!this.isEdit) {
                    this.paymentTerms = d.payment_terms || '';
                    this.deliveryTerms = d.delivery_terms || '';
                    this.warrantyTerms = d.warranty_terms || '';
                    this.freight = d.freight || '';
                    this.jurisdiction = d.jurisdiction || 'Kanpur';
                    this.gstPercent = d.gst_percent ?? 18;
                    this.coverLetter = d.cover_letter || '';
                    const vd = document.getElementById('validity_days');
                    if (vd && d.validity_days) vd.value = d.validity_days;
                }
            },
            currentRefPreview() {
                const d = this.companyDefaults[this.companyId];
                return d ? d.ref_preview : '—';
            },
        };
    }
</script>
