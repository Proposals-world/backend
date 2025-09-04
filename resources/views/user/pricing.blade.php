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
                    @php $isMale = Auth::user()->gender === 'male'; @endphp

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
                                    </div>

                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            @if ($isMale)
                                                <li>
                                                    <p class="mb-0">
                                                        {{ __('userDashboard.pricing.contact_limit') }}:
                                                        {{ $card['contact_limit'] }}
                                                    </p>
                                                </li>
                                            @else
                                                <li>
                                                    <p class="mb-0">
                                                        {{ __('userDashboard.pricing.duration') }}:
                                                        {{ $card['duration'] ?? 'N/A' }} {{ __('home.in_days') }}
                                                    </p>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="text-center">
                                            @if (!empty($card['payment_url']))
                                                <a href="{{ $card['payment_url'] }}" target="_blank"
                                                    class="btn btn-link btn-empty btn-lg">
                                                    {{ __('userDashboard.pricing.button') }} <i
                                                        class="simple-icon-arrow-right"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">Payment link unavailable</span>
                                            @endif
                                        </div>

                                        <div class="text-right mt-auto">
                                            <img src="{{ asset('frontend/img/mastercard.png') }}" alt="Mastercard"
                                                height="20" class="ml-1">
                                            <img src="{{ asset('frontend/img/VISA-logo.png') }}" alt="VISA"
                                                height="20" class="ml-1">
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
