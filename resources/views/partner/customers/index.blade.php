@extends('layouts.dashboard')

@section('title', 'My Customers')
@section('page-title', 'My Customers')

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
    <a href="{{ route('partner.customers.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 shadow-sm transition hover:bg-solar-400">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Add Customer
    </a>
@endsection

@section('content')
    <form method="get" action="{{ route('partner.customers.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1 max-w-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 t-faint" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name or phone…" class="w-full rounded-xl border border-theme bg-input py-2.5 pl-10 pr-4 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20 outline-none transition">
        </div>
        <button type="submit" class="rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">Search</button>
        @if(request('search'))
            <a href="{{ route('partner.customers.index') }}" class="inline-flex items-center justify-center rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-medium t-secondary hover:bg-white/10 transition">Clear</a>
        @endif
    </form>

    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left">
                        <th class="px-5 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Name</th>
                        <th class="px-5 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Phone</th>
                        <th class="px-5 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">City</th>
                        <th class="px-5 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Type</th>
                        <th class="px-5 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Payment</th>
                        <th class="px-5 py-3 text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Status</th>
                        <th class="px-5 py-3 text-right text-[10px] font-semibold t-faint uppercase tracking-widest border-b border-subtle">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[color:var(--border-subtle)]">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-5 py-3.5 font-medium t-primary">{{ $customer->name }}</td>
                            <td class="px-5 py-3.5 t-secondary">{{ $customer->phone }}</td>
                            <td class="px-5 py-3.5 t-secondary">{{ $customer->city ?? '—' }}</td>
                            <td class="px-5 py-3.5 capitalize t-secondary">{{ $customer->installation_type ?? '—' }}</td>
                            <td class="px-5 py-3.5 capitalize">
                                <span class="inline-flex rounded-lg px-2 py-0.5 text-xs font-semibold {{ $customer->payment_method === 'loan' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' }}">
                                    {{ $customer->payment_method ?? '—' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                @php
                                    $st = $customer->status ?? '';
                                    $stBadge = match (true) {
                                        $st === 'installation_completed' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                        str_contains($st, 'rejected') => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                        in_array($st, ['kyc_approved', 'loan_approved'], true) => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                                        default => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-lg px-2.5 py-0.5 text-xs font-semibold {{ $stBadge }}">
                                    {{ str_replace('_', ' ', $st ?: '—') }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <a href="{{ route('partner.customers.show', $customer) }}" class="inline-flex items-center rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold text-solar-600 dark:text-solar-500 hover:bg-white/10 transition">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center t-faint">No customers match your search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
            <div class="border-t border-subtle px-5 py-4">
                {{ $customers->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
