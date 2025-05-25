<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <img src="{{ asset('dashboard/logos/menu-button.png') }}" alt="Menu Button" style="width: auto; height: 25px; margin-bottom: 8px; vertical-align: middle;">
                        <span>{{ __('userDashboard.sidebar.main_menu') }}</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('desired') ? 'active' : '' }}">
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
                        <img src="{{ asset('dashboard/logos/heart-half-stroke.png') }}" alt="Half Match" style="width: auto; height: 25px; margin-bottom: 8px; vertical-align: middle;">
                        {{ __('userDashboard.sidebar.half_match') }}
                    </a>
                </li>
                <li class="{{ request()->routeIs('matches') ? 'active' : '' }}">
                    <a href="{{ route('matches') }}">
                        <img src="{{ asset('dashboard/logos/full-heart.png') }}" alt="Full Heart" style="width: auto; height: 35px; margin-bottom: 8px; vertical-align: middle;">
                        {{ __('userDashboard.sidebar.matches') }}
                    </a>
                </li>
                <li class="{{ request()->routeIs('user.pricing') ? 'active' : '' }}">
                    <a href="{{ route('user.pricing') }}">
                        <i class="iconsminds-box-with-folders"></i>
                        {{ __('userDashboard.sidebar.subscription') }}
                    </a>
                </li>
                  <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <a href="{{ route('user.profile') }}">
                        <i class="iconsminds-box-with-folders"></i>
                        {{ __('userDashboard.sidebar.profile') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @yield('sidebar-filters')
</div>
