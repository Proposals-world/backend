<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f6f6f6; }
        .container { background: #fff; padding: 30px; max-width: 600px; margin: 20px auto; border-radius: 10px; }
        .header { color: #b30059; font-size: 22px; font-weight: bold; margin-bottom: 20px; }
        .panel { border: 1px dashed #b30059; background: #fff5f8; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .panel p { margin: 5px 0; }
        .footer { font-size: 13px; color: #888; text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="color: white">Subscription Receipt</div>
        <p>Hello {{ $user->first_name ?? $user->last_name }},</p>
        <p>Thanks for your purchase. Below is your subscription summary.</p>

        <div class="panel">
            <p><strong>Package:</strong> {{ $package->package_name_en ?? '—' }}</p>
            <p><strong>Price:</strong> ${{ $price }} USD</p>
            <p><strong>Purchase Date:</strong> {{ $start->format('Y-m-d H:i') }}</p>
            {{-- <p><strong>Reason:</strong> {{ $reason }}</p> --}}
        </div>

        @if($isMale)
            <p><strong>Contacts Included:</strong> {{ $contacts }}</p>
        @else
            <p><strong>Duration:</strong> {{ $months }} {{ Str::plural('month', $months) }}</p>
        @endif

        <p><strong>Start Date:</strong> {{ $start->toDateString() }}</p>
        <p><strong>End Date:</strong> {{ $end->toDateString() }}</p>

        <p>Thanks,<br><strong>{{ config('app.name') }}</strong></p>

        <div class="footer">
            This receipt is for your records. If you have any questions, reply to this email.<br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
