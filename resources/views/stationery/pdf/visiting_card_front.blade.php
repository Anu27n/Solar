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
        html, body { width: {{ $pw }}pt; height: {{ $ph }}pt; margin: 0; padding: 0; overflow: hidden; font-family: DejaVu Sans, sans-serif; }
        table { border-collapse: collapse; width: 100%; height: 100%; }
        .left { width: 58%; vertical-align: top; padding: 5pt 6pt; border: 1pt solid #00DF82; }
        .right { width: 42%; vertical-align: top; padding: 4pt; background: #f8fafc; border: 1pt solid #00DF82; border-left: none; }
        .nm { font-size: 7pt; font-weight: bold; color: #0B0F0E; }
        .sub { font-size: 6pt; color: #00b368; font-weight: bold; padding: 1pt 0 3pt 0; }
        .grp { font-size: 7pt; font-weight: bold; text-transform: uppercase; color: #0B0F0E; border-bottom: 1pt solid #00DF82; padding-bottom: 2pt; margin-bottom: 3pt; }
        .txt { font-size: 5.5pt; color: #334155; line-height: 1.3; }
        .meta { font-size: 5.5pt; color: #475569; line-height: 1.3; padding: 2pt 0; }
        .dealer-h { font-size: 5pt; font-weight: bold; text-decoration: underline; padding-top: 2pt; }
        .dealer-i { font-size: 4.8pt; color: #334155; line-height: 1.2; }
        .logo-row { text-align: center; padding: 3pt 0; border-bottom: 0.5pt solid #e2e8f0; }
        .logo-row img { max-height: 22pt; max-width: 80pt; }
        .logo-fb { background: #0B0F0E; color: #00DF82; font-size: 5pt; font-weight: bold; padding: 2pt 4pt; }
        .logo-lb { font-size: 5pt; font-weight: bold; color: #0B0F0E; padding-top: 1pt; }
    </style>
</head>
<body>
<table cellspacing="0" cellpadding="0">
    <tr>
        <td class="left">
            <div class="nm">{{ $user->name }}</div>
            <div class="sub">{{ $user->designation ?: 'Representative' }}</div>
            <div class="grp">{{ \Illuminate\Support\Str::limit($groupTitle, 55) }}</div>
            <div class="txt">{{ \Illuminate\Support\Str::limit($office->address_office, 80) }}@if($office->city), {{ $office->city }}@endif @if($office->pincode) - {{ $office->pincode }}@endif</div>
            <div class="meta">
                @if($user->phone)<strong>M:</strong> {{ $user->phone }}<br>@endif
                @if($user->email)<strong>E:</strong> {{ \Illuminate\Support\Str::limit($user->email, 32) }}<br>@endif
                @if($office->phonesList())<strong>T:</strong> {{ \Illuminate\Support\Str::limit($office->phonesList(), 40) }}@endif
            </div>
            <div class="dealer-h">Our companies:</div>
            @foreach($companies as $co)
                <div class="dealer-i">{{ \Illuminate\Support\Str::limit($co['profile']->name, 40) }}</div>
            @endforeach
        </td>
        <td class="right">
            @foreach($companies as $co)
                <div class="logo-row">
                    @if(!empty($co['logoDataUri']))
                        <img src="{{ $co['logoDataUri'] }}" alt="">
                    @else
                        <span class="logo-fb">{{ $co['shortLabel'] }}</span>
                    @endif
                    <div class="logo-lb">{{ \Illuminate\Support\Str::limit($co['profile']->name, 28) }}</div>
                </div>
            @endforeach
        </td>
    </tr>
</table>
</body>
</html>
