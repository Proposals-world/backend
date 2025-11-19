@extends('user.layouts.app')

@section('content')
<style>
    .icon-size {
        height: 117px;
        width: 124px;
        object-fit: contain;
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
</style>


    <div class="container d-flex justify-content-center align-items-start py-5">
    <div class="card shadow p-4 text-center" style="max-width: 400px; width: 100%;">


            <h4 class="mb-4">{{ __('auth.reset_password') }}</h4>

            <!-- Success and error message containers -->
            <div id="status-message" class="alert d-none"></div>

            <form id="change-password-form" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3 text-left">
                    <label for="current_password">{{ __('auth.current_password') }}</label>
                    <input id="current_password" type="password"
                        class="form-control"
                        name="current_password" required autofocus>
                </div>

                <div class="form-group mb-3 text-left">
                    <label for="password">{{ __('auth.new_password') }}</label>
                    <input id="password" type="password"
                        class="form-control"
                        name="password" required>
                </div>

                <div class="form-group mb-4 text-left">
                    <label for="password_confirmation">{{ __('auth.confirm_new_password') }}</label>
                    <input id="password_confirmation" type="password"
                        class="form-control"
                        name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block matchmaking-form-submit">
                    {{ __('auth.save_new_password') }}
                </button>
            </form>

        </div>
    </div>

<!-- Include jQuery -->
@push('scripts')
<script>
$(document).ready(function() {
    $('#change-password-form').on('submit', function(e) {
        e.preventDefault();

        // Get form values
        let currentPassword = $('#current_password').val();
        let newPassword = $('#password').val();
        let passwordConfirmation = $('#password_confirmation').val();

        // Get the locale from the HTML tag or app locale
        let locale = $('html').attr('lang') || '{{ app()->getLocale() }}';

        $.ajax({
            url: "{{ route('password.change.update') }}",
            type: 'PUT',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                current_password: currentPassword,
                password: newPassword,
                password_confirmation: passwordConfirmation
            }),
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ auth()->user()->createToken("API Token")->plainTextToken }}',
                'Accept-Language': locale
            },
            beforeSend: function() {
                $('#status-message').removeClass('alert-success alert-danger').addClass('alert-info').text('{{ __("auth.changing_password") }}').removeClass('d-none');
            },
            success: function(response) {
                    $('#status-message').removeClass('alert-info alert-danger').addClass('alert-success').text(response.message).removeClass('d-none');
                    setTimeout(function() {
                        window.location.href = "{{ route('user.dashboard') }}";
                    }, 1000); // 1-second delay to show success message

                 $('#change-password-form')[0].reset();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let message = xhr.responseJSON?.message || '';

                let errorText = message;
                $.each(errors, function(key, value) {
                    errorText += '\n' + value.join('\n');
                });

                $('#status-message').removeClass('alert-info alert-success').addClass('alert-danger').text(errorText).removeClass('d-none');
            }
        });
    });
});
</script>
@endpush
@endsection
