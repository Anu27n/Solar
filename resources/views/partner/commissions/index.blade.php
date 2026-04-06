@extends('layouts.dashboard')

@section('title', 'My Commissions')
@section('page-title', 'My Commissions')

@section('sidebar')
    <a href="{{ route('partner.dashboard') }}" class="sidebar-link {{ request()->routeIs('partner.dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
        Dashboard
    </a>
    <a href="{{ route('partner.customers.index') }}" class="sidebar-link {{ request()->routeIs('partner.customers.*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        My Customers
    </a>
    <a href="{{ route('partner.commissions.index') }}" class="sidebar-link {{ request()->routeIs('partner.commissions.*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        Commissions
    </a>
@endsection

@section('content')
    @php $s = fn($k, $d = 0) => $stats[$k] ?? $d; @endphp

    {{-- Stat cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 mb-6">
        <div class="stat-card animate-fade-in">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Total Earned</span>
            <div class="text-xl font-bold t-primary mt-1.5 tabular-nums">₹{{ number_format($s('total_earned'), 0) }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-1">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Total Paid</span>
            <div class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-1.5 tabular-nums">₹{{ number_format($s('total_paid'), 0) }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-2">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Pending</span>
            <div class="text-xl font-bold text-amber-600 dark:text-amber-400 mt-1.5 tabular-nums">₹{{ number_format($s('pending'), 0) }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-3">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">This Month</span>
            <div class="text-xl font-bold text-blue-600 dark:text-blue-400 mt-1.5 tabular-nums">₹{{ number_format($s('this_month'), 0) }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-4">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">This Year</span>
            <div class="text-xl font-bold text-violet-600 dark:text-violet-400 mt-1.5 tabular-nums">₹{{ number_format($s('this_year'), 0) }}</div>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('partner.commissions.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">
        <select name="type" class="min-w-[200px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
            <option value="">All types</option>
            <option value="per_installation" @selected(request('type') === 'per_installation')>Per Installation</option>
            <option value="monthly" @selected(request('type') === 'monthly')>Monthly</option>
            <option value="yearly" @selected(request('type') === 'yearly')>Yearly</option>
            <option value="bonus" @selected(request('type') === 'bonus')>Bonus</option>
        </select>
        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filter
            </button>
            @if(request('type'))
                <a href="{{ route('partner.commissions.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-medium t-secondary hover:bg-white/10 transition">Reset</a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Customer</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Amount</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Type</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Status</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[color:var(--border-subtle)]">
                    @php
                        $typeBadge = fn(?string $type): string => match($type) {
                            'per_installation' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                            'monthly'          => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400',
                            'yearly'           => 'bg-violet-500/10 text-violet-600 dark:text-violet-400',
                            'bonus'            => 'bg-pink-500/10 text-pink-600 dark:text-pink-400',
                            default            => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
                        };
                    @endphp
                    @forelse($commissions as $commission)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-5 py-3 font-medium t-primary">{{ $commission->customer?->name ?? '—' }}</td>
                            <td class="px-4 py-3 font-semibold t-secondary tabular-nums">₹{{ number_format($commission->amount, 0) }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize {{ $typeBadge($commission->type) }}">
                                    {{ str_replace('_', ' ', $commission->type ?? '—') }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $commission->status === 'paid' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400' }}">
                                    {{ ucfirst($commission->status ?? '—') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 t-muted">{{ $commission->created_at?->format('d M Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center t-faint">No commission records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($commissions->hasPages())
            <div class="border-t border-subtle px-5 py-4">
                {{ $commissions->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
