@extends('layouts.dashboard')

@section('title', 'Quotation Management')
@section('page-title', 'Quotation Management')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('header-actions')
    <a href="{{ route('admin.quotations.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 transition hover:bg-solar-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Create Quotation
    </a>
@endsection

@section('content')
    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Package</th>
                        <th class="px-6 py-4">Total Price</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">WhatsApp</th>
                        <th class="px-6 py-4">SMS</th>
                        <th class="px-6 py-4">Created By</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($quotations as $quotation)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-6 py-4 font-medium t-primary">{{ $quotation->customer->name ?? '—' }}</td>
                            <td class="px-6 py-4 t-secondary">{{ $quotation->package->name ?? '—' }}</td>
                            <td class="px-6 py-4 t-secondary tabular-nums">₹{{ number_format($quotation->total_price, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($quotation->email_sent)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-600 dark:text-emerald-400"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 dark:text-gray-600"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($quotation->whatsapp_sent)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-600 dark:text-emerald-400"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 dark:text-gray-600"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($quotation->sms_sent)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-600 dark:text-emerald-400"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 dark:text-gray-600"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                @endif
                            </td>
                            <td class="px-6 py-4 t-muted">{{ $quotation->createdBy->name ?? '—' }}</td>
                            <td class="px-6 py-4 t-muted tabular-nums">{{ $quotation->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                @unless($quotation->email_sent)
                                    <form method="POST" action="{{ route('admin.quotations.send', $quotation) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold text-solar-600 dark:text-solar-400 hover:bg-white/10 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                            Send Email
                                        </button>
                                    </form>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center t-faint">No quotations yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($quotations->hasPages())
        <div class="mt-6 border-t border-subtle pt-6 flex flex-wrap items-center justify-center gap-2 sm:justify-end">
            {{ $quotations->links() }}
        </div>
    @endif
@endsection
