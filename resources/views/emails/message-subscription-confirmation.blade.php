<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmation</title>
    <style>
        /* Reset styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
        }

        /* Container styles */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        /* Header styles */
        .header {
            text-align: center;
            padding: 20px 0;
        }

        .logo {
            width: 200px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        /* Content styles */
        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .greeting {
            font-size: 24px;
            color: #9c0c58;
            margin-bottom: 20px;
            text-align: center;
        }

        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Button styles */
        .button-container {
            text-align: center;
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
            font-size: 16px;
        }

        /* Footer styles */
        .footer {
            text-align: center;
            padding: 20px;
            color: #666666;
            font-size: 14px;
            border-top: 1px solid #eeeeee;
            margin-top: 30px;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #E91E63;
            text-decoration: none;
        }

        .disclaimer {
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding: 10px;
            }

            .content {
                padding: 15px;
            }

            .greeting {
                font-size: 20px;
            }

            .message {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('admin/assets/images/brands/proposals-logo.jpeg') }}" alt="Islamic Proposals" class="logo">
        </div>

        <div class="content">
            <h1 class="greeting">Thank You for Subscribing!</h1>
            
            <div class="message">
                <p>Assalamu Alaikum,</p>
                <p>Thank you for subscribing to Islamic Proposals. We're excited to have you join our community of individuals seeking a halal way to find their life partner.</p>
                <p>We'll keep you updated about our launch and send you exclusive information about our services.</p>
            </div>

            <div class="button-container">
                <a href="{{ url('/') }}" class="button">Visit Our Website</a>
            </div>

            <div class="message">
                <p>Stay tuned for updates about:</p>
                <ul style="list-style: none; padding: 0;">
                    <li>✓ Our official launch date</li>
                    <li>✓ Special early-bird offers</li>
                    <li>✓ Exclusive features and services</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p>Islamic Proposals - Finding Your Soulmate the Halal Way</p>

            <div class="disclaimer">
                <p>This email was sent to {{ $email }}</p>
                <p>If you didn't subscribe to Islamic Proposals, please ignore this email.</p>
                <p>© {{ date('Y') }} Islamic Proposals. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>