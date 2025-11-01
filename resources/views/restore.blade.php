@extends('frontend.layouts.app')

@section('section')
<style>
    @media (max-width: 767.98px) {
        .matchmaking-form-submit {
            display: block !important;
            text-align: center;
            margin-top: 20px;
        }
        .matchmaking-form-submit .btn {
            display: inline-block !important;
            width: 100%;
            max-width: 100%;
        }
    }
</style>

<div class="slider-bg2" style="
    @if (app()->getLocale() === 'ar')
        background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
        background-position: left 0;
    @else
        background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
        background-position: right 0;
    @endif
    background-repeat: no-repeat;
    background-size: 65%;
    min-height: 700px;
">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4 text-center" style="max-width: 400px; width: 100%;">

            <h4 class="mb-4">{{ __('auth.restore_account') }}</h4>

            <div id="status-message" class="alert d-none"></div>

            <form id="restore-account-form" method="POST">
                @csrf

                <div class="form-group mb-3 text-left">
                    <label for="email">{{ __('auth.email') }}</label>
                    <input type="email" id="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="form-group mb-4 text-left">
                    <label for="password">{{ __('auth.password_restore') }}</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block matchmaking-form-submit">
                    {{ __('auth.restore_now') }}
                </button>
            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {

    $('#restore-account-form').on('submit', function(e) {
        e.preventDefault();

        let email = $('#email').val();
        let password = $('#password').val();
        let locale = $('html').attr('lang') || '{{ app()->getLocale() }}';

        $.ajax({
            url: "{{ route('users.restore') }}",
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                email: email,
                password: password
            }),
            headers: {
                'Accept': 'application/json',
                'Accept-Language': locale
            },
            beforeSend: function() {
                $('#status-message').removeClass('alert-success alert-danger')
                                    .addClass('alert-info')
                                    .text('{{ __("auth.restoring_account") }}')
                                    .removeClass('d-none');
            },
            success: function(response) {
                $('#status-message').removeClass('alert-info alert-danger')
                                    .addClass('alert-success')
                                    .text(response.message)
                                    .removeClass('d-none');

                setTimeout(function() {
                    window.location.href = "{{ route('login') }}";
                }, 1200);
            },
            error: function(xhr) {
                let message = xhr.responseJSON?.message || '{{ __("auth.restore_failed") }}';

                $('#status-message').removeClass('alert-info alert-success')
                                    .addClass('alert-danger')
                                    .text(message)
                                    .removeClass('d-none');
            }
        });
    });
});
</script>
@endpush
@endsection
