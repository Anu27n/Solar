@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . auth()->user()->name)

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
@php
    $s = fn($k, $d = 0) => $stats[$k] ?? $d;
    $notifList = $notifications ?? [];
    $notifCount = count($notifList);
    $cr = $commissionRule ?? ['type' => 'percentage', 'value' => '0'];
    $commissionLine = ($cr['type'] === 'fixed' || $cr['type'] === 'Fixed')
        ? 'Commission: fixed — ₹' . number_format((float) $cr['value'], 0)
        : 'Commission: percentage — ' . e($cr['value']) . '%';
@endphp

<div class="space-y-8">
    {{-- 1. Hero summary --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="relative overflow-hidden rounded-2xl p-6 bg-gradient-to-br from-solar-500/20 via-solar-600/10 to-transparent border border-solar-500/20 animate-fade-in gradient-border">
            <div class="absolute top-0 right-0 w-36 h-36 bg-solar-500/10 rounded-full blur-3xl -translate-y-10 translate-x-10 pointer-events-none"></div>
            <div class="relative">
                <div class="flex items-center gap-2 mb-4">
                    <div class="p-2 rounded-xl bg-input border border-subtle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-solar-500"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <span class="text-[11px] font-semibold t-muted uppercase tracking-wider">Total customers</span>
                </div>
                <div class="text-4xl sm:text-5xl font-bold t-primary tracking-tight tabular-nums leading-none" data-count="{{ $s('total_customers') }}">0</div>
                <div class="flex flex-wrap gap-x-6 gap-y-2 mt-5 pt-4 border-t border-subtle">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                        <span class="text-[12px] t-muted">Domestic <span class="t-secondary font-semibold tabular-nums">{{ $s('domestic_customers') }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-violet-400"></span>
                        <span class="text-[12px] t-muted">Commercial <span class="t-secondary font-semibold tabular-nums">{{ $s('commercial_customers') }}</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl p-6 bg-gradient-to-br from-emerald-500/15 via-emerald-600/5 to-transparent border border-emerald-500/20 animate-fade-in delay-1">
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl translate-y-8 -translate-x-8 pointer-events-none"></div>
            <div class="relative">
                <div class="flex items-center gap-2 mb-4">
                    <div class="p-2 rounded-xl bg-input border border-subtle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-500"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <span class="text-[11px] font-semibold t-muted uppercase tracking-wider">Installations</span>
                </div>
                <div class="text-4xl sm:text-5xl font-bold t-primary tracking-tight tabular-nums leading-none" data-count="{{ $s('installations_completed') }}">0</div>
                <p class="text-[12px] t-faint mt-1">Completed</p>
                <div class="flex flex-wrap gap-x-6 gap-y-2 mt-4 pt-4 border-t border-subtle">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        <span class="text-[12px] t-muted">Pending <span class="text-amber-600 dark:text-amber-400 font-semibold tabular-nums">{{ $s('installations_pending') }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                        <span class="text-[12px] t-muted">Rejected <span class="text-red-600 dark:text-red-400 font-semibold tabular-nums">{{ $s('installations_rejected') }}</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl p-6 bg-gradient-to-br from-violet-500/15 via-violet-600/5 to-transparent border border-violet-500/20 animate-fade-in delay-2">
            <div class="absolute top-1/2 left-1/2 w-40 h-40 bg-violet-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
            <div class="relative">
                <div class="flex items-center gap-2 mb-4">
                    <div class="p-2 rounded-xl bg-input border border-subtle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-violet-500"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <span class="text-[11px] font-semibold t-muted uppercase tracking-wider">Revenue</span>
                </div>
                <div class="text-4xl sm:text-5xl font-bold t-primary tracking-tight tabular-nums leading-none" data-prefix="₹" data-count="{{ $s('total_revenue') }}" data-decimals="0">0</div>
                <div class="flex flex-wrap gap-x-6 gap-y-2 mt-5 pt-4 border-t border-subtle">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        <span class="text-[12px] t-muted">Cash <span class="t-secondary font-semibold tabular-nums">{{ $s('cash_customers') }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                        <span class="text-[12px] t-muted">Loan <span class="t-secondary font-semibold tabular-nums">{{ $s('loan_customers') }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Secondary stats --}}
    @php
        $miniStats = [
            ['label' => 'Partners', 'key' => 'total_channel_partners', 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/>', 'd' => 3],
            ['label' => 'Employees', 'key' => 'total_employees', 'icon' => '<circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 1 0-16 0"/>', 'd' => 3],
            ['label' => 'Loan cases', 'key' => 'total_loan_cases', 'icon' => '<rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/>', 'd' => 4],
            ['label' => 'EMI pending', 'key' => 'emi_pending', 'icon' => '<rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/>', 'd' => 4],
            ['label' => 'Subsidy OK', 'key' => 'subsidy_received', 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>', 'd' => 5],
            ['label' => 'Subsidy wait', 'key' => 'subsidy_pending', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>', 'd' => 5],
            ['label' => 'KYC pending', 'key' => 'kyc_pending_count', 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m16 11 2 2 4-4"/>', 'd' => 6],
            ['label' => 'Pending tasks', 'key' => 'pending_tasks', 'icon' => '<path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>', 'd' => 6],
        ];
        $delayClass = [3 => 'delay-3', 4 => 'delay-4', 5 => 'delay-5', 6 => 'delay-6'];
    @endphp
    <div class="grid grid-cols-2 sm:grid-cols-4 xl:grid-cols-8 gap-3">
        @foreach($miniStats as $m)
            <div class="stat-card animate-fade-in {{ $delayClass[$m['d']] ?? 'delay-3' }}">
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="t-muted shrink-0">{!! $m['icon'] !!}</svg>
                    <span class="text-[10px] font-medium t-muted uppercase tracking-wider leading-tight">{{ $m['label'] }}</span>
                </div>
                <div class="text-xl font-bold t-primary tabular-nums" data-count="{{ $s($m['key']) }}">0</div>
            </div>
        @endforeach
    </div>

    {{-- 3. Notifications --}}
    <div class="glass rounded-2xl overflow-hidden animate-fade-in delay-3" x-data="{ showAll: false }">
        <div class="px-5 py-4 border-b border-theme flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="p-2 rounded-xl bg-amber-500/10 border border-amber-500/15 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-600 dark:text-amber-400"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-semibold t-primary">Action required</h2>
                    <p class="text-[11px] t-faint mt-0.5 hidden sm:block">Items that need a decision or follow-up</p>
                </div>
            </div>
            @if($notifCount > 0)
                <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-amber-500/15 text-amber-600 dark:text-amber-400 tabular-nums shrink-0">{{ $notifCount }}</span>
            @endif
        </div>

        @if($notifCount === 0)
            <div class="px-5 py-14 text-center">
                <div class="inline-flex flex-col items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-500/10 border border-emerald-500/15 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-500"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <p class="text-sm t-muted">All clear — nothing needs your attention right now.</p>
                </div>
            </div>
        @else
            <div class="divide-y divide-[var(--border-subtle)]">
                @foreach($notifList as $ni => $notif)
                    <a href="{{ $notif['link'] }}"
                       class="flex items-start gap-3 px-5 py-3.5 hover:bg-[var(--bg-card-hover)] transition-colors group"
                       x-show="showAll || {{ $ni < 8 ? 'true' : 'false' }}"
                       @if($ni >= 8) x-cloak @endif>
                        @php
                            $iconKey = $notif['icon'] ?? '';
                            $tone = match($notif['type'] ?? 'info') {
                                'alert' => 'bg-red-500/10 text-red-600 dark:text-red-400 border-red-500/15',
                                'warning' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/15',
                                default => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/15',
                            };
                        @endphp
                        <div class="w-9 h-9 rounded-xl flex-shrink-0 flex items-center justify-center border {{ $tone }}">
                            @if($iconKey === 'kyc')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m16 11 2 2 4-4"/></svg>
                            @elseif($iconKey === 'emi')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
                            @elseif($iconKey === 'install')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                            @elseif($iconKey === 'loan')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            @elseif($iconKey === 'subsidy')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/><path d="m7 10 3-3 3 3"/><path d="m17 14-3 3-3-3"/></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1 pt-0.5">
                            <div class="text-sm font-medium t-secondary group-hover:text-[var(--text-primary)] transition-colors">{{ $notif['title'] }}</div>
                            <div class="text-[11px] t-muted mt-0.5 leading-relaxed">{{ $notif['detail'] }}</div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="t-faint shrink-0 mt-1 opacity-0 group-hover:opacity-100 transition-opacity"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                @endforeach
            </div>
            @if($notifCount > 8)
                <div class="px-5 py-3 border-t border-subtle bg-input/30 text-center">
                    <button type="button" @click="showAll = !showAll" class="text-[11px] font-medium text-solar-600 dark:text-solar-400 hover:text-solar-500 transition-colors">
                        <span x-show="!showAll">Show all {{ $notifCount }} notifications</span>
                        <span x-show="showAll" x-cloak>Show less</span>
                    </button>
                </div>
            @endif
        @endif
    </div>

    {{-- 4. Pending approvals + Recent customers --}}
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-5">
        <div class="xl:col-span-2 glass rounded-2xl overflow-hidden animate-fade-in delay-4">
            <div class="px-5 py-4 border-b border-theme flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    <h2 class="text-sm font-semibold t-primary">Pending approvals</h2>
                </div>
                <span class="text-[10px] font-medium t-faint uppercase tracking-wider">Queue</span>
            </div>

            <div class="divide-y divide-[var(--border-subtle)] max-h-[520px] overflow-y-auto">
                <div class="p-4">
                    <h3 class="text-[10px] font-semibold t-faint uppercase tracking-widest mb-3">KYC reviews</h3>
                    @forelse(($pendingKyc ?? collect()) as $kyc)
                        <div class="flex items-center justify-between py-2.5 first:pt-0 last:pb-0">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-xl bg-input border border-subtle flex items-center justify-center text-[11px] font-bold t-secondary shrink-0">{{ strtoupper(mb_substr($kyc->name ?? '?', 0, 1)) }}</div>
                                <span class="text-sm font-medium t-secondary truncate">{{ $kyc->name ?? '—' }}</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-lg bg-amber-500/10 text-amber-700 dark:text-amber-400 font-medium shrink-0">Pending</span>
                        </div>
                    @empty
                        <p class="text-xs t-faint py-6 text-center">No pending KYC</p>
                    @endforelse
                </div>

                <div class="p-4">
                    <h3 class="text-[10px] font-semibold t-faint uppercase tracking-widest mb-3">Installations</h3>
                    @forelse(($pendingInstallations ?? collect()) as $inst)
                        <div class="flex items-center justify-between py-2.5 first:pt-0 last:pb-0 gap-2">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-xl bg-input border border-subtle flex items-center justify-center text-[11px] font-bold text-blue-600 dark:text-blue-400 shrink-0">{{ strtoupper(mb_substr($inst->customer->name ?? '?', 0, 1)) }}</div>
                                <span class="text-sm font-medium t-secondary truncate">{{ $inst->customer->name ?? '—' }}</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-lg bg-blue-500/10 text-blue-700 dark:text-blue-400 font-medium shrink-0">{{ ucwords(str_replace('_', ' ', $inst->status)) }}</span>
                        </div>
                    @empty
                        <p class="text-xs t-faint py-6 text-center">No pending installations</p>
                    @endforelse
                </div>

                <div class="p-4">
                    <h3 class="text-[10px] font-semibold t-faint uppercase tracking-widest mb-3">Loan applications</h3>
                    @forelse(($pendingLoans ?? collect()) as $loan)
                        <div class="flex items-start justify-between gap-3 py-2.5 first:pt-0 last:pb-0">
                            <div class="flex items-start gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-xl bg-input border border-subtle flex items-center justify-center text-[11px] font-bold text-violet-600 dark:text-violet-400 shrink-0">{{ strtoupper(mb_substr($loan->customer->name ?? '?', 0, 1)) }}</div>
                                <div class="min-w-0">
                                    <span class="text-sm font-medium t-secondary block truncate">{{ $loan->customer->name ?? '—' }}</span>
                                    <span class="text-[11px] t-faint truncate block">{{ $loan->bank_name ?? '—' }}</span>
                                </div>
                            </div>
                            <span class="text-xs font-semibold t-primary tabular-nums shrink-0">₹{{ number_format($loan->loan_amount ?? 0) }}</span>
                        </div>
                    @empty
                        <p class="text-xs t-faint py-6 text-center">No pending loans</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="xl:col-span-3 glass rounded-2xl overflow-hidden animate-fade-in delay-5">
            <div class="px-5 py-4 border-b border-theme flex items-center justify-between">
                <h2 class="text-sm font-semibold t-primary">Recent customers</h2>
                <a href="{{ route('admin.customers.index') }}" class="text-[11px] font-medium text-solar-600 dark:text-solar-400 hover:text-solar-500 transition-colors">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[640px]">
                    <thead>
                        <tr class="border-b border-subtle bg-input/40">
                            <th class="px-5 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-wider">Customer</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-wider">Payment</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-wider">Partner</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-subtle)]">
                        @forelse(($recentCustomers ?? collect()) as $c)
                            <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                                <td class="px-5 py-3.5 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-solar-500/15 to-transparent border border-solar-500/20 flex items-center justify-center text-[12px] font-bold text-solar-600 dark:text-solar-400 shrink-0">
                                            {{ strtoupper(mb_substr($c->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-medium t-secondary truncate max-w-[180px]">{{ $c->name }}</div>
                                            <div class="text-[11px] t-faint tabular-nums">{{ $c->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="text-[11px] px-2 py-0.5 rounded-lg font-medium {{ ($c->installation_type ?? '') === 'commercial' ? 'bg-violet-500/10 text-violet-700 dark:text-violet-400' : 'bg-blue-500/10 text-blue-700 dark:text-blue-400' }}">
                                        {{ ucfirst($c->installation_type ?? '—') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap text-xs t-secondary capitalize">{{ $c->payment_method ?? '—' }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @php
                                        $st = strtolower((string) ($c->status ?? ''));
                                        $sc = match(true) {
                                            str_contains($st, 'completed') => 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-400',
                                            str_contains($st, 'rejected') => 'bg-red-500/10 text-red-700 dark:text-red-400',
                                            str_contains($st, 'approved') => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
                                            default => 'bg-amber-500/10 text-amber-700 dark:text-amber-400',
                                        };
                                    @endphp
                                    <span class="text-[11px] px-2 py-0.5 rounded-lg font-medium {{ $sc }}">{{ ucwords(str_replace('_', ' ', $c->status ?? '')) }}</span>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap text-xs t-muted truncate max-w-[140px]">{{ $c->channelPartner->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-16 text-center">
                                    <p class="text-sm t-muted">No customers yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 5. Recent payments + Commission --}}
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-5">
        <div class="xl:col-span-2 glass rounded-2xl overflow-hidden animate-fade-in delay-6">
            <div class="px-5 py-4 border-b border-theme flex items-center justify-between">
                <h2 class="text-sm font-semibold t-primary">Recent payments</h2>
                <a href="{{ route('admin.payments.index') }}" class="text-[11px] font-medium text-solar-600 dark:text-solar-400 hover:text-solar-500 transition-colors">View all</a>
            </div>
            <div class="divide-y divide-[var(--border-subtle)]">
                @forelse(($recentPayments ?? collect()) as $pay)
                    @php
                        $pst = strtolower((string) ($pay->status ?? ''));
                        $pBadge = match(true) {
                            $pst === 'completed' || str_contains($pst, 'complete') => 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-400',
                            str_contains($pst, 'fail') || str_contains($pst, 'reject') => 'bg-red-500/10 text-red-700 dark:text-red-400',
                            str_contains($pst, 'pend') => 'bg-amber-500/10 text-amber-700 dark:text-amber-400',
                            default => 'bg-slate-500/10 t-secondary',
                        };
                    @endphp
                    <div class="px-5 py-3.5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="min-w-0">
                            <div class="text-sm font-medium t-secondary truncate">{{ $pay->customer->name ?? '—' }}</div>
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1">
                                <span class="text-[11px] t-faint tabular-nums">{{ $pay->created_at?->format('d M Y') ?? '—' }}</span>
                                <span class="text-[11px] t-muted capitalize">{{ $pay->method ?? '—' }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-sm font-semibold t-primary tabular-nums">₹{{ number_format((float) $pay->amount, 0) }}</span>
                            <span class="text-[10px] px-2 py-0.5 rounded-lg font-medium {{ $pBadge }}">{{ ucfirst($pay->status ?? '—') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-14 text-center text-sm t-muted">No payments recorded yet</div>
                @endforelse
            </div>
        </div>

        <div class="xl:col-span-3 glass rounded-2xl overflow-hidden animate-fade-in delay-6">
            <div class="px-5 py-4 border-b border-theme flex items-center justify-between">
                <h2 class="text-sm font-semibold t-primary">Commission rules</h2>
                <a href="{{ route('admin.settings.index') }}" class="text-[11px] font-medium text-solar-600 dark:text-solar-400 hover:text-solar-500 transition-colors">Configure</a>
            </div>
            <div class="p-5 space-y-6">
                <div class="rounded-xl border border-subtle bg-input/50 px-4 py-3">
                    <p class="text-[10px] font-semibold t-faint uppercase tracking-widest mb-1">Current rule</p>
                    <p class="text-sm font-medium t-primary">{{ $commissionLine }}</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-xl border border-theme p-4">
                        <p class="text-[11px] t-muted uppercase tracking-wider mb-1">Paid out</p>
                        <p class="text-2xl font-bold t-primary tabular-nums">₹{{ number_format((float) $s('total_commissions_paid'), 0) }}</p>
                    </div>
                    <div class="rounded-xl border border-theme p-4">
                        <p class="text-[11px] t-muted uppercase tracking-wider mb-1">Pending</p>
                        <p class="text-2xl font-bold t-primary tabular-nums">₹{{ number_format((float) $s('total_commissions_pending'), 0) }}</p>
                    </div>
                </div>
                <p class="text-[11px] t-faint leading-relaxed">Partner commissions use this rule for new calculations. Update values in settings anytime.</p>
            </div>
        </div>
    </div>
</div>
@endsection
