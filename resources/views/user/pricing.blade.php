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
                </div>

                <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                    <ul class="list-unstyled">
                        @if (Auth::user()->gender == "male")
                            <li>
                                <p class="mb-0">
                                    {{ __('userDashboard.pricing.contact_limit') }}: {{ $card['contact_limit'] }}
                                </p>
                            </li>
                        @else
                            <li>
                                <p class="mb-0">
                                    {{ __('userDashboard.pricing.duration') }}: {{ $card['duration'] ?? 'N/A' }} {{ __('home.in_days') }}
                                </p>
                            </li>
                        @endif
                    </ul>
                    <div class="text-center">
                        <a href="#" class="btn btn-link btn-empty btn-lg">
                            {{ __('userDashboard.pricing.button') }} <i class="simple-icon-arrow-right"></i>
                        </a>
                    </div>
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
                                            <!-- Button to trigger modal -->


                                            @if (!empty($card['payment_url']))
                                               <a href="#" class="btn btn-link btn-empty btn-lg" data-toggle="modal" data-target="#paymentModal">
    {{ __('userDashboard.pricing.button') }} <i class="simple-icon-arrow-right"></i>
</a>
<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content shadow-lg">

            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="simple-icon-credit-card mr-2"></i>  {{ __('payment.Payment_Notice') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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
                                    <a href="#"
                                        class="btn btn-link btn-empty btn-lg open-payment-modal"
                                        data-package-id="{{ $card['id'] }}"
                                        data-email="{{ Auth::user()->email }}"
                                        data-amount="{{ $card['price'] }}"
                                        data-date="{{ now() }}"
                                        data-url="{{ $card['payment_url'] }}">
                                        {{ __('userDashboard.pricing.button') }} <i class="simple-icon-arrow-right"></i>
                                    </a>
                                    @else
                                    <span class="text-muted">Payment link unavailable</span>
                                    @endif
                                </div>

                                <div class="text-right mt-auto">
                                    <img src="{{ asset('frontend/img/mastercard.png') }}" alt="Mastercard" height="20" class="ml-1">
                                    <img src="{{ asset('frontend/img/VISA-logo.png') }}" alt="VISA" height="20" class="ml-1">
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

<!-- ✅ SINGLE SHARED MODAL -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content shadow-lg">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title font-weight-bold">
          <i class="simple-icon-credit-card mr-2"></i> {{ __('payment.Payment_Notice') }}
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body text-center">
        <p class="mb-0">{{ __('payment.message') }}</p>
      </div>

      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-outline-secondary mr-auto" data-dismiss="modal">
          {{ __('payment.Cancel') }}
        </button>
        <button type="button" class="btn btn-primary proceed-payment-btn">
          {{ __('payment.Proceed_to_Payment') }}
        </button>
      </div>

    </div>
  </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentPackage = null;

    // When clicking a "Subscribe" button
    document.querySelectorAll('.open-payment-modal').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            // Save the clicked card’s data
            currentPackage = {
                packageId: this.dataset.packageId,
                email: this.dataset.email,
                amount: this.dataset.amount,
                date: this.dataset.date,
                url: this.dataset.url
            };
            $('#paymentModal').modal('show');
        });
    });

    // When clicking "Proceed to Payment"
    document.querySelector('.proceed-payment-btn').addEventListener('click', function () {
        if (!currentPackage) {
            alert('No package selected.');
            return;
        }

        fetch('{{ url('/api/check-user-payment') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Authorization': 'Bearer {{ Auth::user()->createToken("web")->plainTextToken ?? "" }}'
            },
            body: JSON.stringify({
                package_id: currentPackage.packageId,
                email: currentPackage.email,
                amount: currentPackage.amount,
                date: currentPackage.date
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.open(currentPackage.url, '_blank');
                $('#paymentModal').modal('hide');
            } else {
                alert('Error: ' + (data.message || 'Could not insert payment.'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong.');
        });
    });
});
</script>
@endpush
