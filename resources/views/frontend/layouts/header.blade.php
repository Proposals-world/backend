<style>

</style>
<header class="header-area">
    <div id="" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="{{ route('welcome') }}">
                                <img src="{{ asset('frontend/img/logo/proposals-logo-removebg-preview.png') }}" style="width: 170px;" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="responsive d-lg-none"><i class="icon dripicons-align-right"></i></div>
                        <div class="main-menu text-right text-xl-right">
                             <nav id="mobile-menu">
                                <ul id="header-ul">
                                    <div></div>
                                    {{-- <li><a href="{{ url('/') }}" style="{{ app()->getLocale() === 'ar' ? 'color: #ff3494;' : '' }}">{{ __('header.home') }}</a></li> --}}
                                    <li ><a href="{{ route('about-us') }}">{{ __('header.about_us') }}</a></li>
                                    <li><a href="{{ url('/') }}#features">{{ __('header.features') }}</a></li>
                                    <li><a href="{{ url('/') }}#blog">{{ __('header.blog') }}</a></li>
                                    <li><a href="{{ url('/') }}#pricing">{{ __('header.pricing') }}</a></li>
                                    <li><a href="{{ url('/') }}#contact">{{ __('header.contact') }}</a></li>
                                    @auth
                                        <li><a href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('header.logout') }}
                                        </a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        <li><a href="{{ route('login') }}">{{ __('header.login') }}</a></li>
                                    @endauth
                                    <li class="d-lg-none"><a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                                        style="color: gray; font-size: 16px; text-decoration: none;">
                                        {{ __('header.language_switcher') }}
                                    </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 text-right d-none d-xl-block">
                        <div class="header-btn second-header-btn">
                            <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                                style="color: white; font-size: 16px; text-decoration: none;">
                                {{ __('header.language_switcher') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

