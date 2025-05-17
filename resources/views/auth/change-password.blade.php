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

            <h4 class="mb-4">{{ __('Change Password') }}</h4>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.change.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3 text-left">
                    <label for="current_password">{{ __('Current Password') }}</label>
                    <input id="current_password" type="password"
                        class="form-control @error('current_password') is-invalid @enderror"
                        name="current_password" required autofocus>
                    @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3 text-left">
                    <label for="password">{{ __('New Password') }}</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4 text-left">
                    <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                    <input id="password_confirmation" type="password"
                        class="form-control"
                        name="password_confirmation" required>
                </div>

                <button type="submit"
                    class="btn btn-primary btn-block matchmaking-form-submit">
                    {{ __('Save New Password') }}
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
