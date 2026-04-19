@extends('layouts.dashboard')

@section('title', 'Quotations')
@section('page-title', 'Quotations')
@section('page-subtitle', 'All quotations across companies')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('header-actions')
    <a href="{{ route('admin.quotations.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        New Quotation
    </a>
@endsection

@section('content')
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.quotations.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ !request('company') ? 'bg-solar-500/15 border-solar-500/40 text-solar-600 dark:text-solar-400' : 'border-theme t-muted hover:bg-input' }}">All</a>
        @foreach($companies as $c)
            <a href="{{ route('admin.quotations.index', ['company' => $c->code]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ request('company') === $c->code ? 'bg-solar-500/15 border-solar-500/40 text-solar-600 dark:text-solar-400' : 'border-theme t-muted hover:bg-input' }}">
                {{ $c->name }}
            </a>
        @endforeach
    </div>

    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-5 py-4">Ref. #</th>
                        <th class="px-5 py-4">Company</th>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Location</th>
                        <th class="px-5 py-4 text-right">Grand Total</th>
                        <th class="px-5 py-4">Email</th>
                        <th class="px-5 py-4">Created by</th>
                        <th class="px-5 py-4">Date</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[color:var(--border-subtle)]">
                    @forelse($quotations as $q)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-5 py-4 font-mono text-xs t-primary font-semibold">{{ $q->reference_number ?? ('#' . $q->id) }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center rounded-lg border border-theme bg-input px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide t-secondary">{{ $q->company?->ref_prefix ?? '—' }}</span>
                                <div class="text-[11px] t-muted mt-0.5">{{ $q->company?->name ?? '—' }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-medium t-primary">{{ $q->customer?->name ?? '—' }}</div>
                                @if($q->customer?->city)<div class="text-[11px] t-faint">{{ $q->customer->city }}</div>@endif
                            </td>
                            <td class="px-5 py-4 t-secondary text-xs">{{ $q->location ?: '—' }}</td>
                            <td class="px-5 py-4 text-right t-primary font-semibold tabular-nums">₹{{ number_format((float) $q->grand_total, 2) }}</td>
                            <td class="px-5 py-4">
                                @if($q->sent_email)
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-emerald-500/10 px-2 py-0.5 text-[11px] font-medium text-emerald-600 dark:text-emerald-400">Sent</span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-amber-500/10 px-2 py-0.5 text-[11px] font-medium text-amber-600 dark:text-amber-400">Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-[11px] t-muted">{{ $q->creator?->name ?? '—' }}</td>
                            <td class="px-5 py-4 text-[11px] t-muted tabular-nums whitespace-nowrap">{{ $q->created_at?->format('d M Y') }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex flex-wrap items-center justify-end gap-2">
                                    <a href="{{ route('admin.quotations.show', $q) }}" class="inline-flex items-center gap-1 rounded-lg border border-theme bg-white/5 px-2.5 py-1.5 text-[11px] font-semibold t-secondary hover:bg-white/10 transition">View</a>
                                    <a href="{{ route('admin.quotations.edit', $q) }}" class="inline-flex items-center gap-1 rounded-lg border border-theme bg-white/5 px-2.5 py-1.5 text-[11px] font-semibold t-secondary hover:bg-white/10 transition">Edit</a>
                                    <a href="{{ route('admin.quotations.pdf', $q) }}" target="_blank" class="inline-flex items-center gap-1 rounded-lg border border-theme bg-white/5 px-2.5 py-1.5 text-[11px] font-semibold text-solar-600 dark:text-solar-400 hover:bg-white/10 transition">PDF</a>
                                    @unless($q->sent_email)
                                        <form method="POST" action="{{ route('admin.quotations.send', $q) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-solar-500/15 px-2.5 py-1.5 text-[11px] font-semibold text-solar-600 dark:text-solar-400 hover:bg-solar-500/25 transition">Send</button>
                                        </form>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-16 text-center t-faint text-sm">
                                No quotations yet. <a href="{{ route('admin.quotations.create') }}" class="text-solar-600 dark:text-solar-400 font-medium">Create one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($quotations->hasPages())
        <div class="mt-5">{{ $quotations->links() }}</div>
    @endif
@endsection
