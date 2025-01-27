<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .greeting {
            font-size: 20px;
            color: #9c0c58;
            margin-bottom: 15px;
        }
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 25px;
        }
        .button-container {
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #9c0c58;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #666666;
            margin-top: 20px;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Password Reset OTP</h1>
        </div>
        <div class="content">
            <p class="greeting">Assalamu Alaikum, {{ $userName }}</p>
            <p class="message">
                Your OTP verification code is <strong>{{ $otp }}</strong>. This code will expire in 15 minutes.
            </p>
            <div class="button-container">
                <a href="{{ config('app.frontend_url') }}/verify-otp" class="button">Verify OTP</a>
            </div>
        </div>
        <div class="footer">
            <p>Thanks,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>