<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installation — Step {{ $step ?? 1 }} of 7</title>
    <style>
        :root {
            --bg: #0f172a;
            --panel: #1e293b;
            --border: #334155;
            --text: #f8fafc;
            --muted: #94a3b8;
            --accent: #f59e0b;
            --accent-2: #38bdf8;
            --danger: #f87171;
            --ok: #4ade80;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background: radial-gradient(1200px 600px at 20% -10%, rgba(245, 158, 11, 0.18), transparent 60%),
                radial-gradient(900px 500px at 90% 20%, rgba(56, 189, 248, 0.14), transparent 55%),
                var(--bg);
            color: var(--text);
        }
        .wrap { max-width: 720px; margin: 0 auto; padding: 2.5rem 1.25rem 4rem; }
        .brand {
            display: flex; align-items: center; gap: 0.6rem;
            font-weight: 700; letter-spacing: 0.02em; margin-bottom: 1.75rem;
        }
        .brand span { color: var(--accent); }
        .panel {
            background: rgba(30, 41, 59, 0.92);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        }
        .steps {
            display: flex; flex-wrap: wrap; gap: 0.35rem 0.5rem; margin-bottom: 1.25rem;
        }
        .steps span {
            font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em;
            padding: 0.25rem 0.55rem; border-radius: 999px;
            border: 1px solid var(--border); color: var(--muted);
        }
        .steps span.on { border-color: rgba(245, 158, 11, 0.55); color: var(--text); background: rgba(245, 158, 11, 0.12); }
        .steps span.done { border-color: rgba(74, 222, 128, 0.45); color: var(--ok); }
        h1 { font-size: 1.45rem; margin: 0 0 0.5rem; }
        p.lead { margin: 0 0 1.25rem; color: var(--muted); line-height: 1.55; }
        label { display: block; font-size: 0.85rem; color: var(--muted); margin: 0.75rem 0 0.35rem; }
        input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="number"], select {
            width: 100%; padding: 0.65rem 0.75rem; border-radius: 8px;
            border: 1px solid var(--border); background: #0b1220; color: var(--text);
        }
        input:focus, select:focus { outline: 2px solid rgba(56, 189, 248, 0.35); border-color: rgba(56, 189, 248, 0.45); }
        .row { display: grid; gap: 0 1rem; grid-template-columns: 1fr; }
        @media (min-width: 560px) { .row.two { grid-template-columns: 1fr 1fr; } }
        .check { display: flex; align-items: flex-start; gap: 0.5rem; margin-top: 0.75rem; color: var(--muted); font-size: 0.9rem; }
        .check input { margin-top: 0.2rem; }
        .actions { margin-top: 1.5rem; display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; }
        .btn {
            appearance: none; border: 0; cursor: pointer; border-radius: 9px; padding: 0.65rem 1.1rem;
            font-weight: 600; font-size: 0.95rem;
            background: linear-gradient(135deg, var(--accent), #d97706);
            color: #0f172a;
        }
        .btn.secondary { background: transparent; color: var(--text); border: 1px solid var(--border); }
        .btn:disabled { opacity: 0.5; cursor: not-allowed; }
        .error {
            background: rgba(248, 113, 113, 0.12);
            border: 1px solid rgba(248, 113, 113, 0.45);
            color: #fecaca;
            padding: 0.75rem 0.85rem; border-radius: 10px; margin-bottom: 1rem; font-size: 0.9rem;
        }
        ul.checklist { list-style: none; padding: 0; margin: 0; }
        ul.checklist li {
            display: flex; justify-content: space-between; gap: 1rem;
            padding: 0.55rem 0; border-bottom: 1px solid rgba(51, 65, 85, 0.65);
            font-size: 0.9rem;
        }
        ul.checklist li:last-child { border-bottom: 0; }
        .badge { font-size: 0.75rem; font-weight: 700; }
        .badge.ok { color: var(--ok); }
        .badge.bad { color: var(--danger); }
        pre.log {
            background: #0b1220; border: 1px solid var(--border); border-radius: 10px;
            padding: 0.85rem; overflow: auto; font-size: 0.78rem; color: var(--muted); max-height: 240px;
        }
        a { color: var(--accent-2); }
    </style>
</head>
<body>
<div class="wrap">
    <div class="brand">Solar Portal <span>Installer</span></div>
    <div class="panel">
        @php
            $labels = ['Welcome', 'Requirements', 'Database', 'Configuration', 'Migrate', 'Admin', 'Finish'];
            $current = $step ?? 1;
        @endphp
        <div class="steps">
            @foreach($labels as $i => $lbl)
                <span class="@if(($i + 1) < $current) done @elseif(($i + 1) === $current) on @endif">{{ $i + 1 }}. {{ $lbl }}</span>
            @endforeach
        </div>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</div>
</body>
</html>
