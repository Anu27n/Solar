@extends('layouts.dashboard')

@section('title', 'Partner Dashboard')
@section('page-title', 'Partner Dashboard')
@section('page-subtitle', 'Performance, pipeline, and payouts at a glance')

@section('sidebar')
    <a href="{{ route('partner.dashboard') }}" class="sidebar-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
        Dashboard
    </a>
    <a href="{{ route('partner.customers.index') }}" class="sidebar-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        My Customers
    </a>
    <a href="{{ route('partner.commissions.index') }}" class="sidebar-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        Commissions
    </a>
@endsection

@section('content')
@php
    $s = fn ($k, $d = 0) => $stats[$k] ?? $d;
    $instStep = function ($status) {
        return match ($status) {
            'registration_completed' => 1,
            'kyc_approved' => 2,
            'loan_approved' => 3,
            'installation_scheduled', 'installation_in_progress' => 4,
            'installation_completed' => 5,
            'installation_rejected' => 0,
            default => 1,
        };
    };
    $instBadge = function ($status) {
        return match ($status) {
            'installation_completed' => ['bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/20', 'Completed'],
            'installation_rejected' => ['bg-red-500/15 text-red-600 dark:text-red-400 border-red-500/20', 'Rejected'],
            'installation_scheduled' => ['bg-sky-500/15 text-sky-600 dark:text-sky-400 border-sky-500/20', 'Scheduled'],
            'installation_in_progress' => ['bg-blue-500/15 text-blue-600 dark:text-blue-400 border-blue-500/20', 'In progress'],
            'loan_approved' => ['bg-violet-500/15 text-violet-600 dark:text-violet-400 border-violet-500/20', 'Loan approved'],
            'kyc_approved' => ['bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/20', 'KYC approved'],
            default => ['bg-slate-500/15 t-secondary border-theme', ucfirst(str_replace('_', ' ', $status))],
        };
    };
@endphp

{{-- Hero cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="glass rounded-2xl relative overflow-hidden p-6 border-theme animate-fade-in">
        <div class="absolute top-0 right-0 w-32 h-32 bg-solar-500/10 rounded-full blur-3xl -translate-y-8 translate-x-8 pointer-events-none"></div>
        <div class="relative">
            <span class="text-[11px] font-semibold t-faint uppercase tracking-wider">Total customers</span>
            <div class="text-4xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $s('total_customers') }}">0</div>
            <div class="mt-4 grid grid-cols-2 gap-3 text-[11px]">
                <div class="rounded-xl bg-input border border-subtle px-3 py-2">
                    <span class="t-muted block mb-0.5">Cash / Loan</span>
                    <span class="t-secondary font-semibold tabular-nums">{{ $s('cash_customers') }} <span class="t-faint font-normal">/</span> {{ $s('loan_customers') }}</span>
                </div>
                <div class="rounded-xl bg-input border border-subtle px-3 py-2">
                    <span class="t-muted block mb-0.5">Domestic / Commercial</span>
                    <span class="t-secondary font-semibold tabular-nums">{{ $s('domestic_customers') }} <span class="t-faint font-normal">/</span> {{ $s('commercial_customers') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl relative overflow-hidden p-6 border-theme animate-fade-in delay-1">
        <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-500/10 rounded-full blur-3xl -translate-y-6 translate-x-6 pointer-events-none"></div>
        <div class="relative">
            <span class="text-[11px] font-semibold t-faint uppercase tracking-wider">Installations</span>
            <div class="text-4xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $s('installations_completed') }}">0</div>
            <p class="text-[11px] t-muted mt-1">Completed</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-lg border border-amber-500/25 bg-amber-500/10 px-2.5 py-1 text-[11px] font-medium text-amber-700 dark:text-amber-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Pending {{ $s('installations_pending') }}
                </span>
                <span class="inline-flex items-center gap-1.5 rounded-lg border border-red-500/25 bg-red-500/10 px-2.5 py-1 text-[11px] font-medium text-red-700 dark:text-red-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                    Rejected {{ $s('installations_rejected') }}
                </span>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl relative overflow-hidden p-6 border-theme animate-fade-in delay-2">
        <div class="absolute top-0 right-0 w-28 h-28 bg-violet-500/10 rounded-full blur-3xl -translate-y-6 translate-x-6 pointer-events-none"></div>
        <div class="relative">
            <span class="text-[11px] font-semibold t-faint uppercase tracking-wider">Commissions</span>
            <div class="text-3xl sm:text-4xl font-bold t-primary mt-2 tabular-nums" data-prefix="₹" data-count="{{ $s('total_commission_paid') }}">₹0</div>
            <p class="text-[11px] t-muted mt-1">Total paid</p>
            <div class="mt-4 rounded-xl bg-input border border-subtle px-3 py-2">
                <span class="text-[11px] t-muted">Pending settlement</span>
                <div class="text-lg font-semibold text-amber-600 dark:text-amber-400 tabular-nums">₹{{ number_format($s('total_commission_pending'), 0) }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Secondary stats: 2×4 --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-8">
    <div class="stat-card animate-fade-in delay-3">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Subsidy OK</span>
        <div class="text-xl font-bold t-primary mt-1.5 tabular-nums" data-count="{{ $s('subsidy_received') }}">0</div>
    </div>
    <div class="stat-card animate-fade-in delay-4">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Subsidy wait</span>
        <div class="text-xl font-bold t-primary mt-1.5 tabular-nums" data-count="{{ $s('subsidy_pending') }}">0</div>
    </div>
    <div class="stat-card animate-fade-in delay-5">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">EMI paid</span>
        <div class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-1.5 tabular-nums" data-count="{{ $s('total_emi_paid') }}">0</div>
    </div>
    <div class="stat-card animate-fade-in delay-6">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">EMI pending</span>
        <div class="text-xl font-bold text-amber-600 dark:text-amber-400 mt-1.5 tabular-nums" data-count="{{ $s('total_emi_pending') }}">0</div>
    </div>
    <div class="stat-card animate-fade-in delay-1">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">KYC pending</span>
        <div class="text-xl font-bold t-primary mt-1.5 tabular-nums" data-count="{{ $s('kyc_pending') }}">0</div>
    </div>
    <div class="stat-card animate-fade-in delay-2">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Commission (month)</span>
        <div class="text-xl font-bold t-primary mt-1.5 tabular-nums" data-prefix="₹" data-count="{{ (float) $monthlyCommission }}">₹0</div>
    </div>
    <div class="stat-card animate-fade-in delay-3">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Commission (year)</span>
        <div class="text-xl font-bold t-primary mt-1.5 tabular-nums" data-prefix="₹" data-count="{{ (float) $yearlyCommission }}">₹0</div>
    </div>
    <div class="stat-card animate-fade-in delay-4">
        <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Domestic / Commercial</span>
        <div class="mt-1.5 flex items-baseline gap-2 flex-wrap">
            <span class="text-lg font-bold t-primary tabular-nums">{{ $s('domestic_customers') }}</span>
            <span class="text-[11px] t-muted">domestic</span>
            <span class="t-faint">·</span>
            <span class="text-lg font-bold t-primary tabular-nums">{{ $s('commercial_customers') }}</span>
            <span class="text-[11px] t-muted">commercial</span>
        </div>
    </div>
</div>

{{-- Installation pipeline --}}
<div class="glass rounded-2xl border-theme overflow-hidden mb-8 animate-fade-in delay-5">
    <div class="px-5 py-4 border-b border-theme flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div>
            <h2 class="text-sm font-semibold t-primary">Installation pipeline</h2>
            <p class="text-[11px] t-muted mt-0.5">Registration → KYC → Loan → Scheduled → Completed</p>
        </div>
        <a href="{{ route('partner.customers.index') }}" class="text-[11px] font-medium text-solar-600 dark:text-solar-400 hover:underline shrink-0">View customers →</a>
    </div>
    <div class="p-5 space-y-5">
        @forelse($installationPipeline as $c)
            @php
                $inst = $c->installation;
                $st = $inst?->status ?? 'registration_completed';
                [$badgeCls, $badgeLabel] = $instBadge($st);
                $step = $instStep($st);
                $labels = ['Registration', 'KYC', 'Loan', 'Scheduled', 'Completed'];
                $isCash = ($c->payment_method ?? '') === 'cash';
            @endphp
            <div class="rounded-xl border border-subtle bg-input/50 p-4">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-4">
                    <div>
                        <div class="font-semibold t-primary">{{ $c->name }}</div>
                        @if($inst?->scheduled_date)
                            <p class="text-[11px] t-muted mt-0.5">
                                Scheduled <span class="t-secondary font-medium">{{ $inst->scheduled_date->format('D, d M Y') }}</span>
                            </p>
                        @endif
                    </div>
                    <span class="inline-flex items-center rounded-lg border px-2.5 py-1 text-[11px] font-semibold w-fit {{ $badgeCls }}">{{ $badgeLabel }}</span>
                </div>
                <div class="grid grid-cols-5 gap-1 sm:gap-2 pt-1">
                    @foreach($labels as $i => $label)
                        @php $n = $i + 1; @endphp
                        <div class="flex flex-col items-center text-center min-w-0">
                                @php
                                    $isLoanCol = $label === 'Loan';
                                    $rejected = $step === 0;
                                    $done = ! $rejected && ($step > $n || ($step >= 5 && $n === 5));
                                    $current = ! $rejected && $step === $n;
                                    if ($isLoanCol && $isCash && ! $rejected) {
                                        if ($step >= 3) {
                                            $done = true;
                                            $current = false;
                                        }
                                    }
                                @endphp
                                <div class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 text-[10px] font-bold shrink-0 mx-auto
                                    @if($rejected)
                                        border-theme bg-[var(--bg-card)] t-faint
                                    @elseif($done)
                                        border-solar-500 bg-solar-500/15 text-solar-700 dark:text-solar-400
                                    @elseif($current)
                                        border-solar-500 bg-solar-500/20 text-solar-800 dark:text-solar-300 ring-2 ring-solar-500/30
                                    @else
                                        border-theme bg-[var(--bg-card)] t-faint
                                    @endif">
                                    @if($isLoanCol && $isCash && ! $rejected)
                                        —
                                    @elseif($done && ! $rejected)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
                                    @else
                                        {{ $n }}
                                    @endif
                                </div>
                                <span class="mt-1.5 text-[9px] sm:text-[10px] font-medium uppercase tracking-wide leading-tight t-muted block">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
                @if($step === 0)
                    <p class="text-[11px] text-red-600 dark:text-red-400 mt-3">Installation was rejected — check notes in the customer record.</p>
                @endif
            </div>
        @empty
            <p class="text-sm t-faint text-center py-8">No active installation records yet. Add a customer to start the pipeline.</p>
        @endforelse
    </div>
</div>

{{-- Recent customers + Commission history --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mb-8">
    <div class="glass rounded-2xl overflow-hidden animate-fade-in delay-6">
        <div class="px-5 py-4 border-b border-theme flex items-center justify-between gap-3">
            <div>
                <h2 class="text-sm font-semibold t-primary">Recent customers</h2>
                <p class="text-[11px] t-muted mt-0.5">Latest leads and accounts</p>
            </div>
            <a href="{{ route('partner.customers.index') }}" class="text-[11px] font-medium text-solar-600 dark:text-solar-400 whitespace-nowrap">View all →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle">
                        <th class="px-5 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Name</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Type</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Payment</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[color:var(--border-subtle)]">
                    @forelse($recentCustomers as $c)
                        @php
                            $typeBadge = $c->installation_type === 'commercial'
                                ? 'bg-violet-500/10 text-violet-600 dark:text-violet-400 border border-violet-500/15'
                                : 'bg-sky-500/10 text-sky-600 dark:text-sky-400 border border-sky-500/15';
                            $payBadge = ($c->payment_method ?? '') === 'loan'
                                ? 'bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-500/20'
                                : 'bg-slate-500/10 t-secondary border border-theme';
                            $stRaw = $c->status ?? '';
                            $statusStyle = match (true) {
                                str_contains($stRaw, 'completed') => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                str_contains($stRaw, 'rejected') => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                            };
                        @endphp
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-5 py-3.5 font-medium t-secondary">{{ $c->name }}</td>
                            <td class="px-4 py-3.5">
                                <span class="text-[11px] px-2 py-0.5 rounded-md font-semibold capitalize {{ $typeBadge }}">{{ $c->installation_type ?? '—' }}</span>
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="text-[11px] px-2 py-0.5 rounded-md font-medium capitalize {{ $payBadge }}">{{ $c->payment_method ?? '—' }}</span>
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="text-[11px] px-2 py-0.5 rounded-md font-medium {{ $statusStyle }}">{{ ucwords(str_replace('_', ' ', $stRaw ?: '—')) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-12 text-center t-faint text-sm">No customers yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="glass rounded-2xl overflow-hidden animate-fade-in delay-5">
        <div class="px-5 py-4 border-b border-theme">
            <h2 class="text-sm font-semibold t-primary">Commission history</h2>
            <p class="text-[11px] t-muted mt-0.5">Latest payouts and accruals</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle">
                        <th class="px-5 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Customer</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Amount</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Status</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[color:var(--border-subtle)]">
                    @forelse($commissions as $row)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-5 py-3.5 t-secondary">{{ $row->customer?->name ?? '—' }}</td>
                            <td class="px-4 py-3.5 font-semibold t-primary tabular-nums">₹{{ number_format($row->amount, 0) }}</td>
                            <td class="px-4 py-3.5">
                                <span class="text-[11px] px-2 py-0.5 rounded-md font-medium {{ ($row->status ?? '') === 'paid' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400' }}">{{ ucfirst($row->status ?? '—') }}</span>
                            </td>
                            <td class="px-4 py-3.5 text-[11px] t-muted whitespace-nowrap">{{ $row->created_at?->format('d M Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-12 text-center t-faint text-sm">No commission records</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Loan + Subsidy tracking --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
    <div class="glass rounded-2xl border-theme overflow-hidden animate-fade-in delay-6">
        <div class="px-5 py-4 border-b border-theme">
            <h2 class="text-sm font-semibold t-primary">Loan tracking</h2>
            <p class="text-[11px] t-muted mt-0.5">EMI progress for financed systems</p>
        </div>
        <div class="p-5 space-y-4">
            @forelse($loanCustomers as $c)
                @php $loan = $c->loan; @endphp
                <div class="rounded-xl border border-subtle bg-input/40 p-4">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                        <div class="font-semibold t-primary">{{ $c->name }}</div>
                        @php
                            $ls = $loan?->status ?? '';
                            $loanBadge = match (true) {
                                in_array($ls, ['approved', 'disbursed'], true) => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                $ls === 'rejected' => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                            };
                        @endphp
                        <span class="text-[11px] px-2 py-0.5 rounded-md font-medium w-fit {{ $loanBadge }}">{{ ucfirst(str_replace('_', ' ', $ls ?: '—')) }}</span>
                    </div>
                    <p class="text-[11px] t-muted mb-2"><span class="t-faint">Bank</span> <span class="t-secondary">{{ $loan?->bank_name ?? '—' }}</span></p>
                    <div class="flex flex-wrap gap-4 text-[11px]">
                        <div>
                            <span class="t-faint block">Loan amount</span>
                            <span class="font-semibold t-primary tabular-nums">₹{{ number_format((float) ($loan?->loan_amount ?? 0), 0) }}</span>
                        </div>
                        <div>
                            <span class="t-faint block">EMI</span>
                            <span class="font-medium t-secondary tabular-nums">
                                {{ (int) ($loan?->emis_paid ?? 0) }} / {{ (int) ($loan?->total_emis ?? 0) }} paid
                            </span>
                        </div>
                        <div>
                            <span class="t-faint block">Per EMI</span>
                            <span class="t-secondary tabular-nums">₹{{ number_format((float) ($loan?->emi_amount ?? 0), 0) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm t-faint text-center py-6">No loan customers yet</p>
            @endforelse
        </div>
    </div>

    <div class="glass rounded-2xl border-theme overflow-hidden animate-fade-in delay-6">
        <div class="px-5 py-4 border-b border-theme">
            <h2 class="text-sm font-semibold t-primary">Subsidy tracking</h2>
            <p class="text-[11px] t-muted mt-0.5">Government subsidy applications</p>
        </div>
        <div class="p-5 space-y-4">
            @forelse($subsidyCustomers as $c)
                @php $sub = $c->subsidy; @endphp
                <div class="rounded-xl border border-subtle bg-input/40 p-4">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <div class="font-semibold t-primary">{{ $c->name }}</div>
                        @php
                            $ss = $sub?->status ?? '';
                            $subBadge = match (true) {
                                $ss === 'received' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                str_contains($ss, 'reject') => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                            };
                        @endphp
                        <span class="text-[11px] px-2 py-0.5 rounded-md font-medium capitalize w-fit {{ $subBadge }}">{{ str_replace('_', ' ', $ss ?: '—') }}</span>
                    </div>
                    <div class="text-[11px] t-muted mb-2">
                        <span class="t-faint">Amount</span>
                        <span class="font-semibold t-primary tabular-nums">₹{{ number_format((float) ($sub?->subsidy_amount ?? 0), 0) }}</span>
                    </div>
                    @if($sub?->status_check_link)
                        <a href="{{ $sub->status_check_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[11px] font-medium text-solar-600 dark:text-solar-400 hover:underline">
                            Check status
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-sm t-faint text-center py-6">No subsidy records yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
