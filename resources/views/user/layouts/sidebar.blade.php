<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="iconsminds-shop-2"></i>
                        <span>{{ __('userDashboard.sidebar.main_menu') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">
                        <i class="iconsminds-box-with-folders"></i>
                        {{ __('userDashboard.sidebar.profile') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('desired') }}">
                        <i class="iconsminds-handshake"></i>
                        {{ __('userDashboard.sidebar.desired_partner') }}
                    </a>
                </li>
                <li id="findMatchItem" class="match-item {{ request()->routeIs('find-match') ? 'active' : '' }}">
                    <a href="{{ route('find-match') }}" class="main-menu-link">
                        <img src="{{ asset('dashboard/logos/rings.png') }}" alt="Find A Match"
                             style="width: auto; height: 40px; vertical-align: middle;">
                        <span>{{ __('userDashboard.sidebar.find_match') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('liked-me') ? 'active' : '' }}">
                    <a href="{{ route('liked-me') }}">
                        <i class="iconsminds-heart"></i>
                        {{ __('userDashboard.sidebar.half_match') }}
                    </a>
                </li>
                <li class="{{ request()->routeIs('matches') ? 'active' : '' }}">
                    <a href="{{ route('matches') }}">
                        <i class="iconsminds-male-female"></i>
                        {{ __('userDashboard.sidebar.matches') }}
                    </a>
                </li>
                <li class="{{ request()->routeIs('user.pricing') ? 'active' : '' }}">
                    <a href="{{ route('user.pricing') }}">
                        <i class="iconsminds-box-with-folders"></i>
                        {{ __('userDashboard.sidebar.subscription') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @yield('sidebar-filters')
</div>