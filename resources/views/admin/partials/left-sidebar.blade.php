<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.html" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{asset('admin/assets/images/proposals-logo.jpeg')}}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{asset('admin/assets/images/proposals-logo.jpeg')}}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{asset('admin/assets/images/proposals-logo.jpeg')}}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{asset('admin/assets/images/proposals-logo.jpeg')}}" alt="small logo">
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
            <a href="pages-profile.html" class="d-flex align-items-center text-reset">
                <div class="flex-shrink-0">
                    <img src="{{asset('admin/assets/images/users/avatar-1.jpg')}}" alt="user-image" height="42" class="rounded-circle shadow">
                </div>
                <div class="flex-grow-1 ms-2">
                    <span class="fw-semibold fs-15 d-block">Doris Larson</span>
                    <span class="fs-13">Founder</span>
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
                <a href="{{route('dashboard')}}" class="side-nav-link">
                    <i class="ri-dashboard-2-fill"></i>
                    <span class="badge bg-success float-end" style="background-color: #9e086c !important;">9+</span>
                    <span> Dashboard </span>
                </a>
            </li>

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
                <a data-bs-toggle="collapse" href="#sidebarSubscriptions" aria-expanded="false" aria-controls="sidebarSubscriptions" class="side-nav-link">
                    <i class="ri-user-location-fill"></i>
                    <span> Subscriptions </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSubscriptions">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{route('subscription-packages.index')}}" class="side-nav-link">
                                <span> Subscription Packages </span>
                            </a>
                        </li>
                        {{-- <li class="side-nav-item">
                            <a href="{{route('features.index')}}" class="side-nav-link">
                                <span> Features </span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEducation" aria-expanded="false" aria-controls="sidebarEducation" class="side-nav-link">
                    <i class="ri-user-location-fill"></i>
                    <span> Education </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEducation">
                    <ul class="side-nav-second-level">
                        {{-- <li class="side-nav-item">
                            <a href="{{route('educational-levels.index')}}" class="side-nav-link">
                                <span> Educational Levels </span>
                            </a>
                        </li> --}}
                        <li class="side-nav-item">
                            <a href="{{route('specializations.index')}}" class="side-nav-link">
                                <span> Specializations </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPerson" aria-expanded="false" aria-controls="sidebarPerson" class="side-nav-link">
                    <i class="ri-user-location-fill"></i>
                    <span> Person </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPerson">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{route('origins.index')}}" class="side-nav-link">
                                <span> Origins </span>
                            </a>
                        </li>
                        {{-- <li class="side-nav-item">
                            <a href="{{route('sports-activities.index')}}" class="side-nav-link">
                                <span> Sports Activities </span>
                            </a>
                        </li> --}}
                        <li class="side-nav-item">
                            <a href="{{route('marriage-budgets.index')}}" class="side-nav-link">
                                <span> Marriage Budgets </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('religions.index')}}" class="side-nav-link">
                                <span> Religions </span>
                            </a>
                        </li>
                        {{-- <li class="side-nav-item">
                            <a href="{{route('hair-colors.index')}}" class="side-nav-link">
                                <span> Hair Colors </span>
                            </a>
                        </li> --}}
                        <li class="side-nav-item">
                            <a href="{{route('pets.index')}}" class="side-nav-link">
                                <span> Pets </span>
                            </a>
                        </li>
                        {{-- <li class="side-nav-item">
                            <a href="{{route('drinking-statuses.index')}}" class="side-nav-link">
                                <span> Drinking Statuses </span>
                            </a>
                        </li> --}}
                        <li class="side-nav-item">
                            <a href="{{route('hobbies.index')}}" class="side-nav-link">
                                <span> Hobbies </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
