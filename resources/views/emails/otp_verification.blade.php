<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
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
            margin-bottom: 15px;
        }

        /* Content Styles */
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
            margin-bottom: 25px;
            line-height: 1.6;
        }

        /* OTP Box Styles */
        .otp-container {
            margin: 25px 0;
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
        }
        .button:hover {
            background-color: #7c0946;
        }

        /* Instructions Box */
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

        /* Help Text */
        .help-text {
            font-size: 14px;
            color: #777777;
            margin-top: 20px;
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
  .rtl-block {
        direction: rtl !important;
        text-align: right !important;
        display: block !important;
    }

    /* لضبط القائمة والعناصر داخلها */
    .rtl-block ul {
        padding-right: 20px !important;
        padding-left: 0 !important;
        list-style: disc !important;
        list-style-position: inside !important;
    }

    .rtl-block ul li {
        direction: rtl !important;
        text-align: right !important;
        display: block !important;
    }

    .rtl-block p,
    .rtl-block strong {
        direction: rtl !important;
        text-align: right !important;
        display: block !important;
    }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <!-- Optional: Add your logo here -->
            <!-- <div class="logo"><img src="your-logo.png" alt="Logo" width="120"></div> -->
            <h1>{{ __('email.verification.title') }}</h1>
        </div>

        <div class="content">
            <p class="greeting">{{ __('email.verification.greeting') }}, {{$user->name}}</p>

            <div class="message">

                {{-- English --}}
                <p>{{ __('email.verification.message') }}</p>
        </div>


           <div class="otp-container">
                <div class="otp-box">{{ $otp }}</div>




                    <p class="expiry-note">
                        {{ __('email.verification.expire') }}
                    </p>

            </div>



            {{-- <div class="button-container">
                <a href="{{ config(key: 'app.frontend_url') }}/verify-otp" class="button">Verify OTP</a>
            </div> --}}

       <div class="instructions" style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin: 25px 0; font-size: 14px; color: #666;">

    <p style="direction: rtl; text-align: right; display: block; margin: 0 0 10px 0;">
        <strong>{{ __('email.verification.instructions_title') }}</strong>
    </p>

    <ul style="direction: rtl; text-align: right; display: block; list-style: disc; list-style-position: inside; margin: 10px 0; padding: 0 20px 0 0;">
        <li style="direction: rtl; text-align: right; display: list-item; margin-bottom: 5px;">
            {{ __('email.verification.instructions_step_1') }}
        </li>
        <li style="direction: rtl; text-align: right; display: list-item; margin-bottom: 5px;">
            {{ __('email.verification.instructions_step_2') }}
        </li>
        <li style="direction: rtl; text-align: right; display: list-item; margin-bottom: 5px;">
            {{ __('email.verification.instructions_step_3') }}
        </li>
    </ul>

    <p style="direction: rtl; text-align: right; display: block; margin-top: 10px;">
        {{ __('email.verification.instructions_warning') }}
    </p>

</div>



        <p class="help-text">
            {{ __('email.verification.help_text') }}
        </p>


        </div>

        <div class="footer">
            <p>{{ __('email.verification.footer_thanks') }}<br><strong>{{ config('app.name') }}</strong></p>

            <!-- Optional: Add social media links here -->
            <!-- <div class="social-links">
                <a href="#" class="social-link">Facebook</a>
                <a href="#" class="social-link">Twitter</a>
                <a href="#" class="social-link">Instagram</a>
            </div> -->

            <div class="disclaimer">
                {{ __('email.verification.footer_disclaimer') }}
            </div>
        </div>
    </div>
</body>
</html>
