@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-12">
            <div class="mb-2">
                <h1>{{ __('userDashboard.pricing.title') }}</h1>
                <p>{{ __('userDashboard.pricing.desc') }}</p>
                <div class="separator mb-5"></div>
            </div>

            <div class="row equal-height-container">
                @forelse ($subscriptionCards as $card)
                    <div class="col-md-12 col-lg-4 mb-4 col-item">
                        <div class="card">
                            <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                <div class="price-top-part">
                                    <i class="iconsminds-wallet large-icon"></i>
                                    <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">
                                        {{ $card['package_name'] }}
                                    </h5>
                                    <p class="text-large mb-2 text-default">${{ $card['price'] }}</p>
                                    <p class="text-muted text-small">
                                        {{ __('userDashboard.pricing.contact_limit') }}: {{ $card['contact_limit'] }}
                                    </p>
                                </div>

                                <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="mb-0">
                                                {{ __('userDashboard.pricing.contact_limit') }}: {{ $card['contact_limit'] }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="text-center">
                                        <form action="{{ route('user.payment.checkout') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{ $card['id'] }}">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                {{ __('userDashboard.pricing.button') }} <i class="simple-icon-arrow-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>{{ __('userDashboard.pricing.no_packages_available') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection