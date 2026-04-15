<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .wrapper { max-width: 580px; margin: 40px auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .header { background: #1a3a2a; padding: 36px 32px; text-align: center; }
        .header h1 { color: #fff; font-size: 22px; margin: 0; }
        .header p { color: rgba(255,255,255,.65); font-size: 13px; margin: 6px 0 0; }
        .body { padding: 32px; }
        .body h2 { color: #1a3a2a; font-size: 20px; margin-bottom: 10px; }
        .body p { color: #4a5e4f; font-size: 15px; line-height: 1.7; margin-bottom: 12px; }
        .details { background: #f0f5f1; border-radius: 10px; padding: 20px 24px; margin: 24px 0; }
        .details table { width: 100%; border-collapse: collapse; }
        .details td { padding: 7px 0; font-size: 14px; color: #4a5e4f; }
        .details td:first-child { font-weight: 600; color: #1a3a2a; width: 40%; }
        .footer { background: #f7f3ec; padding: 20px 32px; text-align: center; }
        .footer p { color: #aaa; font-size: 12px; margin: 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Malaysian Forestry Conference 2026</h1>
            <p>Registration Confirmation</p>
        </div>
        <div class="body">
            <h2>You're registered! 🌿</h2>
            <p>Dear <strong>{{ $registration->name }}</strong>, your registration for the Malaysian Forestry Conference 2026 has been confirmed. We look forward to seeing you!</p>

            <div class="details">
                <table>
                    <tr>
                        <td>Full Name</td>
                        <td>{{ $registration->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $registration->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $registration->phone }}</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>{{ $registration->designation }}</td>
                    </tr>
                    <tr>
                        <td>Agency</td>
                        <td>{{ $registration->agency }}</td>
                    </tr>
                </table>
            </div>

            <p>To verify your attendance on each day of the conference, visit the event website and enter your registered email address.</p>
            <p>If you have any questions, please contact us at <a href="mailto:forestdepartment@sarawak.gov.my" style="color:#2d5a3d;">forestdepartment@sarawak.gov.my</a></p>
        </div>
        <div class="footer">
            <p>© 2026 Forest Department Sarawak · This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>