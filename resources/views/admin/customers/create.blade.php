@extends('layouts.dashboard')

@section('title', 'Add Customer')
@section('page-title', 'Add Customer')
@section('page-subtitle', 'Create a customer and assign to a channel partner')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.customers.store') }}" class="max-w-3xl space-y-6">
        @csrf

        <div class="glass rounded-2xl p-6 sm:p-8 space-y-5">
            <h3 class="text-sm font-semibold t-primary">Assignment</h3>
            <div>
                <label for="channel_partner_id" class="block text-xs font-medium t-muted mb-1.5">Channel Partner <span class="text-red-500">*</span></label>
                <select name="channel_partner_id" id="channel_partner_id" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                    <option value="">Select channel partner</option>
                    @foreach($channelPartners as $partner)
                        <option value="{{ $partner->id }}" @selected(old('channel_partner_id') == $partner->id)>
                            {{ $partner->name }}@if($partner->phone) — {{ $partner->phone }}@endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2"><h3 class="text-sm font-semibold t-primary">Customer details</h3></div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Phone <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-xs font-medium t-muted mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                <p class="mt-1 text-[11px] t-faint">Portal login details will be emailed here after creation.</p>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-xs font-medium t-muted mb-1.5">Address <span class="text-red-500">*</span></label>
                <textarea name="address" rows="2" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">{{ old('address') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">City <span class="text-red-500">*</span></label>
                <input type="text" name="city" value="{{ old('city') }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">State <span class="text-red-500">*</span></label>
                <input type="text" name="state" value="{{ old('state') }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-xs font-medium t-muted mb-1.5">Installation location (optional)</label>
                <input type="text" name="installation_location" value="{{ old('installation_location') }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
        </div>

        <div class="glass rounded-2xl p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2"><h3 class="text-sm font-semibold t-primary">System &amp; billing</h3></div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">System capacity (kW)</label>
                <input type="number" step="0.1" min="0.1" name="system_capacity_kw" value="{{ old('system_capacity_kw') }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Package (optional)</label>
                <select name="package_selected" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                    <option value="">— none —</option>
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->name }}" @selected(old('package_selected') === $pkg->name)>{{ $pkg->name }} — {{ $pkg->system_size_kw }} kW</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Installation type <span class="text-red-500">*</span></label>
                <select name="installation_type" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                    <option value="domestic" @selected(old('installation_type') === 'domestic')>Domestic</option>
                    <option value="commercial" @selected(old('installation_type') === 'commercial')>Commercial</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Payment method <span class="text-red-500">*</span></label>
                <select name="payment_method" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                    <option value="cash" @selected(old('payment_method') === 'cash')>Cash</option>
                    <option value="loan" @selected(old('payment_method') === 'loan')>Loan</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">Create customer</button>
            <a href="{{ route('admin.customers.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
@endsection
