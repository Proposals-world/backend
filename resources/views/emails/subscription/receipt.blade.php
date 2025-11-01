<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <style>
        body { margin: 0; padding: 0; background: #f3f4f6; font-family: "Segoe UI", Arial, sans-serif; direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}; }
        .invoice-wrapper { max-width: 750px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.07); }
        .header { background: linear-gradient(90deg, #b30059, #7d0040); color: #fff; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 600; }
        .section { padding: 25px 35px; }
        .info { margin-bottom: 15px; font-size: 14px; color: #444; }
        .info strong { color: #111; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px 10px; border-bottom: 1px solid #eaeaea; font-size: 14px; }
        th { background: #fafafa; font-weight: 600; }
        .total { font-weight: bold; background: #fcf1f6; color: #b30059; border-top: 2px solid #b30059; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #777; border-top: 1px solid #ececec; }
    </style>
</head>

<body>
<div class="invoice-wrapper">

    <div class="header">
        <img src="{{ asset('admin/assets/images/tolba.png') }}" alt="Logo" style="max-width: 140px; margin-bottom: 10px; background: #fff; padding: 5px; border-radius: 8px;">
        <h1 style="text-align: center; margin: 0; color: white;">{{ __('email.Subscription_Receipt') }}</h1>
    </div>

    <div class="section">

        <p class="info">
            <strong>{{ __('email.company') }} :</strong> {{ __('email.company_name') }}<br>
            <strong>{{ __('email.Customer') }}:</strong> {{ $user->first_name }} {{ $user->last_name }}<br>
            <strong>{{ __('email.Invoice_Date') }}:</strong> {{ $fwateer->invoice_date }}<br>
            <strong>{{ __('email.Invoice_Number') }}:</strong> {{ $fwateer->invoice_number }}
        </p>

        <table>
            <tr>
                <th>{{ __('email.Description') }}</th>
                <th style="text-align:right;">{{ __('email.Amount') }}</th>
            </tr>

            <tr><td>{{ __('email.Package_Name') }}</td><td style="text-align:right;">{{ $package->package_name_en }}</td></tr>
            <tr><td>{{ __('email.Subscription_Price') }}</td><td style="text-align:right;">${{ number_format($price,2) }} USD</td></tr>
            <tr><td>{{ __('email.Purchase_Date') }}</td><td style="text-align:right;">{{ $start->format('Y-m-d H:i') }}</td></tr>

            @if($isMale)
                <tr><td>{{ __('email.Contacts_Included') }}</td><td style="text-align:right;">{{ $contacts }}</td></tr>
            @else
                <tr><td>{{ __('email.Duration') }}</td><td style="text-align:right;">{{ $months }} {{ __('email.months') }}</td></tr>
            @endif

            <tr><td>{{ __('email.Start_Date') }}</td><td style="text-align:right;">{{ $start->toDateString() }}</td></tr>
            <tr><td>{{ __('email.End_Date') }}</td><td style="text-align:right;">{{ $end->toDateString() }}</td></tr>

            <tr class="total">
                <td>{{ __('email.Total_Due') }}</td>
                <td style="text-align:right;">${{ number_format($price,2) }} USD</td>
            </tr>
        </table>

    </div>

    <div class="footer">
        {{ __('email.Footer_Note') }}<br>
        © {{ date('Y') }} {{ config('app.name') }}
    </div>

</div>
</body>
</html>
