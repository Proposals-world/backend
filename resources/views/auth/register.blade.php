<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @if (app()->getLocale() === 'ar')

    <link rel="stylesheet" href="{{ asset('frontend/css/auth-rtl.css') }}">
    @endif
    @include("admin.partials.title-meta", ["title" => "Register"])
    @include('admin.partials.head-css')
      <style>
                                    .gender-options.ltr-gender .form-check-input,
                                    .custom-checkbox.ltr-gender {
                                        order: 0;
                                        margin-right: 0.5rem;
                                        margin-left: 0;
                                    }
                                    .gender-options.ltr-gender .form-check-label {
                                        order: 1;
                                    }
                                    .gender-options.rtl-gender,
                                    .rtl-gender .form-check {
                                        direction: rtl;
                                    }
                                    .gender-options.rtl-gender .form-check-input,
                                    .custom-checkbox.rtl-gender {
                                        order: 1;
                                        margin-left: 0.5rem;
                                        margin-right: 0;
                                    }
                                    .gender-options.rtl-gender .form-check-label {
                                        order: 0;
                                    }
                                    .gender-options {
                                        display: flex;
                                        gap: 1.5rem;
                                    }
                                    .gender-options .form-check {
                                        display: flex;
                                        align-items: center;
                                        flex-direction: row;
                                    }
                                    /* General checkbox/radio direction for all checkboxes/radios */
                                    .form-check.ltr-gender {
                                        flex-direction: row;
                                    }
                                    .form-check.rtl-gender {
                                        flex-direction: row-reverse;
                                    }

        .auth-fluid {
            display: flex;
            min-height: 100vh;
        }
        .auth-fluid-right {
            background: #f8f9fa;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .auth-fluid-form-box {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
    </style>
</head>
<body class="authentication-bg pb-0">
    <div class="auth-fluid">
        <!-- Right Content (Optional testimonial carousel) -->
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
        <!-- End Auth fluid right content -->

        <!-- Left Content: Registration Form -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">
                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="{{ url('/') }}" class="logo-dark">
                        <span><img src="{{ asset('admin/assets/images/proposals-logo.jpeg') }}" alt="dark logo" class="auth-logo"></span>
                    </a>
                    <a href="{{ url('/') }}" class="logo-light">
                        <span><img src="{{ asset('admin/assets/images/proposals-logo.jpeg') }}" alt="logo" height="24"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- Title -->
                    <h4 class="mt-3">{{ __('auth.register') }}</h4>
                    {{-- <p class="text-muted mb-4">{{ __('auth.not_receive_email') }}</p> --}}

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- First Name and Last Name -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">{{ __('auth.first_name') }}</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="{{ __('auth.first_name') }}" >
                                    @error('first_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">{{ __('auth.last_name') }}</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="{{ __('auth.last_name') }}" >
                                    @error('last_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('auth.email') }}
                            </label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('auth.email') }}">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
<!-- country -->
                        <div class="mb-3">
                        <label for="country_code" class="form-label sr-only">
                            {{ __('auth.Country_code') }}
                        </label>
                        <select name="country_code" id="country_code"
                                class="form-select @error('country_code') is-invalid @enderror">
                            @foreach(config('countries') as $iso => $info)
                            <option value="{{ $iso }}"
                                    {{ old('country_code', 'JO') == $iso ? 'selected' : '' }}>
                                    {{ $info['name'] }} {{ $info['dial_code'] }}
                            </option>

                            @endforeach
                        </select>
                        @error('country_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">{{ __('auth.phone_number') }}</label>
                            <input type="tel" class="form-control {{ app()->getLocale() === 'ar' ? ' text-end' : '' }}" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="{{ __('auth.phone_placeholder') }}">
                            @error('phone_number')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Password and Confirm Password -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="{{ __('auth.password_label') }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">{{ __('auth.confirm_password') }}</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="{{ __('auth.confirm_password') }}">
                                </div>
                            </div>
                            <div class="text-mute mb-2">{{ __('auth.passwordInsturction')}}</div>
                            @error('password_confirmation')
                                <div class="text-danger mb-2">{{ $message }}</div>
                            @enderror
                            @error('password')
                              <div class="text-danger mb-2">{{ $message }}</div>
                          @enderror
                        </div>

                        <!-- Gender Selection -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('auth.gender') }}</label>
                            <div class="d-flex justify-content-around">
                                <div class="gender-options {{ app()->getLocale() === 'ar' ? 'rtl-gender' : 'ltr-gender' }}">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input custom-checkbox" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="male">{{ __('auth.male') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input custom-checkbox" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="female">{{ __('auth.female') }}</label>
                                    </div>
                                </div>

                            </div>
                            @error('gender')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hidden Profile Status Field -->
                        <input type="hidden" name="profile_status" value="pending">

                        <!-- Terms and Privacy Policy -->
                        <div class="mb-3">
                            @if(app()->getLocale() === 'ar')
                                <div class="form-check terms-container ">
                                    <label class="form-check-label ms-2" for="terms">
                                        {{ __('auth.terms') }}
                                        <a href="{{ route('terms-and-conditions') }}" class="active"> {{ __('auth.Terms and Conditions') }}</a>
                                        {{ __('auth.and') }}
                                        <a href="{{ route('privacy-policy') }}">{{ __('auth.Privacy Policy') }}</a>
                                    </label>
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                </div>
                            @else
                                <div class="form-check terms-container ">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        {{ __('auth.terms') }}
                                        <a href="{{ route('terms-and-conditions') }}" class="active"> {{ __('auth.Terms and Conditions') }}</a>
                                        {{ __('auth.and') }}
                                        <a href="{{ route('privacy-policy') }}">{{ __('auth.Privacy Policy') }}</a>
                                    </label>
                                </div>
                            @endif
                            @error('terms')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-0 text-center">
                            <button class="btn btn-primary fw-semibold rounded-pill px-5" type="submit">{{ __('auth.register') }} <i class="fas fa-user-plus ml-2"></i></button>
                        </div>

                    </form>
                </div>

                <!-- Footer -->
                <footer class="footer footer-alt text-center">
                    <p class="text-muted">{{ __('auth.already_registered') }} <a href="{{ route('login') }}" class="ms-1 fw-bold">{{ __('auth.login') }}</a></p>
                </footer>
            </div>
        </div>
    </div>

    @include('admin.partials.footer-scripts')
    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>
</html>
