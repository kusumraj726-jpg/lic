<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NexoraByte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4f46e5;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 40px;
        }
        .footer {
            background-color: #f1f5f9;
            padding: 20px;
            text-align: center;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
        }
        h1 {
            color: #0f172a;
            font-size: 24px;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 15px;
        }
        .credentials-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .credentials-box h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 14px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .credential-item {
            margin-bottom: 10px;
        }
        .credential-label {
            font-weight: bold;
            color: #0f172a;
            display: inline-block;
            width: 100px;
        }
        .credential-value {
            color: #4f46e5;
            font-weight: 600;
        }
        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #ffffff; margin: 0; letter-spacing: 3px; font-weight: 800;">NEXORABYTE</h2>
        </div>
        <div class="content">
            <h1>Workspace Provisioned Successfully</h1>
            <p>Welcome, <strong>{{ $user->name }}</strong>.</p>
            <p>Your administrative console for <strong>{{ $user->company_name }}</strong> has been successfully provisioned and is ready for use.</p>
            
            <div class="credentials-box">
                <h3>Your Access Credentials</h3>
                <div class="credential-item">
                    <span class="credential-label">Admin ID:</span>
                    <span class="credential-value">{{ $user->unique_id }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Email ID:</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                @if(isset($password))
                <div class="credential-item">
                    <span class="credential-label">Password:</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
                @endif
            </div>
            
            <p>Please keep these credentials secure. You can now access your workspace and begin architecting your enterprise ecosystem.</p>
            
            <div style="text-align: center;">
                <a href="https://nexorabyte.in/login" class="button">Login to Workspace</a>
            </div>
            
            <div class="divider"></div>
            
            <p style="font-size: 12px; color: #64748b; margin-bottom: 0;">This is an automated message. If you did not authorize this registration, please contact our support team immediately.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} NEXORABYTE • SECURE ACCESS
        </div>
    </div>
</body>
</html>
