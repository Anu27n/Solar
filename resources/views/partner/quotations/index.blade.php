@extends('layouts.dashboard')

@section('title', 'Quotations')
@section('page-title', 'Quotations')
@section('page-subtitle', 'Quotations issued to your customers (read-only)')

@section('sidebar')
    @include('partner.partials.sidebar')
@endsection

@section('content')
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
                        <th class="px-5 py-4">Date</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[color:var(--border-subtle)]">
                    @forelse($quotations as $q)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-5 py-4 font-mono text-xs t-primary font-semibold">{{ $q->reference_number ?? ('#' . $q->id) }}</td>
                            <td class="px-5 py-4 t-secondary">{{ $q->company?->name ?? '—' }}</td>
                            <td class="px-5 py-4 t-primary font-medium">{{ $q->customer?->name ?? '—' }}</td>
                            <td class="px-5 py-4 t-secondary text-xs">{{ $q->location ?: '—' }}</td>
                            <td class="px-5 py-4 text-right t-primary font-semibold tabular-nums">₹{{ number_format((float) $q->grand_total, 2) }}</td>
                            <td class="px-5 py-4">
                                @if($q->sent_email)
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-emerald-500/10 px-2 py-0.5 text-[11px] font-medium text-emerald-600 dark:text-emerald-400">Sent</span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-amber-500/10 px-2 py-0.5 text-[11px] font-medium text-amber-600 dark:text-amber-400">Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-[11px] t-muted tabular-nums whitespace-nowrap">{{ $q->created_at?->format('d M Y') }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center justify-end gap-2">
                                    <a href="{{ route('partner.quotations.show', $q) }}" class="inline-flex rounded-lg border border-theme bg-white/5 px-2.5 py-1.5 text-[11px] font-semibold t-secondary hover:bg-white/10 transition">View</a>
                                    <a href="{{ route('partner.quotations.pdf', $q) }}" target="_blank" class="inline-flex rounded-lg border border-theme bg-white/5 px-2.5 py-1.5 text-[11px] font-semibold text-solar-600 dark:text-solar-400 hover:bg-white/10 transition">PDF</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-6 py-16 text-center t-faint text-sm">No quotations yet for your customers.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($quotations->hasPages())
        <div class="mt-5">{{ $quotations->links() }}</div>
    @endif
@endsection
