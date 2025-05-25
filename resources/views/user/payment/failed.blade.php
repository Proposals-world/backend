@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <i class="iconsminds-close text-danger" style="font-size: 4rem;"></i>
                    <h3 class="mt-3">Payment Failed</h3>
                    <p class="text-muted">Your payment could not be processed.</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('user.pricing') }}" class="btn btn-primary">
                            Try Again
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary ml-2">
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection