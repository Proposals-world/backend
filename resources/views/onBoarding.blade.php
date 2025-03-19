@extends('frontend.layouts.app')
@section('section')
    <section id="onboarding" class="slider-area slider-bg2 second-slider-bg d-flex fix"
        style="
            @if (app()->getLocale() === 'ar')
                background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
                background-position: left 0;
            @else
                background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
                background-position: right 0;
            @endif
            background-repeat: no-repeat;
            background-size: 65%;">
        <div id="container" class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="onboarding-wrapper mt-5">
                        <!-- Step Indicators -->
                        <div class="onboarding-steps-indicator mb-4">
                            <div class="row no-gutters">
                                @php
                                    $steps = [
                                        __('onboarding.personal_info'),
                                        __('onboarding.physical_attributes'),
                                        __('onboarding.employment_lifestyle'),
                                        __('onboarding.family_housing'),
                                        __('onboarding.final_details'),
                                    ];
                                @endphp
                                @foreach ($steps as $index => $step)
                                    <div class="col step-indicator {{ $index == 0 ? 'active' : '' }}" data-step="{{ $index }}">
                                        <div class="step-number">{{ $index + 1 }}</div>
                                        <div class="step-name d-none d-md-block">{{ $step }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Onboarding Form -->
                        <div class="card rounded-lg shadow-lg onboarding-card">
                            <div class="card-body p-lg-5">
                                <form id="onboarding-form" method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="onboarding-steps">
                                        <!-- Step 0: Personal Information -->
                                        <div class="onboarding-step" id="step-0">
                                            <h2 class="card-title text-center mb-4 section-title">{{ __('onboarding.personal_info') }}</h2>
                                            <div class="form-group">
                                                <label class="form-label">{{ __('onboarding.photo_upload') }}</label>
                                                <div class="custom-file">
                                                    <input type="file" name="photo_url" class="custom-file-input" id="customFile" accept="image/*" required>
                                                    <label class="custom-file-label" for="customFile">{{ __('onboarding.choose_photo') }}</label>
                                                </div>
                                                <span class="error-message text-danger" style="font-size:12px;"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.bio_en') }}</label>
                                                        <textarea name="bio_en" class="form-control rounded" rows="3" placeholder="{{ __('onboarding.bio_placeholder_en') }}" required></textarea>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.bio_ar') }}</label>
                                                        <textarea name="bio_ar" class="form-control rounded" rows="3" placeholder="{{ __('onboarding.bio_placeholder_ar') }}" required></textarea>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.date_of_birth') }}</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" name="date_of_birth" class="form-control rounded-right" required>
                                                        </div>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.nationality') }}</label>
                                                        <select name="nationality_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_nationality') }}</option>
                                                            @foreach ($data['nationalities'] as $nationality)
                                                                <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-primary rounded-pill next-step" disabled>
                                                    {{ __('onboarding.next') }} <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 1: Physical Attributes -->
                                        <div class="onboarding-step" id="step-1" style="display:none;">
                                            <h2 class="card-title text-center mb-4 section-title">{{ __('onboarding.physical_attributes') }}</h2>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.height') }}</label>
                                                        <select name="height" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_height') }}</option>
                                                            @foreach ($data['heights'] as $height)
                                                                <option value="{{ $height->id }}">{{ $height->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.weight') }}</label>
                                                        <select name="weight" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_weight') }}</option>
                                                            @foreach ($data['weights'] as $weight)
                                                                <option value="{{ $weight->id }}">{{ $weight->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.hair_color') }}</label>
                                                        <select name="hair_color_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_hair_color') }}</option>
                                                            @foreach ($data['hairColors'] as $hairColor)
                                                                <option value="{{ $hairColor->id }}">{{ $hairColor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.skin_color') }}</label>
                                                        <select name="skin_color_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_skin_color') }}</option>
                                                            @foreach ($data['skinColors'] as $skinColor)
                                                                <option value="{{ $skinColor->id }}">{{ $skinColor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Religiosity Level (populated client-side based on gender) -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.religiosity_level') }}</label>
                                                        <select id="religiosity_levels" name="religiosity_level_id" class="form-control rounded-pill" >
                                                            <option value="">{{ __('onboarding.select_religiosity') }}</option>
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                                    <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step" disabled>
                                                    {{ __('onboarding.next') }} <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 2: Employment and Lifestyle -->
                                        <div class="onboarding-step" id="step-2" style="display:none;">
                                            <h2 class="card-title text-center mb-4 section-title">{{ __('onboarding.employment_lifestyle') }}</h2>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.employment_status') }}</label>
                                                        <select name="employment_status" class="form-control rounded-pill" required>
                                                            <option value="1">{{ __('onboarding.employed') }}</option>
                                                            <option value="0">{{ __('onboarding.unemployed') }}</option>
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <!-- Job Title container; shown only if Employment Status is 1 -->
                                                <div class="col-md-4 job-title-wrapper" style="display:none;">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.job_title') }}</label>
                                                        <select name="job_title_id" class="form-control rounded-pill">
                                                            <option value="">{{ __('onboarding.select_job_title') }}</option>
                                                            @foreach ($data['jobTitles'] as $jobTitle)
                                                                <option value="{{ $jobTitle->id }}">{{ $jobTitle->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.position_level') }}</label>
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
                                                        <label class="form-label">{{ __('onboarding.smoking_status') }}</label>
                                                        <select name="smoking_status" class="form-control rounded-pill" required>
                                                            <option value="0">{{ __('onboarding.non_smoker') }}</option>
                                                            <option value="1">{{ __('onboarding.smoker') }}</option>
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <!-- Smoking Tools container; shown only if Smoking Status is 1 -->
                                                <div class="col-md-4 smoking-tools-wrapper" style="display:none;">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.smoking_tools') }}</label>
                                                        <select name="smoking_tools[]" class="form-control rounded-pill" multiple>
                                                            <option value="">{{ __('onboarding.select_smoking_tools') }}</option>
                                                            @foreach ($data['smokingTools'] as $tool)
                                                                <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.drinking_status') }}</label>
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
                                                        <label class="form-label">{{ __('onboarding.social_media_presence') }}</label>
                                                        <select name="social_media_presence_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_social_media_presence') }}</option>
                                                            @foreach ($data['socialMediaPresence'] as $social)
                                                                <option value="{{ $social->id }}">{{ $social->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.sports_activity') }}</label>
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
                                            <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                                    <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step" disabled>
                                                    {{ __('onboarding.next') }} <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 3: Family and Housing -->
                                        <div class="onboarding-step" id="step-3" style="display:none;">
                                            <h2 class="card-title text-center mb-4 section-title">{{ __('onboarding.family_housing') }}</h2>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.marital_status') }}</label>
                                                        <select name="marital_status_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_marital_status') }}</option>
                                                            @foreach ($data['maritalStatuses'] as $maritalStatus)
                                                                <option value="{{ $maritalStatus->id }}">{{ $maritalStatus->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.number_of_children') }}</label>
                                                        <input type="number" name="number_of_children" class="form-control rounded-pill" min="0" max="10" required>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.housing_status') }}</label>
                                                        <select name="housing_status_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_housing_status') }}</option>
                                                            @foreach ($data['housingStatuses'] as $housingStatus)
                                                                <option value="{{ $housingStatus->id }}">{{ $housingStatus->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.hobbies') }}</label>
                                                        <select name="hobbies[]" class="form-control rounded-pill" required multiple>
                                                            <option value="">{{ __('onboarding.select_hobbies') }}</option>
                                                            @foreach ($data['hobbies'] as $hobby)
                                                                <option value="{{ $hobby->id }}">{{ $hobby->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.pets') }}</label>
                                                        <select name="pets[]" class="form-control rounded-pill" required multiple>
                                                            <option value="">{{ __('onboarding.select_pets') }}</option>
                                                            @foreach ($data['pets'] as $pet)
                                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(old('gender') == 'female')
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('onboarding.hijab_status') }}</label>
                                                    <select name="hijab_status" class="form-control rounded-pill" required>
                                                        <option value="">{{ __('onboarding.select_hijab_status') }}</option>
                                                        <option value="1">{{ __('onboarding.strictly_hijab') }}</option>
                                                        <option value="0">{{ __('onboarding.non_hijab') }}</option>
                                                    </select>
                                                    <span class="error-message text-danger" style="font-size:12px;"></span>
                                                </div>
                                            @endif
                                            <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                                    <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                                </button>
                                                <button type="button" class="btn btn-primary rounded-pill next-step" disabled>
                                                    {{ __('onboarding.next') }} <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 4: Final Details -->
                                        <div class="onboarding-step" id="step-4" style="display:none;">
                                            <h2 class="card-title text-center mb-4 section-title">{{ __('onboarding.final_details') }}</h2>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            {{ __('onboarding.guardian_contact') }}
                                                            <small class="form-text text-muted">{{ __('onboarding.guardian_contact_help') }}</small>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                            </div>
                                                            <input type="tel" name="guardian_contact" class="form-control rounded-right" required>
                                                        </div>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('onboarding.financial_status') }}</label>
                                                        <select name="financial_status_id" class="form-control rounded-pill" required>
                                                            <option value="">{{ __('onboarding.select_financial_status') }}</option>
                                                            @foreach ($data['financialStatuses'] as $financialStatus)
                                                                <option value="{{ $financialStatus->id }}">{{ $financialStatus->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error-message text-danger" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label class="form-label">{{ __('onboarding.car_ownership') }}</label>
                                                         <select name="car_ownership" class="form-control rounded-pill" required>
                                                             <option value="">{{ __('onboarding.select_car_ownership') }}</option>
                                                             <option value="1">{{ __('onboarding.own_car') }}</option>
                                                             <option value="0">{{ __('onboarding.no_car') }}</option>
                                                         </select>
                                                         <span class="error-message text-danger" style="font-size:12px;"></span>
                                                     </div>
                                                 </div>
                                            </div>
                                            <div class="onboarding-navigation d-flex justify-content-between mt-4">
                                                 <button type="button" class="btn btn-secondary rounded-pill prev-step">
                                                     <i class="fas fa-arrow-left mr-2"></i>{{ __('onboarding.previous') }}
                                                 </button>
                                                 <button type="submit" class="btn btn-success rounded-pill">
                                                     {{ __('onboarding.submit') }} <i class="fas fa-check ml-2"></i>
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
            $(document).ready(function() {

                // Initialize Select2 on multi-selects
                $('select[multiple]').select2({
                    placeholder: "{{ __('onboarding.select_hobbies') }}",
                    allowClear: true
                });

                // Static arrays for Religiosity Levels (client-side only)
                var maleReligiosityLevels = [
                    { id: 1, text: "{{ __('onboarding.very_devout') }}" },
                    { id: 2, text: "{{ __('onboarding.devout') }}" },
                    { id: 3, text: "{{ __('onboarding.moderately_devout') }}" },
                    { id: 4, text: "{{ __('onboarding.average') }}" },
                    { id: 5, text: "{{ __('onboarding.low') }}" }
                ];
                var femaleReligiosityLevels = [
                    { id: 6, text: "{{ __('onboarding.very_covered') }}" },
                    { id: 7, text: "{{ __('onboarding.strictly_hijab') }}" },
                    { id: 8, text: "{{ __('onboarding.hijab') }}" },
                    { id: 9, text: "{{ __('onboarding.modestly_non_hijab') }}" },
                    { id: 10, text: "{{ __('onboarding.non_hijab') }}" }
                ];

                // Update Religiosity Levels select when gender is changed
                $('input[name="gender"]').on('change', function() {
                    var gender = $(this).val();
                    var $select = $('#religiosity_levels');
                    $select.empty();
                    $select.append('<option value="">{{ __('onboarding.select_religiosity') }}</option>');
                    if (gender === 'male') {
                        $.each(maleReligiosityLevels, function(index, option) {
                            $select.append('<option value="' + option.id + '">' + option.text + '</option>');
                        });
                    } else if (gender === 'female') {
                        $.each(femaleReligiosityLevels, function(index, option) {
                            $select.append('<option value="' + option.id + '">' + option.text + '</option>');
                        });
                    }
                });

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

                // Validate individual field
                function validateField(field) {
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
                            errorSpan.text('This field is required.');
                            return false;
                        }
                        if ($(field).is('select') && value === '') {
                            errorSpan.text('This field is required.');
                            return false;
                        }
                        if (!Array.isArray(value) && !value) {
                            errorSpan.text('This field is required.');
                            return false;
                        }
                    }
                    // Explicit checks for specific selects
                    if ((fieldName === 'specialization_id' || fieldName === 'job_title_id' || fieldName === 'drinking_status_id') && value === '') {
                        errorSpan.text('This field is required.');
                        return false;
                    }
                    switch (fieldName) {
                        case 'email':
                            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(value)) {
                                errorSpan.text('Please enter a valid email address.');
                                isValid = false;
                            }
                            break;
                        case 'phone_number':
                            var phoneRegex = /^[0-9+\-\s()]{8,20}$/;
                            if (!phoneRegex.test(value)) {
                                errorSpan.text('Please enter a valid phone number.');
                                isValid = false;
                            }
                            break;
                        case 'password':
                            if (value.length < 8) {
                                errorSpan.text('Password must be at least 8 characters long.');
                                isValid = false;
                            }
                            break;
                        case 'password_confirmation':
                            var password = $('input[name="password"]').val();
                            if (value !== password) {
                                errorSpan.text('Passwords do not match.');
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
                                errorSpan.text('You must be at least 18 years old.');
                                isValid = false;
                            }
                            if (age > 100) {
                                errorSpan.text('Please enter a valid date of birth.');
                                isValid = false;
                            }
                            break;
                        case 'photo_url':
                            if (value) {
                                var fileExtension = value.split('.').pop().toLowerCase();
                                var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                if (!allowedExtensions.includes(fileExtension)) {
                                    errorSpan.text('Please upload a valid image file (JPG, JPEG, PNG, GIF).');
                                    isValid = false;
                                }
                                if ($(field)[0].files.length > 0) {
                                    var fileSize = $(field)[0].files[0].size / 1024 / 1024;
                                    if (fileSize > 5) {
                                        errorSpan.text('File size should not exceed 5MB.');
                                        isValid = false;
                                    }
                                }
                            }
                            break;
                        case 'number_of_children':
                            if (value && (isNaN(value) || value < 0 || value > 10)) {
                                errorSpan.text('Please enter a number between 0 and 10.');
                                isValid = false;
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
                            $(step).find('input[name="gender"]').closest('.form-group').find('.error-message').text('Please select a gender.');
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
                    $('.form-group').find('input[name="' + radioGroup + '"]').closest('.form-group').find('.error-message').text('');
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
                    markStepFieldsAsTouched(currentStep);
                    if (validateStep(currentStep)) {
                        var currentStepId = currentStep.attr('id');
                        var currentIndex = parseInt(currentStepId.split('-')[1]);
                        var nextStep = currentStep.next('.onboarding-step');
                        currentStep.hide();
                        nextStep.show();
                        updateStepIndicator(currentIndex + 1);
                        $('html, body').animate({ scrollTop: 0 }, 'fast');
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
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                });

                $('#onboarding-form').on('submit', function(e) {
                    e.preventDefault();
                    var currentStep = $('.onboarding-step:visible');
                    markStepFieldsAsTouched(currentStep);
                    if (!validateStep(currentStep)) {
                        return false;
                    }
                    this.submit();
                });

                function updateStepIndicator(currentIndex) {
                    $('.step-indicator').each(function(index) {
                        if (index < currentIndex) {
                            $(this).find('.step-number').css('background-color', '#FF3494');
                            // $(this).removeClass('active');
                        } else if (index === currentIndex) {
                            $(this).find('.step-number').css('background-color', '#7D4196').css('opacity', '1');
                            $(this).addClass('active');
                        } else {
                            
                            $(this).find('.step-number').css('background-color', '#f1f1f1');
                        }
                    });
                }

                $('select[name="country_of_residence_id"]').on('change', function() {
                    var countryId = $(this).val();
                    var $citySelect = $('select[name="city_id"]');
                    $citySelect.empty().append('<option value="">{{ __('onboarding.select_city') }}</option>');
                    if (countryId) {
                        $.ajax({
                            url: '{{ route("cities.by.country", ":countryId") }}'.replace(':countryId', countryId),
                            type: 'GET',
                            dataType: 'json',
                            success: function(cities) {
                                $.each(cities, function(index, city) {
                                    $citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching cities:', error);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection