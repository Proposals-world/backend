<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Apply for traditional marriage proposals with ease. Discover a trusted platform where tradition meets love. Start your journey today.">

        <!-- Primary Meta Tags -->
    <meta name="title" content="Proposals.world – Where Tradition Meets Love">
    <meta name="description" content="Apply for traditional marriage proposals with ease. Discover a trusted platform where tradition meets love. Start your journey today.">
    <meta name="keywords" content="proposals, traditional marriage, marriage application, traditional marriage application, traditional marriage website, marriage website, where tradition meets love">
    <meta name="author" content="Proposals.world Team">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Proposals.world – Where Tradition Meets Love">
    <meta property="og:description" content="Find meaningful connections through traditional marriage proposals. Apply now and let tradition guide your path to love.">
    <meta property="og:image" content="{{ asset('admin/assets/images/proposals-logo.jpeg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Proposals.world – Where Tradition Meets Love">
    <meta name="twitter:description" content="Join a community that honors tradition. Submit your marriage application online and connect through values that last.">
    <meta name="twitter:image" content="{{ asset('admin/assets/images/proposals-logo.jpeg') }}">

<title>Proposals.world - Find Your Perfect Life Partner</title>
<link rel="icon" type="image/jpeg" href="{{ asset('admin/assets/images/proposals-logo.jpeg') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('dashboard/font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/font/simple-line-icons/css/simple-line-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/bootstrap.rtl.only.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/datatables.responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/glide.core.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/bootstrap-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/component-custom-switch.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/video-js.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/vendor/smart_wizard.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('dashboard/css/dore.light.purplemonster.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/css/dore.dark.bluenavy.min.css') }}" /> --}}
    @if (app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}" />
    @endif
</head>

<body id="app-container" class="menu-default" style="
@if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
    background-position: left 0;
@else
    background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
    background-position: right 0; @endif
background-repeat: no-repeat;
background-size: 40%;">

    @include('user.layouts.header')

    @include('user.layouts.sidebar')

    <main>
       @yield('content')
    </main>

    @include('user.layouts.footer')
    <script src="{{ asset('dashboard/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/select2.full.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/nouislider.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/cropper.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/mousetrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/dore-plugins/select.from.library.js') }}"></script>
    <script src="{{ asset('dashboard/js/dore.script.js') }}"></script>
    <script src="{{ asset('dashboard/js/scripts.js') }}"></script>
    <script src="{{ asset('dashboard/js/scripts.single.theme.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
    <script>
        (function ($) {
            if ($().dropzone) {
                Dropzone.autoDiscover = false;
            }
            const currentLocale = "{{ app()->getLocale() }}";
            const direction = currentLocale === 'ar' ? 'rtl' : 'ltr';

            document.documentElement.setAttribute('dir', direction);
            $('body').removeClass('ltr rtl').addClass(direction);

            localStorage.setItem("dore-direction", direction);

            $("input[name='directionRadio'][data-direction='" + direction + "']").prop('checked', true);

            $('input[name="directionRadio"]').on('change', function (event) {
                const selectedDirection = $(this).data('direction');
                localStorage.setItem('dore-direction', selectedDirection);
                window.location.reload();
            });

        })(jQuery);
    </script>
    @stack('scripts')
</body>

<script>

</script>

</html>
