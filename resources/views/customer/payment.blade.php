@extends('layouts.dashboard')

@section('title', 'Make a Payment')
@section('page-title', 'Make a Payment')
@section('page-subtitle', 'Pay securely via Razorpay')

@section('sidebar')
    <a href="{{ route('customer.dashboard') }}" class="sidebar-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
        Dashboard
    </a>
    <a href="{{ route('customer.payment.create') }}" class="sidebar-link {{ request()->routeIs('customer.payment.*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
        Make Payment
    </a>
@endsection

@section('content')
    <div class="max-w-5xl mx-auto space-y-6 sm:space-y-8">

        {{-- Case 1: no customer linked --}}
        @if(!$customer)
            <div class="glass rounded-2xl p-6 sm:p-10 text-center animate-fade-in max-w-lg mx-auto">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mx-auto mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="text-amber-500 dark:text-amber-400">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold t-primary">Account Not Linked</h2>
                <p class="mt-3 text-sm t-muted leading-relaxed max-w-sm mx-auto">We couldn't find a customer record linked to your account. Contact support.</p>
            </div>

        @else
            <div class="space-y-6 sm:space-y-8">

                {{-- Case 2: gateway not configured --}}
                @if(empty($razorpayKey))
                    <div class="glass rounded-2xl p-6 sm:p-8 text-center animate-fade-in max-w-2xl mx-auto">
                        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-amber-500 dark:text-amber-400"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                        </div>
                        <h2 class="text-lg font-semibold t-primary">Payment Gateway Being Configured</h2>
                        <p class="mt-2 text-sm t-muted max-w-md mx-auto leading-relaxed">The online payment gateway is currently being set up. Please check back later or contact support for alternative payment options.</p>
                    </div>

                {{-- Case 3: make a payment --}}
                @else
                    <section class="animate-fade-in">
                        <h2 class="text-xs font-semibold t-faint uppercase tracking-wider mb-3">Make a Payment</h2>
                        <div class="glass rounded-2xl overflow-hidden border border-theme">
                            <div class="px-5 sm:px-6 py-4 border-b border-subtle">
                                <p class="text-sm t-secondary">
                                    Paying as <span class="t-primary font-semibold">{{ $customer->name }}</span>
                                </p>
                            </div>
                            <div class="p-5 sm:p-6">
                                <label for="pay-amount" class="block text-xs font-semibold t-faint uppercase tracking-wider mb-2">Amount</label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-lg font-semibold t-muted">₹</span>
                                    <input
                                        type="number"
                                        id="pay-amount"
                                        name="amount_display"
                                        min="1"
                                        step="1"
                                        inputmode="numeric"
                                        placeholder="0"
                                        class="w-full rounded-xl border border-theme bg-input py-3 pl-10 pr-4 text-lg font-semibold t-primary tabular-nums placeholder:t-faint focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20"
                                    />
                                </div>
                                <button
                                    type="button"
                                    id="pay-btn"
                                    class="mt-5 w-full flex items-center justify-center gap-2.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 active:scale-[0.99] px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition-all"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                    Pay with Razorpay
                                </button>
                            </div>
                        </div>

                        <form id="payment-success-form" method="POST" action="{{ route('customer.payment.store') }}" class="hidden" aria-hidden="true">
                            @csrf
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">
                            <input type="hidden" name="amount" id="razorpay_amount" value="">
                        </form>
                    </section>
                @endif

                {{-- Payment history (linked customer — Cases 2 & 3) --}}
                <section class="animate-fade-in {{ !empty($razorpayKey) ? 'delay-1' : '' }}">
                    <h2 class="text-xs font-semibold t-faint uppercase tracking-wider mb-3">Payment History</h2>
                    <div class="stat-card rounded-2xl p-0 overflow-hidden border border-theme">
                        @if($payments->isEmpty())
                            <div class="px-6 py-14 sm:py-16 text-center border border-dashed border-subtle rounded-2xl m-4 bg-input/30">
                                <p class="text-sm t-muted">No payments yet</p>
                            </div>
                        @else
                            <div class="overflow-x-auto -mx-px">
                                <table class="min-w-full text-left text-sm">
                                    <thead>
                                        <tr class="border-b border-theme bg-input/40">
                                            <th scope="col" class="px-4 sm:px-5 py-3 font-semibold t-faint text-[11px] uppercase tracking-wide whitespace-nowrap">Date</th>
                                            <th scope="col" class="px-4 sm:px-5 py-3 font-semibold t-faint text-[11px] uppercase tracking-wide whitespace-nowrap">Amount</th>
                                            <th scope="col" class="px-4 sm:px-5 py-3 font-semibold t-faint text-[11px] uppercase tracking-wide whitespace-nowrap">Method</th>
                                            <th scope="col" class="px-4 sm:px-5 py-3 font-semibold t-faint text-[11px] uppercase tracking-wide whitespace-nowrap">Status</th>
                                            <th scope="col" class="px-4 sm:px-5 py-3 font-semibold t-faint text-[11px] uppercase tracking-wide whitespace-nowrap">Transaction ID</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[var(--border-subtle)]">
                                        @foreach($payments as $payment)
                                            @php
                                                $payStatus = strtolower((string) $payment->status);
                                                $statusClass = match ($payStatus) {
                                                    'completed' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border-emerald-500/25',
                                                    'pending' => 'bg-amber-500/15 text-amber-800 dark:text-amber-400 border-amber-500/25',
                                                    'failed' => 'bg-red-500/15 text-red-700 dark:text-red-400 border-red-500/25',
                                                    'refunded' => 'bg-slate-500/15 t-secondary border-theme',
                                                    default => 'bg-slate-500/10 t-muted border-subtle',
                                                };
                                            @endphp
                                            <tr class="hover:bg-input/30 transition-colors">
                                                <td class="px-4 sm:px-5 py-3.5 t-secondary whitespace-nowrap tabular-nums">{{ $payment->created_at?->format('d M Y') ?? '—' }}</td>
                                                <td class="px-4 sm:px-5 py-3.5 t-primary font-semibold tabular-nums whitespace-nowrap">₹{{ number_format((float) $payment->amount, 2) }}</td>
                                                <td class="px-4 sm:px-5 py-3.5 t-secondary capitalize whitespace-nowrap">{{ $payment->method ? str_replace('_', ' ', $payment->method) : '—' }}</td>
                                                <td class="px-4 sm:px-5 py-3.5 whitespace-nowrap">
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize border {{ $statusClass }}">{{ $payment->status }}</span>
                                                </td>
                                                <td class="px-4 sm:px-5 py-3.5 t-muted font-mono text-xs max-w-[140px] sm:max-w-none truncate" title="{{ $payment->transaction_id }}">{{ $payment->transaction_id ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
@if($customer && !empty($razorpayKey))
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('pay-btn').addEventListener('click', function () {
    var amountInput = document.getElementById('pay-amount');
    var amount = parseFloat(amountInput.value);
    if (!amount || amount < 1) { amountInput.focus(); return; }
    var options = {
        key: '{{ $razorpayKey }}',
        amount: Math.round(amount * 100),
        currency: 'INR',
        name: 'U.P.R. Solar Green Energy',
        description: 'Solar Installation Payment',
        prefill: {
            name: '{{ addslashes($customer->name) }}',
            email: '{{ addslashes($customer->email ?? "") }}'
        },
        theme: { color: '#00DF82' },
        handler: function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_amount').value = amount;
            document.getElementById('payment-success-form').submit();
        }
    };
    var rzp = new Razorpay(options);
    rzp.open();
});
</script>
@endif
@endsection
