@php
    $pw = round(89 * 72 / 25.4, 2);
    $ph = round(51 * 72 / 25.4, 2);
    $leftW = round($pw * 0.64, 1);
    $rightW = round($pw * 0.36, 1);
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
        .front-table { border-collapse: collapse; width: {{ $pw }}pt; height: {{ $ph }}pt; table-layout: fixed; }
        .left {
            width: {{ $leftW }}pt;
            vertical-align: top;
            padding: 3pt 4pt 2pt 4pt;
            border: 1pt solid #00DF82;
            overflow: hidden;
        }
        .right {
            width: {{ $rightW }}pt;
            vertical-align: top;
            padding: 2pt;
            background: #f8fafc;
            border: 1pt solid #00DF82;
            border-left: none;
        }
        .nm { font-size: 7pt; font-weight: bold; color: #0B0F0E; line-height: 1.1; }
        .sub { font-size: 5.5pt; color: #00b368; font-weight: bold; line-height: 1.1; padding: 1pt 0; }
        .brand-line {
            font-size: 5pt;
            font-weight: bold;
            color: #0B0F0E;
            text-transform: uppercase;
            border-bottom: 0.5pt solid #00DF82;
            padding-bottom: 1pt;
            margin: 2pt 0;
            line-height: 1.15;
        }
        .addr { font-size: 4.8pt; color: #334155; line-height: 1.2; }
        .meta { font-size: 4.8pt; color: #475569; line-height: 1.25; padding: 1pt 0; }
        .meta strong { color: #0B0F0E; }
        .companies-box {
            margin-top: 2pt;
            padding-top: 2pt;
            border-top: 0.5pt solid #e2e8f0;
        }
        .dealer-h { font-size: 4.8pt; font-weight: bold; color: #0B0F0E; text-decoration: underline; margin-bottom: 1pt; }
        .dealer-list { width: 100%; border-collapse: collapse; }
        .dealer-list td {
            font-size: 4.6pt;
            color: #334155;
            line-height: 1.15;
            padding: 0.5pt 0;
            vertical-align: top;
        }
        .dealer-list td.bullet { width: 6pt; color: #00DF82; font-weight: bold; }
        .logo-stack { width: 100%; height: {{ $ph }}pt; border-collapse: collapse; table-layout: fixed; }
        .logo-cell { text-align: center; vertical-align: middle; padding: 2pt 1pt; border-bottom: 0.5pt solid #e2e8f0; height: 33.33%; }
        .logo-cell:last-child { border-bottom: none; }
        .logo-cell img { max-height: 14pt; max-width: {{ $rightW - 6 }}pt; display: block; margin: 0 auto; }
        .logo-fb {
            display: inline-block;
            background: #0B0F0E;
            color: #00DF82;
            font-size: 4.5pt;
            font-weight: bold;
            padding: 1.5pt 3pt;
            line-height: 1.1;
        }
        .back-bg { background: #0B0F0E; color: #f8fafc; border: 1pt solid #00DF82; }
        .back-hd { background: #00DF82; color: #0B0F0E; font-size: 8pt; font-weight: bold; text-align: center; padding: 5pt; text-transform: uppercase; }
        .back-mid { padding: 5pt 8pt; font-size: 5.8pt; line-height: 1.4; color: #e2e8f0; }
        .back-mid b { color: #00DF82; font-size: 6.5pt; text-transform: uppercase; display: block; margin-bottom: 3pt; }
        .back-mid ul { margin: 0; padding-left: 10pt; }
        .back-mid li { margin-bottom: 2pt; }
        .back-ft {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #00DF82;
            color: #0B0F0E;
            font-size: 4.5pt;
            font-weight: bold;
            text-align: center;
            padding: 3pt 2pt;
            line-height: 1.15;
        }
    </style>
</head>
<body>
<div class="p1">
    <table class="front-table" cellspacing="0" cellpadding="0">
        <tr>
            <td class="left">
                <div class="nm">{{ $user->name }}</div>
                <div class="sub">{{ $user->designation ?: 'Representative' }}</div>
                <div class="brand-line">Solar | Electrical | Refrigeration</div>
                <div class="addr">
                    {{ \Illuminate\Support\Str::limit($office->address_office, 52) }}@if($office->pincode) - {{ $office->pincode }}@endif
                </div>
                <div class="meta">
                    @if($user->phone)<strong>M:</strong> {{ $user->phone }}@endif
                    @if($user->phone && $user->email)<br>@endif
                    @if($user->email)<strong>E:</strong> {{ \Illuminate\Support\Str::limit($user->email, 28) }}@endif
                </div>
                <div class="companies-box">
                    <div class="dealer-h">Our companies:</div>
                    <table class="dealer-list" cellspacing="0" cellpadding="0">
                        @foreach($companies as $co)
                            <tr>
                                <td class="bullet">&#8226;</td>
                                <td>{{ $co['shortLabel'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </td>
            <td class="right">
                <table class="logo-stack" cellspacing="0" cellpadding="0">
                    @foreach($companies as $co)
                        <tr>
                            <td class="logo-cell">
                                @if(!empty($co['logoDataUri']))
                                    <img src="{{ $co['logoDataUri'] }}" alt="">
                                @else
                                    <span class="logo-fb">{{ $co['shortLabel'] }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
</div>

<div class="p2 back-bg">
    <div class="back-hd">We deal in</div>
    <div class="back-mid">
        <b>Products &amp; services</b>
        <ul>
            @foreach($services as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>
    </div>
    <div class="back-ft">{{ $groupTitle }}</div>
</div>
</body>
</html>
