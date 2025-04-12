@extends('user.layouts.app')

@section('content')

<style>

    .card-title{
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form id="user-preference-form" method="POST">
                @csrf
            <div class="mb-2">
                <h1>{{ ucfirst(auth()->user()->first_name) .' '. ucfirst(auth()->user()->last_name) }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="submit"
                        class="btn btn-lg btn-primary mt-1   top-right-button top-right-button-single"
                       >
                        {{ __('profile.Desired_Partner_characteristics') }}
                    </button>

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
            <div id="field-limit-counter"
            class="alert alert-info py-2 px-3 mb-3 shadow-sm"
            style="font-size: 16px; position: sticky; top: 105px; left: 0; z-index: 1050;">
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
                                                    <i class="simple-icon-user"></i> {{ __('profile.Personal_Info') }}
                                                </h5>
                                                <div>

                                            {{-- Nationality --}}
                                            @if (!empty($data['nationalities']))
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_nationality">{{ __('profile.Nationality') }}</label>
                                                    <select class="form-control" name="preferred_nationality_id">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['nationalities'] as $option)
                                                            <option value="{{ $option->id }}" {{ $userPreferences['preferred_nationality'] == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif


                                                    <!-- Origin -->
                                                    @if (!empty($data['origins']))
                                                    <div class="form-group">
                                                        <label class="form-label" for="preferred_origin">{{ __('profile.Origin') }}</label>
                                                        <select class="form-control" name="preferred_origin_id">
                                                            <option value="">No Preference</option>
                                                            @foreach($data['origins'] as $option)
                                                                <option value="{{ $option->id }}" {{ $userPreferences['preferred_origin'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                <!-- Height -->
                                                @if (!empty($data['heights']))
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_height">{{ __('profile.height') }}</label>
                                                    <select class="form-control" name="preferred_height_id">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['heights'] as $option)
                                                            <option value="{{ $option->id }}" {{ $userPreferences['preferred_height'] == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                                <!-- Weight -->
                                                @if (!empty($data['weights']))
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_weight">{{ __('profile.weight') }}</label>
                                                    <select class="form-control" name="preferred_weight_id">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['weights'] as $option)
                                                            <option value="{{ $option->id }}" {{ $userPreferences['preferred_weight'] == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                                {{-- Age Range --}}
                                                <div class="form-group">
                                                    <label class="form-label d-block mb-2">{{ __('profile.Age') }}</label>

                                                    {{-- Top Labels --}}
                                                    <div class="d-flex justify-content-between px-2 mt-2">

                                                        <div class="bg-light rounded px-3 py-1 border" id="age-min-label">{{ $userPreferences['preferred_age_min'] ?? 18 }}</div>
                                                        <div class="bg-light rounded px-3 py-1 border" id="age-max-label">{{ $userPreferences['preferred_age_max'] ?? 65 }}</div>
                                                    </div>
                                                    {{-- Slider --}}
                                                    {{-- these 4 should be as one input in js --}}
                                                    <div class="position-relative slider-wrapper mb-3">
                                                        <input type="range" min="18" max="65" value="{{ $userPreferences['preferred_age_min'] ?? 18 }}" id="ageMin" class="form-range slider-track">
                                                        <input type="range" min="18" max="65" value="{{ $userPreferences['preferred_age_max'] ?? 65 }}" id="ageMax" class="form-range slider-track">
                                                        <div class="range-highlight"></div>
                                                        <input type="hidden" class="form-control form-control-sm mx-1" name="preferred_age_min" id="preferred_age_min" value="{{ $userPreferences['preferred_age_min'] ?? 18 }}" placeholder="Min Age" min="18" max="100">
                                                        <input type="hidden" class="form-control form-control-sm" name="preferred_age_max" id="preferred_age_max" value="{{ $userPreferences['preferred_age_max'] ?? 60 }}" placeholder="Max Age" min="18" max="100">
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

                                    <!-- Lifestyle & Habits -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">


                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-heart"></i> {{ __('profile.Lifestyle_&_Habits') }}
                                                </h5>

                                               {{-- Smoking Status --}}
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_smoking_status">{{ __('profile.Smoking_Status') }}</label>
                                                    <select class="form-control" name="preferred_smoking_status" id="preferred_smoking_status">
                                                        <option value=""{{ $userPreferences['preferred_smoking_status'] ??'selected' }}>{{ __('profile.No_Preference') }}</option>
                                                        <option value="1" {{ ($userPreferences['preferred_smoking_status'] ?? null) == 1 ? 'selected' : '' }}>{{ __('profile.Yes') }}</option>
                                                        <option value="0" {{ ($userPreferences['preferred_smoking_status'] ?? null) == 0 ? 'selected' : '' }}>{{ __('profile.No') }}</option>
                                                    </select>
                                                </div>

                                                {{-- Smoking Tools --}}
                                                @if (!empty($data['smokingTools']))
                                                    <div class="form-group smoking-tools-wrapper" style="display: none;">
                                                        <label class="form-label">
                                                            {{ __('onboarding.smoking_tools') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="preferred_smoking_tools[]" class="form-control rounded-pill" multiple>
                                                            <option value="null"> No Preferences</option>
                                                            @foreach ($data['smokingTools'] as $tool)
                                                                <option value="{{ $tool->id }}"
                                                                    @if (in_array($tool->id, $userPreferences['preferred_smoking_tools']->pluck('id')->toArray())) selected @endif>
                                                                    {{ $tool->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                @endif



                                                {{-- Drinking Status --}}
                                                @if (!empty($data['drinkingStatuses']))
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_drinking_status">{{ __('profile.Drinking_Status') }}</label>
                                                    <select class="form-control" name="preferred_drinking_status_id" id="preferred_drinking_status">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['drinkingStatuses'] as $status)
                                                            <option value="{{ $status->id }}" {{ $userPreferences['preferred_drinking_status'] == $status->name ? 'selected' : '' }}>
                                                                {{ $status->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                                {{-- Sleep Habit --}}
                                                @if (!empty($data['sleepHabits']))
                                                    <div class="form-group">
                                                        <label class="form-label" for="preferred_sleep_habit">{{ __('profile.Sleep_Habit') }}</label>
                                                        <select class="form-control" name="preferred_sleep_habit_id">
                                                            <option value="">No Preference</option>
                                                            @foreach($data['sleepHabits'] as $option)
                                                                <option value="{{ $option->id }}" {{ $userPreferences['preferred_sleep_habit'] == $option->name ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif

                                                {{-- Sports Activity --}}
                                                @if (!empty($data['sportsActivities']))
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_sports_activity">{{ __('profile.Sports_Activity') }}</label>
                                                    <select class="form-control" name="preferred_sports_activity_id" id="preferred_sports_activity">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['sportsActivities'] as $option)
                                                            <option value="{{ $option->id }}" {{ $userPreferences['preferred_sports_activity'] == $option->name ? 'selected' : '' }}>
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
                                                    <i class="simple-icon-location-pin"></i> {{ __('profile.Location_Info') }}
                                                </h5>


                                                {{-- Country of Residence --}}
                                                <div class="form-group">
                                                    <label class="form-label" for="country_id">{{ __('profile.Country_of_Residence') }}</label>
                                                    <select class="form-control" name="preferred_country_id" id="country_id">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['countries'] as $option)
                                                            <option value="{{ $option->id }}"
                                                                {{ old('country_of_residence', $userPreferences['preferred_country'] ?? '') == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                {{-- City --}}
                                                <div class="form-group">
                                                    <label  class="form-label" for="city_id">{{ __('profile.City') }}</label>
                                                    <select class="form-control" name="preferred_city_id" id="city_id">
                                                        <option value="">{{ __('onboarding.select_city') }}</option>
                                                        @if (!empty($cities))
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ $userPreferences['preferred_city'] == $city->name ? 'selected' : '' }}>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        @elseif(!empty($userPreferences['preferred_city']))
                                                            <option selected value="{{ $userPreferences['preferred_city'] }}">{{ $userPreferences['preferred_city'] }}</option>
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
                                                    <i class="simple-icon-graduation"></i> {{ __('profile.Education') }}
                                                </h5>

                                                {{-- Educational Level --}}
                                                <div class="form-group ">
                                                    <label class="form-label" for="preferred_educational_level">{{ __('profile.Educational_Level') }}</label>
                                                    <select class="form-control" name="preferred_educational_level_id">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['educationalLevels'] as $option)
                                                            <option value="{{ $option->id }}" {{ $userPreferences['preferred_educational_level'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Specialization --}}
                                                <div class="form-group ">
                                                <label  class="form-label" for="preferred_specialization">{{ __('profile.Specialization') }}</label>
                                                <select class="form-control" name="preferred_specialization_id">
                                                    <option value="">No Preference</option>
                                                    @foreach($data['specializations'] as $option)
                                                        <option value="{{ $option->id }}" {{ $userPreferences['preferred_specialization'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Hobbies && Pets -->
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">


                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="fas fa-paw"></i> {{ __('profile.Hobbies_&_Pets') }}
                                                </h5>
                                                {{-- Hobbies --}}

                                                <div class="form-group w-100">
                                                    <label class="form-label">
                                                        {{ __('profile.Hobbies') }}
                                                    </label>
                                                    <select name="preferred_hobbies_id[]" class="form-control rounded-pill w-100" multiple>
                                                        @foreach ($data['hobbies'] as $hobby)
                                                            <option value="{{ $hobby->id }}"
                                                                @if (in_array($hobby->id, $userPreferences['preferred_hobbies']->pluck('id')->toArray())) selected @endif>
                                                                {{ $hobby->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>

                                                {{-- Pets --}}
                                                <div class="form-group w-100">
                                                    <label class="form-label">
                                                        {{ __('profile.Pets') }}
                                                    </label>
                                                    <select name="preferred_pets_id[]" class="form-control rounded-pill w-100" multiple>
                                                        @foreach ($data['pets'] as $pet)
                                                            <option value="{{ $pet->id }}"
                                                                @if (in_array($pet->id, $userPreferences['preferred_pets']->pluck('id')->toArray())) selected @endif>
                                                                {{ $pet->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                     <!-- Employment Card -->
                                     <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">


                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-briefcase"></i> {{ __('profile.Employment') }}
                                                </h5>

                                                {{-- Job Title --}}
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_job_title">{{ __('profile.Job_Title') }}</label>
                                                    <select class="form-control" name="preferred_job_title_id" id="preferred_job_title">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['jobTitles'] as $option)
                                                            <option value="{{ $option->id }}"
                                                                {{ $userPreferences['preferred_job_title'] == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Employment Status --}}
                                                <div class="form-group">
                                                    <label class="form-label" for="preferred_employment_status">{{ __('profile.Employment_Status') }}</label>
                                                    <select class="form-control"
                                                            name="preferred_employment_status"
                                                            id="preferred_employment_status">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        <option value="1" {{ ($userPreferences['preferred_employment_status'] ?? null) == 1 ? 'selected' : '' }}>
                                                            Employed
                                                        </option>
                                                        <option value="0" {{ ($userPreferences['preferred_employment_status'] ?? null) == 0 ? 'selected' : '' }}>
                                                            Unemployed
                                                        </option>
                                                    </select>
                                                </div>


                                            </div>
                                        </div>
                                    </div>





<div class="col-lg-6 col-12 mb-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <i class="simple-icon-home"></i> {{ __('profile.Housing_&_Financial_Info') }}
            </h5>

            {{-- Marital Status --}}
            <div class="form-group">
                <label class="form-label" for="preferred_marital_status">{{ __('profile.Marital_Status') }}</label>
                <select class="form-control" name="preferred_marital_status_id">
                    <option value="">No Preference</option>
                    @foreach($data['maritalStatuses'] as $option)
                        <option value="{{ $option->id }}"
                            {{ $userPreferences['preferred_marital_status'] == $option->name ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>

 {{-- Financial Status --}}
 <div class="form-group ">
    <label class="form-label" for="preferred_financial_status">{{ __('profile.Financial_Status') }}</label>
    <select class="form-control" name="preferred_financial_status_id">
        <option value="">No Preference</option>
        @foreach($data['financialStatuses'] as $option)
            <option value="{{ $option->id }}" {{ $userPreferences['preferred_financial_status'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
        @endforeach
    </select>
</div>



        </div>
    </div>
</div>
<div class="col-lg-6 col-12 mb-4">
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">
                <i class="simple-icon-diamond"></i> {{ __('profile.Religion_&_Marriage') }}
            </h5>

            {{-- Religiosity Level --}}
            <div class="form-group">
                <label class="form-label" for="preferred_religiosity_level">{{ __('profile.Religiosity_Level') }}</label>
                <select class="form-control" name="preferred_religiosity_level_id" id="preferred_religiosity_level">
                    <option value="">No Preference</option>
                    @foreach($data['religiousLevels'] as $option)
                        <option value="{{ $option->id }}" {{ $userPreferences['preferred_religiosity_level'] == $option->name ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Marriage Budget --}}
            @if ($data['gender'] != 'female')

            <div class="form-group">
                <label class="form-label" for="preferred_marriage_budget">{{ __('profile.Marriage_Budget') }}</label>
                <select class="form-control" name="preferred_marriage_budget_id" id="preferred_marriage_budget">
                    <option value="">{{ __('No Preference') }}</option>
                    @foreach($data['marriageBudget'] as $option)
                        <option value="{{ $option->id }}" {{ $userPreferences['preferred_marriage_budget'] == $option->name ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            {{-- (اختياري) Religion و Hijab Status إذا كنت تستخدمهم مستقبلاً --}}
            {{--
            <div class="form-group">
                <label for="religion">{{ __('profile.Religion') }}</label>
                <input type="text"
                       class="form-control"
                       name="religion"
                       id="religion"
                       value="{{ $userProfile['profile']['religion'] ?? '' }}"
                       placeholder="No Preference">
            </div>

            @if ($userProfile['gender'] === 'female')
            <div class="form-group">
                <label for="hijab_status">{{ __('profile.Hijab_Status') }}</label>
                <input type="text"
                       class="form-control"
                       name="hijab_status"
                       id="hijab_status"
                       value="{{ $userProfile['profile']['hijab_status'] ?? '' }}"
                       placeholder="No Preference">
            </div>
            @endif
            --}}
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


                </form>
                </div>

            </div>
        </div>
    </div>
</div>
</main>
@push('scripts')
<script>
  $(document).ready(function () {
    const MAX_FIELDS = 10;
    const trackedInputsSelector = 'input:not([type="hidden"]):not([type="submit"]):not([type="radio"]), select, textarea';
    function countTotalSelected() {
    let count = 0;

    const ageMin = parseInt($('#preferred_age_min').val());
    const ageMax = parseInt($('#preferred_age_max').val());

    $(trackedInputsSelector).each(function () {
        const el = $(this);
        const name = el.attr('name');
        const type = el.attr('type');
        const id = el.attr('id');

        // ❌ Skip hidden, submit, and radio inputs
        if (type === 'hidden' || type === 'submit' || type === 'radio') return;

        // ❌ Skip the visual range sliders (handled via hidden synced inputs)
        if (id === 'ageMin' || id === 'ageMax') return;

        if (el.prop('disabled')) return;

        const value = el.val();

        // ✅ Multi-selects
        if (el.is('select[multiple]') && Array.isArray(value)) {
            count += value.filter(v => v !== '').length;
        }
        // ✅ Normal fields
        else if (value && value !== '' && value !== 'No Preference') {
            count += 1;
        }
    });

    // ✅ Only count age if changed from default (treat as 1 field)
    if (ageMin > 18 || ageMax < 65) {
        count += 1;
    }

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

        $(trackedInputsSelector).each(function () {
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

    $('#user-preference-form').on('submit', function (e) {
    e.preventDefault(); // Prevent page refresh

    const form = $(this);
    const submitBtn = form.find('button[type="submit"]');
    submitBtn.prop('disabled', true).text('{{ __("profile.Saving...") }}');

    // Clear previous errors
    $('.error-message').text('');
    $('.form-control').removeClass('is-invalid');
    let formData = {};
    form.serializeArray().forEach(item => {
        const isEmpty = item.value === '' || item.value === 'null' || item.value === 'No Preference';
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
        url: '{{ route("api.user-preferences.store") }}',
        type: 'POST',
        data: form.serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept-Language': '{{ app()->getLocale() }}'
        },
        success: function (response) {
            // console.log('Success response:', response);
            // console.log('preferred_hobbies_id:', $('[name="preferred_hobbies_id[]"]').val());

            const alertContainer = $('#preference-success-alert');
            $('#preference-success-message').text("{{ __('profile.Desired_partner_characteristics_saved_successfully') }}");

            alertContainer.removeClass('d-none').css('display', 'block').hide().fadeIn();

            submitBtn.prop('disabled', false).text('{{ __("profile.Saved") }}');

            setTimeout(() => {
                alertContainer.fadeOut(300, () => {
                    alertContainer.addClass('d-none').removeAttr('style');
                });
            }, 10000);
        },
        error: function (xhr) {
            submitBtn.prop('disabled', false).text('{{ __("profile.Save") }}');

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
$(document).ready(function () {
    var selectedCountryId = $('#country_id').val(); // Get the selected country ID from the dropdown
    if (selectedCountryId) {
        loadCities(selectedCountryId);
    }

    // When country changes, update the cities
    $('#country_id').on('change', function () {
        var countryId = $(this).val();
        $('#city_id').empty().append('<option value="">{{ __('onboarding.select_city') }}</option>'); // Clear the cities dropdown
        if (countryId) {
            loadCities(countryId);
        }
    });

    // Function to load cities based on the country ID
    function loadCities(countryId) {
        $.ajax({
            url: "{{ route('cities.by.country', '') }}/" + countryId,
            type: 'GET',
            success: function (data) {
                $.each(data, function (index, city) {
                    // Check if the city should be selected
                    var isSelected = '{{ old('preferred_city_id', $userPreferences['preferred_city_id'] ?? '') }}' == city.id;
                    $('#city_id').append('<option value="' + city.id + '" ' + (isSelected ? 'selected' : '') + '>' + city.name + '</option>');
                });
            },
        });
    }
});

});

document.addEventListener('DOMContentLoaded', function () {
        const minRange = document.getElementById('ageMin');
        const maxRange = document.getElementById('ageMax');
        const minInput = document.getElementById('preferred_age_min');
        const maxInput = document.getElementById('preferred_age_max');
        const minLabel = document.getElementById('age-min-label');
        const maxLabel = document.getElementById('age-max-label');
        const highlight = document.querySelector('.range-highlight');

        function updateSlider() {
    const minVal = parseInt($('#ageMin').val());
    const maxVal = parseInt($('#ageMax').val());

    if (minVal > maxVal) $('#ageMin').val(maxVal);
    if (maxVal < minVal) $('#ageMax').val(minVal);

    $('#preferred_age_min').val($('#ageMin').val());
    $('#preferred_age_max').val($('#ageMax').val());

    // Optional label update if visible
    $('#age-min-label').text($('#ageMin').val());
    $('#age-max-label').text($('#ageMax').val());

    // Update range highlight
    const min = parseInt(minRange.min);   // should be 18
    const max = parseInt(minRange.max);   // now correctly 65
    const minPercent = ((minRange.value - min) / (max - min)) * 100;
const maxPercent = ((maxRange.value - min) / (max - min)) * 100;
    $('.range-highlight').css({
        left: `${minPercent}%`,
        width: `${maxPercent - minPercent}%`
    });
}


        function updateFromInputs() {
            let minVal = parseInt(minInput.value) || 18;
            let maxVal = parseInt(maxInput.value) || 100;
            minVal = Math.max(18, Math.min(minVal, maxVal));
            maxVal = Math.min(100, Math.max(minVal, maxVal));
            minRange.value = minVal;
            maxRange.value = maxVal;
            updateSlider();
        }

        minRange.addEventListener('input', updateSlider);
        maxRange.addEventListener('input', updateSlider);
        minInput.addEventListener('change', updateFromInputs);
        maxInput.addEventListener('change', updateFromInputs);

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
