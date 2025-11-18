<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include("admin.partials.title-meta")
    @include('admin.partials.head-css')
    @if (app()->getLocale() === 'ar')

    <link rel="stylesheet" href="{{ asset('frontend/css/auth-rtl.css') }}">
    @endif
</head>

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
            </div>
        </div>
        <!-- end Auth fluid right content -->

        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
<div class="auth-brand text-center text-lg-start position-relative mb-3">

                    <!-- Language Switcher Positioned Top Right of Logo -->
    <div style="position: absolute; top: 0; right: 0;">
        <a class="btn btn-outline-primary btn-sm"
           href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}">
            {{ __('header.language_switcher') }}
        </a>
    </div>
                    <a href="{{ url('/') }}" class="logo-dark" style="height: 19px;">
                        <span><img src="{{asset('admin/assets/images/tolba.png')}}" alt="dark logo" class="auth-logo"></span>
                    </a>
                    <a href="{{ url('/') }}" class="logo-light" style="height: 19px;">
                        <span><img src="{{asset('admin/assets/images/tolba.png')}}" alt="logo" height="24"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">{{ __('auth.login') }}</h4>
                    {{-- <p class="text-muted mb-4">{{ __('auth.check_email_verification') }}</p> --}}

                    <!-- Laravel Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('auth.email') }}</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('auth.email') }}">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {{-- <a href="{{ route('password.request') }}" class="text-muted float-end"><small>{{ __('auth.forgot_password') }}</small></a> --}}
                            <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
                            <input class="form-control" type="password" name="password" id="password" required placeholder="{{ __('auth.password_label') }}">
                            <div class="d-flex justify-content-between mt-2">
                                <a href="{{ route('password.request') }}" class="small text-muted">{{ __('auth.forgot_password') }}</a>
                                <a href="{{ route('restore-my-account') }}" class="small text-primary">{{ __('auth.restore_now') }}</a>
                            </div>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check @if(app()->getLocale() === 'ar') d-flex flex-row-reverse justify-content-end align-items-center @endif">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember" @if(app()->getLocale() === 'ar') style="margin-left: 0.5em; margin-right: 0;" @endif>
                                <label class="form-check-label" for="checkbox-signin">{{ __('auth.remember_me') }}</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="ri-login-box-line"></i> {{ __('auth.login') }} </button>
                        </div>
                    </form>
                    <!-- end form-->
                </div>

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">{{ __('auth.not_receive_email') }} ? <a href="{{ route('register') }}" class=" ms-1"><b>{{ __('auth.register') }}</b></a></p>
                </footer>
            </div>
        </div>
        <!-- end auth-fluid-form-box -->
    </div>
    <!-- end auth-fluid-->

    @include('admin.partials.footer-scripts')

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

</body>

</html>
