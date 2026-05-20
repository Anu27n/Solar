@php
    $pw = round(85.6 * 72 / 25.4, 2);
    $ph = round(53.98 * 72 / 25.4, 2);
    $logoLabels = [
        'upr_solar' => 'UPR Solar',
        'upr_refrigeration' => 'UP Refrig.',
        'upk_electrical' => 'UPK Elect.',
    ];
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; size: {{ $pw }}pt {{ $ph }}pt; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: {{ $pw }}pt; margin: 0; padding: 0; }
        body { font-family: DejaVu Sans, sans-serif; }
        .p1, .p2 {
            position: fixed;
            left: 0;
            top: 0;
            width: {{ $pw }}pt;
            height: {{ $ph }}pt;
            overflow: hidden;
        }
        .p2 { page-break-before: always; position: relative; }
        .front-wrap { width: 100%; height: 100%; border-collapse: collapse; table-layout: fixed; }
        .accent { width: 5pt; background: #00DF82; }
        .cell { vertical-align: top; padding: 3pt 4pt; }
        .logos { width: 100%; border-collapse: collapse; margin-bottom: 2pt; }
        .logo-td { width: 33.33%; text-align: center; vertical-align: middle; padding: 1pt; }
        .logo-td img { max-height: 14pt; max-width: 24pt; display: block; margin: 0 auto; }
        .badge {
            display: inline-block;
            background: #0B0F0E;
            color: #00DF82;
            font-size: 4.2pt;
            font-weight: bold;
            padding: 1pt 2pt;
            line-height: 1.1;
            white-space: nowrap;
        }
        .tag {
            text-align: center;
            font-size: 4.8pt;
            font-weight: bold;
            color: #0B0F0E;
            text-transform: uppercase;
            padding: 2pt 0 3pt 0;
            border-bottom: 0.5pt solid #00DF82;
            margin-bottom: 3pt;
        }
        .main { width: 100%; border-collapse: collapse; }
        .photo-td { width: 58pt; text-align: center; vertical-align: middle; }
        .photo {
            width: 50pt;
            height: 50pt;
            border: 1.5pt solid #00DF82;
            border-radius: 50%;
            overflow: hidden;
            background: #f1f5f9;
            margin: 0 auto;
        }
        .photo img { width: 50pt; height: 50pt; }
        .photo-ph { font-size: 5pt; color: #94a3b8; padding-top: 18pt; text-align: center; }
        .name { font-size: 10pt; font-weight: bold; color: #0B0F0E; line-height: 1.1; }
        .role { font-size: 6.5pt; font-weight: bold; color: #00a86b; padding: 1pt 0 3pt 0; }
        .lbl { font-size: 4.8pt; font-weight: bold; color: #64748b; text-transform: uppercase; }
        .val { font-size: 5.8pt; color: #334155; padding-bottom: 2pt; line-height: 1.2; }
        .back-bg { background: #0B0F0E; color: #e2e8f0; }
        .back-hd {
            background: #00DF82;
            color: #0B0F0E;
            font-size: 6.5pt;
            font-weight: bold;
            text-align: center;
            padding: 4pt 3pt;
            text-transform: uppercase;
        }
        .back-body { padding: 4pt 6pt 10pt 6pt; font-size: 4.8pt; line-height: 1.25; }
        .back-brand {
            color: #00DF82;
            font-weight: bold;
            font-size: 4.8pt;
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 3pt;
        }
        .co-list { margin: 0 0 3pt 0; padding: 0; list-style: none; }
        .co-list li { color: #e2e8f0; padding: 0.5pt 0; font-size: 4.6pt; }
        .co-list li:before { content: "• "; color: #00DF82; }
        .back-list { margin: 0; padding-left: 8pt; color: #cbd5e1; font-size: 4.5pt; }
        .back-list li { margin-bottom: 1pt; }
        .back-addr { color: #94a3b8; font-size: 4.5pt; margin-top: 2pt; line-height: 1.2; }
        .back-ft {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #00DF82;
            color: #0B0F0E;
            font-size: 5pt;
            font-weight: bold;
            text-align: center;
            padding: 3pt;
        }
    </style>
</head>
<body>
{{-- Front --}}
<div class="p1">
    <table class="front-wrap" cellspacing="0" cellpadding="0">
        <tr>
            <td class="accent"></td>
            <td class="cell">
                <table class="logos" cellspacing="0" cellpadding="0">
                    <tr>
                        @foreach($companies as $co)
                            @php $code = $co['profile']->code; @endphp
                            <td class="logo-td">
                                @if(!empty($co['logoDataUri']))
                                    <img src="{{ $co['logoDataUri'] }}" alt="">
                                @else
                                    <span class="badge">{{ $logoLabels[$code] ?? $co['shortLabel'] }}</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </table>
                <div class="tag">Solar | Electrical | Refrigeration</div>
                <table class="main" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="photo-td">
                            <div class="photo">
                                @if(!empty($photoDataUri))
                                    <img src="{{ $photoDataUri }}" alt="">
                                @else
                                    <div class="photo-ph">Photo</div>
                                @endif
                            </div>
                        </td>
                        <td style="vertical-align:middle;padding-left:5pt;">
                            <div class="name">{{ $user->name }}</div>
                            <div class="role">{{ $user->designation ?: 'Staff Member' }}</div>
                            <div class="lbl">Mobile</div>
                            <div class="val">{{ $user->phone ?: '-' }}</div>
                            <div class="lbl">Email</div>
                            <div class="val">{{ \Illuminate\Support\Str::limit($user->email, 32) }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

{{-- Back --}}
<div class="p2 back-bg">
    <div class="back-hd">Authorized representative</div>
    <div class="back-body">
        <div class="back-brand">{{ $groupTitle }}</div>
        <ul class="co-list">
            @foreach($companies as $co)
                <li>{{ $co['shortLabel'] }}</li>
            @endforeach
        </ul>
        <ul class="back-list">
            @foreach(array_slice($services, 0, 3) as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>
        <div class="back-addr">
            {{ \Illuminate\Support\Str::limit($office->address_office, 70) }}
            @if($office->phonesList())<br>{{ \Illuminate\Support\Str::limit($office->phonesList(), 35) }}@endif
        </div>
    </div>
    <div class="back-ft">www.uprsolargreen.in</div>
</div>
</body>
</html>
