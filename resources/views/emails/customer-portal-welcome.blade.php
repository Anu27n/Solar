<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal login</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f5;font-family:Segoe UI,system-ui,sans-serif;font-size:15px;line-height:1.55;color:#1a1a1a;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width:520px;background:#ffffff;border-radius:12px;border:1px solid #e4e4e7;overflow:hidden;">
                    <tr>
                        <td style="padding:28px 28px 8px;">
                            <p style="margin:0 0 8px;font-size:12px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#00a86b;">U.P.R. Solar</p>
                            <h1 style="margin:0 0 16px;font-size:20px;font-weight:700;">Welcome, {{ $customerName }}</h1>
                            <p style="margin:0 0 16px;color:#52525b;">Your channel partner has registered you on our customer portal. Use the credentials below to sign in and track your installation, KYC, and payments.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 20px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#fafafa;border:1px solid #e4e4e7;border-radius:10px;">
                                <tr>
                                    <td style="padding:16px 18px;">
                                        <p style="margin:0 0 6px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#71717a;">Login link</p>
                                        <p style="margin:0 0 14px;word-break:break-all;"><a href="{{ $loginUrl }}" style="color:#00a86b;font-weight:600;">{{ $loginUrl }}</a></p>
                                        <p style="margin:0 0 6px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#71717a;">Email</p>
                                        <p style="margin:0 0 14px;font-family:ui-monospace,Consolas,monospace;font-size:14px;">{{ $loginEmail }}</p>
                                        <p style="margin:0 0 6px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#71717a;">Temporary password</p>
                                        <p style="margin:0;font-family:ui-monospace,Consolas,monospace;font-size:15px;font-weight:600;letter-spacing:0.04em;">{{ $temporaryPassword }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 28px;">
                            <p style="margin:0;font-size:13px;color:#71717a;">For security, change this password after your first login if that option is available. If you did not expect this email, contact your channel partner or our support team.</p>
                        </td>
                    </tr>
                </table>
                <p style="margin:16px 0 0;font-size:12px;color:#a1a1aa;">This is an automated message. Please do not reply directly to this email.</p>
            </td>
        </tr>
    </table>
</body>
</html>
