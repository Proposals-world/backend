@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard/css/findAmatch.css') }}" />
   {{-- {{  dd( $matchesWithoutContact); }} --}}
   {{-- {{  dd( $match['matched_user']['id']); }} --}}
<div class="container-fluid disable-text-selection">
    <div class="row ">
        <div class="col-12 mb-4">
            <div class="match-dashboard-header">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-4">
                    <div>
                        <h1 class="mb-1">{{ __('userDashboard.matches.users_who_matched_with_you') }}</h1>
                        <p class="text-dark mb-0">View mutual matches based on your preferences</p>
                    </div>
                    <div class="match-stats d-flex mt-3 mt-md-0">
                        <div class="match-stat-item text-center mr-4">
                            <span class="match-stat-number">{{ $matchesWithoutContact->count() }}</span>
                            <span class="match-stat-label">Pending Matches</span>
                        </div>
                        <div class="match-stat-item text-center">
                            <span class="match-stat-number">{{ $matchesWithContact->count() }}</span>
                            <span class="match-stat-label">Contact Exchanged</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section: Contact Not Exchanged --}}
    @if ($matchesWithoutContact->count())
        <div class="row px-4">
            <div class="col-12 section-header">
                <h5>{{ __('userDashboard.matches.contact_not_exchanged') }}</h5>
                <span class="badge">{{ $matchesWithoutContact->count() }}</span>
            </div>
        </div>

        <div class="row px-4 list disable-text-selection" id="suggestedMatchResults">
            @foreach ($matchesWithoutContact as $match)
                @php $profile = $match['matched_user']; @endphp
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="card profile-card shadow-sm h-100" data-profile='@json($match)'>
                        <button type="button"
                        class="btn btn-outline-danger position-absolute d-flex align-items-center justify-content-center"
                        style="top: 10px; {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px; width: 40px; height: 40px; border-radius: 50%; padding: 0; z-index: 10;"
                        onclick="event.stopPropagation(); openReportModal({{ $match['matched_user']['id'] }})">
                        <i class="fas fa-flag"></i>
                    </button>

                        <div class="position-relative">
                            <span class="badge badge-warning position-absolute m-2">Match</span>
                            <img class="card-img-top"
                                src="{{ collect($profile['profile']['photos'])->firstWhere('is_main', 1)['photo_url'] ?? asset('dashboard/logos/profile-icon.jpg') }}"
                                alt="Profile">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $profile['first_name'] }} {{ $profile['last_name'] }}</h5>
                            <p class="text-muted small mb-2">
                                {{ $profile['profile']['country_of_residence'] ?? '' }}{{ $profile['profile']['city'] ? ', ' . $profile['profile']['city'] : '' }}
                            </p>
                            <div class="profile-details mt-auto">
                                @if (!empty($profile['profile']['age']))
                                    <span class="badge badge-light mr-2">{{ $profile['profile']['age'] }} years</span>
                                @endif
                                @if (!empty($profile['profile']['religion']))
                                    <span class="badge badge-light">{{ $profile['profile']['religion'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Section: Contact Exchanged --}}
    @if ($matchesWithContact->count())
        <div class="row mt-5 px-4">
            <div class="col-12 section-header">
                <h5>{{ __('userDashboard.matches.contact_exchanged') }}</h5>
                <span class="badge badge-info">{{ $matchesWithContact->count() }}</span>
            </div>
        </div>

        <div class="row px-4 list disable-text-selection" id="exactMatchResults">
            @foreach ($matchesWithContact as $match)
                @php $profile = $match['matched_user']; @endphp
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="card profile-card shadow-sm h-100" data-profile='@json($match)'>
                        <button type="button"
                        class="btn btn-outline-danger position-absolute d-flex align-items-center justify-content-center"
                        style="top: 10px; {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px; width: 40px; height: 40px; border-radius: 50%; padding: 0; z-index: 10;"
                        onclick="event.stopPropagation(); openReportModal({{ $match['matched_user']['id'] }})">
                        <i class="fas fa-flag"></i>
                    </button>

                        <div class="position-relative">

                            <span class="badge badge-success position-absolute m-2">Contacted</span>
                            <img class="card-img-top"
                                src="{{ collect($profile['profile']['photos'])->firstWhere('is_main', 1)['photo_url'] ?? asset('dashboard/logos/profile-icon.jpg') }}"
                                alt="Profile">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $profile['first_name'] }} {{ $profile['last_name'] }}</h5>
                            <p class="text-muted small mb-2">
                                {{ $profile['profile']['country_of_residence'] ?? '' }}{{ $profile['profile']['city'] ? ', ' . $profile['profile']['city'] : '' }}
                            </p>
                            <div class="profile-details mt-auto">
                                @if (!empty($profile['profile']['age']))
                                    <span class="badge badge-light mr-2">{{ $profile['profile']['age'] }} years</span>
                                @endif
                                @if (!empty($profile['profile']['religion']))
                                    <span class="badge badge-light">{{ $profile['profile']['religion'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($matchesWithoutContact->isEmpty() && $matchesWithContact->isEmpty())
        <div class="row mt-4 px-4">
            <div class="col-12 text-center text-muted">
                <i class="simple-icon-user font-large d-block mb-3"></i>
                <h5>{{ __('userDashboard.matches.no_matches') }}</h5>
            </div>
        </div>
    @endif
</div>


    {{-- Profile Modal --}}
    <div class="modal fade {{ app()->getLocale() === 'ar' ? 'modal-left' : 'modal-right' }}" id="profileModalRight"
        tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="simple-icon-user mr-2"></i>{{ __('userDashboard.matches.profile_details') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="{{ __('userDashboard.matches.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Content loaded via JS --}}
                    <div class="text-center mb-4">
                        <img id="modalAvatar" class="img-fluid rounded-circle mb-3 shadow-lg" src="" alt="Avatar"
                            style="max-width: 250px; height: 250px; object-fit: cover;">
                        <h4 id="modalName" class="font-weight-bold text-primary mt-3"></h4>
                        <p id="modalBio" class="text-muted small"></p>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('userDashboard.matches.basic_information') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.gender') }}:</strong> <span
                                        id="modalGender"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.age') }}:</strong> <span id="modalAge"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.nationality') }}:</strong> <span
                                        id="modalNationality"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.city') }}:</strong> <span id="modalCity"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Inline Success Alert (hidden by default) -->
                    <div id="reveal-success-alert" class="alert alert-success alert-dismissible fade shadow-sm d-none" role="alert">
                        <i class="simple-icon-info mr-2"></i>
                        <span id="preference-success-message">{{ __('userDashboard.dashboard.Contact info revealed successfully') }}.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="card mt-4 mb-3">
                        <div class="card-header d-flex justify-content-between pt-2 align-items-center bg-primary"
                            style="color: #fff; ">
                            <h6 class="mb-0">{{ __('userDashboard.matches.contact_info') }}</h6>
                            {{-- fix the user pass id  --}}
                            {{-- {{ dd( $match['matched_user']['id']) }} --}}
                            <button id="revealContactBtn" onclick="revealContact('{{ $match['matched_user']['id'] }}')"
                            class="btn btn-sm btn-outline-primary d-none" style="background-color: #fff;">
                            <i class="simple-icon-eye"></i> {{ __('userDashboard.matches.reveal_info') }}
                        </button>





                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.phone_number') }}:</strong>
                                    <span id="guardianPhone"></span>
                                    <span id="modalPhone"></span>
                                </div>
                                {{-- <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.email') }}:</strong>
                                    <span id="modalEmail"></span>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header bg-light  pt-2">
                            <h6 class="mb-0">{{ __('userDashboard.matches.additional_details') }}</h6>
                        </div>
                        <div class="card-body">
                            <div id="extraDetails" class="row"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button class="btn btn-outline-secondary mr-auto"
                        data-dismiss="modal">{{ __('userDashboard.matches.close') }}</button>
                   <!-- Remove old inline onclick and give it an ID -->
<button id="removeMatchBtn" class="btn btn-outline-danger mr-2">
    <i class="simple-icon-dislike mr-2"></i>{{ __('userDashboard.matches.remove') }}
</button>
                </div>
            </div>
        </div>
    </div>
    {{-- report modal --}}
    <div class="modal fade modal-top"
    id="reportModalMain" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title">
                    <i class="fas fa-flag"></i> {{ __('userDashboard.dashboard.report_user') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('userDashboard.likeMe.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="reportForm">
                    @csrf
                    <div id="report-success" class="alert alert-success mt-3 d-none">
                        {{ __('userDashboard.dashboard.report_success') }}
                    </div>
                    <input type="hidden" id="reportModal_user_id" name="reported_id" value="">

                    <div class="form-group">
                        <label for="reasonSelect">{{ __('userDashboard.dashboard.reason') }}</label>
                        <select id="reasonSelect" name="reason_en" class="form-control"onchange="toggleOtherReason()" required>
                            <option value="Inappropriate Photos">{{ __('userDashboard.dashboard.inappropriate_photos') }}</option>
                            <option value="Harassment">{{ __('userDashboard.dashboard.harassment') }}</option>
                            <option value="Disrespectful Behavior">{{ __('userDashboard.dashboard.disrespectful_behavior') }}</option>
                            <option value="Asking for Haram (Forbidden)">{{ __('userDashboard.dashboard.asking_for_haram') }}</option>
                            <option value="Fake Profile">{{ __('userDashboard.dashboard.fake_profile') }}</option>
                            <option value="Spam or Advertising">{{ __('userDashboard.dashboard.spam_or_advertising') }}</option>
                            <option value="Offensive Language">{{ __('userDashboard.dashboard.offensive_language') }}</option>
                            <option value="Not Serious About Marriage">{{ __('userDashboard.dashboard.not_serious') }}</option>
                            <option value="Misleading Information">{{ __('userDashboard.dashboard.misleading_information') }}</option>
                            <option value="Other">{{ __('userDashboard.dashboard.other') }}</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="otherReasonGroup">
                        <label>{{ app()->getLocale() === 'ar' ? __('userDashboard.dashboard.other_reason_ar') : __('userDashboard.dashboard.other_reason_en') }}</label>
                        <textarea name="other_reason_{{ app()->getLocale() }}" id="otherReasonInput" class="form-control" rows="2"></textarea>
                    </div>


                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-primary feedback-btn" onclick="submitReport()">
                    {{ __('userDashboard.dashboard.submit') }}
                </button>

                <button type="button" class="btn btn-outline-danger feedback-btn" data-dismiss="modal">
                    {{ __('userDashboard.dashboard.cancel') }}
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
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
    console.log('FormData content:');
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
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
            $('#report-success').removeClass('d-none').text(`{{ __('userDashboard.dashboard.report_success') }}`);
            setTimeout(() => {
                $('#reportModalMain').modal('hide');
            }, 1500);
        },
        error: function(xhr) {
            console.error('Error submitting report:', xhr.responseText);
            alert('Something went wrong, please try again.');
        }
    });
}function toggleOtherReason() {
    const reasonSelect = document.getElementById('reasonSelect').value;
    const otherGroup = document.getElementById('otherReasonGroup');

    if (reasonSelect === 'Other') {
        otherGroup.classList.remove('d-none');
    } else {
        otherGroup.classList.add('d-none');
        document.getElementById('otherReasonInput').value = ''; // clear input
    }
}

        $(document).ready(function() {
           // Initialize the modal
            function categorizeDetails(profile) {
                return {
                    "{{ __('userDashboard.likeMe.personal') }}": {
                        "{{ __('userDashboard.likeMe.date_of_birth') }}": profile.profile.date_of_birth,
                        "{{ __('userDashboard.likeMe.religion') }}": profile.profile.religion,
                        "{{ __('userDashboard.likeMe.marital_status') }}": profile.profile.marital_status,
                        "{{ __('userDashboard.likeMe.children') }}": profile.profile.children ??
                            "{{ __('userDashboard.likeMe.na') }}",
                        "{{ __('userDashboard.likeMe.skin_color') }}": profile.profile.skin_color,
                        "{{ __('userDashboard.likeMe.hair_color') }}": profile.profile.hair_color,
                    },
                    "{{ __('userDashboard.likeMe.professional') }}": {
                        "{{ __('userDashboard.likeMe.educational_level') }}": profile.profile.educational_level,
                        "{{ __('userDashboard.likeMe.specialization') }}": profile.profile.specialization,
                        "{{ __('userDashboard.likeMe.employment_status') }}": profile.profile.employment_status ?
                            "{{ __('userDashboard.likeMe.employed') }}" :
                            "{{ __('userDashboard.likeMe.unemployed') }}",
                        "{{ __('userDashboard.likeMe.job_title') }}": profile.profile.job_title,
                        "{{ __('userDashboard.likeMe.position_level') }}": profile.profile.position_level,
                        "{{ __('userDashboard.likeMe.financial_status') }}": profile.profile.financial_status,
                    },
                    "{{ __('userDashboard.likeMe.lifestyle') }}": {
                        "{{ __('userDashboard.likeMe.hijab_status') }}": profile.profile.hijab_status !== null ?
                            (profile.profile.hijab_status ? "{{ __('userDashboard.likeMe.yes') }}" :
                                "{{ __('userDashboard.likeMe.no') }}") : "{{ __('userDashboard.likeMe.na') }}",
                        "{{ __('userDashboard.likeMe.smoking_status') }}": profile.profile.smoking_status !==
                            null ?
                            (profile.profile.smoking_status ? "{{ __('userDashboard.likeMe.yes') }}" :
                                "{{ __('userDashboard.likeMe.no') }}") : "{{ __('userDashboard.likeMe.na') }}",
                        "{{ __('userDashboard.likeMe.drinking_status') }}": profile.profile.drinking_status,
                    },
                    "{{ __('userDashboard.likeMe.physical') }}": {
                        "{{ __('userDashboard.likeMe.height') }}": profile.profile.height,
                        "{{ __('userDashboard.likeMe.weight') }}": profile.profile.weight,
                        "{{ __('userDashboard.likeMe.sports_activity') }}": profile.profile.sports_activity,
                    },
                    "{{ __('userDashboard.likeMe.social') }}": {
                        "{{ __('userDashboard.likeMe.social_media_presence') }}": profile.profile
                            .social_media_presence,
                    },
                    "{{ __('userDashboard.likeMe.interests') }}": {
                        "{{ __('userDashboard.likeMe.smoking_tools') }}": profile.profile.smoking_tools,
                        "{{ __('userDashboard.likeMe.hobbies') }}": profile.profile.hobbies,
                        "{{ __('userDashboard.likeMe.pets') }}": profile.profile.pets,
                    }
                };
            }

            function populateExtraDetails(details) {
                const container = $('#extraDetails');
                container.empty();

                Object.entries(details).forEach(([category, fields]) => {
                    let categoryHtml =
                        `<div class="col-md-12"><h6 class="text-primary mt-3">${category}</h6></div>`;
                    container.append(categoryHtml);

                    Object.entries(fields).forEach(([label, value]) => {
                        if (!value || value === 'N/A' || (Array.isArray(value) && !value.length))
                            return;

                        if (Array.isArray(value)) {
                            const badges = [...new Set(value)].map(item =>
                                `<span class="badge badge-info mr-1 mb-1">${item}</span>`).join(
                                '');
                            container.append(`
                            <div class="col-md-6 mb-3">
                                <strong>${label}:</strong><br>${badges}
                            </div>
                        `);
                        } else {
                            container.append(`
                            <div class="col-md-6 mb-2">
                                <strong>${label}:</strong> ${value}
                            </div>
                        `);
                        }
                    });
                });
            }

             // ✅ Global so it's accessible
    function removeMatchFromModal(matchId) {
        // console.log("Removing match with ID:", matchId);
        if (!confirm("{{ __('userDashboard.matches.confirm_remove') }}")) return;

        fetch("{{ route('api.remove.match') }}", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept-Language": "{{ app()->getLocale() }}",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ match_id: matchId })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            $('#profileModalRight').modal('hide');
            location.reload();
        })
        .catch(err => {
            // console.error(err);
            alert("Error happen while removing the match.");
        });
    }
    function revealContact(matchedUserId) {
    if (!confirm(`{{ __('userDashboard.dashboard.Are you sure you want to reveal this user contact information? This action cannot be undone') }}.`)) {
        return; // User cancelled the confirmation
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // console.log("Revealing contact for user ID:", matchedUserId);

    fetch(`{{ route('reveal.contact') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept-Language': '{{ app()->getLocale() }}',
        },
        body: JSON.stringify({
            matched_user_id: matchedUserId
        })
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(({ status, body }) => {
        const $alert = $('#reveal-success-alert');
        const $message = $('#preference-success-message');

        if (status !== 200 || body.error) {
            const $alert = $('#reveal-success-alert');
    const $message = $('#preference-success-message');

    let errorMessage = body.error || 'An unknown error occurred.';

    // 👇 Add pricing link for subscription error
    if (errorMessage.includes('subscribed')) {
        errorMessage += ` <a href="{{ route('user.pricing') }}" style="text-decoration: underline;" class="fw-bold text-danger">{{ __('userDashboard.dashboard.Subscription_Now') }}</a>`;
    }

    $alert
        .removeClass('d-none alert-success')
        .addClass('show alert-danger');
    $message.html(errorMessage); // Use .html() to render link properly
        } else {
            // ✅ Show success alert
            $('#guardianPhone').text(body.guardian_contact || 'N/A');
            $alert
                .removeClass('d-none alert-danger')
                .addClass('show alert-success');
            $message.text(`{{ __('userDashboard.dashboard.Contact info revealed successfully') }}.`);
            $('#revealContactBtn').addClass('d-none');

            setTimeout(() => {
                $alert.removeClass('show').addClass('d-none');
            }, 10000);

            setTimeout(() => {
                location.reload();
            }, 20000);
        }
    })
    .catch(error => {
        // console.error('Error:', error);
        const $alert = $('#reveal-success-alert');
        const $message = $('#preference-success-message');

        $alert
            .removeClass('d-none alert-success')
            .addClass('show alert-danger');
        $message.text('Network error. Please try again later.');

        setTimeout(() => {
            $alert.removeClass('show').addClass('d-none');
        }, 10000);
    });
}




    // ✅ Inside document.ready
    $(document).ready(function () {
        $('.profile-card').on('click', function (e) {
            if ($(e.target).closest('button, a').length) return;

        e.preventDefault();
        const match = $(this).data('profile');
        const profile = match.matched_user;

        // Correct matched user ID
        const matchedUserId = profile.id;
        $('#revealContactBtn').data('matchedUserId', matchedUserId);
        $('#removeMatchBtn').data('matchId', match.match_id);

        // Populate modal
        const mainPhoto = profile.profile.photos.find(photo => photo.is_main === 1)?.photo_url || '{{ asset("dashboard/logos/profile-icon.jpg") }}';
        $('#modalAvatar').attr('src', mainPhoto);
        $('#modalName').text(`${profile.first_name} ${profile.last_name}`);
        $('#modalBio').text(profile.profile.bio || 'No bio provided.');
        $('#modalGender').text(profile.gender || 'N/A');
        $('#modalAge').text(profile.profile.age || 'N/A');
        $('#modalNationality').text(profile.profile.nationality || 'N/A');
        $('#modalCity').text(profile.profile.city || 'N/A');
        // $('#modalPhone').text(profile.phone_number || 'N/A');
        $('#guardianPhone').text(profile.profile.guardian_contact || 'N/A');
        // console.log(match)
        if (!match.contact_exchanged) {
    $('#revealContactBtn').removeClass('d-none');
    $('#removeMatchBtn').removeClass('d-none');
} else {
    $('#revealContactBtn').addClass('d-none');
    $('#removeMatchBtn').addClass('d-none');
}




        const details = categorizeDetails(profile);
        populateExtraDetails(details);

        $('#profileModalRight').modal('show');
    });

    // ✅ Reveal Contact Button Click Handler
    $('#revealContactBtn').off('click').on('click', function () {
        const matchedUserId = $(this).data('matchedUserId');
        revealContact(matchedUserId);
    });

    // ✅ Remove Match Button Handler (no changes)
    $('#removeMatchBtn').on('click', function () {
        const matchId = $(this).data('matchId');
        removeMatchFromModal(matchId);
    });
    });

        });
    </script>
@endpush
