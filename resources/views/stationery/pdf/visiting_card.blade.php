<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* 89mm × 51mm — standard Indian / ISO business card */
        @page {
            size: 89mm 51mm;
            margin: 0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            width: 89mm;
            height: 51mm;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: DejaVu Sans, sans-serif;
        }
        .card {
            position: absolute;
            top: 0; left: 0;
            width: 89mm;
            height: 51mm;
            border: 1.5pt solid #00DF82;
        }
        /* Left column — dark, company info */
        .col-left {
            position: absolute;
            top: 0; left: 0;
            width: 44mm;
            height: 51mm;
            background: #0B0F0E;
            color: #f8fafc;
            padding: 3mm;
            overflow: hidden;
        }
        /* Right column — light, person info */
        .col-right {
            position: absolute;
            top: 0; left: 44mm;
            width: 45mm;
            height: 51mm;
            background: #f1f5f9;
            color: #0B0F0E;
            padding: 3mm;
            overflow: hidden;
            border-left: 1.5pt solid #00DF82;
        }
        /* Green accent strip at bottom */
        .accent-bar {
            position: absolute;
            bottom: 0; left: 0;
            width: 89mm;
            height: 1.5mm;
            background: #00DF82;
        }
        .logo { margin-bottom: 1.5mm; }
        .logo img { max-height: 8mm; max-width: 38mm; display: block; }
        .co-name {
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.2pt;
            line-height: 1.15;
            color: #ffffff;
        }
        .co-tag {
            font-size: 5pt;
            color: #94a3b8;
            margin-top: 1mm;
            line-height: 1.2;
        }
        .co-meta {
            font-size: 5.5pt;
            color: #cbd5e1;
            margin-top: 2mm;
            line-height: 1.3;
        }
        .person-name {
            font-size: 10pt;
            font-weight: bold;
            color: #0B0F0E;
            line-height: 1.1;
            margin-bottom: 1mm;
        }
        .person-role {
            font-size: 7pt;
            color: #00b368;
            font-weight: bold;
            margin-bottom: 3mm;
        }
        .info-row {
            font-size: 6pt;
            line-height: 1.3;
            margin-bottom: 1.5mm;
            color: #334155;
        }
        .info-row .lbl {
            display: block;
            font-size: 5pt;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 0.3mm;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="col-left">
            <div class="logo">
                @if(!empty($logoDataUri))
                    <img src="{{ $logoDataUri }}" alt="">
                @endif
            </div>
            <div class="co-name">{{ $company->name }}</div>
            @if($company->tagline)
                <div class="co-tag">{{ \Illuminate\Support\Str::limit($company->tagline, 140) }}</div>
            @endif
            <div class="co-meta">
                {{ \Illuminate\Support\Str::limit($company->address_office, 160) }}<br>
                @if($company->email){{ $company->email }}<br>@endif
                @if($company->phonesList()){{ $company->phonesList() }}@endif
            </div>
        </div>
        <div class="col-right">
            <div class="person-name">{{ $user->name }}</div>
            <div class="person-role">{{ $user->designation ?: 'Representative' }}</div>
            <div class="info-row">
                <span class="lbl">Email</span>
                {{ $user->email }}
            </div>
            <div class="info-row">
                <span class="lbl">Phone</span>
                {{ $user->phone ?: '—' }}
            </div>
        </div>
        <div class="accent-bar"></div>
    </div>
</body>
</html>
