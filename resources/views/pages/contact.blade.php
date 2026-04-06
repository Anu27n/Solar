@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main class="marketing-atmosphere relative">
@include('partials.marketing-page-atmosphere', [
    'marketingAtmosphereImage' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=1920&q=80',
    'marketingAtmospherePosition' => 'center 38%',
])
<div class="relative z-10">
    <!-- Contact Hero: Precision & Clarity -->
    <section class="relative py-16 sm:py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 reveal-up">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full mb-10">
                <span class="text-[11px] uppercase font-bold tracking-[0.3em] text-solarGreen">Direct Channels Active</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black font-heading leading-[0.85] tracking-tighter text-white mb-10">
                CONNECT <br/> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-600 italic">WITH LIGHT.</span>
            </h1>
            
            <p class="text-sm text-white/50 max-w-xl leading-relaxed font-medium">
                Request a site assessment, technical consultation, or project quote. Our engineering team responds within 24 operational hours.
            </p>
        </div>

    </section>

    <!-- Interactive Contact Hub -->
    <section class="pb-16 sm:pb-20 px-4 sm:px-6 pt-8 sm:pt-10 marketing-section-bg border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-5 gap-10 lg:gap-12 stagger-children">
            <!-- Left: Contact Details (Bento Cards) -->
            <div class="lg:col-span-2 space-y-6 reveal-left">
                <div class="p-8 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] shadow-sm group hover:border-solarGreen/30 transition-all duration-500 hover-lift">
                    <div class="w-12 h-12 bg-solarGreen/10 rounded-2xl flex items-center justify-center text-solarGreen mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h4 class="text-[11px] font-bold uppercase tracking-[0.4em] text-solarGreen mb-4">Command Center</h4>
                    <p class="text-lg md:text-xl font-bold text-white leading-tight">Near IIT Metro Station, <br/> Kanpur, Uttar Pradesh, <br/> India - 208016</p>
                </div>

                <div class="p-8 bg-deepForest text-white rounded-[2rem] border border-white/5 shadow-2xl group hover:border-solarGreen/50 transition-all duration-500 hover-lift">
                    <div class="w-12 h-12 bg-solarGreen rounded-2xl flex items-center justify-center text-deepForest mb-8 group-hover:rotate-12 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h4 class="text-[11px] font-bold uppercase tracking-[0.4em] text-solarGreen mb-4">Voice Comms</h4>
                    <ul class="space-y-4 text-lg md:text-xl font-bold tracking-tighter">
                        <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors">+91-9412452844</a></li>
                        <li><a href="tel:+919336852500" class="hover:text-solarGreen transition-colors">+91-9336852500</a></li>
                    </ul>
                </div>

                <div class="p-8 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] shadow-sm group hover:border-solarGreen/30 transition-all duration-500 hover-lift">
                    <div class="w-12 h-12 bg-solarGreen/10 rounded-2xl flex items-center justify-center text-solarGreen mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/></svg>
                    </div>
                    <h4 class="text-[11px] font-bold uppercase tracking-[0.4em] text-solarGreen mb-4">Digital Mail</h4>
                    <p class="text-lg md:text-xl font-bold text-white leading-tight lowercase">info@uprsolar.com</p>
                </div>
            </div>

            <!-- Right: Inquiry Form (Premium Glass) -->
            <div class="lg:col-span-3 reveal-right">
                <div class="bg-white/[0.03] rounded-[2rem] sm:rounded-[3rem] p-6 sm:p-8 md:p-12 border border-white/[0.06] shadow-2xl relative overflow-hidden hover-lift">
                    <div class="absolute top-0 right-0 p-12 opacity-5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="m2 12h2"/><path d="m20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tighter mb-12 uppercase italic">Inquiry <span class="text-solarGreen">Portal.</span></h2>
                    
                    <form class="space-y-10">
                        <div class="grid md:grid-cols-2 gap-10">
                            <div class="space-y-3">
                                <label class="text-[11px] font-bold uppercase tracking-[0.4em] text-white/40">Full Name</label>
                                <input type="text" class="w-full bg-white/[0.05] border border-white/10 rounded-2xl px-5 sm:px-6 py-4 sm:py-5 min-h-[48px] text-white text-base font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-white/20" placeholder="e.g. Anubhav Jain">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[11px] font-bold uppercase tracking-[0.4em] text-white/40">Technical Contact</label>
                                <input type="tel" class="w-full bg-white/[0.05] border border-white/10 rounded-2xl px-5 sm:px-6 py-4 sm:py-5 min-h-[48px] text-white text-base font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-white/20" placeholder="+91 XXX XXX XXXX">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[11px] font-bold uppercase tracking-[0.4em] text-white/40">Enterprise Email</label>
                            <input type="email" class="w-full bg-white/[0.05] border border-white/10 rounded-2xl px-5 sm:px-6 py-4 sm:py-5 min-h-[48px] text-white text-base font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-white/20" placeholder="name@company.com">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[11px] font-bold uppercase tracking-[0.4em] text-white/40">Project Scope</label>
                            <textarea rows="5" class="w-full bg-white/[0.05] border border-white/10 rounded-[2rem] px-5 sm:px-6 py-4 sm:py-5 min-h-[140px] text-white text-base font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-white/20" placeholder="Describe your energy requirements (e.g. 50kW Hospital Hybrid System)..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-5 sm:py-6 min-h-[52px] bg-solarGreen text-deepForest font-black rounded-2xl shadow-[0_20px_50px_rgba(0,223,130,0.3)] hover:shadow-[0_25px_60px_rgba(0,223,130,0.5)] hover:-translate-y-1 active:scale-[0.99] transition-all group overflow-hidden relative uppercase tracking-widest text-[11px]">
                            <span class="relative z-10 flex items-center justify-center gap-4">Transmit Transmission <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg></span>
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Strategic Map Area — Google Maps (office: Near IIT Metro, Kalyanpur, Kanpur) -->
    @php
        $officeMapQuery = 'Near IIT Metro Station, Kalyanpur, Kanpur, Uttar Pradesh 208016, India';
        $officeMapEmbed = 'https://maps.google.com/maps?q=' . rawurlencode($officeMapQuery) . '&hl=en&z=16&ie=UTF8&t=m&output=embed';
        $officeMapExternal = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($officeMapQuery);
    @endphp
    <section class="py-16 sm:py-20 px-4 sm:px-6 marketing-section-bg border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto reveal-up">
            <div class="relative h-[min(420px,70vh)] sm:h-[500px] rounded-[2rem] sm:rounded-[3rem] border border-white/[0.06] shadow-xl overflow-hidden bg-deepForest/95 ring-1 ring-white/10">
                <iframe
                    class="absolute inset-0 w-full h-full border-0 [color-scheme:light]"
                    src="{{ $officeMapEmbed }}"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="U.P.R. Solar office — {{ $officeMapQuery }}"
                ></iframe>
                <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
                    {{-- Dark caption band in both themes (obsidian → light mint in lm, which ruined contrast over the map) --}}
                    <div class="lm-surface-dark bg-gradient-to-t from-deepForest from-20% via-deepForest/95 to-transparent px-5 sm:px-8 pt-16 pb-5 sm:pb-6">
                        <h4 class="text-base font-bold text-white tracking-tighter uppercase [text-shadow:0_1px_2px_rgba(0,0,0,0.5)]">Geographic Hub: Kanpur</h4>
                        <p class="text-white/70 font-bold uppercase tracking-[0.18em] sm:tracking-[0.2em] text-[10px] sm:text-[11px] mt-1.5 max-w-xl leading-relaxed [text-shadow:0_1px_2px_rgba(0,0,0,0.45)]">Serving Uttar Pradesh &amp; North India <span class="text-white/50">|</span> MNRE Registered</p>
                        <a href="{{ $officeMapExternal }}" target="_blank" rel="noopener noreferrer" class="pointer-events-auto inline-flex items-center gap-2 mt-4 min-h-[44px] text-solarGreen text-[11px] font-bold uppercase tracking-wider hover:text-white transition-colors [text-shadow:0_1px_2px_rgba(0,0,0,0.35)]">
                            <span>Open in Google Maps</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16 pt-8 border-t border-white/5 text-[11px] font-medium text-white/20 uppercase tracking-wider text-center">
        © 2026 U.P.R. Solar Green Energy™ | U.P. Refrigeration & Sales Co.
    </div>
</footer>
@endsection
