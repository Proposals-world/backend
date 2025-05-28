@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="iconsminds-check text-success" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 text-success">{{ __('Payment Successful') }}</h3>
                    <p class="text-muted">{{ __('Thank you! Your subscription has been activated successfully.') }}</p>
                </div>
            </div>

            <!-- Receipt Card -->
            <div class="card card mt-4 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Payment Receipt') }}</h5>
                    <form action="{{ route('user.payment.email-receipt', $payment) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            <i class="simple-icon-envelope"></i> {{ __('Email Receipt') }}
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">{{ __('From:') }}</h6>
                            <div>
                                <strong>{{ config('app.name') }}</strong>
                            </div>
                            <div>{{ config('app.url') }}</div>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="mb-3">{{ __('To:') }}</h6>
                            <div>
                                <strong>{{ $payment->user->name }}</strong>
                            </div>
                            <div>{{ $payment->user->email }}</div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>{{ __('Order ID') }}</th>
                                    <td>{{ $payment->order_id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Package') }}</th>
                                    <td>{{ $payment->package->{'package_name_' . app()->getLocale()} }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Contact Limit') }}</th>
                                    <td>{{ $payment->package->contact_limit }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Payment Date') }}</th>
                                    <td>{{ $payment->paid_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Amount') }}</th>
                                    <td>{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        <span class="badge bg-success">{{ strtoupper($payment->status) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                            {{ __('Go to Dashboard') }}
                        </a>
                        <a href="{{ route('user.pricing') }}" class="btn btn-outline-secondary ml-2">
                            {{ __('View Other Packages') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection