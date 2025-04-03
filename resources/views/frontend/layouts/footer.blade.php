<footer class="footer-bg footer-p pt-60" style="background-image: url({{ asset('frontend/img/bg/f-bg.png') }}); background-position: center top; background-size: auto; background-repeat: no-repeat;">
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Logo & Description -->
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="logo mt-15 mb-15">
                            <a href="#"><img src="{{ asset('frontend/img/logo/proposals-logo-removebg-preview.png') }}" height="80px" alt="logo"></a>
                        </div>
                        <div class="footer-text mb-20">
                            <p>{{ __('footer.footer_text') }}</p>
                        </div>
                        <div class="footer-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Useful Links -->
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h5>{{ __('footer.useful_links') }}</h5>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="#">{{ __('footer.home') }}</a></li>
                                <li><a href="#">{{ __('footer.about_us') }}</a></li>
                                <li><a href="#">{{ __('footer.services') }}</a></li>
                                <li><a href="#">{{ __('footer.project') }}</a></li>
                                <li><a href="#">{{ __('footer.careers') }}</a></li>
                                <li><a href="#">{{ __('footer.our_team') }}</a></li>
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
