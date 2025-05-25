@extends('user.layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h3 class="text-success mb-3">{{ __('Payment Successful') }}</h3>
    <p>{{ __('Thank you! Your subscription has been activated.') }}</p>
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">{{ __('Back to Dashboard') }}</a>
</div>
@endsection