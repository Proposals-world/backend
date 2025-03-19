$(document).ready(function() {
    // Function to update step indicators:
    function updateStepIndicator(currentIndex) {
        $('.step-indicator').each(function(index) {
            if (index < currentIndex) {
                // Previous steps get background #FF3494
                $(this).find('.step-number').css('background-color', '#FF3494');
                $(this).removeClass('active');
            } else if (index === currentIndex) {
                // Current step gets background #7D4196
                $(this).find('.step-number').css('background-color', '#7D4196');
                $(this).find('.step-number').css('opacity', '1');
                $(this).addClass('active');
            } else {
                // Future steps revert to default
                $(this).find('.step-number').css('background-color', '#f1f1f1');
            }
        });
    }

    // Initialize indicator on page load
    updateStepIndicator(0);

    // Password confirmation validation
    $('input[name="password_confirmation"]').on('input', function() {
        let password = $('input[name="password"]').val();
        let confirmPassword = $(this).val();
        if (password !== confirmPassword) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // Step navigation - Next
    $('.next-step').click(function() {
        let currentStep = $(this).closest('.onboarding-step');
        let currentStepId = currentStep.attr('id'); // e.g. "step-0"
        let currentIndex = parseInt(currentStepId.split('-')[1]);
        let nextStep = currentStep.next('.onboarding-step');

        // Basic form validation before moving to next step
        let isValid = true;
        currentStep.find('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            currentStep.hide();
            nextStep.show();
            updateStepIndicator(currentIndex + 1);
        }
    });

    // Step navigation - Previous
    $('.prev-step').click(function() {
        let currentStep = $(this).closest('.onboarding-step');
        let currentStepId = currentStep.attr('id');
        let currentIndex = parseInt(currentStepId.split('-')[1]);
        let prevStep = currentStep.prev('.onboarding-step');
        currentStep.hide();
        prevStep.show();
        updateStepIndicator(currentIndex - 1);
    });
});