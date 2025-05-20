@extends('frontend.layouts.app')

@section('section')
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

            <h4 class="mb-4 text-danger">{{ __('auth.delete_account') }}</h4>
            <p class="text-left text-danger">
                {{ __('auth.delete_confirm') }}
            </p>

            <!-- Success and error message containers -->
            <div id="status-message" class="alert d-none"></div>

            <form id="delete-account-form" method="POST">
                @csrf

                <div class="form-group text-left mb-4">
                    <label for="current_password">{{ __('auth.confirm_with_password') }}</label>
                    <input id="current_password" type="password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           name="current_password" required>
                </div>

                <button type="submit" class="btn btn-danger btn-block matchmaking-form-submit">
                    {{ __('auth.delete_my_account') }}
                </button>
            </form>

        </div>
    </div>
</div>

<!-- Include jQuery -->
@push('scripts')
<script>
$(document).ready(function() {
    $('#delete-account-form').on('submit', function(e) {
        e.preventDefault();

        let password = $('#current_password').val();
        let token = '{{ csrf_token() }}';

        $.ajax({
            url: "{{ route('account.delete') }}", // API endpoint
            type: 'DELETE',
            dataType: 'json',
            data: {
                current_password: password,
                _token: token
            },
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ auth()->user()->createToken("API Token")->plainTextToken }}'
            },
            beforeSend: function() {
                $('#status-message').removeClass('d-none alert-success alert-danger').addClass('alert-info').text('{{ __("auth.deleting") }}');
            },
            success: function(response) {
                $('#status-message').removeClass('alert-info alert-danger').addClass('alert-success').text(response.message).removeClass('d-none');
                setTimeout(function() {
                    window.location.href = '/'; // Redirect after successful deletion
                }, 1500);
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON?.message || '{{ __("An error occurred while deleting the account.") }}';
                $('#status-message').removeClass('alert-info alert-success').addClass('alert-danger').text(errorMessage).removeClass('d-none');
            }
        });
    });
});
</script>
@endpush
@endsection