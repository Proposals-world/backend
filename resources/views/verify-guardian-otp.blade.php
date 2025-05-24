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
        <div id="otp-alert-success" class="alert alert-success d-none" role="alert"></div>
        <div id="otp-alert-error" class="alert alert-danger d-none" role="alert"></div>
        <div class="form-group" id="guardian-contact-row">
            <label for="guardian_contact" class="fw-bold text-left">{{ __('otp.Guardian_Contact') }}</label>

            <div class="d-flex align-items-center gap-2">
                <input type="text" id="guardian_contact" name="guardian_contact"
                    class="form-control" value="{{ auth()->user()->profile->guardian_contact_encrypted ?? '' }}" placeholder="{{ __('otp.Enter_guardian_number') }}" required
                    style="flex: 1; min-width: 0; {{ app()->getLocale() === 'en' ? 'margin-right' : 'margin-left' }}: 9px;">

                <button id="update-guardian-btn" class="btn btn-transparent">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>


            <small class="form-text text-muted mt-1 text-left">
                <i class="fas fa-exclamation-circle text-warning me-2"></i>

                {{ __('otp.This_is_to_confirm_your_guardian_contact._Leave_it_as_is_if_already_correct.') }}
            </small>
        </div>


        {{-- Step 1: Initial Button --}}
        <button id="show-otp-btn" class="btn btn-primary btn-block">
            {{ __('otp.Verify_Guardian_Contact') }}
        </button>
        <div id="guardian-loading" style="display:none;" class="mt-2 text-muted small">
            {{ __('otp.Sending_verification_code') }}...
        </div>


        {{-- Step 2: OTP Inputs (hidden at first) --}}
        <div id="otp-wrapper" style="display: none;">

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
<div class="modal fade" id="confirmVerifyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('otp.Confirm_Action') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        This will take your mother’s approval to share her number on this website.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          {{ __('Cancel') }}
        </button>
        <button type="button" class="btn btn-primary" id="confirmVerifyBtn">
          {{ __('Confirm') }}
        </button>
      </div>
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
    successBox.scrollIntoView({ behavior: 'smooth' });
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
    errorBox.scrollIntoView({ behavior: 'smooth' });

}
    const updateGuardianBtn = document.getElementById('update-guardian-btn');
const guardianContactInput = document.getElementById('guardian_contact');

updateGuardianBtn.addEventListener('click', function () {
    const contact = guardianContactInput.value.trim();

    if (!contact) {
        showErrorMessage('{{ __("otp.Please_enter_guardian_contact") }}');
        return;
    }

    updateGuardianBtn.disabled = true;
    updateGuardianBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> `;

    const formData = new FormData();
    formData.append('guardian_contact', contact);

    fetch('guardian-contact/update-guardian-contact', {
        method: 'POST',
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
        if (!response.ok) throw new Error(result.message || '{{ __("otp.update_failed") }}');
        showSuccessMessage(result.message);
    })
    .catch(err => {
        showErrorMessage(err.message || '{{ __("otp.update_failed") }}');
    })
    .finally(() => {
        updateGuardianBtn.disabled = false;
        updateGuardianBtn.innerHTML= `<i class="fas fa-sync-alt"></i>`;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-input');
    const verifyBtn = document.getElementById('verify-btn');
    const resendText = document.getElementById('resend-text');
    const form = document.getElementById('otp-form');
    const otpWrapper = document.getElementById('otp-wrapper');
    const showOtpBtn = document.getElementById('show-otp-btn');
    const guardianLoading = document.getElementById('guardian-loading');
    const resendLink = resendText.querySelector('a');
 // 1) Create the Bootstrap 5 modal instance
  const confirmModal = new bootstrap.Modal(
    document.getElementById('confirmVerifyModal')
  );

  // 2) When “Verify” is clicked, show the modal instead of submitting
  verifyBtn.addEventListener('click', function(e) {
    e.preventDefault();
    confirmModal.show();
  });

  // 3) When they click “Confirm” in the modal → hide it & dispatch the real submit
  document.getElementById('confirmVerifyBtn')
    .addEventListener('click', function() {
      confirmModal.hide();
      form.dispatchEvent(new Event('submit', { cancelable: true }));
    });

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
      'Accept': 'application/json',
      'Accept-Language': '{{ app()->getLocale() }}',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    credentials: 'same-origin',
    body: JSON.stringify({})
  })
  .then(async response => {
    // try to parse JSON (might fail if non-JSON)
    let data = null;
    try { data = await response.json(); } catch {}

    if (!response.ok) {
      // pick the best error message
      const message = data?.message
        || (data?.errors && Object.values(data.errors)[0][0])
        || response.statusText;
      showErrorMessage(message);
      throw new Error(message);
    }

    // success
    if (data?.message) showSuccessMessage(data.message);
    if (callback) callback();
    return data;
  })
  .catch(err => {
    // err.message is already shown above, but in case fetch itself failed:
    showErrorMessage(err.message || '{{ __("otp.otp_invalid") }}');
  })
  .finally(() => {
    button.disabled = false;
    button.innerHTML = `{{ __('otp.Resend_Code') }}`;
  });
}



    // Trigger OTP on first button
    showOtpBtn.addEventListener('click', function () {
        guardianLoading.style.display = 'none';
        sendVerificationRequest(showOtpBtn, () => {
            document.getElementById('guardian-contact-row').style.display = 'none'; // Hides input + refresh button

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
    form.addEventListener('submit', async function(e) {
  e.preventDefault();

  const code = Array.from(inputs).map(i => i.value.trim()).join('');
  if (code.length !== 6) {
    showErrorMessage('Please fill in all 6 digits of the OTP.');
    return;
  }

  verifyBtn.disabled = true;
  verifyBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span>  {{ __('otp.Verifying') }}`;

  try {
    const response = await fetch('/user/guardian-contact/verify-code', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Accept-Language': '{{ app()->getLocale() }}',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      credentials: 'same-origin',
      body: JSON.stringify({ code })
    });

    let result = null;
    try { result = await response.json(); } catch {}

    if (!response.ok) {
      const message = result?.message
        || (result?.errors && Object.values(result.errors)[0][0])
        || response.statusText;
      throw new Error(message);
    }

    showSuccessMessage(result.message || '{{ __("otp.otp_verified") }}');
    setTimeout(() => window.location.href = '/user/dashboard', 2000);
  } catch (err) {
    showErrorMessage(err.message || '{{ __("otp.otp_invalid") }}');
  } finally {
    verifyBtn.disabled = false;
    verifyBtn.innerHTML = `{{ __('otp.Verify') }}`;
  }
});


    updateVerifyButtonState(); // initial state




});


</script>
@endpush
