<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('dashboard/logos/tolba.png') }}" style="width: 74px; height: 74px;" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('dashboard/logos/tolba.png') }}" style="width: 74px; height: 74px;" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('dashboard/logos/tolba.png') }}" style="width: 74px; height: 74px;" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('dashboard/logos/tolba.png') }}" style="width: 74px; height: 74px;" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user p-3 text-white">
            <a  class="d-flex align-items-center text-reset">
                <div class="flex-shrink-0">
                    <img src="{{ asset('dashboard/logos/tolba.png') }}" style="background-color: #f8f9fa;" alt="user-image" height="42"
                        class="rounded-circle shadow">
                </div>
                <div class="flex-grow-1 ms-2">
                    <span class="fw-semibold fs-15 d-block">{{ Auth::user()->first_name ?? 'Admin' }} </span>
                </div>
                <div class="ms-auto">
                    <i class="ri-arrow-right-s-fill fs-20"></i>
                </div>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title mt-1"> Main</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-2-fill"></i>
                    <span class="badge bg-success float-end" style="background-color: #9e086c !important;">9+</span>
                    <span> Dashboard </span>
                </a>

            </li>
            {{-- Example: Display sessionId from getSessionId() --}}
            @php
                $sessionId = app('App\Services\WhatsAppContactService')->getSessionId();
            @endphp
            @if($sessionId)

                <li class="side-nav-item">
                   <a href="{{ route('admin.whatsapp.qr.code') }}" class="side-nav-link">
                    <i class="ri-whatsapp-fill"></i>
                        <span class="badge bg-success float-end" style="background-color: green !important;padding: 2px 6px;">
                            <i class="ri-check-line"></i>
                        </span>
                        <span> Whatsapp </span>
                    </a>
                </li>
                @else
                <li class="side-nav-item">
                   <a href="{{ route('admin.whatsapp.qr.code') }}" class="side-nav-link">
                    <i class="ri-whatsapp-fill"></i>
                        <span class="badge bg-success float-end" style="background-color: red !important; font-size: 10px; padding: 2px 6px;">
                            <i class="ri-close-line"></i>
                        </span>
                        <span> Whatsapp </span>
                    </a>
                </li>
            @endif

            <li class="side-nav-title mt-2">Managment</li>
            {{--
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLocations" aria-expanded="false" aria-controls="sidebarLocations" class="side-nav-link">
                    <i class="ri-user-location-fill"></i>
                    <span> Locations </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLocations">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{route('countries.index')}}" class="side-nav-link">
                                <span> Countries </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('cities.index')}}" class="side-nav-link">
                                <span> Cities </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLocations" aria-expanded="false" aria-controls="sidebarLocations" class="side-nav-link">
                    <i class="ri-user-location-fill"></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLocations">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{route('admins.index')}}" class="side-nav-link">
                                <i class="ri-admin-line"></i>
                                <span> Admins </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('manageUsers.index')}}" class="side-nav-link">
                                <i class="ri-user-3-line"></i>
                                <span> Customers </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('reports.index')}}" class="side-nav-link">
<i class="ri-file-chart-line"></i>
                                <span> Customer Reports </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('feedback.index')}}" class="side-nav-link">
                                <i class="ri-feedback-line"></i>
                                <span> Customer Feedback </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.suspended-users.index')}}" class="side-nav-link">
                            <i class="ri-user-unfollow-line"></i>
                                <span> Suspended Users </span>
                            </a>
                        </li>
                        {{-- <li class="side-nav-item">
                            <a href="" class="side-nav-link">
                                <span> Cities </span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLocationsBlogs" aria-expanded="false"
                    aria-controls="sidebarLocations" class="side-nav-link">
                    <i class="ri-newspaper-line"></i>
                    <span> Blogs </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLocationsBlogs">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('blogs.index') }}" class="side-nav-link">
                                <i class="ri-article-line"></i>
                                <span> Blogs </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('categories.index') }}" class="side-nav-link">
                                <i class="ri-list-unordered"></i>
                                <span> Categories </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSubscriptions" aria-expanded="false"
                    aria-controls="sidebarSubscriptions" class="side-nav-link">
                    <i class="ri-vip-crown-line"></i>
                    <span> Subscriptions </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSubscriptions">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('subscription-packages.index') }}" class="side-nav-link">
                                <i class="ri-vip-diamond-line"></i>
                                <span> Subscription Packages </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.user.payments.index') }}" class="side-nav-link">
                                <i class="ri-wallet-line"></i>
                                <span> User Payments </span>
                            </a>
                        </li>
                           <li class="side-nav-item">
                <a href="{{ route('admin.redeem.index') }}" class="side-nav-link">
                    <i class="ri-gift-line"></i>
                    <span> Redeems </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.payments.index') }}" class="side-nav-link">
                    <i class="ri-bank-card-line"></i>
                    <span> Payments Transactions </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.monthly-subscription-sales.index') }}" class="side-nav-link">
                    <i class="ri-bank-card-line"></i>
                    <span> Monthly Sales Report </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.yearly-subscription-sales.index') }}" class="side-nav-link">
                    <i class="ri-bank-card-line"></i>
                    <span> Yearly Sales Report </span>
                </a>
            </li>
                    </ul>
                </div>
            </li>

            {{-- <li class="side-nav-item">
                <a href="{{route('features.index')}}" class="side-nav-link">
                    <span> Features </span>
                </a>
            </li> --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEducation" aria-expanded="false"
                    aria-controls="sidebarEducation" class="side-nav-link">
                    <i class="ri-book-line"></i>
                    <span> Education </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEducation">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('specializations.index') }}" class="side-nav-link">
                                <i class="ri-bookmark-line"></i>
                                <span> Specializations </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('job-titles.index') }}" class="side-nav-link">
                                <i class="ri-briefcase-4-line"></i>
                                <span> Job Domain </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="side-nav-item">
                <a href="{{route('educational-levels.index')}}" class="side-nav-link">
                    <span> Educational Levels </span>
                </a>
            </li> --}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPerson" aria-expanded="false" aria-controls="sidebarPerson"
                    class="side-nav-link">
                    <i class="ri-user-3-line"></i>
                    <span> Customer Info </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPerson">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('origins.index') }}" class="side-nav-link">
                                <i class="ri-map-pin-line"></i>
                                <span> Origins </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('marriage-budgets.index') }}" class="side-nav-link">
                                <i class="ri-money-dollar-circle-line"></i>
                                <span> Marriage Budgets </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('religions.index') }}" class="side-nav-link">
                                <i class="ri-heart-2-line"></i>
                                <span> Religions </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('pets.index') }}" class="side-nav-link d-flex align-items-center">
                                <img width="16px" style="margin-left: 7px;" class="me-2"
                                    src="{{ asset('admin/assets/images/svg/paw-solid.svg') }}" alt="">
                                <span> Pets </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('hobbies.index') }}" class="side-nav-link">
                                <i class="ri-paint-brush-line"></i>
                                <span> Hobbies </span>
                            </a>
                        </li>

                        {{-- <li class="side-nav-item">
                            <a href="{{route('sports-activities.index')}}" class="side-nav-link">
                                <span> Sports Activities </span>
                            </a>
                        </li> --}}
                        {{-- <li class="side-nav-item">
                            <a href="{{route('hair-colors.index')}}" class="side-nav-link">
                                <span> Hair Colors </span>
                            </a>
                        </li> --}}
                        {{-- <li class="side-nav-item">
                            <a href="{{route('drinking-statuses.index')}}" class="side-nav-link">
                                <span> Drinking Statuses </span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarManagement" aria-expanded="false" aria-controls="sidebarManagement" class="side-nav-link">
                    <i class="ri-settings-3-line"></i>
                        <span> Management </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarManagement">  <!-- Changed ID here -->
                    <ul class="side-nav-second-level">


                        <li class="side-nav-item">
                            <a href="{{route('faqs.index')}}" class="side-nav-link">
                                <i class="ri-question-line"></i>
                                <span> Manage FAQs </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.support') }}" class="side-nav-link">
                    <i class="ri-heart-2-line"></i>
                    <span> Support </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.contact-messages.index') }}" class="side-nav-link">
                    <i class="ri-mail-line"></i>
                    <span> Contact Messages </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.success-stories.index') }}" class="side-nav-link">
                    <i class="ri-trophy-line"></i>
                    <span> Success Stories </span>
                </a>
            </li>


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
