@extends('layouts.dashboard')

@section('title', 'Edit ' . $profile->name)
@section('page-title', 'Edit ' . $profile->name)

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-4xl">
        <form method="POST" action="{{ route('admin.company-profiles.update', $profile) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="glass rounded-2xl p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium t-muted mb-1.5">Logo (ID / visiting cards, optional)</label>
                    @if($profile->logo_path)
                        <div class="mb-2 flex items-center gap-4">
                            <img src="{{ asset('storage/'.$profile->logo_path) }}" alt="" class="h-14 w-auto max-w-[200px] object-contain rounded-lg border border-theme bg-white p-1">
                            <label class="inline-flex items-center gap-2 text-xs t-secondary cursor-pointer">
                                <input type="checkbox" name="remove_logo" value="1" {{ old('remove_logo') ? 'checked' : '' }}>
                                Remove current logo
                            </label>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/jpeg,image/png,image/webp,image/gif"
                        class="block w-full text-sm t-secondary file:mr-3 file:rounded-lg file:border-0 file:bg-solar-500 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-dark-900">
                    <p class="mt-1 text-[11px] t-faint">PNG or JPG, max 4 MB. Shown on PDF cards when set.</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium t-muted mb-1.5">Company name</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium t-muted mb-1.5">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" maxlength="500" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium t-muted mb-1.5">Office address</label>
                    <textarea name="address_office" rows="2" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ old('address_office', $profile->address_office) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium t-muted mb-1.5">Factory address (optional)</label>
                    <textarea name="address_factory" rows="2" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ old('address_factory', $profile->address_factory) }}</textarea>
                </div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">City</label><input type="text" name="city" value="{{ old('city', $profile->city) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">State</label><input type="text" name="state" value="{{ old('state', $profile->state) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Pincode</label><input type="text" name="pincode" value="{{ old('pincode', $profile->pincode) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">GSTIN</label><input type="text" name="gstin" value="{{ old('gstin', $profile->gstin) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm font-mono"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Email</label><input type="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Website (optional)</label><input type="text" name="website" value="{{ old('website', $profile->website) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div class="sm:col-span-2"><label class="block text-xs font-medium t-muted mb-1.5">Phone numbers (one per line or comma separated)</label>
                    <textarea name="phones" rows="2" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">{{ old('phones', implode("\n", (array) ($profile->phones ?? []))) }}</textarea>
                </div>
            </div>

            <div class="glass rounded-2xl p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2"><h3 class="text-sm font-semibold t-primary">Bank</h3></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Bank name</label><input type="text" name="bank_name" value="{{ old('bank_name', $profile->bank_name) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Branch</label><input type="text" name="bank_branch" value="{{ old('bank_branch', $profile->bank_branch) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">A/C No.</label><input type="text" name="bank_ac_no" value="{{ old('bank_ac_no', $profile->bank_ac_no) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm font-mono"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">IFSC</label><input type="text" name="bank_ifsc" value="{{ old('bank_ifsc', $profile->bank_ifsc) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm font-mono"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Bank PIN</label><input type="text" name="bank_pin" value="{{ old('bank_pin', $profile->bank_pin) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
            </div>

            <div class="glass rounded-2xl p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2"><h3 class="text-sm font-semibold t-primary">Signatory</h3></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Name</label><input type="text" name="signatory_name" value="{{ old('signatory_name', $profile->signatory_name) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Title / designation</label><input type="text" name="signatory_title" value="{{ old('signatory_title', $profile->signatory_title) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Phone</label><input type="text" name="signatory_phone" value="{{ old('signatory_phone', $profile->signatory_phone) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
            </div>

            <div class="glass rounded-2xl p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2"><h3 class="text-sm font-semibold t-primary">Reference &amp; defaults</h3></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Reference prefix</label><input type="text" name="ref_prefix" value="{{ old('ref_prefix', $profile->ref_prefix) }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm font-mono"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Year mode</label>
                    <select name="ref_year_mode" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                        <option value="calendar" @selected(old('ref_year_mode', $profile->ref_year_mode) === 'calendar')>Calendar year (e.g. 2026)</option>
                        <option value="fiscal" @selected(old('ref_year_mode', $profile->ref_year_mode) === 'fiscal')>Fiscal year Apr-Mar (e.g. 2026-27)</option>
                    </select>
                </div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Next sequence</label><input type="number" min="1" name="next_quotation_seq" value="{{ old('next_quotation_seq', $profile->next_quotation_seq) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Default GST %</label><input type="number" step="0.01" min="0" max="100" name="default_gst_percent" value="{{ old('default_gst_percent', $profile->default_gst_percent) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Default validity (days)</label><input type="number" min="1" max="365" name="default_validity_days" value="{{ old('default_validity_days', $profile->default_validity_days) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Default freight</label><input type="text" name="default_freight" value="{{ old('default_freight', $profile->default_freight) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-medium t-muted mb-1.5">Default jurisdiction</label><input type="text" name="default_jurisdiction" value="{{ old('default_jurisdiction', $profile->default_jurisdiction) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm"></div>
                <div class="sm:col-span-2"><label class="block text-xs font-medium t-muted mb-1.5">Default cover letter</label>
                    <textarea name="default_cover_letter" rows="3" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">{{ old('default_cover_letter', $profile->default_cover_letter) }}</textarea>
                </div>
                <div class="sm:col-span-2"><label class="block text-xs font-medium t-muted mb-1.5">Default payment terms</label>
                    <textarea name="default_payment_terms" rows="2" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">{{ old('default_payment_terms', $profile->default_payment_terms) }}</textarea>
                </div>
                <div class="sm:col-span-2"><label class="block text-xs font-medium t-muted mb-1.5">Default delivery terms</label>
                    <textarea name="default_delivery_terms" rows="2" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">{{ old('default_delivery_terms', $profile->default_delivery_terms) }}</textarea>
                </div>
                <div class="sm:col-span-2"><label class="block text-xs font-medium t-muted mb-1.5">Default warranty terms</label>
                    <textarea name="default_warranty_terms" rows="2" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">{{ old('default_warranty_terms', $profile->default_warranty_terms) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $profile->is_active)) class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
                        <span class="text-sm t-secondary">Active (show in quotation forms)</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">Save</button>
                <a href="{{ route('admin.company-profiles.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">Cancel</a>
            </div>
        </form>
    </div>
@endsection
