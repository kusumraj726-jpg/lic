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
        background: linear-gradient(120deg, #eef2ff, #f8fafc);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: #1f2937;
    }

    .container {
        max-width: 620px;
        margin: 50px auto;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    /* HEADER */
    .header {
        background: linear-gradient(135deg, #4f46e5, #7c3aed, #6366f1);
        background-size: 200% 200%;
        animation: gradientMove 6s ease infinite;
        color: #fff;
        text-align: center;
        padding: 30px 20px;
    }

    @keyframes gradientMove {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }

    .brand {
        font-size: 20px;
        letter-spacing: 3px;
        font-weight: 600;
        opacity: 0.9;
    }

    /* CONTENT */
    .content {
        padding: 35px 28px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 12px;
        color: #111827;
    }

    p {
        font-size: 15px;
        line-height: 1.7;
        color: #4b5563;
    }

    .highlight {
        font-weight: 600;
        color: #111827;
    }

    /* CARD */
    .credentials {
        background: linear-gradient(145deg, #f9fafb, #f1f5f9);
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 22px;
        margin: 28px 0;
    }

    .credentials h3 {
        font-size: 13px;
        letter-spacing: 1.5px;
        color: #6b7280;
        margin-bottom: 15px;
        margin-top: 0;
    }

    .cred-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px dashed #e5e7eb;
        font-size: 14px;
    }

    .cred-row:last-child {
        border-bottom: none;
    }

    .cred-label {
        color: #6b7280;
    }

    .cred-value {
        color: #4f46e5;
        font-weight: 600;
    }

    /* BUTTON */
    .button-container {
        text-align: center;
        margin: 35px 0;
    }

    .btn {
        display: inline-block;
        padding: 14px 32px;
        border-radius: 10px;
        text-decoration: none;
        color: white !important;
        font-weight: 600;
        font-size: 15px;
        background: linear-gradient(135deg, #6366f1, #7c3aed);
        box-shadow: 0 8px 18px rgba(99,102,241,0.35);
        transition: all 0.25s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 22px rgba(99,102,241,0.45);
    }

    /* FOOTER */
    .footer {
        border-top: 1px solid #eef2f7;
        padding: 20px;
        text-align: center;
        font-size: 12px;
        color: #9ca3af;
        line-height: 1.6;
        background: #fafafa;
    }

</style>
</head>

<body>

<div class="container">

    <div class="header">
        <div class="brand">NEXORABYTE</div>
    </div>

    <div class="content">
        <h1>Workspace Provisioned Successfully 🎉</h1>

        <p>Welcome, <span class="highlight">{{ $user->name }}</span>.</p>

        <p>
            Your administrative console for 
            <span class="highlight">{{ $user->company_name }}</span> 
            has been successfully provisioned and is now ready for use.
        </p>

        <div class="credentials">
            <h3>YOUR ACCESS CREDENTIALS</h3>

            <div class="cred-row">
                <span class="cred-label">Admin ID</span>
                <span class="cred-value">{{ $user->unique_id }}</span>
            </div>

            <div class="cred-row">
                <span class="cred-label">Email</span>
                <span class="cred-value">{{ $user->email }}</span>
            </div>

            @if(isset($password))
            <div class="cred-row">
                <span class="cred-label">Password</span>
                <span class="cred-value">{{ $password }}</span>
            </div>
            @endif
        </div>

        <p>
            Keep your credentials secure. You can now start building and managing your enterprise workspace.
        </p>

        <div class="button-container">
            <a href="https://nexorabyte.in/login" class="btn" style="color: white !important;">Login to Workspace</a>
        </div>
    </div>

    <div class="footer">
        This is an automated message. If you did not authorize this registration, please contact support immediately.
    </div>

</div>

</body>
</html>
