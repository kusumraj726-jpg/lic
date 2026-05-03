<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Workspace Ready</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f8fafc;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #1e293b;
    }
    .wrapper {
        width: 100%;
        padding: 40px 0;
        background-color: #f8fafc;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .header {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        padding: 48px 40px;
        text-align: center;
        color: #ffffff;
    }
    .brand {
        font-size: 16px;
        font-weight: 800;
        letter-spacing: 6px;
        text-transform: uppercase;
        margin-bottom: 12px;
        opacity: 0.9;
    }
    .header h2 {
        font-size: 32px;
        font-weight: 800;
        margin: 0;
        letter-spacing: -1px;
    }
    .content {
        padding: 48px 40px;
    }
    h1 {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
    }
    p {
        font-size: 16px;
        line-height: 1.7;
        color: #475569;
        margin-bottom: 28px;
    }
    .highlight {
        color: #0f172a;
        font-weight: 700;
    }
    .card {
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        padding: 32px;
        margin: 32px 0;
    }
    .card-header {
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        margin-bottom: 24px;
    }
    .cred-table {
        width: 100%;
        border-collapse: collapse;
    }
    .cred-table td {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .cred-table tr:last-child td {
        border-bottom: none;
    }
    .label {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        text-align: left;
    }
    .value {
        font-size: 14px;
        color: #4f46e5;
        font-weight: 700;
        text-align: right;
        font-family: 'SF Mono', 'Monaco', monospace;
    }
    .btn-container {
        text-align: center;
        margin-top: 40px;
    }
    .btn {
        display: inline-block;
        background-color: #4f46e5;
        color: #ffffff !important;
        padding: 20px 56px;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 800;
        font-size: 16px;
        box-shadow: 0 12px 30px rgba(79, 70, 229, 0.25);
        transition: all 0.3s ease;
    }
    .footer {
        padding: 40px;
        text-align: center;
        font-size: 12px;
        color: #94a3b8;
        background-color: #fafafa;
        border-top: 1px solid #f1f5f9;
    }
</style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="brand">NEXORABYTE</div>
                <h2>Provisioning Complete</h2>
            </div>
            <div class="content">
                <h1>Welcome, {{ $user->name }}!</h1>
                <p>Your administrative console for <span class="highlight">{{ $user->company_name }}</span> has been successfully architected and is now live on our secure infrastructure.</p>
                
                <div class="card">
                    <div class="card-header">Secure Access Keys</div>
                    <table class="cred-table">
                        <tr>
                            <td class="label">System ID</td>
                            <td class="value">{{ $user->unique_id }}</td>
                        </tr>
                        <tr>
                            <td class="label">Access Email</td>
                            <td class="value">{{ $user->email }}</td>
                        </tr>
                        @if(isset($password))
                        <tr>
                            <td class="label">Initial Password</td>
                            <td class="value">{{ $password }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                
                <p>Please synchronize your security protocols and store these credentials in a vault. You can now proceed to initiate your secure session.</p>
                
                <div class="btn-container">
                    <a href="https://nexorabyte.in/login" class="btn">Launch Enterprise Console</a>
                </div>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} NexoraByte Intelligence Suite.<br>
                Architecting the future of enterprise management.<br>
                <span style="display: block; margin-top: 12px; opacity: 0.5;">This is an automated architectural transmission.</span>
            </div>
        </div>
    </div>
</body>
</html>
