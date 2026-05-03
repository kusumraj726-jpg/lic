<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Ready</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .header {
            background-color: #4f46e5;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 5px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px;
        }
        .title {
            font-size: 24px;
            font-weight: 800;
            color: #000000;
            margin-bottom: 20px;
        }
        .welcome-text {
            font-size: 15px;
            color: #334155;
            margin-bottom: 20px;
        }
        .welcome-text strong {
            color: #000000;
        }
        .credentials-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            margin: 30px 0;
        }
        .credentials-title {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }
        .cred-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cred-table td {
            padding: 6px 0;
            font-size: 14px;
        }
        .label {
            font-weight: 700;
            color: #000000;
            width: 100px;
        }
        .value {
            color: #4f46e5;
            font-weight: 700;
        }
        .button-container {
            text-align: center;
            margin: 40px 0;
        }
        .btn {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            padding: 14px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }
        .disclaimer {
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.6;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 10px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>NEXORABYTE</h1>
        </div>
        <div class="content">
            <div class="title">Workspace Provisioned Successfully</div>
            
            <div class="welcome-text">
                Welcome, <strong>{{ $user->name }}</strong>.
            </div>
            
            <div class="welcome-text">
                Your administrative console for <strong>{{ $user->company_name }}</strong> has been successfully provisioned and is ready for use.
            </div>
            
            <div class="credentials-box">
                <div class="credentials-title">YOUR ACCESS CREDENTIALS</div>
                <table class="cred-table">
                    <tr>
                        <td class="label">Admin ID:</td>
                        <td class="value">{{ $user->unique_id }}</td>
                    </tr>
                    <tr>
                        <td class="label">Email ID:</td>
                        <td class="value">{{ $user->email }}</td>
                    </tr>
                    @if(isset($password))
                    <tr>
                        <td class="label">Password:</td>
                        <td class="value">{{ $password }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            
            <div class="welcome-text">
                Please keep these credentials secure. You can now access your workspace and begin architecting your enterprise ecosystem.
            </div>
            
            <div class="button-container">
                <a href="https://nexorabyte.in/login" class="btn" style="color: white !important;">Login to Workspace</a>
            </div>
            
            <div class="disclaimer">
                This is an automated message. If you did not authorize this registration, please contact our support team immediately.
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} NEXORABYTE - SECURE ACCESS
        </div>
    </div>
</body>
</html>
