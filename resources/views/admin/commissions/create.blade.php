@extends('layouts.dashboard')

@section('title', 'Create Commission')
@section('page-title', 'Create Commission')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.commissions.store') }}" class="space-y-6 glass rounded-2xl p-6 sm:p-8">
            @csrf

            <div>
                <label for="channel_partner_id" class="block text-xs font-medium t-muted mb-1.5">Channel Partner</label>
                <select name="channel_partner_id" id="channel_partner_id" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="">Select partner</option>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}" @selected(old('channel_partner_id') == $partner->id)>{{ $partner->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="customer_id" class="block text-xs font-medium t-muted mb-1.5">Customer</label>
                <select name="customer_id" id="customer_id" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="">Select customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="amount" class="block text-xs font-medium t-muted mb-1.5">Amount (₹)</label>
                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" min="0" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="type" class="block text-xs font-medium t-muted mb-1.5">Type</label>
                <select name="type" id="type" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="per_installation" @selected(old('type') === 'per_installation')>Per Installation</option>
                    <option value="monthly" @selected(old('type') === 'monthly')>Monthly</option>
                    <option value="yearly" @selected(old('type') === 'yearly')>Yearly</option>
                    <option value="bonus" @selected(old('type') === 'bonus')>Bonus</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-xs font-medium t-muted mb-1.5">Status</label>
                <select name="status" id="status" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="pending" @selected(old('status', 'pending') === 'pending')>Pending</option>
                    <option value="approved" @selected(old('status') === 'approved')>Approved</option>
                    <option value="paid" @selected(old('status') === 'paid')>Paid</option>
                </select>
            </div>

            <div>
                <label for="period_month" class="block text-xs font-medium t-muted mb-1.5">Period Month</label>
                <input type="date" name="period_month" id="period_month" value="{{ old('period_month') }}"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="notes" class="block text-xs font-medium t-muted mb-1.5">Notes</label>
                <textarea name="notes" id="notes" rows="4"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">{{ old('notes') }}</textarea>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-600 transition">
                    Create Commission
                </button>
                <a href="{{ route('admin.commissions.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
