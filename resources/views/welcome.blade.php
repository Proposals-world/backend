@extends('frontend.layouts.app')
@section('section')
    <div>
        <!-- slider-area -->
        <section id="parallax" class="slider-area slider-bg2 second-slider-bg d-flex fix"
            style="
                @if (app()->getLocale() === 'ar')
                    background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
                    background-position: left 0;
                @else
                    background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
                    background-position: right 0;
                @endif
                background-repeat: no-repeat;
                background-size: 65%;">
    
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
                                <a href="#" class="btn ss-btn" data-animation="fadeInUp" data-delay=".8s">
                                    {{ __('home.call_to_action') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img id="header-phone-image" src="{{ asset('frontend/img/gallery/home.png') }}" alt="app" class="s-img">
                    </div>
                </div>
            </div>
        </section>
        <!-- slider-area-end -->
    
        <!-- features-area (Our Features) -->
        <section id="about" class="services-area services-bg pt-25 pb-20"
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
                                <img src="{{ asset('frontend/img/icon/f-icon1.png') }}" alt="icon">
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
                                <img src="{{ asset('frontend/img/icon/f-icon2.png') }}" alt="icon">
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
                                <img src="{{ asset('frontend/img/icon/f-icon3.png') }}" alt="icon">
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
                                <img src="{{ asset('frontend/img/icon/f-icon2.png') }}" alt="icon">
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
        <section class="choose-area pt-100 pb-60 p-relative" style="direction: ltr; background-image: url({{ asset('frontend/img/shape/header-sape3.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="chosse-img" style="background-image: url({{ asset('frontend/img/bg/easy-m-bg.png') }})"></div>
            <div class="chosse-img2">
                <img src="{{ asset('admin/assets/images/mobile2.png') }}" alt="mobile" />
            </div>
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
                                            <img src="{{ asset('frontend/img/icon/g-play-icon.png') }}" alt="g-play-icon">
                                        </span>
                                        <span class="text"> {{ __('home.google_play') }} <strong>GOOGLE PLAY</strong></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- choose-area-end -->
    
        <!-- how-app-work (How It Works) -->
        <section id="features" class="app-work pt-70 pb-100 p-relative"
            style="background-image: url({{ asset('frontend/img/shape/header-sape4.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6">
                        <div class="choose-wrap">
                            <div class="section-title w-title left-align mb-15">
                                <h2>{{ __('home.how_it_works') }}</h2>
                            </div>
                            <div class="app-work-content mt-20">
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/apw-Icon1.png') }}" alt="step 1">
                                        </div>
                                        <div class="text">
                                            <h4>{{ __('home.step_1') }}</h4>
                                            <p>{{ __('home.step_1_desc') }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/apw-Icon2.png') }}" alt="step 2">
                                        </div>
                                        <div class="text">
                                            <h4>{{ __('home.step_2') }}</h4>
                                            <p>{{ __('home.step_2_desc') }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/apw-Icon3.png') }}" alt="step 3">
                                        </div>
                                        <div class="text">
                                            <h4>{{ __('home.step_4') }}</h4>
                                            <p>{{ __('home.step_4_desc') }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="how-it-works-img-section" class="col-xl-6">
                        <img src="{{ asset('frontend/img/gallery/how_it_works.png') }}" alt="app-work-img" class="img">
                    </div>
                </div>
            </div>
        </section>
        <!-- how-app-work-end -->
    
        <!-- video-area (Meet Your Match Video) -->
        {{-- <section style="direction: ltr !important;" class="video-area pt-100 pb-100 p-relative">
            <div class="video-img2">
                <img src="{{ asset('frontend/img/bg/video-img.png') }}" alt="video">
                <a href="https://www.youtube.com/watch?v=7e90gBu4pas" class="popup-video">
                    <img src="{{ asset('frontend/img/bg/play-btn.png') }}" alt="play-btn">
                </a>
            </div>
            <div class="video-img3">
                <img src="{{ asset('frontend/img/shape/header-sape5.png') }}" alt="shape">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6"></div>
                    <div class="col-xl-6">
                        <div class="video-wrap">
                            <div class="section-title w-title left-align mb-25">
                                <h2>{{ __('home.video_title') }}</h2>
                            </div>
                            <div class="video-content">
                                <p>{{ __('home.video_desc') }}</p>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/vs-icon.png') }}" alt="icon">
                                        </div>
                                        <div class="text">{{ __('home.video_point1') }}</div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/vs-icon.png') }}" alt="icon">
                                        </div>
                                        <div class="text">{{ __('home.video_point2') }}</div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/vs-icon.png') }}" alt="icon">
                                        </div>
                                        <div class="text">{{ __('home.video_point3') }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- video-area-end -->
    
        <!-- screen-area (App Screenshots) -->
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
                                <img style="height:638px;"  src="{{ asset('frontend/img/gallery/screen-4.jpeg') }}" alt="slide 5">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;"  src="{{ asset('frontend/img/gallery/screen-1.jpeg') }}" alt="slide 2">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;" src="{{ asset('frontend/img/gallery/screen-5.jpeg') }}" alt="slide 1">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;"  src="{{ asset('frontend/img/gallery/screen-2.jpeg') }}" alt="slide 3">
                            </div>
                            <div class="swiper-slide">
                                <img style="height:638px;"  src="{{ asset('frontend/img/gallery/screen-3.jpeg') }}" alt="slide 4">
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
                    <div class="col-lg-6">
                        <div class="faq-img text-right">
                            <img src="{{ asset('frontend/img/icon/logos-icons.png') }}" alt="logos" class="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title left-align mb-50">
                            <h2>{{ __('home.faq_title') }}</h2>
                            <p>{{ __('home.faq_desc') }}</p>
                        </div>
                        <div class="faq-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="faqHeadingOne">
                                        <h2 class="mb-0">
                                            <button class="faq-btn" type="button" data-toggle="collapse"
                                                data-target="#faqCollapseOne" aria-expanded="true"
                                                aria-controls="faqCollapseOne">
                                                {{ __('home.faq_question1') }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faqCollapseOne" class="collapse show" aria-labelledby="faqHeadingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            {{ __('home.faq_answer1') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="faqHeadingTwo">
                                        <h2 class="mb-0">
                                            <button class="faq-btn collapsed" type="button" data-toggle="collapse"
                                                data-target="#faqCollapseTwo" aria-expanded="false"
                                                aria-controls="faqCollapseTwo">
                                                {{ __('home.faq_question2') }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faqCollapseTwo" class="collapse" aria-labelledby="faqHeadingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            {{ __('home.faq_answer2') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="faqHeadingThree">
                                        <h2 class="mb-0">
                                            <button class="faq-btn collapsed" type="button" data-toggle="collapse"
                                                data-target="#faqCollapseThree" aria-expanded="false"
                                                aria-controls="faqCollapseThree">
                                                {{ __('home.faq_question3') }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faqCollapseThree" class="collapse" aria-labelledby="faqHeadingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            {{ __('home.faq_answer3') }}
                                        </div>
                                    </div>
                                </div>
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
                        <form name="ajax-form" id="contact-form4" action="#" method="post"
                            class="contact-form newslater">
                            <div class="form-group">
                                <input class="form-control" id="email2" name="email" type="email"
                                    placeholder="{{ __('home.subscribe_placeholder') }}" value="" required>
                                <button type="submit" class="btn btn-custom" id="send2">
                                    {{ __('home.subscribe_button') }}
                                </button>
                            </div>
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
            <div class="row">
                @if(isset($subscriptionPackage) && count($subscriptionPackage) > 0)
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
                                        <li>{{ __('home.days') }}: {{ $package['duration_days'] }}</li>
                                        <li>{{ __('home.contact_limit') }}: {{ $package['contact_limit'] }}</li>

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
                    <!-- Blog Post 1 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="#"><img src="{{ asset('frontend/img/blog/inner_b1.jpg') }}" alt="blog"></a>
                            </div>
                            <div class="blog-content">
                                <div class="b-meta mb-40">
                                    <ul>
                                        <li><a href="#">20 Jan 2019</a></li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">{{ __('home.blog_post_title1') }}</a>
                                </h4>
                                <p>{{ __('home.blog_post_desc1') }}</p>

                            </div>
                        </div>
                    </div>
                    <!-- Blog Post 2 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="#"><img src="{{ asset('frontend/img/blog/inner_b2.jpg') }}" alt="blog"></a>
                            </div>
                            <div class="blog-content">
                                <div class="b-meta mb-40">
                                    <ul>
                                        <li><a href="#">20 Jan 2019</a></li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">{{ __('home.blog_post_title2') }}</a>
                                </h4>
                                <p>{{ __('home.blog_post_desc2') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Blog Post 3 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="#"><img src="{{ asset('frontend/img/blog/inner_b3.jpg') }}" alt="blog"></a>
                            </div>
                            <div class="blog-content">
                                <div class="b-meta mb-40">
                                    <ul>
                                        <li><a href="#">20 Jan 2019</a></li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">{{ __('home.blog_post_title3') }}</a>
                                </h4>
                                <p>{{ __('home.blog_post_desc3') }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->
    
        <!-- contact-area (Get In Touch) -->
        <section id="contact" class="contact-area contact-bg pt-50 pb-100 p-relative fix"
            style="background-image: url({{ asset('frontend/img/shape/header-sape8.png') }}); background-position: right center; background-size: auto; background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-img2">
                            <img src="{{ asset('frontend/img/bg/illustration.png') }}" alt="illustration">
                        </div>
                    </div>
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