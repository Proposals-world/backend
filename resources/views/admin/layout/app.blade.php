<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.title-meta', ['title' => 'Dashboard'])

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">
    
        
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/sweetalert/sweetalert2.min.css')}}">    
    @include('admin.partials.head-css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('admin.partials.menu')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            @yield('content')
            @include('admin.partials.footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('admin.partials.right-sidebar')

    @include('admin.partials.footer-scripts')

    <!-- Daterangepicker js -->
    <script src="{{ asset('admin/assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Apex Charts js -->
    <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map js -->
    <script src="{{ asset('admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('admin/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>

    <!-- Dashboard App js -->
    <script src="{{ asset('admin/assets/js/pages/demo.dashboard.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert2.min.js') }}"></script>
    @stack('scripts')

</body>

</html>
