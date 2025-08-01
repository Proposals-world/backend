@extends('user.layouts.app')

@section('content')
{{-- {{ dd( $data) }} --}}


<!-- Icons css -->
<link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

@php
$locale = app()->getLocale();
@endphp
<style>
      @media (max-width: 768px) {
            [dir="rtl"] .onboarding-steps-indicator {
                left: 10px;
                right: auto;
                align-items: flex-end;
            }

            [dir="rtl"] .step-indicator {
                flex-direction: row;
                justify-content: flex-start;
                align-items: center;
            }

            [dir="rtl"] .step-number {
                margin-left: 10px;
                margin-right: 0;
            }

            [dir="rtl"] .onboarding-card {
                margin-left: 50px;
                margin-right: 0px;
            }
        }

        @media (max-width: 500px) {

            /* Prevent iOS zoom and ensure all form elements are accessible */
            textarea.form-control,
            input.form-control:not([type="file"]),
            select.form-control {
                font-size: 16px !important;
                /* Critical for iOS */
                -webkit-appearance: none;
                -webkit-text-size-adjust: 100%;
                touch-action: manipulation;
            }

            /* Ensure textareas are on top */
            textarea {
                position: relative;
                z-index: 10;
                -webkit-user-select: auto;
                user-select: auto;
            }

            /* Ensure other inputs and selects are also on top and clickable */
            input:not([type="file"]),
            select {
                position: relative;
                z-index: 10;
                -webkit-user-select: auto;
                user-select: auto;
            }

            /* Specific fix for select elements on mobile */
            select.form-control {
                background-image: none;
                /* Remove any custom arrows that might interfere */
                cursor: pointer;
                -webkit-tap-highlight-color: transparent;
            }

            /* Fix for Select2 initialized selects */
            .select2-container {
                z-index: 10 !important;
            }

            .select2-container .select2-selection {
                font-size: 16px !important;
                min-height: 44px;
                cursor: pointer;
            }

            /* Fix container issues */
            #onboarding {
                overflow: visible;
                min-height: auto;
            }

            .container {
                overflow: visible;
            }

            .form-group {
                overflow: visible !important;
            }
        }

        /* Additional fix for touch devices */
        @media (pointer: coarse) {
            select.form-control {
                cursor: pointer;
                -webkit-touch-callout: auto;
            }
        }

</style>
<form id="profile-form"  enctype="multipart/form-data">
@csrf

<section id="onboarding" class="slider-area slider-bg2 second-slider-bg d-flex fix"
{{-- style="
    @if ($locale === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
        background-position: left 0;
    @else
        background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
        background-position: right 0; @endif
    background-repeat: no-repeat;
    background-size: 65%;"
     --}}
    >
<div id="container" class="container">
    <!-- Step Indicators -->

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="onboarding-wrapper mt-5">

                <div class="onboarding-steps-indicator mb-4">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }} heeloo</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="row no-gutters">
                        @php
                            // Define step titles as per logical grouping.
                            $steps = [
                                __('onboarding.personal_info'),
                                __('onboarding.physical_attributes'),
                                __('onboarding.employment_lifestyle'),
                                __('onboarding.family_housing'),
                                __('onboarding.nationality_city_residence'),
                                __('onboarding.final_details'),
                            ];
                        @endphp


                        @foreach ($steps as $index => $step)
                            <div class="col step-indicator {{ $index == 0 ? 'active' : '' }}"
                                data-step="{{ $index }}">
                                <div class="step-number">{{ $index + 1 }}</div>
                                <div class="step-name d-none d-md-block">{{ $step }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div id="profile-success-alert" class="d-none">
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="simple-icon-info mr-2"></i>
                            <span id="preference-success-message">{{ __('profile.Profile_saved_successfully') }}!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                    {{-- <div id="profile-danger-alert" class="d-none">
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="simple-icon-info mr-2"></i>
                            <span id="preference-danger-message">{{ __('profile.Profile_saved_failed') }}!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div> --}}
                </div>
                <!-- Onboarding Form -->
                <div class="card rounded-lg shadow-lg onboarding-card mb-4">

                    <div class="card-body p-lg-5">
                        {{-- <form id="onboarding-form"
                         > --}}

                            <input type="hidden" value="true" name="FromUpdateProfile">
                            <div class="onboarding-steps">
                                <!-- Step 0: Personal Information -->
                                <div class="onboarding-step" id="step-0">
                                    <h2 class="card-title text-center mb-4 section-title">
                                        {{ __('onboarding.personal_info') }}
                                    </h2>

                                    <div class="form-group">
                                        <label class="form-label">{{ __('onboarding.photo_upload') }} <span class="required-field">*</span></label>
                                        <div class="custom-file">
                                            <input type="file"  name="profile_photo" class="custom-file-input" id="customFile" accept="image/*"
                                                @if (!optional($user->photos->firstWhere('is_main', 1))->photo_url) required @endif>
                                            <label class="custom-file-label" for="customFile">{{ __('onboarding.choose_photo') }}</label>
                                        </div>
                                        <img id="preview"
                                        name="profile_photo"
                                            src="{{ optional($user->photos->firstWhere('is_main', 1))->photo_url }}"
                                            alt="{{ __('Thumbnail') }}"
                                            style="display: block; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 150px;" />

                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.bio_en') }} <span class="required-field">*</span></label>
                                                <textarea name="bio_en" class="form-control rounded" rows="3"
                                                    placeholder="{{ __('onboarding.bio_placeholder_en') }}" required value="">{{ $user->profile->bio_en}}</textarea>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.bio_ar') }} <span class="required-field">*</span></label>
                                                <textarea name="bio_ar" class="form-control rounded" rows="3"
                                                    placeholder="{{ __('onboarding.bio_placeholder_ar') }}" required>{{ $user->profile->bio_ar}}</textarea>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.date_of_birth') }} <span class="required-field">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" name="date_of_birth"
                                                        class="form-control rounded-right" required value="{{ $user->profile->date_of_birth}}">
                                                </div>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.zodiac_sign') }}</label>
                                                <select name="zodiac_sign_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">
                                                        {{ __('onboarding.select_zodiac_sign') }}</option>
                                                        @foreach ($data['zodiacSigns'] as $zodiac)
                                                        <option value="{{ $zodiac->id }}"
                                                            {{ $user->profile->zodiac_sign_id == $zodiac->id ? 'selected' : '' }}>
                                                            {{ $zodiac->name  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('onboarding.nickname') }} <span class="required-field">*</span></label>
                                                     <input type="text" name="nickname"
                                                            class="form-control rounded-pill" required
                                                            value="{{ $user->profile->nickname }}"
                                                            placeholder="{{ __('onboarding.nickname') }}">
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                    </div>



                                    <div class="onboarding-navigation d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-primary rounded-pill next-step"
                                            >
                                            {{ __('onboarding.next') }} <i
                                                class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 1: Physical Attributes -->
                                <div class="onboarding-step" id="step-1" style="display:none;">
                                    <h2 class="card-title text-center mb-4 section-title">
                                        {{ __('onboarding.physical_attributes') }}
                                    </h2>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.height') }} <span class="required-field">*</span></label>
                                                <select name="height" class="form-control rounded-pill" required>
                                                    <option value="">{{ __('onboarding.select_height') }}
                                                    </option>
                                                    @foreach ($data['heights'] as $height)
                                                        <option value="{{ $height->id }}"{{ $user->profile->height_id == $height->id ? 'selected' : '' }}>{{ $height->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.weight') }} <span class="required-field">*</span></label>
                                                <select name="weight" class="form-control rounded-pill" required>
                                                    <option value="">{{ __('onboarding.select_weight') }}
                                                    </option>
                                                    @foreach ($data['weights'] as $weight)
                                                        <option value="{{ $weight->id }}"{{ $user->profile->weight_id == $weight->id ? 'selected' : '' }}>{{ $weight->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.hair_color') }} <span class="required-field">*</span></label>
                                                <select name="hair_color_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">
                                                        {{ __('onboarding.select_hair_color') }}</option>
                                                    @foreach ($data['hairColors'] as $hairColor)
                                                        <option value="{{ $hairColor->id }}" {{ $user->profile->hair_color_id == $hairColor->id ? 'selected' : '' }}>
                                                            {{ $hairColor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.skin_color') }} <span class="required-field">*</span></label>
                                                <select name="skin_color_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">
                                                        {{ __('onboarding.select_skin_color') }}</option>
                                                    @foreach ($data['skinColors'] as $skinColor)
                                                        <option value="{{ $skinColor->id }}" {{ $user->profile->skin_color_id == $skinColor->id ? 'selected' : '' }}>
                                                            {{ $skinColor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.religion') }} <span class="required-field">*</span></label>
                                                <select name="religion_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">{{ __('onboarding.select_religion') }}
                                                    </option>
                                                    @foreach ($data['religions'] as $religion)
                                                        <option value="{{ $religion->id }}" {{ $user->profile->religion_id == $religion->id ? 'selected' : '' }}>{{ $religion->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.religiosity_level') }} <span class="required-field">*</span></label>
                                                <select id="religiosity_levels" name="religiosity_level_id"
                                                    class="form-control rounded-pill">
                                                    <option value="">
                                                        {{ __('onboarding.select_religiosity') }}</option>
                                                    @foreach ($data['religiousLevels'] as $religiousLevel)
                                                        <option value="{{ $religiousLevel->id }}"{{ $user->profile->religiosity_level_id == $religiousLevel->id ? 'selected' : '' }}>
                                                            {{ $religiousLevel->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.eye_color') }} <span class="required-field">*</span></label>
                                                <select name="eye_color_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">{{ __('onboarding.select_eye_color') }}
                                                    </option>
                                                    @foreach ($data['eyeColors'] as $eyeColor)
                                                        <option value="{{ $eyeColor->id }}"{{ $user->profile->eye_color_id == $eyeColor->id ? 'selected' : '' }}>{{ $eyeColor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                        </button>
                                        <button type="button" class="btn btn-primary rounded-pill next-step"
                                            >
                                            {{ __('onboarding.next') }}
                                            <i
                                                class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 2: Employment and Lifestyle -->
                                <div class="onboarding-step" id="step-2" style="display:none;">
                                    <h2 class="card-title text-center mb-4 section-title">
                                        {{ __('onboarding.employment_lifestyle') }}
                                    </h2>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.employment_status') }} <span class="required-field">*</span></label>
                                                    <select name="employment_status" class="form-control rounded-pill" required>
                                                        <option value="1" {{ $user->profile->employment_status == 1 ? 'selected' : '' }}>Employed</option>
                                                        <option value="0" {{ $user->profile->employment_status == 0 ? 'selected' : '' }}>Unemployed</option>
                                                    </select>

                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 job-title-wrapper" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.Job_Domain') }} <span class="required-field">*</span></label>
                                                <select name="job_title_id" class="form-control rounded-pill">
                                                    <option value="">{{ __('onboarding.select_job_domain') }}</option>
                                                    @foreach ($data['jobTitles'] as $jobTitle)
                                                        <option value="{{ $jobTitle->id }}" {{ $user->profile->job_title_id == $jobTitle->id ? 'selected' : '' }}>
                                                            {{ $jobTitle->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 job-title-wrapper" style="display:none;">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.position_level') }} <span class="required-field">*</span></label>
                                                <select name="position_level_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">
                                                        {{ __('onboarding.select_position_level') }}</option>
                                                    @foreach ($data['positionLevels'] as $position)
                                                        <option value="{{ $position->id }}"{{ $user->profile->position_level_id == $position->id ? 'selected' : '' }}>{{ $position->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.educational_level') }} <span class="required-field">*</span></label>
                                                <select name="educational_level_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">
                                                        {{ __('onboarding.select_educational_level') }}</option>
                                                    @foreach ($data['educationalLevels'] as $level)
                                                        <option value="{{ $level->id }}" {{ $user->profile->educational_level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.specialization') }} <span class="required-field">*</span></label>
                                                <select name="specialization_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">
                                                        {{ __('onboarding.select_specialization') }}</option>
                                                    @foreach ($data['specializations'] as $specialization)
                                                        <option value="{{ $specialization->id }}"{{ $user->profile->specialization_id == $specialization->id ? 'selected' : '' }}>
                                                            {{ $specialization->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.sports_activity') }} <span class="required-field">*</span></label>
                                                <select name="sports_activity_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">
                                                        {{ __('onboarding.select_sports_activity') }}</option>
                                                    @foreach ($data['sportsActivities'] as $sport)
                                                        <option value="{{ $sport->id }}"{{ $user->profile->sports_activity_id == $sport->id ? 'selected' : '' }}>{{ $sport->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.smoking_status') }} <span class="required-field">*</span></label>
                                                <select name="smoking_status" class="form-control rounded-pill"
                                                    required>
                                                    <option value="0">{{ __('onboarding.non_smoker') }}
                                                    </option>
                                                    <option value="1" {{ $user->profile->smoking_status == 1 ? 'selected' : '' }}>{{ __('onboarding.smoker') }}</option>
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 smoking-tools-wrapper" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    {{ __('onboarding.smoking_tools') }}
                                                    <span class="required-field">*</span>
                                                </label>
                                                <select name="smoking_tools[]" class="form-control rounded-pill"
                                                    multiple>
                                                    @foreach ($data['smokingTools'] as $tool)
                                                        <option value="{{ $tool->id }}" {{ $user->profile->smokingTools->contains('id', $tool->id) == $tool->id ? 'selected' : '' }}>{{ $tool->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.drinking_status') }} <span class="required-field">*</span></label>
                                                <select name="drinking_status_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">
                                                        {{ __('onboarding.select_drinking_status') }}</option>
                                                    @foreach ($data['drinkingStatuses'] as $drinking)
                                                        <option value="{{ $drinking->id }}"{{ $user->profile->drinking_status_id == $drinking->id ? 'selected' : '' }}>
                                                            {{ $drinking->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.social_media_presence') }} <span class="required-field">*</span></label>
                                                <select name="social_media_presence_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">
                                                        {{ __('onboarding.select_social_media_presence') }}
                                                    </option>
                                                    @foreach ($data['socialMediaPresence'] as $social)
                                                        <option value="{{ $social->id }}"{{ $user->profile->social_media_presence_id == $social->id ? 'selected' : '' }}>{{ $social->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                        </button>
                                        <button type="button" class="btn btn-primary rounded-pill next-step"
                                            >
                                            {{ __('onboarding.next') }}
                                            <i
                                                class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 3: Family and Housing -->
                                <div class="onboarding-step" id="step-3" style="display:none;">
                                    <h2 class="card-title text-center mb-4 section-title">
                                        {{ __('onboarding.family_housing') }}</h2>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.marital_status') }} <span class="required-field">*</span></label>
                                                <select name="marital_status_id" class="form-control rounded-pill" required>
                                                    <option value="">{{ __('onboarding.select_marital_status') }}</option>
                                                    @foreach ($data['maritalStatuses'] as $maritalStatus)
                                                        <option value="{{ $maritalStatus->id }}"{{ $user->profile->marital_status_id == $maritalStatus->id ? 'selected' : '' }}>
                                                            {{ $maritalStatus->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger" style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.number_of_children') }}</label>
                                                <input type="number" name="number_of_children"
                                                    class="form-control rounded-pill" min="0"
                                                    max="10" required value="{{  $user->profile->children }}">
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.pets') }} <span class="required-field">*</span></label>
                                                <select name="pets[]" class="form-control rounded-pill" required
                                                    multiple>
                                                    @foreach ($data['pets'] as $pet)
                                                        <option value="{{ $pet->id }}" {{ $user->pets->contains('id', $pet->id) ? 'selected' : '' }}>{{ $pet->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                      {{--  --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.hobbies') }} <span class="required-field">*</span></label>
                                                <select name="hobbies[]" class="form-control rounded-pill"
                                                    required multiple>
                                                    @foreach ($data['hobbies'] as $hobby)
                                                        <option value="{{ $hobby->id }}"{{ $user->hobbies->contains('id', $hobby->id) == $hobby->id ? 'selected' : '' }}>{{ $hobby->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        @if (old('gender') !== 'female')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.marriage_budget') }} <span class="required-field">*</span></label>
                                                    <select name="marriage_budget_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_marriage_budget') }}</option>
                                                        @foreach ($data['marriageBudget'] as $budget)
                                                            <option value="{{ $budget->id }}" {{ $user->profile->marriage_budget_id == $budget->id ? 'selected' : '' }}>
                                                                {{ $budget->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                                                                    <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    @endif

                                    </div>
                                    @if (old('gender') == 'female')
                                        <div class="form-group">
                                            <label class="form-label">{{ __('onboarding.hijab_status') }} <span class="required-field">*</span></label>
                                            <select name="hijab_status" class="form-control rounded-pill"
                                                required>
                                                <option value="1">{{ __('onboarding.strictly_hijab') }}
                                                </option>
                                                <option value="0">{{ __('onboarding.non_hijab') }}</option>
                                            </select>
                                            <span class="error-message text-danger"
                                                style="font-size:12px;"></span>
                                        </div>
                                    @endif
                                    <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                        </button>
                                        <button type="button" class="btn btn-primary rounded-pill next-step"
                                            >
                                            {{ __('onboarding.next') }} <i
                                                class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- Step 4: Final Details -->
                                <div class="onboarding-step" id="step-4" style="display:none;">
                                    <h2 class="card-title text-center mb-4 section-title">
                                        {{ __('onboarding.final_details') }}</h2>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.country_of_residence') }} <span class="required-field">*</span></label>
                                                <select name="country_of_residence_id" id="country_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">{{ __('onboarding.select_country') }}
                                                    </option>
                                                    @foreach ($data['countries'] as $country)
                                                        <option value="{{ $country->id }}"{{ $user->profile->country_of_residence_id == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.city') }} <span class="required-field">*</span></label>
                                                <select name="city_id" id="city_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="" >{{ __('onboarding.select_city') }}
                                                    </option>
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.city_location') }} <span class="required-field">*</span></label>
                                                <select name="city_location_id" id="city_location_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">{{ __('onboarding.city_location') }}
                                                    </option>
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.nationality') }} <span class="required-field">*</span></label>
                                                <select name="nationality_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">
                                                        {{ __('onboarding.select_nationality') }}</option>
                                                    @foreach ($data['nationalities'] as $nationality)
                                                        <option value="{{ $nationality->id }}"{{ $user->profile->nationality_id == $nationality->id ? 'selected' : '' }}>
                                                            {{ $nationality->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.origin') }} <span class="required-field">*</span></label>
                                                <select name="origin_id" class="form-control rounded-pill"
                                                    required>
                                                    <option value="">{{ __('onboarding.select_origin') }}
                                                    </option>
                                                    @foreach ($data['origins'] as $origin)
                                                        <option value="{{ $origin->id }}"{{ $user->profile->origin_id == $origin->id ? 'selected' : '' }}>{{ $origin->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                        </button>
                                        <button type="button" class="btn btn-primary rounded-pill next-step"
                                            >
                                            {{ __('onboarding.next') }} <i
                                                class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- Step 4: Final Details -->
                                <div class="onboarding-step" id="step-5" style="display:none;">
                                    <h2 class="card-title text-center mb-4 section-title">
                                        {{ __('onboarding.final_details') }}</h2>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.car_ownership') }} <span class="required-field">*</span></label>
                                                <select name="car_ownership" class="form-control rounded-pill"
                                                    required>
                                                    <option value="1">{{ __('onboarding.own_car') }}
                                                    </option>
                                                    <option value="0" {{ $user->profile->car_ownership == 0 ? 'selected' : '' }}>{{ __('onboarding.no_car') }}</option>
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        {{--  --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-label">{{ __('onboarding.financial_status') }} <span class="required-field">*</span></label>
                                                {{-- <br> --}}
                                                <select name="financial_status_id"
                                                    class="form-control rounded-pill" required>
                                                    <option value="">
                                                        {{ __('onboarding.select_financial_status') }}</option>
                                                    @foreach ($data['financialStatuses'] as $financialStatus)
                                                        <option value="{{ $financialStatus->id }}"{{ $user->profile->financial_status_id == $financialStatus->id ? 'selected' : '' }}>
                                                            {{ $financialStatus->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                        {{--  --}}
                                        @if (old('gender') !== 'male')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    {{ __('onboarding.guardian_contact') }} <span class="required-field">*</span>
                                                    <p
                                                        class="form-text text-muted mb-0">{{ __('onboarding.guardian_contact_help') }} </p>

                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                     <select name="country_code"
                                                                        class="form-select form-control @error('country_code') is-invalid @enderror"
                                                                        style="max-width:110px">
                                                                    @foreach(config('countries') as $iso => $info)
                                                                    <option value="{{ $iso }}"
                                                                        {{ old('country_code', 'JO') == $iso ? 'selected' : '' }}>
                                                                            {{ $iso }} {{ $info['dial_code'] }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                    <input type="tel" name="guardian_contact"
                                                        class="form-control rounded-right" required value="{{ old('guardian_contact', auth()->user()->profile->guardian_contact_local) }}"
  >
                                                </div>
                                                 <p
                                                        class="form-text text-muted">{{ __('onboarding.guardian_contact_number_help') }}</p>
                                                <span class="error-message text-danger"
                                                    style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                    @endif

                                    </div>
                                    <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                            <i
                                                class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                        </button>
                                        <button type="submit" class="btn btn-success rounded-pill">
                                            {{ __('onboarding.submit') }} <i class="fas fa-check ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</form>

@push('scripts')
<script>
    // Assume user gender is available from a hidden field or global variable.
    var userGender = "{{ old('gender', auth()->user()->gender ?? '') }}";
    $('#religion_id').on('change', function () {
    var religionId = $(this).val();
    var gender = "{{ old('gender', auth()->user()->gender ?? '') }}"; // You already have user's gender.

    $('#religiosity_levels')
        .empty()
        .append('<option value="">{{ __("onboarding.select_religiosity") }}</option>');

    if (religionId) {
        $.ajax({
            url: "{{ url('user/religious-levels-gender') }}",
            type: 'GET',
            data: {
                religion_id: religionId,
                gender: gender === 'male' ? 1 : 2
            },
            success: function (response) {
                if (response.religiousLevels && response.religiousLevels.length > 0) {
                    $.each(response.religiousLevels, function (index, level) {
                        $('#religiosity_levels').append(
                            '<option value="' + level.id + '">' + level.name + '</option>'
                        );
                    });
                }
            },
            error: function (xhr) {
                console.error('Error fetching religiosity levels:', xhr.responseText);
            }
        });
    }
});
$('select[name="marital_status_id"]').on('change', function () {
    var selectedMaritalStatus = $(this).val();

    // Assuming "Single" marital status has ID = 1
    if (selectedMaritalStatus == 1) { // adjust 1 if your "Single" ID is different
        $('input[name="number_of_children"]').val(0).prop('readonly', true);
    } else {
        $('input[name="number_of_children"]').val('').prop('readonly', false);
    }
});
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
        localStorage.removeItem(formStorageKey);

        const stored = localStorage.getItem(formStorageKey);
        if (stored) {
            const dataObj = JSON.parse(stored);
            for (const [key, value] of Object.entries(dataObj)) {
                $(`[name="${key}"]`).val(value);
            }
        }
    }
    $('#profile-form').submit(function(e) {
    e.preventDefault(); // Prevent normal form submission

    var formData = new FormData(this); // Get all form data

    var profileUrl = '{{ route("profile.update") }}';
    var photoUrl = '{{ route("user.profile.photo.update") }}';

    // Always send profile update request
    let profileRequest = $.ajax({
        url: profileUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    });

    // Check if a photo file was selected
    var fileInput = $('#customFile')[0];
    var photoRequest = null;

    if (fileInput.files.length > 0) {
        // Only if there is a file, send photo update request
        photoRequest = $.ajax({
            url: photoUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        });
    }

    // Handle both requests
    if (photoRequest) {
        // If there is a photo, wait for both
        Promise.all([profileRequest, photoRequest])
            .then((responses) => {
                // Profile and Photo updated
                handleSuccess(responses[0], responses[1]);
            })
            .catch(handleError);
    } else {
        // No photo, only profile request
        profileRequest
            .then((response) => {
                handleSuccess(response, null);
            })
            .catch(handleError);
    }

    function handleSuccess(profileResponse, photoResponse) {
    // console.log('Profile updated successfully!', profileResponse);
    if (photoResponse) {
        // console.log('Photo updated successfully!', photoResponse);
        if (photoResponse.success || photoResponse.data || photoResponse.message) {
            $('#preview').attr('src', photoResponse.photoUrl);
        }
    }
    if (profileResponse && (profileResponse.data || profileResponse.success || profileResponse.message)) {
        $('#profile-success-alert').removeClass('d-none').fadeIn();
        setTimeout(function() {
            window.location.href = '{{ route("user.profile") }}';
        }, 2000);
    }
}

    function handleError(error) {
        console.error('An error occurred:', error);
        if (error.status === 422) {
            var errors = error.responseJSON.errors;
            $('.error-message').text('');
            for (var field in errors) {
                if (errors.hasOwnProperty(field)) {
                    var errorMessage = errors[field].join(', ');
                    $('[name="' + field + '"]').closest('.form-group').find('.error-message').text(errorMessage);
                }
            }
        } else {
            let errorMsg = 'There was an error submitting the form.';
            if (error.responseJSON && error.responseJSON.message) {
                errorMsg = error.responseJSON.message;
            }
            alert(errorMsg);
        }
    }
});
// Handle the file input change to show a preview image
$('#customFile').change(function(event) {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#preview').attr('src', e.target.result); // Update preview image with selected file
    };
    reader.readAsDataURL(event.target.files[0]);
});


        function validateReligiosityLevel() {
            var religiosityField = $('select[name="religiosity_level_id"]');
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

        // Toggle Smoking Tools based on Smoking Status
        function toggleSmokingTools() {
            var smokingStatus = $('select[name="smoking_status"]').val();
            var $smokingToolsWrapper = $('.smoking-tools-wrapper');
            if (smokingStatus === "1") {
                $smokingToolsWrapper.show();
                $smokingToolsWrapper.find('select').prop('required', true);
            } else {
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
                    var $positionLevelWrapper = $('.position-level-wrapper');
                    if (employmentStatus === "1") {
                        $jobTitleWrapper.show();
                        $jobTitleWrapper.find('select').prop('required', true);
                        $positionLevelWrapper.show();
                        $positionLevelWrapper.find('select').prop('required', true);
                    } else {
                        $jobTitleWrapper.hide();
                        $jobTitleWrapper.find('select').prop('required', false).val('').trigger('change');
                        $jobTitleWrapper.find('select').removeClass('is-valid is-invalid');
                        $jobTitleWrapper.find('.error-message').text('');
                        $positionLevelWrapper.hide();
                        $positionLevelWrapper.find('select').prop('required', false).val('').trigger('change');
                        $positionLevelWrapper.find('select').removeClass('is-valid is-invalid');
                        $positionLevelWrapper.find('.error-message').text('');
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

                case 'bio_en':
                    var englishRegex = /^[A-Za-z0-9\s.,'"\-?!()]+$/;
                    if (!englishRegex.test(value)) {
                        errorSpan.text("{{ __('onboarding.english_required') }}");
                        isValid = false;
                    }
                    if (/\d/.test(value)) {
                        errorSpan.text("{{ __('onboarding.no_numbers_allowed') }}");
                        isValid = false;
                    }
                    // Check for special characters (allow only basic punctuation)
                    var specialCharRegex = /[^A-Za-z0-9\s.,'"\-?!()]/;
                    if (specialCharRegex.test(value)) {
                        errorSpan.text("{{ __('onboarding.no_special_characters') }}");
                        isValid = false;
                    }
                    break;
              case 'bio_ar':
                // 1) If there are any digits, show the no‐numbers error and stop
                if (/\d/.test(value)) {
                    errorSpan.text("{{ __('onboarding.no_numbers_allowed') }}");
                    isValid = false;
                    break;
                }

                // 2) If there are any characters outside Arabic letters, spaces, and our basic punctuation,
                //    show the special‐characters error and stop
                var specialCharRegexAr = /[^\u0600-\u06FF\s\u060C\u061B\u061F\.,'"()\-\?!]/u;
                if (specialCharRegexAr.test(value)) {
                    errorSpan.text("{{ __('onboarding.no_special_characters') }}");
                    isValid = false;
                    break;
                }

                // 3) Finally, ensure it’s at least Arabic letters (with allowed punctuation)
                var arabicLettersAndPunc = /^[\u0600-\u06FF\s\u060C\u061B\u061F\.,'"()\-\?!]+$/u;
                if (!arabicLettersAndPunc.test(value)) {
                    errorSpan.text("{{ __('onboarding.arabic_required_no_numbers') }}");
                    isValid = false;
                }
                break;
                // case 'guardian_contact':
                //     // var guardianRegex = /^(078|077|079)\d{7}$/;
                //     // if (!guardianRegex.test(value)) {
                //     //     errorSpan.text("{{ __('onboarding.invalid_guardian_contact') }}");
                //     //     isValid = false;
                //     // }
                //     break;
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

        // Validate all fields in a step
        function validateStep(step) {
            var isValid = true;
            $(step).find('input, select, textarea').each(function() {
                if (!validateField(this)) {
                    isValid = false;
                }
            });
            if ($(step).find('input[name="gender"]').length > 0) {
                if (!$('input[name="gender"]:checked').val()) {
                    $(step).find('input[name="gender"]').closest('.form-group').find('.error-message').text(
                        'Please select a gender.');
                    isValid = false;
                } else {
                    $(step).find('input[name="gender"]').closest('.form-group').find('.error-message').text('');
                }
            }
            return isValid;
        }

        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
            $(this).data('touched', true);
            validateField(this);
        });

        $('input, select, textarea').on('blur change', function() {
            $(this).data('touched', true);
            validateField(this);
            var currentStep = $(this).closest('.onboarding-step');
            updateNextButton(currentStep);
        });

        $('input[type="radio"]').on('change', function() {
            $(this).data('touched', true);
            var radioGroup = $(this).attr('name');
            $('.form-group').find('input[name="' + radioGroup + '"]').closest('.form-group').find(
                '.error-message').text('');
            var currentStep = $(this).closest('.onboarding-step');
            updateNextButton(currentStep);
        });

        function updateNextButton(step) {
            if (validateStep(step)) {
                $(step).find('.next-step').prop('disabled', false);
            } else {
                $(step).find('.next-step').prop('disabled', true);
            }
        }

        $('.next-step').prop('disabled', false);

        $('.next-step').click(function() {
            var currentStep = $(this).closest('.onboarding-step');
            markStepFieldsAsTouched(currentStep);
            if (validateStep(currentStep)) {
                var currentStepId = currentStep.attr('id');
                var currentIndex = parseInt(currentStepId.split('-')[1]);
                var nextStep = currentStep.next('.onboarding-step');
                currentStep.hide();
                nextStep.show();
                updateStepIndicator(currentIndex + 1);
                $('html, body').animate({
                    scrollTop: 0
                }, 'fast');
            }
        });

        $('.prev-step').click(function() {
            var currentStep = $(this).closest('.onboarding-step');
            var currentStepId = currentStep.attr('id');
            var currentIndex = parseInt(currentStepId.split('-')[1]);
            var prevStep = currentStep.prev('.onboarding-step');
            currentStep.hide();
            prevStep.show();
            updateStepIndicator(currentIndex - 1);
            $('html, body').animate({
                scrollTop: 0
            }, 'fast');
        });

        $('#onboarding-form').on('submit', function(e) {
            e.preventDefault();
            var currentStep = $('.onboarding-step:visible');
            markStepFieldsAsTouched(currentStep);
            if (!validateStep(currentStep)) {
                return false;
            }

            // clear saved form data from localStorage upon successful submission.
            localStorage.removeItem(formStorageKey);
            this.submit();
            window.location.href = "{{ route('user.profile') }}";

        });

        function updateStepIndicator(currentIndex) {
            $('.step-indicator').each(function(index) {
                if (index < currentIndex) {
                    $(this).find('.step-number').css('background-color', '#FF3494');
                } else if (index === currentIndex) {
                    $(this).find('.step-number').css('background-color', '#7D4196').css('opacity', '1');
                    $(this).addClass('active');
                } else {
                    $(this).find('.step-number').css('background-color', '#f1f1f1');
                }
            });
        }
        function toggleCityLocationRequirement(countryId) {
            const $loc = $('#city_location_id');
            const $formGroup = $loc.closest('.form-group');
            const $reqSpan = $formGroup.find('.required-field');

            if (parseInt(countryId, 10) >= 23) {
                $loc.prop('required', false);

                // Clear the star content
                $reqSpan.text('');

                // Clear any existing error message
                $formGroup.find('.error-message').text('');
            } else {
                $loc.prop('required', true);

                // Add star back if missing
                if ($reqSpan.text().trim() === '') {
                $reqSpan.text('*');
                }
            }
            }

// When the country changes, update the cities dropdown
$('#country_id').on('change', function() {
    var countryId = $(this).val();
      toggleCityLocationRequirement(countryId);

    $('#city_id').empty().append('<option value="">{{ __('onboarding.select_city') }}</option>'); // Clear existing cities

    if (countryId) {
        $.ajax({
            url: "{{ route('cities.by.country', '') }}/" + countryId,
            type: 'GET',
            success: function(data) {
                $.each(data, function(index, city) {
                    $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                });

                // If the user's profile has a city_id, preselect it
                var userCityId = "{{ $user->profile->city_id ?? '' }}";
                if (userCityId) {
                    $('#city_id').val(userCityId); // Preselect the city if it exists in the user's profile
                }
            },
        });
    }
});

// Trigger change event on page load to populate cities for the user's selected country
$(document).ready(function() {
    var userCountryId = "{{ $user->profile->country_of_residence_id ?? '' }}";
    if (userCountryId) {
        $('#country_id').val(userCountryId).trigger('change'); // Set the selected country and trigger the change event
    }
});
 /* --------------------------------------------------
             * Fetch city locations when a city is chosen
             * -------------------------------------------------- */
             $(document).ready(function() {
    var savedCityId = "{{ $user->profile->city_id ?? '' }}";
    var savedCityLocationId = "{{ $user->profile->city_location_id ?? '' }}";

    function loadCityLocations(cityId, selectedLocationId = null) {
        $('#city_location_id')
            .empty()
            .append('<option value="">{{ __("onboarding.city_location") }}</option>');

        if (cityId) {
            $.ajax({
                url: "{{ route('cityLocations.by.city', '') }}/" + cityId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, location) {
                        $('#city_location_id').append(
                            '<option value="' + location.id + '">' + location.name + '</option>'
                        );
                    });

                    if (selectedLocationId) {
                        $('#city_location_id').val(selectedLocationId);
                    }
                }
            });
        }
    }

    // On page load: if saved city exists, load locations
    if (savedCityId) {
        loadCityLocations(savedCityId, savedCityLocationId);
    }
 // After loading saved form data
 var currentStep = $('.onboarding-step:visible');
    markStepFieldsAsTouched(currentStep);
    validateStep(currentStep);
    updateNextButton(currentStep);
    // On city change: reload city locations
    $('#city_id').on('change', function() {
        var cityId = $(this).val();
        // When user changes city, reset saved location
        loadCityLocations(cityId, null);

    });
});



</script>
@endpush
@endsection
