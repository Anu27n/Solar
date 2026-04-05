@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <a href="{{ route('solar-products.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors mb-8 group">
            <span class="p-1 rounded-full bg-white shadow-sm border border-slate-100 mr-2 group-hover:border-emerald-100 group-hover:bg-emerald-50 transition-colors">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </span>
            Return to Inventory
        </a>

        <article class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Media Section -->
                <div class="w-full lg:w-1/2 bg-slate-50 relative min-h-[400px] flex items-center justify-center p-8">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-w-full max-h-[500px] object-contain drop-shadow-xl z-10 hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="flex flex-col items-center justify-center text-slate-300">
                            <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-semibold uppercase tracking-widest text-slate-400">Image Missing</span>
                        </div>
                    @endif
                </div>
                
                <!-- Content Section -->
                <div class="w-full lg:w-1/2 p-10 lg:p-14 flex flex-col">
                    <div class="flex items-center gap-3 mb-6">
                        @if($product->category)
                            <span class="px-3 py-1 bg-slate-900 text-white text-xs font-bold uppercase tracking-wider rounded-md">
                                {{ $product->category }}
                            </span>
                        @endif
                        <span class="text-xs text-slate-400 font-medium tracking-wide">
                            Scraped: {{ $product->scraped_at ? $product->scraped_at->format('M j, Y') : 'Unknown' }}
                        </span>
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                        {{ $product->name }}
                    </h1>
                    
                    @if($product->short_description)
                        <p class="text-lg text-emerald-700 font-medium mb-6">
                            {{ $product->short_description }}
                        </p>
                    @endif
                    
                    @if($product->price)
                        <div class="mb-10 block">
                            <span class="text-3xl font-black text-slate-900 bg-emerald-50 px-4 py-2 rounded-xl text-emerald-800 tracking-tight">{{ $product->price }}</span>
                        </div>
                    @endif

                    <div class="prose prose-slate prose-lg max-w-none text-slate-600 mb-12">
                        @if($product->description)
                            {!! nl2br(e($product->description)) !!}
                        @else
                            <p class="italic text-slate-400">Full specification sheet not extracted.</p>
                        @endif
                    </div>

                    <div class="mt-auto bg-slate-50 border border-slate-100 rounded-2xl p-6">
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Distributor</h3>
                        <p class="text-sm text-slate-700 font-medium whitespace-pre-line mb-6">
                            {{ $product->contact_info }}
                        </p>
                        
                        @if($product->source_url)
                            <a href="{{ $product->source_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center bg-slate-900 hover:bg-emerald-600 text-white font-bold py-3.5 px-6 rounded-xl transition duration-300 group">
                                View Original Listing
                                <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </article>
    </div>
</main>
@endsection
