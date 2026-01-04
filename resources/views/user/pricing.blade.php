@extends('user.layouts.app')

@section('content')
<style>/* =========================
   CORNER LABEL CONTAINER
========================= */

/* ✅ Ribbon Wrapper */
.offer-ribbon {
    position: absolute;
    top: 0;
    width: 120px;
    height: 120px;
    overflow: hidden;
    z-index: 10;
}

/* ✅ EN = Left */
.ribbon-left {
    left: 0;
}

/* ✅ AR = Right */
.ribbon-right {
    right: 0;
}

/* ✅ Ribbon Strip */
.offer-ribbon span {
    position: absolute;
    display: block;
    width: 170px;
    padding: 8px 0;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    text-align: center;
    background: linear-gradient(135deg, #ff512f, #dd2476);
    box-shadow: 0 8px 20px rgba(221, 36, 118, 0.35);
    letter-spacing: 0.4px;
}

/* ✅ Left Ribbon Rotation */
.ribbon-left span {
    transform: rotate(-45deg);
    top: 28px;
    left: -45px;
}

/* ✅ Right Ribbon Rotation */
.ribbon-right span {
    transform: rotate(45deg);
    top: 28px;
    right: -45px;
}

</style>
<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-12">
            <div class="mb-2">
                <h1>{{ __('userDashboard.pricing.title') }}</h1>
                <p>{{ __('userDashboard.pricing.desc') }}</p>
                <div class="separator mb-5"></div>
            </div>

            <div class="row equal-height-container">
                <div class="col-12">
        <h3 class="mb-3 text-left font-weight-bold text-primary">
            {{ __('payment.pay_by_card') }}
        </h3>
    </div>
                @php $isMale = Auth::user()->gender === 'male'; @endphp

                @forelse ($subscriptionCards as $card)
                <div class="col-md-12 col-lg-4 mb-4 col-item">
                    <div class="card position-relative
                            @if($activePackageId == $card['id']) border-success shadow-lg @endif"
                            style="@if($activePackageId == $card['id']) border-width:3px !important; @endif">
                             @if($activePackageId == $card['id'])
                                <!-- 🎯 ACTIVE Badge -->
                                <span class="badge badge-success position-absolute"
                                    style="top:10px; right:10px; font-size:13px; padding:6px 10px;">
                                    {{ __('payment.Active') }}
                                </span>
                                @endif
                                {{-- {{ dd($card) }} --}}
                              @if(!empty($card['is_special_offer']) && $card['is_special_offer'])
                                <div class="offer-ribbon {{ app()->getLocale() === 'ar' ? 'ribbon-right' : 'ribbon-left' }}">
                                    <span>{{ __('payment.Special_Offer') }}</span>
                                </div>
                            @endif




                            <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                            <div class="price-top-part">
                                <i class="iconsminds-wallet large-icon"></i>
                                <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">
                                    {{ $card['package_name'] }}
                                </h5>
                                <p class="text-large mb-2 text-default">${{ $card['price'] }}</p>
                                @if($activePackageId == $card['id'] && $activeSubscription)
                                    <p class="text-success font-weight-bold mt-2" style="font-size: 14px;">
                                        {{ __('payment.expires_at') }}:
                                        {{ \Carbon\Carbon::parse($activeSubscription->expires_at)->format('Y-m-d') }}
                                    </p>
                                @endif

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
                                    <div class="text-center mt-2">
                                        @if($card['country_group_id'] == 1)
                                            <!-- PAY WITH CLIQ BUTTON -->
                                            <button
                                                class="btn btn-outline-primary btn-sm open-cliq-with-package"
                                                data-package-id="{{ $card['id'] }}">
                                                {{ __('payment.Pay_with_CliQ') }}
                                                <i class="simple-icon-camera"></i>
                                            </button>
                                        @endif
                                    </div>

                                </div>

                                {{-- <div class="text-right mt-auto">
                                    <img src="{{ asset('frontend/img/mastercard.png') }}" alt="Mastercard" height="20" class="ml-1">
                                    <img src="{{ asset('frontend/img/VISA-logo.png') }}" alt="VISA" height="20" class="ml-1">
                                </div> --}}
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

      <!-- ============================= -->
<!-- ✅ Pay with CliQ Section -->
<!-- ============================= -->
{{-- <div class="row equal-height-container mt-5">
    <div class="col-12">
        <h3 class="mb-3 text-left font-weight-bold text-primary">
            {{ __('payment.pay_by_card') }}
        </h3>
    </div>

    <div class="col-md-12 col-lg-4 mb-4 col-item">
        <div class="card h-100 shadow-lg hover-shadow" id="openCliqModal"
            style="cursor: pointer; border: 2px dashed #0d6efd; transition: all 0.3s;">
            <div class="card-body pt-5 pb-5 d-flex flex-column justify-content-center align-items-center text-center">
               <img src="{{ asset('admin\assets\images\cliq.svg') }}" alt="" height="80" class="mb-3">
                <h5 class="font-weight-semibold mb-2">{{ __('payment.Pay_with_CliQ') }}</h5>
                <p class="text-muted mb-0">{{ __('payment.upload_your_payment_screenshot') }}</p>
            </div>
        </div>
    </div>
</div> --}}


        <!-- CliQ Payment Modal -->
<!-- CliQ Payment Modal -->
<!-- CliQ Payment Modal -->
<div class="modal fade" id="cliqModal" tabindex="-1" aria-labelledby="cliqModalLabel" aria-hidden="true">
    <!-- 🔔 Dynamic Alert Placeholder -->

    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow-lg">
            <form id="cliqPaymentForm" enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="cliqModalLabel">
                        <i class="simple-icon-camera mr-2"></i> {{ __('payment.provide_screenshot') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- 🔹 Obvious CliQ Text -->
<div class="text-center mb-3 p-2"
     style="font-size: 18px; font-weight: bold; color:#922c88 ; border:1px solid #922c88 ; border-radius:8px;">
    Cliq: Tolba962
</div>
    <div id="cliqAlert" style="display:none;"></div>

    <!-- 🔽 Package Selection -->
    <div class="mb-3">
        <label for="package_id" class="form-label font-weight-semibold">
            {{ __('payment.select_package') }}
        </label>
        <select name="package_id" id="package_id" class="form-control" required>
            <option value="">{{ __('payment.choose_package') }}</option>
            @foreach ($packages as $package)
                <option value="{{ $package->id }}">
                    {{ app()->getLocale() === 'ar' ? $package->package_name_ar : $package->package_name_en }}
                    — ${{ number_format($package->price, 2) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- 📸 Upload Screenshot -->
    <div class="mb-3">
        <label for="payment_screenshot" class="form-label font-weight-semibold">
            {{ __('payment.upload_label') }}
        </label>
        <input type="file" class="form-control" id="payment_screenshot" name="photo_url" accept="image/*" required>
    </div>

    <!-- ⚠️ Disclaimer -->
    <div class="alert alert-warning mt-4 mb-0" style="font-size: 14px;">
        ⚠️ <strong>{{ __('payment.note') }}</strong>
       {{ __('payment.cliq_disclaimer') }}

    </div>

    <input type="hidden" name="payment_type" value="cliq">
</div>



        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
            {{ __('payment.Cancel') }}
          </button>
          <button type="submit" class="btn btn-primary" id="submitCliqPaymentBtn">
            {{ __('payment.Submit_Payment') }}
          </button>
        </div>
      </form>
    </div>



        <!-- ============================= -->
        <!-- End Pay with CliQ Section -->
        <!-- ============================= -->

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

    // ============================
    // 1️⃣ OPEN PAYMENT NOTICE MODAL
    // ============================
    document.querySelectorAll('.open-payment-modal').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

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

    // ============================
    // 2️⃣ PROCEED TO PAYMENT
    // ============================
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
        .catch(() => alert('Something went wrong.'));
    });


    // ============================
    // 3️⃣ OPEN CLIQ MODAL FROM BUTTON INSIDE CARD
    // ============================
    document.querySelectorAll('.open-cliq-with-package').forEach(btn => {
        btn.addEventListener('click', function () {

            let packageId = this.dataset.packageId;

            // Open modal
            $('#cliqModal').modal('show');

            // Pre-select the correct package
            document.getElementById('package_id').value = packageId;
        });
    });


    // ============================
    // 4️⃣ SUBMIT CLIQ PAYMENT (AJAX)
    // ============================
    document.getElementById('cliqPaymentForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submitCliqPaymentBtn');
        const alertBox = document.getElementById('cliqAlert');

        alertBox.style.display = 'none';
        alertBox.innerHTML = '';

        submitBtn.disabled = true;
        submitBtn.innerText = '{{ __("payment.Processing") }}';

        try {
            const response = await fetch('{{ route('user.payment.cliq') }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer {{ Auth::user()->createToken("web")->plainTextToken ?? "" }}',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const data = await response.json();
            submitBtn.disabled = false;
            submitBtn.innerText = '{{ __("payment.Submit_Payment") }}';

            if (response.ok && data.success) {
                alertBox.className = 'alert alert-success alert-dismissible fade show';
                alertBox.innerHTML = `
                    <strong><i class="simple-icon-check"></i></strong> ${data.message}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                `;
                alertBox.style.display = 'block';
                form.reset();

                setTimeout(() => {
                    $('#cliqModal').modal('hide');
                }, 2000);

            } else {
                const errors = data.errors ? Object.values(data.errors).flat().join('<br>') : data.message;
                alertBox.className = 'alert alert-danger alert-dismissible fade show';
                alertBox.innerHTML = `
                    <strong><i class="simple-icon-close"></i></strong> ${errors}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                `;
                alertBox.style.display = 'block';
            }

        } catch (err) {
            submitBtn.disabled = false;
            submitBtn.innerText = '{{ __("payment.Submit_Payment") }}';
            alertBox.className = 'alert alert-danger alert-dismissible fade show';
            alertBox.innerHTML = `
                <strong><i class="simple-icon-close"></i></strong> Connection error. Please try again.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            `;
            alertBox.style.display = 'block';
        }
    });

});


// Open CliQ modal
document.getElementById('openCliqModal').addEventListener('click', function () {
    $('#cliqModal').modal('show');
});

// Handle CliQ form submission (AJAX)
document.getElementById('cliqPaymentForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = document.getElementById('submitCliqPaymentBtn');
    const alertBox = document.getElementById('cliqAlert');

    // Reset alert box
    alertBox.style.display = 'none';
    alertBox.innerHTML = '';

    submitBtn.disabled = true;
    submitBtn.innerText = '{{ __("payment.Processing") ?? "Processing..." }}';

    try {
        const response = await fetch('{{ route('user.payment.cliq') }}', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ Auth::user()->createToken("web")->plainTextToken ?? "" }}',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });

        const data = await response.json();
        submitBtn.disabled = false;
        submitBtn.innerText = '{{ __("payment.Submit_Payment") }}';

        if (response.ok && data.success) {
            // ✅ Success alert inside modal
            alertBox.className = 'alert alert-success alert-dismissible fade show';
            alertBox.innerHTML = `
                <strong><i class="simple-icon-check"></i></strong> ${data.message}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            `;
            alertBox.style.display = 'block';
            form.reset();

            // Auto-hide modal after 2.5s
            setTimeout(() => {
                $('#cliqModal').modal('hide');
                alertBox.style.display = 'none';
            }, 5000);
        } else {
            // ❌ Validation or upload error
            const errors = data.errors ? Object.values(data.errors).flat().join('<br>') : data.message;
            alertBox.className = 'alert alert-danger alert-dismissible fade show';
            alertBox.innerHTML = `
                <strong><i class="simple-icon-close"></i></strong> ${errors}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            `;
            alertBox.style.display = 'block';
        }

    } catch (err) {
        console.error(err);
        submitBtn.disabled = false;
        submitBtn.innerText = '{{ __("payment.Submit_Payment") }}';
        alertBox.className = 'alert alert-danger alert-dismissible fade show';
        alertBox.innerHTML = `
            <strong><i class="simple-icon-close"></i></strong> Connection error. Please try again.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        `;
        alertBox.style.display = 'block';
    }
});
// Open CliQ modal from inside subscription card
document.querySelectorAll('.open-cliq-with-package').forEach(btn => {
    btn.addEventListener('click', function () {

        let packageId = this.dataset.packageId;

        // Open modal
        $('#cliqModal').modal('show');

        // Pre-select the correct package
        document.getElementById('package_id').value = packageId;
    });
});

</script>
@endpush
