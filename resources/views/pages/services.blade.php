@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main class="bg-obsidian">
    <!-- Services Hero: Impact Design -->
    <section class="relative py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center reveal-up">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full mb-10">
                <span class="text-[11px] uppercase font-bold tracking-[0.3em] text-solarGreen">Energy as a Service</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black font-heading leading-[0.85] tracking-tighter text-white mb-10">
                INDUSTRIAL <br/> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-600">GRADE</span> <br/>
                SOLUTIONS.
            </h1>
            
            <p class="text-base text-white/50 max-w-2xl mx-auto leading-relaxed font-medium">
                From precision site mapping to high-output grid integration. <br/> We provide end-to-end solar infrastructure for India's evolving economy.
            </p>
        </div>

        <!-- Abstract Light Accents -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-solarGreen/5 blur-[120px] rounded-full -z-10"></div>
    </section>

    <!-- Services Bento Grid -->
    <section class="py-20 lg:py-28 bg-obsidian border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 stagger-children">
                @foreach([
                    ['t' => 'Rooftop Solar', 'd' => 'Industrial-strength residential systems. Reduce bills by up to 90%.', 's' => 'HP_01', 'img' => '/assets/images/services/residential.png'],
                    ['t' => 'Commercial Plants', 'd' => 'High-capacity infrastructure for factories, hospitals, and schools.', 's' => 'MX_88', 'img' => '/assets/images/services/commercial.png'],
                    ['t' => 'Water Heating', 'd' => 'ETC vacuum tube technology for maximum thermal efficiency.', 's' => 'TH_09', 'img' => 'https://images.unsplash.com/photo-1558449028-b53a39d100fc?auto=format&fit=crop&w=800&q=80'],
                    ['t' => 'Maintenance', 'd' => 'Periodic cleaning, AMC, and technical audits for long-term yield.', 's' => 'OP_22', 'img' => '/assets/images/services/maintenance.png']
                ] as $s)
                    <div class="relative p-8 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] group hover:border-solarGreen/30 transition-all duration-500 shadow-sm hover:shadow-2xl overflow-hidden min-h-[350px] flex flex-col hover-lift">
                        <!-- Abstract Background Image -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-700">
                            <img src="{{ $s['img'] }}" class="w-full h-full object-cover">
                        </div>

                        <div class="relative z-10">
                            <div class="text-[11px] font-bold text-solarGreen/40 uppercase tracking-[0.4em] mb-8">{{ $s['s'] }}</div>
                            <h3 class="text-base font-bold text-white uppercase tracking-tighter mb-4">{{ $s['t'] }}</h3>
                            <p class="text-base text-white/50 font-medium leading-relaxed">{{ $s['d'] }}</p>
                        </div>
                        
                        <div class="mt-auto pt-12 flex justify-end relative z-10">
                            <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-solarGreen group-hover:border-solarGreen transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white/40 group-hover:text-deepForest transition-colors"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Detailed Service Breakdown -->
    <section class="py-20 lg:py-28 bg-obsidian border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="aspect-square rounded-[3rem] overflow-hidden shadow-2xl relative">
                    <img src="https://images.unsplash.com/photo-1497435334941-8c899ee9e8e2?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="Solar Lab">
                    <div class="absolute inset-0 bg-solarGreen/10 mix-blend-multiply"></div>
                </div>
            </div>
            
            <div class="space-y-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tighter leading-tight uppercase">THE LAB <br/> <span class="italic text-solarGreen">PROCESS.</span></h2>
                
                <div class="space-y-10">
                    <div class="flex gap-8 group">
                        <div class="shrink-0 w-12 h-12 rounded-2xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center font-bold text-solarGreen text-lg shadow-md">01</div>
                        <div>
                            <h4 class="text-base font-bold text-white uppercase tracking-widest mb-1">Technical Audit</h4>
                            <p class="text-base text-white/50 font-medium leading-relaxed">Shadow analysis, load calculation, and structural integrity verification.</p>
                        </div>
                    </div>
                    <div class="flex gap-8 group">
                        <div class="shrink-0 w-12 h-12 rounded-2xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center font-bold text-solarGreen text-lg shadow-md">02</div>
                        <div>
                            <h4 class="text-base font-bold text-white uppercase tracking-widest mb-1">Systems Design</h4>
                            <p class="text-base text-white/50 font-medium leading-relaxed">Selecting the optimal inverter-battery-panel combination for your specific geography.</p>
                        </div>
                    </div>
                    <div class="flex gap-8 group">
                        <div class="shrink-0 w-12 h-12 rounded-2xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center font-bold text-solarGreen text-lg shadow-md">03</div>
                        <div>
                            <h4 class="text-base font-bold text-white uppercase tracking-widest mb-1">Deployment</h4>
                            <p class="text-base text-white/50 font-medium leading-relaxed">Certified engineering teams ensure your system is bonded and grounded to MNRE specs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Transformations: High Fidelity Grid -->
    <section class="py-20 lg:py-28 bg-deepForest text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="text-3xl md:text-4xl font-bold font-heading tracking-tighter mb-4 uppercase">LATEST <span class="text-solarGreen italic">IMPACT.</span></h3>
                <p class="text-white/40 uppercase tracking-[0.4em] text-[11px] font-bold">Transforming the energy landscape of Uttar Pradesh.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                @foreach([
                    ['n' => 'Sharma Residency', 'l' => 'Kanpur', 't' => '5kW Rooftop', 'img' => 'https://images.unsplash.com/photo-1624397640148-949b1732bb0a?auto=format&fit=crop&w=800&q=80'],
                    ['n' => 'Green Valley', 'l' => 'Lucknow', 't' => '50kW Plant', 'img' => 'https://images.unsplash.com/photo-1594818379496-da1e345b0ded?auto=format&fit=crop&w=800&q=80'],
                    ['n' => 'Tiwari Storage', 'l' => 'Unnao', 't' => '100kW Industrial', 'img' => 'https://images.unsplash.com/photo-1565514020125-9a84752c1df8?auto=format&fit=crop&w=800&q=80']
                ] as $p)
                    <div class="group relative aspect-[3/4] rounded-[2rem] overflow-hidden border border-white/5">
                        <img src="{{ $p['img'] }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $p['n'] }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-deepForest to-transparent opacity-80"></div>
                        <div class="absolute bottom-10 left-10 space-y-2">
                            <div class="text-[11px] font-bold text-solarGreen uppercase tracking-[0.4em]">{{ $p['l'] }}</div>
                            <h4 class="text-base font-bold tracking-tighter">{{ $p['n'] }}</h4>
                            <p class="text-white/40 text-sm font-bold uppercase tracking-widest">{{ $p['t'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

<footer class="bg-deepForest py-20 lg:py-24 relative overflow-hidden text-white border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-12">
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
            <p class="text-sm font-medium text-white/60 leading-relaxed">Near IIT Metro Station, <br/> Kanpur, Uttar Pradesh, <br/> India - 208016</p>
        </div>
        <div>
            <h4 class="text-[11px] font-bold uppercase tracking-[0.3em] text-solarGreen mb-6">Communications</h4>
            <ul class="space-y-4 text-sm font-medium text-white/60">
                <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors">+91-9412452844</a></li>
                <li><a href="mailto:info@uprsolargreenenergy.com" class="hover:text-solarGreen transition-colors">info@uprsolar.com</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-[11px] font-bold uppercase tracking-[0.3em] text-solarGreen mb-6">Status</h4>
            <div class="p-5 bg-white/5 rounded-2xl border border-white/5">
                <div class="flex items-center gap-2.5 mb-1.5">
                    <span class="w-2 h-2 bg-solarGreen rounded-full animate-pulse-glow"></span>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-white">GRID ACTIVE</span>
                </div>
                <div class="text-[11px] text-white/40 font-medium">Accepting New Projects</div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-white/5 text-[11px] font-medium text-white/20 uppercase tracking-wider text-center">
        © 2026 U.P.R. Solar Green Energy™ | U.P. Refrigeration & Sales Co.
    </div>
</footer>
@endsection
