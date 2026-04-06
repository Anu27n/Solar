@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main class="marketing-atmosphere relative">
@include('partials.marketing-page-atmosphere', [
    'marketingAtmosphereImage' => 'https://images.unsplash.com/photo-1613665813446-82a78c468a1d?auto=format&fit=crop&w=1920&q=80',
    'marketingAtmospherePosition' => 'center 48%',
])
<div class="relative z-10">
    <!-- Product Hero -->
    <section class="relative py-16 md:py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-8 lg:gap-12 items-center relative">
            <div class="text-left reveal-left space-y-8 sm:space-y-10">
                <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full border border-solarGreen/10">
                    <span class="text-[11px] uppercase font-bold tracking-[0.3em] text-solarGreen">Precision Hardware</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-black font-heading leading-[0.85] tracking-tighter text-white uppercase drop-shadow-sm">
                    SOLAR <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-400 drop-shadow-[0_0_25px_rgba(0,223,130,0.4)] italic">STORE.</span>
                </h1>
                
                <p class="text-base text-white/50 max-w-xl leading-relaxed font-medium border-l-4 border-solarGreen/20 pl-6">
                    Tier-1 engineering components approved for high-efficiency grid participation. <br/> Premium grade panels, inverters, and storage solutions.
                </p>
            </div>

            <div class="order-3 lg:order-none col-span-full lg:col-span-1 flex justify-center lg:hidden reveal-scale">
                <div class="relative w-full max-w-sm">
                    <img src="/assets/images/products/hero-panel.png"
                         class="w-full h-auto max-h-[240px] object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.25)] animate-float"
                         alt="Premium solar panel">
                    <div class="absolute -right-1 top-4 p-3 bg-white/[0.08] backdrop-blur-xl border border-white/10 rounded-xl shadow-xl text-right animate-float-slow">
                        <div class="text-[9px] font-bold uppercase text-solarGreen tracking-widest">Efficiency</div>
                        <div class="text-lg font-bold text-white tracking-tighter">23.8%</div>
                    </div>
                </div>
            </div>

            <!-- Floating Asset -->
            <div class="relative hidden lg:flex justify-center reveal-right">
                <div class="relative z-10 group cursor-default">
                    <img src="/assets/images/products/hero-panel.png" 
                         class="w-full h-auto drop-shadow-[0_20px_50px_rgba(0,0,0,0.1)] group-hover:scale-105 transition-transform duration-1000 animate-float" 
                         alt="Premium Solar Asset">
                    
                    <div class="absolute -top-4 -right-4 p-4 bg-white/[0.08] backdrop-blur-xl border border-white/10 rounded-2xl shadow-xl animate-float-slow">
                        <div class="text-[10px] font-bold uppercase text-solarGreen tracking-widest">Efficiency</div>
                        <div class="text-xl font-bold text-white tracking-tighter">23.8%</div>
                    </div>
                </div>
                <!-- Back Glow -->
                <div class="absolute inset-0 bg-solarGreen/20 blur-[120px] rounded-full -z-10 scale-75 animate-pulse-glow"></div>
            </div>
        </div>
    </section>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(-1deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; transform: scale(0.7); }
            50% { opacity: 0.8; transform: scale(0.9); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 5s ease-in-out infinite; }
    </style>

    <!-- Interactive Category Filter -->
    <section class="marketing-section-bg border-t border-white/[0.06] py-10 sm:py-12 sm:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 overflow-x-auto [-webkit-overflow-scrolling:touch] snap-x snap-mandatory">
            <div class="flex justify-start sm:justify-center gap-2 sm:gap-3 min-w-min pb-4" id="category-filter-bar">
                <button type="button" onclick="filterProducts('All')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-solarGreen text-deepForest shadow-lg" data-category="All">All</button>
                <button type="button" onclick="filterProducts('Solar Panels')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Solar Panels">Solar Panels</button>
                <button type="button" onclick="filterProducts('Inverters')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Inverters">Inverters</button>
                <button type="button" onclick="filterProducts('Batteries')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Batteries">Batteries</button>
                <button type="button" onclick="filterProducts('Water Heaters')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Water Heaters">Water Heaters</button>
                <button type="button" onclick="filterProducts('Lighting')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Lighting">Lighting</button>
                <button type="button" onclick="filterProducts('Agriculture')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Agriculture">Agriculture</button>
                <button type="button" onclick="filterProducts('Accessories')" class="category-btn snap-start shrink-0 px-6 sm:px-8 py-3 min-h-[44px] rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-widest transition-all bg-white/[0.03] text-white/40 border border-white/[0.06] hover:border-solarGreen/40" data-category="Accessories">Accessories</button>
            </div>
        </div>
    </section>

    <!-- Standardized Product Grid -->
    <section class="marketing-section-bg border-t border-white/[0.06] py-10 pb-16 sm:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 stagger-children" id="product-grid">
            @php
                $products = [
                    [
                        "name" => "Mono PERC Solar Panel 540W",
                        "description" => "High-efficiency half-cut for Indian climate.",
                        "image_url" => "/assets/images/products/mono-panel.png",
                        "category" => "Solar Panels",
                        "price" => "₹14,500",
                        "stat" => "22% Eff."
                    ],
                    [
                        "name" => "Bifacial Solar Panel 550W",
                        "description" => "Dual-side power generation for max yield.",
                        "image_url" => "/assets/images/products/bifacial-panel.png",
                        "category" => "Solar Panels",
                        "price" => "₹16,000",
                        "stat" => "Double Glass"
                    ],
                    [
                        "name" => "Solar Hybrid Inverter 5kVA",
                        "description" => "IoT Enabled pure sine wave system.",
                        "image_url" => "/assets/images/products/hybrid-inverter.png",
                        "category" => "Inverters",
                        "price" => "₹45,000",
                        "stat" => "98% Eff."
                    ],
                    [
                        "name" => "LFP Battery Unit",
                        "description" => "Long-life storage for solar systems.",
                        "image_url" => "/assets/images/products/lithium-battery.png",
                        "category" => "Batteries",
                        "price" => "₹32,000",
                        "stat" => "5000+ Cycles"
                    ],
                    [
                        "name" => "Solar Water Heater 200L",
                        "description" => "High-performance vacuum ETC tech.",
                        "image_url" => "/assets/images/products/water-heater.png",
                        "category" => "Water Heaters",
                        "price" => "₹18,500",
                        "stat" => "Glass Lined"
                    ],
                    [
                        "name" => "Solar Street Light",
                        "description" => "Automatic dusk-to-dawn LED sensor.",
                        "image_url" => "/assets/images/products/street-light.png",
                        "category" => "Lighting",
                        "price" => "₹5,500",
                        "stat" => "IP65 Proof"
                    ],
                    [
                        "name" => "Solar Submersible Pump",
                        "description" => "High-power DC irrigation pump.",
                        "image_url" => "/assets/images/products/submersible-pump.png",
                        "category" => "Agriculture",
                        "price" => "₹55,000",
                        "stat" => "MPPT Drive"
                    ],
                    [
                        "name" => "Charge Controller 60A",
                        "description" => "Optimized energy harvest system.",
                        "image_url" => "/assets/images/products/charge-controller.png",
                        "category" => "Accessories",
                        "price" => "₹6,000",
                        "stat" => "LCD Display"
                    ],
                ];
            @endphp

            @foreach($products as $p)
                <div class="product-card hover-lift group bg-white/[0.03] rounded-[2rem] border border-white/[0.06] overflow-hidden transition-all duration-500 hover:shadow-2xl hover:border-solarGreen/20 flex flex-col" data-category="{{ $p['category'] }}">
                    <div class="aspect-video relative overflow-hidden bg-obsidian">
                        <img src="{{ $p['image_url'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $p['name'] }}">
                        <div class="absolute top-6 left-6 px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg text-[9px] font-bold uppercase tracking-widest text-white">In Stock</div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col space-y-4">
                        <div class="flex justify-between items-start">
                            <span class="text-[10px] font-bold text-solarGreen uppercase tracking-[0.3em]">{{ $p['category'] }}</span>
                            <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">{{ $p['stat'] }}</span>
                        </div>
                        <h3 class="text-base font-bold text-white tracking-tight leading-tight uppercase">{{ $p['name'] }}</h3>
                        <p class="text-[11px] text-white/40 font-medium uppercase tracking-widest">{{ $p['description'] }}</p>
                        
                        <div class="pt-8 mt-auto flex items-center justify-between border-t border-white/[0.06]">
                            <div class="text-xl font-black text-white tracking-tighter">{{ $p['price'] }}</div>
                            <button class="w-12 h-12 bg-white/[0.03] border border-white/[0.06] rounded-2xl flex items-center justify-center hover:bg-solarGreen hover:border-solarGreen transition-all group/btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white group-hover/btn:text-deepForest group-hover/btn:scale-110 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Bulk Order CTA -->
    <section class="pb-16 sm:pb-20 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto relative rounded-[2rem] sm:rounded-[3rem] p-8 sm:p-10 md:p-16 text-center overflow-hidden group border border-white/5 bg-deepForest shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] reveal-up">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_40%,rgba(0,223,130,0.15),transparent_60%)]"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto space-y-10">
                <h3 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-tight uppercase italic">
                    Bulk Order or <br/>
                    <span class="text-solarGreen">Custom System?</span>
                </h3>
                <p class="text-base text-white/50 font-medium leading-relaxed max-w-2xl mx-auto">
                    Access engineering-grade architectural estimates tailored for industrial-scale deployment or residential customization.
                </p>
                <div class="pt-8 sm:pt-10">
                    <a href="/contact" class="inline-flex items-center justify-center gap-4 bg-solarGreen text-deepForest w-full sm:w-auto px-8 sm:px-12 py-5 sm:py-6 min-h-[52px] rounded-[2rem] font-black uppercase tracking-widest text-[11px] shadow-[0_10px_50px_rgba(0,223,130,0.4)] hover:shadow-[0_20px_70px_rgba(0,223,130,0.6)] hover:scale-105 active:scale-95 transition-all duration-500 group/btn">
                        Get Custom Quote 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/btn:translate-x-1"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </a>
                </div>
            </div>
            <div class="absolute top-12 left-12 w-32 h-32 border-l border-t border-white/10 opacity-20"></div>
            <div class="absolute bottom-12 right-12 w-32 h-32 border-r border-b border-white/10 opacity-20"></div>
        </div>
    </section>
</div>
</main>

<footer class="bg-deepForest py-16 sm:py-20 lg:py-24 relative overflow-hidden text-white border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-10 sm:gap-12 pb-[max(0.5rem,env(safe-area-inset-bottom))]">
        <div class="space-y-6">
            <div class="flex items-center gap-2.5">
                <div class="p-1.5 bg-solarGreen rounded-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                </div>
                <span class="text-lg font-black tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
            </div>
            <p class="text-xs text-white/40 font-medium leading-relaxed">MNRE & ISO Certified Solar Infrastructure. Engineering India's Future since 2013.</p>
        </div>
        <div>
            <h4 class="text-[11px] font-bold uppercase tracking-[0.3em] text-solarGreen mb-6">Headquarters</h4>
            <p class="text-sm font-medium text-white/60 leading-relaxed">Near IIT Metro Station, Kanpur - 208016</p>
        </div>
        <div>
            <h4 class="text-[11px] font-bold uppercase tracking-[0.3em] text-solarGreen mb-6">Communications</h4>
            <ul class="space-y-4 text-sm font-medium text-white/60">
                <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors">+91-9412452844</a></li>
                <li><a href="mailto:info@uprsolar.com" class="hover:text-solarGreen transition-colors">info@uprsolar.com</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-[11px] font-bold uppercase tracking-[0.3em] text-solarGreen mb-6">Status</h4>
            <div class="p-5 bg-white/5 rounded-2xl border border-white/5">
                <div class="flex items-center gap-2.5 mb-1.5">
                    <span class="w-2 h-2 bg-solarGreen rounded-full animate-pulse-glow"></span>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-white">GRID ACTIVE</span>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16 pt-8 border-t border-white/5 text-[11px] font-medium text-white/20 uppercase tracking-wider text-center">
        © 2026 U.P.R. Solar Green Energy™
    </div>
</footer>

<script>
    function filterProducts(category) {
        const cards = document.querySelectorAll('.product-card');
        const buttons = document.querySelectorAll('.category-btn');

        buttons.forEach(btn => {
            if (btn.getAttribute('data-category') === category) {
                btn.classList.remove('bg-white/[0.03]', 'text-white/40', 'border', 'border-white/[0.06]');
                btn.classList.add('bg-solarGreen', 'text-deepForest', 'shadow-lg');
            } else {
                btn.classList.add('bg-white/[0.03]', 'text-white/40', 'border', 'border-white/[0.06]');
                btn.classList.remove('bg-solarGreen', 'text-deepForest', 'shadow-lg');
            }
        });

        cards.forEach(card => {
            card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            if (category === 'All' || card.getAttribute('data-category') === category) {
                card.style.display = 'flex';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0) scale(1)';
                }, 10);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px) scale(0.95)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 500);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.product-card');
        cards.forEach(card => {
            card.style.opacity = '1';
            card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
</script>
@endsection
