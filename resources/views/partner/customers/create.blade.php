@extends('layouts.dashboard')

@section('title', 'Add New Customer')
@section('page-title', 'Add New Customer')

@section('sidebar')
    <a href="{{ route('partner.dashboard') }}" class="sidebar-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
        Dashboard
    </a>
    <a href="{{ route('partner.customers.index') }}" class="sidebar-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        My Customers
    </a>
    <a href="{{ route('partner.commissions.index') }}" class="sidebar-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        Commissions
    </a>
@endsection

@section('content')
    <form method="post" action="{{ route('partner.customers.store') }}" class="max-w-3xl space-y-6">
        @csrf

        <div class="glass rounded-2xl p-6 sm:p-8 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-xs font-medium t-muted mb-1.5">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div>
                    <label for="phone" class="block text-xs font-medium t-muted mb-1.5">Phone <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium t-muted mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label for="address" class="block text-xs font-medium t-muted mb-1.5">Address <span class="text-red-500">*</span></label>
                    <textarea name="address" id="address" rows="2" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">{{ old('address') }}</textarea>
                </div>
                <div>
                    <label for="city" class="block text-xs font-medium t-muted mb-1.5">City <span class="text-red-500">*</span></label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div>
                    <label for="state" class="block text-xs font-medium t-muted mb-1.5">State <span class="text-red-500">*</span></label>
                    <input type="text" name="state" id="state" value="{{ old('state') }}" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label for="installation_location" class="block text-xs font-medium t-muted mb-1.5">Installation location</label>
                    <input type="text" name="installation_location" id="installation_location" value="{{ old('installation_location') }}" class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div>
                    <label for="system_capacity_kw" class="block text-xs font-medium t-muted mb-1.5">System capacity (kW)</label>
                    <input type="number" step="0.1" min="0.1" name="system_capacity_kw" id="system_capacity_kw" value="{{ old('system_capacity_kw') }}" class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                </div>
                <div>
                    <label for="package_selected" class="block text-xs font-medium t-muted mb-1.5">Package</label>
                    <select name="package_selected" id="package_selected" class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                        <option value="">— Select —</option>
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg->name }}" @selected(old('package_selected') === $pkg->name)>{{ $pkg->name }} @if($pkg->system_size_kw) ({{ $pkg->system_size_kw }} kW) @endif</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="installation_type" class="block text-xs font-medium t-muted mb-1.5">Installation type <span class="text-red-500">*</span></label>
                    <select name="installation_type" id="installation_type" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                        <option value="domestic" @selected(old('installation_type') === 'domestic')>Domestic</option>
                        <option value="commercial" @selected(old('installation_type') === 'commercial')>Commercial</option>
                    </select>
                </div>
                <div>
                    <label for="payment_method" class="block text-xs font-medium t-muted mb-1.5">Payment method <span class="text-red-500">*</span></label>
                    <select name="payment_method" id="payment_method" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                        <option value="cash" @selected(old('payment_method') === 'cash')>Cash</option>
                        <option value="loan" @selected(old('payment_method') === 'loan')>Loan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-solar-500 px-6 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-400 transition">Submit</button>
            <a href="{{ route('partner.customers.index') }}" class="inline-flex items-center justify-center rounded-xl border border-theme bg-white/5 px-6 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
@endsection
