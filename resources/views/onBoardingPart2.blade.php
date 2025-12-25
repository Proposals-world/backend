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
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row no-gutters">
                            @php
                            // Define step titles for Part 2
                            $steps_part2 = [
                                0 => __('onboarding.employment_lifestyle'),
                                1 => __('onboarding.family_housing'),
                            ];
                            @endphp
                            @foreach ($steps_part2 as $index => $step)
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

                    @if(session('success'))
                    <div id="profile-success-alert" class="mb-4">
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="display:block;">
                            <i class="simple-icon-check mr-2"></i>
                            <span id="preference-success-message">
                                {{ session('success') }}
                            </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif

                    <div class="card rounded-lg shadow-lg onboarding-card">
                        <div class="card-body p-lg-5">
                            <form id="onboarding-form-part2" method="POST" action="{{ route('user.profile.update.part2') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="form_part" value="second_part">

                                <div class="onboarding-steps">
                                    <!-- Step 0: Employment and Lifestyle -->
                                    <div class="onboarding-step" id="step-0">
                                        <h2 class="card-title text-center mb-4 section-title">
                                            {{ __('onboarding.employment_lifestyle') }}
                                        </h2>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.employment_status') }} <span class="required-field">*</span></label>
                                                    <select name="employment_status" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_employment') }}</option>
                                                        <option value="1">{{ __('onboarding.employed') }}</option>
                                                        <option value="0">{{ __('onboarding.unemployed') }}</option>
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4 job-title-wrapper" style="display:none;">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.Job_Domain') }} <span class="required-field">*</span></label>
                                                    <select name="job_title_id" class="form-control rounded-pill">
                                                        <option value="">{{ __('onboarding.select_job_domain') }}</option>
                                                        @foreach ($data['jobTitles'] as $jobTitle)
                                                        <option value="{{ $jobTitle->id }}">{{ $jobTitle->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4 position-level-wrapper" style="display:none;">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.position_level') }} <span class="required-field">*</span></label>
                                                    <select name="position_level_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_position_level') }}</option>
                                                        @foreach ($data['positionLevels'] as $position)
                                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.educational_level') }} <span class="required-field">*</span></label>
                                                    <select name="educational_level_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_educational_level') }}</option>
                                                        @foreach ($data['educationalLevels'] as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.specialization') }} <span class="required-field">*</span></label>
                                                    <select name="specialization_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_specialization') }}</option>
                                                        @foreach ($data['specializations'] as $specialization)
                                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.sports_activity') }} <span class="required-field">*</span></label>
                                                    <select name="sports_activity_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_sports_activity') }}</option>
                                                        @foreach ($data['sportsActivities'] as $sport)
                                                        <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.smoking_status') }} <span class="required-field">*</span></label>
                                                    <select name="smoking_status" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_smoking_status') }}</option>
                                                        <option value="0">{{ __('onboarding.non_smoker') }}</option>
                                                        <option value="1">{{ __('onboarding.smoker') }}</option>
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4 smoking-tools-wrapper" style="display:none;">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.smoking_tools') }} <span class="required-field">*</span></label>
                                                    <select name="smoking_tools[]" class="form-control rounded-pill" id="smoking_tools" multiple>
                                                        @foreach ($data['smokingTools'] as $tool)
                                                        <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="error-smoking_tools" class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.drinking_status') }} <span class="required-field">*</span></label>
                                                    <select name="drinking_status_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_drinking_status') }}</option>
                                                        @foreach ($data['drinkingStatuses'] as $drinking)
                                                        <option value="{{ $drinking->id }}">{{ $drinking->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.social_media_presence') }} <span class="required-field">*</span></label>
                                                    <select name="social_media_presence_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_social_media_presence') }}</option>
                                                        @foreach ($data['socialMediaPresence'] as $social)
                                                        <option value="{{ $social->id }}">{{ $social->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="onboarding-navigation d-flex justify-content-end mt-4">
                                            <button type="button" class="btn btn-primary rounded-pill next-step" disabled>
                                                {{ __('onboarding.next') }} <i class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} ml-2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Step 1: Family and Housing -->
                                    <div class="onboarding-step" id="step-1" style="display:none;">
                                        <h2 class="card-title text-center mb-4 section-title">
                                            {{ __('onboarding.family_housing') }}
                                        </h2>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.marital_status') }} <span class="required-field">*</span></label>
                                                    <select name="marital_status_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_marital_status') }}</option>
                                                        @foreach ($data['maritalStatuses'] as $maritalStatus)
                                                        <option value="{{ $maritalStatus->id }}">{{ $maritalStatus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.pets') }} <span class="required-field">*</span></label>
                                                    <select name="pets[]" class="form-control rounded-pill" id="pets" required multiple>
                                                        @foreach ($data['pets'] as $pet)
                                                        <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="error-pets" class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.hobbies') }} <span class="required-field">*</span></label>
                                                    <select name="hobbies[]" class="form-control rounded-pill" id="hobbies" required multiple>
                                                        @foreach ($data['hobbies'] as $hobby)
                                                        <option value="{{ $hobby->id }}">{{ $hobby->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="error-hobbies" class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            @if (old('gender') !== 'female')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.marriage_budget') }} <span class="required-field">*</span></label>
                                                    <select name="marriage_budget_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_marriage_budget') }}</option>
                                                        @foreach ($data['marriageBudget'] as $budget)
                                                        <option value="{{ $budget->id }}">{{ $budget->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        @if (old('gender') !== 'female')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.housing_status') }} <span class="required-field">*</span></label>
                                                    <select name="housing_status_id" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_housing_status') }}</option>
                                                        @foreach ($data['housingStatuses'] as $housing)
                                                        <option value="{{ $housing->id }}">{{ $housing->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if (old('gender') == 'female')
                                        <div class="form-group">
                                            <label class="form-label">{{ __('onboarding.hijab_status') }} <span class="required-field">*</span></label>
                                            <select name="hijab_status" class="form-control rounded-pill" required>
                                                <option value="1">{{ __('onboarding.strictly_hijab') }}</option>
                                                <option value="0">{{ __('onboarding.non_hijab') }}</option>
                                            </select>
                                            <span class="error-message text-danger" style="font-size:12px;"></span>
                                        </div>
                                        @endif

                                        <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                            <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                                <i class="fas fa-arrow-{{ $locale === 'ar' ? 'right' : 'left' }} mr-2"></i>{{ __('onboarding.previous') }}
                                            </button>
                                            <button type="submit" class="btn btn-success rounded-pill" id="final-submit-button">
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
    var totalApis = 0;
    var loadedApis = 0;
    let isPageLoading = true;

    function apiLoaded() {
        loadedApis++;
        if (loadedApis >= totalApis) {
            $(".btn-text").show();
            $(".btn-loader").hide();
        }
    }

    /* ============================================================
       LOCAL STORAGE AUTO SAVE SYSTEM FOR ONBOARDING
       ============================================================ */

    const LS_KEY_DATA = "onboardingFormDataPart2";
    const LS_KEY_STEP = "onboardingCurrentStepPart2";

    function saveCurrentFormToLocalStorage() {
        let data = {};

        // Save all inputs, selects, textareas
        $("#onboarding-form-part2")
            .find("input, select, textarea")
            .each(function() {
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

    function loadSavedStep() {
        let saved = sessionStorage.getItem(LS_KEY_STEP);
        if (!saved) return 0;

        saved = parseInt(saved);

        $(".onboarding-step").hide();
        $(`#step-${saved}`).show();

        $(".step-indicator").removeClass("active");
        $(`.step-indicator[data-step="${saved}"]`).addClass("active");

        return saved;
    }

    function loadFormDataFromLocalStorage() {
        let stored = sessionStorage.getItem(LS_KEY_DATA);

        if (!stored) return;

        let data = JSON.parse(stored);

        for (let key in data) {
            let el = $(`[name="${key}"]`);

            if (!el.length) continue;

            if (el.prop("multiple")) {
                el.val(data[key]).trigger("change");
            } else {
                el.val(data[key]).trigger("change");
            }

            // Mark as touched + validate immediately
            el.data('touched', true);
            validateField(el);
        }
        isPageLoading = false;
    }

    // Validate individual field
    function validateField(field) {
        const fieldName = $(field).attr('name');
        const fieldType = $(field).attr('type');

        if ($(field).attr('id') === 'smoking_tools' && $('.smoking-tools-wrapper').is(':hidden')) {
            return true;
        }

        if (
            !fieldName ||
            $(field).hasClass('select2-search__field') ||
            fieldType === 'search'
        ) {
            return true;
        }

        // If the field is hidden, skip validation
        if ($(field).is(':hidden')) return true;

        const isSelect2 = $(field).hasClass('select2-hidden-accessible');
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
                realVal === undefined;

            if (isPlaceholder) {
                isValid = false;
            }
        }

        // Decide which error span to use
        let errorSpan = $(field).closest('.form-group').find('.error-message');
        const customErrorSpan = $(`#error-${fieldId}`);
        if (customErrorSpan.length > 0) {
            errorSpan = customErrorSpan;
        }

        // Clear old message
        errorSpan.text('');

        // If not "touched" yet, skip
        if (!touched) {
            return false;
        }

        // Universal "required" check
        if ($(field).prop('required')) {
            if (Array.isArray(value) && value.length === 0) {
                errorSpan.text("{{ __('onboarding.required') }}");
                isValid = false;
            } else if (!Array.isArray(value) && !value) {
                errorSpan.text("{{ __('onboarding.required') }}");
                isValid = false;
            }
        }

        // Smoking tools conditional validation
        if (fieldId === 'smoking_tools') {
            const smokingStatus = $('select[name="smoking_status"]').val();
            if (smokingStatus === '1' && value.length === 0) {
                errorSpan.text("{{ __('onboarding.required') }}");
                isValid = false;
            }
        }

        // Style feedback
        if (isValid) {
            $(field).removeClass('is-invalid').addClass('is-valid');
            errorSpan.text('');
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

    // Validate all fields in a step
    function validateStep(step) {
        var isValid = true;
        $(step).find('input, select, textarea').each(function() {
            if (!validateField(this)) {
                isValid = false;
            }
        });
        return isValid;
    }

    function updateNextButton(step) {
        if (validateStep(step)) {
            $(step).find('.next-step').prop('disabled', false);
        } else {
            $(step).find('.next-step').prop('disabled', true);
        }
    }

    function applyStepRequiredRules(step) {
        // Enable required only for visible step
        step.find('[required]').each(function() {
            $(this).prop('required', true);
        });

        // Disable required for hidden steps
        $('.onboarding-step').not(step).find('[required]').prop('required', false);
    }

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

    $(document).ready(function() {
        const navEntries = performance.getEntriesByType("navigation");
        const pageReloaded = navEntries.length > 0 && navEntries[0].type === "reload";

        if (!pageReloaded) {
            loadedApis = totalApis;
        }

        if (pageReloaded) {
            $(".btn-text").show();
            $(".btn-loader").hide();
        }

        // Initialize Select2 on multi-selects
        $('select[multiple]').select2({
            placeholder: "{{ __('profile.you_can_select_more_than_one') }}",
            allowClear: true
        });

        // Remove housing and marriage budget for female users
        if (userGender === 'female') {
            $('select[name="housing_status_id"]').closest('.form-group').remove();
            $('select[name="marriage_budget_id"]').closest('.form-group').remove();
        }

        // Run toggles on page load
        toggleSmokingTools();
        toggleJobTitle();

        // Load form data FIRST (before select2 initialization)
        loadFormDataFromLocalStorage();

        // Load step AFTER form data
        let startingStep = loadSavedStep();
        applyStepRequiredRules($(`#step-${startingStep}`));

        // Mark fields as touched on blur/change
        $('input, select, textarea').on('blur change', function() {
            $(this).data('touched', true);
            validateField(this);
            var currentStep = $(this).closest('.onboarding-step');
            updateNextButton(currentStep);
        });

        // Bind change events for conditional fields
        $('select[name="smoking_status"]').on('change', function() {
            $(this).data('touched', true);
            validateField(this);
            toggleSmokingTools();
            var currentStep = $(this).closest('.onboarding-step');
            updateNextButton(currentStep);
        });

        $('select[name="employment_status"]').on('change', function() {
            $(this).data('touched', true);
            validateField(this);
            toggleJobTitle();
            var currentStep = $(this).closest('.onboarding-step');
            updateNextButton(currentStep);
        });

        $('.next-step').prop('disabled', true);

        $('.next-step').click(function() {
            var currentStep = $(this).closest('.onboarding-step');
            if (validateStep(currentStep)) {
                var currentStepId = currentStep.attr('id');
                var currentIndex = parseInt(currentStepId.split('-')[1]);
                var nextStep = currentStep.next('.onboarding-step');

                // Save current step form data
                saveCurrentFormToLocalStorage();
                saveCurrentStep(currentIndex + 1);

                currentStep.hide();
                nextStep.show();
                updateStepIndicator(currentIndex + 1);
                applyStepRequiredRules(nextStep);

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

            // Save form data
            saveCurrentFormToLocalStorage();
            saveCurrentStep(currentIndex - 1);
            applyStepRequiredRules(prevStep);

            // Show previous step
            currentStep.hide();
            prevStep.show();
            updateStepIndicator(currentIndex - 1);

            // Mark all fields in previous step as touched and validate
            prevStep.find('input, select, textarea').each(function() {
                $(this).data('touched', true);
                validateField(this);
            });

            if (validateStep(prevStep)) {
                prevStep.find('.next-step').prop('disabled', false);
            } else {
                prevStep.find('.next-step').prop('disabled', true);
            }

            $(".btn-text").show();
            $(".btn-loader").hide();

            $('html, body').animate({
                scrollTop: 0
            }, 'fast');
        });

        // Form submission
        $('#onboarding-form-part2').on('submit', function(e) {
            e.preventDefault();

            var currentStep = $('.onboarding-step:visible');

            if (!validateStep(currentStep)) {
                return false;
            }

            // Save final data to localStorage
            saveCurrentFormToLocalStorage();

            // Clear session storage
            sessionStorage.removeItem("onboardingFormDataPart2");
            sessionStorage.removeItem("onboardingCurrentStepPart2");

            // Show loading state
            $('.btn-text').hide();
            $('.btn-loader').show();
            $('#final-submit-button').prop('disabled', true);

            this.submit(); // allow real submit
        });

        // Mobile touch fix
        if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
            $('textarea').on('touchstart', function() {
                $(this).focus();
            });
        }
    });
</script>
@endpush
@endsection
