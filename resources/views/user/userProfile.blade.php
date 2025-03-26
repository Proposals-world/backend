@extends('user.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="mb-2">
                <h1>{{ ucfirst($userProfile['first_name']) .' '. ucfirst($userProfile['last_name']) }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button"
                        class="btn btn-lg btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ACTIONS
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                    </div>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
            </div>


            <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                        aria-controls="first" aria-selected="true">PROFILE</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                        aria-controls="second" aria-selected="false">My Likes</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                    <div class="row">
                        <div class="col-12 col-lg-5 col-xl-4 col-left">
                            <div class="card mb-4">
                                <div class="position-absolute card-top-buttons">
                                    <button class="btn btn-outline-white icon-button ">
                                        <i class="simple-icon-pencil"></i>
                                    </button>
                                </div>
                                <img src="{{ asset(optional($userProfile['profile']['photos']->where('is_main', true)->first())['photo_url'] ?? 'default-profile.png') }}"
                                    alt="{{ $userProfile['first_name'] . ' ' . $userProfile['last_name'] }}"
                                    class="card-img-top" />




                                <div class="card-body">
                                    <p class="text-muted text-small mb-2">Bio</p>
                                    <p class="mb-3">
                                        {{ $userProfile['profile']['bio'] ?? 'N/A' }}
                                    </p>

                                    <p class="text-muted text-small mb-2">Location</p>
                                    <p class="mb-3">{{ $userProfile['profile']['country_of_residence'] . ' , ' .  $userProfile['profile']['city'] }}</p>
                                    <p class="text-muted text-small mb-2">Hobbies</p>
                                    <p class="mb-3">
                                        @if (!empty($userProfile['profile']['hobbies']))
                                            @foreach ($userProfile['profile']['hobbies'] as $hobby)
                                                <a href="#">
                                                    <span class="badge badge-pill badge-outline-theme-2 mb-1">{{ $hobby }}</span>
                                                </a>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No hobbies available</span>
                                        @endif
                                    </p>
                                    <p class="text-muted text-small mb-2">Pets</p>
                                    <p class="mb-3">
                                        @if (!empty($userProfile['profile']['pets']))
                                            @foreach ($userProfile['profile']['pets'] as $pet)
                                                <a href="#">
                                                    <span class="badge badge-pill badge-outline-theme-2 mb-1">{{ $pet }}</span>
                                                </a>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No pets available</span>
                                        @endif
                                    </p>

                                    @if ($userProfile['profile']['smoking_status'] == true)
                                    <p class="text-muted text-small mb-2">Smoking Tools</p>
                                    <p class="mb-3">
                                        @foreach ($userProfile['profile']['smoking_tools'] ?? [] as $tool)
                                            <a href="#">
                                                <span class="badge badge-pill badge-outline-theme-2 mb-1">{{ $tool }}</span>
                                            </a>
                                        @endforeach
                                    </p>
                                @endif
{{--
                                    <p class="text-muted text-small mb-2">Contact</p>
                                    <div class="social-icons">
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">
                                                <a href="#"><i class="simple-icon-social-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#"><i class="simple-icon-social-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#"><i class="simple-icon-social-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card mb-4 d-none d-lg-block">
                                <div class="position-absolute card-top-buttons">
                                    <button class="btn btn-header-light icon-button">
                                    </button>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Matches</h5>
                                    <div>
                                        @foreach($matches as $match)
                                        <div class="d-flex flex-row mb-3">
                                            <a class="d-block position-relative" href="#">
                                                <!-- Check if the matched user's photo is available -->
                                                <img src="{{ asset($match['matched_user_photo'] ?? 'default-profile.png') }}"
                                                     alt="{{ $match['matched_user_name'] }}"
                                                     class="list-thumbnail border-0" />
                                            </a>
                                            <div class="pl-3 pt-2 pr-2 pb-2">
                                                <a href="#">
                                                    <p class="list-item-heading">{{ $match['matched_user_name'] }}</p>
                                                    <p class="text-muted">Age: {{ $match['matched_user_age'] }} | City: {{ $match['matched_user_city'] }}</p>
                                                    <p>Phone: {{ $match['matched_user_phone'] }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach



                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-7 col-xl-8 col-right">
                            <div class="row listing-card-container">
                                <div class="row">
                                    <!-- Personal Info Card -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-user"></i> Personal Info
                                                </h5>
                                                <div>
                                                    {{-- <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>ID Number:</strong> {{ $userProfile['profile']['id_number'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}

                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Nationality:</strong> {{ $userProfile['profile']['nationality'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Age:</strong> {{ $userProfile['profile']['age'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Zodiac Sign:</strong> {{ $userProfile['profile']['zodiac_sign'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Location Info Card -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-location-pin"></i> Location Info
                                                </h5>
                                                <div>
                                                    <!-- Nationality -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Nationality:</strong> {{ $userProfile['profile']['nationality'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Origin -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Origin:</strong> {{ $userProfile['profile']['origin'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Country of Residence -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Country of Residence:</strong> {{ $userProfile['profile']['country_of_residence'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- City -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>City:</strong> {{ $userProfile['profile']['city'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Employment & Financial Info Card -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-briefcase"></i> Employment & Financial Info
                                                </h5>
                                                <div>
                                                    <!-- Sector -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Sector:</strong> {{ $userProfile['profile']['sector'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Position Level -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Position Level:</strong> {{ $userProfile['profile']['position_level'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Job Title -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Job Title:</strong> {{ $userProfile['profile']['job_title'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                     <!-- Employment Status -->
                                                     <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Employment Status:</strong>
                                                            @if ($userProfile['profile']['employment_status'] ?? false)
                                                                <i class="simple-icon-check text-success"></i>
                                                            @else
                                                                <i class="simple-icon-close text-danger"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- Financial Status -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Financial Status:</strong> {{ $userProfile['profile']['financial_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Lifestyle & Habits -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-heart"></i> Lifestyle & Habits
                                                </h5>
                                                <div>
                                                    <!-- Car Ownership -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Car Ownership:</strong>
                                                            @if ($userProfile['profile']['car_ownership'] ?? false)
                                                                <i class="simple-icon-check text-success"></i>
                                                            @else
                                                                <i class="simple-icon-close text-danger"></i>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Smoking Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Smoking Status:</strong>
                                                            @if ($userProfile['profile']['smoking_status'] ?? false)
                                                                <i class="simple-icon-check text-success"></i>
                                                            @else
                                                                <i class="simple-icon-close text-danger"></i>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Drinking Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Drinking Status:</strong>
                                                            @if ($userProfile['profile']['drinking_status'] ?? false)
                                                                <i class="simple-icon-check text-success"></i>
                                                            @else
                                                                <i class="simple-icon-close text-danger"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- Sleep Habit -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Sleep Habit:</strong> {{ $userProfile['profile']['sleep_habit'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Sports Activity -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Sports Activity:</strong> {{ $userProfile['profile']['sports_activity'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-diamond"></i> Religion & Marriage
                                                </h5>
                                                <div>
                                                    <!-- Religiosity Level -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Religiosity Level:</strong> {{ $userProfile['profile']['religiosity_level'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Marriage Budget -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Marriage Budget:</strong> {{ $userProfile['profile']['marriage_budget'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Religion -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Religion:</strong> {{ $userProfile['profile']['religion'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    @if ($userProfile['gender'] === 'female')
                                                    <!-- Hijab Status -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                                <strong>Hijab Status:</strong> {{ $userProfile['profile']['hijab_status'] ?? 'N/A' }}
                                                            </div>
                                                        </div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Housing & Marital Status -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-home"></i> Housing & Marital
                                                </h5>
                                                <div>
                                                    <!-- Housing Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Housing Status:</strong> {{ $userProfile['profile']['housing_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Marital Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Marital Status:</strong> {{ $userProfile['profile']['marital_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Children -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Children:</strong> {{ $userProfile['profile']['children'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-heart"></i> Physical Appearance & Health
                                                </h5>
                                                <div>
                                                    <!-- Skin Color -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Skin Color:</strong> {{ $userProfile['profile']['skin_color'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Hair Color -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Hair Color:</strong> {{ $userProfile['profile']['hair_color'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <!-- Health Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Health Status:</strong> {{ $userProfile['profile']['health_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-shield"></i> Criminal Record
                                                </h5>
                                                <div>
                                                    <!-- Criminal Record -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Criminal Record:</strong> {{ $userProfile['profile']['criminal_record'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Record Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Record Status:</strong> {{ $userProfile['profile']['record_status'] ?? 'unverified' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Education -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-graduation"></i> Education
                                                </h5>
                                                <div>
                                                    <!-- Educational Level -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Educational Level:</strong> {{ $userProfile['profile']['educational_level'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Specialization -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Specialization:</strong> {{ $userProfile['profile']['specialization'] ?? 'N/A' }}
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($userProfile['gender'] === 'female')
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="card mb-3">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="iconsminds-network"></i> Guardian Contact && Social Media
                                                </h5>
                                                <div>
                                                    <!-- Contact (Encrypted) -->
                                                    <div class="d-flex flex-row mb-2">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Guardian Contact:</strong> {{ $userProfile['profile']['guardian_contact'] ?? 'None' }}
                                                        </div>
                                                    </div>
                                                    <!-- Social Media Presence -->
                                                    <div class="d-flex flex-row mb-2">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>Social Media Presence:</strong> {{ $userProfile['profile']['social_media_presence'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    @else
                                    <div class="col-lg-6 col-12 mb-3">
                                    <div class="card mb-3">
                                        <div class="position-absolute card-top-buttons">
                                            <button class="btn btn-header-light icon-button">
                                            </button>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="iconsminds-network"></i> Contact & Social Media
                                            </h5>
                                            <div>
                                                <!-- Contact (Encrypted) -->
                                                <div class="d-flex flex-row mb-2">
                                                    <div class="pl-3 pt-2 pr-2 pb-2">
                                                        <strong>Contact:</strong> {{ $userProfile['phone_number'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                                <!-- Social Media Presence -->
                                                <div class="d-flex flex-row mb-2">
                                                    <div class="pl-3 pt-2 pr-2 pb-2">
                                                        <strong>Social Media Presence:</strong> {{ $userProfile['profile']['social_media_presence'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                    @endif


                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                    <div class="row">
                        @foreach($likes as $like)
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card d-flex flex-row mb-4">
            <a class="d-flex" href="#">

                <!-- Display the profile image -->
                <img src="{{ asset(optional($like['liked_user']['photos']->firstWhere('is_main', 1))['url'] ?? 'default-profile.png') }}"
                alt="Profile"
                class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">

            </a>
            <div class="d-flex flex-grow-1 min-width-zero">
                <div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                        <a href="#">
                            <!-- Use optional() to safely access liked_user properties -->
                            <p class="list-item-heading mb-1 truncate">
                                {{-- {{ dd($like['liked_user']) }} --}}
                                {{ $like['liked_user']['first_name'] ?? '' }}
                                {{ $like['liked_user']['last_name'] ?? '' }}


                            </p>
                        </a>
                        <p class="mb-2 text-muted text-small">
                            {{ $like['liked_user']['email'] ?? '' }}
                        </p>
                        <button type="button" class="btn btn-xs btn-outline-primary">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach





                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>


@endsection
