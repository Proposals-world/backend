@extends('user.layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center">

        <!-- Checkmark Icon -->
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14m0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16"/>
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
            </svg>
        </div>

        <!-- Success Message -->
        <h2 class="text-success font-weight-bold">{{ __('payment.Payment_Successful') }}</h2>
        <p class="mt-3 text-muted">
           {!! __('payment.we_will_activate_your_subscription_within_24_hours') !!}

        </p>

        <!-- Back to Dashboard -->
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-4">
            {!! __('payment.Go_to_Home') !!}
        </a>
    </div>
</div>
@endsection
