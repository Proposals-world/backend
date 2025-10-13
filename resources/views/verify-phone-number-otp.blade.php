@extends('frontend.layouts.app')
@section('section')
    <style>
        .icon-size {
            height: 117px;
            width: 124px;
            object-fit: contain;
            /* Keeps image aspect ratio nicely inside */
        }

        @media (max-width: 767.98px) {
            .matchmaking-form-submit {
                display: block !important;
                text-align: center;
                margin-top: 20px;
            }

            .slider-btn {
                display: block !important;
            }

            .matchmaking-form-submit .btn {
                display: inline-block !important;
                width: 100%;
                max-width: 100%;
            }
        }

        /* Card flip animation styles */
        .card-container {
            perspective: 1000px;
            max-width: 380px;
            width: 100%;
            height: 400px;
        }

        .card-flipper {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .card-flipper.flipped {
            transform: rotateY(180deg);
        }

        .card-front,
        .card-back {
            position: absolute;
            width: 117%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-back {
            transform: rotateY(180deg);
        }

        .flip-indicator {
            position: absolute;
            bottom: 15px;
            right: 15px;
            color: #6c757d;
            font-size: 12px;
            opacity: 0.7;
        }
    </style>
    <div class="slider-bg2"
        style="
    @if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
        background-position: left 0;
    @else
        background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
        background-position: right 0; @endif
    background-repeat: no-repeat;
    background-size: 65%;
    min-height: 700px;">

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card-container">
                <div class="card-flipper" id="cardFlipper">

                    {{-- Front Side: Confirmation Message --}}
                    <div class="card-front">
                    <h4 class="mb-4">{{ __('otp.Verify_Phone_number') }}</h4>
                        <div id="otp-alert-success" class="alert alert-success d-none" role="alert"></div>
                        <div id="otp-alert-error" class="alert alert-danger d-none" role="alert"></div>

                        <div class="form-group" id="guardian-contact-row">

                            <label for="phone_number" class="fw-bold text-left">{{ __('otp.Phone_number') }}</label>

                            <div class="d-flex align-items-center gap-2">
                                <div class="input-group-prepend">
                                                        <span class="input-group-text" style="height: 39px;"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                 <select name="country_code"
                                    class="form-select form-control @error('country_code') is-invalid @enderror"
                                    style="max-width:143px">
@php
    $countries = \App\Helpers\CountryHelper::getCountries();
@endphp
                                        @foreach($countries as $iso => $info)
                                            <option value="{{ $iso }}"
                                                {{ $countryCode == $iso ? 'selected' : '' }}>
                                                    {{ $info['name'] }}{{ $info['dial_code'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                <input type="text" id="phone_number" name="phone_number" class="form-control"
                                    value="{{ $localPhone }}"
                                    placeholder="{{ __('otp.Enter_Phone_number') }}" required
                                    style="flex: 1; min-width: 0; {{ app()->getLocale() === 'en' ? 'margin-right' : 'margin-left' }}: 4px;">

                                <button id="update-phone-number-btn" class="btn btn-transparent">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>

                            <small class="form-text text-muted mt-1 text-left">
                                <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                {{ __('otp.This_is_to_confirm_your_phone_number._Leave_it_as_is_if_already_correct.') }}
                            </small>
                        </div>


                        {{-- Step 1: Initial Button --}}
                        <button id="show-otp-btn" class="btn btn-primary btn-block">
                            {{ __('otp.Verify_Phone_number') }}
                        </button>
                        <div id="guardian-loading" style="display:none;" class="mt-2 text-muted small">
                            {{ __('otp.Sending_verification_code') }}...
                        </div>

                        {{-- Step 2: OTP Inputs (hidden at first) --}}
                        <div id="otp-wrapper" style="display: none;">
                            <h5 class="mt-4 mb-3">{{ __('otp.Enter_the_6_digit_Code_phone_number') }}</h5>

                            <form id="otp-form" onsubmit="return false;">
                                @csrf
                                <div class="d-flex justify-content-between mb-3">
                                    @for ($i = 0; $i < 6; $i++)
                                        <input type="text" name="otp[]" maxlength="1"
                                            class="form-control text-center otp-input mx-1"
                                            style="width: 40px; font-size: 24px;" required>
                                    @endfor
                                </div>

                                @if ($errors->has('otp'))
                                    <div class="text-danger text-center">{{ $errors->first('otp') }}</div>
                                @endif

                                {{-- Resend Code Link --}}
                                <div id="resend-text" class="text-left mt-3 mb-2" style="display: none;">
                                    <a href="#" class="text-decoration-none"
                                        style="color: #a72890; font-weight: 500;">{{ __('otp.Resend_Code') }}</a>
                                </div>

                                {{-- Submit Button --}}
                                <button type="submit" id="verify-btn"
                                    class="btn btn-primary btn-block w-100">{{ __('otp.Verify') }}</button>
                            </form>
                        </div>

                        {{-- <div class="flip-indicator">
                            <i class="fas fa-sync-alt me-1"></i>
                            {{ __('otp.Verification_form') }}
                        </div> --}}
                    </div>

                    {{-- Back Side: Original Verification Form --}}
                    {{-- <div class="card-back">

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function showSuccessMessage(message) {
            const successBox = document.getElementById('otp-alert-success');
            const errorBox = document.getElementById('otp-alert-error');

            errorBox.classList.add('d-none'); // hide error
            successBox.textContent = message;
            successBox.classList.remove('d-none');

            setTimeout(() => {
                successBox.classList.add('d-none');
                successBox.textContent = '';
            }, 5000);

            // Optional: scroll into view on mobile
            successBox.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function showErrorMessage(message) {
            const errorBox = document.getElementById('otp-alert-error');
            const successBox = document.getElementById('otp-alert-success');

            successBox.classList.add('d-none'); // hide success
            errorBox.textContent = message;
            errorBox.classList.remove('d-none');

            setTimeout(() => {
                errorBox.classList.add('d-none');
                errorBox.textContent = '';
            }, 5000);

            // Optional: scroll into view on mobile
            errorBox.scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Card flip functionality - MOVED INSIDE DOMContentLoaded
            const confirmProceedBtn = document.getElementById('confirmProceedBtn');
            // const cardFlipper = document.getElementById('cardFlipper');

            // if (confirmProceedBtn && cardFlipper) {
            //     confirmProceedBtn.addEventListener('click', function() {
            //         cardFlipper.classList.add('flipped');
            //     });
            // }

            // Update Guardian Contact functionality
            const updateGuardianBtn = document.getElementById('update-phone-number-btn');
            const guardianContactInput = document.getElementById('phone_number');
             const countryCodeSelect   = document.querySelector('select[name="country_code"]');

            if (updateGuardianBtn && guardianContactInput) {
                updateGuardianBtn.addEventListener('click', function() {
                    const contact = guardianContactInput.value.trim();
                    const country = countryCodeSelect.value;

                    if (!contact) {
                        showErrorMessage('{{ __('otp.Please_enter_phone_number') }}');
                        return;
                    }

                    updateGuardianBtn.disabled = true;
                    updateGuardianBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> `;

                    const formData = new FormData();
                    formData.append('phone_number', contact);
                    formData.append('country_code', country);
                    // formData.append('_method', 'PUT'); // Laravel method spoofing

                    // console.log(formData);
                    fetch('{{ route('user.update.phone.number') }}', {
                            method: 'post',
                            headers: {
                                'Accept': 'application/json',
                                'Accept-Language': '{{ app()->getLocale() }}',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            credentials: 'same-origin',
                            body: formData
                        })
                        .then(async response => {
                            const result = await response.json();
                            if (!response.ok) throw new Error(result.message || '{{ __('otp.update_failed_phone') }}');
                            showSuccessMessage(result.message);
                        })
                        .catch(err => {
  // Show friendly error
    showErrorMessage(err.message || '{{ __("otp.update_failed_phone") }}');                        })
                        .finally(() => {
                            updateGuardianBtn.disabled = false;
                            updateGuardianBtn.innerHTML = `<i class="fas fa-sync-alt"></i>`;
                        });
                });
            }

            // OTP functionality
            const inputs = document.querySelectorAll('.otp-input');
            const verifyBtn = document.getElementById('verify-btn');
            const resendText = document.getElementById('resend-text');
            const form = document.getElementById('otp-form');
            const otpWrapper = document.getElementById('otp-wrapper');
            const showOtpBtn = document.getElementById('show-otp-btn');
            const guardianLoading = document.getElementById('guardian-loading');
            const resendLink = resendText ? resendText.querySelector('a') : null;

            // Bootstrap modal (only if it exists)
            let confirmModal = null;
            const confirmModalElement = document.getElementById('confirmVerifyModal');
            if (confirmModalElement && typeof bootstrap !== 'undefined') {
                confirmModal = new bootstrap.Modal(confirmModalElement);

                // When "Verify" is clicked, show the modal instead of submitting
                if (verifyBtn) {
                    verifyBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        confirmModal.show();
                    });
                }

                // When they click "Confirm" in the modal → hide it & dispatch the real submit
                const confirmVerifyBtn = document.getElementById('confirmVerifyBtn');
                if (confirmVerifyBtn) {
                    confirmVerifyBtn.addEventListener('click', function() {
                        confirmModal.hide();
                        if (form) {
                            form.dispatchEvent(new Event('submit', {
                                cancelable: true
                            }));
                        }
                    });
                }
            }

            // Enable/disable verify button based on input completion
            function updateVerifyButtonState() {
                if (verifyBtn && inputs.length > 0) {
                    const allFilled = Array.from(inputs).every(input => input.value.trim().length === 1);
                    verifyBtn.disabled = !allFilled;
                }
            }

            // OTP input handling
            inputs.forEach((input, index) => {
                input.setAttribute('inputmode', 'numeric');
                input.addEventListener('input', () => {
                    input.value = input.value.replace(/[^0-9]/g, '');
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateVerifyButtonState();
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                        inputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pasteData = (e.clipboardData || window.clipboardData).getData('text')
                        .replace(/\D/g, '');
                    if (pasteData.length === inputs.length) {
                        inputs.forEach((input, idx) => input.value = pasteData[idx] || '');
                        inputs[inputs.length - 1].focus();
                    }
                    updateVerifyButtonState();
                });
            });

            // Shared function to send OTP request
            function sendVerificationRequest(button, callback) {
                const originalText = button.innerHTML;
                button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
                button.disabled = true;

                fetch('{{ route('user.send.message') }}', {
                // fetch('/user/guardian-contact/send-verification', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Accept-Language': '{{ app()->getLocale() }}',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            //  to: "962798716432",
                        })
                    })
                    .then(async response => {
                        let data = null;
                        try {
                            data = await response.json();
                        } catch {}

                        if (!response.ok) {
                            const message = data?.message ||
                                (data?.errors && Object.values(data.errors)[0][0]) ||
                                response.statusText;
                            showErrorMessage(message);
                            throw new Error(message);
                        }

                        if (data?.message) showSuccessMessage(data.message);
                        if (callback) callback();
                        return data;
                    })
                    .catch(err => {
                        showErrorMessage(err.message || '{{ __('otp.otp_invalid') }}');
                    })
                    .finally(() => {
                        button.disabled = false;
                        if (button === showOtpBtn) {
                            button.innerHTML = '{{ __('otp.Verify_Guardian_Contact') }}';
                        } else {
                            button.innerHTML = '{{ __('otp.Resend_Code') }}';
                        }
                    });
            }

            // Trigger OTP on first button
            if (showOtpBtn) {
                showOtpBtn.addEventListener('click', function() {
                    if (guardianLoading) {
                        guardianLoading.style.display = 'none';
                    }
                    sendVerificationRequest(showOtpBtn, () => {
                        const guardianContactRow = document.getElementById('guardian-contact-row');
                        if (guardianContactRow) {
                            guardianContactRow.style.display = 'none';
                        }

                        showOtpBtn.style.display = 'none';
                        if (otpWrapper) {
                            otpWrapper.style.display = 'block';
                        }
                        if (resendText) {
                            resendText.style.display = 'block';
                        }
                    });
                });
            }

            // Resend Code logic with timer
            if (resendLink) {
                resendLink.addEventListener('click', function(e) {
                    e.preventDefault();

                    resendLink.style.pointerEvents = 'none';
                    resendLink.style.opacity = '0.6';
                    const originalText = '{{ __('otp.Resend_Code') }}';
                    let seconds = 60;

                    sendVerificationRequest(resendLink, () => {
                        const timer = setInterval(() => {
                            resendLink.innerHTML = originalText +
                                ' <span class="text-muted">(' + (seconds--) + ' ' +
                                '{{ __('otp.seconds') }}' + ')</span>';
                            if (seconds < 0) {
                                clearInterval(timer);
                                resendLink.innerHTML = originalText;
                                resendLink.style.pointerEvents = '';
                                resendLink.style.opacity = '1';
                            }
                        }, 1000);
                    });
                });
            }

            // Submit OTP
            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const code = Array.from(inputs).map(i => i.value.trim()).join('');
                    if (code.length !== 6) {
                        showErrorMessage('Please fill in all 6 digits of the OTP.');
                        return;
                    }

                    if (verifyBtn) {
                        verifyBtn.disabled = true;
                        verifyBtn.innerHTML =
                            `<span class="spinner-border spinner-border-sm"></span>  {{ __('otp.Verifying') }}`;
                    }

                    try {
                        const response = await fetch('{{ route('user.verify') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Accept-Language': '{{ app()->getLocale() }}',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                code
                            })
                        });

                        let result = null;
                        try {
                            result = await response.json();
                        } catch {}

                        if (!response.ok) {
                            const message = result?.message ||
                                (result?.errors && Object.values(result.errors)[0][0]) ||
                                response.statusText;
                            throw new Error(message);
                        }

                        showSuccessMessage(result.message || '{{ __('otp.otp_verified') }}');
                        setTimeout(() => window.location.href = '/user/dashboard', 2000);
                    } catch (err) {
                        showErrorMessage(err.message || '{{ __('otp.otp_invalid') }}');
                    } finally {
                        if (verifyBtn) {
                            verifyBtn.disabled = false;
                            verifyBtn.innerHTML = '{{ __('otp.Verify') }}';
                        }
                    }
                });
            }

            updateVerifyButtonState(); // initial state
        });
    </script>
@endpush
