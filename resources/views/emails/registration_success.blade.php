<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="20" style="background:#ffffff; margin:30px auto; border-radius:12px; box-shadow:0px 4px 20px rgba(0,0,0,0.3);">
                    
                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding:30px 0; background:#111827; border-top-left-radius:12px; border-top-right-radius:12px;">
                            <img src="https://randour-x.com/imagess/logorandour.png" alt="Randourx Logo" width="160" style="display:block; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="text-align:center; color:#1e293b; padding:20px;">
                            <h2 style="margin:0; font-size:26px; color:#0f172a;">Hello {{ $full_user }},</h2>
                            <p style="font-size:17px; color:#475569;">Thank you for registering with <strong>Randourx</strong>!</p>
                        </td>
                    </tr>

                    <!-- User Info -->
                    <tr>
                        <td style="padding:20px;">
                            <table width="100%" cellpadding="12" cellspacing="0" style="border:1px solid #e2e8f0; border-radius:10px; background:#f9fafb;">
                                <tr>
                                    <td style="font-size:16px; color:#1e293b;"><strong>Username:</strong></td>
                                    <td style="font-size:16px; color:#334155;">{{ $username }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px; color:#1e293b;"><strong>Email:</strong></td>
                                    <td style="font-size:16px; color:#334155;">{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px; color:#1e293b;"><strong>Password:</strong></td>
                                    <td style="font-size:16px; color:#334155;">{{ $plainPassword ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Extra Note -->
                    <tr>
                        <td style="text-align:center; color:#334155; padding:20px;">
                            <p style="font-size:16px;">Use your username <b>{{ $username }}</b> and password <b>{{ $plainPassword }}</b> to log in to our portal!</p>
                        </td>
                    </tr>

                    <!-- CTA -->
                    <tr>
                        <td align="center" style="padding:30px;">
                            <a href="https://randourx.com/login" 
                               style="background:linear-gradient(90deg,#2563eb,#1d4ed8); color:#ffffff; text-decoration:none; padding:14px 30px; border-radius:8px; font-size:17px; font-weight:bold; display:inline-block; box-shadow:0 3px 8px rgba(37,99,235,0.4);">
                                Login to Your Account
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="font-size:14px; color:#64748b; padding:20px; border-top:1px solid #e2e8f0;">
                            © {{ date('Y') }} Randourx. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
