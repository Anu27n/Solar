@extends('layouts.dashboard')

@section('title', 'Commission Management')
@section('page-title', 'Commission Management')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('header-actions')
    <a href="{{ route('admin.commissions.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 transition hover:bg-solar-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Create Commission
    </a>
@endsection

@section('content')
    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="stat-card animate-fade-in">
            <div class="flex items-center gap-2 mb-2.5">
                <div class="p-2 bg-violet-500/20 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <span class="text-[11px] font-medium t-muted uppercase tracking-wider">Total</span>
            </div>
            <div class="text-2xl font-bold t-primary tabular-nums">₹{{ number_format($totals['total'] ?? 0, 2) }}</div>
        </div>

        <div class="stat-card animate-fade-in delay-1">
            <div class="flex items-center gap-2 mb-2.5">
                <div class="p-2 bg-emerald-500/20 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <span class="text-[11px] font-medium t-muted uppercase tracking-wider">Paid</span>
            </div>
            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 tabular-nums">₹{{ number_format($totals['paid'] ?? 0, 2) }}</div>
        </div>

        <div class="stat-card animate-fade-in delay-2">
            <div class="flex items-center gap-2 mb-2.5">
                <div class="p-2 bg-amber-500/20 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </div>
                <span class="text-[11px] font-medium t-muted uppercase tracking-wider">Pending</span>
            </div>
            <div class="text-2xl font-bold text-amber-600 dark:text-amber-400 tabular-nums">₹{{ number_format($totals['pending'] ?? 0, 2) }}</div>
        </div>

        <div class="stat-card animate-fade-in delay-3">
            <div class="flex items-center gap-2 mb-2.5">
                <div class="p-2 bg-blue-500/20 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <span class="text-[11px] font-medium t-muted uppercase tracking-wider">Approved</span>
            </div>
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 tabular-nums">₹{{ number_format($totals['approved'] ?? 0, 2) }}</div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.commissions.index') }}" class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
            <select name="partner_id" class="min-w-[180px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                <option value="">All Partners</option>
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" @selected(request('partner_id') == $partner->id)>{{ $partner->name }}</option>
                @endforeach
            </select>

            <select name="status" class="min-w-[160px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                <option value="">All Statuses</option>
                <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                <option value="approved" @selected(request('status') === 'approved')>Approved</option>
                <option value="paid" @selected(request('status') === 'paid')>Paid</option>
            </select>

            <input type="month" name="month" value="{{ request('month') }}"
                class="min-w-[160px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">

            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filter
                </button>
                @if(request()->hasAny(['partner_id', 'status', 'month']))
                    <a href="{{ route('admin.commissions.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-medium t-secondary hover:bg-white/10">Reset</a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-6 py-4">Partner</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @php
                        $typeBadge = fn(string $type) => match($type) {
                            'per_installation' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                            'monthly'          => 'bg-violet-500/10 text-violet-600 dark:text-violet-400',
                            'yearly'           => 'bg-cyan-500/10 text-cyan-600 dark:text-cyan-400',
                            'bonus'            => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                            default            => 'bg-white/5 t-muted',
                        };
                        $statusBadge = fn(string $status) => match($status) {
                            'paid'     => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                            'approved' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                            'pending'  => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                            default    => 'bg-white/5 t-muted',
                        };
                    @endphp

                    @forelse($commissions as $commission)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-6 py-4 font-medium t-primary">{{ $commission->channelPartner->name ?? '—' }}</td>
                            <td class="px-6 py-4 t-secondary">{{ $commission->customer->name ?? '—' }}</td>
                            <td class="px-6 py-4 t-secondary tabular-nums">₹{{ number_format($commission->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-medium {{ $typeBadge($commission->type) }}">
                                    {{ ucwords(str_replace('_', ' ', $commission->type)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-semibold {{ $statusBadge($commission->status) }}">
                                    {{ ucfirst($commission->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 t-muted tabular-nums">{{ $commission->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                @if($commission->status !== 'paid')
                                    <form method="POST" action="{{ route('admin.commissions.pay', $commission) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:bg-white/10 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            Mark Paid
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center t-faint">No commissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($commissions->hasPages())
        <div class="mt-6 border-t border-subtle pt-6 flex flex-wrap items-center justify-center gap-2 sm:justify-end">
            {{ $commissions->withQueryString()->links() }}
        </div>
    @endif
@endsection
