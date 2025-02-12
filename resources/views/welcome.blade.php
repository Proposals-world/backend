@extends('frontend.layouts.app')
@section('section')
    <div>
        <!-- slider-area -->
        <section id="parallax" class="slider-area slider-bg2 second-slider-bg d-flex fix"
            style="background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }}); background-position:right 0; background-repeat: no-repeat; background-size: 65%;">

            <div class="slider-shape ss-one layer" data-depth="0.10"><img 
                    src="{{ asset('frontend/img/shape/header-sape.png') }}" alt="shape"></div>

            <div class="slider-shape ss-eight layer" data-depth="0.50"></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="slider-content second-slider-content left-center">
                            <ul class="small-title mb-30">
                                <li>New</li>
                                <li>Best Mobile App</li>
                            </ul>
                            <h2 data-animation="fadeInUp" data-delay=".4s">Best Mobile App <span>Showcase</span>
                            </h2>
                            <p data-animation="fadeInUp" data-delay=".6s">Aenean dictum odio dapibus turpis dapibus
                                vestibulum. Mauris quis massa nisi. Nullam porta lorem at volutpat euismod. Proin in
                                ex
                                nunc.</p>
                            <div class="slider-btn mt-30 mb-30">
                                <a href="#" class="btn ss-btn" data-animation="fadeInUp" data-delay=".8s">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('frontend/img/bg/mobile.png') }}" alt="shape" class="s-img">
                    </div>
                </div>

            </div>
        </section>
        <!-- slider-area-end -->
        <!-- services-area -->
        <section id="about" class="services-area services-bg pt-25 pb-20"
            style="background-image: url({{ asset('frontend/img/shape/header-sape2.png') }}); background-position: right top; background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-10">
                        <div class="section-title text-center pl-40 pr-40 mb-45">
                            <h2>Our Features</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-30">
                        <div class="s-single-services active text-center">
                            <div class="services-icon">
                                <img src="{{ asset('frontend/img/icon/f-icon1.png') }}" />
                            </div>
                            <div class="second-services-content">
                                <h5>Perfect UI Design</h5>
                                <p>Praesent ac vehicula sapien. Sed sollicitudin molestie consequat. Ut vitae ante
                                    ut mi
                                    vehicula vulputate.</p>
                                <a href="#"><span>1</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-30">
                        <div class="s-single-services text-center">
                            <div class="services-icon">
                                <img src="{{ asset('img/icon/f-icon3.png') }}" />
                            </div>
                            <div class="second-services-content">
                                <h5>Great CSS Animation</h5>
                                <p>Praesent ac vehicula sapien. Sed sollicitudin molestie consequat. Ut vitae ante
                                    ut mi
                                    vehicula vulputate.</p>
                                <a href="#"><span>2</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-30">
                        <div class="s-single-services text-center">
                            <div class="services-icon">
                                <img src="{{ asset('frontend/img/icon/f-icon2.png') }}" />
                            </div>
                            <div class="second-services-content">
                                <h5>Fully Secured</h5>
                                <p>Praesent ac vehicula sapien. Sed sollicitudin molestie consequat. Ut vitae ante
                                    ut mi
                                    vehicula vulputate.</p>
                                <a href="#"><span>3</span></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- services-area-end -->
        <!-- choose-area -->
        <section class="choose-area pt-100 pb-60 p-relative"
            style="background-image: url({{ asset('frontend/img/shape/header-sape3.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="chosse-img" style="background-image:url({{ asset('frontend/img/bg/easy-m-bg.png') }})">
            </div>
            <div class="chosse-img2"><img src="{{ asset('frontend/img/bg/mobile2.png') }}" alt="mobile" /></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                    </div>
                    <div class="col-xl-7">
                        <div class="choose-wrap">
                            <div class="section-title w-title left-align mb-25">
                                <h2>Easy And Perfect Solution For Your Business App</h2>
                            </div>
                            <div class="choose-content">
                                <p>Aliquam aliquet purus a est consequat lobortis. Etiam vehicula suscipit purus,
                                    eget
                                    ullamcorper augue blandit vitae. Ut eu euismod felis. Etiam at varius quam.
                                    Vivamus
                                    lacinia pulvinar turpis in suscipit. Aenean mattis enim ut pretium gravida. Sed
                                    fermentum a lacus bibendum convallis.</p>
                                <p>Consequat purus aliquet a est aliquam lobortis. Etiam vehicula suscipit purus,
                                    eget
                                    ullamcorper augue blandit vitae. Ut eu euismod felis. Etiam at varius quam.
                                    Vivamus
                                    lacinia pulvinar turpis in suscipit. Aenean mattis enim ut pretium gravida. Sed
                                    fermentum a lacus bibendum convallis.</p>

                                <div class="choose-btn mt-30">
                                    <a href="#"><span class="icon"><img
                                                src="{{ asset('frontend/img/icon/apple-icon.png') }}"
                                                alt="apple-icon"></span>
                                        <span class="text"> Available on <strong>APP STORE</strong></span></a>
                                    <a href="#" class="g-btn"><span class="icon"><img
                                                src="{{ asset('frontend/img/icon/g-play-icon.png') }}"
                                                alt="apple-icon"></span>
                                        <span class="text"> Available on <strong>GOOGLE PLAY</strong></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- choose-area-end -->
        <!-- how-app-work -->
        <section id="features" class="app-work pt-70 pb-100 p-relative"
            style="background-image: url({{ asset('frontend/img/shape/header-sape4.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-center ">

                    <div class="col-xl-6">
                        <div class="choose-wrap">
                            <div class="section-title w-title left-align mb-15">
                                <h2>How does This App Work?</h2>
                            </div>
                            <div class="app-work-content mt-20">
                                <ul>
                                    <li>
                                        <div class="icon"><img src="{{ asset('frontend/img/icon/apw-Icon1.png') }}">
                                        </div>
                                        <div class="text">
                                            <h4>Make A Profile</h4>
                                            <p>Aliquam varius ligula nec leo tempus porta. Vestibulum suscipit leo
                                                at
                                                nunc imperdiet, quis lacinia nisi euismod.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><img src="{{ asset('frontend/img/icon/apw-Icon2.png') }}">
                                        </div>
                                        <div class="text">
                                            <h4>Download It For Free</h4>
                                            <p>Aliquam varius ligula nec leo tempus porta. Vestibulum suscipit leo
                                                at
                                                nunc imperdiet, quis lacinia nisi euismod.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><img src="{{ asset('frontend/img/icon/apw-Icon3.png') }}">
                                        </div>
                                        <div class="text">
                                            <h4>Enjoy This App</h4>
                                            <p>Aliquam varius ligula nec leo tempus porta. Vestibulum suscipit leo
                                                at
                                                nunc imperdiet, quis lacinia nisi euismod.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <img src="{{ asset('frontend/img/bg/app-work-img.png') }}" alt="app-work-img" class="img">
                    </div>
                </div>
            </div>
        </section>
        <!-- how-app-work -->
        <!-- video-area -->
        <section class="video-area pt-100 pb-100 p-relative">
            <div class="video-img2">

                <img src="{{ asset('frontend/img/bg/video-img.png') }}" alt="mobile" />

                <a href="https://www.youtube.com/watch?v=7e90gBu4pas" class="popup-video"><img src="img/bg/play-btn.png"
                        alt="play-btn.png"></a>
            </div>
            <div class="video-img3">
                <img src="{{ asset('frontend/img/shape/header-sape5.png') }}" alt="header-sape4">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                    </div>
                    <div class="col-xl-6">
                        <div class="video-wrap">
                            <div class="section-title w-title left-align mb-25">
                                <h2>Build The App That Everyonee Love</h2>
                            </div>
                            <div class="video-content">
                                <p>Praesent fermentum nisl at ipsum facilisis viverra. Ut elementum accumsan
                                    finibus.
                                    Cras placerat lacinia mi, ac dictum ante. Donec libero enim, tincidunt sit amet
                                    venenatis id, maximus eu quam. </p>
                                <ul>
                                    <li>
                                        <div class="icon"><img src="{{ asset('frontend/img/icon/vs-icon.png') }}">
                                        </div>
                                        <div class="text">Pellentesque placerat, nisi congue vehicula efficitur.
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><img src="{{ asset('frontend/img/icon/vs-icon.png') }}">
                                        </div>
                                        <div class="text">Pellentesque placerat, nisi congue vehicula efficitur.
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><img src="{{ asset('frontend/img/icon/vs-icon.png') }}">
                                        </div>
                                        <div class="text">Suspendisse vitae varius diam, a vulputate urna.
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- video-area-end -->
        <!-- screen-area -->
        <section id="screen" class="screen-area services-bg services-two pt-100 pb-70"
            style="background-image: url({{ asset('frontend/img/shape/header-sape4.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="section-title text-center pl-40 pr-40 mb-50">
                            <h2>Our App ScreenShots</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- Swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="{{ asset('frontend/img/gallery/screen-img01.png') }}"
                                    alt="slide 1">
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('frontend/img/gallery/screen-img02.png') }}"
                                    alt="slide 1">
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('frontend/img/gallery/screen-img03.png') }}"
                                    alt="slide 1">
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('frontend/img/gallery/screen-img04.png') }}"
                                    alt="slide 1">
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('frontend/img/gallery/screen-img05.png') }}"
                                    alt="slide 1">
                            </div>

                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </div>


        </section>
        <!-- screen-area-end -->

        <!-- faq-area -->
        <section class="faq-area pb-100"
            style="background-image: url({{ asset('frontend/img/shape/header-sape6.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="faq-img text-right">
                            <img src="{{ asset('frontend/img/icon/logos-icons.png') }}" alt="img" class="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title left-align mb-50">
                            <h2>Designed & Worked By The Latest Partners</h2>
                            <p>Duis non aliquet tellus, in mollis leo. Phasellus quis posuere dui. Nulla mauris
                                purus,
                                mattis eget sagittis at, accumsan sed leo.</p>
                        </div>
                        <div class="faq-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="faq-btn" type="button" data-toggle="collapse"
                                                data-target="#collapseThree" aria-expanded="true"
                                                aria-controls="collapseThree">
                                                Aliquam varius ligula nec leo tempus porta.
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                            laboris
                                            nisi ut aliquip
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="faq-btn collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="false"
                                                aria-controls="collapseOne">
                                                Suspendisse vitae varius diam, a vulputate urna.
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                            laboris
                                            nisi ut aliquip
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="faq-btn collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Aliquam aliquet purus eget lacus pretium.
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                            laboris
                                            nisi ut aliquip
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq-aread-end -->

        <!-- newslater-area -->
        <section class="newslater-area pt-90 pb-100"
            style=" background-image: url({{ asset('frontend/img/bg/subscribe-bg.png') }});background-size: cover;">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="section-title text-center pl-40 pr-40 mb-50">
                            <h2>Subscreibe For New Features</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-10">
                        <form name="ajax-form" id="contact-form4" action="#" method="post"
                            class="contact-form newslater">
                            <div class="form-group">
                                <input class="form-control" id="email2" name="email" type="email"
                                    placeholder="Email Address..." value="" required="">
                                <button type="submit" class="btn btn-custom" id="send2">Subscribe
                                    Now</button>
                            </div>
                            <!-- /Form-email -->
                        </form>
                    </div>

                </div>
            </div>
        </section>
        <!-- newslater-aread-end -->

        <!-- pricing-area -->
        <section id="pricing" class="pricing-area pt-100 pb-50"
            style="background-image:  url({{ asset('frontend/img/shape/header-sape7.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-title text-center mb-50">
                            <h2>Our Pricing Plans</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                        <nav class="pricing-tab mb-60">
                            <span class="monthly_tab_title">
                                Monthly </span>
                            <span class="pricing-tab-switcher"></span>
                            <span class="annual_tab_title">
                                Annual </span>
                        </nav>
                    </div>



                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-box text-center mb-60">
                            <div class="pricing-head">
                                <h4>Beginner</h4>
                                <div class="pricing-amount">
                                    <div class="annual_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 95 </span>
                                        <span class="subscription"> / Annual </span>
                                    </div>
                                    <div class="monthly_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 15 </span>
                                        <span class="subscription"> / Monthly </span>
                                    </div>
                                </div>
                                <h5>I have a dream</h5>
                            </div>

                            <div class="pricing-body mb-40 text-left">

                                <ul>
                                    <li>1000+ projets</li>
                                    <li>No transaction fees</li>
                                    <li>Unlimited Storage</li>
                                    <li>5 Download</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">Start Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-box active text-center mb-60">
                            <div class="poppuler">
                                <span class="btn">Poppuler</span>
                            </div>
                            <div class="pricing-head">
                                <h4>Starter</h4>
                                <div class="pricing-amount">
                                    <div class="annual_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 78 </span>
                                        <span class="subscription"> /Annual </span>
                                    </div>
                                    <div class="monthly_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 15 </span>
                                        <span class="subscription"> /Monthly </span>
                                    </div>
                                </div>
                                <h5>I have a dream</h5>
                            </div>
                            <div class="pricing-body mb-40 text-left">

                                <ul>
                                    <li>1000+ projets</li>
                                    <li>No transaction fees</li>
                                    <li>Unlimited Storage</li>
                                    <li>5 Download</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">Start Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-box active text-center mb-60">
                            <div class="pricing-head">
                                <h4>Professionl</h4>
                                <div class="pricing-amount">
                                    <div class="annual_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 90 </span>
                                        <span class="subscription"> / Annual </span>
                                    </div>
                                    <div class="monthly_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 18 </span>
                                        <span class="subscription"> / Monthly </span>
                                    </div>
                                </div>
                                <h5>I have a dream</h5>
                            </div>

                            <div class="pricing-body mb-40 text-left">

                                <ul>
                                    <li>1000+ projets</li>
                                    <li>No transaction fees</li>
                                    <li>Unlimited Storage</li>
                                    <li>5 Download</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">Start Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-box active text-center mb-60">
                            <div class="pricing-head">
                                <h4>Power Plan</h4>
                                <div class="pricing-amount">
                                    <div class="annual_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 120 </span>
                                        <span class="subscription"> / Annual </span>
                                    </div>
                                    <div class="monthly_price">
                                        <sup><span class="currency">$</span></sup>
                                        <span class="price"> 25 </span>
                                        <span class="subscription"> / Monthly </span>
                                    </div>
                                </div>
                                <h5>I have a dream</h5>
                            </div>
                            <div class="pricing-body mb-40 text-left">

                                <ul>
                                    <li>1000+ projets</li>
                                    <li>No transaction fees</li>
                                    <li>Unlimited Storage</li>
                                    <li>5 Download</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">Start Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- pricing-area-end -->

        <!-- testimonial-area -->
        <section id="testimonios" class="testimonial-area testimonial-p  pt-100 pb-70"
            style="background-image:url({{ asset('frontend/img/bg/client-bg.png') }}); background-repeat: no-repeat; background-position: right center;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title center-align">
                            <h2>What Our Clients Say’s</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="testimonial-active">
                            <div class="col-xl-4">
                                <div class="single-testimonial">
                                    <div class="testi-author text-left">
                                        <img src="{{ asset('frontend/img/testimonial/testi_avatar.png') }}"
                                            alt="img">
                                        <div class="ta-info">
                                            <h6>Mr Jone Dose</h6>
                                            <span>Author</span>
                                        </div>
                                    </div>
                                    <div class="qutation"><img src="{{ asset('frontend/img/bg/qutation.png') }}"
                                            alt="qutation.png"></div>

                                    <p>Praesent fermentum nisl at ipsum fcilisis viverra elementum accumsan finibus.
                                        Cras placerat lacinia mitincidunt sit amet venenatis.</p>

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="single-testimonial">
                                    <div class="testi-author text-left">
                                        <img src="{{ asset('frontend/img/testimonial/testi_avatar2.png') }}"
                                            alt="img">
                                        <div class="ta-info">
                                            <h6>Mr Jone Dose</h6>
                                            <span>Author</span>
                                        </div>
                                    </div>
                                    <div class="qutation"><img src="{{ asset('frontend/img/bg/qutation.png') }}"
                                            alt="qutation.png"></div>
                                    <p>Praesent fermentum nisl at ipsum fcilisis viverra elementum accumsan finibus.
                                        Cras placerat lacinia mitincidunt sit amet venenatis.</p>


                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="single-testimonial">
                                    <div class="testi-author text-left">
                                        <img src="{{ asset('frontend/img/testimonial/testi_avatar3.png') }}"
                                            alt="img">
                                        <div class="ta-info">
                                            <h6>Mr Jone Dose</h6>
                                            <span>Web Developer</span>
                                        </div>
                                    </div>
                                    <div class="qutation"><img src="{{ asset('frontend/img/bg/qutation.png') }}"
                                            alt="qutation.png"></div>
                                    <p>Praesent fermentum nisl at ipsum fcilisis viverra elementum accumsan finibus.
                                        Cras placerat lacinia mitincidunt sit amet venenatis.</p>

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="single-testimonial">
                                    <div class="testi-author text-left">
                                        <img src="{{ asset('frontend/img/testimonial/testi_avatar.png') }}"
                                            alt="img">
                                        <div class="ta-info">
                                            <h6>Mr Jone Dose</h6>
                                            <span>Web Developer</span>
                                        </div>
                                    </div>
                                    <div class="qutation"><img src="{{ asset('frontend/img/bg/qutation.png') }}"
                                            alt="qutation.png"></div>
                                    <p>Praesent fermentum nisl at ipsum fcilisis viverra elementum accumsan finibus.
                                        Cras placerat lacinia mitincidunt sit amet venenatis.</p>

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="single-testimonial">
                                    <div class="testi-author text-left">
                                        <img src="{{ asset('frontend/img/testimonial/testi_avatar2.png') }}"
                                            alt="img">
                                        <div class="ta-info">
                                            <h6>Mr Jone Dose</h6>
                                            <span>Web Developer</span>
                                        </div>
                                    </div>
                                    <div class="qutation"><img src="{{ asset('frontend/img/bg/qutation.png') }}"
                                            alt="qutation.png"></div>
                                    <p>Praesent fermentum nisl at ipsum fcilisis viverra elementum accumsan finibus.
                                        Cras placerat lacinia mitincidunt sit amet venenatis.</p>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- testimonial-area-end -->


        <!-- blog-area -->
        <section id="blog" class="blog-area p-relative pt-70"
            style="background-image: url({{ asset('frontend/img/shape/header-sape8.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-10">
                        <div class="section-title text-center mb-50">
                            <h2>Our Latest Blog & News</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/inner_b1.jpg') }}"
                                        alt="img"></a>
                            </div>
                            <div class="blog-content">
                                <div class="b-meta mb-40">
                                    <ul>
                                        <li><a href="#">20 jan 2019</a></li>
                                    </ul>
                                </div>
                                <h4><a href="blog-details.html">Making Distribut Product Team
                                        Work More With Monday</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisi
                                    cing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <div class="admin">
                                    <ul>
                                        <li><img src="{{ asset('frontend/img/blog/admin-img.png') }}" alt="test">
                                        </li>
                                        <li>
                                            <h6>Jhon Abraham</h6> Author
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/inner_b2.jpg') }}"
                                        alt="img"></a>
                            </div>
                            <div class="blog-content">
                                <div class="b-meta mb-40">
                                    <ul>
                                        <li><a href="#">20 jan 2019</a></li>
                                    </ul>
                                </div>
                                <h4><a href="blog-details.html">Monthly Web Development Upto Cost Of JavaScript
                                        Ethics</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisi
                                    cing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <div class="admin">
                                    <ul>
                                        <li><img src="{{ asset('frontend/img/blog/admin-img.png') }}" alt="test">
                                        </li>
                                        <li>
                                            <h6>Jhon Abraham</h6> Author
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/inner_b3.jpg') }}"
                                        alt="img"></a>
                            </div>
                            <div class="blog-content">
                                <div class="b-meta mb-40">
                                    <ul>
                                        <li><a href="#">20 jan 2019</a></li>
                                    </ul>
                                </div>
                                <h4><a href="blog-details.html">User Experience Psychology And Performance
                                        Smashing</a>
                                </h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisi
                                    cing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <div class="admin">
                                    <ul>
                                        <li><img src="{{ asset('frontend/img/blog/admin-img.png') }}" alt="test">
                                        </li>
                                        <li>
                                            <h6>Jhon Abraham</h6> Author
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

        <!-- contact-area -->
        <section id="contact" class="contact-area contact-bg  pt-50 pb-100 p-relative fix"
            style="background-image: url({{ asset('frontend/img/shape/header-sape8.png') }}); background-position: right center; background-size: auto;background-repeat: no-repeat;">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-img2">
                            <img src="{{ asset('frontend/img/bg/illustration.png') }}" alt="test">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title mb-40">
                            <h2>Get In Tuch</h2>
                            <p>Quisque posuere mollis ipsum et molestie. Fusce cursus, risus vel scelerisque
                                porttitor,
                                leo quam vulputate nibh, sit amet blandit erat magna.</p>
                        </div>
                        <form action="#" class="contact-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="contact-field p-relative c-name mb-20">
                                        <input type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-field p-relative c-email mb-20">
                                        <input type="text" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-field p-relative c-subject mb-20">
                                        <input type="text" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-field p-relative c-message mb-45">
                                        <textarea name="message" id="message" cols="10" rows="10" placeholder="Write comments"></textarea>
                                    </div>
                                    <button class="btn">Send Message</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection
