@extends('layouts.react')

@section('content')
<nav class="sticky top-0 z-[100] transition-all duration-300 px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center bg-white/70 backdrop-blur-xl border border-white/20 rounded-2xl px-6 py-3 shadow-[0_8px_32px_0_rgba(0,0,0,0.05)]">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-solarGreen rounded-lg shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
            </div>
            <span class="text-xl font-black tracking-tighter uppercase text-deepForest">U.P.R. <span class="text-solarGreen">Solar</span></span>
        </div>
        
        <div class="hidden md:flex items-center gap-8">
            @foreach(['Home' => '/', 'About' => '/about', 'Products' => '/products', 'Services' => '/services', 'Gallery' => '/gallery', 'Projects' => '/projects', 'Contact' => '/contact'] as $label => $link)
                <a href="{{ $link }}" class="text-[10px] font-black uppercase tracking-[0.2em] {{ Request::is(trim($link, '/')) || (Request::is('gallery') && $label == 'Gallery') ? 'text-solarGreen' : 'text-deepForest/60' }} hover:text-solarGreen transition-colors">{{ $label }}</a>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <a href="/products" class="p-2 text-deepForest/40 hover:text-deepForest transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            </a>
            <button class="px-6 py-2 bg-solarGreen text-deepForest font-black rounded-lg text-[10px] uppercase tracking-widest shadow-lg hover:scale-105 transition-transform">Portal</button>
        </div>
    </div>
</nav>

<main class="bg-auroraWhite">
    <!-- Gallery Hero: Visual Archive -->
    <section class="relative py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center reveal-up">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full mb-10">
                <span class="text-[10px] uppercase font-black tracking-[0.3em] text-solarGreen">Field Archive</span>
            </div>
            
            <h1 class="text-7xl md:text-9xl font-black font-heading leading-[0.85] tracking-tighter text-deepForest mb-10 uppercase">
                SOLAR <br/> <span class="italic text-solarGreen">VISION.</span>
            </h1>
            
            <p class="text-lg text-deepForest/60 max-w-2xl mx-auto leading-relaxed font-medium">
                An immersive visual collection of our most sophisticated solar deployments across the Indian landscape.
            </p>
        </div>
    </section>

    <!-- Immersive Mosaic Grid -->
    <section class="pb-32 px-6">
        <div class="max-w-7xl mx-auto columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
            @php
                $images = [
                    ['url' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200&q=80', 'title' => 'Rooftop Array', 'loc' => 'Kanpur', 'type' => 'Residential'],
                    ['url' => 'https://images.unsplash.com/photo-1611365892117-00ac5ef43c90?auto=format&fit=crop&w=1200&q=80', 'title' => 'Industrial Plant', 'loc' => 'Unnao', 'type' => 'Commercial'],
                    ['url' => 'https://images.unsplash.com/photo-1594818379496-da1e345b0ded?auto=format&fit=crop&w=1200&q=80', 'title' => 'Educational Hub', 'loc' => 'Lucknow', 'type' => 'Institutional'],
                    ['url' => 'https://images.unsplash.com/photo-1624397640148-949b1732bb0a?auto=format&fit=crop&w=1200&q=80', 'title' => 'Cold Storage', 'loc' => 'Kalyanpur', 'type' => 'Industrial'],
                    ['url' => 'https://images.unsplash.com/photo-1613665813446-82a78c468a1d?auto=format&fit=crop&w=1200&q=80', 'title' => 'Smart Inverters', 'loc' => 'Technical Lab', 'type' => 'Grid Tech'],
                    ['url' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=1200&q=80', 'title' => 'Bifacial Units', 'loc' => 'Panki', 'type' => 'Bifacial'],
                    ['url' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e2?auto=format&fit=crop&w=1200&q=80', 'title' => 'Water Heating', 'loc' => 'Barra', 'type' => 'Thermal'],
                    ['url' => 'https://images.unsplash.com/photo-1558449028-b53a39d100fc?auto=format&fit=crop&w=1200&q=80', 'title' => 'Agriculture Pumps', 'loc' => 'Bilhaur', 'type' => 'Agri-Tech'],
                    ['url' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80', 'title' => 'Maintenance', 'loc' => 'Site Visit', 'type' => 'Service']
                ];
            @endphp

            @foreach($images as $img)
                <div class="break-inside-avoid relative rounded-[2rem] overflow-hidden group shadow-xl border border-deepForest/5 bg-white transition-all duration-700 hover:-translate-y-2 hover:shadow-2xl">
                    <img src="{{ $img['url'] }}" class="w-full h-auto object-cover transition-transform duration-1000 group-hover:scale-105" alt="{{ $img['title'] }}">
                    
                    <!-- Overlay HUB -->
                    <div class="absolute inset-0 bg-gradient-to-t from-deepForest/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <!-- Glass Technical Tag -->
                    <div class="absolute top-6 left-6 px-4 py-2 bg-white/20 backdrop-blur-md border border-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 translate-y-4 group-hover:translate-y-0 text-[9px] font-black uppercase tracking-widest text-white shadow-xl">
                        {{ $img['type'] }}
                    </div>

                    <!-- Information Cluster -->
                    <div class="absolute bottom-8 left-8 right-8 opacity-0 group-hover:opacity-100 transition-all duration-500 delay-200 translate-y-6 group-hover:translate-y-0">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-8 h-[2px] bg-solarGreen rounded-full"></span>
                            <span class="text-[9px] font-black text-solarGreen uppercase tracking-[0.3em]">{{ $img['loc'] }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-white tracking-tighter uppercase">{{ $img['title'] }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Cinematic Final Statement -->
    <section class="py-32 bg-deepForest text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_40%,rgba(0,223,130,0.1),transparent_60%)]"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 space-y-10 reveal-up">
            <h2 class="text-4xl md:text-5xl font-bold font-heading text-white tracking-tighter leading-tight uppercase italic">
                Witness the <br/>
                <span class="text-solarGreen">Revolution.</span>
            </h2>
            <p class="text-lg text-white/40 font-medium leading-relaxed max-w-2xl mx-auto">
                Join thousands of stakeholders across India participating in the grid modernization era.
            </p>
            <div class="pt-8">
                <a href="/contact" class="inline-flex items-center gap-6 text-white font-black uppercase tracking-[0.3em] group text-[11px] hover:text-solarGreen transition-colors">
                    Start Your Project <span class="w-12 h-[2px] bg-solarGreen transition-all group-hover:w-24"></span>
                </a>
            </div>
        </div>
    </section>
</main>

<footer class="bg-deepForest py-32 relative overflow-hidden text-white border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-4 gap-20">
        <div class="lg:col-span-1 space-y-10">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-solarGreen rounded-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                </div>
                <span class="text-xl font-black tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
            </div>
            <p class="text-base font-bold text-white/40 leading-relaxed">MNRE & ISO Certified Solar Infrastructure. <br/> Engineering India's Future since 2013.</p>
        </div>
        <div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Headquarters</h4>
            <p class="text-base font-bold text-white/70 leading-relaxed">Near IIT Metro Station, Kanpur - 208016</p>
        </div>
        <div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Communications</h4>
            <ul class="space-y-6 text-base font-bold text-white/70">
                <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors flex items-center gap-3">+91-9412452844</a></li>
                <li><a href="mailto:info@uprsolar.com" class="hover:text-solarGreen transition-colors flex items-center gap-3">info@uprsolar.com</a></li>
            </ul>
        </div>
        <div class="space-y-6">
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Status</h4>
            <div class="p-6 bg-white/5 rounded-3xl border border-white/5">
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-2 h-2 bg-solarGreen rounded-full animate-pulse-glow"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white">GRID ACTIVE</span>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-32 pt-12 border-t border-white/5 text-[10px] font-black text-white/20 uppercase tracking-[0.5em] text-center">
        © 2026 U.P.R. Solar Green Energy™
    </div>
</footer>
@endsection
