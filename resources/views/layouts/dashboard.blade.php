<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — U.P.R. Solar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        solar: { 50:'#edfff5', 100:'#d5ffe8', 200:'#aeffd3', 300:'#70ffb0', 400:'#2bfd86', 500:'#00DF82', 600:'#00b368', 700:'#008c52', 800:'#006e43', 900:'#005a39' },
                        dark: { 900:'#09090b', 800:'#0f0f12', 700:'#18181b', 600:'#1e1e23', 500:'#27272a', 400:'#3f3f46' },
                    },
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                }
            }
        }
    </script>
    <script>
        (function() {
            const t = localStorage.getItem('dashboard-theme');
            if (t === 'light') document.documentElement.classList.remove('dark');
            else document.documentElement.classList.add('dark');
        })();
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', system-ui, sans-serif; }

        /* ─── LIGHT MODE ─── */
        :root {
            --bg-body: #f8fafc; --bg-sidebar: #ffffff; --bg-card: #ffffff; --bg-card-hover: #f1f5f9;
            --bg-input: #f1f5f9; --border-main: #e2e8f0; --border-subtle: #f1f5f9;
            --text-primary: #0f172a; --text-secondary: #475569; --text-muted: #94a3b8; --text-faint: #cbd5e1;
            --glass-bg: rgba(255,255,255,0.8); --glass-border: rgba(0,0,0,0.06);
            --sidebar-bg: #0f0f12; --sidebar-text: rgba(255,255,255,0.45); --sidebar-active-bg: rgba(0,223,130,0.15);
        }

        /* ─── DARK MODE ─── */
        .dark {
            --bg-body: #09090b; --bg-sidebar: #0f0f12; --bg-card: rgba(255,255,255,0.03); --bg-card-hover: rgba(255,255,255,0.05);
            --bg-input: #18181b; --border-main: rgba(255,255,255,0.06); --border-subtle: rgba(255,255,255,0.04);
            --text-primary: rgba(255,255,255,0.85); --text-secondary: rgba(255,255,255,0.5); --text-muted: rgba(255,255,255,0.3); --text-faint: rgba(255,255,255,0.15);
            --glass-bg: rgba(255,255,255,0.03); --glass-border: rgba(255,255,255,0.06);
            --sidebar-bg: rgba(15,15,18,0.8); --sidebar-text: rgba(255,255,255,0.45);
        }

        body { background: var(--bg-body); color: var(--text-primary); transition: background 0.3s, color 0.3s; }

        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.6rem 0.85rem; border-radius: 0.75rem;
            font-size: 0.8125rem; font-weight: 500; color: rgba(255,255,255,0.45);
            transition: all 0.25s cubic-bezier(0.16,1,0.3,1);
        }
        .sidebar-link:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(0,223,130,0.15), rgba(0,223,130,0.05));
            color: #00DF82; box-shadow: inset 0 0 0 1px rgba(0,223,130,0.15);
        }

        .glass { background: var(--glass-bg); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid var(--glass-border); }
        .glass-light { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); }
        .dark .glass-light { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); }

        .stat-card {
            position: relative; overflow: hidden; border-radius: 1rem;
            padding: 1.25rem; border: 1px solid var(--border-main);
            background: var(--bg-card); backdrop-filter: blur(12px);
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
        }
        .stat-card:hover { border-color: rgba(0,223,130,0.2); transform: translateY(-2px); background: var(--bg-card-hover); }
        .stat-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-main), transparent);
        }

        /* ─── Theme-aware text helpers ─── */
        .t-primary { color: var(--text-primary); }
        .t-secondary { color: var(--text-secondary); }
        .t-muted { color: var(--text-muted); }
        .t-faint { color: var(--text-faint); }
        .bg-surface { background: var(--bg-card); }
        .bg-input { background: var(--bg-input); }
        .border-theme { border-color: var(--border-main); }
        .border-subtle { border-color: var(--border-subtle); }

        /* ─── Light mode card overrides ─── */
        html:not(.dark) .stat-card { box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
        html:not(.dark) .glass { background: rgba(255,255,255,0.8); border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.04); backdrop-filter: none; }
        html:not(.dark) body { background: #f8fafc; }

        @keyframes fade-in { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse-ring { 0% { transform: scale(1); opacity: 1; } 100% { transform: scale(2); opacity: 0; } }
        @keyframes glow-pulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 0.8; } }

        .animate-fade-in { animation: fade-in 0.5s cubic-bezier(0.16,1,0.3,1) both; }
        .animate-glow { animation: glow-pulse 3s ease-in-out infinite; }

        .delay-1 { animation-delay: 50ms; } .delay-2 { animation-delay: 100ms; }
        .delay-3 { animation-delay: 150ms; } .delay-4 { animation-delay: 200ms; }
        .delay-5 { animation-delay: 250ms; } .delay-6 { animation-delay: 300ms; }

        .gradient-border { position: relative; }
        .gradient-border::after {
            content: ''; position: absolute; inset: -1px; border-radius: inherit; padding: 1px;
            background: linear-gradient(135deg, rgba(0,223,130,0.3), transparent 50%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude; pointer-events: none;
        }

        .mobile-sidebar { transform: translateX(-100%); transition: transform 0.35s cubic-bezier(0.16,1,0.3,1); }
        .mobile-sidebar.open { transform: translateX(0); }

        .dark ::-webkit-scrollbar { width: 6px; }
        .dark ::-webkit-scrollbar-track { background: transparent; }
        .dark ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }

        /* Theme toggle */
        .theme-toggle { position: relative; width: 44px; height: 24px; border-radius: 12px; cursor: pointer; transition: background 0.3s; }
        .dark .theme-toggle { background: rgba(255,255,255,0.1); }
        html:not(.dark) .theme-toggle { background: #e2e8f0; }
        .theme-toggle-dot {
            position: absolute; top: 2px; width: 20px; height: 20px; border-radius: 50%; transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
        }
        .dark .theme-toggle-dot { left: 22px; background: #00DF82; }
        html:not(.dark) .theme-toggle-dot { left: 2px; background: #f59e0b; }
    </style>
</head>
<body class="h-full">
    <div class="flex h-full">
        <aside class="hidden lg:flex lg:w-[260px] lg:flex-col bg-dark-800 border-r border-white/[0.04]">
            <div class="flex flex-col h-full">
                <div class="px-5 py-5">
                    <a href="/" class="flex items-center gap-2.5 group">
                        <div class="p-2 bg-gradient-to-br from-solar-500 to-solar-600 rounded-xl shadow-lg shadow-solar-500/20 group-hover:shadow-solar-500/40 transition-shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0B0F0E" stroke-width="2.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
                        </div>
                        <div>
                            <span class="text-sm font-bold tracking-tight text-white">U.P.R. Solar</span>
                            <span class="block text-[10px] font-medium text-white/30 tracking-wider uppercase">CRM Portal</span>
                        </div>
                    </a>
                </div>

                <div class="px-4 mb-2"><div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div></div>

                <nav class="flex-1 px-3 py-2 space-y-0.5 overflow-y-auto">@yield('sidebar')</nav>

                <div class="p-3">
                    <div class="p-3 rounded-xl glass-light">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 bg-gradient-to-br from-solar-500/30 to-solar-600/10 rounded-xl flex items-center justify-center text-solar-400 font-bold text-xs border border-solar-500/20">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                                <div class="text-[10px] text-white/30 capitalize">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2.5">
                            @csrf
                            <button class="w-full flex items-center justify-center gap-2 px-3 py-1.5 rounded-lg text-[11px] font-medium text-red-400/80 hover:text-red-400 hover:bg-red-500/10 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <div id="mobile-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden" onclick="toggleMobileSidebar()"></div>
        <aside id="mobile-sidebar" class="mobile-sidebar fixed inset-y-0 left-0 z-50 w-[260px] bg-dark-800 border-r border-white/[0.04] lg:hidden">
            <div class="flex flex-col h-full">
                <div class="px-5 py-5 flex justify-between items-center">
                    <span class="text-sm font-bold tracking-tight text-white">U.P.R. Solar</span>
                    <button onclick="toggleMobileSidebar()" class="p-1.5 rounded-lg text-white/40 hover:text-white hover:bg-white/10 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>
                <nav class="flex-1 px-3 py-2 space-y-0.5 overflow-y-auto">@yield('sidebar')</nav>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="sticky top-0 z-30 border-b border-theme px-4 sm:px-6 lg:px-8 py-3.5" style="background: var(--bg-body); backdrop-filter: blur(12px);">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleMobileSidebar()" class="lg:hidden p-2 t-muted rounded-lg hover:bg-surface transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div>
                            <h1 class="text-base font-semibold t-primary">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-[11px] t-muted mt-0.5">@yield('page-subtitle', '')</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @yield('header-actions')
                        {{-- Theme toggle --}}
                        <button onclick="toggleTheme()" class="theme-toggle" title="Toggle theme" aria-label="Toggle theme">
                            <div class="theme-toggle-dot flex items-center justify-center">
                                <svg class="dark:hidden w-3 h-3 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
                                <svg class="hidden dark:block w-3 h-3 text-dark-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z"/></svg>
                            </div>
                        </button>
                        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg stat-card !p-1.5 !rounded-lg">
                            <div class="w-1.5 h-1.5 rounded-full bg-solar-500 animate-glow"></div>
                            <span class="text-[11px] font-medium t-muted" id="live-clock"></span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 p-3.5 bg-solar-500/10 border border-solar-500/20 rounded-xl text-solar-600 dark:text-solar-400 text-sm font-medium flex items-center gap-2.5 animate-fade-in">
                        <div class="p-1 bg-solar-500/20 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-3.5 bg-red-500/10 border border-red-500/20 rounded-xl text-red-600 dark:text-red-400 text-sm animate-fade-in">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function toggleMobileSidebar() {
        document.getElementById('mobile-sidebar').classList.toggle('open');
        document.getElementById('mobile-overlay').classList.toggle('hidden');
    }

    function toggleTheme() {
        const html = document.documentElement;
        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            localStorage.setItem('dashboard-theme', 'light');
        } else {
            html.classList.add('dark');
            localStorage.setItem('dashboard-theme', 'dark');
        }
    }

    function updateClock() {
        const el = document.getElementById('live-clock');
        if (el) {
            const now = new Date();
            el.textContent = now.toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', hour12: true }) + ' · ' +
                now.toLocaleDateString('en-IN', { day: 'numeric', month: 'short' });
        }
    }
    updateClock();
    setInterval(updateClock, 30000);

    document.querySelectorAll('[data-count]').forEach(el => {
        const target = parseFloat(el.dataset.count);
        const suffix = el.dataset.suffix || '';
        const prefix = el.dataset.prefix || '';
        const decimals = parseInt(el.dataset.decimals || '0');
        const duration = 1400;
        const startTime = performance.now();
        function tick(now) {
            const p = Math.min((now - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 4);
            el.textContent = prefix + (target * eased).toFixed(decimals) + suffix;
            if (p < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    });
    </script>
    @yield('scripts')
</body>
</html>
