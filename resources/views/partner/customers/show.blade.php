@extends('layouts.dashboard')

@section('title', $customer->name)
@section('page-title', $customer->name)

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

@section('header-actions')
    <a href="{{ route('partner.customers.index') }}" class="text-sm font-semibold text-solar-600 dark:text-solar-500 hover:text-solar-700 dark:hover:text-solar-300">← Back to list</a>
@endsection

@section('content')
    @php
        $inst = $customer->installation;
        $steps = [
            ['key' => 'registration_completed', 'label' => 'Registered'],
            ['key' => 'kyc_approved', 'label' => 'KYC'],
            ['key' => 'loan_approved', 'label' => 'Loan'],
            ['key' => 'installation_scheduled', 'label' => 'Scheduled'],
            ['key' => 'installation_in_progress', 'label' => 'In progress'],
            ['key' => 'installation_completed', 'label' => 'Completed'],
        ];
        $order = array_flip(array_column($steps, 'key'));
        $currentIdx = $inst ? ($order[$inst->status] ?? 0) : null;
        $rejected = $inst && $inst->status === 'installation_rejected';
    @endphp

    <div class="grid lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 glass rounded-2xl p-6">
            <h2 class="text-xs font-semibold t-muted uppercase tracking-widest mb-4">Customer details</h2>
            <dl class="grid sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                <div><dt class="t-faint">Phone</dt><dd class="t-secondary">{{ $customer->phone }}</dd></div>
                <div><dt class="t-faint">Email</dt><dd class="t-secondary">{{ $customer->email ?? '—' }}</dd></div>
                <div class="sm:col-span-2"><dt class="t-faint">Address</dt><dd class="t-secondary">{{ $customer->address }}</dd></div>
                <div><dt class="t-faint">City</dt><dd class="t-secondary">{{ $customer->city }}</dd></div>
                <div><dt class="t-faint">State</dt><dd class="t-secondary">{{ $customer->state }}</dd></div>
                <div class="sm:col-span-2"><dt class="t-faint">Installation location</dt><dd class="t-secondary">{{ $customer->installation_location ?? '—' }}</dd></div>
                <div><dt class="t-faint">System (kW)</dt><dd class="t-secondary">{{ $customer->system_capacity_kw ?? '—' }}</dd></div>
                <div><dt class="t-faint">Package</dt><dd class="t-secondary">{{ $customer->package_selected ?? '—' }}</dd></div>
                <div><dt class="t-faint">Type</dt><dd class="t-secondary capitalize">{{ $customer->installation_type }}</dd></div>
                <div><dt class="t-faint">Payment</dt><dd class="t-secondary capitalize">{{ $customer->payment_method }}</dd></div>
                <div><dt class="t-faint">Application status</dt><dd>
                    @php
                        $appSt = $customer->status ?? '';
                        $appBadge = match (true) {
                            $appSt === 'installation_completed' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                            str_contains($appSt, 'rejected') => 'bg-red-500/10 text-red-600 dark:text-red-400',
                            in_array($appSt, ['kyc_approved', 'loan_approved'], true) => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                            default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                        };
                    @endphp
                    <span class="inline-flex rounded-lg px-2.5 py-0.5 text-xs font-semibold {{ $appBadge }}">{{ str_replace('_', ' ', $appSt) }}</span>
                </dd></div>
            </dl>
        </div>

        <div class="glass rounded-2xl p-6">
            <h2 class="text-xs font-semibold t-muted uppercase tracking-widest mb-4">Installation status</h2>
            @if($inst)
                @if($rejected)
                    <div class="rounded-xl bg-red-500/10 border border-red-500/20 p-4 text-sm text-red-600 dark:text-red-400">
                        <p class="font-semibold">Installation rejected</p>
                        @if($inst->rejection_reason)
                            <p class="mt-1 text-red-600 dark:text-red-400">{{ $inst->rejection_reason }}</p>
                        @endif
                    </div>
                @else
                    <div class="space-y-1">
                        @foreach($steps as $i => $step)
                            @php
                                $done = $currentIdx !== null && ($i < $currentIdx || $inst->status === 'installation_completed');
                                $active = $inst->status === $step['key'];
                                $dot = $done ? 'bg-solar-500/20 text-solar-600 dark:text-solar-500 ring-solar-500/20' : ($active ? 'bg-amber-500/20 text-amber-600 dark:text-amber-400 ring-amber-500/20 scale-105' : 'bg-white/5 t-faint ring-[color:var(--border-main)]');
                            @endphp
                            <div class="flex items-start gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full ring-2 {{ $dot }} text-xs font-bold">
                                        @if($done)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6 9 17l-5-5"/></svg>
                                        @else
                                            {{ $i + 1 }}
                                        @endif
                                    </div>
                                    @if($i < count($steps) - 1)
                                        <div class="w-0.5 flex-1 min-h-[12px] {{ $done ? 'bg-solar-500/30' : 'bg-white/5' }}"></div>
                                    @endif
                                </div>
                                <div class="pb-4 pt-0.5">
                                    <p class="text-sm font-semibold {{ $active ? 't-primary' : ($done ? 't-secondary' : 't-faint') }}">{{ $step['label'] }}</p>
                                    @if($active && $inst->scheduled_date && in_array($inst->status, ['installation_scheduled', 'installation_in_progress', 'installation_completed'], true))
                                        <p class="text-xs t-muted mt-0.5">Scheduled {{ $inst->scheduled_date->format('M j, Y') }}</p>
                                    @endif
                                    @if($inst->status === 'installation_completed' && $step['key'] === 'installation_completed' && $inst->completed_date)
                                        <p class="text-xs t-muted mt-0.5">Completed {{ $inst->completed_date->format('M j, Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <p class="text-sm t-faint">No installation record yet.</p>
            @endif
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        <div class="glass rounded-2xl p-6">
            <h2 class="text-xs font-semibold t-muted uppercase tracking-widest mb-4">Upload KYC</h2>
            <form method="post" action="{{ route('partner.customers.kyc', $customer) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="document_type" class="block text-xs font-medium t-muted mb-1.5">Document type</label>
                    <select name="document_type" id="document_type" required class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none">
                        <option value="aadhaar_card">Aadhaar Card</option>
                        <option value="pan_card">PAN Card</option>
                        <option value="address_proof">Address Proof</option>
                        <option value="electricity_bill">Electricity Bill</option>
                        <option value="property_ownership">Property Ownership</option>
                        <option value="bank_details">Bank Details</option>
                    </select>
                </div>
                <div>
                    <label for="document" class="block text-xs font-medium t-muted mb-1.5">File (PDF, JPG, PNG, max 5MB)</label>
                    <input type="file" name="document" id="document" required accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm t-secondary file:mr-4 file:rounded-lg file:border-0 file:bg-solar-500/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-solar-600 dark:file:text-solar-500 hover:file:bg-solar-500/20">
                </div>
                <button type="submit" class="rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">Upload</button>
            </form>
        </div>

        <div class="glass rounded-2xl p-6 overflow-hidden">
            <h2 class="text-xs font-semibold t-muted uppercase tracking-widest mb-4">KYC documents</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left">
                            <th class="px-4 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Document</th>
                            <th class="px-4 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">File</th>
                            <th class="px-4 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[color:var(--border-subtle)]">
                        @forelse($customer->kycDocuments as $doc)
                            @php
                                $kycBadge = match ($doc->status ?? 'pending') {
                                    'approved' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                                    'rejected' => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                    default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                                };
                            @endphp
                            <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                                <td class="px-4 py-3 font-medium t-primary">{{ $doc->document_label }}</td>
                                <td class="px-4 py-3 t-secondary truncate max-w-[140px]" title="{{ $doc->original_filename }}">{{ $doc->original_filename }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-lg px-2 py-0.5 text-xs font-semibold {{ $kycBadge }}">{{ ucfirst($doc->status ?? 'pending') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-4 py-6 text-center t-faint">No documents uploaded.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($customer->loan)
        <div class="glass rounded-2xl p-6 mb-8">
            <h2 class="text-xs font-semibold t-muted uppercase tracking-widest mb-4">Loan details</h2>
            <dl class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                <div><dt class="t-faint">Bank</dt><dd class="t-secondary">{{ $customer->loan->bank_name ?? '—' }}</dd></div>
                <div><dt class="t-faint">Status</dt><dd>
                    @php
                        $loanSt = $customer->loan->status ?? '';
                        $loanBadge = match (true) {
                            str_contains($loanSt, 'approved') => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                            str_contains($loanSt, 'rejected') => 'bg-red-500/10 text-red-600 dark:text-red-400',
                            default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                        };
                    @endphp
                    <span class="inline-flex rounded-lg px-2.5 py-0.5 text-xs font-semibold {{ $loanBadge }}">{{ str_replace('_', ' ', $loanSt) }}</span>
                </dd></div>
                <div><dt class="t-faint">Loan amount</dt><dd class="t-secondary">₹{{ number_format($customer->loan->loan_amount ?? 0, 2) }}</dd></div>
                <div><dt class="t-faint">EMI</dt><dd class="t-secondary">₹{{ number_format($customer->loan->emi_amount ?? 0, 2) }} / month</dd></div>
                <div><dt class="t-faint">Progress</dt><dd class="t-secondary">{{ (int) ($customer->loan->emis_paid ?? 0) }} / {{ (int) ($customer->loan->total_emis ?? 0) }} EMIs</dd></div>
            </dl>
            @if($customer->loan->notes)
                <p class="mt-4 text-sm t-muted border-t border-subtle pt-4">{{ $customer->loan->notes }}</p>
            @endif
        </div>
    @endif

    @if($customer->subsidy)
        <div class="glass rounded-2xl p-6">
            <h2 class="text-xs font-semibold t-muted uppercase tracking-widest mb-4">Subsidy status</h2>
            <dl class="grid sm:grid-cols-2 gap-4 text-sm">
                <div><dt class="t-faint">Status</dt><dd>
                    @php
                        $subSt = $customer->subsidy->status ?? '';
                        $subBadge = match ($subSt) {
                            'received' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                            'pending' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                            default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                        };
                    @endphp
                    <span class="inline-flex rounded-lg px-2.5 py-0.5 text-xs font-semibold {{ $subBadge }}">{{ ucfirst($subSt) }}</span>
                </dd></div>
                <div><dt class="t-faint">Application no.</dt><dd class="t-secondary">{{ $customer->subsidy->application_number ?? '—' }}</dd></div>
                @if($customer->subsidy->status_check_link)
                    <div class="sm:col-span-2">
                        <a href="{{ $customer->subsidy->status_check_link }}" target="_blank" rel="noopener" class="text-sm font-semibold text-solar-600 dark:text-solar-500 hover:text-solar-700 dark:hover:text-solar-300">Check status online →</a>
                    </div>
                @endif
                @if($customer->subsidy->notes)
                    <div class="sm:col-span-2"><p class="t-muted">{{ $customer->subsidy->notes }}</p></div>
                @endif
            </dl>
        </div>
    @endif
@endsection
