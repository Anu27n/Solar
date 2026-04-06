@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main>
    {{-- ═══════════════ HERO ═══════════════ --}}
    <section class="relative min-h-screen flex items-center overflow-hidden bg-obsidian">
        {{-- Animated grid background --}}
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: linear-gradient(rgba(0,223,130,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(0,223,130,0.3) 1px, transparent 1px); background-size: 60px 60px;"></div>
        {{-- Gradient orbs --}}
        <div class="absolute top-20 left-1/4 w-[500px] h-[500px] bg-solarGreen/5 rounded-full blur-[150px] animate-float-slow"></div>
        <div class="absolute bottom-20 right-1/4 w-[400px] h-[400px] bg-solarGreen/3 rounded-full blur-[120px] animate-float"></div>

        <div class="max-w-7xl mx-auto px-5 md:px-8 w-full grid lg:grid-cols-2 gap-12 lg:gap-8 py-24 lg:py-32 items-center relative z-10">
            <div class="space-y-8 reveal-up">
                <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-solarGreen/10 border border-solarGreen/20 rounded-full backdrop-blur-sm">
                    <span class="w-2 h-2 bg-solarGreen rounded-full animate-pulse shadow-[0_0_8px_rgba(0,223,130,0.6)]"></span>
                    <span class="text-[11px] uppercase font-bold tracking-[0.2em] text-solarGreen">The Future of Energy</span>
                </div>
                
                <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black font-heading leading-[0.85] tracking-tighter text-white">
                    POWERING <br/> 
                    <span class="text-shimmer">INDIA</span> <br/>
                    <span class="text-white/20">WITH LIGHT.</span>
                </h1>
                
                <p class="text-base text-white/40 max-w-lg leading-relaxed font-medium">
                    MNRE & ISO Certified Engineering. Reducing carbon footprints and electricity bills across Uttar Pradesh since 2013.
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="/contact" class="magnetic-btn px-8 py-4 bg-solarGreen text-deepForest font-bold rounded-xl shadow-[0_12px_36px_rgba(0,223,130,0.25)] hover:shadow-[0_20px_60px_rgba(0,223,130,0.4)] hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative text-sm">
                        <span class="relative z-10 flex items-center gap-2">Get Started <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></span>
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </a>
                    <a href="/products" class="magnetic-btn px-8 py-4 border border-white/15 text-white font-bold rounded-xl hover:bg-white/5 transition-all duration-300 hover:-translate-y-1 text-sm backdrop-blur-sm">
                        Shop Store
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-3 pt-6 stagger-children">
                    <div class="p-4 bg-white/[0.03] rounded-2xl border border-white/[0.06] backdrop-blur-sm tilt-card">
                        <div class="text-2xl font-black text-white count-up tabular-nums" data-count="10" data-suffix="+">0</div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-solarGreen/80 mt-1">Years Legacy</div>
                    </div>
                    <div class="p-4 bg-white/[0.03] rounded-2xl border border-white/[0.06] backdrop-blur-sm tilt-card">
                        <div class="text-2xl font-black text-white count-up tabular-nums" data-count="500" data-suffix="+">0</div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-solarGreen/80 mt-1">Installations</div>
                    </div>
                    <div class="p-4 bg-white/[0.03] rounded-2xl border border-white/[0.06] backdrop-blur-sm tilt-card">
                        <div class="text-2xl font-black text-white count-up tabular-nums" data-count="90" data-suffix="%">0</div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-solarGreen/80 mt-1">Bill Cut</div>
                    </div>
                </div>
            </div>

            {{-- 3D Solar Panel Hero --}}
            <div class="relative flex justify-center items-center reveal-scale">
                {{-- Orbiting ring --}}
                <div class="absolute w-[380px] h-[380px] lg:w-[450px] lg:h-[450px] rounded-full border border-solarGreen/10 orbit-ring"></div>
                <div class="absolute w-[300px] h-[300px] lg:w-[360px] lg:h-[360px] rounded-full border border-dashed border-white/5 orbit-ring-reverse"></div>
                
                {{-- Main 3D Panel --}}
                <div id="hero-panel" class="relative w-[260px] h-[400px] lg:w-[300px] lg:h-[460px] preserve-3d cursor-crosshair z-10">
                    <div class="absolute inset-0 rounded-[2.5rem] overflow-hidden border-2 border-white/10 shadow-[0_0_80px_rgba(0,223,130,0.1),0_40px_80px_rgba(0,0,0,0.4)] panel-surface">
                        {{-- Panel cells --}}
                        <div class="w-full h-full grid grid-cols-4 grid-rows-8 gap-1 p-2.5">
                            @for($i = 0; $i < 32; $i++)
                                <div class="solar-cell bg-gradient-to-br from-[#0a1628] to-[#0d2040] border border-white/[0.04] rounded-sm relative overflow-hidden" style="animation-delay: {{ $i * 40 }}ms">
                                    <div class="absolute inset-0 bg-gradient-to-br from-solarGreen/5 to-transparent opacity-0 cell-glow"></div>
                                    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                                </div>
                            @endfor
                        </div>
                        
                        {{-- Panel frame details --}}
                        <div class="absolute inset-0 rounded-[2.5rem] border border-white/[0.06] pointer-events-none"></div>
                        <div class="absolute top-4 left-4 text-[7px] font-bold tracking-[0.3em] text-white/15 uppercase">AIDA_SYS_v4.2</div>
                        <div class="absolute bottom-4 right-4 flex flex-col items-end gap-0.5">
                            <div class="text-[7px] font-bold tracking-[0.2em] text-solarGreen/60 uppercase">OUTPUT: 540W</div>
                            <div class="text-[7px] font-bold tracking-[0.2em] text-white/20 uppercase">MP-540-UPR</div>
                        </div>

                        {{-- Scanning line effect --}}
                        <div class="absolute inset-x-0 h-px bg-gradient-to-r from-transparent via-solarGreen/40 to-transparent scan-line"></div>
                    </div>
                </div>

                {{-- Floating data badges --}}
                <div class="absolute -top-4 right-0 lg:right-[-20px] p-3 bg-white/[0.05] backdrop-blur-xl border border-white/10 rounded-xl shadow-2xl animate-float z-20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-solarGreen/20 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00DF82" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        </div>
                        <div>
                            <div class="text-[9px] text-white/30 font-bold uppercase tracking-wider">Energy</div>
                            <div class="text-sm font-black text-white tabular-nums count-up" data-count="98.4" data-suffix="%" data-decimals="1">0</div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-2 left-0 lg:left-[-20px] p-3 bg-white/[0.05] backdrop-blur-xl border border-white/10 rounded-xl shadow-2xl animate-float-slow z-20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div>
                            <div class="text-[9px] text-white/30 font-bold uppercase tracking-wider">Status</div>
                            <div class="text-sm font-black text-emerald-400">OPTIMAL</div>
                        </div>
                    </div>
                </div>

                <div class="absolute top-1/2 -right-8 lg:right-[-40px] p-2.5 bg-white/[0.04] backdrop-blur-xl border border-solarGreen/20 rounded-lg animate-float z-20">
                    <div class="text-[8px] text-solarGreen font-bold tracking-widest">540W</div>
                </div>

                {{-- Glow effects --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] bg-solarGreen/8 rounded-full blur-[80px] animate-pulse pointer-events-none"></div>
            </div>
        </div>

        {{-- Bottom gradient fade --}}
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-obsidian to-transparent"></div>
    </section>

    {{-- ═══════════════ TRUST BAR ═══════════════ --}}
    <section class="py-8 bg-obsidian border-y border-white/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-30 hover:opacity-70 transition-all duration-700">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-white">MNRE CERTIFIED</span>
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-white">ISO 9001:2015</span>
            <div class="w-px h-5 bg-white/10 hidden md:block"></div>
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-white">UP-NEDA LICENSED</span>
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-white">GOVERNMENT APPROVED</span>
        </div>
    </section>

    {{-- ═══════════════ TECHNOLOGY ═══════════════ --}}
    <section class="py-24 lg:py-32 bg-obsidian relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(#00DF82 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:grid lg:grid-cols-2 items-center gap-16 relative z-10">
            <div class="space-y-6 reveal-left">
                <div class="w-16 h-0.5 bg-gradient-to-r from-solarGreen to-transparent rounded-full"></div>
                <h2 class="text-3xl md:text-4xl font-bold font-heading leading-tight tracking-tighter uppercase text-white">
                    PRECISION <br/> 
                    <span class="text-solarGreen">ENGINEERING</span>
                </h2>
                <p class="text-base text-white/40 font-medium leading-relaxed max-w-lg">
                    Featuring our <strong class="text-white/70">MP-540-UPR</strong> flagship panel. Specifically optimized for the high-intensity thermal index of North India.
                </p>
                
                <div class="grid grid-cols-2 gap-3 pt-4 stagger-children">
                    <div class="p-4 bg-white/[0.03] rounded-xl border border-white/[0.06]">
                        <div class="text-xl font-black text-solarGreen">540W</div>
                        <div class="text-[10px] text-white/30 font-bold uppercase tracking-wider mt-1">Peak Output</div>
                    </div>
                    <div class="p-4 bg-white/[0.03] rounded-xl border border-white/[0.06]">
                        <div class="text-xl font-black text-solarGreen">21.5%</div>
                        <div class="text-[10px] text-white/30 font-bold uppercase tracking-wider mt-1">Efficiency</div>
                    </div>
                    <div class="p-4 bg-white/[0.03] rounded-xl border border-white/[0.06]">
                        <div class="text-xl font-black text-solarGreen">25yr</div>
                        <div class="text-[10px] text-white/30 font-bold uppercase tracking-wider mt-1">Warranty</div>
                    </div>
                    <div class="p-4 bg-white/[0.03] rounded-xl border border-white/[0.06]">
                        <div class="text-xl font-black text-solarGreen">IP68</div>
                        <div class="text-[10px] text-white/30 font-bold uppercase tracking-wider mt-1">Rating</div>
                    </div>
                </div>

                <div class="pt-6 border-t border-white/5">
                    <a href="/products" class="inline-flex items-center gap-4 text-white font-bold uppercase tracking-[0.2em] group text-xs hover:text-solarGreen transition-colors">
                        Technology Reveal <span class="w-10 h-[2px] bg-solarGreen transition-all group-hover:w-20"></span>
                    </a>
                </div>
            </div>

            <div class="flex justify-center reveal-right">
                <div id="solar-3d-panel" class="relative w-[280px] h-[460px] preserve-3d cursor-crosshair">
                    <div class="absolute inset-0 bg-gradient-to-b from-[#0a1a2e] to-[#050d18] rounded-[2.5rem] border border-white/10 shadow-[0_40px_80px_rgba(0,0,0,0.4),0_0_60px_rgba(0,223,130,0.05)] overflow-hidden transition-transform duration-200">
                        <div class="w-full h-full grid grid-cols-4 grid-rows-8 gap-1.5 p-3">
                            @for($i = 0; $i < 32; $i++)
                                <div class="bg-gradient-to-br from-solarGreen/8 to-solarGreen/3 border border-white/[0.04] rounded-md shadow-inner relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-b from-white/[0.02] to-transparent"></div>
                                </div>
                            @endfor
                        </div>
                        
                        <div class="absolute top-5 left-5 text-[8px] font-bold tracking-widest text-white/15 uppercase">AIDA_SYSTEM_V4.2</div>
                        <div class="absolute bottom-6 right-6 flex flex-col items-end">
                            <div class="text-[8px] font-bold tracking-widest text-solarGreen/50 uppercase mb-1">OUTPUT: 540W</div>
                            <div class="text-[8px] font-bold tracking-widest text-white/20 uppercase">MODEL: MP-540-UPR</div>
                        </div>
                    </div>
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-solarGreen/15 blur-3xl animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════ PRODUCTS ═══════════════ --}}
    <section class="py-24 lg:py-32 bg-obsidian relative overflow-hidden border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6 reveal-up">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-solarGreen/10 border border-solarGreen/20 rounded-full mb-5">
                        <span class="w-1.5 h-1.5 bg-solarGreen rounded-full glow-green"></span>
                        <span class="text-[11px] uppercase font-bold tracking-[0.2em] text-solarGreen">Certified Ecosystem</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-tight">
                        BEST SELLING <br/> <span class="text-solarGreen italic">SOLUTIONS.</span>
                    </h2>
                    <p class="text-white/30 mt-4 text-sm font-medium max-w-md leading-relaxed">
                        Industrial-grade solar infrastructure engineered for maximum longevity and energy yield.
                    </p>
                </div>
                <a href="/products" class="magnetic-btn group px-7 py-3.5 bg-white/[0.03] border border-white/10 text-white font-bold uppercase tracking-wider text-xs rounded-xl hover:bg-solarGreen hover:text-obsidian hover:border-solarGreen transition-all duration-300">
                    View Full Catalog <span class="inline-block transition-transform group-hover:translate-x-1.5 ml-1.5">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 stagger-children">
                @foreach([
                    ['n' => 'Mono PERC 540W', 'p' => '₹14,500', 'd' => 'Industrial half-cut technology.', 'img' => '/assets/images/product1.png'],
                    ['n' => 'Hybrid Inverter', 'p' => '₹45,000', 'd' => 'Pure sine wave smart system.', 'img' => '/assets/images/product2.png'],
                    ['n' => 'LFP Battery 100Ah', 'p' => '₹22,000', 'd' => '10-Year deep cycle storage.', 'img' => '/assets/images/product3.png'],
                    ['n' => 'Solar Heater 200L', 'p' => '₹18,500', 'd' => 'High-efficiency vacuum ETC.', 'img' => '/assets/images/product4.png']
                ] as $p)
                    <div class="group flex flex-col h-full bg-white/[0.02] border border-white/[0.06] rounded-[2rem] p-6 hover:border-solarGreen/30 transition-all duration-500 hover-lift relative overflow-hidden tilt-card">
                        <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-5 bg-black/40 relative">
                            <img src="{{ $p['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1s]" alt="{{ $p['n'] }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-obsidian/60 to-transparent"></div>
                        </div>
                        
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-sm font-bold text-white leading-tight uppercase tracking-tight">{{ $p['n'] }}</h3>
                                <span class="text-[8px] font-bold text-solarGreen border border-solarGreen/20 px-1.5 py-0.5 rounded-full shrink-0 ml-2">MNRE</span>
                            </div>
                            <p class="text-[11px] text-white/30 font-medium uppercase tracking-wider mb-5">{{ $p['d'] }}</p>
                        </div>

                        <div class="flex justify-between items-center bg-white/[0.03] p-3.5 rounded-xl border border-white/[0.04] mt-auto">
                            <span class="text-white font-black text-lg tracking-tighter">{{ $p['p'] }}</span>
                            <button class="w-9 h-9 bg-solarGreen text-obsidian rounded-lg flex items-center justify-center shadow-[0_0_16px_rgba(0,223,130,0.15)] transform group-hover:rotate-6 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════ TESTIMONIALS ═══════════════ --}}
    <section class="py-24 lg:py-32 bg-obsidian relative overflow-hidden border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6 reveal-up">
                <div class="max-w-xl text-left">
                    <div class="text-solarGreen font-bold uppercase tracking-[0.3em] text-[11px] mb-3">Market Reputation</div>
                    <h2 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-tight">VOICES OF <br/> <span class="italic text-solarGreen">TRUST.</span></h2>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 stagger-children">
                @foreach([
                    ['n' => 'Rahul Verma', 'l' => 'Kanpur Sector 5', 'q' => 'Installed a 5kW system on my home. Excellent after-sales support and genuine MNRE panels.'],
                    ['n' => 'Pooja Mishra', 'l' => 'Kalyanpur, Kanpur', 'q' => 'The best solar company in Kanpur. Precise engineering and zero downtime since installation.'],
                    ['n' => 'Anuj Tiwari', 'l' => 'Barra Resident', 'q' => 'Their team is highly professional. My query was resolved in under 2 hours. Top notch.']
                ] as $t)
                    <div class="flex flex-col h-full p-7 bg-white/[0.02] rounded-[2rem] border border-white/[0.06] hover:border-solarGreen/20 transition-all duration-500 group hover-lift tilt-card">
                        <div class="flex gap-0.5 mb-6 text-solarGreen">
                            @for($i=0; $i<5; $i++) <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1.7L15 9h7.7l-6.2 4.5 2.4 7.5L12 16.3l-6.9 4.7 2.4-7.5L1.3 9h7.7z"/></svg> @endfor
                        </div>
                        <p class="text-sm text-white/40 font-medium leading-relaxed mb-8 flex-grow group-hover:text-white/70 transition-colors tracking-tight">"{{ $t['q'] }}"</p>
                        <div class="flex items-center gap-3 pt-5 border-t border-white/5">
                            <div class="w-10 h-10 bg-solarGreen/10 rounded-xl flex items-center justify-center font-bold text-solarGreen text-sm border border-solarGreen/15">{{ substr($t['n'], 0, 1) }}</div>
                            <div>
                                <div class="text-sm font-bold text-white uppercase tracking-tight">{{ $t['n'] }}</div>
                                <div class="text-[10px] text-white/25 font-medium tracking-wider">{{ $t['l'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-solarGreen/5 blur-[100px] rounded-full pointer-events-none"></div>
    </section>

    {{-- ═══════════════ FOOTER ═══════════════ --}}
    <footer class="bg-deepForest py-20 lg:py-24 relative overflow-hidden border-t border-white/5">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-solarGreen/30 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-12 relative z-10">
            <div class="space-y-6">
                <div class="flex items-center gap-2.5">
                    <div class="p-1.5 bg-solarGreen rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M2 12h2"/><path d="M20 12h2"/></svg>
                    </div>
                    <span class="text-lg font-black font-heading tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
                </div>
                <p class="text-xs text-white/30 font-medium leading-relaxed">
                    MNRE & ISO Certified Solar Infrastructure. Engineering India's Future since 2013.
                </p>
                <div class="flex gap-2.5">
                    @foreach(['FB', 'TW', 'LI', 'IG'] as $social)
                        <a href="#" class="w-9 h-9 rounded-xl border border-white/[0.06] bg-white/[0.02] flex items-center justify-center text-white/30 hover:border-solarGreen/30 hover:text-solarGreen transition-all text-xs font-bold">{{ $social }}</a>
                    @endforeach
                </div>
            </div>
            
            <div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-solarGreen/80 mb-6">Headquarters</h4>
                <p class="text-sm font-medium text-white/40 leading-relaxed">Near IIT Metro Station, <br/> Kanpur, Uttar Pradesh, <br/> India - 208016</p>
            </div>
            
            <div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-solarGreen/80 mb-6">Communications</h4>
                <ul class="space-y-4 text-sm font-medium text-white/40">
                    <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors flex items-center gap-2"><span class="text-[9px] text-white/15">CALL</span> +91-9412452844</a></li>
                    <li><a href="mailto:info@uprsolargreenenergy.com" class="hover:text-solarGreen transition-colors flex items-center gap-2"><span class="text-[9px] text-white/15">MAIL</span> info@uprsolar.com</a></li>
                </ul>
            </div>

            <div class="space-y-4">
                <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-solarGreen/80 mb-6">Status</h4>
                <div class="p-4 bg-white/[0.03] rounded-2xl border border-white/[0.06]">
                    <div class="flex items-center gap-2.5 mb-1.5">
                        <span class="w-2 h-2 bg-solarGreen rounded-full shadow-[0_0_8px_rgba(0,223,130,0.6)] animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-white">GRID ACTIVE</span>
                    </div>
                    <div class="text-[10px] text-white/25 font-medium">Accepting New Projects</div>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-white/5 text-[10px] font-medium text-white/15 uppercase tracking-wider text-center">
            © 2026 U.P.R. Solar Green Energy™ | U.P. Refrigeration & Sales Co.
        </div>
    </footer>
</main>

<style>
    .preserve-3d { transform-style: preserve-3d; perspective: 1500px; }
    #solar-3d-panel { transition: transform 0.4s cubic-bezier(0.1, 0.4, 0.2, 1); }
    #hero-panel > div { transition: transform 0.3s cubic-bezier(0.1, 0.4, 0.2, 1); }

    .panel-surface {
        background: linear-gradient(135deg, #0a1628 0%, #071020 50%, #0d1830 100%);
    }

    .nav-pill { position: relative; }
    .nav-pill::after {
        content: ''; position: absolute; bottom: 2px; left: 50%; width: 0; height: 1.5px;
        background: #00DF82; border-radius: 1px; transition: all 0.3s ease; transform: translateX(-50%);
    }
    .nav-pill:hover::after, .nav-pill.text-solarGreen::after { width: 60%; }

    @keyframes orbit { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    @keyframes orbit-reverse { 0% { transform: rotate(360deg); } 100% { transform: rotate(0deg); } }
    .orbit-ring { animation: orbit 25s linear infinite; }
    .orbit-ring-reverse { animation: orbit-reverse 35s linear infinite; }

    @keyframes scan {
        0% { top: -2px; opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }
    .scan-line { animation: scan 4s ease-in-out infinite; }

    @keyframes cell-activate {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; }
    }
    .solar-cell .cell-glow { animation: cell-activate 3s ease-in-out infinite; }
    .solar-cell:nth-child(odd) .cell-glow { animation-delay: 0.5s; }
    .solar-cell:nth-child(3n) .cell-glow { animation-delay: 1s; }
    .solar-cell:nth-child(4n+1) .cell-glow { animation-delay: 1.5s; }
</style>

<script>
    // Hero panel 3D tilt
    const heroPanel = document.getElementById('hero-panel');
    if (heroPanel && window.matchMedia('(pointer: fine)').matches) {
        document.addEventListener('mousemove', (e) => {
            const rect = heroPanel.getBoundingClientRect();
            const cx = rect.left + rect.width / 2;
            const cy = rect.top + rect.height / 2;
            const dx = (e.clientX - cx) / 25;
            const dy = (e.clientY - cy) / 25;
            heroPanel.querySelector('div').style.transform = `rotateY(${dx}deg) rotateX(${-dy}deg)`;
        });
    }

    // Tech section panel
    const panel = document.getElementById('solar-3d-panel');
    if (panel && window.matchMedia('(pointer: fine)').matches) {
        panel.addEventListener('mousemove', (e) => {
            const r = panel.getBoundingClientRect();
            const rx = ((e.clientY - r.top) / r.height - 0.5) * 20;
            const ry = ((e.clientX - r.left) / r.width - 0.5) * -20;
            panel.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
        });
        panel.addEventListener('mouseleave', () => { panel.style.transform = ''; });
    }
</script>
@endsection
