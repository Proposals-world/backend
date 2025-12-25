/* ============================================================
   COMMON ONBOARDING FUNCTIONS
   ============================================================ */

// Global variables
var savedReligiosityValue = null;
var savedCityValue = null;
var savedCityLocationValue = null;
var savedCountryValue = null;
var totalApis = 3;
var loadedApis = 0;
var guardianContactValid = false;
let isPageLoading = true;
var userGender = "{{ old('gender', auth()->user()->gender ?? '') }}";

// Local Storage keys
const LS_KEY_DATA = "onboardingFormData";
const LS_KEY_STEP = "onboardingCurrentStep";

function apiLoaded() {
    loadedApis++;
    if (loadedApis >= totalApis) {
        $(".btn-text").show();
        $(".btn-loader").hide();
    }
}

function saveCurrentFormToLocalStorage() {
    let data = {};

    $("#onboarding-form")
        .find("input, select, textarea")
        .each(function () {
            const name = $(this).attr("name");
            if (!name) return;
            if ($(this).hasClass("select2-search__field")) return;
            if ($(this).is(":file")) return;

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

function autoLoadCityAndLocation() {
    if (!savedCountryValue) return;

    $('#country_id').val(savedCountryValue);

    $.ajax({
        url: "{{ route('cities.by.country', '') }}/" + savedCountryValue,
        type: "GET",
        success: function (cities) {
            $('#city_id')
                .empty()
                .append('<option value="">{{ __("onboarding.select_city") }}</option>');

            cities.forEach(city => {
                $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
            });

            if (savedCityValue) {
                $('#city_id').val(savedCityValue);
            }

            if (savedCityValue) {
                loadCityLocations(savedCityValue);
            }
            apiLoaded();
        }
    });
}

function loadCityLocations(cityId) {
    $.ajax({
        url: "{{ route('cityLocations.by.city', '') }}/" + cityId,
        type: "GET",
        success: function (locations) {
            $('#city_location_id')
                .empty()
                .append('<option value="">{{ __("onboarding.city_location") }}</option>');

            locations.forEach(location => {
                $('#city_location_id').append(
                    `<option value="${location.id}">${location.name}</option>`
                );
            });

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

    if (optionCount <= 1) {
        $loc.prop('required', false);
        $loc.data('touched', false);
        $loc.removeClass('is-valid is-invalid');
        $loc.closest('.form-group').find('.error-message').text('');
        $loc.addClass('is-valid');
        return true;
    }
    return false;
}

function loadSavedStep() {
    // Implementation based on your needs
}

function loadFormDataFromLocalStorage() {
    let stored = sessionStorage.getItem(LS_KEY_DATA);
    if (!stored) return;

    let data = JSON.parse(stored);

    for (let key in data) {
        let el = $(`[name="${key}"]`);
        if (!el.length) continue;

        if (key === "religiosity_level_id") {
            savedReligiosityValue = data[key];
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

        el.data('touched', true);
        validateField(el);
    }
    isPageLoading = false;

    if (userGender === "female") {
        const guardianInput = document.getElementById('guardian_contact_input');
        if (guardianInput && guardianInput.value.trim() !== "") {
            setTimeout(() => {
                validateGuardianContact();
            }, 300);
        }
    }
}

function applyStepRequiredRules(step) {
    step.find('[required]').each(function () {
        $(this).prop('required', true);
    });
    $('.onboarding-step').not(step).find('[required]').prop('required', false);
}

// Common field validation function
function validateField(field) {
    const fieldName = $(field).attr('name');
    const fieldType = $(field).attr('type');

    if ($(field).attr('id') === 'city_location_id') {
        if ($('#city_location_id option').length <= 1) {
            return true;
        }
    }

    if (!fieldName || $(field).hasClass('select2-search__field') || fieldType === 'search') {
        return true;
    }

    if ($(field).is(':hidden')) return true;

    const isSelect2 = $(field).hasClass('select2-hidden-accessible');
    const fieldId = $(field).attr('id');
    const touched = $(field).data('touched');
    let value = $(field).prop('multiple') ?
        ($(field).val() || []) :
        ($(field).val() || '').trim();

    let isValid = true;

    // Select validation
    if ($(field).is("select")) {
        let realVal = $(field).val();
        let isPlaceholder = realVal === "" || realVal === null || realVal === undefined;
        if (isPlaceholder) {
            isValid = false;
        }
    }

    let errorSpan = $(field).closest('.form-group').find('.error-message');
    const customErrorSpan = $(`#error-${fieldId}`);
    if (customErrorSpan.length > 0) {
        errorSpan = customErrorSpan;
    }

    errorSpan.text('');

    if (!touched) {
        if (fieldName === 'guardian_contact') {
            return guardianContactValid;
        }
        return false;
    }

    // Required validation
    if ($(field).prop('required')) {
        if (Array.isArray(value) && value.length === 0) {
            errorSpan.text("{{ __('onboarding.required') }}");
            isValid = false;
        } else if (!Array.isArray(value) && !value) {
            errorSpan.text("{{ __('onboarding.required') }}");
            isValid = false;
        }
    }

    // Field-specific validations
    if (fieldId === 'smoking_tools') {
        const smokingStatus = $('select[name="smoking_status"]').val();
        if (smokingStatus === '1' && value.length === 0) {
            errorSpan.text("{{ __('onboarding.required') }}");
            isValid = false;
        }
    }

    // Other field validations
    switch (fieldName) {
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
            if (!guardianContactValid) {
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
            var specialCharRegex = /[^A-Za-z0-9\s.,'"\-?!()]/;
            if (specialCharRegex.test(value)) {
                errorSpan.text("{{ __('onboarding.no_special_characters') }}");
                isValid = false;
            }
            break;
        case 'bio_ar':
            if (/\d/.test(value)) {
                errorSpan.text("{{ __('onboarding.no_numbers_allowed') }}");
                isValid = false;
                break;
            }
            var arabicAllowedRegex = /^[\u0600-\u06FF\s\.,]+$/u;
            if (!arabicAllowedRegex.test(value)) {
                errorSpan.text("{{ __('onboarding.no_special_characters') }}");
                isValid = false;
                break;
            }
            break;
        case 'photo_url':
            if (value) {
                const fileExtension = value.split('.').pop().toLowerCase();
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (!allowedExtensions.includes(fileExtension)) {
                    errorSpan.text("{{ __('onboarding.invalid_image_file') }}");
                    isValid = false;
                }
                if ($(field)[0].files.length > 0) {
                    const fileSize = $(field)[0].files[0].size / 1024 / 1024;
                    if (fileSize > 5) {
                        errorSpan.text("{{ __('onboarding.file_size') }}");
                        isValid = false;
                    }
                }
            }
            break;
    }

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

function validateStep(step) {
    var isValid = true;
    $(step).find('input, select, textarea').each(function () {
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

// Guardian Contact Validation
function setupGuardianContactValidation() {
    const input = document.getElementById('guardian_contact_input');
    if (!input) return;

    const countrySelect = document.querySelector('select[name="country_code"]');
    const errorSpan = input.closest('.form-group').querySelector('.error-message');
    const currentStep = input.closest('.onboarding-step');
    const nextButton = currentStep ? currentStep.querySelector('.next-step') : null;

    let debounceTimer = null;

    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            validateGuardianContact();
        }, 700);
    });

    async function validateGuardianContact() {
        const guardianContact = input.value.trim();
        const countryCode = countrySelect.value;

        errorSpan.textContent = '';
        input.classList.remove('is-valid', 'is-invalid');
        errorSpan.classList.remove('text-success', 'text-danger');
        guardianContactValid = false;

        if (nextButton) nextButton.disabled = true;
        if (!guardianContact) return;

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
                let message = data.message;
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

    // Make it globally accessible
    window.validateGuardianContact = validateGuardianContact;
}

// Main initialization function
function initializeOnboardingCommon() {
    const navEntries = performance.getEntriesByType("navigation");
    const pageReloaded = navEntries.length > 0 && navEntries[0].type === "reload";

    if (!pageReloaded) {
        loadedApis = totalApis;
    }
    if (pageReloaded) {
        $(".btn-text").hide();
        $(".btn-loader").show();
        $("#final-submit-button").prop("disabled", true);
    }

    loadFormDataFromLocalStorage();
    setTimeout(() => {
        autoLoadCityAndLocation();
    }, 200);

    let startingStep = loadSavedStep();
    applyStepRequiredRules($(`#step-${startingStep}`));

    // Initialize Select2
    $('select[multiple]').select2({
        placeholder: "{{ __('profile.you_can_select_more_than_one') }}",
        allowClear: true
    });

    // Remove guardian contact for male users
    if (userGender === 'male') {
        $('input[name="guardian_contact"]').closest('.form-group').remove();
    }

    // Event listeners
    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        $(this).data('touched', true);
        validateField(this);
    });

    $('input, select, textarea').on('blur change', function () {
        $(this).data('touched', true);
        validateField(this);
        var currentStep = $(this).closest('.onboarding-step');
        updateNextButton(currentStep);
    });

    $('.next-step').prop('disabled', true);

    $('.next-step').click(function () {
        var currentStep = $(this).closest('.onboarding-step');
        if (validateStep(currentStep)) {
            var currentStepId = currentStep.attr('id');
            var currentIndex = parseInt(currentStepId.split('-')[1]);
            var nextStep = currentStep.next('.onboarding-step');

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

    $('.prev-step').click(function () {
        var currentStep = $(this).closest('.onboarding-step');
        var currentStepId = currentStep.attr('id');
        var currentIndex = parseInt(currentStepId.split('-')[1]);
        var prevStep = currentStep.prev('.onboarding-step');

        saveCurrentFormToLocalStorage();
        saveCurrentStep(currentIndex - 1);
        applyStepRequiredRules(prevStep);

        currentStep.hide();
        prevStep.show();
        updateStepIndicator(currentIndex - 1);

        prevStep.find('input, select, textarea').each(function () {
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
        $('html, body').animate({ scrollTop: 0 }, 'fast');
    });

    $('#disclaimerAgreement').on('change', function () {
        $(this).data('touched', true);
        validateField(this);

        if ($(this).is(':checked') && loadedApis >= totalApis) {
            $("#final-submit-button").prop("disabled", false);
        } else {
            $("#final-submit-button").prop("disabled", true);
        }
    });

    $('#onboarding-form').on('submit', function (e) {
        e.preventDefault();

        var currentStep = $('.onboarding-step:visible');

        if (!validateStep(currentStep)) {
            return false;
        }

        if (!$('#disclaimerAgreement').prop('checked')) {
            $('#disclaimerAgreement').addClass('is-invalid');
            $('#disclaimerAgreement')
                .closest('.form-check')
                .find('.error-message')
                .text("{{ __('onboarding.consent_required') }}");
            return false;
        }

        sessionStorage.removeItem("onboardingFormData");
        sessionStorage.removeItem("onboardingCurrentStep");

        this.submit();
    });

    function updateStepIndicator(currentIndex) {
        $('.step-indicator').each(function (index) {
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

    // Setup guardian contact validation if present
    if (document.getElementById('guardian_contact_input')) {
        setupGuardianContactValidation();
    }
}

// Mobile fixes
$(document).ready(function () {
    if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        $('textarea').on('touchstart', function () {
            $(this).focus();
        });
    }
});
