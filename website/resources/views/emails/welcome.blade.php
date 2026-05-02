<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NexoraByte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f111a;
            color: #94a3b8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #1e293b;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .header {
            background-color: #0f111a;
            padding: 40px;
            text-align: center;
        }
        .content {
            padding: 40px;
        }
        .footer {
            background-color: #0f111a;
            padding: 20px;
            text-align: center;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #475569;
        }
        h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .id-badge {
            display: inline-block;
            background-color: rgba(225, 29, 72, 0.1);
            color: #e11d48;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 14px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #e11d48;
            color: #ffffff !important;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }
        .divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.05);
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #ffffff; margin: 0; letter-spacing: 4px; font-weight: 900;">NEXORABYTE</h2>
        </div>
        <div class="content">
            <h1>Workspace Provisioned Successfully</h1>
            <p>Welcome, <strong>{{ $user->name }}</strong>.</p>
            <p>Your elite administrative console for <strong>{{ $user->company_name }}</strong> has been successfully provisioned on our infrastructure.</p>
            
            <div class="id-badge">ADMIN ID: {{ $user->unique_id }}</div>
            
            <p>You can now access your workspace and begin architecting your enterprise data ecosystem using the credentials you provided during registration.</p>
            
            <a href="https://nexorabyte.in/login" class="button">Access Console</a>
            
            <div class="divider"></div>
            
            <p style="font-size: 12px;">This is an automated architectural protocol. If you did not authorize this provisioning, please contact our security team immediately.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} NEXORABYTE • ARCHITECTING EXCELLENCE
        </div>
    </div>
</body>
</html>
