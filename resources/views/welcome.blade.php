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
.contact-direction {
    display: flex;
    flex-wrap: wrap;
}

html[dir="rtl"] .contact-direction {
    flex-direction: row-reverse;
}

</style>
    <div style="
    @if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
        background-position: left 0;
        background-size: 70%;
    @else
        background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
        background-position: right 0;
        background-size: 65%;
    @endif
    background-repeat: no-repeat;
    ">
        <!-- slider-area -->
        <section id="parallax" class="slider-area slider-bg2 second-slider-bg d-flex fix"
            >

            <div class="slider-shape ss-one layer" data-depth="0.10">
                <img src="{{ asset('frontend/img/shape/header-sape.png') }}" alt="shape">
            </div>

            <div class="slider-shape ss-eight layer" data-depth="0.50"></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="slider-content second-slider-content left-center">
                            <h2 data-animation="fadeInUp" data-delay=".4s">
                                {{ __('home.slider_title') }}
                            </h2>
                            <p data-animation="fadeInUp" data-delay=".6s">
                                {{ __('home.slider_subtitle') }}
                            </p>
                            <div class="slider-btn mt-30 mb-30">
                                <a  href="{{ route('register') }}" class="btn ss-btn" data-animation="fadeInUp" data-delay=".8s">
                                    {{ __('home.call_to_action') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        {{-- <div class="matchmaking-form-wrapper">
                            <form class="matchmaking-form">
                                <div class="matchmaking-form-group">
                                    <div class="matchmaking-form-label">{{ __('home.gender_label') }}</div>
                                    <div class="matchmaking-form-options">
                                        <div class="matchmaking-radio-wrapper">
                                            <input type="radio" id="gender-male" name="gender"
                                                class="matchmaking-radio-input" value="man">
                                            <label for="gender-male" class="matchmaking-radio-label">{{ __('home.man') }}</label>
                                        </div>
                                        <div class="matchmaking-radio-wrapper">
                                            <input type="radio" id="gender-female" name="gender"
                                                class="matchmaking-radio-input" value="woman">
                                            <label for="gender-female" class="matchmaking-radio-label">{{ __('home.woman') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Seeking Selection -->
                                <div class="matchmaking-form-group">
                                    <div class="matchmaking-form-label">{{ __('home.seeking_label') }}</div>
                                    <div class="matchmaking-form-options">
                                        <div class="matchmaking-radio-wrapper">
                                            <input type="radio" id="seeking-man" name="seeking"
                                                class="matchmaking-radio-input" value="man">
                                            <label for="seeking-man" class="matchmaking-radio-label">{{ __('home.man') }}</label>
                                        </div>
                                        <div class="matchmaking-radio-wrapper">
                                            <input type="radio" id="seeking-woman" name="seeking"
                                                class="matchmaking-radio-input" value="woman">
                                            <label for="seeking-woman" class="matchmaking-radio-label">{{ __('home.woman') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Age Selection -->
                                <div class="matchmaking-form-group">
                                    <div class="matchmaking-form-label">{{ __('home.age_label') }}</div>
                                    <div class="matchmaking-age-range">
                                        <div class="matchmaking-select-wrapper">
                                            <select class="matchmaking-select-input">
                                                <option value="">18</option>
                                                <option value="">20</option>
                                                <option value="">24</option>
                                            </select>
                                        </div>
                                        <span class="matchmaking-age-separator">-</span>
                                        <div class="matchmaking-select-wrapper">
                                            <select class="matchmaking-select-input">
                                                <option value="">30</option>
                                                <option value="">35</option>
                                                <option value="">40</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Country Selection -->
                                <div class="matchmaking-form-group">
                                    <div class="matchmaking-form-label">{{ __('home.country_label') }}</div>
                                    <div id="country-select" class="matchmaking-select-wrapper">
                                        <select class="matchmaking-select-input">
                                            <option>{{ __('home.select_country') }}</option>
                                            <option value="">India</option>
                                            <option value="">Japan</option>
                                            <option value="">England</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="matchmaking-form-submit">
                                    <a href="{{ route('register') }}" class="btn ss-btn">
                                        {{ __('home.join_now') }}
                                    </a>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- features-area (Our Features) -->
        <section id="features" class="services-area services-bg pt-25 pb-20"
            style="background-image: url({{ asset('frontend/img/shape/header-sape2.png') }}); background-position: right top; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-10">
                        <div class="section-title text-center pl-40 pr-40 mb-45">
                            <h2>{{ __('home.features_title') }}</h2>
                            <p>{{ __('home.features_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Feature 1 -->
                    <div class="col-lg-3 col-md-12 mb-30">
                        <div class="s-single-services text-center">
                            <div class="services-icon">
                                <img src="{{ asset('frontend/img/icon/Smart Matchmaking.png') }}" alt="icon" class="icon-size">
                            </div>
                            <div class="second-services-content">
                                <h5>{{ __('home.feature_1') }}</h5>
                                <p>{{ __('home.feature_1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="col-lg-3 col-md-12 mb-30">
                        <div class="s-single-services text-center">
                            <div class="services-icon">
                                <img src="{{ asset('frontend/img/icon/secure-search.png') }}" alt="icon" class="icon-size">
                            </div>
                            <div class="second-services-content">
                                <h5>{{ __('home.feature_2') }}</h5>
                                <p>{{ __('home.feature_2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="col-lg-3 col-md-12 mb-30">
                        <div class="s-single-services text-center">
                            <div class="services-icon">
                                <img src="{{ asset('frontend/img/icon/Respects your time.png') }}" alt="icon" class="icon-size">
                            </div>
                            <div class="second-services-content">
                                <h5>{{ __('home.feature_3') }}</h5>
                                <p>{{ __('home.feature_3_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div class="col-lg-3 col-md-12 mb-30">
                        <div class="s-single-services text-center">
                            <div class="services-icon">
                                <img src="{{ asset('frontend/img/icon/Aligned with Values.png') }}" alt="icon" class="icon-size">
                            </div>
                            <div class="second-services-content">
                                <h5>{{ __('home.feature_4') }}</h5>
                                <p>{{ __('home.feature_4_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- features-area-end -->

        <!-- choose-area (Find Your Ideal Match) -->
        <section class="choose-area pt-100 pb-60 p-relative"
            style="direction: ltr; background-image: url({{ asset('frontend/img/shape/header-sape3.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="chosse-img" style="background-image: url({{ asset('frontend/img/bg/easy-m-bg.png') }})"></div>

            <div class="container">
                <div class="row">
                    <div class="col-xl-5"></div>
                    <div class="col-xl-7">
                        <div class="choose-wrap">
                            <div class="section-title w-title left-align mb-25">
                                <h2>{{ __('home.choose_title') }}</h2>
                            </div>
                            <div class="choose-content">
                                <p>{{ __('home.choose_desc_1') }}</p>
                                <p>{{ __('home.choose_desc_2') }}</p>
                                <div class="choose-btn mt-30">
                                    <a href="#" class="btn">
                                        <span class="icon">
                                            <img src="{{ asset('frontend/img/icon/apple-icon.png') }}" alt="apple-icon">
                                        </span>
                                        <span class="text"> {{ __('home.app_store') }} <strong>APP STORE</strong></span>
                                    </a>
                                    <a href="#" class="g-btn">
                                        <span class="icon">
                                            <img src="{{ asset('frontend/img/icon/g-play-icon.png') }}"
                                                alt="g-play-icon">
                                        </span>
                                        <span class="text"> {{ __('home.google_play') }} <strong>GOOGLE
                                                PLAY</strong></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="screen" class="screen-area services-bg services-two pt-100 pb-70"
            style="background-image: url({{ asset('frontend/img/shape/header-sape4.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="section-title text-center pl-40 pr-40 mb-50">
                            <h2>{{ __('home.screenshots_title') }}</h2>
                            <p>{{ __('home.screenshots_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Swiper Slider for Screenshots -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img style="height:638px;" src="{{ asset('frontend/img/gallery/screen-1.jpeg') }}"
                                    alt="slide 5">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;" src="{{ asset('frontend/img/gallery/screen-4.jpeg') }}"
                                    alt="slide 2">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;" src="{{ asset('frontend/img/gallery/screen-5.jpeg') }}"
                                    alt="slide 1">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;" src="{{ asset('frontend/img/gallery/screen-2.jpeg') }}"
                                    alt="slide 3">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;" src="{{ asset('frontend/img/gallery/screen-3.jpeg') }}"
                                    alt="slide 4">
                            </div>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- screen-area-end -->

        <!-- faq-area (Frequently Asked Questions) -->
        <section class="faq-area pb-100"
            style="background-image: url({{ asset('frontend/img/shape/header-sape6.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-end">

                    <div class="col-lg-12">
                        <div class="section-title left-align mb-50">
                            <h2>{{ __('home.faq_title') }}</h2>
                            <p>{{ __('home.faq_desc') }}</p>
                        </div>
                        <div class="faq-wrap">
                            <div class="accordion" id="accordionExample">
                                @foreach ($faqs as $index => $faq)
                                    <div class="card">
                                        <div class="card-header" id="faqHeading{{ $index }}">
                                            <h2 class="mb-0">
                                                <button class="faq-btn {{ $index == 0 ? '' : 'collapsed' }}"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#faqCollapse{{ $index }}"
                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                    aria-controls="faqCollapse{{ $index }}">
                                                    {{ $faq['question'] }}
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="faqCollapse{{ $index }}"
                                            class="collapse {{ $index == 0 ? 'show' : '' }}"
                                            aria-labelledby="faqHeading{{ $index }}"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                {{ $faq['answer'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq-area-end -->


        <!-- newslater-area (Subscribe for Updates) -->
        <section class="newslater-area pt-90 pb-100"
            style="background-image: url({{ asset('frontend/img/bg/subscribe-bg.png') }}); background-size: cover;">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                <div class="section-title text-center pl-40 pr-40 mb-50">
                    <h2>{{ __('home.subscribe_title') }}</h2>
                    <p>{{ __('home.subscribe_desc') }}</p>
                </div>
                </div>
            </div>
            <div class="row justify-content-center" style="direction: ltr;">
                <div class="col-xl-6 col-lg-10">
                <form name="ajax-form" id="contact-form4" action="{{ route('subscribe.message') }}" method="post"
                    class="contact-form newslater">
                    @csrf
                    <div class="form-group">
                    <input class="form-control" id="email2" name="email" type="email"
                        placeholder="{{ __('home.subscribe_placeholder') }}" value="" required>
                    <button type="submit" class="btn btn-custom" id="send2">
                        {{ __('home.subscribe_button') }}
                    </button>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                </form>
                </div>
            </div>
            </div>
        </section>
        <!-- newslater-area-end -->

        <!-- pricing-area (Our Pricing Plans) -->
        <section id="pricing" class="pricing-area pt-100 pb-50"
            style="background-image: url({{ asset('frontend/img/shape/header-sape7.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-title text-center mb-50">
                            <h2>{{ __('home.pricing_title') }}</h2>
                            <p>{{ __('home.pricing_desc') }}</p>
                        </div>

                    </div>
                </div>
                <div class="row justify-content-center" id="pricing-plan-cards">
                    @if (isset($subscriptionPackage) && count($subscriptionPackage) > 0)
                        @foreach ($subscriptionPackage as $package)
                            <div class="col-lg-3 col-md-6">
                                <div class="pricing-box text-center mb-60">
                                    <div class="pricing-head">
                                        <h4>{{ $package['package_name'] }}</h4>
                                        <div class="pricing-amount">
                                            <sup><span class="currency">$</span></sup>
                                            <span class="price">{{ $package['price'] }}</span>
                                            <br>
                                            <span class="subscription"></span>
                                        </div>
                                        <h5></h5>
                                    </div>
                                    <div class="pricing-body mb-40 text-left">
                                        <ul>
                                            <li>{{ __('home.contact_limit') }}: {{ $package['contact_limit'] }}</li>
                                            {{-- <li>{{ __('home.duration') }}: {{ $package['duration'] ?? "N/A" }}</li> --}}
                                        </ul>
                                    </div>
                                    <div class="pricing-btn">
                                        <a href="#" class="btn">{{ __('home.pricing_button') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>{{ __('home.no_packages_available') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- pricing-area-end -->


        <!-- blog-area (Our Latest Blog & News) -->
        <section id="blog" class="blog-area p-relative pt-70"
            style="background-image: url({{ asset('frontend/img/shape/header-sape8.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-10">
                        <div class="section-title text-center mb-50">
                            <h2>{{ __('home.blog_title') }}</h2>
                            <p>{{ __('home.blog_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-12">
                            <div class="single-post mb-30">
                                <div class="blog-thumb">
                                    @if (isset($blog['image']))
                                        <a href="{{ route('blog-details', $blog['id']) }}"><img
                                                src="{{ asset('storage/' . $blog['image']) }}" alt="blog"></a>
                                    @endif
                                </div>
                                <div class="blog-content">
                                    <div class="b-meta mb-40">
                                        <ul>
                                            <li><a >{{ $blog['created_at']->format('d M Y') }}</a></li>
                                        </ul>
                                    </div>
                                    <h4>
                                        <a href="{{ route('blog-details', $blog['id']) }}">{{ $blog['title'] }}</a>
                                    </h4>
                                    <p>{{ strip_tags(Str::limit($blog['content'], 100)) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

      <!-- contact-area (Get In Touch) -->
<section id="contact" class="contact-area pt-50 pb-100"
style="background-color: #fff; position: relative;">
<div class="container">
    <div class="row align-items-center contact-direction" style="max-width: 1140px; margin: auto;">
        <!-- Left Image -->
        <div class="col-lg-6 d-flex justify-content-center">
            <div class="contact-img2" style="max-width: 723px; max-height: 555px;">
                <img src="{{ asset('frontend/img/bg/couples.jpg') }}" alt="couples"
                    style="width: 100%; height: auto; object-fit: cover; border-radius: 12px;">
            </div>
        </div>

        <!-- Right Form -->
        <div class="col-lg-6">
            <div class="section-title mb-40">
                <h2>{{ __('home.contact_title') }}</h2>
                <p>{{ __('home.contact_desc') }}</p>
            </div>
            <form action="#" class="contact-form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-field p-relative c-name mb-20">
                            <input type="text" placeholder="{{ __('home.contact_placeholder_name') }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="contact-field p-relative c-email mb-20">
                            <input type="email" placeholder="{{ __('home.contact_placeholder_email') }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="contact-field p-relative c-subject mb-20">
                            <input type="text" placeholder="{{ __('home.contact_placeholder_phone') }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="contact-field p-relative c-message mb-45">
                            <textarea name="message" id="message" cols="10" rows="10"
                                placeholder="{{ __('home.contact_placeholder_message') }}"></textarea>
                        </div>
                        <button class="btn">{{ __('home.contact_button') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</section>

        <!-- contact-area-end -->

    </div>
@endsection
