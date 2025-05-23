@extends('user.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('dashboard/css/findAmatch.css') }}" />
    {{-- Match Profile Modal --}}

    <div class="modal fade {{ app()->getLocale() === 'ar' ? 'modal-left' : 'modal-right' }}" id="profileModalRight"
        tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="simple-icon-user mr-2"></i>{{ __('userDashboard.likeMe.profile_details') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="{{ __('userDashboard.likeMe.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="modalAvatar" class="img-fluid rounded-circle mb-3 shadow-lg" src="" alt="Avatar"
                            style="max-width: 250px; height: 250px; object-fit: cover;">
                        <h4 id="modalName" class="font-weight-bold text-primary mt-3"></h4>
                        <p id="modalBio" class="text-muted small"></p>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('userDashboard.likeMe.basic_information') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.gender') }}:</strong> <span id="modalGender"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.age') }}:</strong> <span id="modalAge"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.nationality') }}:</strong> <span
                                        id="modalNationality"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.city') }}:</strong> <span id="modalCity"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('userDashboard.likeMe.additional_details') }}</h6>
                        </div>
                        <div class="card-body">
                            <div id="extraDetails" class="row"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button class="btn btn-outline-secondary mr-auto"
                        data-dismiss="modal">{{ __('userDashboard.likeMe.close') }}</button>
                    <form method="POST" action="{{ route('user.like') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="liked_user_id" value="">
                        <button class="btn btn-sm btn-outline-primary" type="submit">
                            <i class="simple-icon-like"></i> {{ __('userDashboard.likeMe.like') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('user.dislike') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="disliked_user_id" value="">
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            <i class="simple-icon-dislike"></i> {{ __('userDashboard.likeMe.Fdislike') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid disable-text-selection">
        <!-- Enhanced Header with Dashboard Summary -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="match-dashboard-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-4">
                        <div>
                            <h1 class="mb-1">{{ __('userDashboard.findMatch.title') }}</h1>
                            <p class="text-dark mb-0">
                                {{ __('userDashboard.dashboard.Find_your_perfect_match_based_on_compatibility_and_preferences') }}
                            </p>
                        </div>

                        <div class="match-stats d-flex mt-3 mt-md-0">
                            <div class="match-stat-item text-center mr-4">
                                <span class="match-stat-number" id="exactMatchCount">0</span>
                                <span class="match-stat-label">{{ __('userDashboard.dashboard.Exact_Matches') }}</span>
                            </div>
                            <div class="match-stat-item text-center">
                                <span class="match-stat-number" id="suggestedMatchCount">0</span>
                                <span class="match-stat-label">{{ __('userDashboard.dashboard.Suggestions') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if ($filledPreferenceCount >= 2) --}}

            <!-- Clear Section Division for Exact Matches -->
            <div class="row mb-4 px-4">
                <div class="col-12">
                    <div class="section-header">
                        <h5 class="mb-0">
                            <i class="simple-icon-check mr-2"></i>{{ __('userDashboard.dashboard.Exact_Matches') }}
                            <span class="badge badge-light ml-2" id="exactMatchBadge">0</span>
                        </h5>
                    </div>
                    <div class="row mt-3" id="exactMatchResults">
                        <!-- Exact match cards will be populated here via JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Suggestion Slider Section with Clear Visual Distinction -->
            <div id="Suggested_Matches_section" class="row  px-4">
                <div class="col-12">
                    <div class="section-header">
                        <h5 class="mb-0">
                            <i class="simple-icon-star mr-2"></i>{{ __('userDashboard.dashboard.Suggested_Matches') }}
                            <span class="badge badge-light ml-2" id="suggestedMatchBadge">0</span>
                            <span class="badge badge-info ml-2"
                                id="matchPercentage">{{ __('userDashboard.dashboard.% Match') }}</span>
                        </h5>
                    </div>
                    <div class="suggested-slider-container mt-3">
                        <div class="suggested-slider-controls">
                            <button id="prevSuggestion" class="btn btn-outline-primary btn-sm">
                                <i class="simple-icon-arrow-left"></i>
                            </button>
                            <button id="nextSuggestion" class="btn btn-outline-primary btn-sm">
                                <i class="simple-icon-arrow-right"></i>
                            </button>
                        </div>
                        <div class="suggested-slider" id="suggestedMatchResults">
                            <!-- Suggested match cards will be populated here via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="modal fade modal-top" id="reportModalMain" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">
                        <i class="fas fa-flag"></i> {{ __('userDashboard.dashboard.report_user') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="{{ __('userDashboard.likeMe.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="reportForm">
                        @csrf
                        <div id="report-success" class="alert alert-success mt-3 d-none">
                            {{ __('userDashboard.dashboard.report_success') }}
                        </div>
                        <input type="hidden" id="reportModal_user_id" name="reported_id" value="">

                        <div class="form-group">
                            <label for="reasonSelect">{{ __('userDashboard.dashboard.reason') }}</label>
                            <select id="reasonSelect" name="reason_en" class="form-control"onchange="toggleOtherReason()"
                                required>
                                <option value="Inappropriate Photos">
                                    {{ __('userDashboard.dashboard.inappropriate_photos') }}
                                </option>
                                <option value="Offensive Language">
                                    {{ __('userDashboard.dashboard.offensive_language') }}
                                </option>
                                <option value="Spam or Advertising">
                                    {{ __('userDashboard.dashboard.spam_or_advertising') }}
                                </option>
                                <option value="Other">{{ __('userDashboard.dashboard.other') }}</option>
                            </select>
                            <div class="form-group d-none" id="otherReasonGroup">
                                <label>{{ app()->getLocale() === 'ar' ? __('userDashboard.dashboard.other_reason_ar') : __('userDashboard.dashboard.other_reason_en') }}</label>
                                <textarea name="other_reason_{{ app()->getLocale() }}" id="otherReasonInput" class="form-control" rows="2"></textarea>
                            </div>

                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-primary feedback-btn" onclick="submitReport()">
                        {{ __('userDashboard.dashboard.submit') }}
                    </button>

                    <button type="button" class="btn btn-outline-danger feedback-btn" data-dismiss="modal">
                        {{ __('userDashboard.dashboard.cancel') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('sidebar-filters')
    <!-- Filter Sidebar -->
    <div id="filterTab" class="filter-tab show">
        <a href="javascript:void(0)" id="filterToggleDesktop">
            <i class="simple-icon-equalizer"></i>
            <span class="filter-count" id="desktopFilterCount">0</span>
        </a>
    </div>

    <div id="filterBookmark" class="filter-bookmark show">
        <a href="javascript:void(0)" id="filterToggleMobile">
            <i class="simple-icon-equalizer"></i>
            <span class="filter-count ml-2" id="mobileFilterCount">0</span>
        </a>
    </div>

    <div class="sub-menu show" id="matchFilters">
        <div class="scroll">
            <div class="filter-header">
                <h6 class="sub-menu-title mb-0">{{ __('userDashboard.submenu.match_filters') }}</h6>
                <button id="resetAllFilters" class="btn btn-sm btn-outline-danger">
                    <i class="simple-icon-refresh"></i> {{ __('userDashboard.submenu.reset') }}
                </button>
            </div>
            <div class="p-3">
                <form id="filterForm" onsubmit="return false;">
                    @csrf
                    <input type="hidden" name="isFilter" value="true">

                    {{-- BASIC INFO --}}
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.age_range') }}</label>
                        <div class="d-flex">
                            <input type="number" name="age_min" min="18" class="form-control mr-2"
                                placeholder="Min">
                            <input type="number" name="age_max" max="65" class="form-control" placeholder="Max">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.nationality') }}</label>
                        <select name="nationality_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['nationalities'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_nationality_id']) && $prefs['preferred_nationality_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.country_of_residence') }}</label>
                        <select name="country_of_residence_id" id="country_of_residence_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['countries'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_country_id']) && $prefs['preferred_country_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.city') }}</label>
                        <select name="city_id" id="city_id" class="form-control">
                            <option value="">{{ __('userDashboard.submenu.Select Country First') }}</option>
                        </select>
                    </div>

                    {{-- RELIGION --}}
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.religion') }}</label>
                        <select name="religion_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['religions'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.religiosity_level') }}</label>
                        <select name="religiosity_level_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['religiousLevels'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_religiosity_level_id']) && $prefs['preferred_religiosity_level_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- APPEARANCE --}}
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.height') }}</label>
                        <select name="height_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['heights'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_height_id']) && $prefs['preferred_height_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.weight') }}</label>
                        <select name="weight_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['weights'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_weight_id']) && $prefs['preferred_weight_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.skin_color') }}</label>
                        <select name="skin_color_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['skinColors'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_skin_color_id']) && $prefs['preferred_skin_color_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.hair_color') }}</label>
                        <select name="hair_color_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['hairColors'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_hair_color_id']) && $prefs['preferred_hair_color_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.eye_color') }}</label>
                        <select name="eye_color_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['eyeColors'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
{{--
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.zodiac_sign') }}</label>
                        <select name="zodiac_sign_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['zodiacSigns'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    {{-- LIFESTYLE --}}
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.marital_status') }}</label>
                        <select name="marital_status_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['maritalStatuses'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.smoking_status') }}</label>
                        <select name="smoking_status" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.drinking_status') }}</label>
                        <select name="drinking_status_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['drinkingStatuses'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.sleep_habit') }}</label>
                        <select name="sleep_habit_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['sleepHabits'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- EDUCATION & WORK --}}
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.educational_level') }}</label>
                        <select name="educational_level_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['educationalLevels'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_educational_level_id']) && $prefs['preferred_educational_level_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.specialization') }}</label>
                        <select name="specialization_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['specializations'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_specialization_id']) && $prefs['preferred_specialization_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.job_domain') }}</label>
                        <select name="job_title_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['jobTitles'] as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($prefs['preferred_job_title_id']) && $prefs['preferred_job_title_id'] == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.position_level') }}</label>
                        <select name="sector_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['positionLevels'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.marriage_budget') }}</label>
                        <select name="marriage_budget_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['marriageBudget'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label>{{ __('userDashboard.submenu.children') }}</label>
                        <select name="children" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div> --}}

                    {{-- SOCIAL --}}
                    <div class="form-group">
                        <label>{{ __('userDashboard.submenu.social_media_presence') }}</label>
                        <select name="social_media_presence_id" class="form-control">
                            <option value="any">{{ __('userDashboard.submenu.any') }}</option>
                            @foreach ($data['socialMediaPresence'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ACTION --}}
                    <div class="form-group mt-4">
                        <button type="button" id="applyFiltersBtn" class="btn btn-primary btn-block">
                            <i class="simple-icon-magnifier mr-2"></i> {{ __('userDashboard.submenu.Find Matches') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- @else
    <div class="container py-5 text-center">
        <h3 class="text-danger mb-3">{{ __('userDashboard.findMatch.complete_preferences') }}</h3>
        <p class="mb-4">{{ __('userDashboard.findMatch.at_least_two_fields') }}
        </p>
        <a href="{{ route('desired') }}" class="btn btn-primary">{{ __('userDashboard.findMatch.complete_preferences_btn') }}</a>
    </div>
    @endif --}}


    <!-- Dependent City Loading -->
    @push('scripts')
        <script>
            // this is for the modal view user details
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept-Language': '{{ app()->getLocale() }}'
                }
            });

            function categorizeDetails(profile) {
                return {
                    "{{ __('userDashboard.likeMe.personal') }}": {
                        "{{ __('userDashboard.likeMe.date_of_birth') }}": profile.profile.date_of_birth,
                        "{{ __('userDashboard.likeMe.religion') }}": profile.profile.religion,
                        "{{ __('userDashboard.likeMe.marital_status') }}": profile.profile.marital_status,
                        "{{ __('userDashboard.likeMe.children') }}": profile.profile.children ??
                            "{{ __('userDashboard.likeMe.na') }}",
                        "{{ __('userDashboard.likeMe.skin_color') }}": profile.profile.skin_color,
                        "{{ __('userDashboard.likeMe.hair_color') }}": profile.profile.hair_color,
                    },
                    "{{ __('userDashboard.likeMe.professional') }}": {
                        "{{ __('userDashboard.likeMe.educational_level') }}": profile.profile.educational_level,
                        "{{ __('userDashboard.likeMe.specialization') }}": profile.profile.specialization,
                        "{{ __('userDashboard.likeMe.employment_status') }}": profile.profile.employment_status ?
                            "{{ __('userDashboard.likeMe.employed') }}" : "{{ __('userDashboard.likeMe.unemployed') }}",
                        "{{ __('userDashboard.likeMe.Job_Domain') }}": profile.profile.job_title,
                        "{{ __('userDashboard.likeMe.position_level') }}": profile.profile.position_level,
                        "{{ __('userDashboard.likeMe.financial_status') }}": profile.profile.financial_status,
                    },
                    "{{ __('userDashboard.likeMe.lifestyle') }}": {
                        // "{{ __('userDashboard.likeMe.hijab_status') }}": profile.profile.hijab_status !== null ?
                        //     (profile.profile.hijab_status ? "{{ __('userDashboard.likeMe.yes') }}" :
                        //         "{{ __('userDashboard.likeMe.no') }}") : "{{ __('userDashboard.likeMe.na') }}",
                        "{{ __('userDashboard.likeMe.smoking_status') }}": profile.profile.smoking_status !== null ?
                            (profile.profile.smoking_status ? "{{ __('userDashboard.likeMe.yes') }}" :
                                "{{ __('userDashboard.likeMe.no') }}") : "{{ __('userDashboard.likeMe.na') }}",
                        "{{ __('userDashboard.likeMe.drinking_status') }}": profile.profile.drinking_status,
                    },
                    "{{ __('userDashboard.likeMe.physical') }}": {
                        "{{ __('userDashboard.likeMe.height') }}": profile.profile.height,
                        "{{ __('userDashboard.likeMe.weight') }}": profile.profile.weight,
                        "{{ __('userDashboard.likeMe.sports_activity') }}": profile.profile.sports_activity,
                    },
                    "{{ __('userDashboard.likeMe.social') }}": {
                        "{{ __('userDashboard.likeMe.social_media_presence') }}": profile.profile.social_media_presence,
                    },
                    "{{ __('userDashboard.likeMe.interests') }}": {
                        "{{ __('userDashboard.likeMe.smoking_tools') }}": profile.profile.smoking_tools,
                        "{{ __('userDashboard.likeMe.hobbies') }}": profile.profile.hobbies,
                        "{{ __('userDashboard.likeMe.pets') }}": profile.profile.pets,
                    }
                };
            }

            function populateExtraDetails(details) {
                const container = $('#extraDetails');
                container.empty();

                Object.entries(details).forEach(([category, fields]) => {
                    container.append(`<div class="col-md-12"><h6 class="text-primary mt-3">${category}</h6></div>`);
                    Object.entries(fields).forEach(([label, value]) => {
                        if (!value || value === 'N/A' || (Array.isArray(value) && !value.length)) return;
                        if (Array.isArray(value)) {
                            const badges = [...new Set(value)].map(item =>
                                `<span class="badge badge-info mr-1 mb-1">${item}</span>`).join('');
                            container.append(
                                `<div class="col-md-6 mb-3"><strong>${label}:</strong><br>${badges}</div>`);
                        } else {
                            container.append(
                                `<div class="col-md-6 mb-2"><strong>${label}:</strong> ${value}</div>`);
                        }
                    });
                });
            }

            // ✅ Main modal load logic
            $(document).on('click', '.profile-card', function() {
                const user = $(this).data('profile');
                const userId = user.id || user.user_id;

                // console.log("Fetching profile for user ID:", userId);

                $.ajax({
                    method: 'GET',
                    url: `/user/user-profile?user_id=${userId}`,

                    success: function(response) {
                        const user = response.data; // ✅ renamed to `user`

                        const mainPhoto = user.profile?.photos?.find(photo => photo.is_main === 1)
                            ?.photo_url;
                        $('#modalAvatar').attr('src', mainPhoto || '/dashboard/logos/profile-icon.jpg');
                        $('#modalName').text(`${user.profile.nickname} `);
                        $('#modalBio').text(user.profile?.bio || 'No bio provided.');
                        $('input[name="liked_user_id"]').val(userId);
                        $('input[name="disliked_user_id"]').val(userId);
                        $('#modalGender').text(user.gender || 'N/A');
                        $('#modalAge').text(user.profile?.age || 'N/A');
                        $('#modalNationality').text(user.profile?.nationality || 'N/A');
                        $('#modalCity').text(user.profile?.city || 'N/A');
                        $('#modalPhone').text(user.phone_number || 'N/A');

                        if (!user.contact_exchanged) {
                            $('#revealContactBtn').removeClass('d-none').off('click').on('click',
                                function() {
                                    alert("This feature is not implemented.");
                                });
                        } else {
                            $('#revealContactBtn').addClass('d-none');
                        }

                        const details = categorizeDetails(user);
                        populateExtraDetails(details);
                        console.log(details)
                        $('#profileModalRight').modal('show');
                    }
                });
            });

            // ----------------------------------------------------
            $('#country_of_residence_id').on('change', function() {
                let countryId = $(this).val();
                $('#city_id').html('<option value="">Loading...</option>');
                if (countryId) {
                    $.get('/cities-by-country/' + countryId, function(data) {
                        let options = '<option value="">-- Select City --</option>';
                        data.forEach(city => {
                            options += `<option value="${city.id}">${city.name}</option>`;
                        });
                        $('#city_id').html(options);
                    });
                } else {
                    $('#city_id').html('<option value="">-- Select Country First --</option>');
                }
            });


            $(document).ready(function() {


                // Initialize collapsible sections
                $('.filter-section-header').on('click', function() {
                    $(this).find('i.simple-icon-arrow-down').toggleClass('simple-icon-arrow-up');
                    $(this).next('.filter-section-body').collapse('toggle');
                });

                // Modified content section for clearer data separation
                const matchResultsContainer = $('#matchResults');
                matchResultsContainer.html(`
                <!-- Clear Section Division for Exact Matches -->
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="simple-icon-check mr-2"></i>{{ __('userDashboard.dashboard.Exact_Matches') }}
                                <span class="badge badge-light ml-2" id="exactMatchBadge">0</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row" id="exactMatchResults">
                                <!-- Will be populated via JavaScript -->
                                <div class="col-12 text-center py-5">
                                    <i class="simple-icon-refresh spinning font-large"></i>
                                    <p class="mt-3">{{ __('userDashboard.dashboard.Loading_matches') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suggestion Slider Section with Clear Visual Distinction -->
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="simple-icon-star mr-2"></i>Suggested Matches
                                <span class="badge badge-light ml-2" id="suggestedMatchBadge">0</span>
                                <span class="badge badge-info ml-2" id="matchPercentage">{{ __('userDashboard.dashboard.% Match') }}</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="suggested-slider-container">
                                <div class="suggested-slider-controls">
                                    <button id="prevSuggestion" class="btn btn-outline-primary btn-sm">
                                        <i class="simple-icon-arrow-left"></i>
                                    </button>
                                    <button id="nextSuggestion" class="btn btn-outline-primary btn-sm">
                                        <i class="simple-icon-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="suggested-slider" id="suggestedMatchResults">
                                    <!-- Will be populated via JavaScript -->
                                    <div class="col-12 text-center py-5">
                                        <i class="simple-icon-refresh spinning font-large"></i>
                                        <p class="mt-3">{{ __('userDashboard.dashboard.Loading_suggestions...') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

                // Initialize slider controls
                $('#nextSuggestion').on('click', function() {
                    const container = document.querySelector('.suggested-slider');
                    container.scrollLeft += 320; // Width of a card + gap
                });

                $('#prevSuggestion').on('click', function() {
                    const container = document.querySelector('.suggested-slider');
                    container.scrollLeft -= 320; // Width of a card + gap
                });

                // Track active filters and update counters
                function updateFilterCounters() {
                    let activeFilters = 0;

                    // Check each filter input/select
                    $('#filterForm').find('select, input[type="number"]').each(function() {
                        const $this = $(this);
                        const value = $this.val();
                        const id = $this.attr('id');
                        const activeLabel = $('#' + id + 'Active');

                        if (value && value !== '' && value !== 'any' && id !== '_token') {
                            activeFilters++;

                            // Show active state for this filter
                            if (activeLabel.length) {
                                if (id === 'age_min' || id === 'age_max') {
                                    const min = $('#age_min').val() || '?';
                                    const max = $('#age_max').val() || '?';
                                    if (min !== '?' || max !== '?') {
                                        $('#ageRangeActive').text(`${min}-${max}`).addClass('show');
                                    }
                                } else {
                                    activeLabel.text('Selected').addClass('show');
                                }
                            }
                        } else {
                            // Remove active state
                            if (activeLabel.length && id !== 'age_min' && id !== 'age_max') {
                                activeLabel.text('').removeClass('show');
                            } else if ((id === 'age_min' || id === 'age_max') &&
                                !$('#age_min').val() && !$('#age_max').val()) {
                                $('#ageRangeActive').text('').removeClass('show');
                            }
                        }
                    });

                    // Update filter badges
                    $('#desktopFilterCount, #mobileFilterCount').text(activeFilters);

                    if (activeFilters > 0) {
                        $('.filter-count').addClass('active');
                    } else {
                        $('.filter-count').removeClass('active');
                    }

                    return activeFilters > 0;
                }

                // Reset all filters
                $('#resetAllFilters').on('click', function() {
                    $('#filterForm')[0].reset();
                    $('.filter-active').text('').removeClass('show');
                    $('.filter-count').removeClass('active');
                    $('#desktopFilterCount, #mobileFilterCount').text('0');
                    loadDefaultMatches();
                });

                // On page load, send the default request with isFilter = false
                loadDefaultMatches();

                // Handle filter form submission
                $('#applyFiltersBtn').on('click', function(e) {
                    e.preventDefault();

                    // Update filter counters and check if any filters are active
                    const hasFilter = updateFilterCounters();
                    $('input[name="isFilter"]').val(hasFilter ? "true" : "false");

                    // Show loading state
                    $(this).html('<i class="simple-icon-refresh spinning mr-2"></i> Searching...');
                    $('#exactMatchResults, #suggestedMatchResults').html(
                        '<div class="col-12 text-center py-5"><i class="simple-icon-refresh spinning font-large"></i><p class="mt-3">Searching for matches...</p></div>'
                    );

                    // Serialize and send the GET request
                    let queryString = $('#filterForm').serialize();
                    $.ajax({
                        url: '/user/filter?' + queryString,
                        method: 'GET',
                        success: function(response) {
                            renderMatches(response.exact_matches, response.suggested_users, response
                                .suggestion_percentage);
                            $('#applyFiltersBtn').html(
                                '<i class="simple-icon-magnifier mr-2"></i> {{ __('userDashboard.submenu.Find Matches') }}');
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            $('#applyFiltersBtn').html(
                                '<i class="simple-icon-magnifier mr-2"></i> {{ __('userDashboard.submenu.Find Matches') }}');
                            $('#exactMatchResults, #suggestedMatchResults').html(
                                '<div class="col-12 text-center py-4"><p class="text-muted">Error loading matches. Please try again.</p></div>'
                            );
                        }
                    });
                });

                // Monitor filter changes
                $('#filterForm').find('select, input[type="number"]').on('change', function() {
                    updateFilterCounters();
                });

                function loadDefaultMatches() {
                    // Show loading indicators
                    $('#exactMatchResults, #suggestedMatchResults').html(
                        `<div class="col-12 text-center py-5"><i class="simple-icon-refresh spinning font-large"></i><p class="mt-3">{{ __('userDashboard.dashboard.Loading_matches') }}</p></div>`
                    );

                    // Send a request with isFilter = false
                    $.ajax({
                        url: '/user/filter',
                        method: 'GET',
                        success: function(response) {
                            renderMatches(response.exact_matches, response.suggested_users, response
                                .suggestion_percentage);

                            // Remove Suggested Matches section if no suggested users
                            if (!response.suggested_users || response.suggested_users.length === 0) {
                                $('#Suggested_Matches_section').remove();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            $('#exactMatchResults, #suggestedMatchResults').html(
                                '<div class="col-12 text-center py-4"><p class="text-muted">Unable to load matches. Please try again.</p></div>'
                            );
                        }
                    });
                }

                // Renders matches in their respective containers with enhanced styling
                function renderMatches(exactMatches, suggestedUsers, suggestionPercentage) {
                    // Update badge counters
                    $('#exactMatchBadge').text(exactMatches ? exactMatches.length : 0);
                    $('#suggestedMatchBadge').text(suggestedUsers ? suggestedUsers.length : 0);
                    $('#matchPercentage').text(suggestionPercentage + `%{{ __('userDashboard.dashboard.% Match') }}`);
                    $('#exactMatchCount').text(exactMatches ? exactMatches.length : 0);
                    $('#suggestedMatchCount').text(suggestedUsers ? suggestedUsers.length : 0);
                    // Render exact matches
                    let exactContainer = $('#exactMatchResults');
                    exactContainer.empty();

                    if (exactMatches && exactMatches.length > 0) {
                        exactMatches.forEach(userProfile => {
                            exactContainer.append(matchCard(userProfile, 'exact'));
                        });
                    } else {
                        exactContainer.html(
                            `<div class="col-12 text-center py-4"><p class="text-dark">{{ __('userDashboard.dashboard.No_exact_matches_found_based_on_your_criteria') }}</p></div>`
                        );
                    }

                    // Render suggested matches in the slider
                    let suggestedContainer = $('#suggestedMatchResults');
                    suggestedContainer.empty();

                    if (suggestedUsers && suggestedUsers.length > 0) {
                        suggestedUsers.forEach(userProfile => {
                            suggestedContainer.append(matchCard(userProfile, 'suggested'));
                        });
                    } else {
                        suggestedContainer.html(
                            `<div class="text-center py-4 w-100"><p class="text-dark">{{ __('userDashboard.dashboard.No_suggested_matches_found_based_on_your_criteria') }}</p></div>`
                        );
                    }
                }

                function matchCard(userProfile, cardType) {
                    // Determine main photo URL with fallback
                    let mainPhotoUrl = '/dashboard/logos/profile-icon.jpg';
                    if (userProfile.photos && userProfile.photos.length > 0) {
                        const mainPhoto = userProfile.photos.find(photo => photo.is_main == 1);
                        if (mainPhoto && mainPhoto.photo_url) {
                            mainPhotoUrl = mainPhoto.photo_url;
                        }
                    }

                    // Process location information
                    let country = (userProfile && userProfile.country) ? userProfile.country :
                        `{{ __('userDashboard.dashboard.Unknown_Location') }}`;
                    let city = (userProfile && userProfile.city) ? userProfile.city :
                        `{{ __('userDashboard.dashboard.Unknown_Location') }}`;
                    // console.log(userProfile);

                    // Extract additional user info if available
                    let age = userProfile.profile && userProfile.profile.age ? userProfile.profile.age : '';
                    let religion = userProfile.profile && userProfile.profile.religion ? userProfile.profile.religion :
                        '';
                    // console.log(userProfile);
                    // Create a different HTML structure based on card type
                    if (cardType === 'exact') {
                        return `
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="card profile-card shadow-sm h-100" data-profile='${JSON.stringify(userProfile)}'>
                                  <div class="card-body d-flex flex-column">
                                    <button type="button"
                                        class="btn btn-outline-danger position-absolute d-flex align-items-center justify-content-center"
                                        style="top: 10px; {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px; width: 40px; height: 40px; border-radius: 50%; padding: 0; z-index: 10;"
                                        onclick="event.stopPropagation(); openReportModal(${userProfile.id})">
                                        <i class="fas fa-flag"></i>
                                    </button>
                                <div class="position-relative">
                                    <span class="badge badge-success position-absolute m-2">{{ __('userDashboard.dashboard.Exact_Match') }}</span>
                                    <img class="card-img-top" src="${mainPhotoUrl}" alt="${userProfile.nickname}'s Profile">
                                </div>

                                    <h5 class="card-title mb-1">${userProfile.nickname} </h5>
                                    <p class="text-muted small mb-2">
                                        ${country}${country && city ? ', ' : ''}${city}
                                    </p>
                                    <div class="profile-details mt-auto">
                                        ${age ? `<span class="badge badge-light mr-2">${age} years</span>` : ''}
                                        ${religion ? `<span class="badge badge-light">${religion}</span>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    } else {
                        // For suggestion slider, wrap in a container div for proper layout
                        return `
                        <div class="card-container">
                            <div class="card profile-card shadow-sm h-100" data-profile='${JSON.stringify(userProfile)}'>
                                    <button type="button"
                                        class="btn btn-outline-danger position-absolute d-flex align-items-center justify-content-center"
                                        style="top: 10px; {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px; width: 40px; height: 40px; border-radius: 50%; padding: 0; z-index: 10;"
                                        onclick="event.stopPropagation(); openReportModal(${userProfile.id})">
                                        <i class="fas fa-flag"></i>
                                    </button>

                                <div class="position-relative">
                                    <span class="badge badge-warning position-absolute m-2">{{ __('userDashboard.dashboard.Suggested') }}</span>
                                    <img class="card-img-top" src="${mainPhotoUrl}" alt="${userProfile.nickname}'s Profile">
                                </div>
                                <div class="card-body d-flex flex-column">

                                    <h5 class="card-title mb-1">${userProfile.nickname} </h5>
                                    <p class="text-muted small mb-2">
                                        ${country}${country && city ? ', ' : ''}${city}
                                    </p>
                                    <div class="profile-details mt-auto">
                                        ${age ? `<span class="badge badge-light mr-2">${age} years</span>` : ''}
                                        ${religion ? `<span class="badge badge-light">${religion}</span>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    }
                }

                // Add an animation class for the loading spinner
                $('<style>').text(`
                .spinning {
                    animation: spin 1s infinite linear;
                }
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                .font-large {
                    font-size: 2rem;
                }
            `).appendTo('head');
            });
        </script>
        @include('user.partials.report-scripts')
    @endpush
@endsection
