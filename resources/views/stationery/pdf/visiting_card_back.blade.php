@php
    $pw = round(89 * 72 / 25.4, 2);
    $ph = round(51 * 72 / 25.4, 2);
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; size: {{ $pw }}pt {{ $ph }}pt; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: {{ $pw }}pt; height: {{ $ph }}pt; margin: 0; padding: 0; overflow: hidden; font-family: DejaVu Sans, sans-serif; background: #0B0F0E; color: #f8fafc; }
        .hd { background: #00DF82; color: #0B0F0E; font-size: 8pt; font-weight: bold; text-align: center; padding: 5pt; text-transform: uppercase; }
        .mid { padding: 5pt 8pt; font-size: 5.8pt; line-height: 1.4; color: #e2e8f0; }
        .mid b { color: #00DF82; font-size: 6.5pt; text-transform: uppercase; display: block; margin-bottom: 3pt; }
        ul { margin: 0; padding-left: 10pt; }
        li { margin-bottom: 2pt; }
        .ft { position: fixed; bottom: 0; left: 0; width: {{ $pw }}pt; background: #00DF82; color: #0B0F0E; font-size: 5.5pt; font-weight: bold; text-align: center; padding: 4pt; }
    </style>
</head>
<body>
<div class="hd">We deal in</div>
<div class="mid">
    <b>Products &amp; services</b>
    <ul>
        @foreach($services as $line)
            <li>{{ $line }}</li>
        @endforeach
    </ul>
</div>
<div class="ft">{{ \Illuminate\Support\Str::limit($groupTitle, 60) }}</div>
</body>
</html>
