<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your OTP Code</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f3f1; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f3f1; padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:16px; overflow:hidden; border:1px solid #e7e5e2;">

                    {{-- Header / Logo --}}
                    <tr>
                        <td align="center" style="background-color:#1f4b3f; padding:28px 20px;">
                            <img src="{{ asset('front/images/pashugharlogo.png') }}" alt="Pashughar" height="40" style="display:block; filter: brightness(0) invert(1);">
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 36px 28px;">
                            <p style="margin:0 0 8px; font-size:20px; font-weight:700; color:#1a1a1a;">
                                Your Verification Code
                            </p>
                            <p style="margin:0 0 26px; font-size:14px; line-height:1.6; color:#666666;">
                                Use the code below to {{ $purpose }} at Pashughar. This code is valid for the next {{ $validMinutes }} minutes.
                            </p>

                            {{-- OTP Box --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding:8px 0 26px;">
                                        <div style="display:inline-block; background-color:#f7f7f6; border:1px solid #e2e0dc; border-radius:12px; padding:16px 32px;">
                                            <span style="font-size:32px; font-weight:700; letter-spacing:10px; color:#1f4b3f;">
                                                {{ $otp }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 4px; font-size:13px; line-height:1.6; color:#999999;">
                                Didn't request this code? You can safely ignore this email — no changes will be made to your account.
                            </p>
                            <p style="margin:16px 0 0; font-size:13px; line-height:1.6; color:#c0392b; font-weight:600;">
                                Please do not share this OTP with anyone, including Pashughar staff.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:20px 36px 28px; border-top:1px solid #eeece9;">
                            <p style="margin:0; font-size:12px; color:#aaaaaa; text-align:center;">
                                &copy; {{ date('Y') }} Pashughar. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>