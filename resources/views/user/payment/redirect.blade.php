@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-4">{{ __('Redirecting to Payment Gateway') }}</h3>
                    <p class="text-muted">{{ __('Please wait while we redirect you to the secure payment page...') }}</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary me-2" role="status">
                            <span class="visually-hidden">{{ __('') }}</span>
                        </div>
                        <span class="text-muted">{{ __('Loading...') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="paymentForm" method="POST" action="{{ $checkoutUrl }}">
    <input type="hidden" name="session.id" value="{{ $sessionId }}">
    <input type="hidden" name="merchant" value="{{ $merchantId }}">
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('paymentForm').submit();
    });
</script>
@endsection 