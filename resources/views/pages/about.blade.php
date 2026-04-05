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
    <!-- About Hero: Defining the Legacy -->
    <section class="relative py-32 overflow-hidden">
        <!-- Dynamic Solar Grid Background -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none select-none -z-10">
            <div class="absolute inset-0 bg-[radial-gradient(#0B0F0E_1.5px,transparent_1.5px)] [background-size:40px_40px]"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-white via-transparent to-white"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div class="space-y-12 reveal-up">
                <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full">
                    <span class="text-[10px] uppercase font-black tracking-[0.3em] text-solarGreen">ESTABLISHED 2013</span>
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black font-heading leading-[0.85] tracking-tighter text-deepForest uppercase">
                    ENGINEERING <br/> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-600 italic">DOMINANCE</span> <br/>
                    IN RENEWABLES.
                </h1>
                
                <p class="text-lg text-deepForest/60 max-w-lg leading-relaxed font-medium">
                    U.P.R. Solar Green Energy™ has pioneered sustainable engineering across Uttar Pradesh for over a decade. We don't just install panels; we architect energy independence.
                </p>

                <!-- Premium Stats Bento Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-8 bg-white rounded-[2rem] border border-deepForest/5 shadow-[0_10px_40px_rgba(0,0,0,0.02)] group hover:border-solarGreen/20 transition-all">
                        <div class="text-3xl font-bold text-deepForest mb-1">10Y+</div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-solarGreen">Pure Legacy</div>
                    </div>
                    <div class="p-8 bg-white rounded-[2rem] border border-deepForest/5 shadow-[0_10px_40px_rgba(0,0,0,0.02)] group hover:border-solarGreen/20 transition-all">
                        <div class="text-3xl font-bold text-deepForest mb-1">5000+</div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-solarGreen">Roofs Powered</div>
                    </div>
                </div>
            </div>

            <div class="relative group">
                <div class="aspect-[4/5] rounded-[4rem] overflow-hidden shadow-2xl relative border-8 border-white">
                    <img src="https://images.unsplash.com/photo-1542332213-31f87348057f?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Solar Engineering">
                    <div class="absolute inset-0 bg-gradient-to-t from-deepForest/40 to-transparent"></div>
                    
                    <div class="absolute bottom-8 left-8 right-8 p-10 bg-white/95 backdrop-blur-xl rounded-[3rem] border border-white/20 shadow-2xl">
                        <div class="text-[11px] font-black uppercase tracking-widest text-solarGreen mb-4">Our Mission</div>
                        <p class="text-lg font-bold text-deepForest leading-snug tracking-tight">"To democratize clean energy by providing industrial-grade engineering to every household in India."</p>
                    </div>
                </div>
                
                <!-- Geometric Accents -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-solarGreen/10 blur-3xl rounded-full"></div>
            </div>
        </div>
    </section>
    
    <!-- Founder's Vision: The Human Core -->
    <section class="py-32 bg-deepForest relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(0,223,130,0.05),transparent_50%)]"></div>
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-24 items-center relative z-10">
            <div class="space-y-12 reveal-left">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-solarGreen"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen">DIRECTIVE FROM LEADERSHIP</span>
                </div>
                
                <h2 class="text-4xl md:text-6xl font-bold font-heading text-white tracking-tighter leading-[1.1] uppercase italic">
                    WE ARE NOT JUST <br/>
                    <span class="text-solarGreen">INSTALLING PANELS.</span> <br/>
                    WE ARE BUILDING <br/>
                    ENERGY FREEDOM.
                </h2>
                
                <div class="space-y-8">
                    <p class="text-lg text-white/50 leading-relaxed font-medium italic border-l-4 border-solarGreen/20 pl-8">
                        "In 2013, I saw a landscape where high-tech engineering was reserved for the few. U.P.R. Solar was born from a singular mission: to bring industrial-grade energy solutions to every rooftop in Uttar Pradesh, with zero compromise on precision."
                    </p>
                    
                    <div class="flex items-center gap-8 pt-6">
                        <div class="space-y-1">
                            <div class="text-white font-black uppercase tracking-widest text-[11px]">Surendra Jain</div>
                            <div class="text-solarGreen/40 font-bold uppercase tracking-widest text-[9px]">Founder & Chief Engineer</div>
                        </div>
                        <!-- Stylized Signature Effect -->
                        <div class="h-12 w-[1px] bg-white/10 rotate-12"></div>
                        <div class="text-2xl font-serif italic text-white/20 select-none">S. Jain</div>
                    </div>
                </div>
            </div>

            <div class="relative group reveal-right">
                <div class="aspect-square rounded-[4rem] overflow-hidden border border-white/5 shadow-2xl relative">
                    <img src="https://images.unsplash.com/photo-1594818379496-da1e345b0ded?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s]" alt="Founding Legacy">
                    <div class="absolute inset-0 bg-gradient-to-t from-deepForest to-transparent opacity-60"></div>
                </div>
                <!-- Interactive Blueprint Overlay -->
                <div class="absolute -bottom-8 -left-8 p-10 bg-solarGreen/90 backdrop-blur-xl rounded-[3rem] shadow-2xl max-w-xs group-hover:scale-105 transition-transform duration-500">
                    <div class="text-[9px] font-black uppercase tracking-widest text-deepForest mb-2">Technical Authority</div>
                    <p class="text-sm font-bold text-deepForest leading-tight">MNRE-Approved Technical Architect with 35+ years of combined engineering excellence.</p>
                </div>
            </div>
        </div>
    </section>



    <!-- Company Overview: Operational History -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-start">
                <div class="space-y-12 reveal-left">
                    <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full">
                        <span class="text-[10px] uppercase font-black tracking-[0.3em] text-solarGreen">Established 2018</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-deepForest tracking-tighter leading-tight uppercase">Operational <br/> <span class="italic text-solarGreen/60 text-3xl md:text-4xl">Excellence.</span></h2>
                    
                    <div class="space-y-6 text-lg text-deepForest/70 leading-relaxed font-medium">
                        <p>
                            Established in the year 2018, U.P Refrigeration and Sales Co in Radha Mohan Patel Market, Kalyanpur, Kanpur is a top player in the category Solar Panel Dealers. Our establishment acts as a one-stop destination servicing customers both local and from other parts of Kanpur.
                        </p>
                        <p>
                            Located prominently at GT Road, near IIT Metro Station, we have established a firm foothold in the industry through our core belief that customer satisfaction is as important as our products and services. Our dedicated team works tirelessly to achieve the common vision and larger goals of the company.
                        </p>
                    </div>
                </div>

                <div class="bg-auroraWhite rounded-[4rem] p-12 border border-deepForest/5 shadow-sm reveal-right">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-solarGreen mb-10">Primary Specializations</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach([
                            'Solar Panel Dealers', 
                            'Installation Services', 
                            'Inverter Battery Dealers', 
                            'Solar Energy Systems',
                            'Solar Inverter Dealers',
                            'Panel Manufacturing',
                            'UTL Solar Solutions',
                            'Mounting Structures'
                        ] as $service)
                            <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-deepForest/[0.03]">
                                <span class="w-1.5 h-1.5 bg-solarGreen rounded-full"></span>
                                <span class="text-[11px] font-bold text-deepForest/60 uppercase tracking-widest">{{ $service }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section: Clarity in Engineering -->
    <section class="py-32 bg-auroraWhite relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-20 reveal-up">
                <div class="text-solarGreen font-black uppercase tracking-[0.4em] text-[10px] mb-4">Support Hub</div>
                <h2 class="text-4xl md:text-5xl font-bold font-heading text-deepForest tracking-tighter leading-tight uppercase italic text-center">Frequently Asked <br/> <span class="text-solarGreen">Questions.</span></h2>
            </div>

            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q' => 'What is the lifespan of solar panels?', 'a' => 'Most solar panels are engineered to last for 25–30 years with minimal degradation.'],
                        ['q' => 'What are the benefits of installing solar panels?', 'a' => 'Solar panels significantly reduce your electricity bills and offer various tax rebates and government incentives.'],
                        ['q' => 'Do solar panels work without sunlight?', 'a' => 'While maximum efficiency is achieved on sunny days, electricity is still produced during cloudy weather through diffused light.'],
                        ['q' => 'How can I locate U.P Refrigeration and Sales Co?', 'a' => 'We are prominently located at Radha Mohan Patel Market, GT Road, near the IIT Metro Station in Kanpur.'],
                        ['q' => 'How to maintain solar panels?', 'a' => 'Routine cleaning once a month is recommended to remove dust and improve the durability and efficiency of the arrays.'],
                        ['q' => 'Is getting solar panels for your home costly?', 'a' => 'Solar panels represent a one-time capital investment; once commissioned, they provide free electricity for decades.']
                    ];
                @endphp

                @foreach($faqs as $index => $f)
                    <div class="group reveal-up bg-white rounded-[2rem] border border-deepForest/5 overflow-hidden transition-all duration-500 hover:border-solarGreen/30">
                        <button class="w-full p-8 text-left flex justify-between items-center" onclick="toggleFaq({{ $index }})">
                            <span class="text-base font-bold text-deepForest uppercase tracking-tight">{{ $f['q'] }}</span>
                            <span class="w-8 h-8 rounded-full bg-auroraWhite flex items-center justify-center transition-transform group-hover:bg-solarGreen group-hover:text-deepForest" id="faq-icon-{{ $index }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </span>
                        </button>
                        <div class="max-h-0 overflow-hidden transition-all duration-500 bg-white" id="faq-content-{{ $index }}">
                            <div class="p-8 pt-0 text-sm text-deepForest/60 leading-relaxed font-medium">
                                {{ $f['a'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        function toggleFaq(index) {
            const content = document.getElementById(`faq-content-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);
            
            // Close others
            document.querySelectorAll('[id^="faq-content-"]').forEach((el, i) => {
                if (i !== index) {
                    el.style.maxHeight = null;
                    document.getElementById(`faq-icon-${i}`).style.transform = 'rotate(0deg)';
                }
            });

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = 'rotate(180deg)';
            }
        }
    </script>

    <!-- Accreditation Wall: High Contrast -->
    <section class="py-32 bg-deepForest relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-[10px] font-black uppercase tracking-[0.8em] text-solarGreen mb-20 animate-pulse">GLOBAL ACCREDITATIONS</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 opacity-50 grayscale hover:grayscale-0 transition-all duration-700">
                <div class="text-white font-black text-2xl tracking-tighter">MNRE<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">GOVT OF INDIA</span></div>
                <div class="text-white font-black text-2xl tracking-tighter">ISO<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">9001:2015</span></div>
                <div class="text-white font-black text-2xl tracking-tighter">NEDA<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">LICENSED</span></div>
                <div class="text-white font-black text-2xl tracking-tighter">BEE<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">STAR RATED</span></div>
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
