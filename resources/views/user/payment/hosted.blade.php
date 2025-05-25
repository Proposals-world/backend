@extends('user.layouts.app')

@section('content')
<div class="container my-5">
    <h4 class="mb-4">{{ __('Proceed to Payment') }}</h4>

    {{-- MPGS hosted checkout --}}
    <iframe
        src="{{ $checkoutUrl }}"
        title="Secure Payment"
        style="width:100%;min-height:720px;border:0"
        allowfullscreen
        allowpaymentrequest>
    </iframe>

    <p class="mt-3 text-muted text-center">
        {{ __('If the form does not appear, ') }}
        <a href="{{ $checkoutUrl }}" target="_blank" rel="noopener">
            {{ __('click here to open it in a new tab.') }}
        </a>
    </p>
</div>
@endsection