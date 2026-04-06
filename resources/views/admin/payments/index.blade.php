@extends('layouts.dashboard')

@section('title', 'Payment Records')
@section('page-title', 'Payment Records')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    @php
        $statusBadge = fn(string $status): string => match($status) {
            'completed' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'pending'   => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
            'failed'    => 'bg-red-500/10 text-red-600 dark:text-red-400',
            'refunded'  => 'bg-violet-500/10 text-violet-600 dark:text-violet-400',
            default     => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
        };

        $methodBadge = fn(?string $method): string => match($method) {
            'razorpay' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
            'upi'      => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400',
            'cash'     => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'bank'     => 'bg-cyan-500/10 text-cyan-600 dark:text-cyan-400',
            default    => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
        };
    @endphp

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="stat-card animate-fade-in">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Total Revenue</span>
            <div class="text-2xl font-bold t-primary mt-1.5 tabular-nums">₹{{ number_format($totals['total'] ?? 0, 0) }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-1">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Pending</span>
            <div class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-1.5 tabular-nums">₹{{ number_format($totals['pending'] ?? 0, 0) }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-2">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Today</span>
            <div class="text-2xl font-bold text-solar-600 dark:text-solar-400 mt-1.5 tabular-nums">₹{{ number_format($totals['today'] ?? 0, 0) }}</div>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.payments.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
        <div class="relative flex-1 min-w-[200px]">
            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center t-faint">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search customer, transaction ID…" class="w-full rounded-xl border border-theme bg-input py-2.5 pl-10 pr-4 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
        </div>
        <select name="status" class="min-w-[160px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
            <option value="">All statuses</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="completed" @selected(request('status') === 'completed')>Completed</option>
            <option value="failed" @selected(request('status') === 'failed')>Failed</option>
            <option value="refunded" @selected(request('status') === 'refunded')>Refunded</option>
        </select>
        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-medium t-secondary hover:bg-white/10 transition">Reset</a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Customer</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Amount</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Method</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Status</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Transaction ID</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-4 py-3 font-medium t-primary">{{ $payment->customer?->name ?? '—' }}</td>
                            <td class="px-4 py-3 font-semibold t-secondary tabular-nums">₹{{ number_format($payment->amount, 0) }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize {{ $methodBadge($payment->method) }}">
                                    {{ $payment->method ?? '—' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize {{ $statusBadge($payment->status) }}">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 t-muted font-mono text-xs">{{ $payment->transaction_id ?? '—' }}</td>
                            <td class="px-4 py-3 t-muted">{{ $payment->created_at?->format('d M Y, h:i A') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center t-faint">No payment records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
            <div class="border-t border-subtle px-4 py-4">
                {{ $payments->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
