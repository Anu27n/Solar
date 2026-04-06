<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Log in') }} — U.P.R. Solar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#00DF82', dark: '#0B0F0E' },
                    },
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-[#0B0F0E] font-sans text-sm text-zinc-200 antialiased">
    <div class="flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-[400px]">
            <div class="mb-8 text-center">
                <p class="text-lg font-semibold tracking-tight text-white">U.P.R. Solar</p>
                <p class="mt-1 text-xs text-zinc-500">Solar CRM</p>
            </div>

            <div class="rounded-2xl border border-zinc-800/80 bg-zinc-900/40 p-8 shadow-xl shadow-black/20 backdrop-blur-sm">
                <h1 class="mb-6 text-center text-base font-semibold text-white">Log in</h1>

                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-500/30 bg-red-500/10 px-3 py-2 text-xs text-red-300">
                        <ul class="list-inside list-disc space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="mb-1.5 block text-xs font-medium text-zinc-400">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            class="w-full rounded-lg border border-zinc-700 bg-[#0B0F0E] px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none ring-brand/20 transition focus:border-brand focus:ring-2"
                            placeholder="you@example.com"
                        >
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-xs font-medium text-zinc-400">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            class="w-full rounded-lg border border-zinc-700 bg-[#0B0F0E] px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none ring-brand/20 transition focus:border-brand focus:ring-2"
                            placeholder="••••••••"
                        >
                    </div>

                    <div class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                            class="h-3.5 w-3.5 rounded border-zinc-600 bg-[#0B0F0E] text-brand focus:ring-brand focus:ring-offset-0"
                        >
                        <label for="remember" class="text-xs text-zinc-400">Remember me</label>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-[#00DF82] py-2.5 text-sm font-medium text-[#0B0F0E] transition hover:bg-[#00c975] focus:outline-none focus:ring-2 focus:ring-[#00DF82] focus:ring-offset-2 focus:ring-offset-[#0B0F0E]"
                    >
                        Log in
                    </button>
                </form>

                <p class="mt-6 text-center text-xs text-zinc-500">
                    Don’t have an account?
                    <a href="{{ url('/register') }}" class="font-medium text-[#00DF82] hover:underline">Register</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
