document.addEventListener("DOMContentLoaded", function() {
    const seekingRadios = document.querySelectorAll('input[name="seeking"]');
    const genderRadios = document.querySelectorAll('input[name="gender"]');

    function handleSelectionChange(source) {
        const selectedSeeking = document.querySelector('input[name="seeking"]:checked');
        const selectedGender = document.querySelector('input[name="gender"]:checked');

        if (source === "seeking" && selectedSeeking) {
            // Switch gender selection to the opposite
            genderRadios.forEach(radio => {
                if (radio.value !== selectedSeeking.value) {
                    radio.checked = true;
                }
            });
        } else if (source === "gender" && selectedGender) {
            // Switch seeking selection to the opposite
            seekingRadios.forEach(radio => {
                if (radio.value !== selectedGender.value) {
                    radio.checked = true;
                }
            });
        }
    }

    // Listen for changes in both radio groups
    seekingRadios.forEach(radio => {
        radio.addEventListener("change", function() {
            handleSelectionChange("seeking");
        });
    });

    genderRadios.forEach(radio => {
        radio.addEventListener("change", function() {
            handleSelectionChange("gender");
        });
    });
});