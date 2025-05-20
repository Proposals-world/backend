@extends('frontend.layouts.app')
@section('section')
<style>
    .row {
        align-items: unset;
    }

    .about-us-section {
        font-size: 18px;
        line-height: 1.8;
        color: #333;
    }

    .about-us-section .about-item {
        margin-bottom: 20px;
        position: relative;
        padding-left: 25px;
    }

    .about-us-section .about-item::before {
        content: "–";
        position: absolute;
        left: 0;
        color: #6c63ff;
        font-weight: bold;
    }

    .highlight {
        background-color: #e8a5d3;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 500;
        color: #fff;
    }

    .about-center-text {
        text-align: center;
        font-weight: 600;
        margin-top: 30px;
    }

</style>
@if (app()->getLocale() === 'ar')
<style>
    .about-us-section {
        text-align: right;
        direction: rtl;
    }
    .about-us-section .about-item {
        padding-right: 25px;
    }
    .about-us-section .about-item::before {
        right: 0;
    }
</style>
@else
<style>
    .about-us-section {
        text-align: left;
        direction: ltr;
    }
    .about-us-section .about-item {
        padding-left: 25px;
    }
    .about-us-section .about-item::before {
        left: 0;
    }
</style>
@endif

<div>
    <section class="breadcrumb-area d-flex align-items-center"
    style="
    @if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }}); background-position: left 0;
    @else background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }}); background-position: right 0; @endif
    background-repeat: no-repeat;
    background-size: cover;
">
        <div class="container">
            <div class="row">
                <div class="@if(app()->getLocale() === 'ar') col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 text-center mx-auto @else col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 text-center @endif">
                    <div class="breadcrumb-wrap text-center" >
                        <div class="breadcrumb-title mt-60 mb-30">
                            <h2>{{ __('home.about-us') }}</h2>
                        </div>
                            {{-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('home.home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ __('home.about-us') }}</li>
                                </ol>
                            </nav> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="inner-blog b-details-p pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 about-us-section">

                    <h3 class="mb-4 fw-bold text-dark">{{ __('home.proposals') }}</h3>

                    @if (app()->getLocale() === 'ar')
                        <div class="about-item">أول منصة وتطبيق إلكتروني للزواج التقليدي في الأردن</div>
                    @endif
                    <div class="about-item">{{ __('home.proposals-paragraph-1') }}</div>

                    <div class="about-item">{{ __('home.proposals-paragraph-2') }}</div>

                    <div class="about-item">{{ __('home.proposals-paragraph-3') }}</div>

                    <div class="about-center-text">{{ __('home.proposals-line-1') }}</div>

                    <div class="about-center-text">{{ __('home.proposals-line-2') }}</div>

                    <hr class="my-5">

                    <h3 class="mb-4 fw-bold text-dark">{{ __('home.why-proposals') }}</h3>

                    <div class="about-item">{{ __('home.why-paragraph-1') }}</div>

                    <div class="about-item">
                        {{ __('home.why-paragraph-2') }}
                        {{-- <span class="highlight">{{ __('home.origin') }}</span>,
                        <span class="highlight">{{ __('home.education') }}</span>,
                        <span class="highlight">{{ __('home.social-level') }}</span>,
                        <span class="highlight">{{ __('home.work') }}</span>,
                        <span class="highlight">{{ __('home.values') }}</span>,
                        <span class="highlight">{{ __('home.financial') }}</span>,
                        <span class="highlight">{{ __('home.hobbies') }}</span>. --}}
                    </div>

                    <div class="about-item">{{ __('home.why-paragraph-3') }}</div>

                    <div class="about-item">{{ __('home.why-paragraph-4') }}</div>

                    <div class="about-item">{{ __('home.why-paragraph-5') }}</div>

                    <div class="about-item">{{ __('home.why-paragraph-6') }}</div>

                    <div class="about-item">{{ __('home.why-paragraph-7') }}</div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
