<x-mail::message>
# Payment Receipt

Dear {{ $payment->user->name }},

Thank you for your payment. Here is your receipt for your records.

<x-mail::panel>
**Order Details:**
- Order ID: {{ $payment->order_id }}
- Package: {{ $payment->package->{'package_name_' . app()->getLocale()} }}
- Contact Limit: {{ $payment->package->contact_limit }}
- Payment Date: {{ $payment->paid_at->format('Y-m-d H:i:s') }}
- Amount: {{ number_format($payment->amount, 2) }} {{ $payment->currency }}
- Status: {{ strtoupper($payment->status) }}
</x-mail::panel>

<x-mail::button :url="route('user.dashboard')">
View Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> 