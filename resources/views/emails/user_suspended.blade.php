<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            /* margin: 0;
            padding: 0; */
            background: #f4f4f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .email-wrapper {
            max-width: 700px;
            margin: 45px auto;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        }

        /* ✅ Fix header rounding + spacing */
        .header {
            background: #9c0c58;
            padding: 40px 0;
            text-align: center;
            color: #fff;
            font-size: 26px;
            font-weight: 600;
            border-radius: 14px 14px 0 0;
        }

        .content {
            padding: 40px 50px;
            color: #444;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #9c0c58;
        }

        /* ✅ Match subscription styled box */
        .message-box {
            background: #fdf8fb;
            border: 1px dashed #e2bcd2;
            border-radius: 12px;
            padding: 22px 20px;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 35px;
        }

        .support {
            font-size: 15px;
            color: #555;
            margin-bottom: 18px;
        }
        .support strong {
            color: #9c0c58;
            font-weight: 700;
        }

        /* ✅ Footer fixed to match invoice look */
        .footer {
            text-align: center;
            padding: 18px 0;
            font-size: 13px;
            color: #888;
            background: #fafafa;
            border-top: 1px solid #ececec;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">

        <div class="header">{{ __('email.suspended_title') }}</div>

        <div class="content" style="padding: auto;">

            <div class="greeting">
                {{ __('email.hello') }} {{ $user->first_name }} {{ $user->last_name }},
            </div>

            <div class="message-box">
                {!! __('email.suspended_message', ['id' => $user->id]) !!}
            </div>

            <div class="support">
                {{ __('email.support_note') }}<br>
                <strong>support@Tolba.world</strong>
            </div>

        </div>

        <div class="footer" style="width: 570px;">
            © {{ date('Y') }} Tolba. {{ __('email.all_rights_reserved') }}
        </div>
    </div>
</body>
</html>
