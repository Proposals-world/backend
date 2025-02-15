<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
<!-- Basic Meta Tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Proposals.world - Find Your Perfect Life Partner</title>
<meta name="description" content="Proposals.world is a premium matchmaking platform dedicated to helping you find your ideal life partner. Join thousands of happy couples and start your journey toward a lifelong relationship.">
<meta name="keywords" content="matchmaking, proposals, marriage, soulmate, dating, relationships, proposals world">
<meta name="author" content="Proposals.world">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://proposals.world">

<!-- Open Graph / Facebook -->
<meta property="og:title" content="Proposals.world - Find Your Perfect Life Partner">
<meta property="og:description" content="Join thousands of happy couples who discovered true love on Proposals.world.">
<meta property="og:image" content="{{ asset('frontend/img/logo/proposals-logo-removebg-preview.png') }}">
<meta property="og:url" content="https://proposals.world">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Proposals.world - Find Your Perfect Life Partner">
<meta name="twitter:description" content="Join thousands of happy couples who discovered true love on Proposals.world.">
<meta name="twitter:image" content="{{ asset('admin/assets/images/proposals-logo.jpeg') }}">

<!-- Favicon & Apple Touch Icon -->
<link rel="icon" type="image/jpeg" href="{{ asset('admin/assets/images/proposals-logo.jpeg') }}">
<link rel="apple-touch-icon" href="{{ asset('frontend/img/logo/proposals-logo-removebg-preview.png') }}">
    <!-- CSS here -->
    @if (app()->getLocale() === 'ar')
        <!-- RTL CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">

    @endif
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

</head>

<body>
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- main-area -->
    <main>
        @yield('section')
        <!-- contact-area-end -->
    </main>
    <!-- main-area-end -->
    <!-- footer -->

    <!-- footer-end -->
    @include('frontend.layouts.footer');

    <!-- JS here -->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/one-page-nav-min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('frontend/js/paroller.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/js_isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('frontend/js/parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/typed.js') }}"></script>
    <script src="{{ asset('frontend/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/element-in-view.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>



</body>

</html>
