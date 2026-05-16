<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0B0F0E;
            font-size: 7.5px;
            background: #f1f5f9;
        }
        .card {
            width: 100%;
            min-height: 100%;
            border: 2px solid #00DF82;
            background: #ffffff;
        }
        .header {
            background: #00DF82;
            color: #0B0F0E;
            padding: 4px 6px;
            border-bottom: 2px solid #0B0F0E;
        }
        .header-table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: middle; }
        .header-logo {
            width: 38px;
            text-align: left;
        }
        .header-logo img {
            max-height: 28px;
            max-width: 36px;
            display: block;
        }
        .header-text { text-align: center; padding: 0 4px; }
        .company-name {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            line-height: 1.15;
            color: #0B0F0E;
        }
        .tagline {
            font-size: 5.5px;
            color: #0B0F0E;
            opacity: 0.85;
            margin-top: 2px;
            line-height: 1.2;
        }
        .body {
            padding: 6px 8px 5px 8px;
        }
        .body-table { width: 100%; border-collapse: collapse; }
        .body-table td { vertical-align: top; }
        .photo-cell { width: 58px; padding-right: 8px; }
        /* Oval frame: fixed ellipse using border-radius on wrapper */
        .photo-oval {
            width: 52px;
            height: 66px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #00DF82;
            background: #e2e8f0;
            text-align: center;
        }
        .photo-oval img {
            width: 100%;
            height: 100%;
            display: block;
        }
        .photo-placeholder {
            font-size: 6px;
            color: #94a3b8;
            padding-top: 24px;
        }
        .name {
            font-size: 11px;
            font-weight: bold;
            color: #0B0F0E;
            margin-bottom: 2px;
            line-height: 1.1;
        }
        .designation {
            font-size: 8px;
            color: #00b368;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .contact {
            font-size: 7px;
            color: #334155;
            line-height: 1.35;
            word-wrap: break-word;
        }
        .contact .lbl {
            color: #64748b;
            font-size: 6px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .footer {
            background: #0B0F0E;
            color: #e2e8f0;
            font-size: 5.8px;
            padding: 4px 6px;
            text-align: center;
            line-height: 1.3;
            border-top: 2px solid #00DF82;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="header-logo">
                        @if(!empty($logoDataUri))
                            <img src="{{ $logoDataUri }}" alt="">
                        @endif
                    </td>
                    <td class="header-text">
                        <div class="company-name">{{ $company->name }}</div>
                        @if($company->tagline)
                            <div class="tagline">{{ \Illuminate\Support\Str::limit($company->tagline, 100) }}</div>
                        @endif
                    </td>
                    <td class="header-logo" style="width:38px;"></td>
                </tr>
            </table>
        </div>
        <div class="body">
            <table class="body-table">
                <tr>
                    <td class="photo-cell">
                        <div class="photo-oval">
                            @if(!empty($photoDataUri))
                                <img src="{{ $photoDataUri }}" alt="">
                            @else
                                <div class="photo-placeholder">Photo</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="name">{{ $user->name }}</div>
                        <div class="designation">{{ $user->designation ?: 'Staff' }}</div>
                        <div class="contact">
                            <span class="lbl">Email</span><br>
                            {{ $user->email }}<br><br>
                            <span class="lbl">Phone</span><br>
                            {{ $user->phone ?: '—' }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            {{ \Illuminate\Support\Str::limit($company->address_office, 130) }}
            @if($company->phonesList())
                <br><span style="color:#00DF82;">|</span> {{ $company->phonesList() }}
            @endif
        </div>
    </div>
</body>
</html>
