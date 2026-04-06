@extends('layouts.dashboard')

@section('title', 'Customer Detail')
@section('page-title', $customer->name)
@section('page-subtitle', $customer->phone . ($customer->email ? ' · ' . $customer->email : ''))

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    @php
        $statusBadge = function (string $status): string {
            if ($status === 'installation_completed') return 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400';
            if (str_ends_with($status, '_rejected')) return 'bg-red-500/10 text-red-600 dark:text-red-400';
            if (in_array($status, ['kyc_approved', 'loan_approved'], true)) return 'bg-blue-500/10 text-blue-600 dark:text-blue-400';
            return 'bg-amber-500/10 text-amber-600 dark:text-amber-400';
        };

        $kycBadge = fn(string $s) => match ($s) {
            'approved' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'rejected' => 'bg-red-500/10 text-red-600 dark:text-red-400',
            default    => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
        };

        $loanStatusBadge = fn(string $s) => match ($s) {
            'approved', 'disbursed' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'rejected'              => 'bg-red-500/10 text-red-600 dark:text-red-400',
            default                 => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
        };

        $instStatusBadge = fn(string $s) => match (true) {
            str_contains($s, 'completed') => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            str_contains($s, 'rejected')  => 'bg-red-500/10 text-red-600 dark:text-red-400',
            str_contains($s, 'progress')  => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
            default                       => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
        };

        $subsidyStatusBadge = fn(string $s) => match ($s) {
            'approved', 'received' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'rejected'             => 'bg-red-500/10 text-red-600 dark:text-red-400',
            default                => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
        };

        $paymentBadge = fn(string $s) => match ($s) {
            'completed', 'verified' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'failed'                => 'bg-red-500/10 text-red-600 dark:text-red-400',
            default                 => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
        };

        $inst    = $customer->installation;
        $loan    = $customer->loan;
        $subsidy = $customer->subsidy;
    @endphp

    {{-- ═══ HEADER ═══ --}}
    <div class="mb-6 animate-fade-in">
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold t-muted hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to customers
            </a>
        </div>

        <div class="mt-4 glass rounded-2xl p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-solar-500/20 to-solar-600/10 border border-solar-500/20">
                        <span class="text-lg font-bold text-solar-400">{{ strtoupper(substr($customer->name, 0, 2)) }}</span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold t-primary">{{ $customer->name }}</h2>
                        <div class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm t-secondary">
                            <span class="inline-flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                {{ $customer->phone }}
                            </span>
                            @if($customer->email)
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    {{ $customer->email }}
                                </span>
                            @endif
                        </div>
                        <div class="mt-1 text-xs t-muted">{{ $customer->address }}, {{ $customer->city }}, {{ $customer->state }}</div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    @if($customer->installation_type === 'commercial')
                        <span class="inline-flex rounded-full bg-violet-500/10 px-2.5 py-0.5 text-xs font-semibold text-violet-600 dark:text-violet-400">Commercial</span>
                    @else
                        <span class="inline-flex rounded-full bg-sky-500/10 px-2.5 py-0.5 text-xs font-semibold text-sky-400">Domestic</span>
                    @endif

                    @if($customer->payment_method === 'loan')
                        <span class="inline-flex rounded-full bg-indigo-500/10 px-2.5 py-0.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400">Loan</span>
                    @else
                        <span class="inline-flex rounded-full bg-emerald-500/10 px-2.5 py-0.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400">Cash</span>
                    @endif

                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusBadge($customer->status) }}">
                        {{ str_replace('_', ' ', ucwords($customer->status, '_')) }}
                    </span>
                </div>
            </div>

            @if($customer->system_capacity_kw || $customer->channelPartner)
                <div class="mt-4 flex flex-wrap items-center gap-4 border-t border-subtle pt-4">
                    @if($customer->system_capacity_kw)
                        <div class="text-xs t-muted">
                            <span class="font-semibold t-faint uppercase tracking-widest">Capacity</span>
                            <span class="ml-1 t-secondary">{{ number_format((float)$customer->system_capacity_kw, 2) }} kW</span>
                        </div>
                    @endif
                    @if($customer->channelPartner)
                        <div class="text-xs t-muted">
                            <span class="font-semibold t-faint uppercase tracking-widest">Channel Partner</span>
                            <span class="ml-1 t-secondary">{{ $customer->channelPartner->name }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="space-y-6">

        {{-- ═══ KYC DOCUMENTS ═══ --}}
        <div class="glass rounded-2xl p-6 animate-fade-in delay-1">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold t-primary">KYC Documents</h2>
                    <p class="mt-1 text-sm t-muted">Review and verify uploaded documents</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white/5 t-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                </span>
            </div>

            <ul class="mt-6 divide-y divide-[var(--border-subtle)]">
                @forelse($customer->kycDocuments as $kyc)
                    <li class="flex flex-col gap-4 py-4 first:pt-0 last:pb-0 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <div class="font-semibold t-primary text-sm">{{ $kyc->document_label }}</div>
                            <div class="mt-0.5 text-xs t-muted">Uploaded {{ $kyc->created_at->format('M j, Y') }}</div>
                            @if($kyc->status === 'rejected' && $kyc->rejection_reason)
                                <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $kyc->rejection_reason }}</p>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $kycBadge($kyc->status) }}">{{ ucfirst($kyc->status) }}</span>
                            @if($kyc->status === 'pending')
                                <form method="POST" action="{{ route('admin.kyc.approve', $kyc) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-solar-500 px-3 py-1.5 text-xs font-semibold text-dark-900 hover:bg-solar-400 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.kyc.reject', $kyc) }}" class="inline-flex flex-wrap items-center gap-2">
                                    @csrf
                                    <input type="text" name="rejection_reason" required placeholder="Reason" class="w-40 rounded-xl border border-theme bg-input px-2 py-1.5 text-xs t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-red-500/80 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-500 transition-colors">Reject</button>
                                </form>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm t-muted">No KYC documents uploaded yet.</li>
                @endforelse
            </ul>
        </div>

        {{-- ═══ LOAN MANAGEMENT ═══ --}}
        <div class="glass rounded-2xl p-6 animate-fade-in delay-2">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold t-primary">Loan Management</h2>
                    <p class="mt-1 text-sm t-muted">{{ $loan ? 'Financing details and EMI progress' : 'No loan record — create one below' }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @if($loan)
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $loanStatusBadge($loan->status) }}">{{ ucfirst(str_replace('_', ' ', $loan->status)) }}</span>
                    @endif
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </span>
                </div>
            </div>

            @if($loan)
                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2 flex justify-between gap-4 border-b border-subtle pb-3">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Bank</dt>
                        <dd class="text-sm t-secondary text-right">{{ $loan->bank_name }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Down Payment</dt>
                        <dd class="text-sm t-secondary text-right">₹{{ number_format((float)$loan->down_payment, 2) }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Loan Amount</dt>
                        <dd class="text-sm t-secondary text-right">₹{{ number_format((float)$loan->loan_amount, 2) }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">EMI Amount</dt>
                        <dd class="text-sm t-secondary text-right">₹{{ number_format((float)$loan->emi_amount, 2) }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Total EMIs</dt>
                        <dd class="text-sm t-secondary text-right">{{ $loan->total_emis }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">EMIs Paid</dt>
                        <dd class="text-sm t-secondary text-right">{{ $loan->emis_paid }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">EMIs Pending</dt>
                        <dd class="text-sm t-secondary text-right">{{ $loan->emis_pending }}</dd>
                    </div>
                    @if($loan->notes)
                        <div class="sm:col-span-2 border-t border-subtle pt-3">
                            <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Notes</dt>
                            <dd class="mt-1 text-sm t-secondary">{{ $loan->notes }}</dd>
                        </div>
                    @endif
                </dl>
            @endif

            <div class="mt-6 border-t border-subtle pt-4">
                <button type="button" onclick="toggleSection('loan-form')" class="inline-flex items-center gap-2 rounded-xl border border-theme px-4 py-2 text-sm font-semibold t-secondary hover:bg-white/5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                    {{ $loan ? 'Edit Loan' : 'Add Loan' }}
                </button>

                <div id="loan-form" class="hidden mt-4">
                    <form method="POST" action="{{ $loan ? route('admin.loan.update', $loan) : route('admin.loan.store', $customer) }}" class="rounded-xl border border-theme bg-surface p-5 space-y-4">
                        @csrf
                        @if($loan) @method('PUT') @endif

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Bank Name</label>
                                <input type="text" name="bank_name" value="{{ old('bank_name', $loan->bank_name ?? '') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Down Payment (₹)</label>
                                <input type="number" step="0.01" name="down_payment" value="{{ old('down_payment', $loan->down_payment ?? '') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Loan Amount (₹)</label>
                                <input type="number" step="0.01" name="loan_amount" value="{{ old('loan_amount', $loan->loan_amount ?? '') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">EMI Amount (₹)</label>
                                <input type="number" step="0.01" name="emi_amount" value="{{ old('emi_amount', $loan->emi_amount ?? '') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Total EMIs</label>
                                <input type="number" name="total_emis" value="{{ old('total_emis', $loan->total_emis ?? '') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            @if($loan)
                                <div>
                                    <label class="block text-xs font-semibold t-muted mb-1.5">EMIs Paid</label>
                                    <input type="number" name="emis_paid" value="{{ old('emis_paid', $loan->emis_paid ?? 0) }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold t-muted mb-1.5">Status</label>
                                    <select name="status" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                                        @foreach(['applied', 'under_review', 'approved', 'rejected', 'disbursed'] as $s)
                                            <option value="{{ $s }}" @selected(old('status', $loan->status) === $s)>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-semibold t-muted mb-1.5">Notes</label>
                            <textarea name="notes" rows="2" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">{{ old('notes', $loan->notes ?? '') }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                {{ $loan ? 'Update Loan' : 'Create Loan' }}
                            </button>
                            <button type="button" onclick="toggleSection('loan-form')" class="text-sm t-muted hover:t-secondary transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ═══ INSTALLATION MANAGEMENT ═══ --}}
        <div class="glass rounded-2xl p-6 animate-fade-in delay-3">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold t-primary">Installation Management</h2>
                    <p class="mt-1 text-sm t-muted">{{ $inst ? 'Progress and scheduling details' : 'No installation scheduled yet' }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @if($inst)
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $instStatusBadge($inst->status) }}">{{ ucfirst(str_replace('_', ' ', $inst->status)) }}</span>
                    @endif
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-solar-500/10 text-solar-600 dark:text-solar-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </span>
                </div>
            </div>

            @if($inst)
                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Scheduled Date</dt>
                        <dd class="text-sm t-secondary text-right">{{ $inst->scheduled_date ? $inst->scheduled_date->format('M j, Y') : '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Completed Date</dt>
                        <dd class="text-sm t-secondary text-right">{{ $inst->completed_date ? $inst->completed_date->format('M j, Y') : '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Assigned Team</dt>
                        <dd class="text-sm t-secondary text-right">{{ $inst->assigned_team ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Status</dt>
                        <dd class="text-sm t-secondary text-right capitalize">{{ str_replace('_', ' ', $inst->status) }}</dd>
                    </div>
                    @if($inst->rejection_reason)
                        <div class="sm:col-span-2">
                            <p class="rounded-xl border border-red-500/20 bg-red-500/5 px-4 py-3 text-sm text-red-600 dark:text-red-400">
                                <span class="font-semibold">Rejection reason:</span> {{ $inst->rejection_reason }}
                            </p>
                        </div>
                    @endif
                    @if($inst->notes)
                        <div class="sm:col-span-2 border-t border-subtle pt-3">
                            <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Notes</dt>
                            <dd class="mt-1 text-sm t-secondary">{{ $inst->notes }}</dd>
                        </div>
                    @endif
                </dl>

                @if(!in_array($inst->status, ['installation_completed', 'installation_rejected'], true))
                    <div class="mt-4 flex flex-wrap items-end gap-3 border-t border-subtle pt-4">
                        <form method="POST" action="{{ route('admin.installation.approve', $inst) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                Approve Installation
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.installation.reject', $inst) }}" class="inline-flex flex-wrap items-end gap-2 rounded-xl border border-red-500/20 bg-red-500/5 p-3">
                            @csrf
                            <div class="min-w-[200px]">
                                <label class="sr-only" for="inst_rejection_reason">Rejection reason</label>
                                <input id="inst_rejection_reason" name="rejection_reason" required placeholder="Rejection reason" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-red-500/80 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                Reject
                            </button>
                        </form>
                    </div>
                @endif
            @endif

            <div class="mt-6 border-t border-subtle pt-4">
                <button type="button" onclick="toggleSection('installation-form')" class="inline-flex items-center gap-2 rounded-xl border border-theme px-4 py-2 text-sm font-semibold t-secondary hover:bg-white/5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                    {{ $inst ? 'Edit Installation' : 'Schedule Installation' }}
                </button>

                <div id="installation-form" class="hidden mt-4">
                    <form method="POST" action="{{ $inst ? route('admin.installation.update', $inst) : route('admin.installation.store', $customer) }}" class="rounded-xl border border-theme bg-surface p-5 space-y-4">
                        @csrf
                        @if($inst) @method('PUT') @endif

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Scheduled Date</label>
                                <input type="date" name="scheduled_date" value="{{ old('scheduled_date', $inst?->scheduled_date?->format('Y-m-d') ?? '') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Assigned Team</label>
                                <input type="text" name="assigned_team" value="{{ old('assigned_team', $inst->assigned_team ?? '') }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            @if($inst)
                                <div>
                                    <label class="block text-xs font-semibold t-muted mb-1.5">Status</label>
                                    <select name="status" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                                        @foreach(['installation_scheduled', 'installation_in_progress', 'installation_completed', 'installation_rejected'] as $s)
                                            <option value="{{ $s }}" @selected(old('status', $inst->status) === $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold t-muted mb-1.5">Completed Date</label>
                                    <input type="date" name="completed_date" value="{{ old('completed_date', $inst->completed_date?->format('Y-m-d') ?? '') }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold t-muted mb-1.5">Rejection Reason</label>
                                    <input type="text" name="rejection_reason" value="{{ old('rejection_reason', $inst->rejection_reason ?? '') }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-semibold t-muted mb-1.5">Notes</label>
                            <textarea name="notes" rows="2" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">{{ old('notes', $inst->notes ?? '') }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                {{ $inst ? 'Update Installation' : 'Schedule Installation' }}
                            </button>
                            <button type="button" onclick="toggleSection('installation-form')" class="text-sm t-muted hover:t-secondary transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ═══ SUBSIDY MANAGEMENT ═══ --}}
        <div class="glass rounded-2xl p-6 animate-fade-in delay-4">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold t-primary">Subsidy Management</h2>
                    <p class="mt-1 text-sm t-muted">{{ $subsidy ? 'Government incentive tracking' : 'No subsidy record — create one below' }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @if($subsidy)
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $subsidyStatusBadge($subsidy->status) }}">{{ ucfirst($subsidy->status) }}</span>
                    @endif
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                    </span>
                </div>
            </div>

            @if($subsidy)
                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Subsidy Amount</dt>
                        <dd class="text-sm t-secondary text-right">₹{{ $subsidy->subsidy_amount !== null ? number_format((float)$subsidy->subsidy_amount, 2) : '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Application No.</dt>
                        <dd class="text-sm t-secondary text-right">{{ $subsidy->application_number ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Status</dt>
                        <dd class="text-sm t-secondary text-right capitalize">{{ $subsidy->status }}</dd>
                    </div>
                    @if($subsidy->status_check_link)
                        <div class="flex justify-between gap-2">
                            <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Status Check</dt>
                            <dd class="text-sm text-right">
                                <a href="{{ $subsidy->status_check_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-solar-600 dark:text-solar-400 hover:underline">
                                    Check Link
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                                </a>
                            </dd>
                        </div>
                    @endif
                    @if($subsidy->notes)
                        <div class="sm:col-span-2 border-t border-subtle pt-3">
                            <dt class="text-[10px] font-semibold t-faint uppercase tracking-widest">Notes</dt>
                            <dd class="mt-1 text-sm t-secondary">{{ $subsidy->notes }}</dd>
                        </div>
                    @endif
                </dl>
            @endif

            <div class="mt-6 border-t border-subtle pt-4">
                <button type="button" onclick="toggleSection('subsidy-form')" class="inline-flex items-center gap-2 rounded-xl border border-theme px-4 py-2 text-sm font-semibold t-secondary hover:bg-white/5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                    {{ $subsidy ? 'Edit Subsidy' : 'Add Subsidy' }}
                </button>

                <div id="subsidy-form" class="hidden mt-4">
                    <form method="POST" action="{{ $subsidy ? route('admin.subsidy.update', $subsidy) : route('admin.subsidy.store', $customer) }}" class="rounded-xl border border-theme bg-surface p-5 space-y-4">
                        @csrf
                        @if($subsidy) @method('PUT') @endif

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Subsidy Amount (₹)</label>
                                <input type="number" step="0.01" name="subsidy_amount" value="{{ old('subsidy_amount', $subsidy->subsidy_amount ?? '') }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Application Number</label>
                                <input type="text" name="application_number" value="{{ old('application_number', $subsidy->application_number ?? '') }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Status Check Link</label>
                                <input type="url" name="status_check_link" value="{{ old('status_check_link', $subsidy->status_check_link ?? '') }}" placeholder="https://..." class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Status</label>
                                <select name="status" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                                    @foreach(['pending', 'applied', 'approved', 'received', 'rejected'] as $s)
                                        <option value="{{ $s }}" @selected(old('status', $subsidy->status ?? 'pending') === $s)>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold t-muted mb-1.5">Notes</label>
                            <textarea name="notes" rows="2" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">{{ old('notes', $subsidy->notes ?? '') }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                {{ $subsidy ? 'Update Subsidy' : 'Create Subsidy' }}
                            </button>
                            <button type="button" onclick="toggleSection('subsidy-form')" class="text-sm t-muted hover:t-secondary transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ═══ PAYMENTS ═══ --}}
        <div class="glass rounded-2xl p-6 animate-fade-in delay-5">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold t-primary">Payments</h2>
                    <p class="mt-1 text-sm t-muted">Payment history and recording</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                </span>
            </div>

            @if($customer->payments->count())
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-subtle">
                                <th class="pb-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Date</th>
                                <th class="pb-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Amount</th>
                                <th class="pb-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Method</th>
                                <th class="pb-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Transaction ID</th>
                                <th class="pb-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--border-subtle)]">
                            @foreach($customer->payments as $payment)
                                <tr>
                                    <td class="py-3 t-secondary">{{ $payment->created_at->format('M j, Y') }}</td>
                                    <td class="py-3 t-primary font-semibold">₹{{ number_format((float)$payment->amount, 2) }}</td>
                                    <td class="py-3 t-secondary capitalize">{{ str_replace('_', ' ', $payment->method) }}</td>
                                    <td class="py-3 t-muted font-mono text-xs">{{ $payment->transaction_id ?? '—' }}</td>
                                    <td class="py-3">
                                        <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold {{ $paymentBadge($payment->status) }}">{{ ucfirst($payment->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mt-6 py-6 text-center text-sm t-muted">No payments recorded yet.</p>
            @endif

            <div class="mt-6 border-t border-subtle pt-4">
                <button type="button" onclick="toggleSection('payment-form')" class="inline-flex items-center gap-2 rounded-xl border border-theme px-4 py-2 text-sm font-semibold t-secondary hover:bg-white/5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                    Record Payment
                </button>

                <div id="payment-form" class="hidden mt-4">
                    <form method="POST" action="{{ route('admin.payments.store') }}" class="rounded-xl border border-theme bg-surface p-5 space-y-4">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}" />

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Amount (₹)</label>
                                <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Method</label>
                                <select name="method" required class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                                    <option value="">Select method</option>
                                    <option value="online" @selected(old('method') === 'online')>Online</option>
                                    <option value="cash" @selected(old('method') === 'cash')>Cash</option>
                                    <option value="cheque" @selected(old('method') === 'cheque')>Cheque</option>
                                    <option value="bank_transfer" @selected(old('method') === 'bank_transfer')>Bank Transfer</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold t-muted mb-1.5">Transaction ID</label>
                                <input type="text" name="transaction_id" value="{{ old('transaction_id') }}" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold t-muted mb-1.5">Notes</label>
                            <textarea name="notes" rows="2" class="w-full rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">{{ old('notes') }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                Record Payment
                            </button>
                            <button type="button" onclick="toggleSection('payment-form')" class="text-sm t-muted hover:t-secondary transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ═══ QUOTATIONS ═══ --}}
        <div class="glass rounded-2xl p-6 animate-fade-in delay-6">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold t-primary">Quotations</h2>
                    <p class="mt-1 text-sm t-muted">Sent proposals and pricing</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-500/10 text-violet-600 dark:text-violet-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                </span>
            </div>

            @if($customer->quotations->count())
                <div class="mt-6 space-y-3">
                    @foreach($customer->quotations as $q)
                        <div class="flex flex-col gap-2 rounded-xl border border-subtle p-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <div class="text-sm font-semibold t-primary">{{ $q->package?->name ?? 'Custom Package' }}</div>
                                <div class="mt-0.5 text-xs t-muted">₹{{ number_format((float)$q->total_price, 2) }} · {{ $q->created_at->format('M j, Y') }}</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1 text-xs t-muted" title="Email">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    @if($q->sent_email)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600 dark:text-emerald-400"><path d="M20 6 9 17l-5-5"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="t-faint"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    @endif
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs t-muted" title="WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                    @if($q->sent_whatsapp)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600 dark:text-emerald-400"><path d="M20 6 9 17l-5-5"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="t-faint"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    @endif
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs t-muted" title="SMS">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    @if($q->sent_sms)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600 dark:text-emerald-400"><path d="M20 6 9 17l-5-5"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="t-faint"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-6 py-6 text-center text-sm t-muted">No quotations created yet.</p>
            @endif
        </div>

    </div>
@endsection

@section('scripts')
<script>
function toggleSection(id) {
    const el = document.getElementById(id);
    if (el) el.classList.toggle('hidden');
}
</script>
@endsection
