@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="iconsminds-close text-danger" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 text-danger">{{ __('Payment Cancelled') }}</h3>
                    <p class="text-muted">{{ __('Your payment process was cancelled. This could be due to:') }}</p>
                    <ul class="text-muted text-left">
                        <li>{{ __('You cancelled the payment process') }}</li>
                        <li>{{ __('The payment session expired') }}</li>
                        <li>{{ __('There was an issue with the payment gateway') }}</li>
                    </ul>
                    
                    <div class="mt-4">
                        <a href="{{ route('user.pricing') }}" class="btn btn-primary">
                            {{ __('Try Again') }}
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary ml-2">
                            {{ __('Go to Dashboard') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection