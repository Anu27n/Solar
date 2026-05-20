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
        html, body { width: {{ $pw }}pt; height: {{ $ph }}pt; margin: 0; padding: 0; overflow: hidden; font-family: DejaVu Sans, sans-serif; }
        table { border-collapse: collapse; width: 100%; height: 100%; }
        .accent { width: 6pt; background: #00DF82; }
        .cell { vertical-align: top; padding: 4pt 5pt; }
        .logo-td { width: 33%; text-align: center; vertical-align: middle; padding: 2pt; }
        .logo-td img { max-height: 16pt; max-width: 58pt; }
        .badge { background: #0B0F0E; color: #00DF82; font-size: 5pt; font-weight: bold; padding: 2pt 4pt; }
        .tag { text-align: center; font-size: 5pt; font-weight: bold; color: #0B0F0E; text-transform: uppercase; padding: 3pt 0 5pt 0; }
        .photo-td { width: 72pt; text-align: center; vertical-align: middle; }
        .photo { width: 58pt; height: 58pt; border: 1.5pt solid #00DF82; border-radius: 50%; overflow: hidden; background: #f1f5f9; margin: 0 auto; }
        .photo img { width: 58pt; height: 58pt; }
        .photo-ph { font-size: 5pt; color: #94a3b8; padding-top: 22pt; text-align: center; }
        .name { font-size: 11pt; font-weight: bold; color: #0B0F0E; }
        .role { font-size: 7pt; font-weight: bold; color: #00a86b; padding: 2pt 0 4pt 0; }
        .lbl { font-size: 5pt; font-weight: bold; color: #64748b; text-transform: uppercase; }
        .val { font-size: 6pt; color: #334155; padding-bottom: 3pt; }
    </style>
</head>
<body>
<table cellspacing="0" cellpadding="0">
    <tr>
        <td class="accent"></td>
        <td class="cell">
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    @foreach($companies as $co)
                        <td class="logo-td">
                            @if(!empty($co['logoDataUri']))
                                <img src="{{ $co['logoDataUri'] }}" alt="">
                            @else
                                <span class="badge">{{ $co['shortLabel'] }}</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            </table>
            <div class="tag">Solar | Electrical | Refrigeration</div>
            <table cellspacing="0" cellpadding="0" width="100%">
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
                    <td style="vertical-align:middle;padding-left:6pt;">
                        <div class="name">{{ $user->name }}</div>
                        <div class="role">{{ $user->designation ?: 'Staff Member' }}</div>
                        <div class="lbl">Mobile</div>
                        <div class="val">{{ $user->phone ?: '-' }}</div>
                        <div class="lbl">Email</div>
                        <div class="val">{{ \Illuminate\Support\Str::limit($user->email, 38) }}</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
