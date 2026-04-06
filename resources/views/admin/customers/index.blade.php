@extends('layouts.dashboard')

@section('title', 'All Customers')
@section('page-title', 'Customer Management')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    @php
        $statusBadge = function (string $status): string {
            if ($status === 'installation_completed') {
                return 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400';
            }
            if (str_ends_with($status, '_rejected')) {
                return 'bg-red-500/10 text-red-600 dark:text-red-400';
            }
            if (in_array($status, ['kyc_approved', 'loan_approved'], true)) {
                return 'bg-blue-500/10 text-blue-600 dark:text-blue-400';
            }
            return 'bg-amber-500/10 text-amber-600 dark:text-amber-400';
        };
        $statuses = [
            'registration_completed',
            'kyc_pending',
            'kyc_approved',
            'kyc_rejected',
            'loan_applied',
            'loan_approved',
            'loan_rejected',
            'installation_scheduled',
            'installation_completed',
            'installation_rejected',
        ];
    @endphp

    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center w-full lg:w-auto">
            <div class="relative flex-1 min-w-[200px]">
                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center t-faint">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </span>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search name, phone, email…" class="w-full rounded-xl border border-theme bg-input py-2.5 pl-10 pr-4 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20" />
            </div>
            <select name="status" class="min-w-[180px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                <option value="">All statuses</option>
                @foreach($statuses as $st)
                    <option value="{{ $st }}" @selected(request('status') === $st)>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $st)) }}</option>
                @endforeach
            </select>
            <select name="type" class="min-w-[160px] rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                <option value="">All types</option>
                <option value="domestic" @selected(request('type') === 'domestic')>Domestic</option>
                <option value="commercial" @selected(request('type') === 'commercial')>Commercial</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status', 'type']))
                    <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-medium t-secondary hover:bg-white/10">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="rounded-2xl glass overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Name</th>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Phone</th>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">City</th>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Type</th>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Payment</th>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Status</th>
                        <th scope="col" class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Channel Partner</th>
                        <th scope="col" class="px-4 py-3 text-right text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-4 py-3 font-medium t-primary">{{ $customer->name }}</td>
                            <td class="px-4 py-3 t-muted">{{ $customer->phone }}</td>
                            <td class="px-4 py-3 t-muted">{{ $customer->city }}</td>
                            <td class="px-4 py-3">
                                @if($customer->installation_type === 'commercial')
                                    <span class="inline-flex items-center rounded-full bg-violet-500/10 px-2.5 py-0.5 text-xs font-semibold text-violet-600 dark:text-violet-400">Commercial</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-sky-500/10 px-2.5 py-0.5 text-xs font-semibold text-sky-400">Domestic</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($customer->payment_method === 'loan')
                                    <span class="inline-flex items-center rounded-full bg-indigo-500/10 px-2.5 py-0.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400">Loan</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-2.5 py-0.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400">Cash</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $statusBadge($customer->status) }}">
                                    {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $customer->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 t-secondary">{{ $customer->channelPartner?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="inline-flex items-center gap-1.5 font-semibold text-solar-700 hover:text-solar-800">
                                    View
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center t-faint">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
            <div class="border-t border-subtle px-4 py-4">
                {{ $customers->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
