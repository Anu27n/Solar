@extends('layouts.react')

@section('content')
@include('partials.navbar')

<main class="marketing-atmosphere relative">
@include('partials.marketing-page-atmosphere', [
    'marketingAtmosphereImage' => 'https://images.unsplash.com/photo-1542332213-31f87348057f?auto=format&fit=crop&w=1920&q=80',
    'marketingAtmospherePosition' => 'center 42%',
])
<div class="relative z-10">
    <!-- About Hero: Defining the Legacy -->
    <section class="relative py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] dark:opacity-[0.065] pointer-events-none select-none">
            <div class="absolute inset-0 bg-[radial-gradient(#00DF82_1px,transparent_1px)] [background-size:44px_44px]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center relative">
            <div class="space-y-10 sm:space-y-12 reveal-up">
                <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full">
                    <span class="text-[11px] uppercase font-bold tracking-[0.3em] text-solarGreen">ESTABLISHED 2013</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-black font-heading leading-[0.85] tracking-tighter text-white uppercase">
                    ENGINEERING <br/> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-solarGreen to-emerald-600 italic">DOMINANCE</span> <br/>
                    IN RENEWABLES.
                </h1>
                
                <p class="text-base text-white/50 max-w-lg leading-relaxed font-medium">
                    U.P.R. Solar Green Energy™ has pioneered sustainable engineering across Uttar Pradesh for over a decade. We don't just install panels; we architect energy independence.
                </p>

                <!-- Premium Stats Bento Grid -->
                <div class="grid grid-cols-2 gap-4 stagger-children">
                    <div class="p-7 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] group hover:border-solarGreen/20 transition-all hover-lift">
                        <div class="text-2xl font-bold text-white mb-1">10Y+</div>
                        <div class="text-[11px] font-bold uppercase tracking-widest text-solarGreen">Pure Legacy</div>
                    </div>
                    <div class="p-7 bg-white/[0.03] rounded-[2rem] border border-white/[0.06] group hover:border-solarGreen/20 transition-all hover-lift">
                        <div class="text-2xl font-bold text-white mb-1">5000+</div>
                        <div class="text-[11px] font-bold uppercase tracking-widest text-solarGreen">Roofs Powered</div>
                    </div>
                </div>
            </div>

            <div class="relative group reveal-scale max-w-lg mx-auto lg:max-w-none">
                <div class="aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl relative border-8 border-white/10">
                    <img src="https://images.unsplash.com/photo-1542332213-31f87348057f?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Solar Engineering">
                    <div class="absolute inset-0 bg-gradient-to-t from-deepForest/40 to-transparent"></div>
                    
                    <div class="lm-surface-dark absolute bottom-8 left-8 right-8 p-8 bg-white/[0.08] backdrop-blur-xl rounded-[2rem] border border-white/10 shadow-2xl">
                        <div class="text-[11px] font-bold uppercase tracking-widest text-solarGreen mb-4">Our Mission</div>
                        <p class="text-base font-bold text-white leading-snug tracking-tight">"To democratize clean energy by providing industrial-grade engineering to every household in India."</p>
                    </div>
                </div>
                
                <!-- Geometric Accents -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-solarGreen/10 blur-3xl rounded-full"></div>
            </div>
        </div>
    </section>
    
    <!-- Founder's Vision: The Human Core -->
    <section class="py-20 lg:py-28 bg-deepForest relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(0,223,130,0.05),transparent_50%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center relative z-10">
            <div class="space-y-12 reveal-left">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-solarGreen"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.4em] text-solarGreen">DIRECTIVE FROM LEADERSHIP</span>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-[1.1] uppercase italic">
                    WE ARE NOT JUST <br/>
                    <span class="text-solarGreen">INSTALLING PANELS.</span> <br/>
                    WE ARE BUILDING <br/>
                    ENERGY FREEDOM.
                </h2>
                
                <div class="space-y-8">
                    <p class="text-base text-white/50 leading-relaxed font-medium italic border-l-4 border-solarGreen/20 pl-8">
                        "In 2013, I saw a landscape where high-tech engineering was reserved for the few. U.P.R. Solar was born from a singular mission: to bring industrial-grade energy solutions to every rooftop in Uttar Pradesh, with zero compromise on precision."
                    </p>
                    
                    <div class="flex items-center gap-8 pt-6">
                        <div class="space-y-1">
                            <div class="text-white font-bold uppercase tracking-widest text-[11px]">Surendra Jain</div>
                            <div class="text-solarGreen/40 font-bold uppercase tracking-widest text-[9px]">Founder & Chief Engineer</div>
                        </div>
                        <div class="h-12 w-[1px] bg-white/10 rotate-12"></div>
                        <div class="text-2xl font-serif italic text-white/20 select-none">S. Jain</div>
                    </div>
                </div>
            </div>

            <div class="relative group reveal-right">
                <div class="aspect-square rounded-[3rem] overflow-hidden border border-white/5 shadow-2xl relative">
                    <img src="https://images.unsplash.com/photo-1594818379496-da1e345b0ded?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s]" alt="Founding Legacy">
                    <div class="absolute inset-0 bg-gradient-to-t from-deepForest to-transparent opacity-60"></div>
                </div>
                <div class="absolute -bottom-8 -left-8 p-8 bg-solarGreen/90 backdrop-blur-xl rounded-[2rem] shadow-2xl max-w-xs group-hover:scale-105 transition-transform duration-500 hover-lift">
                    <div class="text-[11px] font-bold uppercase tracking-widest text-deepForest mb-2">Technical Authority</div>
                    <p class="text-sm font-bold text-deepForest leading-tight">MNRE-Approved Technical Architect with 35+ years of combined engineering excellence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Overview: Operational History -->
    <section class="py-20 lg:py-28 marketing-section-bg relative overflow-hidden border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <div class="space-y-12 reveal-left">
                    <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-solarGreen/10 rounded-full">
                        <span class="text-[11px] uppercase font-bold tracking-[0.3em] text-solarGreen">Established 2018</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-tight uppercase">Operational <br/> <span class="italic text-solarGreen/60 text-2xl md:text-3xl">Excellence.</span></h2>
                    
                    <div class="space-y-6 text-sm text-white/50 leading-relaxed font-medium">
                        <p>
                            Established in the year 2018, U.P Refrigeration and Sales Co in Radha Mohan Patel Market, Kalyanpur, Kanpur is a top player in the category Solar Panel Dealers. Our establishment acts as a one-stop destination servicing customers both local and from other parts of Kanpur.
                        </p>
                        <p>
                            Located prominently at GT Road, near IIT Metro Station, we have established a firm foothold in the industry through our core belief that customer satisfaction is as important as our products and services. Our dedicated team works tirelessly to achieve the common vision and larger goals of the company.
                        </p>
                    </div>
                </div>

                <div class="bg-white/[0.03] rounded-[3rem] p-8 border border-white/[0.06] shadow-sm reveal-right hover-lift">
                    <h4 class="text-[11px] font-bold uppercase tracking-[0.4em] text-solarGreen mb-10">Primary Specializations</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 stagger-children">
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
                            <div class="flex items-center gap-4 p-4 bg-white/[0.03] rounded-2xl border border-white/[0.06]">
                                <span class="w-1.5 h-1.5 bg-solarGreen rounded-full"></span>
                                <span class="text-[11px] font-bold text-white/50 uppercase tracking-widest">{{ $service }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section: Clarity in Engineering -->
    <section class="py-20 lg:py-28 marketing-section-bg relative overflow-hidden border-t border-white/[0.06]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16 reveal-up">
                <div class="text-solarGreen font-bold uppercase tracking-[0.4em] text-[11px] mb-4">Support Hub</div>
                <h2 class="text-3xl md:text-4xl font-bold font-heading text-white tracking-tighter leading-tight uppercase italic text-center">Frequently Asked <br/> <span class="text-solarGreen">Questions.</span></h2>
            </div>

            <div class="space-y-4 stagger-children">
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
                    <div class="group reveal-up bg-white/[0.03] rounded-[2rem] border border-white/[0.06] overflow-hidden transition-all duration-500 hover:border-solarGreen/30 hover-lift">
                        <button class="w-full p-7 text-left flex justify-between items-center" onclick="toggleFaq({{ $index }})">
                            <span class="text-sm font-bold text-white uppercase tracking-tight">{{ $f['q'] }}</span>
                            <span class="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center transition-transform group-hover:bg-solarGreen group-hover:text-deepForest" id="faq-icon-{{ $index }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </span>
                        </button>
                        <div class="max-h-0 overflow-hidden transition-all duration-500" id="faq-content-{{ $index }}">
                            <div class="p-7 pt-0 text-sm text-white/50 leading-relaxed font-medium">
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
    <section class="py-16 sm:py-20 lg:py-28 bg-deepForest relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center reveal-up">
            <h3 class="text-[10px] sm:text-[11px] font-bold uppercase tracking-[0.5em] sm:tracking-[0.8em] text-solarGreen mb-12 sm:mb-16 animate-pulse">GLOBAL ACCREDITATIONS</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 sm:gap-12 opacity-50 grayscale hover:grayscale-0 transition-all duration-700 stagger-children">
                <div class="text-white font-black text-2xl tracking-tighter">MNRE<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">GOVT OF INDIA</span></div>
                <div class="text-white font-black text-2xl tracking-tighter">ISO<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">9001:2015</span></div>
                <div class="text-white font-black text-2xl tracking-tighter">NEDA<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">LICENSED</span></div>
                <div class="text-white font-black text-2xl tracking-tighter">BEE<br/><span class="text-[8px] tracking-[0.4em] text-solarGreen">STAR RATED</span></div>
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16 pt-8 border-t border-white/5 text-[11px] font-medium text-white/20 uppercase tracking-wider text-center">
        © 2026 U.P.R. Solar Green Energy™ | U.P. Refrigeration & Sales Co.
    </div>
</footer>
@endsection
