<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            font-family: "Nunito", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-box {
            max-width: 500px;
            background: #fff;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 5px 40px rgba(0,0,0,0.10);
            text-align: center;
        }

        .error-icon {
            font-size: 70px;
            color: #A00064;
        }

        .error-title {
            font-size: 30px;
            font-weight: bold;
            margin: 20px 0 10px;
        }

        .error-desc {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .btn-tolba {
            background: #A00064;
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
        }

        .btn-tolba:hover {
            background: #7a004d;
        }
    </style>
</head>

<body>
    <div class="error-box">
        @yield('content')
    </div>
</body>
</html>
