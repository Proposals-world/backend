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
                        <i class="iconsminds-box-with-folders"></i>Your Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('desired') }}">
                        <i class="iconsminds-handshake"></i> Desired Partner characteristics
                    </a>
                </li>
                <li>
                    <a href="#applications">
                        <i class="iconsminds-male-female"></i> Find A Match
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
                        <i class="iconsminds-box-with-folders"></i>Subscription Packages
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="applications">
                <li>
                    <a href="Apps.MediaLibrary.html">
                        <i class="simple-icon-picture"></i> <span>Gallery</span>
                    </a>
                </li>
                <li>
                    <a href="Apps.Todo.List.html">
                        <i class="simple-icon-list"></i> <span>Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="Apps.Survey.List.html">
                        <i class="simple-icon-notebook"></i> <span>Surveys</span>
                    </a>
                </li>
                <li>
                    <a href="Apps.Chat.html">
                        <i class="simple-icon-speech"></i> <span>Messages</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
