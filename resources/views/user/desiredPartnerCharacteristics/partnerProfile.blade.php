@extends('user.layouts.app')

@section('content')

    <style>
        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .slider-wrapper {
            position: relative;
            height: 50px;
        }

        .slider-track {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 6px;
            background: transparent;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            z-index: 3;
        }

        .slider-track::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid var(--theme-color-1);
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            pointer-events: auto;
            position: relative;
            z-index: 4;
        }

        .slider-track::-moz-range-thumb {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid var(--theme-color-1);
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            pointer-events: auto;
            z-index: 4;
        }

        .range-highlight {
            position: absolute;
            height: 6px;
            top: 50%;
            transform: translateY(-50%);
            background-color: var(--theme-color-1);
            border-radius: 3px;
            z-index: 2;
        }
    </style>
    {{-- {{ dd($userPreferences) }} --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form id="user-preference-form" method="POST">
                    @csrf
                    <div class="mb-2">
                        <h1>{{ ucfirst(auth()->user()->first_name) . ' ' . ucfirst(auth()->user()->last_name) }}</h1>
                        <div class="text-zero top-right-button-container">
                            <button type="submit"
                                class="btn btn-lg btn-primary mt-3   top-right-button top-right-button-single"
                                >
                                {{ __('profile.Desired_Partner_characteristics') }}
                            </button>

                        </div>

                    </div>
                    <div id="field-limit-counter" class="alert alert-info py-2 px-3 mb-3 shadow-sm"
                        style="font-size: 16px; position: sticky; top: 105px; left: 0; z-index: 1000;">
                        {{ __('profile.You can select up to 10 fields. Remaining:') }}
                        <strong id="remaining-count">10</strong>
                    </div>


                    <div id="preference-success-alert" class=" d-none">

                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="simple-icon-info mr-2"></i>
                            <span id="preference-success-message">{{ __('Preferences saved successfully!') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>




                    <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                        {{-- <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                        aria-controls="first" aria-selected="true">{{ __('profile.profile') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                        aria-controls="second" aria-selected="false">{{ __('profile.My_Likes') }}</a>
                </li> --}}
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">

                            </div>

                            <div class="col-12 col-lg-12 col-xl-12 col-right">
                                <div class="row listing-card-container">
                                    <div class="row">
                                        <!-- Personal Info Card -->
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">


                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-user"></i> {{ __('profile.Partner_Personal_Info') }}
                                                    </h5>
                                                    <div>

                                                        {{-- Nationality --}}
                                                        @if (!empty($data['nationalities']))
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="preferred_nationality">{{ __('profile.Partner_Nationality') }}</label>
                                                                <select class="form-control"
                                                                    name="preferred_nationality_id">
                                                                    <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                    </option>
                                                                    @foreach ($data['nationalities'] as $option)
                                                                        <option value="{{ $option->id }}"
                                                                            {{ $userPreferences['preferred_nationality'] == $option->name ? 'selected' : '' }}>
                                                                            {{ $option->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif


                                                        <!-- Origin -->
                                                        @if (!empty($data['origins']))
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="preferred_origin">{{ __('profile.Partner_Origin') }}</label>
                                                                <select class="form-control" name="preferred_origin_id">
                                                                    <option value="">
                                                                        {{ __('profile.Partner_No_Preference') }}</option>
                                                                    @foreach ($data['origins'] as $option)
                                                                        <option value="{{ $option->id }}"
                                                                            {{ $userPreferences['preferred_origin'] == $option->name ? 'selected' : '' }}>
                                                                            {{ $option->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif

                                                        {{-- Age Range --}}
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label d-block mb-2">{{ __('profile.Partner_Age') }}</label>

                                                            {{-- Top Labels --}}
                                                                <div class="d-flex justify-content-between px-2 mt-2 @if(app()->getLocale()==='ar') flex-row-reverse @endif">

                                                                <div class="bg-light rounded px-3 py-1 border"
                                                                    @if(app()->getLocale()==='ar') style="padding-left: 1rem !important;" @endif
                                                                    id="age-min-label">
                                                                    {{ $userPreferences['preferred_age_min'] ?? 18 }}</div>
                                                                <div class="bg-light rounded px-3 py-1 border"
                                                                    @if(app()->getLocale()==='ar') style="padding-left: 1rem !important;" @endif
                                                                    id="age-max-label">
                                                                    {{ $userPreferences['preferred_age_max'] ?? 65 }}</div>
                                                            </div>
                                                            {{-- Slider --}}
                                                            {{-- these 4 should be as one input in js --}}
                                                            <div class="position-relative slider-wrapper mb-3">
                                                                <input type="range" min="18" max="65"
                                                                    value="{{ $userPreferences['preferred_age_min'] ?? 18 }}"
                                                                    id="ageMin" class="form-range slider-track">
                                                                <input type="range" min="18" max="65"
                                                                    value="{{ $userPreferences['preferred_age_max'] ?? 65 }}"
                                                                    id="ageMax" class="form-range slider-track">
                                                                <div class="range-highlight"></div>
                                                                <input type="hidden"
                                                                    class="form-control form-control-sm mx-1"
                                                                    name="preferred_age_min" id="preferred_age_min"
                                                                    value="{{ $userPreferences['preferred_age_min'] ?? 18 }}"
                                                                    placeholder="Min Age" min="18" max="100">
                                                                <input type="hidden" class="form-control form-control-sm"
                                                                    name="preferred_age_max" id="preferred_age_max"
                                                                    value="{{ $userPreferences['preferred_age_max'] ?? 65 }}"
                                                                    placeholder="Max Age" min="18" max="100">
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

                                        {{-- Skin Color & Hair Color --}}
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-user"></i> {{ __('profile.Partner_Appearance') }}
                                                    </h5>

                                                    {{-- Skin Color --}}
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('profile.Partner_Skin_Color') }}</label>
                                                        <select class="form-control" name="preferred_skin_color_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['skinColors'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_skin_color'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- Hair Color --}}
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('profile.Partner_Hair_Color') }}</label>
                                                        <select class="form-control" name="preferred_hair_color_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['hairColors'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_hair_color'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                         <!-- Height -->
                                                        @if (!empty($data['heights']))
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="preferred_height">{{ __('profile.Partner_height') }}</label>
                                                                <select class="form-control" name="preferred_height_id">
                                                                    <option value="">
                                                                        {{ __('profile.Partner_No_Preference') }}</option>
                                                                    @foreach ($data['heights'] as $option)
                                                                        <option value="{{ $option->id }}"
                                                                            {{ $userPreferences['preferred_height'] == $option->name ? 'selected' : '' }}>
                                                                            {{ $option->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif

                                                        <!-- Weight -->
                                                        @if (!empty($data['weights']))
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="preferred_weight">{{ __('profile.Partner_weight') }}</label>
                                                                <select class="form-control" name="preferred_weight_id">
                                                                    <option value="">
                                                                        {{ __('profile.Partner_No_Preference') }}</option>
                                                                    @foreach ($data['weights'] as $option)
                                                                        <option value="{{ $option->id }}"
                                                                            {{ $userPreferences['preferred_weight'] == $option->name ? 'selected' : '' }}>
                                                                            {{ $option->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                </div>
                                            </div>

                                        </div>


                                        <!-- Location Info Card -->
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">


                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-location-pin"></i>
                                                        {{ __('profile.Location_Info') }}
                                                    </h5>


                                                    {{-- Country of Residence --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="country_id">{{ __('profile.Partner_Country_of_Residence') }}</label>
                                                        <select class="form-control" name="preferred_country_id"
                                                            id="country_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['countries'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ old('country_of_residence', $userPreferences['preferred_country'] ?? '') == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>



                                                    {{-- City --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="city_id">{{ __('profile.Partner_City') }}</label>
                                                        <select class="form-control" name="preferred_city_id"
                                                            id="city_id">
                                                            <option value="">{{ __('onboarding.select_city') }}
                                                            </option>
                                                            @if (!empty($cities))
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        {{ $userPreferences['preferred_city'] == $city->name ? 'selected' : '' }}>
                                                                        {{ $city->name }}
                                                                    </option>
                                                                @endforeach
                                                            @elseif(!empty($userPreferences['preferred_city']))
                                                                <option selected
                                                                    value="{{ $userPreferences['preferred_city'] }}">
                                                                    {{ $userPreferences['preferred_city'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--  Education -->
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">


                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-graduation"></i>
                                                        {{ __('profile.Partner_Education') }}
                                                    </h5>

                                                    {{-- Educational Level --}}
                                                    <div class="form-group ">
                                                        <label class="form-label"
                                                            for="preferred_educational_level">{{ __('profile.Partner_Educational_Level') }}</label>
                                                        <select class="form-control"
                                                            name="preferred_educational_level_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['educationalLevels'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_educational_level'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- Specialization --}}
                                                    <div class="form-group ">
                                                        <label class="form-label"
                                                            for="preferred_specialization">{{ __('profile.Partner_Specialization') }}</label>
                                                        <select class="form-control" name="preferred_specialization_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['specializations'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_specialization'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <!--  Hobbies && Pets -->
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">


                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-paw"></i> {{ __('profile.Hobbies_&_Pets') }}
                                                    </h5>




                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- Religion & Marriage --}}
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">

                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-diamond"></i>
                                                        {{ __('profile.Partner_Religion_&_Marriage') }}
                                                    </h5>

                                                    {{-- Religion --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="preferred_religiosity_level">{{ __('profile.Partner_Religion') }}</label>
                                                        <select class="form-control" name="preferred_religion_id" id="religion_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['religions'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_religion'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    {{-- Religiosity Level --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="preferred_religiosity_level">{{ __('profile.Partner_Religiosity_Level') }}</label>
                                                        <select class="form-control" name="preferred_religiosity_level_id"
                                                            id="preferred_religiosity_level">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            {{-- make it loaded when the user alerady has value --}}
                                                            {{-- @foreach ($data['religiousLevels'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_religiosity_level'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>

                                                    {{-- Children Count --}}
                                                    {{-- <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('profile.Children_Count') }}</label>
                                                        <input type="number" class="form-control"
                                                            name="preferred_children_count" min="0"
                                                            value="{{ $userPreferences['preferred_children_count'] }}">
                                                    </div> --}}
                                                    {{-- Marriage Budget --}}
                                                    {{-- @if (Auth::check() && Auth::user()->gender == 'female') --}}
                                                        {{-- Hijab Status --}}
                                                        {{-- <div class="form-group">
                                                            <label
                                                                class="form-label">{{ __('profile.Partner_Hijab_Status') }}</label>
                                                            <select class="form-control" name="preferred_hijab_status">
                                                                <option value=""
                                                                    {{ is_null($userPreferences['preferred_hijab_status']) || $userPreferences['preferred_hijab_status'] == 3 ? 'selected' : '' }}>
                                                                    {{ __('profile.Partner_No_Preference') }}</option>
                                                                <option value="1"
                                                                    {{ $userPreferences['preferred_hijab_status'] == 1 ? 'selected' : '' }}>
                                                                    {{ __('profile.Yes') }}</option>
                                                                <option value="0"
                                                                    {{ $userPreferences['preferred_hijab_status'] == 0 ? 'selected' : '' }}>
                                                                    {{ __('profile.No') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="preferred_marriage_budget">{{ __('profile.Partner_Marriage_Budget') }}</label>
                                                            <select class="form-control"
                                                                name="preferred_marriage_budget_id"
                                                                id="preferred_marriage_budget">
                                                                <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                @foreach ($data['marriageBudget'] as $option)
                                                                    <option value="{{ $option->id }}"
                                                                        {{ $userPreferences['preferred_marriage_budget'] == $option->name ? 'selected' : '' }}>
                                                                        {{ $option->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    {{-- @endif --}}
                                                              {{-- Marital Status --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="preferred_marital_status">{{ __('profile.Partner_Marital_Status') }}</label>
                                                        <select class="form-control" name="preferred_marital_status_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['maritalStatuses'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_marital_status'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- (اختياري) Religion و Hijab Status إذا كنت تستخدمهم مستقبلاً --}}

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Employment Card -->
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">


                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-briefcase"></i>
                                                        {{ __('profile.Partner_Employment') }}
                                                    </h5>

                                                    {{-- Job Title --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="preferred_job_title">{{ __('profile.Partner_Job_Title') }}</label>
                                                        <select class="form-control" name="preferred_job_title_id"
                                                            id="preferred_job_title">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['jobTitles'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_job_title'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- Employment Status --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="preferred_employment_status">{{ __('profile.Partner_Employment_Status') }}</label>
                                                            <select class="form-control" name="preferred_employment_status" id="preferred_employment_status">
                                                                {{-- NULL = No Preference --}}
                                                                <option value=""
                                                                    {{ ($userPreferences['preferred_employment_status'] ?? null) === null ? 'selected' : '' }}>
                                                                    {{ __('profile.Partner_No_Preference') }}
                                                                </option>

                                                                {{-- 1 = Employed --}}
                                                                <option value="1"
                                                                    {{ ($userPreferences['preferred_employment_status'] ?? null) === 1 || ($userPreferences['preferred_employment_status'] ?? null) === '1' ? 'selected' : '' }}>
                                                                     @lang('profile.employed')
                                                                </option>

                                                                {{-- 0 = Unemployed --}}
                                                                <option value="0"
                                                                    {{ ($userPreferences['preferred_employment_status'] ?? null) === 0 || ($userPreferences['preferred_employment_status'] ?? null) === '0' ? 'selected' : '' }}>
                                                                    @lang('profile.unemployed')

                                                                </option>
                                                            </select>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                             <!-- Lifestyle & Habits -->
                                        <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">


                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-heart"></i>
                                                        {{ __('profile.Partner_Lifestyle_&_Habits') }}
                                                    </h5>

                                                    {{-- Smoking Status --}}
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="preferred_smoking_status">{{ __('profile.Partner_Smoking_Status') }}</label>
                                                            <select class="form-control" name="preferred_smoking_status" id="preferred_smoking_status">
                                                                {{-- NULL = “No Preference” --}}
                                                                <option value=""
                                                                    {{ is_null($userPreferences['preferred_smoking_status'] ?? null) ? 'selected' : '' }}>
                                                                    {{ __('profile.Partner_No_Preference') }}
                                                                </option>

                                                                {{-- 1 = Yes --}}
                                                                <option value="1"
                                                                    {{ ($userPreferences['preferred_smoking_status'] ?? null) == 1 ? 'selected' : '' }}>
                                                                    {{ __('profile.Yes') }}
                                                                </option>

                                                                {{-- 0 = No --}}
                                                                <option value="0"
                                                                    {{ ($userPreferences['preferred_smoking_status'] ?? null) === 0 ? 'selected' : '' }}>
                                                                    {{ __('profile.No') }}
                                                                </option>
                                                            </select>

                                                    </div>

                                                    {{-- Smoking Tools --}}
                                                    @if (!empty($data['smokingTools']))
                                                        <div class="form-group smoking-tools-wrapper"
                                                            style="display: none;">
                                                            <label class="form-label">
                                                                {{ __('profile.Partner_smoking_tools') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select name="preferred_smoking_tools[]"
                                                                class="form-control rounded-pill" multiple>
                                                                <option value="null"> {{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                @foreach ($data['smokingTools'] as $tool)
                                                                    <option value="{{ $tool->id }}"
                                                                        @if (in_array($tool->id, $userPreferences['preferred_smoking_tools']->pluck('id')->toArray())) selected @endif>
                                                                        {{ $tool->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <span class="error-message text-danger"
                                                                style="font-size:12px;"></span>
                                                        </div>
                                                    @endif

                                                    @if (Auth::check() && Auth::user()->gender == 'female')
                                                        {{-- Check if user is female --}}

                                                        {{-- Car Ownership --}}
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label">{{ __('profile.Partner_Car_Ownership') }}</label>
                                                            <select class="form-control" name="preferred_car_ownership">
                                                                <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                <option value="1"
                                                                    {{ $userPreferences['preferred_car_ownership'] ? 'selected' : '' }}>
                                                                    {{ __('profile.Yes') }}</option>
                                                                <option value="0"
                                                                    {{ $userPreferences['preferred_car_ownership'] === false ? 'selected' : '' }}>
                                                                    {{ __('profile.No') }}</option>
                                                            </select>
                                                        </div>
                                                    @endif

                                                    {{-- Drinking Status --}}
                                                    @if (!empty($data['drinkingStatuses']))
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="preferred_drinking_status">{{ __('profile.Partner_Drinking_Status') }}</label>
                                                            <select class="form-control"
                                                                name="preferred_drinking_status_id"
                                                                id="preferred_drinking_status">
                                                                <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                @foreach ($data['drinkingStatuses'] as $status)
                                                                    <option value="{{ $status->id }}"
                                                                        {{ $userPreferences['preferred_drinking_status'] == $status->name ? 'selected' : '' }}>
                                                                        {{ $status->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif

                                                    {{-- Sleep Habit --}}
                                                    @if (!empty($data['sleepHabits']))
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="preferred_sleep_habit">{{ __('profile.Partner_Sleep_Habit') }}</label>
                                                            <select class="form-control" name="preferred_sleep_habit_id">
                                                                <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                @foreach ($data['sleepHabits'] as $option)
                                                                    <option value="{{ $option->id }}"
                                                                        {{ $userPreferences['preferred_sleep_habit'] == $option->name ? 'selected' : '' }}>
                                                                        {{ $option->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif

                                                    {{-- Sports Activity --}}
                                                    @if (!empty($data['sportsActivities']))
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="preferred_sports_activity">{{ __('profile.Partner_Sports_Activity') }}</label>
                                                            <select class="form-control"
                                                                name="preferred_sports_activity_id"
                                                                id="preferred_sports_activity">
                                                                <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                @foreach ($data['sportsActivities'] as $option)
                                                                    <option value="{{ $option->id }}"
                                                                        {{ $userPreferences['preferred_sports_activity'] == $option->name ? 'selected' : '' }}>
                                                                        {{ $option->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                      {{-- Hobbies --}}

                                                    <div class="form-group w-100">
                                                        <label class="form-label">
                                                            {{ __('profile.Partner_Hobbies') }}
                                                        </label>
                                                        <select name="preferred_hobbies_id[]"
                                                            class="form-control rounded-pill w-100" multiple>
                                                            @foreach ($data['hobbies'] as $hobby)
                                                                <option value="{{ $hobby->id }}"
                                                                    @if (in_array($hobby->id, $userPreferences['preferred_hobbies']->pluck('id')->toArray())) selected @endif>
                                                                    {{ $hobby->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>

                                                    {{-- Pets --}}
                                                    <div class="form-group w-100">
                                                        <label class="form-label">
                                                            {{ __('profile.Partner_Pets') }}
                                                        </label>
                                                        <select name="preferred_pets_id[]"
                                                            class="form-control rounded-pill w-100" multiple>
                                                            @foreach ($data['pets'] as $pet)
                                                                <option value="{{ $pet->id }}"
                                                                    @if (in_array($pet->id, $userPreferences['preferred_pets']->pluck('id')->toArray())) selected @endif>
                                                                    {{ $pet->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="col-lg-6 col-12 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="simple-icon-home"></i>
                                                        {{ __('profile.Partner_Housing_&_Financial_Info') }}
                                                    </h5>



                                                    {{-- Financial Status --}}
                                                    <div class="form-group ">
                                                        <label class="form-label"
                                                            for="preferred_financial_status">{{ __('profile.Partner_Financial_Status') }}</label>
                                                        <select class="form-control" name="preferred_financial_status_id">
                                                            <option value="">{{ __('profile.Partner_No_Preference') }}
                                                            </option>
                                                            @foreach ($data['financialStatuses'] as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $userPreferences['preferred_financial_status'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- Housing Status --}}
                                                    @if (Auth::check() && Auth::user()->gender == 'female')
                                                        {{-- Check if user is female --}}
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label">{{ __('profile.Housing_Status') }}</label>
                                                            <select class="form-control"
                                                                name="preferred_housing_status_id">
                                                                <option value="">{{ __('profile.Partner_No_Preference') }}
                                                                </option>
                                                                @foreach ($data['housingStatuses'] as $option)
                                                                    <option value="{{ $option->id }}"
                                                                        {{ $userPreferences['preferred_housing_status'] == $option->id ? 'selected' : '' }}>
                                                                        {{ $option->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif


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


                                        {{-- @if ($userProfile['gender'] === 'female')
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="card mb-3">
                                            <div class="position-absolute card-top-buttons">
                                                <button class="btn btn-header-light icon-button">
                                                </button>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="iconsminds-network"></i> {{ __('profile.Guardian_Contact_&_Social_Media') }}
                                                </h5>
                                                <div>
                                                    <!-- Contact (Encrypted) -->
                                                    <div class="d-flex flex-row mb-2">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Guardian_Contact') }}:</strong> {{ $userProfile['profile']['guardian_contact'] ?? 'None' }}
                                                        </div>
                                                    </div>
                                                    <!-- Social Media Presence -->
                                                    <div class="d-flex flex-row mb-2">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>{{ __('profile.Social_Media_Presence') }}:</strong> {{ $userPreferences['preferred_social_media_presence'] ?? 'N/A' }}
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
                                                <i class="iconsminds-network"></i> {{ __('profile.Contact_&_Social_Media') }}
                                            </h5>
                                            <div>
                                                <!-- Contact (Encrypted) -->
                                                <div class="d-flex flex-row mb-2">
                                                    <div class="pl-3 pt-2 pr-2 pb-2">
                                                        <strong>{{ __('profile.Contact') }}:</strong> {{ $userProfile['phone_number'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                                <!-- Social Media Presence -->
                                                <div class="d-flex flex-row mb-2">
                                                    <div class="pl-3 pt-2 pr-2 pb-2">
                                                        <strong>{{ __('profile.Social_Media_Presence') }}:</strong> {{ $userProfile['profile']['social_media_presence'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                    @endif --}}

                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>

                <div class="d-flex justify-content-end"
                >
                    <button type="submit"
                        class="btn btn-lg btn-primary mt-3 top-right-button top-right-button-single">
                        {{ __('profile.Desired_Partner_characteristics') }}
                    </button>
                </div>

                </form>
            </div>

        </div>
    </div>
    </div>
    </div>
    </main>
    @push('scripts')
        <script>
             var userGender = "{{ old('gender', auth()->user()->gender ?? '') }}";

// Function to load religiosity levels
function loadReligiosityLevels(religionId, selectedLevelId = null) {
    $('#preferred_religiosity_level')
        .empty()
        .append('<option value="">{{ __("onboarding.select_religiosity") }}</option>');

    if (religionId) {
        $.ajax({
            url: "{{ route('religious.levels.gender') }}",
            type: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                religion_id: religionId,
                // send  opposite gender to get the right levels from the api
                gender: userGender === 'male' ? 2 : 1
            },
            success: function (response) {
                if (response.religiousLevels && response.religiousLevels.length > 0) {
                    $.each(response.religiousLevels, function (index, level) {
                        $('#preferred_religiosity_level').append(
                            '<option value="' + level.id + '"' +
                            (level.id == selectedLevelId ? ' selected' : '') +
                            '>' + level.name + '</option>'
                        );
                    });
                }
            },
            error: function (xhr) {
                console.error('Error fetching religiosity levels:', xhr.responseText);
            }
        });
    }
}

// On change
$('#religion_id').on('change', function () {
    var religionId = $(this).val();
    loadReligiosityLevels(religionId);
});

// 🚀 Preload on page load if religion is already selected
$(document).ready(function () {
    var preselectedReligionId = $('#religion_id').val();
    var selectedReligiosityLevelId = "{{ old('preferred_religiosity_level_id', $userPreferences['preferred_religiosity_level_id'] ?? '') }}";

    if (preselectedReligionId) {
        loadReligiosityLevels(preselectedReligionId, selectedReligiosityLevelId);
    }
});

            $(document).ready(function() {
                const MAX_FIELDS = 10;
                const trackedInputsSelector =
                    'input:not([type="hidden"]):not([type="submit"]):not([type="radio"]), select, textarea';

                function countTotalSelected() {
                    let count = 0;
                    const ageMinVal = parseInt($('#preferred_age_min').val()) || 18;
                    const ageMaxVal = parseInt($('#preferred_age_max').val()) || 65;

                    $(trackedInputsSelector).each(function() {
                        const el = $(this);
                        const name = el.attr('name');
                        const type = el.attr('type');
                        const id = el.attr('id');
                        const value = el.val();

                        if (type === 'hidden' || type === 'submit' || type === 'radio' || id === 'ageMin' ||
                            id === 'ageMax') return;
                        if (el.prop('disabled')) return;

                        if (el.is('select[multiple]')) {
                            if (value && value.length > 0 && value.some(v => v !== '' && v !== 'null' && v !==
                                    'No Preference')) {
                                // console.log(`Multi-select ${name} counted:`, value);
                                count += 1;
                            }
                        } else if (value && value !== '' && value !== 'null' && value !== 'No Preference') {
                            // console.log(`Input ${name} counted:`, value);
                            count += 1;
                        }
                    });

                    if (ageMinVal !== 18 || ageMaxVal !== 65) {
                        // console.log(`Age range counted: ${ageMinVal} - ${ageMaxVal}`);
                        count += 1;
                    }

                    // console.log('Total count:', count);
                    return count;
                }







                function updateRemainingCountDisplay(remaining) {
                    $('#remaining-count').text(remaining);
                }

                function toggleFieldsDisabledState() {
                    const total = countTotalSelected();
                    const remaining = MAX_FIELDS - total;
                    const disable = total >= MAX_FIELDS;

                    updateRemainingCountDisplay(remaining >= 0 ? remaining : 0);

                    $(trackedInputsSelector).each(function() {
                        const el = $(this);
                        if (!el.is(':focus')) {
                            el.prop('disabled', disable && !el.val());
                        }
                    });
                }

                function enforceLimit(e) {
                    const total = countTotalSelected();

                    if (total > MAX_FIELDS) {
                        e.preventDefault();
                        const $field = $(this);
                        $field.val(null).trigger('change');
                        alert(`⚠️ You can only fill up to ${MAX_FIELDS} fields in total.`);
                    }

                    toggleFieldsDisabledState();
                }

                $(document).on('change input', trackedInputsSelector, enforceLimit);
                toggleFieldsDisabledState(); // Initial run
            });

            $('#user-preference-form').on('submit', function(e) {
                e.preventDefault(); // Prevent page refresh

                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                submitBtn.prop('disabled', true).text('{{ __('profile.Saving...') }}');

                // Clear previous errors
                $('.error-message').text('');
                $('.form-control').removeClass('is-invalid');
                let formData = {};
                form.serializeArray().forEach(item => {
                    const isEmpty = item.value === '' || item.value === 'null' || item.value ===
                    'No Preference';
                    if (formData[item.name]) {
                        // Handle multiple values (like multiselects)
                        if (!Array.isArray(formData[item.name])) {
                            formData[item.name] = [formData[item.name]];
                        }
                        formData[item.name].push(isEmpty ? null : item.value);
                    } else {
                        formData[item.name] = isEmpty ? null : item.value;
                    }
                });
                $.ajax({
                    url: '{{ route('api.user-preferences.store') }}',
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept-Language': '{{ app()->getLocale() }}'
                    },
                    success: function(response) {
                        // console.log('Success response:', response);
                        // console.log('preferred_housing_status_id:', $('[name="preferred_housing_status_id"]').val());
                        // console.log('preferred_marriage_budget_id:', $('[name="preferred_marriage_budget_id"]').val());
                        // console.log('preferred_religiosity_level_id:', $('[name="preferred_religiosity_level_id"]').val());
                        const alertContainer = $('#preference-success-alert');
                        $('#preference-success-message').text(
                            "{{ __('profile.Desired_partner_characteristics_saved_successfully') }}");

                        alertContainer.removeClass('d-none').css('display', 'block').hide().fadeIn();

                        submitBtn.prop('disabled', false).text('{{ __('profile.Saved') }}');

                        setTimeout(() => {
                            alertContainer.fadeOut(300, () => {
                                alertContainer.addClass('d-none').removeAttr('style');
                            });
                        }, 10000);
                    },
                    error: function(xhr) {

                        submitBtn.prop('disabled', false).text('{{ __('profile.Save') }}');

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;

                            // ✅ Log the errors clearly
                            console.log('🚫 Validation Error Response:', xhr.responseJSON);
                            console.log('❗ Validation Errors:', errors);
                            console.table(errors); // Nice tabular view in browser console

                            for (const [field, messages] of Object.entries(errors)) {
                                const fieldEl = $(`[name="${field}"]`);
                                fieldEl.addClass('is-invalid');
                                if (!fieldEl.siblings('.error-message').length) {
                                    fieldEl.after('<span class="error-message text-danger"></span>');
                                }
                                fieldEl.siblings('.error-message').text(messages[0]);
                            }
                        } else {
                            console.error('Unexpected error:', xhr);
                            alert("{{ __('Something went wrong. Please try again.') }}");
                        }
                    }
                });
            });

            // Assume user gender is available from a hidden field or global variable.
            var userGender = "{{ old('gender', auth()->user()->gender ?? '') }}";

            // Save progress to localStorage and load on page load.
            const formSelector = '#onboarding-form';
            const formStorageKey = 'onboardingFormData';

            function saveFormData() {
                const formData = $(formSelector).serializeArray();
                let dataObj = {};
                formData.forEach(item => {
                    dataObj[item.name] = item.value;
                });
                localStorage.setItem(formStorageKey, JSON.stringify(dataObj));
            }

            function loadFormData() {
                const stored = localStorage.getItem(formStorageKey);
                if (stored) {
                    const dataObj = JSON.parse(stored);
                    for (const [key, value] of Object.entries(dataObj)) {
                        $(`[name="${key}"]`).val(value);
                    }
                }
            }

            $(document).ready(function() {
                function validateReligiosityLevel() {
                    var religiosityField = $('select[name="preffered_religiosity_level_id"]');
                    var religiosityValue = religiosityField.val();

                    // If the field is empty, set it to required
                    if (!religiosityValue) {
                        religiosityField.prop('required', true);
                    } else {
                        religiosityField.prop('required', false);
                    }
                }

                // Run the check when the page loads
                validateReligiosityLevel();

                // Check again if the field changes
                $('select[name="religiosity_level_id"]').on('change', function() {
                    validateReligiosityLevel();
                });
                loadFormData();

                // Save data on change
                $('#onboarding-form').on('change', 'input, select, textarea', function() {
                    saveFormData();
                });

                // Initialize Select2 on multi-selects
                $('select[multiple]').select2({
                    placeholder: "{{ __('profile.you_can_select_more_than_one') }}",
                    allowClear: true
                });

                // Remove housing and marriage budget for female users
                if (userGender === 'female') {
                    // In Step 3, remove housing status and marriage budget fields
                    $('select[name="housing_status_id"]').closest('.form-group').remove();
                    $('select[name="marriage_budget_id"]').closest('.form-group').remove();
                }

                // Remove guardian contact for male users (Step 4)
                if (userGender === 'male') {
                    $('input[name="guardian_contact"]').closest('.form-group').remove();
                }

                if (window.religiousLevels) {
                    var $select = $('#religiosity_levels');
                    $select.empty();
                    $select.append('<option value="">{{ __('onboarding.select_religiosity') }}</option>');
                    window.religiousLevels.forEach(function(option) {
                        $select.append('<option value="' + option.id + '">' + option.name + '</option>');
                    });
                }

                // Initialize the state based on the current smoking status
                toggleSmokingTools();

                // Bind the change event to toggle the visibility of smoking tools
                $('select[name="preferred_smoking_status"]').change(function() {
                    toggleSmokingTools();
                });

                // Function to toggle the visibility and validation of the smoking tools based on smoking status
                function toggleSmokingTools() {
                    var smokingStatus = $('select[name="preferred_smoking_status"]').val();
                    var $smokingToolsWrapper = $('.smoking-tools-wrapper');

                    if (smokingStatus === "1") {
                        // Show the smoking tools dropdown and set it as required
                        $smokingToolsWrapper.show();
                        $smokingToolsWrapper.find('select').prop('required', true);
                    } else {
                        // Hide the smoking tools dropdown, reset its value, and remove validation
                        $smokingToolsWrapper.hide();
                        $smokingToolsWrapper.find('select').prop('required', false).val('').trigger('change');
                        $smokingToolsWrapper.find('select').removeClass('is-valid is-invalid');
                        $smokingToolsWrapper.find('.error-message').text('');
                    }
                }

                // Toggle Job Title based on Employment Status
                function toggleJobTitle() {
                    var employmentStatus = $('select[name="employment_status"]').val();
                    var $jobTitleWrapper = $('.job-title-wrapper');
                    if (employmentStatus === "1") {
                        $jobTitleWrapper.show();
                        $jobTitleWrapper.find('select').prop('required', true);
                    } else {
                        $jobTitleWrapper.hide();
                        $jobTitleWrapper.find('select').prop('required', false).val('').trigger('change');
                        $jobTitleWrapper.find('select').removeClass('is-valid is-invalid');
                        $jobTitleWrapper.find('.error-message').text('');
                    }
                }

                // Run toggles on page load
                toggleSmokingTools();
                toggleJobTitle();

                // Bind change events for conditional fields
                $('select[name="smoking_status"]').on('change', function() {
                    toggleSmokingTools();
                });
                $('select[name="employment_status"]').on('change', function() {
                    toggleJobTitle();
                });

                // Function to mark fields as touched
                function markStepFieldsAsTouched(step) {
                    $(step).find('input, select, textarea').each(function() {
                        $(this).data('touched', true);
                    });
                }
                $('#customFile').on('change', function() {
                    const input = this;

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview').attr('src', e.target.result).fadeIn();
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                });
                // Validate individual field
                function validateField(field) {
                    // Skip validation if the field is hidden.
                    if ($(field).is(':hidden')) {
                        return true;
                    }

                    var fieldValue = $(field).val();
                    var value = Array.isArray(fieldValue) ? fieldValue : (fieldValue ? fieldValue.trim() : '');
                    var fieldName = $(field).attr('name');
                    var errorSpan = $(field).closest('.form-group').find('.error-message');
                    var touched = $(field).data('touched');
                    var isValid = true;
                    errorSpan.text('');

                    if (!touched) {
                        return true;
                    }

                    if ($(field).prop('required')) {
                        if (Array.isArray(value) && value.length === 0) {
                            errorSpan.text("{{ __('onboarding.required') }}");
                            return false;
                        }
                        if ($(field).is('select') && value === '') {
                            errorSpan.text("{{ __('onboarding.required') }}");
                            return false;
                        }
                        if (!Array.isArray(value) && !value) {
                            errorSpan.text("{{ __('onboarding.required') }}");
                            return false;
                        }
                    }

                    // Explicit checks for specific selects
                    if ((fieldName === 'specialization_id' || fieldName === 'job_title_id' || fieldName ===
                            'drinking_status_id') && value === '') {
                        errorSpan.text("{{ __('onboarding.required') }}");
                        return false;
                    }

                    switch (fieldName) {
                        case 'email':
                            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(value)) {
                                errorSpan.text("{{ __('onboarding.invalid_email') }}");
                                isValid = false;
                            }
                            break;
                        case 'phone_number':
                            var phoneRegex = /^(078|077|079)\d{7}$/;
                            if (!phoneRegex.test(value)) {
                                errorSpan.text("{{ __('onboarding.invalid_phone') }}");
                                isValid = false;
                            }
                            break;
                        case 'password':
                            if (value.length < 8) {
                                errorSpan.text("{{ __('onboarding.password_min') }}");
                                isValid = false;
                            }
                            break;
                        case 'password_confirmation':
                            var password = $('input[name="password"]').val();
                            if (value !== password) {
                                errorSpan.text("{{ __('onboarding.password_mismatch') }}");
                                isValid = false;
                            }
                            break;
                        case 'date_of_birth':
                            var today = new Date();
                            var birthDate = new Date(value);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var monthDiff = today.getMonth() - birthDate.getMonth();
                            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            if (age < 18) {
                                errorSpan.text("{{ __('onboarding.age_min') }}");
                                isValid = false;
                            }
                            if (age > 100) {
                                errorSpan.text("{{ __('onboarding.age_max') }}");
                                isValid = false;
                            }
                            break;
                        case 'bio_ar':
                            var arabicRegex = /[\u0600-\u06FF]+/;
                            if (!arabicRegex.test(value)) {
                                errorSpan.text("{{ __('onboarding.arabic_required') }}");
                                isValid = false;
                            }
                            break;
                        case 'guardian_contact':
                            var guardianRegex = /^(078|077|079)\d{7}$/;
                            if (!guardianRegex.test(value)) {
                                errorSpan.text("{{ __('onboarding.invalid_guardian_contact') }}");
                                isValid = false;
                            }
                            break;
                        case 'photo_url':
                            if (value) {
                                var fileExtension = value.split('.').pop().toLowerCase();
                                var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                if (!allowedExtensions.includes(fileExtension)) {
                                    errorSpan.text("{{ __('onboarding.invalid_image_file') }}");
                                    isValid = false;
                                }
                                if ($(field)[0].files.length > 0) {
                                    var fileSize = $(field)[0].files[0].size / 1024 / 1024;
                                    if (fileSize > 5) {
                                        errorSpan.text("{{ __('onboarding.file_size') }}");
                                        isValid = false;
                                    }
                                }
                            }
                            break;
                        case 'number_of_children':
                            if (value && (isNaN(value) || value < 0 || value > 10)) {
                                errorSpan.text("{{ __('onboarding.children_range') }}");
                                isValid = false;
                            }
                            break;
                        case 'smoking_tools[]':
                            // If smoking_status is "1" (smoker), at least one smoking tool is required.
                            var smokingStatus = $('select[name="smoking_status"]').val();
                            if (smokingStatus === "1") {
                                if (!value || (Array.isArray(value) && value.length === 0) || value === '') {
                                    errorSpan.text("{{ __('onboarding.required') }}");
                                    isValid = false;
                                }
                            }
                            break;
                        default:
                            break;
                    }

                    if (isValid) {
                        $(field).removeClass('is-invalid').addClass('is-valid');
                    } else {
                        $(field).removeClass('is-valid').addClass('is-invalid');
                    }
                    return isValid;
                }








                $('#country_id').on('change', function() {
                    var countryId = $(this).val();
                    $('#city_id').empty().append(
                        '<option value="">{{ __('onboarding.select_city') }}</option>');
                    if (countryId) {
                        $.ajax({
                            url: "{{ route('cities.by.country', '') }}/" + countryId,
                            type: 'GET',
                            success: function(data) {
                                $.each(data, function(index, city) {
                                    $('#city_id').append('<option value="' + city.id +
                                        '">' + city.name + '</option>');
                                });
                            },
                        });
                    }
                });
                // Pre-load cities for the currently selected country when the page loads
                $(document).ready(function() {
                    var selectedCountryId = $('#country_id')
                .val(); // Get the selected country ID from the dropdown
                    if (selectedCountryId) {
                        loadCities(selectedCountryId);
                    }

                    // When country changes, update the cities
                    $('#country_id').on('change', function() {
                        var countryId = $(this).val();
                        $('#city_id').empty().append(
                            '<option value="">{{ __('onboarding.select_city') }}</option>'
                            ); // Clear the cities dropdown
                        if (countryId) {
                            loadCities(countryId);
                        }
                    });

                    // Function to load cities based on the country ID
                    function loadCities(countryId) {
                        $.ajax({
                            url: "{{ route('cities.by.country', '') }}/" + countryId,
                            type: 'GET',
                            success: function(data) {
                                $.each(data, function(index, city) {
                                    // Check if the city should be selected
                                    var isSelected =
                                        '{{ old('preferred_city_id', $userPreferences['preferred_city_id'] ?? '') }}' ==
                                        city.id;
                                    $('#city_id').append('<option value="' + city.id +
                                        '" ' + (isSelected ? 'selected' : '') + '>' +
                                        city.name + '</option>');
                                });
                            },
                        });
                    }
                });

            });

          document.addEventListener('DOMContentLoaded', function() {
    const minRange  = document.getElementById('ageMin');
    const maxRange  = document.getElementById('ageMax');
    const minLabel  = document.getElementById('age-min-label');
    const maxLabel  = document.getElementById('age-max-label');
    const highlight = document.querySelector('.range-highlight');

    function updateSlider() {
        const min = +minRange.min, max = +minRange.max;
        const rawMinPct = ((+minRange.value - min) / (max - min)) * 100;
        const rawMaxPct = ((+maxRange.value - min) / (max - min)) * 100;
        const isRTL = "{{ app()->getLocale() }}" === 'ar';

        const minPct = isRTL ? 100 - rawMinPct : rawMinPct;
        const maxPct = isRTL ? 100 - rawMaxPct : rawMaxPct;
        const left  = Math.min(minPct, maxPct);
        const width = Math.abs(maxPct - minPct);

        // move the colored bar
        highlight.style.left  = left  + '%';
        highlight.style.width = width + '%';

        // ** update your labels here **
        minLabel.textContent = minRange.value;
        maxLabel.textContent = maxRange.value;
        document.getElementById('preferred_age_min').value = minRange.value;
  document.getElementById('preferred_age_max').value = maxRange.value;

    }

    // keep hidden inputs in sync if you have them:
    function updateFromInputs() {
        const minVal = Math.max(18, Math.min(+minLabel.textContent, +maxLabel.textContent));
        const maxVal = Math.min(65, Math.max(+minLabel.textContent, +maxLabel.textContent));
        minRange.value = minVal;
        maxRange.value = maxVal;
        updateSlider();
    }

    // wire up the events
    minRange.addEventListener('input', updateSlider);
    maxRange.addEventListener('input', updateSlider);
    // if you also allow typing in text inputs:
    document.getElementById('preferred_age_min').addEventListener('change', updateFromInputs);
    document.getElementById('preferred_age_max').addEventListener('change', updateFromInputs);

    // initial draw
    updateSlider();
});

        </script>
    @endpush
    {{--
@push('scripts')
<script>
    function loadCities(countryId, selectedCity = '') {
        $('#city_id').empty().append('<option value="">' + @json(__('onboarding.select_city')) + '</option>');

        if (countryId) {
            $.ajax({
                url: '{{ route('cities.by.country', ':countryId') }}'.replace(':countryId', countryId),
                type: 'GET',
                success: function (cities) {
                    cities.forEach(function (city) {
                        const isSelected = city.name === selectedCity ? 'selected' : '';
                        $('#city_id').append(`<option value="${city.name}" ${isSelected}>${city.name}</option>`);
                    });
                }
            });
        }
    }

    // عند تغيير الدولة
    $('#country_id').change(function () {
        const countryId = $(this).val();
        loadCities(countryId);
    });

    // تحميل المدن عند فتح الصفحة (للدولة المحفوظة)
    $(document).ready(function () {
        const selectedCountry = $('#country_id').val();
        const selectedCity = @json($userPreferences['preferred_city'] ?? '');
        if (selectedCountry) {
            loadCities(selectedCountry, selectedCity);
        }
    });
</script>
@endpush --}}


@endsection
