<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmation</title>
    <style>
        /* Base Styles */
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

        /* Header Styles */
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
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            object-fit: cover;
        }

        /* Content Styles */
        .content {
            padding: 35px 40px;
            text-align: center;
        }
        .greeting {
            font-size: 24px;
            color: #9c0c58;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .message p {
            margin: 0 0 15px;
        }

        /* Feature List */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 25px 0;
            text-align: left;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .feature-list li {
            margin-bottom: 12px;
            padding-left: 30px;
            position: relative;
            color: #555555;
        }
        .feature-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 0;
            color: #9c0c58;
            font-weight: bold;
        }

        /* Button Styles */
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
            box-shadow: 0 3px 6px rgba(156, 12, 88, 0.2);
        }
        .button:hover {
            background-color: #7c0946;
        }

        /* Footer Styles */
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
        .tagline {
            font-style: italic;
            color: #9c0c58;
            margin-bottom: 15px;
            font-weight: 600;
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
            padding-top: 15px;
            border-top: 1px solid #eeeeee;
        }
        .disclaimer p {
            margin: 5px 0;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 10px auto;
                border-radius: 8px;
            }
            .content {
                padding: 25px 20px;
            }
            .greeting {
                font-size: 22px;
            }
            .logo {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('admin/assets/images/tolba.png') }}"height= "100px" alt="Islamic Proposals" class="logo">
            <h1>Subscription Confirmation</h1>
        </div>

        <div class="content">
            <h1 class="greeting">Thank You for Subscribing!</h1>

            <div class="message">
                <p>Hello,</p>
                <p>Thank you for subscribing to Proposals. We're excited to have you join our community of individuals seeking a halal way to find their life partner.</p>
                <p>We'll keep you updated about our launch and send you exclusive information about our services.</p>
            </div>

            <div class="button-container">
                <a href="{{ url('/') }}" class="button" style="color: white;">Visit Our Website</a>
            </div>

            <div class="message">
                <p>Stay tuned for updates about:</p>
                <ul class="feature-list">
                    <li>Our official launch date</li>
                    <li>Special early-bird offers</li>
                    <li>Exclusive features and services</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p class="tagline">Finding Your Soulmate</p>

            <!-- Optional: Add social media links here -->
            <!-- <div class="social-links">
                <a href="#" class="social-link">Facebook</a>
                <a href="#" class="social-link">Twitter</a>
                <a href="#" class="social-link">Instagram</a>
            </div> -->

            <div class="disclaimer">
                <p>This email was sent to {{ $email }}</p>
                <p>If you didn't subscribe to Proposals, please ignore this email.</p>
                <p>© {{ date('Y') }} Proposals. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
