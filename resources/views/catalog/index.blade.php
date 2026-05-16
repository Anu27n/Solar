@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main class="min-h-screen bg-obsidian">
    <section class="marketing-section-bg border-b border-white/[0.06] py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-solarGreen mb-2">Product catalog</p>
            <h1 class="text-3xl sm:text-4xl font-black font-heading text-white tracking-tight">Items by company</h1>
            <p class="mt-3 text-white/50 text-sm max-w-2xl">Equipment and product lines for UPK Electrical, UPR Solar, and UP Refrigeration &amp; Sales Co. Listings and stock are maintained by our team; contact us for firm quotations.</p>

            <form method="GET" action="{{ route('catalog.index') }}" class="mt-8 flex flex-wrap items-center gap-3">
                <label class="text-xs text-white/40 font-bold uppercase tracking-wider">Company</label>
                <select name="company" onchange="this.form.submit()" class="rounded-xl bg-white/[0.06] border border-white/10 text-white text-sm px-4 py-2.5 min-w-[200px]">
                    <option value="all" @selected(request('company', 'all') === 'all')>All companies</option>
                    @foreach($companies as $c)
                        <option value="{{ $c->code }}" @selected(request('company') === $c->code)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </section>

    <section class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($items as $item)
                    <article class="bg-white/[0.03] rounded-2xl border border-white/[0.06] p-6 flex flex-col">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-solarGreen/90 mb-2">{{ $item->company->name }}</p>
                        <h2 class="text-lg font-bold text-white font-heading leading-snug">{{ $item->name }}</h2>
                        @if($item->description)
                            <p class="mt-2 text-sm text-white/45 leading-relaxed flex-1">{{ \Illuminate\Support\Str::limit($item->description, 220) }}</p>
                        @endif
                        <dl class="mt-4 space-y-1 text-xs text-white/50">
                            @if($item->sku)
                                <div><span class="text-white/30">SKU</span> {{ $item->sku }}</div>
                            @endif
                            <div><span class="text-white/30">Unit</span> {{ $item->unit }}</div>
                            @if($item->list_price !== null)
                                <div class="text-solarGreen font-semibold text-sm">₹{{ number_format((float) $item->list_price, 2) }} <span class="text-white/30 font-normal text-xs">(indicative)</span></div>
                            @endif
                            <div><span class="text-white/30">Availability</span> In stock: {{ $item->stock_quantity }}</div>
                        </dl>
                        <a href="{{ route('contact') }}" class="mt-5 inline-flex justify-center rounded-xl bg-solarGreen/15 border border-solarGreen/30 text-solarGreen text-xs font-bold uppercase tracking-wider py-2.5 hover:bg-solarGreen/25 transition">Request quote</a>
                    </article>
                @empty
                    <p class="text-white/40 col-span-full text-center py-16">No catalog items published yet. Please check back soon.</p>
                @endforelse
            </div>
            <div class="mt-10 flex justify-center">{{ $items->links() }}</div>
        </div>
    </section>
</main>
@endsection
