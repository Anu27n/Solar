@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[90vh] md:h-[600px] lg:h-[750px] flex items-center justify-center overflow-hidden bg-navyBlue">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=2000&q=80" alt="Solar Panels Hero" class="w-full h-full object-cover animate-ken-burns opacity-70">
        <div class="absolute inset-0 bg-blue-900/60 bg-gradient-to-b from-transparent via-blue-900/30 to-navyBlue"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center px-4 max-w-5xl mx-auto flex flex-col items-center animate-fade-in-up mt-12 md:mt-24">
        <h1 class="text-white font-heading font-black text-5xl md:text-7xl lg:text-8xl leading-tight mb-2 drop-shadow-xl tracking-tight">
            Powering India with
            <span class="block text-solarGreen tracking-tight">Clean Energy</span>
        </h1>
        
        <p class="text-gray-100 text-lg md:text-2xl mb-12 max-w-3xl drop-shadow-lg font-medium tracking-wide">
            MNRE & ISO Certified | 10+ Years Experience | Trusted by Kanpur & Uttar Pradesh. Reduce your electricity bills today with U.P.R. Solar Green Energy™.
        </p>

        <div class="flex flex-col sm:flex-row gap-5 items-center justify-center w-full max-w-2xl px-4">
            <a href="#contact" class="w-full sm:w-auto bg-solarOrange hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-xl transition-all shadow-lg shadow-orange-500/30 transform hover:-translate-y-1 hover:scale-105 text-center text-lg drop-shadow-sm whitespace-nowrap">
                Get Free Solar Consultation
            </a>
            <a href="{{ route('solar-products.index') }}" class="w-full sm:w-auto border-2 border-solarGreen text-solarGreen hover:bg-solarGreen hover:text-white font-bold py-4 px-8 rounded-xl transition-all shadow-lg shadow-green-500/20 transform hover:-translate-y-1 hover:scale-105 text-center text-lg whitespace-nowrap bg-gray-900/40 backdrop-blur-sm">
                Shop Solar Products
            </a>
        </div>
    </div>
</div>

<!-- Certification Bar -->
<div class="bg-lightEco py-12 border-t border-b border-green-100 z-20 relative shadow-sm">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-lightEco text-solarGreen rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-navyBlue">ISO Certified</h4>
                    <p class="text-xs text-gray-500">9001:2015 Standards</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-lightEco text-solarGreen rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-navyBlue">MNRE Approved</h4>
                    <p class="text-xs text-gray-500">Channel Partner</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-lightEco text-solarGreen rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-navyBlue">Tier-1 ALMM</h4>
                    <p class="text-xs text-gray-500">Premium Panels</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-lightEco text-solarGreen rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-navyBlue">25 Year Warranty</h4>
                    <p class="text-xs text-gray-500">Performance Guarantee</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Best Selling Products Carousel Placeholder -->
<div class="py-20 bg-gray-50">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-sm font-bold text-solarOrange uppercase tracking-wider mb-2">Our Store</h2>
            <h3 class="text-4xl lg:text-5xl font-heading font-bold text-navyBlue pb-2">Best Selling Products</h3>
            <div class="w-24 h-1.5 bg-solarGreen mx-auto rounded-full mt-4"></div>
        </div>

        @php
           $products = \App\Models\SolarProduct::whereIn('category', ['Solar Panels', 'Inverters'])->take(4)->get();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div class="bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 flex flex-col relative h-full transform hover:-translate-y-2">
                    <div class="absolute top-4 right-4 bg-solarOrange/10 text-solarOrange text-xs font-bold px-4 py-1.5 rounded-full z-10 backdrop-blur-sm shadow-sm">{{ strtoupper($product->category) }}</div>
                    
                    <div class="relative h-64 overflow-hidden rounded-t-[2rem] bg-gray-50 flex items-center justify-center p-4">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-32 h-32 text-gray-200">
                                <svg fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-heading font-bold text-navyBlue mb-3 leading-tight group-hover:text-solarGreen transition-colors">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-6 flex-grow line-clamp-3 leading-relaxed">{{ $product->short_description ?: Str::limit($product->description, 100) }}</p>
                        
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                            <div>
                                <span class="text-xs text-gray-400 font-medium block mb-0.5">Price</span>
                                <span class="text-xl font-bold text-solarGreen">{{ $product->price ?: 'Contact Us' }}</span>
                            </div>
                            <a href="#" class="w-12 h-12 bg-lightEco text-solarGreen rounded-2xl flex items-center justify-center hover:bg-solarGreen hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-16 text-center">
            <a href="{{ route('solar-products.index') }}" class="inline-flex items-center justify-center gap-2 border-2 border-slate-200 hover:border-solarGreen text-navyBlue hover:text-solarGreen px-10 py-4 rounded-xl font-bold text-lg hover:shadow-lg transition-all transform hover:-translate-y-1">
                View All Products
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</div>

<!-- Services Card Overhang Section -->
<div class="bg-navyBlue relative pt-24 pb-48 px-4" id="services">
    <div class="text-center mb-16 relative z-10">
        <h2 class="text-sm font-bold text-solarOrange uppercase tracking-wider mb-2">Capabilities</h2>
        <h3 class="text-4xl lg:text-5xl font-heading font-bold text-white pb-2">Our Services</h3>
        <div class="w-24 h-1.5 bg-solarGreen mx-auto rounded-full mt-4"></div>
    </div>
    
    <!-- Abstract pattern -->
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#2ECC71 1px, transparent 1px); background-size: 30px 30px;"></div>
</div>

<div class="max-w-[1400px] mx-auto px-4 lg:px-8 -mt-36 relative z-20 pb-24">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Service Card 1 -->
        <div class="bg-white rounded-[2rem] p-8 shadow-xl hover:shadow-2xl transition-shadow border border-gray-50 flex flex-col items-center text-center group">
            <div class="w-20 h-20 bg-lightEco rounded-2xl flex items-center justify-center mb-8 transform group-hover:scale-110 group-hover:bg-solarGreen transition-all duration-300 shadow-md">
                <svg class="w-10 h-10 text-solarGreen group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <h4 class="text-xl font-heading font-bold text-navyBlue mb-4">Residential Rooftop</h4>
            <p class="text-gray-500 mb-6 flex-grow leading-relaxed">Turnkey installations for homes. Offset up to 100% of your electricity bill and increase your property value.</p>
            <a href="#" class="text-solarGreen font-bold flex items-center gap-2 hover:gap-4 transition-all">Learn More <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
        </div>
        <!-- Service Card 2 -->
        <div class="bg-white rounded-[2rem] p-8 shadow-xl hover:shadow-2xl transition-shadow border border-gray-50 flex flex-col items-center text-center group">
            <div class="w-20 h-20 bg-lightEco rounded-2xl flex items-center justify-center mb-8 transform group-hover:scale-110 group-hover:bg-solarGreen transition-all duration-300 shadow-md">
                <svg class="w-10 h-10 text-solarGreen group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h4 class="text-xl font-heading font-bold text-navyBlue mb-4">Commercial Plants</h4>
            <p class="text-gray-500 mb-6 flex-grow leading-relaxed">Large-scale solar parks and industrial roof solutions for factories, hospitals, and educational institutes.</p>
            <a href="#" class="text-solarGreen font-bold flex items-center gap-2 hover:gap-4 transition-all">Learn More <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
        </div>
        <!-- Service Card 3 -->
        <div class="bg-white rounded-[2rem] p-8 shadow-xl hover:shadow-2xl transition-shadow border border-gray-50 flex flex-col items-center text-center group">
            <div class="w-20 h-20 bg-lightEco rounded-2xl flex items-center justify-center mb-8 transform group-hover:scale-110 group-hover:bg-solarGreen transition-all duration-300 shadow-md">
                <svg class="w-10 h-10 text-solarGreen group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h4 class="text-xl font-heading font-bold text-navyBlue mb-4">Maintenance & AMC</h4>
            <p class="text-gray-500 mb-6 flex-grow leading-relaxed">Comprehensive Annual Maintenance Contracts including panel cleaning, inverter diagnostics, and repairs.</p>
            <a href="#" class="text-solarGreen font-bold flex items-center gap-2 hover:gap-4 transition-all">Learn More <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
        </div>
        <!-- Service Card 4 -->
        <div class="bg-white rounded-[2rem] p-8 shadow-xl hover:shadow-2xl transition-shadow border border-gray-50 flex flex-col items-center text-center group">
            <div class="w-20 h-20 bg-lightEco rounded-2xl flex items-center justify-center mb-8 transform group-hover:scale-110 group-hover:bg-solarGreen transition-all duration-300 shadow-md">
                <svg class="w-10 h-10 text-solarGreen group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h4 class="text-xl font-heading font-bold text-navyBlue mb-4">Solar Consultation</h4>
            <p class="text-gray-500 mb-6 flex-grow leading-relaxed">Free site survey and ROI calculation helping you choose the best on-grid or off-grid solar system.</p>
            <a href="#" class="text-solarGreen font-bold flex items-center gap-2 hover:gap-4 transition-all">Learn More <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
        </div>
    </div>
</div>

<!-- Featured Projects -->
<div class="py-16 bg-white overflow-hidden">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-sm font-bold text-solarOrange uppercase tracking-wider mb-2">Our Portfolio</h2>
            <h3 class="text-4xl lg:text-5xl font-heading font-bold text-navyBlue pb-2">Completed Projects</h3>
            <div class="w-24 h-1.5 bg-solarGreen mx-auto rounded-full mt-4"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Project 1 -->
            <div class="relative group h-[400px] rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all">
                <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-navyBlue via-navyBlue/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 w-full p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                    <span class="text-solarGreen font-bold tracking-wide uppercase text-xs mb-2 block">KANPUR, UP</span>
                    <h4 class="text-2xl font-heading font-bold text-white mb-2">Sharma Residency</h4>
                    <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100">5kW Rooftop • Residential installation saving ₹6,000/month.</p>
                </div>
            </div>
            <!-- Project 2 -->
            <div class="relative group h-[400px] rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all">
                <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-navyBlue via-navyBlue/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 w-full p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                    <span class="text-solarGreen font-bold tracking-wide uppercase text-xs mb-2 block">LUCKNOW, UP</span>
                    <h4 class="text-2xl font-heading font-bold text-white mb-2">Green Valley School</h4>
                    <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100">50kW Plant • Full campus powered by green energy.</p>
                </div>
            </div>
            <!-- Project 3 -->
            <div class="relative group h-[400px] rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all">
                <img src="https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-navyBlue via-navyBlue/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 w-full p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                    <span class="text-solarGreen font-bold tracking-wide uppercase text-xs mb-2 block">UNNAO, UP</span>
                    <h4 class="text-2xl font-heading font-bold text-white mb-2">Tiwari Cold Storage</h4>
                    <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100">100kW Industrial • High-capacity plant for industrial cooling needs.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
