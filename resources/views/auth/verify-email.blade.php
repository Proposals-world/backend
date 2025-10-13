<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @if (app()->getLocale() === 'ar')

    <link rel="stylesheet" href="{{ asset('frontend/css/auth-rtl.css') }}">
    @endif
    @include("admin.partials.title-meta")
    @include('admin.partials.head-css')
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

        <!-- Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="{{ url('/') }}" class="logo-dark">
                        <span><img class="auth-logo" src="{{asset('frontend/img/logo/tolba.png')}}" alt="dark logo"></span>
                    </a>
                    <a href="{{ url('/') }}" class="logo-light">
                        <span><img src="{{asset('frontend/img/logo/tolba.png')}}" alt="logo" height="24"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- Title -->
                    <h4 class="text-center">{{ __('auth.verify_email') }}</h4>
                    <p class="text-muted text-center mb-4">
                        {{ __('auth.check_email_verification') }}
                    </p>

                    <!-- Status Message -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-center">
                            {{ __('auth.verification_link_sent') }}
                        </div>
                    @endif

                    <!-- Resend Verification Email Form -->
                    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                        @csrf
                        <div class="d-grid text-center">
                            <button id="sendVerificationBtn" type="submit" class="btn btn-primary">{{ __('auth.send_email_verification_link') }}</button>
                        </div>
                    </form>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-link text-decoration-none text-muted">
                            {{ __('auth.logout') }}
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <footer class="footer footer-alt">
                    <p class="text-muted">
                        <script>document.write(new Date().getFullYear())</script> © Tolba - Tolba.world
                    </p>
                </footer>

            </div>
        </div>
        <!-- end auth-fluid-form-box -->
    </div>

    @include('admin.partials.footer-scripts')

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    @push('script')
<script>
const btn = document.getElementById('sendVerificationBtn');
const originalText = btn.innerText;

// Check if a countdown is already in progress in localStorage
let countdownEnd = localStorage.getItem('emailVerificationCountdown');
if (countdownEnd) {
    const remaining = Math.floor((countdownEnd - Date.now()) / 1000);
    if (remaining > 0) {
        disableButton(remaining);
    } else {
        localStorage.removeItem('emailVerificationCountdown');
    }
}

btn.addEventListener('click', function(e) {
    // Disable button and start countdown
    disableButton(60);

    // Save end time in localStorage
    const endTime = Date.now() + 60000; // 60 seconds
    localStorage.setItem('emailVerificationCountdown', endTime);
});

function disableButton(seconds) {
    btn.disabled = true;
    let counter = seconds;
    btn.innerText = `${originalText} (${counter}s)`;

    const interval = setInterval(() => {
        counter--;
        btn.innerText = `${originalText} (${counter}s)`;

        if (counter <= 0) {
            clearInterval(interval);
            btn.disabled = false;
            btn.innerText = originalText;
            localStorage.removeItem('emailVerificationCountdown');
        }
    }, 1000);
}
</script>
    @endpush
</body>

</html>
