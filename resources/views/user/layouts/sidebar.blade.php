<!-- resources/views/user/layouts/sidebar.blade.php -->
<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="iconsminds-shop-2"></i>
                        <span>Main Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">
                        <i class="iconsminds-box-with-folders"></i> Your Profile
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="iconsminds-handshake"></i> Desired Partner characteristics
                    </a>
                </li>
                <li id="findMatchItem" class="match-item {{ request()->routeIs('find-match') ? 'active' : '' }}">
                    <a href="{{ route('find-match') }}" class="main-menu-link">
                        <img src="{{ asset('dashboard/logos/rings.png') }}" alt="Find A Match"
                             style="width: auto; height: 40px; vertical-align: middle;">
                        <span>Find A Match</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('liked-me') ? 'active' : '' }}">
                    <a href="{{ route('liked-me') }}">
                        <i class="iconsminds-heart"></i> Half Match
                    </a>
                </li>
                <li class="{{ request()->routeIs('matches') ? 'active' : '' }}">
                    <a href="{{ route('matches') }}">
                        <i class="iconsminds-male-female"></i> Matches
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="iconsminds-box-with-folders"></i> Subscription Packages
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- This is where child views can inject something into the sidebar -->
    @yield('sidebar-filters')
</div>