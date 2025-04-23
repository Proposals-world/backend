@extends('frontend.layouts.app')
@section('section')
<style>
    .icon-size {
    height: 117px;
    width: 124px;
    object-fit: contain; /* Keeps image aspect ratio nicely inside */
}@media (max-width: 767.98px) {
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


</style>
    <div class="slider-bg2" style="
    @if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
        background-position: left 0;
    @else
        background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
        background-position: right 0; @endif
    background-repeat: no-repeat;
    background-size: 65%;
    min-height: 700px;">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4 text-center" style="max-width: 400px; width: 100%;">
        {{-- Title --}}
        <h4 class="mb-4">{{ __('otp.Verify_Guardian_Contact') }}</h4>

        {{-- Step 1: Initial Button --}}
        <button id="show-otp-btn" class="btn btn-primary btn-block">
            {{ __('otp.Verify_Guardian_Contact') }}
        </button>
        <div id="guardian-loading" style="display:none;" class="mt-2 text-muted small">
            {{ __('otp.Sending_verification_code') }}...
        </div>


        {{-- Step 2: OTP Inputs (hidden at first) --}}
        <div id="otp-wrapper" style="display: none;">
            <div id="otp-alert-success" class="alert alert-success d-none" role="alert"></div>
            <div id="otp-alert-error" class="alert alert-danger d-none" role="alert"></div>

            <h5 class="mt-4 mb-3">{{ __('otp.Enter_the_6-digit_Code') }}</h5>

            <form id="otp-form" onsubmit="return false;">
                @csrf
                <div class="d-flex justify-content-between mb-3">
                    @for($i = 0; $i < 6; $i++)
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
                    <a href="#" class="text-decoration-none" style="color: #a72890; font-weight: 500;">{{ __('otp.Resend_Code') }}</a>
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="verify-btn" class="btn btn-primary btn-block w-100">{{ __('otp.Verify') }}</button>
            </form>
        </div>
    </div>
</div>



    </div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-input');
    const verifyBtn = document.getElementById('verify-btn');
    const resendText = document.getElementById('resend-text');
    const form = document.getElementById('otp-form');
    const otpWrapper = document.getElementById('otp-wrapper');
    const showOtpBtn = document.getElementById('show-otp-btn');
    const guardianLoading = document.getElementById('guardian-loading');
    const resendLink = resendText.querySelector('a');

    // Enable/disable verify button based on input completion
    function updateVerifyButtonState() {
        const allFilled = Array.from(inputs).every(input => input.value.trim().length === 1);
        verifyBtn.disabled = !allFilled;
    }

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
            const pasteData = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            if (pasteData.length === inputs.length) {
                inputs.forEach((input, idx) => input.value = pasteData[idx] || '');
                inputs[inputs.length - 1].focus();
            }
            updateVerifyButtonState();
        });
    });

    // Shared function to send OTP request
    function sendVerificationRequest(button, callback) {
        button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
        button.disabled = true;

        fetch('/user/guardian-contact/send-verification', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept-Language': '{{ app()->getLocale() }}',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            if (data.message) {
                if (callback) callback();
            } else {
                showSuccessMessage(data.message || '{{ __("otp.otp_verified") }}');
                button.disabled = false;
                button.innerHTML = `{{ __('otp.Resend_Code') }}`;
            }
        })
        .catch(err => {
            showErrorMessage(err.message || '{{ __("otp.otp_invalid") }}');
            button.disabled = false;
            button.innerHTML =  `{{ __('otp.Resend_Code') }}`;
        });
    }

    // Trigger OTP on first button
    showOtpBtn.addEventListener('click', function () {
        guardianLoading.style.display = 'none';
        sendVerificationRequest(showOtpBtn, () => {
            showOtpBtn.style.display = 'none';
            otpWrapper.style.display = 'block';
            resendText.style.display = 'block';
        });
    });

    // Resend Code logic with timer
    resendLink.addEventListener('click', function (e) {
        e.preventDefault();

        resendLink.style.pointerEvents = 'none';
        resendLink.style.opacity = '0.6';
        const originalText =  `{{ __('otp.Resend_Code') }}`;
        let seconds = 60;

        sendVerificationRequest(resendLink, () => {
            const timer = setInterval(() => {
                resendLink.innerHTML = originalText + ' <span class="text-muted">(' + (seconds--) + ' ' + `{{ __('otp.seconds') }}` + ')</span>';
                if (seconds < 0) {
                    clearInterval(timer);
                    resendLink.innerHTML = originalText;
                    resendLink.style.pointerEvents = '';
                    resendLink.style.opacity = '1';
                }
            }, 1000);
        });
    });

    // Submit OTP
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const code = Array.from(inputs).map(input => input.value.trim()).join('');
        if (code.length !== 6) {
            alert('Please fill in all 6 digits of the OTP.');
            return;
        }

        verifyBtn.disabled = true;
        verifyBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span>  {{ __('otp.Verifying') }}`;

        fetch('/user/guardian-contact/verify-code', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept-Language': '{{ app()->getLocale() }}',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        })
        .then(res => res.json())
        .then(data => {
            showSuccessMessage(data.message || '{{ __("otp.otp_verified") }}');
            // Optional: redirect here
            // window.location.href = '/dashboard';
        })
        .catch(err => {
            showErrorMessage(err.message || '{{ __("otp.otp_invalid") }}');
        })
        .finally(() => {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = `{{ __('otp.Verify') }}`;
        });
    });

    updateVerifyButtonState(); // initial state
    function showSuccessMessage(message) {
    const successBox = document.getElementById('otp-alert-success');
    const errorBox = document.getElementById('otp-alert-error');

    errorBox.classList.add('d-none');
    successBox.textContent = message;
    successBox.classList.remove('d-none');

    // Optional auto-hide after 5s
    setTimeout(() => {
        successBox.classList.add('d-none');
        successBox.textContent = '';
    }, 5000);
}

function showErrorMessage(message) {
    const errorBox = document.getElementById('otp-alert-error');
    const successBox = document.getElementById('otp-alert-success');

    successBox.classList.add('d-none');
    errorBox.textContent = message;
    errorBox.classList.remove('d-none');

    // Optional auto-hide after 5s
    setTimeout(() => {
        errorBox.classList.add('d-none');
        errorBox.textContent = '';
    }, 5000);
}



});


</script>
@endpush
