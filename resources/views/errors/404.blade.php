@extends('errors.layout')

@section('title', __('errors.Page Not Found'))

@section('content')

<style>
    .error-wrapper {
        text-align: center;
        animation: fadeIn 0.5s ease-in-out;
    }

    .error-icon-circle {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ff8bb0, #be008a);
        box-shadow: 0 6px 22px rgba(190, 0, 138, 0.25);
        animation: popIn .35s ease-out;
    }

    .error-icon-circle svg {
        width: 70px;
        height: 70px;
    }

    .error-title {
        font-size: 30px;
        font-weight: 800;
        margin-top: 25px;
        color: #333;
    }

    .error-desc {
        margin-top: 10px;
        font-size: 16px;
        color: #777;
        line-height: 1.6;
    }

    .btn-tolba {
        margin-top: 25px;
        padding: 12px 35px;
        border-radius: 30px;
        background: linear-gradient(135deg, #a00064, #d0008a);
        color: #fff !important;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(160, 0, 100, 0.25);
        transition: .2s ease-in-out;
    }

    .btn-tolba:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 0, 100, 0.35);
    }

    @keyframes popIn {
        0% { transform: scale(.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="error-wrapper">

    <!-- 🌟 BUILT-IN SVG ICON HERE -->
    <div class="error-icon-circle">
        <svg fill="#fff" viewBox="0 0 24 24">
            <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10
            10 10 10-4.486 10-10S17.514 2 12 2zm0
            18c-4.411 0-8-3.589-8-8s3.589-8
            8-8 8 3.589 8 8-3.589 8-8 8zm1-13h-2v6h2V7zm0
            8h-2v2h2v-2z"/>
        </svg>
    </div>

    <div class="error-title">
        {{ __('errors.Page Not Found') }}
    </div>

    <div class="error-desc">
        {{ __('errors.The page you are looking for could not be found.') }}
    </div>

    <a href="{{ url()->previous() }}" class="btn-tolba">
        {{ __('errors.Back') }}
    </a>
</div>

@endsection
