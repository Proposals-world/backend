<!-- ========== Topbar Start ========== -->
    <style>
        .notification-list .notify-item .notify-details {
    margin-bottom: 0px;
    margin-left: 10px;
    overflow: hidden;
}
    </style>
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ route('dashboard') }}" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('admin/assets/images/logo.png')}}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="{{ route('dashboard') }}" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('admin/assets/images/tolba.png')}}" alt="dark logo" >
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('admin/assets/images/tolba.png')}}" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="ri-menu-2-fill"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <!-- Topbar Search Form -->
            <div class="app-search dropdown d-none d-lg-block">

                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h5 class="text-overflow mb-1">Found <b class="text-decoration-underline">08</b> results</h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="ri-file-chart-line fs-16 me-1"></i>
                        <span>Analytics Report</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="ri-lifebuoy-line fs-16 me-1"></i>
                        <span>How can I help you?</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="ri-user-settings-line fs-16 me-1"></i>
                        <span>User profile settings</span>
                    </a>

                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow mt-2 mb-1 text-uppercase">Users</h6>
                    </div>

                    <div class="notification-list" >
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="d-flex">
                                <img class="d-flex me-2 rounded-circle" src="{{asset('admin/assets/images/users/avatar-2.jpg')}}" alt="Generic placeholder image" height="32">
                                <div class="w-100">
                                    <h5 class="m-0 fs-14">Erwin Brown</h5>
                                    <span class="fs-12 mb-0">UI Designer</span>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="d-flex">
                                <img class="d-flex me-2 rounded-circle" src="{{asset('admin/assets/images/users/avatar-5.jpg')}}" alt="Generic placeholder image" height="32">
                                <div class="w-100">
                                    <h5 class="m-0 fs-14">Jacob Deo</h5>
                                    <span class="fs-12 mb-0">Developer</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown d-lg-none">
<a class="nav-link dropdown-toggle arrow-none"
   data-bs-toggle="dropdown"
   data-bs-auto-close="outside"
   href="#"
   role="button">
                    <i class="ri-search-line fs-22"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>


            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-fill fs-22"></i>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-fill fs-22"></i>
                </div>
            </li>


            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line fs-22"></i>
                </a>
            </li>
            @php
    $notifs = Auth::user()?->appNotifications()
        ->latest()
        // ->take(8)
        ->get();

    $unreadCount = Auth::user()?->appNotifications()
        ->where('is_read', false)
        ->count();
@endphp

<li class="dropdown notification-list" >
  <a class="nav-link dropdown-toggle arrow-none"
   data-bs-toggle="dropdown"
   data-bs-auto-close="outside"
   href="#" role="button" aria-haspopup="false" aria-expanded="false">

    <span class="position-relative d-inline-block">
        <i class="ri-notification-3-line fs-22"></i>

        @if($unreadCount > 0)
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger
                       d-flex align-items-center justify-content-center"
                style="min-width:18px;height:18px;font-size:11px;line-height:1;"
            >
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </span>
</a>



    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">
        <div class="dropdown-header noti-title px-3 py-2 border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Notifications</h5>

                @if($unreadCount > 0)
                    <button class="btn btn-sm btn-outline-secondary"
                            onclick="markAllNotificationsRead(event)">
                        Mark all read
                    </button>
                @endif
            </div>

            @if($unreadCount > 0)
                <small class="text-muted">You have {{ $unreadCount }} unread notification(s)</small>
            @else
                <small class="text-muted">You’re all caught up 🎉</small>
            @endif
        </div>

        <div class="notification-list" style="overflow-y: auto; overflow-x: hidden; max-height: 500px;  ">
            @forelse($notifs as $n)
                @php
                    // icon per type (adjust types you use)
                    $icon = match($n->notification_type) {
                        'new_user_report' => 'ri-flag-2-line',
                        'new_cliq_payment', 'fintesa_payment_webhook' => 'ri-bank-card-line',
                        'account_suspended' => 'ri-user-forbid-line',
                        default => 'ri-notification-3-line',
                    };

                    $bg = $n->is_read ? 'bg-light' : 'bg-soft-primary';
                @endphp

           <a href="javascript:void(0);"
   class="dropdown-item notify-item px-3 py-2 {{ $n->is_read ? '' : 'unread' }}"
   data-notification-id="{{ $n->id }}">

    <div class="d-flex align-items-start gap-2">

        {{-- Icon --}}
        <div class="flex-shrink-0 mt-1">
            <div class="notify-icon rounded-circle d-flex align-items-center justify-content-center {{ $bg }}"
                 style="width:38px;height:38px;">
                <i class="{{ $icon }} fs-18 text-primary"></i>
            </div>
        </div>

        {{-- Content --}}
        <div class="flex-grow-1">

            <p class="mb-1 fw-semibold text-wrap">
                {{ $n->content_en ?? 'Notification' }}
            </p>

            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    {{ $n->created_at?->diffForHumans() }}
                </small>

                @if(!$n->is_read)
                    <button type="button"
                        class="btn btn-link p-0 small text-primary mark-read-btn"
                        data-notification-id="{{ $n->id }}">
                        Mark as read
                    </button>
                @endif
            </div>

        </div>
    </div>
</a>


            @empty
                <div class="p-4 text-center text-muted">
                    <i class="ri-inbox-2-line fs-28 mb-2 d-block"></i>
                    No notifications yet
                </div>
            @endforelse
        </div>

        {{-- <div class="p-2 border-top text-center">
            <a href="{{ route('admin.notifications.index') }}" class="text-decoration-none">
                View all
                <i class="ri-arrow-right-s-line"></i>
            </a>
        </div> --}}
    </div>
</li>

            <li class="dropdown me-md-2">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{asset('dashboard/logos/tolba.png')}}" style="background: #f8f9fa;" alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0">{{ Auth::user()->first_name ?? 'Guest' }}</h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome {{ Auth::user()->first_name ?? 'Admin' }}!</h6>
                    </div>

                    {{-- <!-- item-->
                    <a href="#" class="dropdown-item">
                        <i class="ri-account-circle-fill align-middle me-1"></i>
                        <span>My Account</span>
                    </a> --}}



                    <!-- item-->
                    {{-- <a href="pages-faq.html" class="dropdown-item">
                        <i class="ri-customer-service-2-fill align-middle me-1"></i>
                        <span>Support</span>
                    </a> --}}

                    {{-- <!-- item-->
                    <a href="auth-lock-screen.html" class="dropdown-item">
                        <i class="ri-lock-password-fill align-middle me-1"></i>
                        <span>Lock Screen</span>
                    </a> --}}

                    <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-fill align-middle me-1"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // helper: update UI after marking as read
    function markReadUI(item) {
        item.classList.remove('unread');

        // remove the "Mark as read" button (if exists)
        item.querySelector('.mark-read-btn')?.remove();

        // update counter badge
        const badge = document.querySelector('.noti-icon-badge');
        if (badge) {
            let count = parseInt(badge.innerText);
            if (!isNaN(count) && count > 1) {
                badge.innerText = count - 1;
            } else {
                badge.remove();
            }
        }
    }

    // ✅ MARK AS READ BUTTON ONLY
    document.querySelectorAll('.mark-read-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation(); // 🔥 IMPORTANT: prevent <a> click

            const id = this.dataset.notificationId;
            if (!id) return;

            const item = this.closest('.notify-item');
            if (!item || !item.classList.contains('unread')) return;

            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',

                    'Accept': 'application/json'
                }
            }).then(() => {
                markReadUI(item);
            });
        });
    });

    // ✅ OPTIONAL: clicking the notification itself marks it read
    document.querySelectorAll('.notify-item').forEach(item => {
        item.addEventListener('click', function (e) {

            // if clicked mark-read button, ignore (already handled)
            if (e.target.closest('.mark-read-btn')) return;

            if (!this.classList.contains('unread')) return;

            const id = this.dataset.notificationId;
            if (!id) return;

            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(() => {
                markReadUI(this);
            });
        });
    });

});

// ✅ MARK ALL AS READ
function markAllNotificationsRead(e) {
    e.preventDefault();

    fetch('/notifications/read-all', {
        method: 'POST',
        headers: {
'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => {
        document.querySelectorAll('.notify-item.unread').forEach(item => {
            item.classList.remove('unread');
            item.querySelector('.mark-read-btn')?.remove();
        });

        document.querySelector('.noti-icon-badge')?.remove();
    });
}


</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.notification-list').forEach(drop => {
    drop.addEventListener('hide.bs.dropdown', function (e) {
      // Bootstrap 5 provides clickEvent when hide happens due to click
      const clickEvent = e.clickEvent;
      if (clickEvent && drop.querySelector('.dropdown-menu')?.contains(clickEvent.target)) {
        e.preventDefault(); // ✅ don't close if clicked inside
      }
    });
  });
});
</script>

@endpush
<!-- ========== Topbar End ========== -->
