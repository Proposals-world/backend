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
            background-color: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333333;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 30px 0 20px;
            background-color: #9c0c58;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .logo {
            margin-bottom: 15px;
        }
        .content {
            padding: 35px 40px;
            text-align: center;
        }
        .greeting {
            font-size: 20px;
            color: #9c0c58;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 30px;
            line-height: 1.6;
            text-align: left;
        }
        .otp-container {
            margin: 30px 0;
            text-align: center;
        }
        .otp-box {
            display: inline-block;
            padding: 15px 40px;
            background-color: #f5f5f5;
            border-radius: 8px;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 5px;
            color: #9c0c58;
            border: 1px dashed #dddddd;
        }
        .expiry-note {
            margin-top: 15px;
            font-size: 14px;
            color: #777777;
            font-style: italic;
        }
        .button-container {
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 14px 32px;
            background-color: #9c0c58;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #7c0946;
        }
        .instructions {
            margin: 25px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            text-align: left;
            font-size: 14px;
            color: #666666;
            line-height: 1.5;
        }
        .instructions p {
            margin: 0 0 10px 0;
        }
        .instructions ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin-bottom: 5px;
        }
        .help-text {
            font-size: 14px;
            color: #777777;
            margin-top: 25px;
        }
        .footer {
            text-align: center;
            padding: 25px 20px;
            font-size: 14px;
            color: #666666;
            background-color: #f9f9f9;
            border-top: 1px solid #eeeeee;
        }
        .footer p {
            margin: 0 0 10px 0;
        }
        .social-links {
            margin: 15px 0;
        }
        .social-link {
            display: inline-block;
            margin: 0 8px;
            color: #9c0c58;
            text-decoration: none;
        }
        .disclaimer {
            font-size: 12px;
            color: #999999;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <!-- Optional: Add your logo here -->
            <!-- <div class="logo"><img src="your-logo.png" alt="Logo" width="120"></div> -->
            <h1>Password Reset</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Assalamu Alaikum, {{ $userName }}</p>
            
            <div class="message">
                <p>We received a request to reset your password. To continue with the password reset process, please use the verification code below:</p>
            </div>
            
            <div class="otp-container">
                <div class="otp-box">{{ $otp }}</div>
                <p class="expiry-note">This code will expire in 15 minutes</p>
            </div>
            
            <div class="instructions">
                <p><strong>To reset your password:</strong></p>
                <ul>
                    <li>Enter this code on the password reset page</li>
                    <li>Create a strong new password</li>
                    <li>Make sure to use a combination of letters, numbers, and symbols</li>
                </ul>
                <p>If you did not request a password reset, please ignore this email or contact customer support if you have concerns.</p>
            </div>
            
            <p class="help-text">If you're having trouble, please contact our support team for assistance.</p>
        </div>
        
        <div class="footer">
            <p>Thanks,<br><strong>{{ config('app.name') }}</strong></p>
            
            <!-- Optional: Add social media links here -->
            <!-- <div class="social-links">
                <a href="#" class="social-link">Facebook</a>
                <a href="#" class="social-link">Twitter</a>
                <a href="#" class="social-link">Instagram</a>
            </div> -->
            
            <div class="disclaimer">
                This is an automated message, please do not reply to this email.
            </div>
        </div>
    </div>
</body>
</html>