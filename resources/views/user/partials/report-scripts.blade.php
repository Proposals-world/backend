<script>
    function openReportModal(userId) {
        // Set the hidden input inside the report modal
        document.getElementById('reportModal_user_id').value = userId;

        // Reset any previous success message or form fields
        document.getElementById('reportForm').reset();
        document.getElementById('report-success').classList.add('d-none');
        document.getElementById('otherReasonGroup').classList.add('d-none');

        // Show the report modal with correct options
        $('#reportModalMain').modal({
            backdrop: 'static', // ❌ no backdrop
            keyboard: false,
            focus: true
        });

        // Force modal styling if needed
        $('#reportModalMain .modal-dialog').addClass('modal-dialog-centered'); // Center it vertically
    }

    function toggleOtherReason() {
        const reasonSelect = document.getElementById('reasonSelect').value;
        const otherGroup = document.getElementById('otherReasonGroup');

        if (reasonSelect === 'Other') {
            otherGroup.classList.remove('d-none');
        } else {
            otherGroup.classList.add('d-none');
            document.getElementById('otherReasonInput').value = ''; // clear input
        }
    }

    function submitReport() {
        const form = document.getElementById('reportForm');

        const reportedId = document.getElementById('reportModal_user_id').value;
        const reasonEn = document.getElementById('reasonSelect').value;
        const otherReasonInput = document.getElementById('otherReasonInput');
        const lang = '{{ app()->getLocale() }}'; // Detect language

        // Prepare FormData
        const formData = new FormData();
        formData.append('reported_id', reportedId);
        formData.append('reason_' + lang, reasonEn); // Always keep "Other" if selected

        // If "Other" selected, also add custom reason in separate field
        if (reasonEn.toLowerCase() === 'other') {
            if (otherReasonInput && otherReasonInput.value.trim() !== '') {
                formData.append('other_reason_' + lang, otherReasonInput.value.trim());
            } else {
                alert('Please enter your custom reason.');
                return;
            }
        }

        // ✅ Debug FormData
        // console.log('FormData content:');
        for (let pair of formData.entries()) {
            // console.log(pair[0] + ': ' + pair[1]);
        }

        // Send Ajax
        $.ajax({
            url: '/user/report-user',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Accept-Language': lang,
            },
            success: function(response) {
                $('#report-success').removeClass('d-none').text(
                    `{{ __('userDashboard.dashboard.report_success') }}`);
                $('.profile-card').each(function() {
                    const card = $(this);
                    const profileData = card.data('profile');

                    // Support both direct user objects and wrapped match objects
                    let matchedUser = profileData?.matched_user ?? profileData;

                    if (matchedUser && (matchedUser.id == reportedId || matchedUser.user_id ==
                            reportedId)) {
                        // Handle both list and slider wrappers
                        card.closest('.col-12, .col-sm-6, .col-md-4, .card-container').fadeOut(300,
                            function() {
                                $(this).remove();
                            });
                    }
                });
                setTimeout(() => {
                    $('#reportModalMain').modal('hide');
                }, 500);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
          error: function (xhr) {
    const message =
    xhr.responseJSON?.error ||
        xhr.responseJSON?.message ||
        (xhr.responseText ? xhr.responseText : 'Something went wrong');

    alert(message);
}

        });
    }
</script>
