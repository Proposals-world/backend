<!DOCTYPE html>
<html lang="{{ $lang }}" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        body {
            margin: 0; padding: 0; background-color: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333; line-height: 1.6;
        }
        .email-container {
            max-width: 600px; margin: 20px auto; background: #fff;
            border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,.05);
            text-align: {{ $lang == 'ar' ? 'right' : 'left' }};
        }
        .header {
            background: #9c0c58; color: #fff; padding: 35px 0; text-align: center;
            position: relative;
        }
        .header h1 { margin:0; font-size:28px; font-weight:600; }
        .content { padding: 35px 40px; }
        .footer { text-align:center; padding:20px; font-size:14px; color:#777; background:#f9f9f9; }
    </style>
</head>

<body>
    <div class="email-container">

        <div class="header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="content">
            {!! $content !!}
        </div>

        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }} – All rights reserved.
        </div>

    </div>
</body>
</html>
