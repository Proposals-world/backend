<!DOCTYPE html>
<html lang="{{ request()->header('Accept-Language', app()->getLocale()) }}" dir="{{ request()->header('Accept-Language', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('email.title') }}</title>
</head>
<body style="font-family: 'Poppins', Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <div style="background: linear-gradient(135deg, #D16BA5, #86A8E7, #5FFBF1); padding: 20px; color: white; text-align: center;">
            <h1 style="margin: 0;">{{ __('email.title') }}</h1>
        </div>
        <div style="padding: 30px; text-align: center; color: #555;">
            <p style="font-size: 18px;">{{ __('email.greeting') }}</p>

           <p style="font-size: 16px;">{{ __('email.message', ['user' => $liker->name]) }}</p>

            <a href="{{ url('/') }}" style="display: inline-block; margin-top: 30px; background: #D16BA5; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                {{ __('email.view_my_likes') }}
            </a>
        </div>
    </div>
</body>
</html>
