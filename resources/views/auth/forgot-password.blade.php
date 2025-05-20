<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('admin.partials.title-meta')
    @include('admin.partials.head-css')
</head>
@if (app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('frontend/css/auth-rtl.css') }}">
@endif

<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    {{-- <div class="carousel-inner">
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
                    </div> --}}
                </div>
            </div> <!-- end auth-user-testimonial -->
        </div>
        <!-- end Auth fluid right content -->

        <!-- Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="{{ url('/') }}" class="logo-dark">
                        <span><img src="{{ asset('admin/assets/images/proposals-logo.jpeg') }}" alt="dark logo"
                                class="auth-logo"></span>
                    </a>
                    <a href="{{ url('/') }}" class="logo-light">
                        <span><img src="{{ asset('admin/assets/images/proposals-logo.jpeg') }}" alt="logo"
                                height="24"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- Title -->
                    <h4>{{ __('auth.reset_password') }}</h4>
                    <p class="text-muted mb-4">{{ __('auth.check_email_verification') }}</p>
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Laravel Form -->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('auth.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" required placeholder="{{ __('auth.email') }}">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-0 text-center d-grid">
                            <button class="btn btn-primary"
                                type="submit">{{ __('auth.send_password_reset_link') }}</button>
                        </div>
                    </form>
                    <!-- end form -->
                </div>

                <!-- Footer -->
                <footer class="footer footer-alt">
                    <p class="text-muted">{{ __('auth.already_registered') }} <a href="{{ route('login') }}"
                            class="text-muted ms-1"><b>{{ __('auth.login') }}</b></a></p>
                </footer>

            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box -->
    </div>
    <!-- end auth-fluid -->

    @include('admin.partials.footer-scripts')

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

</body>

</html>
