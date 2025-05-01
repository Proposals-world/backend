<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>It's a Match!</title>
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
            padding: 35px 0 30px;
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
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
        }
        .header-emoji {
            font-size: 36px;
            margin-left: 8px;
            display: inline-block;
            vertical-align: middle;
            animation: bounce 1s ease infinite alternate;
        }
        @keyframes bounce {
            from {
                transform: translateY(0px);
            }
            to {
                transform: translateY(-5px);
            }
        }
        
        /* Content Styles */
        .content {
            padding: 35px 40px;
            text-align: center;
        }
        .greeting {
            font-size: 22px;
            color: #9c0c58;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .message {
            font-size: 18px;
            color: #555555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .message p {
            margin: 0 0 20px;
        }
        .match-name {
            font-weight: 600;
            color: #9c0c58;
            font-size: 20px;
        }
        
        /* Match Notification Section */
        .match-container {
            margin: 30px auto;
            padding: 25px;
            background-color: #fdf8fb;
            border-radius: 12px;
            border: 1px dashed #e8c0d6;
            max-width: 400px;
        }
        .match-icon {
            font-size: 48px;
            margin-bottom: 15px;
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
        .disclaimer {
            font-size: 12px;
            color: #999999;
            margin-top: 15px;
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
            .header h1 {
                font-size: 28px;
            }
            .match-container {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>It's a Match!<span class="header-emoji">🎉</span></h1>
        </div>
        
        <div class="content">
            <p class="greeting">Assalamu Alaikum, {{ $user1->name }}!</p>
            
            <div class="match-container">
                <div class="match-icon">💞</div>
                <div class="message">
                    <p>You and <span class="match-name">{{ $user2->name }}</span> have liked each other!</p>
                    <p>This could be the beginning of something beautiful.</p>
                </div>
            </div>

            <p class="message">Take the next step on your journey to finding your soulmate the halal way.</p>

            <div class="button-container">
                <a href="{{ route('matches') }}" class="button">View Your Matches</a>
            </div>
        </div>

        <div class="footer">
            <p class="tagline">Finding Your Soulmate the Halal Way</p>
            
            <div class="disclaimer">
                <p>This notification was sent to keep you updated on your matching status.</p>
                <p>© {{ date('Y') }} Proposals. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>