@extends('layouts.dashboard')

@section('title', 'My Installation')
@section('page-title', 'My Installation')
@section('page-subtitle', 'Track your solar journey')

@section('sidebar')
    <a href="{{ route('customer.dashboard') }}" class="sidebar-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
        My Status
    </a>
    <a href="{{ route('customer.payment.create') }}" class="sidebar-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
        Make Payment
    </a>
@endsection

@section('content')
@if(!$customer)
    <div class="flex flex-col items-center justify-center py-16 sm:py-24 px-4 animate-fade-in">
        <div class="w-16 h-16 rounded-2xl bg-input border border-theme flex items-center justify-center mb-5 glass">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="t-faint"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
        </div>
        <h2 class="text-lg font-semibold t-primary">No record found</h2>
        <p class="mt-2 text-sm t-muted max-w-md text-center leading-relaxed">We could not find an application linked to your account. If you recently registered, please check back later or contact support.</p>
    </div>
@else
    @php
        $inst = $customer->installation;
        $kycDocs = $customer->kycDocuments ?? collect();
        $loan = $customer->loan;
        $subsidy = $customer->subsidy;
        $payments = $customer->payments ?? collect();
        $status = $customer->status;

        $stepLabels = [
            1 => 'Registration',
            2 => 'KYC',
            3 => 'Loan',
            4 => 'Scheduled',
            5 => 'Completed',
        ];

        // Timeline states: done | current | future | rejected
        $rejectedStep = match ($status) {
            'kyc_rejected' => 2,
            'loan_rejected' => 3,
            'installation_rejected' => 4,
            default => null,
        };

        $timelineSteps = [];
        if ($status === 'installation_completed') {
            for ($i = 1; $i <= 5; $i++) {
                $timelineSteps[$i] = 'done';
            }
        } elseif ($rejectedStep !== null) {
            for ($i = 1; $i < $rejectedStep; $i++) {
                $timelineSteps[$i] = 'done';
            }
            $timelineSteps[$rejectedStep] = 'rejected';
            for ($i = $rejectedStep + 1; $i <= 5; $i++) {
                $timelineSteps[$i] = 'future';
            }
        } else {
            $current = match ($status) {
                'registration_completed', 'kyc_pending' => 2,
                'kyc_approved', 'loan_applied' => 3,
                'loan_approved', 'installation_scheduled' => 4,
                default => 2,
            };
            for ($i = 1; $i < $current; $i++) {
                $timelineSteps[$i] = 'done';
            }
            $timelineSteps[$current] = 'current';
            for ($i = $current + 1; $i <= 5; $i++) {
                $timelineSteps[$i] = 'future';
            }
        }

        $appBadge = match (true) {
            $status === 'installation_completed' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/25',
            str_contains($status, 'rejected') => 'bg-red-500/15 text-red-600 dark:text-red-400 border-red-500/25',
            str_contains($status, 'approved') => 'bg-sky-500/15 text-sky-600 dark:text-sky-400 border-sky-500/25',
            default => 'bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/25',
        };

        $installationTypeBadge = $customer->installation_type === 'commercial'
            ? 'bg-violet-500/15 text-violet-600 dark:text-violet-400 border-violet-500/20'
            : 'bg-slate-500/15 t-secondary border-theme';

        $paymentMethodBadge = $customer->payment_method === 'loan'
            ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 border-indigo-500/20'
            : 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/20';
    @endphp

    <div class="max-w-5xl mx-auto space-y-5 sm:space-y-6">

        {{-- HERO: Progress timeline --}}
        <section class="glass rounded-2xl p-4 sm:p-6 md:p-8 border border-theme animate-fade-in overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
                <div>
                    <p class="text-[10px] font-semibold t-faint uppercase tracking-widest">Your journey</p>
                    <h2 class="text-lg sm:text-xl font-bold t-primary mt-1">Installation progress</h2>
                    <p class="text-xs sm:text-sm t-muted mt-1">From registration to powering your home.</p>
                </div>
            </div>

            <div class="overflow-x-auto pb-2 -mx-1 px-1">
                <div class="flex items-start min-w-[520px] sm:min-w-0 pt-2">
                    @foreach($stepLabels as $num => $label)
                        @php
                            $state = $timelineSteps[$num] ?? 'future';
                            $lineGreen = $num > 1 && (($timelineSteps[$num - 1] ?? '') === 'done');
                        @endphp
                        <div class="flex-1 flex flex-col items-center min-w-0">
                            <div class="flex items-center w-full">
                                @if($num > 1)
                                    <div class="flex-1 h-[3px] min-w-[8px] rounded-full {{ $lineGreen ? 'bg-emerald-500' : 'bg-input' }}"></div>
                                @endif
                                @if($state === 'rejected')
                                    <div class="relative w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/25 ring-2 ring-red-400/40 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                    </div>
                                @elseif($state === 'done')
                                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-emerald-500 flex items-center justify-center shadow-md shadow-emerald-500/20 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
                                    </div>
                                @elseif($state === 'current')
                                    <div class="relative w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-input border-2 border-emerald-500 flex items-center justify-center shrink-0 animate-pulse shadow-[0_0_0_4px_rgba(16,185,129,0.15)]">
                                        <span class="text-xs sm:text-sm font-bold text-emerald-600 dark:text-emerald-400">{{ $num }}</span>
                                    </div>
                                @else
                                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-input border border-subtle flex items-center justify-center shrink-0">
                                        <span class="text-xs sm:text-sm font-semibold t-muted">{{ $num }}</span>
                                    </div>
                                @endif
                            </div>
                            <p class="mt-2.5 text-[10px] sm:text-xs font-medium text-center t-secondary leading-tight px-0.5 max-w-[5.5rem] sm:max-w-none">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 sm:gap-6">
            {{-- Installation details --}}
            <div class="stat-card rounded-2xl animate-fade-in delay-1">
                <span class="text-[10px] font-semibold t-faint uppercase tracking-widest">Installation details</span>
                <dl class="mt-4 space-y-3">
                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                        <dt class="text-xs t-muted">System capacity</dt>
                        <dd class="text-sm font-semibold t-primary">{{ $customer->system_capacity_kw !== null ? number_format((float) $customer->system_capacity_kw, 2) . ' kW' : '—' }}</dd>
                    </div>
                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                        <dt class="text-xs t-muted">Package</dt>
                        <dd class="text-sm font-medium t-secondary text-right">{{ $customer->package_selected ?: '—' }}</dd>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <dt class="text-xs t-muted">Type</dt>
                        <dd>
                            <span class="inline-flex rounded-lg px-2.5 py-0.5 text-[11px] font-semibold capitalize border {{ $installationTypeBadge }}">{{ $customer->installation_type }}</span>
                        </dd>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <dt class="text-xs t-muted">Payment method</dt>
                        <dd>
                            <span class="inline-flex rounded-lg px-2.5 py-0.5 text-[11px] font-semibold capitalize border {{ $paymentMethodBadge }}">{{ $customer->payment_method }}</span>
                        </dd>
                    </div>
                    @if($inst)
                        <div class="h-px bg-input border-t border-subtle my-2"></div>
                        @if($inst->scheduled_date)
                            <div class="flex flex-wrap items-start justify-between gap-2">
                                <dt class="text-xs t-muted">Scheduled date</dt>
                                <dd class="text-sm font-medium t-primary text-right">{{ $inst->scheduled_date->format('D, M j, Y') }}</dd>
                            </div>
                        @endif
                        @if($inst->status === 'installation_completed' && $inst->completed_date)
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <dt class="text-xs t-muted">Completed</dt>
                                <dd class="flex items-center gap-2 text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    {{ $inst->completed_date->format('D, M j, Y') }}
                                </dd>
                            </div>
                        @endif
                    @endif
                </dl>
            </div>

            {{-- Application status --}}
            <div class="stat-card rounded-2xl animate-fade-in delay-2 relative overflow-hidden gradient-border">
                <span class="text-[10px] font-semibold t-faint uppercase tracking-widest">Application status</span>
                <div class="mt-4">
                    <span class="inline-flex items-center rounded-xl px-4 py-2 text-base sm:text-lg font-bold capitalize border {{ $appBadge }}">
                        {{ str_replace('_', ' ', $status) }}
                    </span>
                    <p class="mt-4 text-xs sm:text-sm t-muted leading-relaxed">This reflects the latest stage of your solar installation request.</p>
                </div>
            </div>
        </div>

        {{-- KYC documents --}}
        <div class="stat-card rounded-2xl animate-fade-in delay-3">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <span class="text-[10px] font-semibold t-faint uppercase tracking-widest">KYC documents</span>
            </div>
            @if($kycDocs->isEmpty())
                <p class="text-sm t-muted">Documents will be uploaded by your channel partner.</p>
            @else
                <ul class="space-y-3">
                    @foreach($kycDocs as $doc)
                        @php
                            $kycBadge = match ($doc->status) {
                                'approved' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                                'rejected' => 'bg-red-500/15 text-red-600 dark:text-red-400 border-red-500/20',
                                default => 'bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/20',
                            };
                            $label = $doc->document_label;
                        @endphp
                        <li class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 p-3 rounded-xl bg-input border border-subtle">
                            <div class="min-w-0">
                                <p class="text-sm font-medium t-primary">{{ $label }}</p>
                                @if($doc->original_filename)
                                    <p class="text-[11px] t-faint truncate">{{ $doc->original_filename }}</p>
                                @endif
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex rounded-lg px-2 py-0.5 text-[11px] font-semibold capitalize border {{ $kycBadge }}">{{ $doc->status }}</span>
                                @if($doc->file_path)
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-solar-600 dark:text-solar-400 hover:underline">View</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if($loan)
            @php
                $loanBadge = match ($loan->status) {
                    'approved', 'disbursed' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                    'rejected' => 'bg-red-500/15 text-red-600 dark:text-red-400 border-red-500/20',
                    'applied', 'under_review' => 'bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/20',
                    default => 'bg-slate-500/15 t-secondary border-theme',
                };
                $totalEmis = max(1, (int) ($loan->total_emis ?? 1));
                $paid = (int) ($loan->emis_paid ?? 0);
                $emiPct = min(100, round(($paid / $totalEmis) * 100));
            @endphp
            <div class="stat-card rounded-2xl animate-fade-in delay-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
                    <span class="text-[10px] font-semibold t-faint uppercase tracking-widest">Loan status</span>
                    <span class="inline-flex w-fit rounded-lg px-2.5 py-0.5 text-[11px] font-semibold capitalize border {{ $loanBadge }}">{{ $loan->status }}</span>
                </div>
                <p class="text-sm font-semibold t-primary mb-4">{{ $loan->bank_name }}</p>
                <dl class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                    <div class="p-3 rounded-xl bg-input border border-subtle">
                        <dt class="text-[10px] t-muted uppercase tracking-wide">Loan amount</dt>
                        <dd class="text-sm font-bold t-primary mt-1">₹{{ number_format((float) $loan->loan_amount, 2) }}</dd>
                    </div>
                    <div class="p-3 rounded-xl bg-input border border-subtle">
                        <dt class="text-[10px] t-muted uppercase tracking-wide">Down payment</dt>
                        <dd class="text-sm font-bold t-primary mt-1">₹{{ number_format((float) $loan->down_payment, 2) }}</dd>
                    </div>
                    <div class="p-3 rounded-xl bg-input border border-subtle">
                        <dt class="text-[10px] t-muted uppercase tracking-wide">EMI amount</dt>
                        <dd class="text-sm font-bold t-primary mt-1">₹{{ number_format((float) $loan->emi_amount, 2) }}</dd>
                    </div>
                </dl>
                <div class="mb-2 flex flex-wrap items-center justify-between gap-2 text-xs">
                    <span class="t-secondary">EMIs paid: <span class="font-semibold t-primary">{{ $paid }}</span> / {{ $loan->total_emis }}</span>
                    <span class="t-muted">{{ $emiPct }}%</span>
                </div>
                <div class="h-2 rounded-full bg-input border border-subtle overflow-hidden">
                    <div class="h-full rounded-full bg-emerald-500 transition-all duration-500" style="width: {{ $emiPct }}%"></div>
                </div>
                <p class="mt-3 text-xs t-muted">EMIs pending: <span class="font-semibold t-secondary">{{ (int) ($loan->emis_pending ?? max(0, $totalEmis - $paid)) }}</span></p>
            </div>
        @endif

        @if($subsidy)
            @php
                $subBadge = match (strtolower((string) $subsidy->status)) {
                    'received', 'approved' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                    'rejected' => 'bg-red-500/15 text-red-600 dark:text-red-400 border-red-500/20',
                    'applied' => 'bg-sky-500/15 text-sky-600 dark:text-sky-400 border-sky-500/20',
                    default => 'bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/20',
                };
            @endphp
            <div class="stat-card rounded-2xl animate-fade-in delay-5">
                <span class="text-[10px] font-semibold t-faint uppercase tracking-widest">Subsidy status</span>
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <span class="inline-flex rounded-lg px-2.5 py-0.5 text-[11px] font-semibold capitalize border {{ $subBadge }}">{{ $subsidy->status }}</span>
                </div>
                <dl class="mt-4 space-y-2">
                    <div class="flex flex-wrap justify-between gap-2">
                        <dt class="text-xs t-muted">Amount</dt>
                        <dd class="text-sm font-bold t-primary">₹{{ number_format((float) $subsidy->subsidy_amount, 2) }}</dd>
                    </div>
                    @if($subsidy->application_number)
                        <div class="flex flex-wrap justify-between gap-2">
                            <dt class="text-xs t-muted">Application number</dt>
                            <dd class="text-sm font-medium t-secondary font-mono">{{ $subsidy->application_number }}</dd>
                        </div>
                    @endif
                </dl>
                @if($subsidy->status_check_link)
                    <a href="{{ $subsidy->status_check_link }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-solar-500/15 text-solar-600 dark:text-solar-400 border border-solar-500/25 hover:bg-solar-500/25 transition-colors w-full sm:w-auto">
                        Check status
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                    </a>
                @endif
            </div>
        @endif

        {{-- Payment history --}}
        <div class="glass rounded-2xl p-4 sm:p-6 border border-theme animate-fade-in delay-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div>
                    <span class="text-[10px] font-semibold t-faint uppercase tracking-widest">Payment history</span>
                    <h3 class="text-base font-bold t-primary mt-1">Your payments</h3>
                </div>
                <a href="{{ route('customer.payment.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-solar-500 text-white hover:bg-solar-600 shadow-lg shadow-solar-500/20 transition-colors w-full sm:w-auto shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                    Make a payment
                </a>
            </div>

            @if($payments->isEmpty())
                <p class="text-sm t-muted py-8 text-center border border-dashed border-subtle rounded-xl bg-input/50">No payments recorded yet.</p>
            @else
                <div class="overflow-x-auto rounded-xl border border-subtle -mx-1">
                    <table class="w-full text-sm min-w-[640px]">
                        <thead>
                            <tr class="border-b border-theme bg-input/80">
                                <th class="text-left py-3 px-3 text-[10px] font-semibold t-faint uppercase tracking-wider">Date</th>
                                <th class="text-right py-3 px-3 text-[10px] font-semibold t-faint uppercase tracking-wider">Amount</th>
                                <th class="text-left py-3 px-3 text-[10px] font-semibold t-faint uppercase tracking-wider">Method</th>
                                <th class="text-left py-3 px-3 text-[10px] font-semibold t-faint uppercase tracking-wider">Status</th>
                                <th class="text-left py-3 px-3 text-[10px] font-semibold t-faint uppercase tracking-wider">Transaction ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments->sortByDesc('created_at') as $pay)
                                @php
                                    $payStatusBadge = match (strtolower((string) $pay->status)) {
                                        'completed', 'success', 'paid' => 'text-emerald-600 dark:text-emerald-400',
                                        'failed', 'cancelled' => 'text-red-600 dark:text-red-400',
                                        default => 't-secondary',
                                    };
                                @endphp
                                <tr class="border-b border-subtle hover:bg-input/40 transition-colors">
                                    <td class="py-3 px-3 t-secondary whitespace-nowrap">{{ $pay->created_at?->format('M j, Y') }}</td>
                                    <td class="py-3 px-3 text-right font-semibold t-primary whitespace-nowrap">₹{{ number_format((float) $pay->amount, 2) }}</td>
                                    <td class="py-3 px-3 capitalize t-secondary">{{ $pay->method }}</td>
                                    <td class="py-3 px-3 capitalize font-medium {{ $payStatusBadge }}">{{ $pay->status }}</td>
                                    <td class="py-3 px-3 t-muted font-mono text-xs">{{ $pay->transaction_id ?: '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endif
@endsection
