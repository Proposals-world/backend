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
                    
                    <div class="mt-4">
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