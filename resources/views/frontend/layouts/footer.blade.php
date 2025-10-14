<footer class="footer-bg footer-p" style="background-image: url({{ asset('frontend/img/bg/f-bg.png') }}); background-position: center top; background-size: auto; background-repeat: no-repeat;">
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Logo & Description -->
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="logo mt-15 mb-15 d-flex justify-content-center align-items-center">
                            <a href="#"><img src="{{ asset('frontend/img/logo/tolba.png') }}" style="height:140px; width:140px;" alt="logo"></a>
                        </div>
                        <div class="footer-text mb-20">
                            <p>{{ __('footer.footer_text') }}</p>
                        </div>
                        {{-- <div class="footer-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                        </div> --}}
                    </div>
                </div>
                <!-- Useful Links -->
                <div class="col-xl-2 col-lg-3 col-sm-6" style="margin-top:7px">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h5>{{ __('footer.useful_links') }}</h5>
                        </div>
                        <div class="footer-link" >
                            <ul>
                                <li><a href="{{ route('welcome') }}">{{ __('footer.home') }}</a></li>
                                <li><a href="{{ route('about-us') }}">{{ __('footer.about_us') }}</a></li>
                                <li><a href="{{ url('/') }}#pricing">{{ __('header.pricing') }}</a></li>
                                <li><a href="{{ url('/') }}#contact">{{ __('header.contact') }}</a></li>
                                <li><a href="{{ url('/') }}#blog">{{ __('header.blog') }}</a></li>
                                <li><a href="{{ route('terms-and-conditions') }}">{{ __('TermsAndConditions.title') }}</a></li>
                                <li><a href="{{ route('privacy-policy') }}">{{ __('footer.privacy_policy') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Contact Us -->
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h5>{{ __('footer.contact_us') }}</h5>
                        </div>
                        <div class="footer-link">
                            <div class="f-contact">
                                <ul>
                                    {{-- <li>
                                        <i class="icon dripicons-phone"></i>
                                        <span>{!! __('footer.phone') !!}</span>
                                    </li> --}}
                                    <li>
                                        <i class="icon dripicons-mail"></i>
                                        <span>{!! __('footer.email') !!}</span>
                                    </li>
                                    <li>
                                        <i class="fal fa-map-marker-alt"></i>
                                        <span>{!! __('footer.address') !!}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods -->
            {{-- <div class="row justify-content-center">
                <div class="col-12">
                    <div class="payment-logos text-center mb-20">
                        <img src="{{ asset('frontend/img/mastercard.png') }}" alt="Mastercard" height="40" class="mx-2">
                        <img src="{{ asset('frontend/img/VISA-logo.png') }}" alt="VISA" height="40" class="mx-2">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright-wrap text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-text">
                        <p>{!! __('footer.copyright') !!} &copy; {{ date('Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
