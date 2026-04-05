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
                <a href="{{ $link }}" class="text-[10px] font-black uppercase tracking-[0.2em] {{ Request::is(trim($link, '/')) ? 'text-solarGreen' : 'text-deepForest/60' }} hover:text-solarGreen transition-colors">{{ $label }}</a>
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
    <!-- Contact Hero: Precision & Clarity -->
    <section class="relative py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 reveal-up">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full mb-10">
                <span class="text-[10px] uppercase font-black tracking-[0.3em] text-solarGreen">Direct Channels Active</span>
            </div>
            
            <h1 class="text-7xl md:text-9xl font-black font-heading leading-[0.85] tracking-tighter text-deepForest mb-10">
                CONNECT <br/> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-600 italic">WITH LIGHT.</span>
            </h1>
            
            <p class="text-lg text-deepForest/60 max-w-xl leading-relaxed font-medium">
                Request a site assessment, technical consultation, or project quote. Our engineering team responds within 24 operational hours.
            </p>
        </div>

        <!-- Geometric Light Accents -->
        <div class="absolute bottom-0 right-0 w-[800px] h-[800px] bg-solarGreen/5 blur-[150px] rounded-full -z-10 translate-x-1/2 translate-y-1/2"></div>
    </section>

    <!-- Interactive Contact Hub -->
    <section class="pb-32 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-5 gap-12">
            <!-- Left: Contact Details (Bento Cards) -->
            <div class="lg:col-span-2 space-y-6 reveal-left">
                <div class="p-10 bg-white rounded-[3rem] border border-deepForest/5 shadow-sm group hover:border-solarGreen/30 transition-all duration-500">
                    <div class="w-12 h-12 bg-solarGreen/10 rounded-2xl flex items-center justify-center text-solarGreen mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-4">Command Center</h4>
                    <p class="text-xl md:text-2xl font-bold text-deepForest leading-tight">Near IIT Metro Station, <br/> Kanpur, Uttar Pradesh, <br/> India - 208016</p>
                </div>

                <div class="p-10 bg-deepForest text-white rounded-[3rem] border border-white/5 shadow-2xl group hover:border-solarGreen/50 transition-all duration-500">
                    <div class="w-12 h-12 bg-solarGreen rounded-2xl flex items-center justify-center text-deepForest mb-8 group-hover:rotate-12 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-4">Voice Comms</h4>
                    <ul class="space-y-4 text-xl md:text-2xl font-bold tracking-tighter">
                        <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors">+91-9412452844</a></li>
                        <li><a href="tel:+919336852500" class="hover:text-solarGreen transition-colors">+91-9336852500</a></li>
                    </ul>
                </div>

                <div class="p-10 bg-white rounded-[3rem] border border-deepForest/5 shadow-sm group hover:border-solarGreen/30 transition-all duration-500">
                    <div class="w-12 h-12 bg-solarGreen/10 rounded-2xl flex items-center justify-center text-solarGreen mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/></svg>
                    </div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-4">Digital Mail</h4>
                    <p class="text-xl md:text-2xl font-bold text-deepForest leading-tight lowercase">info@uprsolar.com</p>
                </div>
            </div>

            <!-- Right: Inquiry Form (Premium Glass) -->
            <div class="lg:col-span-3 reveal-right">
                <div class="bg-white rounded-[4rem] p-12 md:p-16 border border-deepForest/5 shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-12 opacity-5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="m2 12h2"/><path d="m20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                    </div>

                    <h2 class="text-2xl md:text-3xl font-bold text-deepForest tracking-tighter mb-12 uppercase italic">Inquiry <span class="text-solarGreen">Portal.</span></h2>
                    
                    <form class="space-y-10">
                        <div class="grid md:grid-cols-2 gap-10">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-deepForest/40">Full Name</label>
                                <input type="text" class="w-full bg-auroraWhite border-none rounded-2xl px-6 py-5 text-deepForest font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-deepForest/20" placeholder="e.g. Anubhav Jain">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-deepForest/40">Technical Contact</label>
                                <input type="tel" class="w-full bg-auroraWhite border-none rounded-2xl px-6 py-5 text-deepForest font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-deepForest/20" placeholder="+91 XXX XXX XXXX">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.4em] text-deepForest/40">Enterprise Email</label>
                            <input type="email" class="w-full bg-auroraWhite border-none rounded-2xl px-6 py-5 text-deepForest font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-deepForest/20" placeholder="name@company.com">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.4em] text-deepForest/40">Project Scope</label>
                            <textarea rows="5" class="w-full bg-auroraWhite border-none rounded-[2rem] px-6 py-5 text-deepForest font-bold focus:ring-2 focus:ring-solarGreen transition-all placeholder:text-deepForest/20" placeholder="Describe your energy requirements (e.g. 50kW Hospital Hybrid System)..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-6 bg-solarGreen text-deepForest font-black rounded-2xl shadow-[0_20px_50px_rgba(0,223,130,0.3)] hover:shadow-[0_25px_60px_rgba(0,223,130,0.5)] hover:-translate-y-1 transition-all group overflow-hidden relative uppercase tracking-widest text-[11px]">
                            <span class="relative z-10 flex items-center justify-center gap-4">Transmit Transmission <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg></span>
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Strategic Map Area -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto h-[500px] bg-white rounded-[4rem] border border-deepForest/5 shadow-xl relative overflow-hidden group">
            <div class="absolute inset-0 bg-auroraWhite flex flex-col items-center justify-center text-center p-12">
                <div class="w-20 h-20 bg-solarGreen/10 rounded-full flex items-center justify-center text-solarGreen mb-6 group-hover:scale-110 transition-transform animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h4 class="text-xl font-bold text-deepForest tracking-tighter mb-4 uppercase">Geographic Hub: Kanpur</h4>
                <p class="text-deepForest/40 font-bold uppercase tracking-[0.2em] text-[10px]">Serving Uttar Pradesh & North India | MNRE Registered</p>
                
                <!-- Technical Overlay Graphics -->
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none select-none">
                    <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#0B0F0E_1px,transparent_1px)] [background-size:20px_20px]"></div>
                </div>
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
            <p class="text-base font-bold text-white/40 leading-relaxed">
                MNRE & ISO Certified Solar Infrastructure. <br/> Engineering India's Future since 2013.
            </p>
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
@endsection
