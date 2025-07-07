@extends('user.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('dashboard/css/findAmatch.css') }}" />
    <div class="container-fluid disable-text-selection">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="match-dashboard-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-4">
                        <div>
                            <h1 class="mb-1">{{ __('userDashboard.likeMe.users_who_liked_you') }}</h1>
                            <p class="text-dark mb-0">{{ __('userDashboard.likeMe.Discover_who_liked_your_profile') }}</p>
                        </div>
                        <div class="match-stats d-flex mt-3 mt-md-0">
                            <div class="match-stat-item text-center mr-4">
                                <span class="match-stat-number">{{ count($profiles) }}</span>
                                <span class="match-stat-label">{{ __('userDashboard.likeMe.Total_Likes') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="col-12">
                <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                    <i class="simple-icon-info mr-2"></i> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="row list disable-text-selection" id="suggestedMatchResults">
            @if ($profiles->count() > 0)
                @foreach ($profiles as $profile)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="card profile-card shadow-sm h-100" data-profile='@json($profile)'>
                            <button type="button"
                                class="btn btn-outline-danger position-absolute d-flex align-items-center justify-content-center"
                                style="top: 10px; {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px; width: 40px; height: 40px; border-radius: 50%; padding: 0; z-index: 10;"
                                onclick="event.stopPropagation(); openReportModal({{ $profile['id'] }})">
                                <i class="fas fa-flag"></i>
                            </button>

                            <div class="position-relative">
                                <span class="badge badge-warning position-absolute m-2">Suggested</span>
                                <img class="card-img-top"
                                    src="{{ collect($profile['profile']['photos'])->firstWhere('is_main', 1)['photo_url'] ?? '/dashboard/logos/profile-icon.jpg' }}"
                                    alt="{{ $profile['profile']['nickname'] }} ">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1">{{ $profile['profile']['nickname'] }} </h5>
                                <p class="text-muted small mb-2">
                                    {{ $profile['profile']['country_of_residence'] ?? '' }}{{ isset($profile['profile']['city']) ? ', ' . $profile['profile']['city'] : ', Unknown' }}
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
            @else
                <div class="col-12">
                    <div class="  text-center">
                        {{ __('userDashboard.likeMe.no_likes_yet') }}
                    </div>
                </div>
            @endif
        </div>
    </div>


    <div class="modal fade {{ app()->getLocale() === 'ar' ? 'modal-left' : 'modal-right' }}" id="profileModalRight"
        tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="simple-icon-user mr-2"></i>{{ __('userDashboard.likeMe.profile_details') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="{{ __('userDashboard.likeMe.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="modalAvatar" class="img-fluid rounded-circle mb-3 shadow-lg" src="" alt="Avatar"
                            style="max-width: 250px; height: 250px; object-fit: cover;">
                        <h4 id="modalName" class="font-weight-bold text-primary mt-3"></h4>
                        <p id="modalBio" class="text-muted small"></p>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('userDashboard.likeMe.basic_information') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.gender') }}:</strong> <span
                                        id="modalGender"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.age') }}:</strong> <span id="modalAge"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.likeMe.nationality') }}:</strong> <span
                                        id="modalNationality"></span>
                                </div>
                                     <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.country_of_origin') }}:</strong> <span id="modalCountryOfOrigin"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.country_of_residence') }}:</strong> <span id="modalCountryOfResidence"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>{{ __('userDashboard.matches.city_of_Residence') }}:</strong> <span id="modalCity"></span>
                                </div>

                                 <div class="col-md-6 mb-2">
                                <strong>{{ __('userDashboard.matches.city_location') }}:</strong> <span id="city_location"></span>
                            </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('userDashboard.likeMe.additional_details') }}</h6>
                        </div>
                        <div class="card-body">
                            <div id="extraDetails" class="row"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button class="btn btn-outline-secondary mr-auto"
                        data-dismiss="modal">{{ __('userDashboard.likeMe.close') }}</button>
                    <form method="POST" action="{{ route('user.like') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="liked_user_id" value="">
                        <button class="btn btn-sm btn-outline-primary" type="submit">
                            <i class="simple-icon-like"></i> {{ __('userDashboard.likeMe.like_back') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('user.dislike') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="disliked_user_id" value="">
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            <i class="simple-icon-dislike"></i> {{ __('userDashboard.likeMe.dislike') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- report modal --}}
    <div class="modal fade modal-top" id="reportModalMain" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">
                        <i class="fas fa-flag"></i> {{ __('userDashboard.dashboard.report_user') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="{{ __('userDashboard.likeMe.close') }}">
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
                            <select id="reasonSelect" name="reason_en" class="form-control"
                                onchange="toggleOtherReason()" required>
                               <option value="Inappropriate Photos">
                                    {{ __('userDashboard.dashboard.inappropriate_photos') }}
                                </option>
                                <option value="Offensive Language">
                                    {{ __('userDashboard.dashboard.offensive_language') }}
                                </option>
                                <option value="Spam or Advertising">
                                    {{ __('userDashboard.dashboard.spam_or_advertising') }}
                                </option>
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
@include('user.partials.report-scripts')
    <script>
        $(document).ready(function() {
            function categorizeDetails(profile) {
                return {
                    "{{ __('userDashboard.likeMe.personal') }}": {
                        "{{ __('userDashboard.likeMe.date_of_birth') }}": profile.profile.date_of_birth,
                        "{{ __('userDashboard.likeMe.religion') }}": profile.profile.religion,
                        "{{ __('userDashboard.likeMe.religion_level') }}": profile.profile.religion_level ,
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
                        "{{ __('userDashboard.likeMe.Job_Domain') }}": profile.profile.job_title,
                        "{{ __('userDashboard.likeMe.position_level') }}": profile.profile.position_level,
                        "{{ __('userDashboard.likeMe.financial_status') }}": profile.profile.financial_status,
                    },
                    "{{ __('userDashboard.likeMe.lifestyle') }}": {
                        // "{{ __('userDashboard.likeMe.hijab_status') }}": profile.profile.hijab_status !== null ?
                        //     (profile.profile.hijab_status ? "{{ __('userDashboard.likeMe.yes') }}" :
                        //         "{{ __('userDashboard.likeMe.no') }}") : "{{ __('userDashboard.likeMe.na') }}",
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


            // Modal opening logic (existing)
            $('.profile-card').on('click', function(e) {
                if ($(e.target).closest('button, a').length) return;

                e.preventDefault();
                const profile = $(this).data('profile');
                const mainPhoto = profile.profile.photos.find(photo => photo.is_main === 1)?.photo_url;
                $('#modalAvatar').attr('src', mainPhoto);
                $('input[name="liked_user_id"]').val(profile.id);
                $('input[name="disliked_user_id"]').val(profile.id);
                $('#modalName').text(`${profile.profile.nickname} `);
                $('#modalBio').text(profile.profile.bio || 'No bio provided.');
                $('#modalGender').text(profile.gender || 'N/A');
                $('#modalAge').text(profile.profile.age || 'N/A');
                $('#modalNationality').text(profile.profile.nationality || 'N/A');
                $('#modalCity').text(profile.profile.city || 'N/A');
                                $('#city_location').text(profile.profile.city_location || 'N/A');
                                $('#modalCountryOfResidence').text(profile.profile.country_of_residence || 'N/A');
                $('#modalCountryOfOrigin ').text(profile.profile.origin || 'N/A');

                const details = categorizeDetails(profile);
                populateExtraDetails(details);
                $('#profileModalRight').modal('show');
            });

            // Mobile-specific modal drag-down-to-close logic
            if ($(window).width() <= 767) {
                let startY = 0,
                    currentY = 0,
                    isDragging = false;
                const threshold = 100; // drag threshold in pixels

                const modal = $('#profileModalRight');
                const modalDialog = modal.find('.modal-dialog');
                const modalHeader = modal.find('.modal-header');

                modalHeader.addClass('draggable');

                modalHeader.on('touchstart', function(e) {
                    startY = e.originalEvent.touches[0].clientY;
                    isDragging = true;
                });

                modalHeader.on('touchmove', function(e) {
                    if (!isDragging) return;
                    currentY = e.originalEvent.touches[0].clientY;
                    const translateY = Math.max(0, currentY - startY);
                    modalDialog.css('transform', `translateY(${translateY}px)`);
                });

                modalHeader.on('touchend', function() {
                    isDragging = false;
                    if ((currentY - startY) > threshold) {
                        modal.modal('hide');
                    } else {
                        modalDialog.css('transform', 'translateY(0)');
                    }
                });

                // Reset position after modal closes
                modal.on('hidden.bs.modal', function() {
                    modalDialog.css('transform', '');
                });
            }
        });
    </script>
@endpush
