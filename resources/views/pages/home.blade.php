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
                <a href="{{ $link }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-deepForest/60 hover:text-solarGreen transition-colors">{{ $label }}</a>
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

<main>
    <!-- Solar Aurora Hero: Split Design -->
    <section class="relative min-h-[90vh] flex items-center bg-auroraWhite overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 w-full grid lg:grid-cols-2 gap-20 py-20 items-center">
            <div class="space-y-10 reveal-up">
                <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full">
                    <span class="w-2 h-2 bg-solarGreen rounded-full animate-pulse-glow"></span>
                    <span class="text-[10px] uppercase font-black tracking-[0.2em] text-solarGreen">The Future of Energy is Here</span>
                </div>
                
                <h1 class="text-7xl md:text-9xl font-black font-heading leading-[0.85] tracking-tighter text-deepForest">
                    POWERING <br/> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-600">INDIA</span> <br/>
                    WITH LIGHT.
                </h1>
                
                <p class="text-xl text-deepForest/60 max-w-lg leading-relaxed font-semibold">
                    MNRE & ISO Certified Engineering. <br/> Reducing carbon footprints and electricity bills across Uttar Pradesh since 2013.
                </p>

                <div class="flex flex-wrap gap-6 pt-4">
                    <a href="/contact" class="px-10 py-5 bg-solarGreen text-deepForest font-black rounded-2xl shadow-[0_20px_50px_rgba(0,223,130,0.3)] hover:shadow-[0_25px_60px_rgba(0,223,130,0.5)] hover:-translate-y-1 transition-all group overflow-hidden relative">
                        <span class="relative z-10 flex items-center gap-3">Get Started <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></span>
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </a>
                    <a href="/products" class="px-10 py-5 border-2 border-deepForest/10 text-deepForest font-black rounded-2xl hover:bg-deepForest hover:text-white transition-all transform hover:scale-105 active:scale-95">
                        Shop Store
                    </a>
                </div>

                <!-- Bento Quick Stats -->
                <div class="grid grid-cols-2 gap-4 pt-12">
                    <div class="p-6 bg-white rounded-3xl border border-deepForest/5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-3xl font-black text-deepForest">10Y+</div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-solarGreen">Proven Legacy</div>
                    </div>
                    <div class="p-6 bg-white rounded-3xl border border-deepForest/5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-3xl font-black text-deepForest">90%</div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-solarGreen">Bill Reduction</div>
                    </div>
                </div>
            </div>

            <!-- Hero Image / Canvas -->
            <div class="relative group">
                <div class="aspect-[4/5] rounded-[4rem] overflow-hidden shadow-2xl relative">
                    <img src="/assets/images/hero.png" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Solar Field">
                    <div class="absolute inset-0 bg-gradient-to-t from-deepForest/40 to-transparent"></div>
                    
                    <!-- Floating Data Card -->
                    <div class="absolute bottom-8 left-8 right-8 p-8 bg-white/90 backdrop-blur-xl rounded-3xl border border-white/20 shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-deepForest/40">Current Efficiency</span>
                            <span class="px-2 py-1 bg-solarGreen/20 text-solarGreen text-[10px] font-black rounded-md">OPTIMAL</span>
                        </div>
                        <div class="text-4xl font-black text-deepForest tracking-tighter">98.4%</div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full mt-4 overflow-hidden">
                            <div class="h-full bg-solarGreen w-[98.4%] rounded-full shadow-[0_0_10px_rgba(0,223,130,0.5)]"></div>
                        </div>
                    </div>
                </div>

                <!-- Abstract Shapes -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-solarGreen/10 blur-3xl rounded-full translate-x-12 translate-y-12"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-solarGreen/5 blur-3xl rounded-full -translate-x-12 -translate-y-12"></div>
            </div>
        </div>
    </section>

    <!-- Clean Certification Wall -->
    <section class="py-16 bg-white border-y border-deepForest/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 flex flex-wrap justify-center items-center gap-16 md:gap-24 grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-700">
            <span class="text-[12px] font-black uppercase tracking-[0.4em] text-deepForest">MNRE CERTIFIED</span>
            <span class="text-[12px] font-black uppercase tracking-[0.4em] text-deepForest">ISO 9001:2015</span>
            <div class="w-px h-8 bg-deepForest/10 hidden md:block"></div>
            <span class="text-[12px] font-black uppercase tracking-[0.4em] text-deepForest">UP-NEDA LICENSED</span>
            <span class="text-[12px] font-black uppercase tracking-[0.4em] text-deepForest">GOVERNMENT APPROVED</span>
        </div>
    </section>

    <!-- The 3D Hub: Refined Lab Style -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#0B0F0E 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:grid lg:grid-cols-2 items-center gap-20 relative z-10">
            <div class="space-y-8">
                <div class="w-20 h-1 bg-solarGreen rounded-full"></div>
                <h2 class="text-4xl md:text-5xl font-bold font-heading leading-tight tracking-tighter uppercase text-deepForest">
                    PRECISION <br/> 
                    <span class="text-solarGreen">ENGINEERING</span>
                </h2>
                <p class="text-lg text-deepForest/60 font-medium leading-relaxed max-w-lg">
                    Featuring our **MP-540-UPR** flagship panel. Specifically optimized for the high-intensity thermal index of North India.
                </p>
                
                <div class="pt-8 border-t border-deepForest/5">
                    <a href="/products" class="inline-flex items-center gap-6 text-deepForest font-black uppercase tracking-[0.3em] group text-[11px]">
                        Technology Reveal <span class="w-12 h-[2px] bg-solarGreen transition-all group-hover:w-24"></span>
                    </a>
                </div>
            </div>

            <!-- Panel Stage (3D) -->
            <div class="flex justify-center perspective-1000">
                <div id="solar-3d-panel" class="relative w-[320px] h-[540px] preserve-3d cursor-crosshair">
                    <!-- The Base Stage -->
                    <div class="absolute inset-0 bg-deepForest rounded-[3rem] border-4 border-white/10 shadow-[0_50px_100px_rgba(0,0,0,0.2)] overflow-hidden transition-transform duration-200">
                        <div class="w-full h-full grid grid-cols-4 grid-rows-8 gap-1.5 p-3 opacity-90">
                            @for($i = 0; $i < 32; $i++)
                                <div class="bg-solarGreen/10 border border-white/5 rounded-md shadow-inner"></div>
                            @endfor
                        </div>
                        
                        <!-- HUD Elements -->
                        <div class="absolute top-6 left-6 text-[8px] font-black tracking-widest text-white/20 uppercase">AIDA_SYSTEM_V4.2</div>
                        <div class="absolute bottom-8 right-8 flex flex-col items-end">
                            <div class="text-[8px] font-black tracking-widest text-solarGreen uppercase mb-1">OUTPUT: 540W</div>
                            <div class="text-[8px] font-black tracking-widest text-white/40 uppercase">MODEL: MP-540-UPR</div>
                        </div>
                    </div>
                    
                    <!-- Decorative Light Glares -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-solarGreen/20 blur-3xl animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Unified Premium Cluster: Products & Testimonials -->
    <div class="bg-obsidian border-t border-white/5">
        <!-- Section 1: Strictly Aligned Product Grid -->
        <section class="py-32 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full mb-6">
                            <span class="w-2 h-2 bg-solarGreen rounded-full glow-green"></span>
                            <span class="text-[10px] uppercase font-black tracking-[0.3em] text-solarGreen">Certified Ecosystem</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold font-heading text-white tracking-tighter leading-tight">
                            BEST SELLING <br/> <span class="text-solarGreen italic">SOLUTIONS.</span>
                        </h2>
                        <p class="text-white/40 mt-6 text-base font-medium max-w-lg leading-relaxed">
                            Industrial-grade solar infrastructure engineered for maximum longevity and energy yield.
                        </p>
                    </div>
                    <a href="/products" class="group px-10 py-5 bg-white/5 border border-white/10 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl hover:bg-solarGreen hover:text-obsidian transition-all duration-300">
                        View Full Catalog <span class="inline-block transition-transform group-hover:translate-x-2 ml-2">→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach([
                        ['n' => 'Mono PERC 540W', 'p' => '₹14,500', 'd' => 'Industrial half-cut technology.', 'img' => '/assets/images/product1.png'],
                        ['n' => 'Hybrid Inverter', 'p' => '₹45,000', 'd' => 'Pure sine wave smart system.', 'img' => '/assets/images/product2.png'],
                        ['n' => 'LFP Battery 100Ah', 'p' => '₹22,000', 'd' => '10-Year deep cycle storage.', 'img' => '/assets/images/product3.png'],
                        ['n' => 'Solar Heater 200L', 'p' => '₹18,500', 'd' => 'High-efficiency vacuum ETC.', 'img' => '/assets/images/product4.png']
                    ] as $p)
                        <div class="group flex flex-col h-full bg-obsidianLight border border-white/5 rounded-[2.5rem] p-10 hover:border-solarGreen/30 transition-all duration-500 shadow-2xl relative overflow-hidden">
                            <div class="aspect-square rounded-[2rem] overflow-hidden mb-8 bg-black/40 relative">
                                <img src="{{ $p['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $p['n'] }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-obsidian/60 to-transparent"></div>
                            </div>
                            
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-bold text-white leading-tight uppercase tracking-tighter">{{ $p['n'] }}</h3>
                                    <span class="text-[8px] font-black text-solarGreen border border-solarGreen/20 px-2 py-0.5 rounded-full">MNRE</span>
                                </div>
                                <p class="text-[10px] text-white/40 font-medium uppercase tracking-widest mb-8">{{ $p['d'] }}</p>
                            </div>

                            <div class="flex justify-between items-center bg-black/20 p-5 rounded-2xl border border-white/5 mt-auto">
                                <span class="text-white font-black text-2xl tracking-tighter">{{ $p['p'] }}</span>
                                <button class="w-12 h-12 bg-solarGreen text-obsidian rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(0,223,130,0.2)] transform group-hover:rotate-6 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Section 2: Strictly Aligned Voices of Trust -->
        <section class="py-32 relative overflow-hidden border-t border-white/5">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
                    <div class="max-w-2xl text-left">
                        <div class="text-solarGreen font-black uppercase tracking-[0.4em] text-[10px] mb-4">Market Reputation</div>
                        <h2 class="text-4xl md:text-5xl font-bold font-heading text-white tracking-tighter leading-tight">VOICES OF <br/> <span class="italic text-solarGreen">TRUST.</span></h2>
                    </div>
                    <p class="text-white/40 text-base font-medium uppercase tracking-widest mb-4">Trusted across Uttar Pradesh.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['n' => 'Rahul Verma', 'l' => 'Kanpur Sector 5', 'q' => 'Installed a 5kW system on my home. Excellent after-sales support and genuine MNRE panels.'],
                        ['n' => 'Pooja Mishra', 'l' => 'Kalyanpur, Kanpur', 'q' => 'The best solar company in Kanpur. Precise engineering and zero downtime since the installation.'],
                        ['n' => 'Anuj Tiwari', 'l' => 'Barra Resident', 'q' => 'Their team is highly professional. My technical query was resolved in under 2 hours. Top notch.']
                    ] as $t)
                        <div class="flex flex-col h-full p-10 bg-obsidianLight rounded-[2.5rem] border border-white/5 hover:border-solarGreen/20 transition-all duration-500 group shadow-2xl">
                            <div class="flex gap-1.5 mb-10 text-solarGreen">
                                @for($i=0; $i<5; $i++) <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1.7L15 9h7.7l-6.2 4.5 2.4 7.5L12 16.3l-6.9 4.7 2.4-7.5L1.3 9h7.7z"/></svg> @endfor
                            </div>
                            <p class="text-lg text-white/60 font-medium leading-relaxed mb-10 flex-grow group-hover:text-white transition-colors tracking-tight">"{{ $t['q'] }}"</p>
                            <div class="flex items-center gap-5 pt-8 border-t border-white/5">
                                <div class="w-14 h-14 bg-solarGreen/10 rounded-2xl flex items-center justify-center font-black text-solarGreen text-lg border border-solarGreen/20">{{ substr($t['n'], 0, 1) }}</div>
                                <div>
                                    <div class="text-lg font-black text-white uppercase tracking-tighter">{{ $t['n'] }}</div>
                                    <div class="text-[10px] text-white/30 font-black tracking-[0.2em] uppercase">{{ $t['l'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Structural Gradient Accents -->
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-solarGreen/5 blur-[120px] rounded-full pointer-events-none"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-solarGreen/5 blur-[120px] rounded-full pointer-events-none"></div>
        </section>
    </div>

    <!-- Footer: Deep Forest Anchor -->
    <footer class="bg-deepForest py-32 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-solarGreen/30 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-16 relative z-10">
            <div class="space-y-10">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-solarGreen rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M2 12h2"/><path d="M20 12h2"/></svg>
                    </div>
                    <span class="text-2xl font-black font-heading tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
                </div>
                <p class="text-[10px] text-white/40 font-black uppercase tracking-[0.25em] leading-loose">
                    MNRE & ISO Certified Solar Infrastructure. <br/> Engineering India's Future since 2013.
                </p>
                <div class="flex gap-4">
                    @foreach(['FB', 'TW', 'LI', 'IG'] as $social)
                        <a href="#" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/40 hover:border-solarGreen hover:text-solarGreen transition-all">{{ $social }}</a>
                    @endforeach
                </div>
            </div>
            
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Headquarters</h4>
                <p class="text-base font-bold text-white/70 leading-relaxed">Near IIT Metro Station, <br/> Kanpur, Uttar Pradesh, <br/> India - 208016</p>
            </div>
            
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Communications</h4>
                <ul class="space-y-6 text-base font-bold text-white/70">
                    <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors flex items-center gap-3"><span class="text-[10px] text-white/20">CALL</span> +91-9412452844</a></li>
                    <li><a href="mailto:info@uprsolargreenenergy.com" class="hover:text-solarGreen transition-colors flex items-center gap-3"><span class="text-[10px] text-white/20">MAIL</span> info@uprsolar.com</a></li>
                </ul>
            </div>

            <div class="space-y-6">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Status</h4>
                <div class="p-6 bg-white/5 rounded-3xl border border-white/5">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-2 h-2 bg-solarGreen rounded-full animate-pulse-glow"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white">GRID ACTIVE</span>
                    </div>
                    <div class="text-[10px] text-white/40 font-black uppercase tracking-widest">Accepting New Project Proposals</div>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 mt-32 pt-12 border-t border-white/5 text-[10px] font-black text-white/20 uppercase tracking-[0.5em] text-center">
            © 2026 U.P.R. Solar Green Energy™ | U.P. Refrigeration & Sales Co.
        </div>
    </footer>
</main>

<!-- Kinetic JS -->
<script>
    const panel = document.getElementById('solar-3d-panel');
    document.addEventListener('mousemove', (e) => {
        if (!panel) return;
        const rect = panel.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;
        const mouseY = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = (mouseY - centerY) / 25;
        const rotateY = (centerX - mouseX) / 25;
        panel.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });
    panel.addEventListener('mouseleave', () => {
        panel.style.transform = `rotateX(0deg) rotateY(0deg)`;
    });
</script>

<style>
    .preserve-3d { transform-style: preserve-3d; perspective: 1500px; }
    #solar-3d-panel { transition: transform 0.4s cubic-bezier(0.1, 0.4, 0.2, 1); }
    .animate-pulse-glow { animation: pulse-glow 2s infinite; }
    @keyframes pulse-glow {
        0%, 100% { opacity: 0.5; filter: blur(4px); }
        50% { opacity: 1; filter: blur(8px); }
    }
</style>
@endsection
