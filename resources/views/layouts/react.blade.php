<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'U.P.R. Solar Green Energy™') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        solarGreen: '#00DF82', // Solar Emerald
                        solarGreenDark: '#00B368',
                        navyBlue: '#0A2540',
                        obsidian: '#0e0e0e', // The Dark Base
                        obsidianLight: '#131313', // Surface Low
                        obsidianHigh: '#262626', // Surface High
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
                    animation: {
                        'ken-burns': 'ken-burns 20s ease infinite alternate',
                        'pulse-glow': 'pulse-glow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'fade-in-up': 'fade-in-up 0.8s ease-out forwards',
                        'viscous-in': 'viscous-in 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards',
                    },
                    keyframes: {
                        'ken-burns': {
                            '0%': { transform: 'scale(1) translate(0, 0)' },
                            '100%': { transform: 'scale(1.1) translate(-2%, -1%)' },
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: '0.4', filter: 'blur(8px)' },
                            '50%': { opacity: '1', filter: 'blur(12px)' },
                        },
                        'fade-in-up': {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        'viscous-in': {
                            '0%': { opacity: '0', transform: 'scale(0.98) translateY(10px)' },
                            '100%': { opacity: '1', transform: 'scale(1) translateY(0)' },
                        },
                    },
                }
            }
        }
    </script>

    <!-- Custom Premium Styles -->
    <style>
        :root {
            --solar-green: #00DF82;
            --obsidian: #0e0e0e;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: var(--obsidian);
            color: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glow-green {
            filter: drop-shadow(0 0 10px rgba(0, 223, 130, 0.3));
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(0, 223, 130, 0.2);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .viscous-transition {
            transition: all 1.2s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        /* 3D Surface Highlight */
        .surface-3d {
            position: relative;
        }
        .surface-3d::after {
            content: '';
            position: absolute;
            inset: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            pointer-events: none;
            border-radius: inherit;
        }
    </style>
</head>
<body class="antialiased bg-obsidian text-white">
    <div id="root">
        @yield('content')
    </div>
</body>
</html>
