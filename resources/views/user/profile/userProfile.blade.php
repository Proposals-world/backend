@extends('user.layouts.app')

@section('content')
{{-- {{ dd($userProfile) }} --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="mb-2">
                <h1>{{ ucfirst($userProfile['profile']['nickname'])  }}</h1>
                <div class="text-zero top-right-button-container">

                      <div id="update-container"></div>


                </div>



            <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                        aria-controls="first" aria-selected="true">{{ __('profile.profile') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                        aria-controls="second" aria-selected="false">{{ __('profile.My_Likes') }}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                    <div class="row">
                        <div class="col-12 col-lg-5 col-xl-4 col-left">
                            <div class="card mb-4">
                                <div class="position-absolute card-top-buttons">
                                        {{-- <button class="btn btn-outline-white icon-button ">
                                            <i class="simple-icon-pencil"></i>
                                        </button> --}}
                                </div>
                                <img src="{{ collect($userProfile['profile']['photos'])->firstWhere('is_main', 1)['photo_url'] ?? asset('default-profile.png') }}"
                                alt="{{ $userProfile['profile']['nickname']  }}"
                                class="card-img-top" />
                                {{-- <img src="{{ asset(optional($userProfile['profile']['photos']->firstWhere('is_main', 1))->photo_url ?? 'default-profile.png') }}"
                                alt="{{ $userProfile['first_name'] . ' ' . $userProfile['last_name'] }}"
                                class="card-img-top" /> --}}






                                <div class="card-body">
                                    <p class="text-muted text-small mb-2">{{ __('profile.Bio') }}</p>
                                    <p class="mb-3">
                                        {{ $userProfile['profile']['bio'] ?? 'N/A' }}
                                    </p>


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
                            {{-- <div class="card mb-4 d-none d-lg-block">
                                <div class="position-absolute card-top-buttons">
                                    <button class="btn btn-header-light icon-button">
                                    </button>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">{{ __('profile.Matches') }}</h5>
                                    <div style="max-height: 460px; overflow-y: auto;">
                                        @foreach($matches as $match)
                                        <div class="d-flex flex-row mb-3">
                                            <a class="d-block position-relative" href="#">
                                                <!-- Check if the matched user's photo is available -->
                                                <img src="{{ asset($match['matched_user_photo'] ?? 'default-profile.png') }}"
                                                alt="{{ $match['matched_user_nickname'] }}"
                                                class="list-thumbnail border-0"
                                                style="width: 100px; height: 100px; object-fit: cover;" />


                                            </a>
                                            <div class="pl-3 pt-2 pr-2 pb-2">
                                                <a href="#">
                                                    <p class="list-item-heading">{{ $match['matched_user_nickname'] }}</p>
                                                    <p class="text-muted">{{ __('profile.Age') }}: {{ $match['matched_user_age'] }} | {{ __('profile.City') }}: {{ $match['matched_user_city'] }}</p>
                                                    <p>{{ __('profile.Phone') }}: {{ $match['matched_user_phone'] }}</p>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                             {{-- <div class="col-lg-6 col-12 mb-4"> --}}
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-heart"></i> {{ __('profile.Physical_&_Health_Info') }}
                                                </h5>
                                                <div>
                                                    <!-- weight -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.weight') }}:</strong> {{ $userProfile['profile']['weight'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <!-- height -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.height') }}:</strong> {{ $userProfile['profile']['height'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <!-- Skin Color -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Skin_Color') }}:</strong> {{ $userProfile['profile']['skin_color'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Hair Color -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Hair_Color') }}:</strong> {{ $userProfile['profile']['hair_color'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <!-- Hair Color -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.eye_color') }}:</strong> {{ $userProfile['profile']['eye_color'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    {{-- <!-- Health Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Health_Status') }}:</strong> {{ $userProfile['profile']['health_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>

                                    {{-- </div> --}}
                        </div>

                        <div class="col-12 col-lg-7 col-xl-8 col-right">
                            <div class="row listing-card-container">
                                {{-- <div class="row"> --}}
                                    <!-- Personal Info & Location Info Card -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-user"></i> {{ __('profile.Personal_Info') }}
                                                </h5>
                                                <div>
                                                    {{-- <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>ID Number:</strong> {{ $userProfile['profile']['id_number'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}

                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Nationality') }}:</strong> {{ $userProfile['profile']['nationality'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Age') }}:</strong> {{ $userProfile['profile']['age'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                       <!-- Origin -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Origin') }}:</strong> {{ $userProfile['profile']['origin'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Country of Residence -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Country_of_Residence') }}:</strong> {{ $userProfile['profile']['country_of_residence'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- City -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.City') }}:</strong> {{ $userProfile['profile']['city'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    {{-- {{ dd($userProfile['profile']   ) }} --}}
                                                    <!-- city_location -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.city_location') }}:</strong> {{ $userProfile['profile']['city_location'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Zodiac_Sign') }}:</strong> {{ $userProfile['profile']['zodiac_sign'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <!-- Location Info Card -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-location-pin"></i> {{ __('profile.Location_Info') }}
                                                </h5>
                                                <div>


                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}


                                    <!-- Lifestyle & Habits -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-heart"></i> {{ __('profile.Lifestyle') }}
                                                </h5>
                                                <div>
                                                    <!-- Car Ownership -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Car_Ownership') }}:</strong>
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
                                                            <strong>{{ __('profile.Smoking_Status') }}:</strong>
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
                                                            <strong>{{ __('profile.Drinking_Status') }}:</strong>
                                                            {{ $userProfile['profile']['drinking_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    {{-- <!-- Sleep Habit -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Sleep_Habit') }}:</strong> {{ $userProfile['profile']['sleep_habit'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}

                                                    <!-- Sports Activity -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Sports_Activity') }}:</strong> {{ $userProfile['profile']['sports_activity'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                     <!-- Social Media Presence -->
                                                <div class="d-flex flex-row mb-2">
                                                    <div class="pl-3 pt-2 pr-2 pb-2">
                                                        <strong>{{ __('profile.Social_Media_Presence') }}:</strong> {{ $userProfile['profile']['social_media_presence'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                                    <!-- Hobbies -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            @if (!empty($userProfile['profile']['hobbies']))
                                                              <a >
                                                                        <strong>{{ __('profile.Hobbies') }}: </strong>
                                                                @foreach ($userProfile['profile']['hobbies'] as $hobby)
                                                                  <span class="badge badge-pill badge-outline-theme-2 mb-1">{{ $hobby }}</span>
                                                                  @endforeach
                                                                </a>
                                                                  @else
                                                                <span class="text-muted">{{ __('profile.No_hobbies_available') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- pets -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            @if (!empty($userProfile['profile']['pets']))
                                                            <a >
                                                                         <strong>{{ __('profile.Pets') }}: </strong>
                                                                @foreach ($userProfile['profile']['pets'] as $pet)
                                                                    <span class="badge badge-pill badge-outline-theme-2 mb-1">{{ $pet }}</span>
                                                                @endforeach
                                                            </a>
                                                            @else
                                                                <span class="text-muted">{{ __('profile.No_pets_available') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- smoking status -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                              @if ($userProfile['profile']['smoking_status'] == true)
    <a >
                                                                             <strong> {{ __('profile.Smoking_Tools') }}:</strong>
                                                                    @foreach ($userProfile['profile']['smoking_tools'] ?? [] as $tool)
                                                                    <span class="badge badge-pill badge-outline-theme-2 mb-1">{{ $tool }}</span>
                                                                    @endforeach
                                                                </a>
                                                            @endif
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
                                                    <i class="simple-icon-diamond"></i> {{ __('profile.Religion') }}
                                                </h5>
                                                <div>
                                                     <!-- Religion -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Religion') }}:</strong> {{ $userProfile['profile']['religion'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <!-- Religiosity Level -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Religiosity_Level') }}:</strong> {{ $userProfile['profile']['religiosity_level'] ?? 'N/A' }}
                                                        </div>
                                                    </div

                                                    <!-- Marriage Budget (only for male and if authenticated user is male) -->
                                                    @if (
                                                        $userProfile['gender'] === 'male' &&
                                                        auth()->check() &&
                                                        auth()->user()->gender === 'male'
                                                    )
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Marriage_Budget') }}:</strong> {{ $userProfile['profile']['marriage_budget'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    @endif


                                                    {{-- @if ($userProfile['gender'] === 'female')
                                                    <!-- Hijab Status -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                                <strong>{{ __('profile.Hijab_Status') }}:</strong>
                                                                @if ($userProfile['profile']['hijab_status'] ?? false)
                                                                    <i class="simple-icon-check text-success"></i>
                                                                @else
                                                                    <i class="simple-icon-close text-danger"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif --}}
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
                                                    <i class="simple-icon-home"></i> {{ __('profile.Housing_&_Marital_Status') }}
                                                </h5>
                                                <div>
                                                    <!-- Housing Status -->
                                                    @if (auth()->check() && auth()->user()->gender === 'male')
                                                        <div class="d-flex flex-row mb-3">
                                                            <div class="pl-3 pt-2 pr-2 pb-2">
                                                                <strong>{{ __('profile.Housing_Status') }} :</strong> {{ $userProfile['profile']['housing_status'] ?? 'N/A' }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Marital Status -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Marital_Status') }}:</strong> {{ $userProfile['profile']['marital_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                        @if (auth()->check() && auth()->user()->gender === 'female')
                                                            <!-- Contact (Encrypted) -->
                                                            <div class="d-flex flex-row mb-2">
                                                                <div class="pl-3 pt-2 pr-2 pb-2">
                                                                    <strong>{{ __('profile.Guardian_Contact') }}:</strong> {{ $userProfile['profile']['guardian_contact'] ?? 'None' }}
                                                                </div>
                                                            </div>
                                                        @else
                                                            <!-- Contact (Encrypted) -->
                                                            <div class="d-flex flex-row mb-2">
                                                                <div class="pl-3 pt-2 pr-2 pb-2">
                                                                    <strong>{{ __('profile.Contact') }}:</strong> {{ $userProfile['phone_number'] ?? 'N/A' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    {{-- <!-- Children -->
                                                    <div class="d-flex flex-row">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Children') }}:</strong> {{ $userProfile['profile']['children'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}
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
                                                    <i class="simple-icon-graduation"></i> {{ __('profile.Education') }}
                                                </h5>
                                                <div>
                                                    <!-- Educational Level -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Educational_Level') }}:</strong> {{ $userProfile['profile']['educational_level'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Specialization -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Specialization') }}:</strong> {{ $userProfile['profile']['specialization'] ?? 'N/A' }}
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
                                                    <i class="simple-icon-briefcase"></i> {{ __('profile.Employment_&_Financial_Info') }}
                                                </h5>
                                                <div>


                                                    <!-- Position Level -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Position_Level') }}:</strong> {{ $userProfile['profile']['position_level'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                    <!-- Job Title -->
                                                    <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Job_Title') }}:</strong> {{ $userProfile['profile']['job_title'] ?? 'N/A' }}
                                                        </div>
                                                    </div>

                                                     <!-- Employment Status -->
                                                     <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Employment_Status') }}:</strong>
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
                                                            <strong>{{ (__('profile.Financial_Status')) }}:</strong> {{ $userProfile['profile']['financial_status'] ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-6 col-12 mb-4">
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
                                    </div> --}}









                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                       <div class="row">
                        @if(empty($likes))
                            <div class="col-12">
                                <p class="text-center text-muted">{{ __('profile.No_like_yet') }}</p>
                            </div>
                        @else
                            @foreach($likes as $like)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card d-flex flex-row mb-4">
                                        <a class="d-flex" href="#">
                                            <!-- Display the profile image -->
                                            <img src="{{ asset(optional($like['user']['photos']->firstWhere('is_main', 1))['url'] ?? 'default-profile.png') }}"
                                                 alt="Profile"
                                                 class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">
                                        </a>
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                <div class="min-width-zero">
                                                    <a href="#">
                                                        <!-- Use optional() to safely access liked_user properties -->
                                                        <p class="list-item-heading mb-1 truncate">
                                                            {{ $like['user']['nickname'] ?? '' }}
                                                        </p>
                                                    </a>
                                                        {{-- <p class="mb-2 text-muted text-small">
                                                            {{ $like['user']['email'] ?? '' }}
                                                        </p> --}}
                                                    {{-- <a href="{{ route('viewUser', $like['liked_user']['id'] ) }}" type="button" class="btn btn-xs btn-outline-primary">View</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>


@endsection
@push('scripts')
    <script>
          document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('update-container');
    const target    = new Date("{{ auth()->user()->profile->nextAllowedUpdateAt()->toIso8601String() }}").getTime();

    // HTML for your active link
    const linkHtml = `
      <a href="{{ route('updateProfile') }}"
         class="btn btn-lg btn-primary mt-3 top-right-button top-right-button-single">
        {{ __('profile.Update_Profile') }}
      </a>
    `;

    // HTML for the locked state
    function lockedHtml() {
      return `
        <button id="update-btn"
                class="btn btn-lg btn-primary mt-3 top-right-button top-right-button-single"
                disabled>
           {{ __('profile.update_Available_in') }}
          <span id="countdown"></span>
        </button>

        </small>
      `;
    }

    // Render either link or locked UI immediately
    function renderInitial() {
      if (Date.now() >= target) {
        container.innerHTML = linkHtml;
      } else {
        container.innerHTML = lockedHtml();
        startCountdown();
      }
    }

    // Kick off the ticking countdown
    function startCountdown() {
      const cdEl      = document.getElementById('countdown');
      const cdSmallEl = document.getElementById('countdown-small');

      function pad(n){ return String(n).padStart(2,'0'); }

      const interval = setInterval(() => {
        // uncomment the next line to use a specific target time
        // const diff = target - Date.now();
        const diff = 0;
        if (diff <= 0) {
          clearInterval(interval);
          return container.innerHTML = linkHtml;
        }
        const days = Math.floor(diff/(1000*60*60*24));
        const hrs  = Math.floor((diff%(1000*60*60*24))/(1000*60*60));
        const mins = Math.floor((diff%(1000*60*60))/(1000*60));
        const secs = Math.floor((diff%(1000*60))/1000);
        const human = (days>0 ? days+'d ' : '')
                    + pad(hrs)+'h '+pad(mins)+'m '+pad(secs)+'s';

        cdEl.textContent      = human;
        cdSmallEl.textContent = human;
      }, 1000);
    }

    renderInitial();
});
    </script>
@endpush
