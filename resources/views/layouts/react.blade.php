<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'U.P.R. Solar Green Energy™') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        solarGreen: '#00DF82',
                        solarGreenDark: '#00B368',
                        navyBlue: '#0A2540',
                        obsidian: '#0e0e0e',
                        obsidianLight: '#131313',
                        obsidianHigh: '#262626',
                        solarOrange: '#F97316',
                        auroraWhite: '#F8FAFC',
                        auroraGray: '#E2E8F0',
                        deepForest: '#0B0F0E',
                        glassWhite: 'rgba(255,255,255,0.05)',
                        glassBorder: 'rgba(255,255,255,0.1)',
                        glassLight: 'rgba(255,255,255,0.7)',
                    },
                    fontFamily: {
                        sans: ['Manrope', 'Inter', 'sans-serif'],
                        heading: ['Outfit', 'Inter', 'sans-serif'],
                        display: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <script>
        (function(){
            var t = localStorage.getItem('site-theme');
            var el = document.documentElement;
            if (t === 'light') el.classList.remove('dark');
            else el.classList.add('dark');
        })();
    </script>
    <style>
        :root { --solar-green: #00DF82; }

        body {
            font-family: 'Manrope', sans-serif;
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        /* ─── DARK MODE (default) ─── */
        .dark body { background-color: #0e0e0e; color: #ffffff; }
        .dark .glassmorphism {
            background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
        }

        /* ─── LIGHT MODE ─── */
        html:not(.dark) body { background-color: #f8fafc; color: #0B0F0E; }
        html:not(.dark) .glassmorphism {
            background: rgba(255,255,255,0.75); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        /* Light mode section overrides */
        html:not(.dark) .bg-obsidian { background-color: #f8fafc; }
        html:not(.dark) .bg-obsidianLight { background-color: #ffffff; }
        html:not(.dark) .border-white\/5 { border-color: rgba(0,0,0,0.05); }
        html:not(.dark) .border-white\/10 { border-color: rgba(0,0,0,0.08); }
        html:not(.dark) .divide-white\/5 > :not([hidden]) ~ :not([hidden]) { border-color: rgba(0,0,0,0.05); }

        /* Light mode text -- only inside <main> so nav stays readable */
        html:not(.dark) main .text-white { color: #0B0F0E; }
        html:not(.dark) main .text-white\/80 { color: rgba(11,15,14,0.8); }
        html:not(.dark) main .text-white\/70 { color: rgba(11,15,14,0.7); }
        html:not(.dark) main .text-white\/60 { color: rgba(11,15,14,0.6); }
        html:not(.dark) main .text-white\/50 { color: rgba(11,15,14,0.5); }
        html:not(.dark) main .text-white\/40 { color: rgba(11,15,14,0.4); }
        html:not(.dark) main .text-white\/30 { color: rgba(11,15,14,0.3); }
        html:not(.dark) main .text-white\/25 { color: rgba(11,15,14,0.2); }
        html:not(.dark) main .text-white\/20 { color: rgba(11,15,14,0.15); }
        html:not(.dark) main .text-white\/15 { color: rgba(11,15,14,0.1); }

        /* Nav text flip in light mode */
        html:not(.dark) nav .text-white { color: #0B0F0E; }
        html:not(.dark) nav .text-white\/70 { color: rgba(11,15,14,0.7); }
        html:not(.dark) nav .text-white\/60 { color: rgba(11,15,14,0.6); }
        html:not(.dark) nav .text-white\/50 { color: rgba(11,15,14,0.5); }

        /* Light mode card/surface overrides */
        html:not(.dark) .bg-white\/\[0\.02\] { background-color: rgba(255,255,255,0.7); }
        html:not(.dark) .bg-white\/\[0\.03\] { background-color: rgba(255,255,255,0.8); }
        html:not(.dark) .bg-white\/\[0\.04\] { background-color: rgba(255,255,255,0.85); }
        html:not(.dark) .bg-white\/\[0\.05\] { background-color: rgba(255,255,255,0.9); }
        html:not(.dark) .border-white\/\[0\.04\] { border-color: rgba(0,0,0,0.04); }
        html:not(.dark) .border-white\/\[0\.06\] { border-color: rgba(0,0,0,0.06); }
        html:not(.dark) .border-solarGreen\/20 { border-color: rgba(0,223,130,0.25); }

        /* Light mode shadows on cards */
        html:not(.dark) .hover-lift:hover { box-shadow: 0 20px 60px rgba(0,0,0,0.08); }
        html:not(.dark) .tilt-card { box-shadow: 0 1px 3px rgba(0,0,0,0.04); }

        /* Footer stays dark in both modes */
        footer .text-white { color: #ffffff !important; }
        footer .text-white\/40 { color: rgba(255,255,255,0.4) !important; }
        footer .text-white\/30 { color: rgba(255,255,255,0.3) !important; }
        footer .text-white\/25 { color: rgba(255,255,255,0.25) !important; }
        footer .text-white\/15 { color: rgba(255,255,255,0.15) !important; }
        html:not(.dark) footer { background-color: #0B0F0E !important; }
        html:not(.dark) footer .border-white\/5 { border-color: rgba(255,255,255,0.05) !important; }

        /* Page loader respects theme */
        html:not(.dark) .page-loader { background: #f8fafc; }
        html:not(.dark) .loader-bar { background: rgba(0,0,0,0.06); }

        /* Cursor glow in light mode */
        html:not(.dark) .cursor-glow { background: radial-gradient(circle, rgba(0,223,130,0.04) 0%, transparent 70%); }

        /* Theme toggle for marketing site */
        .site-theme-toggle {
            width: 36px; height: 36px; border-radius: 10px; cursor: pointer; display: flex;
            align-items: center; justify-content: center; transition: all 0.3s ease; border: none;
        }
        .dark .site-theme-toggle { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.5); }
        .dark .site-theme-toggle:hover { background: rgba(255,255,255,0.1); color: #fff; }
        html:not(.dark) .site-theme-toggle { background: rgba(0,0,0,0.04); color: rgba(0,0,0,0.4); }
        html:not(.dark) .site-theme-toggle:hover { background: rgba(0,0,0,0.08); color: #0B0F0E; }

        /* Text shimmer in light mode */
        html:not(.dark) .text-shimmer {
            background: linear-gradient(90deg, #00B368 0%, #00DF82 25%, #00B368 50%, #00DF82 75%, #00B368 100%);
            background-size: 300% 100%; -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent; animation: shimmer 4s ease-in-out infinite;
        }

        /* Panel surface in light mode */
        html:not(.dark) .panel-surface { background: linear-gradient(135deg, #e8f5ee 0%, #d1e8db 50%, #e0f0e6 100%); }

        .glow-green { filter: drop-shadow(0 0 10px rgba(0, 223, 130, 0.3)); }
        .text-glow { text-shadow: 0 0 20px rgba(0, 223, 130, 0.2); }
        .no-scrollbar::-webkit-scrollbar { display: none; }

        .surface-3d { position: relative; }
        .surface-3d::after {
            content: '';
            position: absolute;
            inset: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            pointer-events: none;
            border-radius: inherit;
        }

        /* Scroll-triggered reveal system */
        .reveal-up, .reveal-left, .reveal-right, .reveal-scale {
            opacity: 0;
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-up    { transform: translateY(40px); }
        .reveal-left  { transform: translateX(-40px); }
        .reveal-right { transform: translateX(40px); }
        .reveal-scale { transform: scale(0.95); }

        .reveal-up.revealed,
        .reveal-left.revealed,
        .reveal-right.revealed,
        .reveal-scale.revealed {
            opacity: 1;
            transform: translate(0) scale(1);
        }

        /* Stagger children */
        .stagger-children > * { opacity: 0; transform: translateY(24px);
            transition: opacity 0.6s cubic-bezier(0.16,1,0.3,1), transform 0.6s cubic-bezier(0.16,1,0.3,1); }
        .stagger-children.revealed > *:nth-child(1) { transition-delay: 0ms; }
        .stagger-children.revealed > *:nth-child(2) { transition-delay: 80ms; }
        .stagger-children.revealed > *:nth-child(3) { transition-delay: 160ms; }
        .stagger-children.revealed > *:nth-child(4) { transition-delay: 240ms; }
        .stagger-children.revealed > *:nth-child(5) { transition-delay: 320ms; }
        .stagger-children.revealed > *:nth-child(6) { transition-delay: 400ms; }
        .stagger-children.revealed > *:nth-child(7) { transition-delay: 480ms; }
        .stagger-children.revealed > *:nth-child(8) { transition-delay: 560ms; }
        .stagger-children.revealed > * { opacity: 1; transform: translateY(0); }

        /* Smooth parallax-like float */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(-1deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; filter: blur(4px); }
            50% { opacity: 1; filter: blur(8px); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }
        .animate-float-slow { animation: float-slow 7s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 2s infinite; }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent 0%, rgba(0,223,130,0.08) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        /* Magnetic hover for cards */
        .hover-lift {
            transition: transform 0.4s cubic-bezier(0.16,1,0.3,1), box-shadow 0.4s ease;
        }
        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }

        /* Mobile menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.16,1,0.3,1);
        }
        .mobile-menu.open { max-height: 500px; }

        .count-up { font-variant-numeric: tabular-nums; }

        /* Nav pill animated underline */
        .nav-pill { position: relative; }
        .nav-pill::after {
            content: ''; position: absolute; bottom: 2px; left: 50%; width: 0; height: 1.5px;
            background: #00DF82; border-radius: 1px; transition: all 0.3s ease; transform: translateX(-50%);
        }
        .nav-pill:hover::after, .nav-pill.text-solarGreen::after { width: 60%; }

        /* Orbit animations for hero */
        @keyframes orbit { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes orbit-reverse { 0% { transform: rotate(360deg); } 100% { transform: rotate(0deg); } }
        .orbit-ring { animation: orbit 25s linear infinite; }
        .orbit-ring-reverse { animation: orbit-reverse 35s linear infinite; }

        @keyframes scan { 0% { top: -2px; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: 100%; opacity: 0; } }
        .scan-line { animation: scan 4s ease-in-out infinite; }

        @keyframes cell-activate { 0%, 100% { opacity: 0; } 50% { opacity: 1; } }
        .solar-cell .cell-glow { animation: cell-activate 3s ease-in-out infinite; }
        .solar-cell:nth-child(odd) .cell-glow { animation-delay: 0.5s; }
        .solar-cell:nth-child(3n) .cell-glow { animation-delay: 1s; }
        .solar-cell:nth-child(4n+1) .cell-glow { animation-delay: 1.5s; }

        .preserve-3d { transform-style: preserve-3d; perspective: 1500px; }
        .panel-surface { background: linear-gradient(135deg, #0a1628 0%, #071020 50%, #0d1830 100%); }

        .text-shimmer {
            background: linear-gradient(90deg, #00DF82 0%, #34d399 25%, #00DF82 50%, #34d399 75%, #00DF82 100%);
            background-size: 300% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s ease-in-out infinite;
        }

        /* Page loader */
        .page-loader {
            position: fixed; inset: 0; z-index: 9999;
            background: #0e0e0e;
            display: flex; align-items: center; justify-content: center;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        .page-loader.loaded { opacity: 0; visibility: hidden; pointer-events: none; }
        .loader-bar { width: 48px; height: 3px; background: rgba(255,255,255,0.08); border-radius: 2px; overflow: hidden; }
        .loader-bar::after {
            content: ''; display: block; width: 50%; height: 100%; border-radius: 2px;
            background: #00DF82; animation: loader-slide 0.8s ease-in-out infinite alternate;
        }
        @keyframes loader-slide { from { transform: translateX(0); } to { transform: translateX(100%); } }

        /* Cursor glow - follows mouse on hero */
        .cursor-glow {
            position: fixed; pointer-events: none; z-index: 50;
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(0,223,130,0.06) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
            opacity: 0;
        }
        .cursor-glow.visible { opacity: 1; }

        /* Magnetic button */
        .magnetic-btn {
            transition: transform 0.3s cubic-bezier(0.16,1,0.3,1);
        }

        /* Tilt card */
        .tilt-card {
            transition: transform 0.4s cubic-bezier(0.16,1,0.3,1);
            transform-style: preserve-3d;
        }

        /* Smooth gradient line */
        .gradient-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,223,130,0.3), transparent);
        }

        /* Typewriter effect */
        @keyframes blink-caret { 0%, 100% { border-color: #00DF82; } 50% { border-color: transparent; } }
        .type-cursor { border-right: 2px solid #00DF82; animation: blink-caret 1s step-end infinite; padding-right: 2px; }
    </style>
</head>
<body class="antialiased bg-obsidian text-white">
    <div class="page-loader" id="page-loader"><div class="loader-bar"></div></div>
    <div class="cursor-glow" id="cursor-glow"></div>

    <div id="root">
        @yield('content')
    </div>

    <script>
    function toggleSiteTheme() {
        const html = document.documentElement;
        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            localStorage.setItem('site-theme', 'light');
        } else {
            html.classList.add('dark');
            localStorage.setItem('site-theme', 'dark');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Page loader
        setTimeout(() => document.getElementById('page-loader')?.classList.add('loaded'), 300);

        // Scroll reveals
        const revealEls = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right, .reveal-scale, .stagger-children');
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); } });
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
        revealEls.forEach(el => obs.observe(el));

        // Animated counters
        document.querySelectorAll('[data-count]').forEach(el => {
            const target = parseFloat(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            const prefix = el.dataset.prefix || '';
            const decimals = (el.dataset.decimals || 0) | 0;
            let started = false;
            const cObs = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting && !started) {
                        started = true;
                        const duration = 1800, startTime = performance.now();
                        function tick(now) {
                            const p = Math.min((now - startTime) / duration, 1);
                            const eased = 1 - Math.pow(1 - p, 4);
                            el.textContent = prefix + (target * eased).toFixed(decimals) + suffix;
                            if (p < 1) requestAnimationFrame(tick);
                        }
                        requestAnimationFrame(tick);
                        cObs.unobserve(el);
                    }
                });
            }, { threshold: 0.3 });
            cObs.observe(el);
        });

        // Nav shrink on scroll
        const nav = document.querySelector('nav');
        if (nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 60) { nav.classList.add('py-2'); nav.classList.remove('py-4'); }
                else { nav.classList.remove('py-2'); nav.classList.add('py-4'); }
            }, { passive: true });
        }

        // Mobile menu
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('open');
                menuBtn.setAttribute('aria-expanded', mobileMenu.classList.contains('open'));
            });
        }

        // Cursor glow effect (desktop only)
        const glow = document.getElementById('cursor-glow');
        if (glow && window.matchMedia('(pointer: fine)').matches) {
            let glowVisible = false;
            document.addEventListener('mousemove', (e) => {
                glow.style.left = e.clientX + 'px';
                glow.style.top = e.clientY + 'px';
                if (!glowVisible && e.clientY < window.innerHeight * 0.85) {
                    glow.classList.add('visible');
                    glowVisible = true;
                }
            }, { passive: true });
            document.addEventListener('mouseleave', () => { glow.classList.remove('visible'); glowVisible = false; });
        }

        // Tilt effect on cards with .tilt-card class
        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const r = card.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width - 0.5;
                const y = (e.clientY - r.top) / r.height - 0.5;
                card.style.transform = `perspective(800px) rotateY(${x * 8}deg) rotateX(${-y * 8}deg) scale(1.02)`;
            });
            card.addEventListener('mouseleave', () => { card.style.transform = ''; });
        });

        // Magnetic buttons
        document.querySelectorAll('.magnetic-btn').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const r = btn.getBoundingClientRect();
                const x = e.clientX - r.left - r.width / 2;
                const y = e.clientY - r.top - r.height / 2;
                btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
            });
            btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
        });
    });
    </script>
</body>
</html>
