<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
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
    <link rel="stylesheet" href="{{ asset('dashboard/css/dore.light.purplemonster.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/css/dore.dark.bluenavy.min.css') }}" /> --}}
</head>

<body id="app-container" class="menu-default">
  
    @include('user.layouts.header')

    @include('user.layouts.sidebar')

    <main>
       @yield('content')
       <div id="flower-container"></div>
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
    
</body>

<script>
    
</script>

</html>
