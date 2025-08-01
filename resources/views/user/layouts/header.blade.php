<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" style="fill: rgb(146, 44, 136);
">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>

    </div>


    <a class="navbar-logo" href="">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="navbar-right">
        <div class="user d-inline-block">
            <button class="btn btn-empty p-2 bg-white border border-primary shadow" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-gray small">{{ Auth::user() ? Auth::user()->first_name : __('userDashboard.header.guest') }}</span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="{{ route('user.profile') }}">{{ __('userDashboard.header.profile') }}</a>
                <a class="dropdown-item" href="{{ route('user.support') }}">{{ __('userDashboard.header.support') }}</a>

                <a class="dropdown-item" href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}">
                    {{ __('header.language_switcher') }}
                </a>
          @auth
            <a class="dropdown-item" href="{{ route('password.change') }}">
                {{ __('userDashboard.header.Change Password') }}
            </a>
            @endauth
            <a class="dropdown-item" href="{{ route('account.delete.confirm') }}">
                {{ __('userDashboard.header.delete_account') }}
            </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('userDashboard.header.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
