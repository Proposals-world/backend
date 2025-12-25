<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" style="fill: rgb(146, 44, 136);">
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
@if(empty(auth()->user()->profile->educational_level_id) || empty(auth()->user()->profile->employment_status))
        <!-- Enhanced Alert Notification with Click Action -->
        <a href="{{ route('onboarding.complete') }}" class="alert-notification position-relative mr-3 text-decoration-none"
           data-toggle="tooltip"
           data-html="true"
           data-placement="bottom"
           title="{!! __('onboarding.complete_profile_tooltip') !!}">
            <div class="alert-badge-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 36 36" class="alert-icon">
                    <!-- Outer circle with gradient -->
                    <defs>
                        <linearGradient id="alertGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#ff6b6b;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#ff8e8e;stop-opacity:1" />
                        </linearGradient>
                        <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(255,107,107,0.3)" />
                        </filter>
                    </defs>

                    <!-- Animated pulse circle -->
                    <circle cx="18" cy="18" r="16" fill="url(#alertGradient)" filter="url(#shadow)" class="pulse-circle"/>

                    <!-- Inner circle -->
                    <circle cx="18" cy="18" r="14" fill="#ff6b6b" class="alert-circle"/>

                    <!-- Exclamation mark -->
                    <text x="18" y="24" text-anchor="middle" font-size="16" font-weight="bold" fill="white" class="exclamation">!</text>

                    <!-- Optional: Add a subtle ring for more visibility -->
                    <circle cx="18" cy="18" r="15.5" fill="none" stroke="rgba(255,107,107,0.3)" stroke-width="1" class="outer-ring"/>
                </svg>

                <!-- Optional badge count (if you want to show number of incomplete items) -->
                <!-- <span class="alert-badge">1</span> -->
            </div>
        </a>
@endif
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

<style>
.alert-notification {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.alert-notification:hover {
    transform: translateY(-2px);
}

.alert-badge-container {
    position: relative;
    display: inline-block;
}

.alert-icon {
    filter: drop-shadow(0 4px 8px rgba(255, 107, 107, 0.25));
    transition: all 0.3s ease;
}

.alert-notification:hover .alert-icon {
    filter: drop-shadow(0 6px 12px rgba(255, 107, 107, 0.35));
    transform: scale(1.1);
}

/* Pulse animation for attention */
@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes gentle-pulse {
    0%, 100% {
        r: 16;
        opacity: 0.7;
    }
    50% {
        r: 17;
        opacity: 0.9;
    }
}

.pulse-circle {
    animation: gentle-pulse 2s ease-in-out infinite;
}

.alert-circle {
    transition: fill 0.3s ease;
}

.alert-notification:hover .alert-circle {
    fill: #ff5252;
}

.exclamation {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-weight: 700;
    user-select: none;
}

/* Enhanced tooltip styling */
.tooltip-inner {
    max-width: 280px;
    padding: 12px 16px;
    text-align: center;
    background: linear-gradient(135deg, #a5349a 0%, #764ba2 100%);
    color: white;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    border: none;
}

.tooltip.bs-tooltip-bottom .arrow::before {
    border-bottom-color: #922c88;
}

/* Optional badge for count */
.alert-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff4757;
    color: white;
    font-size: 10px;
    font-weight: bold;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    animation: pulse 1.5s infinite;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .alert-icon {
        width: 28px;
        height: 28px;
    }

    .alert-notification {
        margin-right: 1rem;
    }
}

/* Accessibility: focus styles */
.alert-notification:focus {
    outline: 2px solid #922c88;
    outline-offset: 3px;
    border-radius: 50%;
}

/* Optional: Add a subtle bounce animation on page load */
@keyframes bounceIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    60% {
        transform: scale(1.1);
        opacity: 1;
    }
    100% {
        transform: scale(1);
    }
}

.alert-badge-container {
    animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
</style>

<!-- Initialize Bootstrap tooltips if needed -->
<script>
// Only needed if you're not already initializing tooltips globally
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip({
        delay: { "show": 300, "hide": 100 }
    });

    // Add click animation
    $('.alert-notification').on('click', function(e) {
        // Add a click feedback animation
        $(this).find('.alert-icon').css({
            'transform': 'scale(0.9)',
            'transition': 'transform 0.1s ease'
        });

        setTimeout(() => {
            $(this).find('.alert-icon').css({
                'transform': 'scale(1.1)',
                'transition': 'transform 0.3s ease'
            });
        }, 100);
    });
});
</script>
