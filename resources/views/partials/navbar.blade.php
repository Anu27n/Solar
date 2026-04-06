<nav class="sticky top-0 z-[100] transition-all duration-500 px-4 md:px-6 py-4" id="main-nav">
    <div class="max-w-7xl mx-auto flex justify-between items-center glassmorphism rounded-2xl px-5 py-3 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] border border-white/10">
        <a href="/" class="flex items-center gap-2.5 group">
            <div class="p-1.5 bg-solarGreen rounded-xl shadow-lg shadow-solarGreen/20 group-hover:shadow-solarGreen/40 transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
            </div>
            <span class="text-lg font-black tracking-tighter uppercase text-white">U.P.R. <span class="text-solarGreen">Solar</span></span>
        </a>
        
        <div class="hidden md:flex items-center gap-1">
            @foreach(['Home' => '/', 'About' => '/about', 'Products' => '/products', 'Services' => '/services', 'Gallery' => '/gallery', 'Projects' => '/projects', 'Contact' => '/contact'] as $label => $link)
                @php $isActive = ($link === '/' && Request::is('/')) || ($link !== '/' && Request::is(trim($link, '/').'*')); @endphp
                <a href="{{ $link }}" class="nav-pill px-3.5 py-2 rounded-lg text-[11px] font-bold uppercase tracking-[0.12em] {{ $isActive ? 'text-solarGreen bg-solarGreen/10' : 'text-white/50' }} hover:text-solarGreen hover:bg-solarGreen/5 transition-all duration-300">{{ $label }}</a>
            @endforeach
        </div>

        <div class="flex items-center gap-2">
            <button onclick="toggleSiteTheme()" class="site-theme-toggle" title="Toggle theme" aria-label="Toggle theme">
                {{-- Sun icon (shown in dark mode) --}}
                <svg class="hidden dark:block" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                {{-- Moon icon (shown in light mode) --}}
                <svg class="block dark:hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>
            <a href="{{ route('portal') }}" class="hidden sm:inline-flex px-4 py-2 border border-white/10 text-white/70 font-bold rounded-xl text-[11px] uppercase tracking-wider hover:bg-white/10 hover:text-white transition-all duration-300">Portal</a>
            <a href="/contact" class="hidden sm:inline-flex magnetic-btn px-5 py-2.5 bg-solarGreen text-deepForest font-bold rounded-xl text-[11px] uppercase tracking-wider shadow-lg shadow-solarGreen/20 hover:shadow-solarGreen/40 hover:-translate-y-0.5 transition-all duration-300">Get Quote</a>
            <button id="mobile-menu-btn" class="md:hidden p-2 text-white/70" aria-label="Menu" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
    <div id="mobile-menu" class="mobile-menu md:hidden mt-2 glassmorphism rounded-2xl shadow-2xl mx-auto max-w-7xl overflow-hidden">
        <div class="p-4 flex flex-col gap-1">
            @foreach(['Home' => '/', 'About' => '/about', 'Products' => '/products', 'Services' => '/services', 'Gallery' => '/gallery', 'Projects' => '/projects', 'Contact' => '/contact'] as $label => $link)
                <a href="{{ $link }}" class="px-4 py-3 text-sm font-bold text-white/60 hover:text-solarGreen hover:bg-solarGreen/5 rounded-xl transition-all">{{ $label }}</a>
            @endforeach
            <div class="border-t border-white/5 mt-1 pt-1 flex items-center justify-between">
                <a href="{{ route('portal') }}" class="px-4 py-3 text-sm font-bold text-solarGreen hover:bg-solarGreen/5 rounded-xl transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                    Portal Login
                </a>
                <button onclick="toggleSiteTheme()" class="site-theme-toggle mr-2" title="Toggle theme">
                    <svg class="hidden dark:block" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                    <svg class="block dark:hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>
            </div>
        </div>
    </div>
</nav>
