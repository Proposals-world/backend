




@extends('frontend.layouts.app')
@section('section')

    @php
        $locale = app()->getLocale();
    @endphp
    <style>
        [dir="rtl"] .disclaimer-section .form-check-label strong {
            margin-right: 20px;
            display: inline-block;
        }

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
                margin-left: 25px;
                margin-right: 0px;
            }
        }

        .disclaimer-section .card {
            border-radius: 10px;
            background-color: #fffbf0;
            border-width: 1px;
        }

        .disclaimer-section .card-title {
            font-size: 1.1rem;
            color: #856404;
        }

        .disclaimer-section .disclaimer-content {
            font-size: 0.95rem;
            color: #555;
        }

        .disclaimer-section .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 0.2rem;
        }

        .disclaimer-section .form-check-label {
            font-size: 0.95rem;
            padding-left: 5px;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .disclaimer-section .card-body {
                padding: 1rem;
            }

            .disclaimer-section .disclaimer-content {
                font-size: 0.9rem;
            }
        }

        /* RTL support for disclaimer section */
        [dir="rtl"] .disclaimer-section .card {
            border-radius: 10px;
            background-color: #fffbf0;
            border-width: 1px;
        }

        [dir="rtl"] .disclaimer-section .card-title {
            text-align: right;
        }

        [dir="rtl"] .disclaimer-section .card-title i {
            margin-left: 8px;
            margin-right: 0;
        }

        [dir="rtl"] .disclaimer-section .disclaimer-content {
            text-align: right;
        }

        [dir="rtl"] .disclaimer-section .form-check {
            padding-right: 1.5rem;
            padding-left: 0;
        }

        [dir="rtl"] .disclaimer-section .form-check-input {
            margin-right: -1.5rem;
            margin-left: 0;
            position: absolute;
        }

        [dir="rtl"] .disclaimer-section .form-check-label {
            margin-right: 0.5rem;
            margin-left: 0;
            text-align: right;
        }

        [dir="rtl"] .disclaimer-section .error-message {
            text-align: right;
        }

        [dir="rtl"] .btn i.fas.fa-check {
            margin-right: 0.5rem;
            margin-left: 0;
        }

        /* Fix for RTL form elements */
        @media (max-width: 768px) {
            [dir="rtl"] .disclaimer-section .card-body {
                padding: 1rem;
            }

            [dir="rtl"] .disclaimer-section .form-check-input {
                margin-right: -1.25rem;
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
#final-submit-button {
    position: relative;
}
#final-submit-button .btn-loader {
    vertical-align: middle;
    margin-left: 8px;
}

        /* onboarding css ends */
    </style>
    <section id="onboarding" class="slider-area slider-bg2 second-slider-bg d-flex fix"
        style="
            @if ($locale === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
                background-position: left 0;
            @else
                background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
                background-position: right 0; @endif
            background-repeat: no-repeat;
            background-size: 65%;">
        <div id="container" class="container">
            <!-- Step Indicators -->

            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <div class="onboarding-wrapper mt-5">

                        <div class="onboarding-steps-indicator mb-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="margin: 0; padding-left: 20px;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }} heeloo</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
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
                                        __('onboarding.terms_conditions'),
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
                        </div>
                        <!-- Onboarding Form -->
                      @if(session('error'))
                        <div id="profile-danger-alert" class="mb-4">
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="display:block;">
                                <i class="simple-icon-info mr-2"></i>
                                <span id="preference-danger-message">
                                    {{ session('error') }}
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        <div class="card rounded-lg shadow-lg onboarding-card">
                            <div class="card-body p-lg-5">
                                <form id="onboarding-form" method="POST" action="{{ route('user.profile.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="onboarding-steps">
                                        <!-- Step 0: Personal Information -->
                                        <div class="onboarding-step" id="step-0">
                                            <h2 class="card-title text-center mb-4 section-title">
                                                {{ __('onboarding.personal_info') }}
                                            </h2>

                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.photo_upload') }} <span class="required-field">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" name="photo_url" class="custom-file-input"
                                                        id="customFile" accept="image/*" required>
                                                    <label class="custom-file-label"
                                                        for="customFile">{{ __('onboarding.choose_photo') }}</label>
                                                </div>
                                                <img id="preview" src="" alt="{{ __('Thumbnail') }}"
                                                    style="display: none; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 150px;" />
                                                <span class="error-message text-danger" style="font-size:12px;"></span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.bio_en') }} <span class="required-field">*</span></label>
                                                        <textarea name="bio_en" class="form-control rounded" rows="3"
                                                            placeholder="{{ __('onboarding.bio_placeholder_en') }}" required></textarea>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.bio_ar') }} <span class="required-field">*</span></label>
                                                        <textarea name="bio_ar" class="form-control rounded" rows="3"
                                                            placeholder="{{ __('onboarding.bio_placeholder_ar') }}" required></textarea>
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
                                                                class="form-control rounded-right" required>
                                                        </div>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>

                                                {{--
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('onboarding.zodiac_sign') }}</label>
                                                        <select name="zodiac_sign_id" class="form-control rounded-pill"
                                                            required>
                                                            <option value="">
                                                                {{ __('onboarding.select_zodiac_sign') }}</option>
                                                            @foreach ($data['zodiacSigns'] as $zodiac)
                                                                <option value="{{ $zodiac->id }}">{{ $zodiac->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.nickname') }} <span class="required-field">*</span></label>
                                                        <input type="text" name="nickname"
                                                            class="form-control rounded-pill" required
                                                            placeholder="{{ __('onboarding.nicknamePlaceholder') }}">
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="onboarding-navigation d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-primary rounded-pill next-step"
                                                    disabled>
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
                                                                <option value="{{ $height->id }}">{{ $height->name }}
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
                                                                <option value="{{ $weight->id }}">{{ $weight->name }}
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
                                                                <option value="{{ $hairColor->id }}">
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
                                                                <option value="{{ $skinColor->id }}">
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
                                                        <select name="religion_id" id="religion_id"
                                                            class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_religion') }}
                                                            </option>
                                                            @foreach ($data['religions'] as $religion)
                                                                <option value="{{ $religion->id }}">{{ $religion->name }}
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
                                                            class="form-control rounded-pill" required>
                                                            <option value="">
                                                                {{ __('onboarding.select_religiosity') }}</option>
                                                            {{-- @foreach ($data['religiousLevels'] as $religiousLevel)
                                                                <option value="{{ $religiousLevel->id }}">
                                                                    {{ $religiousLevel->name }}</option>
                                                            @endforeach --}}
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
                                                                <option value="{{ $eyeColor->id }}">{{ $eyeColor->name }}
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
                                                    <i
                                                        class="fas fa-arrow-{{ $locale === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step"
                                                    disabled>
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
                                                        <select name="employment_status" class="form-control rounded-pill"
                                                            required>
                                                              <option value="">
                                                                {{ __('onboarding.select_employment') }}
                                                            </option>
                                                            <option value="1">{{ __('onboarding.employed') }}
                                                            </option>
                                                            <option value="0">{{ __('onboarding.unemployed') }}
                                                            </option>
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 job-title-wrapper" style="display:none;">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('onboarding.Job_Domain') }} <span class="required-field">*</span></label>
                                                        <select name="job_title_id" class="form-control rounded-pill">
                                                            <option value="">
                                                                {{ __('onboarding.select_job_domain') }}
                                                            </option>
                                                            @foreach ($data['jobTitles'] as $jobTitle)
                                                                <option value="{{ $jobTitle->id }}">{{ $jobTitle->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 position-level-wrapper "style="display:none;">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('onboarding.position_level') }} <span class="required-field">*</span></label>
                                                        <select name="position_level_id" class="form-control rounded-pill"
                                                            required>
                                                            <option value="">
                                                                {{ __('onboarding.select_position_level') }}</option>
                                                            @foreach ($data['positionLevels'] as $position)
                                                                <option value="{{ $position->id }}">{{ $position->name }}
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
                                                                <option value="{{ $level->id }}">{{ $level->name }}
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
                                                                <option value="{{ $specialization->id }}">
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
                                                                <option value="{{ $sport->id }}">{{ $sport->name }}
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
                                                            <option value="" >{{ __('onboarding.select_smoking_status') }}</option>
                                                            <option value="0">{{ __('onboarding.non_smoker') }}
                                                            </option>
                                                            <option value="1">{{ __('onboarding.smoker') }}</option>
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
                                                            id="smoking_tools" multiple>
                                                            @foreach ($data['smokingTools'] as $tool)
                                                                <option value="{{ $tool->id }}">{{ $tool->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error-smoking_tools" class="error-message text-danger"
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
                                                                <option value="{{ $drinking->id }}">
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
                                                                <option value="{{ $social->id }}">{{ $social->name }}
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
                                                    <i
                                                        class="fas fa-arrow-{{ $locale === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step"
                                                    disabled>
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
                                                        <label
                                                            class="form-label">{{ __('onboarding.marital_status') }} <span class="required-field">*</span></label>
                                                        <select name="marital_status_id" class="form-control rounded-pill"
                                                            required>
                                                            <option value="">
                                                                {{ __('onboarding.select_marital_status') }}</option>
                                                            @foreach ($data['maritalStatuses'] as $maritalStatus)
                                                                <option value="{{ $maritalStatus->id }}">
                                                                    {{ $maritalStatus->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('onboarding.number_of_children') }}</label>
                                                        <input type="number" name="number_of_children"
                                                            class="form-control rounded-pill" min="0"
                                                            max="10" required>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.pets') }} <span class="required-field">*</span></label>
                                                        <select name="pets[]" class="form-control rounded-pill"
                                                            id="pets" required multiple>
                                                            @foreach ($data['pets'] as $pet)
                                                                <option value="{{ $pet->id }}">{{ $pet->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error-pets" class="error-message text-danger"
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
                                                            id="hobbies" required multiple>
                                                            @foreach ($data['hobbies'] as $hobby)
                                                                <option value="{{ $hobby->id }}">{{ $hobby->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error-hobbies" class="error-message text-danger"
                                                            style="font-size:12px;"></span>

                                                    </div>
                                                </div>
                                                @if (old('gender') !== 'female')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label">{{ __('onboarding.marriage_budget') }} <span class="required-field">*</span></label>
                                                            <select name="marriage_budget_id"
                                                                class="form-control rounded-pill" required>
                                                                <option value="">
                                                                    {{ __('onboarding.select_marriage_budget') }}</option>
                                                                @foreach ($data['marriageBudget'] as $budget)
                                                                    <option value="{{ $budget->id }}">
                                                                        {{ $budget->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="error-message text-danger"
                                                                style="font-size:12px;"></span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if (old('gender') !== 'female')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label">{{ __('onboarding.housing_status') }} <span class="required-field">*</span></label>
                                                            <select name="housing_status_id"
                                                                class="form-control rounded-pill" required>
                                                                <option value="">
                                                                    {{ __('onboarding.select_housing_status') }}</option>
                                                                @foreach ($data['housingStatuses'] as $housing)
                                                                    <option value="{{ $housing->id }}">
                                                                        {{ $housing->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="error-message text-danger"
                                                                style="font-size:12px;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
                                                    <i
                                                        class="fas fa-arrow-{{ $locale === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step"
                                                    disabled>
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
                                                                <option value="{{ $country->id }}">
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
                                                            class="form-control rounded-pill" required >
                                                            <option value="">{{ __('onboarding.select_city') }}
                                                            </option>
                                                        </select>
                                                        <span class="error-message text-danger"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('onboarding.city_location') }} <span class="required-field">*</span></label>
                                                        <select name="city_location_id" id="city_location_id"
                                                            class="form-control rounded-pill" required >
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
                                                                <option value="{{ $nationality->id }}">
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
                                                                <option value="{{ $origin->id }}">{{ $origin->name }}
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
                                                    <i
                                                        class="fas fa-arrow-{{ $locale === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step"
                                                    disabled>
                                                    {{ __('onboarding.next') }} <i
                                                        class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 4: Final Details end -->

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
                                                            <option value="">
                                                                {{ __('onboarding.select_car_ownership') }}
                                                            </option>
                                                            <option value="1">{{ __('onboarding.own_car') }}
                                                            </option>
                                                            <option value="0">{{ __('onboarding.no_car') }}</option>
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
                                                                <option value="{{ $financialStatus->id }}">
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
                                                                    class="form-text text-muted mb-0 text-left">{{ __('onboarding.guardian_contact_help') }}</p>
                                                            </label>
                                                            <div class="input-group"  dir="ltr">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-phone"></i></span>
                                                                </div>
                                                                 <select name="country_code"
                                                                        class="form-select form-control @error('country_code') is-invalid @enderror"
                                                                        style="max-width:171px">
                                                                        @php
    $countries = \App\Helpers\CountryHelper::getCountries();
@endphp
                                                                <option value="" selected>{{ __('onboarding.select_country_code') }}</option>
                                                                    @foreach($countries as $iso => $info)
                                                                    <option value="{{ $iso }}"
                                                                        {{ old('country_code', 'JO') == $iso ? '' : '' }}>
                                                                           {{ $info['name'] }} {{ $info['dial_code'] }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="tel" name="guardian_contact" id="guardian_contact_input"
                                                                    class="form-control rounded-right" required

                                                                    >
                                                            </div>
                                                            <p
                                                        class="form-text text-muted text-left">{{ __('onboarding.guardian_contact_number_help') }}</p>
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
                                                <button type="button" class="btn btn-primary rounded-pill next-step">
                                                    {{ __('onboarding.next') }} <i
                                                        class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Step 6: Terms and Conditions -->
                                        <div class="onboarding-step" id="step-6" style="display:none;">
                                            <h2 class="card-title text-center mb-4 section-title">
                                                {{ __('onboarding.terms_conditions') }}</h2>

                                            <!-- Disclaimer Section -->
                                            <div class="disclaimer-section mb-4">
                                                <div class="card border-warning">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-warning mb-3">
                                                            <i
                                                                class="fas fa-exclamation-triangle mr-2"></i>{{ __('onboarding.disclaimer_title') }}
                                                        </h5>
                                                        <div class="disclaimer-content">
                                                            <p class="mb-2">{{ __('onboarding.disclaimer_p1') }}</p>
                                                            {{-- <p class="mb-2">{{ __('onboarding.disclaimer_p2') }}</p> --}}
                                                            {{-- <p class="mb-0">{{ __('onboarding.disclaimer_p3') }}</p> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="disclaimerAgreement" name="disclaimer_agreement" required>
                                                    <label class="form-check-label" for="disclaimerAgreement">
                                                        <strong>{{ __('onboarding.disclaimer_agreement') }}</strong>
                                                    </label>
                                                    <span class="error-message text-danger"
                                                        style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                                    <i
                                                        class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="submit" class="btn btn-success rounded-pill"
                                                    id="final-submit-button" disabled>
                                                    {{-- {{ __('onboarding.submit') }}  --}}
                                                        <span class="btn-loader spinner-border spinner-border-sm" style="display:none;"></span>
                                                        <span class="btn-text">{{ __('onboarding.submit') }}<i class="fas fa-check ml-2"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Assume user gender is available from a hidden field or global variable.
            var userGender = "{{ old('gender', auth()->user()->gender ?? '') }}";
            var savedReligiosityValue = null;
            var savedCityValue = null;
            var savedCityLocationValue = null;
            var savedCountryValue = null;
            var totalApis = 3;
            var loadedApis = 0;
            var guardianContactValid = false;
            let isPageLoading = true;

            function apiLoaded() {
                loadedApis++;

                // إذا انتهت كل الـ APIs → نرجع النص الأصلي
                if (loadedApis >= totalApis) {
                    $(".btn-text").show();
                    $(".btn-loader").hide();
                }
            }

            $('#religion_id').on('change', function() {
                var religionId = $(this).val();
                var gender = "{{ old('gender', auth()->user()->gender ?? '') }}"; // You already have user's gender.

                $('#religiosity_levels')
                    .empty()
                    .append('<option value="">{{ __('onboarding.select_religiosity') }}</option>');

                  if (religionId) {
        loadReligiosityLevelsByReligion(religionId, null);
    }
            });
            $('select[name="marital_status_id"]').on('change', function() {
                var selectedMaritalStatus = $(this).val();

                // Assuming "Single" marital status has ID = 1
                if (selectedMaritalStatus == 1) { // adjust 1 if your "Single" ID is different
                    $('input[name="number_of_children"]').val(0).prop('readonly', true);
                } else {
                    $('input[name="number_of_children"]').val('').prop('readonly', false);
                }
            });

           /* ============================================================
   LOCAL STORAGE AUTO SAVE SYSTEM FOR ONBOARDING
   ============================================================ */

const LS_KEY_DATA = "onboardingFormData";
const LS_KEY_STEP = "onboardingCurrentStep";

function saveCurrentFormToLocalStorage() {
    let data = {};

    // Save all inputs, selects, textareas
    $("#onboarding-form")
        .find("input, select, textarea")
        .each(function () {
            const name = $(this).attr("name");
            if (!name) return;

            // Skip hidden select2 search field
            if ($(this).hasClass("select2-search__field")) return;

            if ($(this).is(":file")) return; // ignore files

            if ($(this).prop("multiple")) {
                data[name] = $(this).val() || [];
            } else {
                data[name] = $(this).val();
            }
        });

    sessionStorage.setItem(LS_KEY_DATA, JSON.stringify(data));
}



function saveCurrentStep(stepIndex) {
    sessionStorage.setItem(LS_KEY_STEP, stepIndex);
}
// AUTO LOAD COUNTRY → CITY → LOCATION IF THEY EXIST IN STORAGE
function autoLoadCityAndLocation() {
    if (!savedCountryValue) return;

    // 1️⃣ اضبط الدولة
    $('#country_id').val(savedCountryValue);

    // 2️⃣ حمل المدن
    $.ajax({
        url: "{{ route('cities.by.country', '') }}/" + savedCountryValue,
        type: "GET",
        success: function(cities) {

            $('#city_id')
                .empty()
                .append('<option value="">{{ __("onboarding.select_city") }}</option>');

            cities.forEach(city => {
                $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
            });

            // 3️⃣ استعادة المدينة
            if (savedCityValue) {
                $('#city_id').val(savedCityValue);
            }

            // 4️⃣ إذا المدينة موجودة → حمّل المناطق مباشرة
            if (savedCityValue) {
                loadCityLocations(savedCityValue);
            }
                apiLoaded();

        }
    });
}

// LOAD CITY LOCATIONS FUNCTION
function loadCityLocations(cityId) {
    $.ajax({
        url: "{{ route('cityLocations.by.city', '') }}/" + cityId,
        type: "GET",
        success: function(locations) {

            $('#city_location_id')
                .empty()
                .append('<option value="">{{ __("onboarding.city_location") }}</option>');

            locations.forEach(location => {
                $('#city_location_id').append(
                    `<option value="${location.id}">${location.name}</option>`
                );
            });

            // 5️⃣ استعادة المنطقة المحفوظة
            if (savedCityLocationValue) {
                $('#city_location_id').val(savedCityLocationValue);
            }
                apiLoaded();

        }
    });
}

                 function resetCityLocationIfEmpty() {
    const $loc = $('#city_location_id');
    const optionCount = $loc.find('option').length;

    // If ONLY placeholder exists → remove any validation state
    if (optionCount <= 1) {
        $loc.prop('required', false);
        $loc.data('touched', false);

        // Remove all validation classes
        $loc.removeClass('is-valid is-invalid');
        $loc.closest('.form-group').find('.error-message').text('');

        // ⭐ NEW LINE → mark as valid (green)
        $loc.addClass('is-valid');

        return true; // means: empty → don't validate
    }

    return false; // means: has data → normal behavior
}

function loadSavedStep() {
    // let saved = sessionStorage.getItem(LS_KEY_STEP);
    // if (!saved) return 0;

    // saved = parseInt(saved);

    // $(".onboarding-step").hide();
    // $(`#step-${saved}`).show();

    // $(".step-indicator").removeClass("active");
    // $(`.step-indicator[data-step="${saved}"]`).addClass("active");

    // return saved;
}
function loadReligiosityLevelsByReligion(religionId, selectedLevel = null) {
    $('#religiosity_levels')
        .empty()
        .append('<option value="">{{ __("onboarding.select_religiosity") }}</option>');

    if (!religionId) return;

    $.ajax({
        url: "{{ url('user/religious-levels-gender') }}",
        type: 'GET',
        data: {
            religion_id: religionId,
            gender: userGender === 'male' ? 1 : 2
        },
        success: function (response) {

            if (response.religiousLevels && response.religiousLevels.length > 0) {
                response.religiousLevels.forEach(function (level) {
                    $('#religiosity_levels').append(
                        `<option value="${level.id}">${level.name}</option>`
                    );
                });
            }

            // ⭐ اختار القيمة المحفوظة بدقة فائقة
            let finalValue = selectedLevel || savedReligiosityValue;

            if (finalValue) {
                $('#religiosity_levels').val(finalValue).trigger('change');
            }
            apiLoaded();

        }
    });
}


            $(document).ready(function() {

const navEntries = performance.getEntriesByType("navigation");
const pageReloaded = navEntries.length > 0 && navEntries[0].type === "reload";

if (!pageReloaded) {
    // ⭐ بدون ريفريش → اعتبر كل الـ APIs Loaded
    loadedApis = totalApis;

}
if (pageReloaded) {
    $(".btn-text").hide();
    $(".btn-loader").show();
    $("#final-submit-button").prop("disabled", true);
}

            // Load form data FIRST (before select2 initialization)
            loadFormDataFromLocalStorage();
            setTimeout(() => {
                autoLoadCityAndLocation();
            }, 200);

            // Load step AFTER form data
            let startingStep = loadSavedStep();
            applyStepRequiredRules($(`#step-${startingStep}`));

            function validateReligiosityLevel() {
                // DO NOT modify required dynamically — it breaks restore + API loading
                // Just check validity, leave required always true in the HTML
                var field = $('select[name="religiosity_level_id"]');

                if (!field.val()) {
                    field.addClass('is-invalid');
                } else {
                    field.removeClass('is-invalid');
                }
            }

          function onStepShown(stepIndex) {
    if (stepIndex === 1) {
        let religionVal = $('[name="religion_id"]').val();

        if (religionVal) {
            loadReligiosityLevelsByReligion(religionVal, savedReligiosityValue);
        }
    }
}

                  // Validate individual field
                function validateField(field) {
                    // 0) Skip validation for fields that aren't actually part of your form
                    //    e.g., the internal search box that Select2 creates.
                    const fieldName = $(field).attr('name');
                    const fieldType = $(field).attr('type');
                    // Skip City Location entirely if it has no options
                    if ($(field).attr('id') === 'city_location_id') {
                        if ($('#city_location_id option').length <= 1) {
                            return true; // no validation
                        }
                    }
                    if (
                        !fieldName // no name means not a real form field
                        ||
                        $(field).hasClass('select2-search__field') // the search box inside Select2
                        ||
                        fieldType === 'search' // sometimes it's type="search"
                    ) {
                        return true; // just skip it
                    }

                    // 1) If the field is hidden (not visible), skip validation
                    if ($(field).is(':hidden')) return true;

                    // 2) Detect if it's a Select2 field (for styling feedback)
                    const isSelect2 = $(field).hasClass('select2-hidden-accessible');

                    // 3) Grab field ID, "touched" status, etc.
                    const fieldId = $(field).attr('id');
                    const touched = $(field).data('touched');
                    let value = $(field).prop('multiple') ?
                        ($(field).val() || []) :
                        ($(field).val() || '').trim();

                    let isValid = true;
                    if ($(field).is("select")) {

                        let placeholder = $(field).find("option:first").val();
                        let realVal = $(field).val();

                        let isPlaceholder =
                            realVal === "" ||
                            realVal === null ||
                            realVal === undefined
                            ;

                        if (isPlaceholder) {
                            isValid = false;
                        }
                    }
                    // 4) Decide which error span to use:
                    //    - If there is a <span id="error-<fieldId>">, use that;
                    //    - Otherwise use the nearest .error-message in .form-group
                    let errorSpan = $(field).closest('.form-group').find('.error-message');
                    const customErrorSpan = $(`#error-${fieldId}`);
                    if (customErrorSpan.length > 0) {
                        errorSpan = customErrorSpan;
                    }

                    // Clear old message
                    errorSpan.text('');

                    // If not “touched” yet, skip
// If not touched yet → only bypass for guardian contact
if (!touched) {
    if (fieldName === 'guardian_contact') {
        return guardianContactValid;  // use API result
    }
    return false; // all other fields stay invalid
}


                    // ------------------------------------------------------
                    // (A) Universal "required" check
                    // ------------------------------------------------------
                    if ($(field).prop('required')) {
                        if (Array.isArray(value) && value.length === 0) {
                            errorSpan.text("{{ __('onboarding.required') }}");
                            isValid = false;
                        } else if (!Array.isArray(value) && !value) {
                            errorSpan.text("{{ __('onboarding.required') }}");
                            isValid = false;
                        }
                    }

                    // ------------------------------------------------------
                    // (B) Field-specific "required" overrides
                    // ------------------------------------------------------
                    if (
                        ['specialization_id', 'job_title_id', 'drinking_status_id'].includes(fieldName) &&
                        value === ''
                    ) {
                        errorSpan.text("{{ __('onboarding.required') }}");
                        isValid = false;
                    }

                    // ------------------------------------------------------
                    // (C) Smoking tools conditional
                    // ------------------------------------------------------
                    if (fieldId === 'smoking_tools') {
                        const smokingStatus = $('select[name="smoking_status"]').val();
                        if (smokingStatus === '1' && value.length === 0) {
                            errorSpan.text("{{ __('onboarding.required') }}");
                            isValid = false;
                        }
                    }

                    // ------------------------------------------------------
                    // (D) Other validations
                    // ------------------------------------------------------
                    switch (fieldName) {
                        case 'email':
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(value)) {
                                errorSpan.text("{{ __('onboarding.invalid_email') }}");
                                isValid = false;
                            }
                            break;

                        case 'phone_number':
                            const phoneRegex = /^(078|077|079)\d{7}$/;
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
                            const password = $('input[name="password"]').val();
                            if (value !== password) {
                                errorSpan.text("{{ __('onboarding.password_mismatch') }}");
                                isValid = false;
                            }
                            break;

                        case 'date_of_birth':
                            const today = new Date();
                            const birthDate = new Date(value);
                            let age = today.getFullYear() - birthDate.getFullYear();
                            const monthDiff = today.getMonth() - birthDate.getMonth();
                            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            if (age < 18) {
                                errorSpan.text("{{ __('onboarding.age_min') }}");
                                isValid = false;
                            } else if (age > 100) {
                                errorSpan.text("{{ __('onboarding.age_max') }}");
                                isValid = false;
                            }
                            break;
                            case 'guardian_contact':
                            // Use the latest global validation state from API
                            if (!guardianContactValid) {
                                // errorSpan.text("{{ __('onboarding.invalid_guardian_contact') }}");
                                isValid = false;
                            } else {
                                $(field).removeClass('is-invalid').addClass('is-valid');
                                errorSpan.text('');
                            }
                            break;

                          case 'bio_en':
                            var englishRegex = /^[A-Za-z\s.,'"()\-\?!]+$/;
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
                // ❌ منع الأرقام
                if (/\d/.test(value)) {
                    errorSpan.text("{{ __('onboarding.no_numbers_allowed') }}");
                    isValid = false;
                    break;
                }

                // ✔ السماح بالحروف العربية + المسافة + النقطة والفاصلة فقط
                var arabicAllowedRegex = /^[\u0600-\u06FF\s\.,]+$/u;

                if (!arabicAllowedRegex.test(value)) {
                    errorSpan.text("{{ __('onboarding.no_special_characters') }}");
                    isValid = false;
                    break;
                }

                break;


                // 3) Finally, ensure it’s at least Arabic letters (with allowed punctuation)
                var arabicLettersAndPunc = /^[\u0600-\u06FF\s\u060C\u061B\u061F\.,'"()\-\?!]+$/u;
                if (!arabicLettersAndPunc.test(value)) {
                    errorSpan.text("{{ __('onboarding.arabic_required_no_numbers') }}");
                    isValid = false;
                }
                break;
                        // case 'guardian_contact':
                        //     const guardianRegex = /^(078|077|079)\d{7}$/;
                        //     if (!guardianRegex.test(value)) {
                        //         errorSpan.text("{{ __('onboarding.invalid_guardian_contact') }}");
                        //         isValid = false;
                        //     }
                        //     break;

                        case 'photo_url':
                            if (value) {
                                const fileExtension = value.split('.').pop().toLowerCase();
                                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                if (!allowedExtensions.includes(fileExtension)) {
                                    errorSpan.text("{{ __('onboarding.invalid_image_file') }}");
                                    isValid = false;
                                }
                                if ($(field)[0].files.length > 0) {
                                    const fileSize = $(field)[0].files[0].size / 1024 / 1024; // MB
                                    if (fileSize > 5) {
                                        errorSpan.text("{{ __('onboarding.file_size') }}");
                                        isValid = false;
                                    }
                                }
                            }
                            break;

                        case 'number_of_children':
                            if (isNaN(value) || value < 0 || value > 10) {
                                errorSpan.text("{{ __('onboarding.children_range') }}");
                                isValid = false;
                            }
                            break;


                    }

                    // ------------------------------------------------------
                    // (E) Style feedback: green or red borders
                    // ------------------------------------------------------
                    if (isValid) {
                        $(field).removeClass('is-invalid').addClass('is-valid');
                        errorSpan.text(''); // no error
                        if (isSelect2) {
                            $(field).next('.select2')
                                .find('.select2-selection')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                    } else {
                        $(field).removeClass('is-valid').addClass('is-invalid');
                        if (isSelect2) {
                            $(field).next('.select2')
                                .find('.select2-selection')
                                .addClass('is-invalid');
                        }
                    }

                    return isValid;
                }
                // Run the check when the page loads
                validateReligiosityLevel();

                // Check again if the field changes
                $('select[name="religiosity_level_id"]').on('change', function() {
                    validateReligiosityLevel();
                });
                // loadFormData();

                // Save data on change
                // $('#onboarding-form').on('change', 'input, select, textarea', function() {
                //     // saveFormData();
                // });

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

                // // Function to mark fields as touched
                // function markStepFieldsAsTouched(step) {
                //     $(step).find('input, select, textarea').each(function() {
                //         $(this).data('touched', true);
                //     });
                // }
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

// ⭐ Auto-touch + validate city_location if country 1–22
function autoTouchCityLocationByCity(cityId) {
    const min = 1;
    const max = 22;

    let $loc = $('#city_location_id');

    // Reset first
    $loc.prop('required', false);

    if (cityId >= min && cityId <= max) {

        // make required
        $loc.prop('required', true);

        // mark touched
        $loc.data('touched', true);

        // validate immediately
        validateField($loc[0]);
    }
}
function loadFormDataFromLocalStorage() {
    let stored = sessionStorage.getItem(LS_KEY_DATA);

    if (!stored) return;

    let data = JSON.parse(stored);

    for (let key in data) {
        let el = $(`[name="${key}"]`);

        if (!el.length) continue;

      if (key === "religiosity_level_id") {
    savedReligiosityValue = data[key]; // ⬅️ خزّن القيمة لحين تحميل API
}
if (key === "city_id") {
    savedCityValue = data[key];
}

if (key === "city_location_id") {
    savedCityLocationValue = data[key];
}

if (key === "country_of_residence_id") {
    savedCountryValue = data[key];
}
if (key === "guardian_contact") {
    $('#guardian_contact_input').val(data[key]);

    // ⭐ قم بتفعيل الفالديشن تلقائيًا عند التحميل
    setTimeout(() => {
        if (typeof validateGuardianContact === 'function') {
            validateGuardianContact();
        }
    }, 500);
}


if (el.prop("multiple")) {
    el.val(data[key]).trigger("change");
} else {
    el.val(data[key]).trigger("change");
}

// ⭐ Mark as touched + validate immediately
el.data('touched', true);
validateField(el);

    }
    isPageLoading = false;
      // 🔥🔥🔥 AUTO-VALIDATE GUARDIAN CONTACT AFTER REFRESH
    if (userGender === "female") {
        const guardianInput = document.getElementById('guardian_contact_input');

        if (guardianInput && guardianInput.value.trim() !== "") {
            // wait for select2 / DOM to finish updating
            setTimeout(() => {
                validateGuardianContact();  // TRIGGER VALIDATION
            }, 300);
        }
    }
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

                $('.next-step').prop('disabled', true);

                $('.next-step').click(function() {
                    var currentStep = $(this).closest('.onboarding-step');
                    // markStepFieldsAsTouched(currentStep);
                    if (validateStep(currentStep)) {
                        var currentStepId = currentStep.attr('id');
                        var currentIndex = parseInt(currentStepId.split('-')[1]);
                        var nextStep = currentStep.next('.onboarding-step');
                        // Save current step form data
    saveCurrentFormToLocalStorage();

    // Save next step number
    saveCurrentStep(currentIndex + 1);
                        currentStep.hide();
                        nextStep.show();
                        updateStepIndicator(currentIndex + 1);
                                applyStepRequiredRules(nextStep);

                        $('html, body').animate({
                            scrollTop: 0
                        }, 'fast');
                    }
                        onStepShown(currentIndex + 1);

                });

                $('.prev-step').click(function() {
                    var currentStep = $(this).closest('.onboarding-step');
                    var currentStepId = currentStep.attr('id');
                    var currentIndex = parseInt(currentStepId.split('-')[1]);
                    var prevStep = currentStep.prev('.onboarding-step');

                    // حفظ بيانات الخطوة
                    saveCurrentFormToLocalStorage();
                    saveCurrentStep(currentIndex - 1);
                        applyStepRequiredRules(prevStep);

                    // إظهار الخطوة السابقة
                    currentStep.hide();
                    prevStep.show();

                    updateStepIndicator(currentIndex - 1);

                    // ⭐ أهم شيء: فعل الفالديشن الموجودة مسبقاً
                    // ضع جميع حقول الخطوة السابقة كـ touched
                    prevStep.find('input, select, textarea').each(function() {
                        $(this).data('touched', true);
                        validateField(this);  // ← الفالديشن الموجودة عندك
                    });

                    // ⭐ استخدم validateStep الأصلي
                    if (validateStep(prevStep)) {
                        prevStep.find('.next-step').prop('disabled', false);
                    } else {
                        prevStep.find('.next-step').prop('disabled', true);
                    }

                    // ⭐ منع أي لودر عن previous
                    $(".btn-text").show();
                    $(".btn-loader").hide();

                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                });
/* ============================================================
   FIX: HTML5 “invalid form control is not focusable”
   By enabling required ONLY for visible step
   ============================================================ */

function applyStepRequiredRules(step) {
    // اجعل جميع required داخل الستب الحالية فعّالة
    step.find('[required]').each(function () {
        $(this).prop('required', true);
    });

    // عطّل required داخل كل الستبات المخفية
    $('.onboarding-step').not(step).find('[required]').prop('required', false);
}

                // Replace your existing disclaimerAgreement change handler with this
                $('#disclaimerAgreement').on('change', function() {
                    $(this).data('touched', true);
                    validateField(this);

                    // Directly enable/disable the submit button based on checkbox state
                        if ($(this).is(':checked') && loadedApis >= totalApis) {
            $("#final-submit-button").prop("disabled", false);
        } else {
            $("#final-submit-button").prop("disabled", true);
        }
                });
                $('#onboarding-form').on('submit', function(e) {
                    e.preventDefault();

                    var currentStep = $('.onboarding-step:visible');
                    // markStepFieldsAsTouched(currentStep);

                    if (!validateStep(currentStep)) {
                        return false;
                    }

                    // Ensure disclaimer is checked
                    if (!$('#disclaimerAgreement').prop('checked')) {
                        $('#disclaimerAgreement').addClass('is-invalid');
                        $('#disclaimerAgreement')
                            .closest('.form-check')
                            .find('.error-message')
                            .text("{{ __('onboarding.consent_required') }}");
                        return false;
                    }

                    // 🔥🔥🔥 حذف بيانات sessionStorage عند الضغط على SUBMIT
                    sessionStorage.removeItem("onboardingFormData");
                    sessionStorage.removeItem("onboardingCurrentStep");

                    this.submit(); // allow real submit
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
                $('#country_id').on('change', function() {
                    var countryId = $(this).val();
                    toggleCityLocationRequirement(countryId);
                        // autoTouchCityLocationByCity(parseInt(countryId));

                    // Clear the city dropdown completely first
                    $('#city_id')
                        .empty()
                        .append('<option value="">{{ __('onboarding.select_city') }}</option>');

                    if (countryId) {
                        $.ajax({
                            url: "{{ route('cities.by.country', '') }}/" + countryId,
                            type: 'GET',
                            success: function(data) {
                                $.each(data, function(index, city) {
                                    $('#city_id').append('<option value="' + city.id +
                                        '">' + city.name + '</option>');
                                });
                                 apiLoaded()
                            },
                            error: function() {
                                console.error("Error loading cities.");
                            }
                        });
                    }
                });



                /* --------------------------------------------------
                 * Fetch city locations when a city is chosen
                 * -------------------------------------------------- */
                $('#city_id').on('change', function() {
                    var cityId = $(this).val();
        // autoTouchCityLocationByCity(cityId);


        // Otherwise run your old logic:
        autoTouchCityLocationByCity(cityId);
                    // reset the select first
                    $('#city_location_id')
                        .empty()
                        .append('<option value="">{{ __('onboarding.city_location') }}</option>');

                    if (cityId) {
                        $.ajax({
                            url: "{{ route('cityLocations.by.city', '') }}/" + cityId,
                            type: 'GET',
                            success: function(data) {
                                $.each(data, function(index, location) {
                                    $('#city_location_id').append(
                                        '<option value="' + location.id + '">' + location.name +
                                        '</option>'
                                    );
                                });
                                 apiLoaded()
                                 // ⛔ STOP if no locations exist (this also resets validation)
        if (resetCityLocationIfEmpty()) return;
                            },
                        });
                    }


                });
            });

            $(document).ready(function() {
                // Fix for mobile textarea focus
                if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
                    $('textarea').on('touchstart', function() {
                        $(this).focus();
                    });
                }
            });

     document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('guardian_contact_input');
    if (!input) return; // skip for male users

    const countrySelect = document.querySelector('select[name="country_code"]');
    const errorSpan = input.closest('.form-group').querySelector('.error-message');
    // ✅ find the next-step button within the same step block
    const currentStep = input.closest('.onboarding-step');
    const nextButton = currentStep ? currentStep.querySelector('.next-step') : null;

    let debounceTimer = null;

    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
            // if (isPageLoading) return;

        debounceTimer = setTimeout(() => {
            validateGuardianContact();
        }, 700); // wait 700ms after typing stops
    });

    async function validateGuardianContact() {
    const guardianContact = input.value.trim();
    const countryCode = countrySelect.value;

    // Reset
    errorSpan.textContent = '';
    input.classList.remove('is-valid', 'is-invalid');
    errorSpan.classList.remove('text-success', 'text-danger');
    guardianContactValid = false; // default = invalid

    if (nextButton) nextButton.disabled = true;

    if (!guardianContact) return; // nothing entered yet

    const formData = new FormData();
    formData.append('country_code', countryCode);
    formData.append('guardian_contact', guardianContact);

    try {
        const response = await fetch("{{ route('validate.guardian.contact') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept-Language': '{{ app()->getLocale() }}',
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            let message = data.message ;
            if (data.errors && data.errors.guardian_contact) {
                message = data.errors.guardian_contact[0];
            }

            errorSpan.textContent = message;
            errorSpan.classList.add('text-danger');
            input.classList.add('is-invalid');
            guardianContactValid = false;
            if (nextButton) nextButton.disabled = true;
        } else {
            errorSpan.textContent = data.message || "{{ __('Guardian contact valid.') }}";
            errorSpan.classList.add('text-success');
            input.classList.add('is-valid');
            guardianContactValid = true;

            if (nextButton) nextButton.disabled = false;
        }
    } catch (error) {
        errorSpan.textContent = "{{ __('Network error, please try again.') }}";
        errorSpan.classList.add('text-danger');
        input.classList.add('is-invalid');
        guardianContactValid = false;
        if (nextButton) nextButton.disabled = true;
    }
}

});



        </script>
    @endpush
@endsection
