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

            <h4 class="mb-4 text-danger">{{ __('Delete Account') }}</h4>
            <p class="text-left text-danger">
                {{ __('Once you delete your account, all of your data will be permanently removed. This action cannot be undone.') }}
            </p>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->has('current_password'))
                <div class="alert alert-danger">{{ $errors->first('current_password') }}</div>
            @endif

            <form method="POST" action="{{ route('account.delete') }}">
                @csrf
                @method('DELETE')

                <div class="form-group text-left mb-4">
                    <label for="current_password">{{ __('Confirm with Password') }}</label>
                    <input id="current_password" type="password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           name="current_password" required>
                </div>

                <button type="submit"
                        class="btn btn-danger btn-block matchmaking-form-submit">
                    {{ __('Delete My Account') }}
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
