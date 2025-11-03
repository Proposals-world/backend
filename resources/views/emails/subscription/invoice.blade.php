<html>
  <body style="font-family:'DejaVu Sans',sans-serif; font-size:12px;">

    {{-- Header with "Tolba" title --}}
    <table width="100%" style="margin-bottom:10px;">
      <tr>
        <td align="left" valign="top">
          <h1 style="margin:0; color:#b30059; font-size:28px;">Tolba</h1>
        </td>
        <td align="right" valign="bottom" style="text-align:right;">
          <h2 style="margin:0; padding:0;">{{ __('email.Subscription_Receipt') }}</h2>
        </td>
      </tr>
    </table>

    {{-- Invoice info --}}
    <p>
      <strong>{{ __('email.Company_Name') }}:</strong> {{ $fwateer->company_name ?? 'Tolba Platform' }}<br>
      <strong>{{ __('email.Customer') }}:</strong> {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}<br>
      <strong>{{ __('email.Invoice_Number') }}:</strong> {{ $fwateer->invoice_number ?? '' }}<br>
      <strong>{{ __('email.Invoice_Date') }}:</strong> {{ $fwateer->invoice_date?->format('Y-m-d') ?? '' }}<br>
      <strong>{{ __('email.Payment_Method') }}:</strong> {{ ucfirst($fwateer->payment_method ?? '-') }}
    </p>

    {{-- Details Table --}}
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <th>{{ __('email.Description') }}</th>
        <th align="right">{{ __('email.Details') }}</th>
      </tr>
      <tr>
        <td>{{ __('email.Package_Name') }}</td>
        <td align="right">{{ $package->package_name_en ?? '-' }}</td>
      </tr>
      <tr>
        <td>{{ __('email.Subscription_Price') }}</td>
        <td align="right">{{ number_format($fwateer->amount ?? $price ?? 0, 2) }} JOD</td>
      </tr>
      <tr>
        <td>{{ __('email.Purchase_Date') }}</td>
        <td align="right">{{ $start?->format('Y-m-d H:i') ?? ($fwateer->invoice_date?->format('Y-m-d H:i') ?? '-') }}</td>
      </tr>

      @if($isMale ?? false)
        <tr>
          <td>{{ __('email.Contacts_Included') }}</td>
          <td align="right">{{ $contacts ?? '-' }}</td>
        </tr>
      @else
        <tr>
          <td>{{ __('email.Duration') }}</td>
          <td align="right">{{ $months ?? '-' }} {{ __('email.months') }}</td>
        </tr>
      @endif

      <tr>
        <td>{{ __('email.Start_Date') }}</td>
        <td align="right">{{ $start?->toDateString() ?? '-' }}</td>
      </tr>
      <tr>
        <td>{{ __('email.End_Date') }}</td>
        <td align="right">{{ $end?->toDateString() ?? '-' }}</td>
      </tr>

      <tr>
        <td><strong>{{ __('email.Total_Due') }}</strong></td>
        <td align="right"><strong>{{ number_format($fwateer->amount ?? $price ?? 0, 2) }} JOD</strong></td>
      </tr>
    </table>

    {{-- Footer --}}
    <p style="text-align:center; margin-top:20px;">
      {{ __('email.Footer_Note') }}<br>
      © {{ date('Y') }} {{ config('app.name') }}
    </p>

  </body>
</html>
