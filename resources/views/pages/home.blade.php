@extends('layouts.react')

@section('content')
<nav class="sticky top-0 z-[100] glassmorphism py-4">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-solarGreen rounded-lg shadow-[0_0_15px_rgba(0,223,130,0.4)]">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0e0e0e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
            </div>
            <span class="text-xl font-black tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
        </div>
        
        <div class="hidden md:flex items-center gap-8">
            @foreach(['Home' => '/', 'About' => '/about', 'Products' => '/products', 'Services' => '/services', 'Gallery' => '/gallery', 'Projects' => '/projects', 'Contact' => '/contact'] as $label => $link)
                <a href="{{ $link }}" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-solarGreen transition-colors">{{ $label }}</a>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <a href="/products" class="p-2 text-gray-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            </a>
            <button class="px-6 py-2 bg-solarGreen text-obsidian font-black rounded-lg text-xs uppercase tracking-widest shadow-[0_0_20px_rgba(0,223,130,0.3)] hover:scale-105 transition-transform">Portal</button>
        </div>
    </div>
</nav>

<main>
    <!-- Solar Hero: Fixed Local Assets -->
    <section class="relative min-h-[85vh] flex items-center overflow-hidden bg-obsidian">
        <div class="absolute inset-0 z-0">
            <img src="/assets/images/hero.png" 
                 class="w-full h-full object-cover animate-ken-burns opacity-30" alt="Solar Field">
            <div class="absolute inset-0 bg-gradient-to-r from-obsidian via-obsidian/80 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 relative z-10 py-20">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-solarGreen/10 border border-solarGreen/20 rounded-full">
                    <span class="w-1.5 h-1.5 bg-solarGreen rounded-full animate-ping"></span>
                    <span class="text-[10px] uppercase font-black tracking-widest text-solarGreen">ISO Certified Engineering</span>
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black font-heading leading-[0.9] tracking-tighter text-white">
                    POWERING INDIA <br/>
                    <span class="text-solarGreen text-glow italic">WITH CLEAN ENERGY</span>
                </h1>
                
                <p class="text-lg text-gray-400 max-w-lg leading-relaxed font-medium">
                    MNRE & ISO Certified | 10+ Years Experience | Trusted by Kanpur & Uttar Pradesh. Reduce your electricity bills today with U.P.R. Solar Green Energy™.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="/contact" class="px-8 py-4 bg-solarOrange text-white font-black rounded-xl hover:bg-orange-600 transition-all shadow-[0_10px_30px_rgba(249,115,22,0.3)] hover:-translate-y-1">
                        Free Consultation
                    </a>
                    <a href="/products" class="px-8 py-4 bg-white/5 border border-white/10 text-white font-black rounded-xl hover:bg-white/10 transition-all backdrop-blur-md">
                        Shop Products
                    </a>
                </div>
            </div>

            <!-- Empty space for cinematic focus -->
            <div class="hidden md:block"></div>

        </div>
    </section>

    <!-- Certification Wall -->
    <section class="py-12 bg-obsidianLight border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 flex flex-wrap justify-center items-center gap-12 opacity-50 grayscale hover:grayscale-0 transition-all">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white">MNRE CERTIFIED</span>
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white">ISO 9001:2015</span>
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white">UP-NEDA LICENSED</span>
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white">GOVERNMENT APPROVED</span>
        </div>
    </section>

    <!-- The 3D Hub -->
    <section class="py-32 bg-obsidian">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-20">
            <div class="md:w-1/2 space-y-8">
                <h2 class="text-5xl md:text-7xl font-black font-heading leading-none tracking-tighter uppercase">Quantum <br/> <span class="text-solarGreen">Efficiency</span></h2>
                <p class="text-lg text-gray-400 font-medium">
                    Featuring our **Mono PERC 540W** high-yield flagship panel. Designed specifically for the high-intensity sunlight cycles of North India.
                </p>
                
                <div class="pt-8 border-t border-white/5">
                    <a href="/products" class="inline-flex items-center gap-4 text-solarGreen font-black uppercase tracking-[0.2em] group text-sm">
                        Explore Technology <span class="w-12 h-[2px] bg-solarGreen transition-all group-hover:w-20"></span>
                    </a>
                </div>
            </div>

            <!-- Panel Stage (3D) -->
            <div class="md:w-1/2 flex justify-center">
                <div id="solar-3d-panel" class="relative w-[300px] h-[500px] preserve-3d cursor-crosshair">
                    <div class="absolute inset-0 bg-[#1a1a1a] rounded-[2rem] border border-white/10 shadow-[0_50px_100px_rgba(0,0,0,0.5)] overflow-hidden transition-transform duration-200">
                        <div class="w-full h-full grid grid-cols-4 grid-rows-8 gap-1 p-2 opacity-80">
                            @for($i = 0; $i < 32; $i++)
                                <div class="bg-solarGreen/5 border border-white/5 rounded-sm"></div>
                            @endfor
                        </div>
                        <div class="absolute bottom-8 right-8 text-[8px] font-black tracking-widest text-solarGreen uppercase opacity-50">MODEL: MP-540-UPR</div>
                    </div>
                    <div class="absolute -top-10 -right-10 w-24 h-24 bg-solarGreen/10 blur-3xl animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid: Restored with Premium LOCAL images -->
    <section class="py-32 bg-obsidian">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="text-4xl font-black font-heading text-white">Best Selling Products</h2>
                    <p class="text-gray-500 mt-2">High-performance solar solutions from our Kanpur warehouse.</p>
                </div>
                <a href="/products" class="text-solarGreen font-bold uppercase tracking-widest text-[10px]">View Store →</a>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                @foreach([
                    ['n' => 'Mono PERC 540W', 'p' => '₹14,500', 'd' => 'Half-cut cell technology.', 'img' => '/assets/images/product1.png'],
                    ['n' => 'Hybrid Inverter 5kVA', 'p' => '₹45,000', 'd' => 'Smart pure sine wave.', 'img' => '/assets/images/product2.png'],
                    ['n' => 'Lithium Battery 100Ah', 'p' => '₹22,000', 'd' => 'Long-life LFP storage.', 'img' => '/assets/images/product3.png'],
                    ['n' => 'Solar Heater 200L', 'p' => '₹18,500', 'd' => 'ETC technology.', 'img' => '/assets/images/product4.png']
                ] as $p)
                    <div class="glassmorphism rounded-[2.5rem] p-5 hover:border-solarGreen/30 transition-all group overflow-hidden">
                        <div class="aspect-square rounded-[2rem] overflow-hidden mb-6 bg-obsidian">
                            <img src="{{ $p['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $p['n'] }}">
                        </div>
                        <div class="px-2">
                            <h3 class="text-base font-black text-white mb-1 uppercase tracking-tighter">{{ $p['n'] }}</h3>
                            <p class="text-[10px] text-gray-500 font-bold uppercase mb-4">{{ $p['d'] }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-solarGreen font-black text-lg">{{ $p['p'] }}</span>
                                <button class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-white hover:bg-solarGreen hover:text-obsidian transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg> 
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Voices of Trust -->
    <section class="py-32 bg-obsidian relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-black font-heading text-center mb-24">Voices of <span class="text-solarGreen italic">Trust</span></h2>
            <div class="grid md:grid-cols-3 gap-12">
                @foreach([
                    ['n' => 'Rahul Verma', 'l' => 'Kanpur', 'q' => 'Installed a 5kW solar system on my home. Excellent service and great after-sales support.'],
                    ['n' => 'Pooja Mishra', 'l' => 'Kalyanpur, Kanpur', 'q' => 'The best solar company in Kanpur. Genuine pricing, certified products, and smooth installation.'],
                    ['n' => 'Anuj Tiwari', 'l' => 'Barra, Kanpur', 'q' => 'Their team is very professional. My electricity bill dropped by more than 70%.']
                ] as $t)
                    <div class="p-10 glassmorphism rounded-[3rem] border-white/5 hover:border-solarGreen/20 transition-all">
                        <div class="text-solarGreen mb-6 flex gap-1">
                            @for($i=0; $i<5; $i++) <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-solarGreen"><path d="M12 1.7L15 9h7.7l-6.2 4.5 2.4 7.5L12 16.3l-6.9 4.7 2.4-7.5L1.3 9h7.7z"/></svg> @endfor
                        </div>
                        <p class="text-gray-400 italic mb-10 font-medium leading-relaxed">"{{ $t['q'] }}"</p>
                        <div>
                            <div class="text-base font-black text-white uppercase tracking-tighter">{{ $t['n'] }}</div>
                            <div class="text-[10px] text-gray-500 font-black tracking-widest uppercase">{{ $t['l'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-obsidian py-32 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12">
            <div class="space-y-8">
                <span class="text-3xl font-black font-heading tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest leading-loose">
                    MNRE & ISO Certified Solar Infrastructure. <br/> Since 2013 | Kanpur, Uttar Pradesh.
                </p>
            </div>
            
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-8">Base Branch</h4>
                <p class="text-sm font-bold text-gray-400 leading-relaxed">Near IIT Metro Station, <br/> Kanpur, Uttar Pradesh, <br/> India</p>
            </div>
            
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-8">Connect</h4>
                <ul class="space-y-4 text-sm font-bold text-gray-400">
                    <li><a href="tel:+919412452844" class="hover:text-solarGreen transition-colors">+91-9412452844</a></li>
                    <li><a href="mailto:info@uprsolargreenenergy.com" class="hover:text-solarGreen transition-colors italic">info@uprsolargreenenergy.com</a></li>
                </ul>
            </div>

            <div class="space-y-4">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-8">Status</h4>
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-solarGreen rounded-full animate-ping"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white">Accepting Installs</span>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 mt-32 pt-8 border-t border-white/5 text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] text-center">
            © 2026 U.P.R. Solar Green Energy™ (U.P. Refrigeration & Sales Co.).
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
        const rotateX = (mouseY - centerY) / 15;
        const rotateY = (centerX - mouseX) / 15;
        panel.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });
    panel.addEventListener('mouseleave', () => {
        panel.style.transform = `rotateX(0deg) rotateY(0deg)`;
    });
</script>

<style>
    .preserve-3d { transform-style: preserve-3d; perspective: 1000px; }
    #solar-3d-panel { transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .text-glow { text-shadow: 0 0 30px rgba(0, 223, 130, 0.4); }
</style>
@endsection
