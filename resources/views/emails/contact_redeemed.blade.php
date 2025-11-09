<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('email.title') }}</title>
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
            padding: 25px 0 20px;
            background-color: #9c0c58;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.2), transparent 70%);
            z-index: 1;
        }

        .header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
            z-index: 2;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
        }

        /* Content Styles */
        .content {
            padding: 35px 40px;
            text-align: center;
        }
        .greeting {
            font-size: 20px;
            color: #9c0c58;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .message p {
            margin: 0 0 20px;
        }
        .highlight {
            font-weight: 600;
            color: #9c0c58;
        }

        /* Notification Section */
        .notification-container {
            margin: 30px auto;
            padding: 25px;
            background-color: #fdf8fb;
            border-radius: 12px;
            border: 1px dashed #e8c0d6;
            max-width: 400px;
        }

        /* Button Styles */
        .button-container {
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 14px 32px;
            background-color: #9c0c58;
            color: #ffffff !important;
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
        .disclaimer {
            font-size: 12px;
            color: #999999;
            margin-top: 15px;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 10px auto;
                border-radius: 8px;
            }
            .content {
                padding: 25px 20px;
            }
            .header img {
                width: 80px;
            }
        }
    </style>
</head>
<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="email-container">
        <div class="header">
            <h1>{{ __('email.title') }}</h1>
        </div>

        <div class="content">
            <p class="greeting">{{ __('email.greeting') }} {{ $user->name }} 👋</p>

            <div class="notification-container">
                <div class="message">
                    <p>{{ __('email.message_redeemed') }}</p>
                    <p class="highlight">{{ __('email.remaining_contacts', ['count' => $user->subscription->contacts_remaining]) }}</p>
                </div>
            </div>

        </div>

        <div class="footer">
            <div class="disclaimer">
                <p>© {{ date('Y') }} {{ config('app.name', 'Tolba') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
