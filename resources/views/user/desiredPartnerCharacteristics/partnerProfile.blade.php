@extends('user.layouts.app')

@section('content')


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
                                                    {{-- <div class="d-flex flex-row mb-3">
                                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                                            <strong>ID Number:</strong> {{ $userProfile['profile']['id_number'] ?? 'N/A' }}
                                                        </div>
                                                    </div> --}}

                                                  {{-- Nationality --}}
                                                  <div class="form-group ">
                                                    <label for="preferred_nationality">{{ __('profile.Nationality') }}</label>
                                                    <select class="form-control" name="preferred_nationality">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['nationalities'] as $option)
                                                            <option value="{{ $option->name }}" {{ $userPreferences['preferred_nationality'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Height -->
                                                <div class="form-group ">
                                                    <label for="preferred_height">{{ __('profile.height') }}</label>
                                                    <select class="form-control" name="preferred_height">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['heights'] as $option)
                                                            <option value="{{ $option->name }}" {{ $userPreferences['preferred_height'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Weight -->
                                                <div class="form-group ">
                                                    <label for="preferred_weight">{{ __('profile.weight') }}</label>
                                                    <select class="form-control" name="preferred_weight">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['weights'] as $option)
                                                            <option value="{{ $option->name }}" {{ $userPreferences['preferred_weight'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                    {{-- Age Range --}}
                                                    <div class="form-group">
                                                        <label for="preferred_age_min">{{ __('profile.Age') }}</label>
                                                        <div class="d-flex align-items-center">
                                                            <label for="preferred_age_min" class="mb-0 mr-2">{{ __('From') }}</label>
                                                            <input type="number"
                                                                   class="form-control form-control-sm mx-1"
                                                                   name="preferred_age_min"
                                                                   id="preferred_age_min"
                                                                   value="{{ $userPreferences['preferred_age_min'] ?? '' }}"
                                                                   placeholder="Min Age">

                                                            <label for="preferred_age_max" class="mb-0 mx-2">{{ __('To') }}</label>
                                                            <input type="number"
                                                                   class="form-control form-control-sm"
                                                                   name="preferred_age_max"
                                                                   id="preferred_age_max"
                                                                   value="{{ $userPreferences['preferred_age_max'] ?? '' }}"
                                                                   placeholder="Max Age">
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
                                                    <label for="preferred_smoking_status">{{ __('profile.Smoking_Status') }}</label>
                                                    <select class="form-control" name="preferred_smoking_status" id="preferred_smoking_status">
                                                        <option value="1" {{ ($userPreferences['preferred_smoking_status'] ?? null) == 1 ? 'selected' : '' }}>{{ __('profile.Yes') }}</option>
                                                        <option value="0" {{ ($userPreferences['preferred_smoking_status'] ?? null) == 0 ? 'selected' : '' }}>{{ __('profile.No') }}</option>
                                                    </select>
                                                </div>

                                                {{-- Drinking Status --}}
                                                <div class="form-group">
                                                    <label for="preferred_drinking_status">{{ __('profile.Drinking_Status') }}</label>
                                                    <select class="form-control" name="preferred_drinking_status" id="preferred_drinking_status">
                                                        <option value="Yes" {{ ($userPreferences['preferred_drinking_status'] ?? '') === 'Yes' ? 'selected' : '' }}>{{ __('profile.Yes') }}</option>
                                                        <option value="No" {{ ($userPreferences['preferred_drinking_status'] ?? '') === 'No' ? 'selected' : '' }}>{{ __('profile.No') }}</option>
                                                    </select>
                                                </div>

                                                {{-- Sleep Habit --}}
                                                <div class="form-group ">
                                                    <label for="preferred_sleep_habit">{{ __('profile.Sleep_Habit') }}</label>
                                                    <select class="form-control" name="preferred_sleep_habit">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['sleepHabits'] as $option)
                                                            <option value="{{ $option->name }}" {{ $userPreferences['preferred_sleep_habit'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Sports Activity --}}
                                                <div class="form-group">
                                                    <label for="preferred_sports_activity">{{ __('profile.Sports_Activity') }}</label>
                                                    <select class="form-control" name="preferred_sports_activity" id="preferred_sports_activity">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['sportsActivities'] as $option)
                                                            <option value="{{ $option->name }}"
                                                                {{ $userPreferences['preferred_sports_activity'] == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
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

                                                    <!-- Origin -->
                                                        <div class="form-group ">
                                                            <label for="preferred_origin">{{ __('profile.Origin') }}</label>
                                                            <select class="form-control" name="preferred_origin">
                                                                <option value="">No Preference</option>
                                                                @foreach($data['origins'] as $option)
                                                                    <option value="{{ $option->name }}" {{ $userPreferences['preferred_origin'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                {{-- Country of Residence --}}
                                                <div class="form-group">
                                                    <label for="country_id">{{ __('profile.Country_of_Residence') }}</label>
                                                    <select class="form-control" name="country_of_residence" id="country_id">
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
                                                    <label for="city_id">{{ __('profile.City') }}</label>
                                                    <select class="form-control" name="preferred_city" id="city_id">
                                                        <option value="">{{ __('onboarding.select_city') }}</option>
                                                        @if (!empty($cities))
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->name }}"
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

                                     <!-- Employment & Financial Info Card -->
                                     <div class="col-lg-6 col-12 mb-4">
                                        <div class="card">


                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="simple-icon-briefcase"></i> {{ __('profile.Employment_&_Financial_Info') }}
                                                </h5>

                                                {{-- Job Title --}}
                                                <div class="form-group">
                                                    <label for="preferred_job_title">{{ __('profile.Job_Title') }}</label>
                                                    <select class="form-control" name="preferred_job_title" id="preferred_job_title">
                                                        <option value="">{{ __('No Preference') }}</option>
                                                        @foreach($data['jobTitles'] as $option)
                                                            <option value="{{ $option->name }}"
                                                                {{ $userPreferences['preferred_job_title'] == $option->name ? 'selected' : '' }}>
                                                                {{ $option->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Employment Status --}}
                                                <div class="form-group">
                                                    <label for="preferred_employment_status">{{ __('profile.Employment_Status') }}</label>
                                                    <select class="form-control"
                                                            name="preferred_employment_status"
                                                            id="preferred_employment_status">
                                                        <option value="1" {{ ($userPreferences['preferred_employment_status'] ?? null) == 1 ? 'selected' : '' }}>
                                                            Employed
                                                        </option>
                                                        <option value="0" {{ ($userPreferences['preferred_employment_status'] ?? null) == 0 ? 'selected' : '' }}>
                                                            Unemployed
                                                        </option>
                                                    </select>
                                                </div>

                                                {{-- Financial Status --}}
                                                <div class="form-group ">
                                                    <label for="preferred_financial_status">{{ __('profile.Financial_Status') }}</label>
                                                    <select class="form-control" name="preferred_financial_status">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['financialStatuses'] as $option)
                                                            <option value="{{ $option->name }}" {{ $userPreferences['preferred_financial_status'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
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
                                                    <label for="preferred_religiosity_level">{{ __('profile.Religiosity_Level') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="preferred_religiosity_level"
                                                           id="preferred_religiosity_level"
                                                           value="{{ $userPreferences['preferred_religiosity_level'] ?? '' }}"
                                                           placeholder="No Preference">
                                                </div>

                                                {{-- Marriage Budget --}}
                                                <div class="form-group">
                                                    <label for="preferred_marriage_budget">{{ __('profile.Marriage_Budget') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="preferred_marriage_budget"
                                                           id="preferred_marriage_budget"
                                                           value="{{ $userPreferences['preferred_marriage_budget'] ?? '' }}"
                                                           placeholder="No Preference">
                                                </div>

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
<!--  Education -->
<div class="col-lg-6 col-12 mb-4">
    <div class="card">


        <div class="card-body">
            <h5 class="card-title">
                <i class="simple-icon-graduation"></i> {{ __('profile.Education') }}
            </h5>

            {{-- Educational Level --}}
            <div class="form-group ">
                <label for="preferred_educational_level">{{ __('profile.Educational_Level') }}</label>
                <select class="form-control" name="preferred_educational_level">
                    <option value="">No Preference</option>
                    @foreach($data['educationalLevels'] as $option)
                        <option value="{{ $option->name }}" {{ $userPreferences['preferred_educational_level'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Specialization --}}
            <div class="form-group ">
            <label for="preferred_specialization">{{ __('profile.Specialization') }}</label>
            <select class="form-control" name="preferred_specialization">
                <option value="">No Preference</option>
                @foreach($data['specializations'] as $option)
                    <option value="{{ $option->name }}" {{ $userPreferences['preferred_specialization'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
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
                                                    <i class="simple-icon-home"></i> {{ __('profile.Housing_&_Marital_Status') }}
                                                </h5>

                                                {{-- Marital Status --}}
                                                <div class="form-group ">
                                                    <label for="preferred_marital_status">{{ __('profile.Marital_Status') }}</label>
                                                    <select class="form-control" name="preferred_marital_status">
                                                        <option value="">No Preference</option>
                                                        @foreach($data['maritalStatuses'] as $option)
                                                            <option value="{{ $option->name }}" {{ $userPreferences['preferred_marital_status'] == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                {{--
                                                {{-- Housing Status --}}
                                                {{-- <div class="form-group">
                                                    <label for="housing_status">{{ __('profile.Housing_Status') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="housing_status"
                                                           id="housing_status"
                                                           value="{{ $userProfile['profile']['housing_status'] ?? '' }}"
                                                           placeholder="No Preference">
                                                </div> --}}

                                                {{-- Children --}}
                                                {{-- <div class="form-group">
                                                    <label for="children">{{ __('profile.Children') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="children"
                                                           id="children"
                                                           value="{{ $userProfile['profile']['children'] ?? '' }}"
                                                           placeholder="No Preference">
                                                </div> --}}

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

                <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                    <div class="row">
                        @if(empty($likes))
                            <div class="col-12">
                                <p class="text-center text-muted">{{ __('profile.No_like_yet') }}</p>
                            </div>
                        @else
                            @foreach($likes as $like)
                                <div class="col-12  col-lg-4">
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
                                                            {{ $like['liked_user']['first_name'] ?? '' }}
                                                            {{ $like['liked_user']['last_name'] ?? '' }}
                                                        </p>
                                                    </a>
                                                    <p class="mb-2 text-muted text-small">
                                                        {{ $like['liked_user']['email'] ?? '' }}
                                                    </p>
                                                    <a href="{{ route('viewUser', $like['liked_user']['id'] ) }}" type="button" class="btn btn-xs btn-outline-primary">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
    $('#user-preference-form').on('submit', function (e) {
        e.preventDefault(); // Prevent page refresh

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('{{ __("profile.Saving...") }}');

        // Clear previous errors
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');

        $.ajax({
            url: '{{ route("api.user-preferences.store") }}', // Adjusted to correct route name
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept-Language': '{{ app()->getLocale() }}'
            },
            success: function (response) {
    // console.log('Success response:', response);

    const alertContainer = $('#preference-success-alert');
    const messageElement = $('#preference-success-message');

    // Reset the alert container
    $('#preference-success-message').text("{{ __('profile.Desired_partner_characteristics_saved_successfully') }}");

    // Always ensure it's visible
    alertContainer.removeClass('d-none').css('display', 'block').hide().fadeIn();

    // Re-enable the submit button
    submitBtn.prop('disabled', false).text('{{ __("profile.Saved") }}');

    // Auto-hide after 5s and reset display state
    setTimeout(() => {
        alertContainer.fadeOut(300, () => {
            alertContainer.addClass('d-none').removeAttr('style'); // restore to d-none
        });
    }, 10000);





                submitBtn.prop('disabled', false).text('{{ __("profile.Saved") }}');
            },
            error: function (xhr) {
                submitBtn.prop('disabled', false).text('{{ __("profile.Save") }}');

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
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
