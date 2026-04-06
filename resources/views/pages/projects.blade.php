@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main class="bg-obsidian">
    <!-- Projects Hero: Technical Legacy -->
    <section class="relative py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center reveal-up">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full mb-10">
                <span class="text-[11px] uppercase font-bold tracking-[0.3em] text-solarGreen">System Portfolio</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black font-heading leading-[0.85] tracking-tighter text-white mb-10 uppercase">
                PRECISION <br/> <span class="italic text-solarGreen">LEGACY.</span>
            </h1>
            
            <p class="text-sm text-white/50 max-w-2xl mx-auto leading-relaxed font-medium">
                Documenting high-impact solar infrastructure across Uttar Pradesh. <br/> From residential rooftops to large-scale industrial cold storage solutions.
            </p>
        </div>
    </section>

    <!-- Impact Stats: Bento Grid -->
    <section class="pb-20 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 stagger-children">
            <div class="p-8 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] shadow-sm hover:shadow-xl transition-all group hover-lift">
                <div class="text-[11px] font-bold uppercase text-solarGreen tracking-[0.3em] mb-6">Aggregate Power</div>
                <div class="text-2xl font-bold text-white tracking-tighter">150+ <span class="text-lg text-white/20">MW</span></div>
                <div class="mt-8 pt-8 border-t border-white/[0.06] text-[11px] text-white/40 font-medium uppercase tracking-widest">Total Grid Impact Since 2013</div>
            </div>
            <div class="p-8 bg-deepForest rounded-[2rem] border border-white/5 shadow-2xl relative overflow-hidden group hover-lift">
                <div class="absolute inset-0 bg-gradient-to-br from-solarGreen/20 to-transparent"></div>
                <div class="relative z-10 text-[11px] font-bold uppercase text-solarGreen tracking-[0.3em] mb-6">Carbon Offset</div>
                <div class="relative z-10 text-2xl font-bold text-white tracking-tighter">42K <span class="text-lg text-white/20">TONS</span></div>
                <div class="relative z-10 mt-8 pt-8 border-t border-white/5 text-[11px] text-white/40 font-medium uppercase tracking-widest">Equivalent Environment Restoration</div>
            </div>
            <div class="p-8 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] shadow-sm hover:shadow-xl transition-all group hover-lift">
                <div class="text-[11px] font-bold uppercase text-solarGreen tracking-[0.3em] mb-6">Operational uptime</div>
                <div class="text-2xl font-bold text-white tracking-tighter">99.9%</div>
                <div class="mt-8 pt-8 border-t border-white/[0.06] text-[11px] text-white/40 font-medium uppercase tracking-widest">Real-time System Reliability Monitor</div>
            </div>
        </div>
    </section>

    <!-- Core Project Showroom -->
    <section class="pb-20 bg-deepForest relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-[600px] bg-[radial-gradient(circle_at_50%_0%,rgba(0,223,130,0.1),transparent_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-6 pt-20 lg:pt-28">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div class="max-w-2xl">
                    <div class="text-solarGreen font-bold uppercase tracking-[0.4em] text-[11px] mb-4">Latest Commissions</div>
                    <h2 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-tight uppercase italic">The Solar <br/> <span class="text-solarGreen">Archive.</span></h2>
                </div>
                <p class="text-white/40 text-sm font-medium uppercase tracking-widest mb-4">Industrial & Residential Grade.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 stagger-children">
                @foreach([
                    ['n' => 'Tiwari Cold Storage', 'l' => 'Unnao, UP', 's' => '100kW', 't' => 'Industrial Cooling', 'img' => 'https://images.unsplash.com/photo-1565514020125-9a84752c1df8?auto=format&fit=crop&w=1200&q=80'],
                    ['n' => 'Green Valley School', 'l' => 'Lucknow, UP', 's' => '50kW', 't' => 'Academic Campus', 'img' => 'https://images.unsplash.com/photo-1594818379496-da1e345b0ded?auto=format&fit=crop&w=1200&q=80'],
                    ['n' => 'Sharma Residency', 'l' => 'Kanpur Sector 5', 's' => '5kW', 't' => 'Residential Plus', 'img' => 'https://images.unsplash.com/photo-1624397640148-949b1732bb0a?auto=format&fit=crop&w=1200&q=80'],
                    ['n' => 'IIT Kanpur Ancillary', 'l' => 'Kalyanpur, UP', 's' => '25kW', 't' => 'Research Lab', 'img' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=1200&q=80']
                ] as $p)
                    <div class="group relative aspect-video rounded-[2rem] overflow-hidden border border-white/5 bg-obsidian transition-all duration-700 hover:border-solarGreen/40 shadow-2xl hover-lift">
                        <img src="{{ $p['img'] }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" alt="{{ $p['n'] }}">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-deepForest/90 via-deepForest/40 to-transparent"></div>
                        
                        <div class="absolute top-8 right-8 px-4 py-1.5 bg-solarGreen text-obsidian rounded-xl text-[11px] font-bold uppercase tracking-widest shadow-xl">
                            {{ $p['s'] }} System
                        </div>

                        <div class="absolute bottom-10 left-10 right-10 space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-[2px] bg-solarGreen rounded-full transition-all group-hover:w-16"></span>
                                <span class="text-[11px] font-bold text-solarGreen uppercase tracking-[0.3em]">{{ $p['t'] }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-white tracking-tighter leading-none uppercase">{{ $p['n'] }}</h3>
                            <div class="flex items-center gap-2 text-[11px] text-white/40 font-bold uppercase tracking-widest">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-solarGreen/40"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $p['l'] }}
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-solarGreen/90 backdrop-blur-md translate-y-full group-hover:translate-y-0 transition-transform duration-700 p-10 md:p-16 flex flex-col justify-between">
                            <div class="space-y-6">
                                <span class="text-sm font-bold uppercase text-obsidian tracking-widest">Performance Data</span>
                                <h4 class="text-base font-bold text-obsidian tracking-tighter leading-none uppercase italic">Optimized <br/> Energy.</h4>
                            </div>
                            <div class="grid grid-cols-2 gap-8 text-obsidian">
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-widest opacity-40">Monthly Save</div>
                                    <div class="text-2xl font-black tracking-tighter inline-flex items-center gap-1">₹8.5K <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-obsidian"><path d="m19 12-7 7-7-7"/></svg></div>
                                </div>
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-widest opacity-40">Efficiency</div>
                                    <div class="text-2xl font-black tracking-tighter">98.2%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Structural Anchor CTA -->
    <section class="py-20 lg:py-28 bg-obsidian">
        <div class="max-w-7xl mx-auto px-6">
            <div class="p-10 md:p-16 bg-white/[0.03] rounded-[3rem] border border-white/[0.06] text-center space-y-12 relative overflow-hidden group hover-lift">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-solarGreen/5 blur-[120px] rounded-full group-hover:bg-solarGreen/10 transition-all duration-700"></div>
                
                <h3 class="text-lg font-bold font-heading text-white tracking-tighter leading-tight uppercase italic relative z-10">
                    Ready to build your <br/>
                    <span class="text-solarGreen">Solar Legacy?</span>
                </h3>
                
                <div class="pt-8 relative z-10">
                    <a href="/contact" class="inline-flex items-center gap-6 bg-solarGreen text-deepForest px-12 py-6 rounded-[2rem] font-bold uppercase tracking-widest text-[11px] shadow-2xl hover:scale-105 active:scale-95 transition-all">
                        Consult Our Engineers <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-deepForest"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
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
                <div class="text-[11px] text-white/40 font-medium">Accepting New Projects</div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-white/5 text-[11px] font-medium text-white/20 uppercase tracking-wider text-center">
        © 2026 U.P.R. Solar Green Energy™ | U.P. Refrigeration & Sales Co.
    </div>
</footer>
@endsection
