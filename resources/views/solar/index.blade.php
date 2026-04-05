@extends('layouts.app')

@section('content')

<!-- Header Overlay -->
<div class="bg-[#2A3B4C] py-20 border-b-4 border-solarGreen relative overflow-hidden">
    <!-- Abstract pattern -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#2ECC71 1px, transparent 1px); background-size: 30px 30px;"></div>
    
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-heading font-black text-white tracking-tight mb-4 drop-shadow-md">Our <span class="text-solarGreen">Solar Store</span></h1>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto">Browse our premium collection of ALMM approved solar panels, smart inverters, and accessories.</p>
    </div>
</div>

<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8">
        
        <!-- Search and Filters Section -->
        <div class="mb-12 flex flex-col md:flex-row justify-between items-center gap-6">
            
            <!-- Filters -->
            <div class="flex flex-wrap gap-3 items-center">
                <a href="{{ route('solar-products.index') }}" 
                   class="px-6 py-2 rounded-full font-medium transition-all shadow-sm {{ request('category') ? 'bg-white text-navyBlue border border-gray-200 hover:border-solarGreen hover:text-solarGreen' : 'bg-solarGreen text-white shadow-md transform hover:scale-105' }}">
                    All
                </a>
                
                @php
                    $categories = \App\Models\SolarProduct::select('category')->distinct()->pluck('category');
                @endphp
                
                @foreach($categories as $cat)
                    <a href="{{ route('solar-products.index', ['category' => $cat]) }}" 
                       class="px-6 py-2 rounded-full font-medium transition-all shadow-sm {{ request('category') === $cat ? 'bg-solarGreen text-white shadow-md transform hover:scale-105' : 'bg-white text-navyBlue border border-gray-200 hover:border-solarGreen hover:text-solarGreen' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('solar-products.index') }}" method="GET" class="w-full md:w-96 relative">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." 
                       class="w-full pl-5 pr-12 py-3 rounded-full border-gray-200 shadow-sm focus:border-solarGreen focus:ring focus:ring-solarGreen focus:ring-opacity-50 text-navyBlue font-medium transition-shadow">
                <button type="submit" class="absolute right-2 top-1.5 w-10 h-10 bg-solarGreen text-white rounded-full flex items-center justify-center hover:bg-deepGreen transition-colors shadow-md">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col relative h-full transform hover:-translate-y-1">
                    
                    <!-- Top Category Pill -->
                    <div class="absolute top-8 right-8 bg-solarOrange/10 text-solarOrange text-xs font-black px-3 py-1 rounded-full z-10">{{ strtoupper($product->category) }}</div>
                    
                    <!-- Image -->
                    <div class="relative h-56 rounded-2xl bg-gray-50 mb-5 overflow-hidden flex items-center justify-center group">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-24 h-24 text-gray-200">
                                <svg fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="flex flex-col flex-grow">
                        <h2 class="text-xl font-heading font-bold text-navyBlue mb-3 leading-tight">{{ $product->name }}</h2>
                        
                        <!-- Specs Checkmarks -->
                        <div class="mb-5 flex-grow space-y-2">
                            @if($product->short_description)
                                <div class="flex gap-2 items-start opacity-80">
                                    <svg class="h-5 w-5 text-solarGreen shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-sm text-navyBlue">{{ $product->short_description }}</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Action Bar -->
                        <div class="flex items-end justify-between pt-4 border-t border-gray-100 mt-auto">
                            <div>
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block mb-1">Price</span>
                                <span class="text-2xl font-black text-solarGreen">{{ $product->price ?: 'On Request' }}</span>
                            </div>
                            <button class="w-12 h-12 bg-[#2C3E50] text-white rounded-xl flex items-center justify-center hover:bg-solarGreen transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navyBlue mb-2">No products found</h3>
                    <p class="text-gray-500 max-w-md mx-auto">We couldn't find anything matching your criteria. Try adjusting your filters or search term.</p>
                    <a href="{{ route('solar-products.index') }}" class="inline-block mt-6 px-6 py-3 bg-solarGreen text-white font-bold rounded-lg hover:bg-deepGreen transition-colors">Clear All Filters</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection
