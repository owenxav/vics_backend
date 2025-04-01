<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            color: #3d4852;
        }
        .email-body {
            padding: 20px 0;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 20px;
        }
        .greeting {
            color: #3d4852;
            font-weight: bold;
        }
        .email-body strong {
            color: #3d4852;
        }
        .password-box {
            font-size: 18px;
            font-weight: bold;
            color: #222;
            background: #eef2ff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin: 10px 0;
        }
        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #777;
        }
        .email-footer a {
            color: #0056b3;
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            color: #ffffff;
            background-color: #0056b3;
            border-radius: 5px;
            text-decoration: none;
        }
        .button:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ env('APP_NAME') }}</h1>
        </div>
        <div class="email-body">
            <p class="greeting">Hello,</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Here is your temporary password: <div class="password-box">{{ $temporaryPassword }}</div></p>
            <p>Please use this password to log in and change your password immediately.</p>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>
        <div class="email-footer">
            <p>Regards,<br>{{ env('APP_NAME') }}</p>
            <p>&copy; 2025 {{ env('APP_NAME') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>