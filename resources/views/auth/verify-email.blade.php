<!DOCTYPE html>
<html lang="en">

<head>
    @include("admin.partials.title-meta")
    @include('admin.partials.head-css')
</head>

<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <h2 class="mb-3">I love the color!</h2>
                            <p class="lead"><i class="ri-double-quotes-l"></i> Everything you need is in this template. Love the overall look and feel. Not too flashy, and still very professional and smart.</p>
                            <p>- Admin User</p>
                        </div>
                        <div class="carousel-item">
                            <h2 class="mb-3">Flexibility!</h2>
                            <p class="lead"><i class="ri-double-quotes-l"></i> Pretty nice theme, hoping you guys could add more features to this. Keep up the good work.</p>
                            <p>- Admin User</p>
                        </div>
                        <div class="carousel-item">
                            <h2 class="mb-3">Feature Availability!</h2>
                            <p class="lead"><i class="ri-double-quotes-l"></i> This is a great product, helped us a lot and very quick to work with and implement.</p>
                            <p>- Admin User</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Auth fluid right content -->

        <!-- Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="{{ url('/') }}" class="logo-dark">
                        <span><img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="dark logo" height="24"></span>
                    </a>
                    <a href="{{ url('/') }}" class="logo-light">
                        <span><img src="{{ asset('admin/assets/images/logo.png') }}" alt="logo" height="24"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- Title -->
                    <h4 class="text-center">Verify Your Email</h4>
                    <p class="text-muted text-center mb-4">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </p>

                    <!-- Status Message -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-center">
                            A new verification link has been sent to the email address you provided during registration.
                        </div>
                    @endif

                    <!-- Resend Verification Email Form -->
                    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                        @csrf
                        <div class="d-grid text-center">
                            <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                        </div>
                    </form>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-link text-decoration-none text-muted">
                            Log Out
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <footer class="footer footer-alt">
                    <p class="text-muted">
                        <script>document.write(new Date().getFullYear())</script> © Propasals - Propasals.world
                    </p>
                </footer>

            </div>
        </div>
        <!-- end auth-fluid-form-box -->
    </div>

    @include('admin.partials.footer-scripts')

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

</body>

</html>