@php
    $pw = round(85.6 * 72 / 25.4, 2);
    $ph = round(53.98 * 72 / 25.4, 2);
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; size: {{ $pw }}pt {{ $ph }}pt; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: {{ $pw }}pt; height: {{ $ph }}pt; margin: 0; padding: 0; overflow: hidden; font-family: DejaVu Sans, sans-serif; background: #0B0F0E; color: #e2e8f0; }
        .hd { background: #00DF82; color: #0B0F0E; font-size: 7pt; font-weight: bold; text-align: center; padding: 5pt; text-transform: uppercase; }
        .body { padding: 5pt 8pt; font-size: 5pt; line-height: 1.35; }
        .brand { color: #00DF82; font-weight: bold; font-size: 5.5pt; text-transform: uppercase; padding-bottom: 3pt; }
        ul { margin: 0; padding-left: 10pt; color: #cbd5e1; }
        li { margin-bottom: 2pt; }
        .ft { position: fixed; bottom: 0; left: 0; width: {{ $pw }}pt; background: #00DF82; color: #0B0F0E; font-size: 5pt; font-weight: bold; text-align: center; padding: 4pt; }
    </style>
</head>
<body>
<div class="hd">Authorized representative</div>
<div class="body">
    <div class="brand">{{ $groupTitle }}</div>
    <ul>
        @foreach(array_slice($services, 0, 5) as $line)
            <li>{{ $line }}</li>
        @endforeach
    </ul>
    <div style="margin-top:4pt;">
        {{ \Illuminate\Support\Str::limit($office->address_office, 120) }}
        @if($office->phonesList())<br>Tel: {{ $office->phonesList() }}@endif
    </div>
</div>
<div class="ft">www.uprsolargreen.in</div>
</body>
</html>
