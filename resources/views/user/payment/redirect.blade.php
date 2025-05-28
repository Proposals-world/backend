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
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                        <span class="text-muted">{{ __('Loading...') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load MPGS Checkout JS -->
<script src="{{ $baseUrl }}/static/checkout/checkout.min.js" 
    data-error="errorCallback"
    data-cancel="cancelCallback"
></script>

<script type="text/javascript">
    function errorCallback(error) {
        window.location.href = "{{ route('user.payment.failed', ['payment' => $orderId]) }}";
    }

    function cancelCallback() {
        window.location.href = "{{ route('user.payment.failed', ['payment' => $orderId]) }}";
    }

    // Configure and start checkout
    Checkout.configure({
        session: {
            id: '{{ $sessionId }}'
        }
    });

    // Start the payment process automatically
    window.addEventListener('load', function() {
        Checkout.showPaymentPage();
    });
</script>
@endsection 