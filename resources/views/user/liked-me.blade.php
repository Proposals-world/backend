@extends('user.layouts.app')

@section('content')
    <style>
        .profile-card {
            width: 100%;
            max-width: 100%;
            height: auto;
            min-height: 500px;
            overflow: hidden;
            cursor: pointer;
        }

        .profile-card img.card-img-top {
            height: 413px;
            object-fit: cover;
            width: 100%;
        }

        .profile-card .card-body {
            padding: 1.5rem;
        }

        .row.list>div.col-12 {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* @media (min-width: 1400px) {
                .profile-card {
                    max-width: 40%;
                    margin-left: 0;
                }
            } */
        @media (min-width: 1400px) {
            .profile-card {
                max-width: 50%;
                margin: 0 auto;
            }
        }

        @media (max-width: 767px) {
            .modal.modal-left .modal-dialog {
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                right: 0 !important;
                margin: 0 !important;
                transform: translateY(100%) !important;
                transition: transform 0.3s ease-out !important;
                max-height: 75vh !important;
                max-width: 100% !important;
            }

            .modal.modal-left.show .modal-dialog {
                transform: translateY(0) !important;
            }

            .modal.modal-left .modal-content {
                border-radius: 15px 15px 0 0 !important;
                height: 100%;
                overflow-y: auto;
                padding-top: 60px;
            }

            .modal.modal-left .modal-header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 200;
                cursor: grab;
            }

            .modal.modal-left .modal-body {
                padding-top: 50px;
            }

            .modal.modal-right .modal-dialog {
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                right: 0 !important;
                margin: 0 !important;
                transform: translateY(100%) !important;
                transition: transform 0.3s ease-out !important;
                max-height: 75vh !important;
                max-width: 100% !important;
            }

            .modal.modal-right.show .modal-dialog {
                transform: translateY(0) !important;
            }

            .modal.modal-right .modal-content {
                border-radius: 15px 15px 0 0 !important;
                height: 100%;
                overflow-y: auto;
                padding-top: 60px;
            }

            .modal.modal-right .modal-header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 200;
                cursor: grab;
            }

            .modal.modal-right .modal-body {
                padding-top: 50px;
            }
        }
    </style>

    <div class="container-fluid disable-text-selection">
        <div class="row">
            <div class="col-12 mb-5">
                <h1>{{ __('userDashboard.likeMe.users_who_liked_you') }}</h1>
                {{-- <div class="separator mb-5"></div> --}}
            </div>
        </div>

        <div class="row list disable-text-selection">
            @foreach ($profiles as $profile)
                <div class="col-12 mb-4">
                    <div class="card profile-card shadow-sm" data-profile='@json($profile)'>
                        <div class="position-relative">
                            <a href="#">
                                <img class="card-img-top"
                                    src="{{ collect($profile['profile']['photos'])->firstWhere('is_main', 1)['photo_url'] }}"
                                    alt="{{ __('userDashboard.likeMe.profile_image') }}">
                            </a>
                            {{-- <span class="badge badge-pill badge-theme-1 position-absolute badge-top-left">
                                {{ __('userDashboard.likeMe.new') }}
                            </span> --}}
                        </div>
                        <div class="card-body">
                            <a href="#" class="profile-link">
                                <p class="list-item-heading mb-1 font-weight-bold">
                                    {{ $profile['first_name'] }} {{ $profile['last_name'] }}
                                </p>
                            </a>
                            <footer>
                                <p class="text-muted text-small mb-0">
                                    {{ $profile['profile']['country_of_residence'] . ', ' . ($profile['profile']['city'] ?? __('userDashboard.likeMe.unknown_location')) }}
                                </p>
                            </footer>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                    <strong>{{ __('userDashboard.likeMe.city') }}:</strong> <span id="modalCity"></span>
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
                    <button class="btn btn-outline-danger mr-2">
                        <i class="simple-icon-dislike mr-2"></i>{{ __('userDashboard.likeMe.dislike') }}
                    </button>
                    <button class="btn btn-primary">
                        <i class="simple-icon-like mr-2"></i>{{ __('userDashboard.likeMe.like_back') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
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


            // Modal opening logic (existing)
            $('.profile-card').on('click', function(e) {
                e.preventDefault();
                const profile = $(this).data('profile');
                const mainPhoto = profile.profile.photos.find(photo => photo.is_main === 1)?.photo_url;
                $('#modalAvatar').attr('src', mainPhoto);
                $('#modalName').text(`${profile.first_name} ${profile.last_name}`);
                $('#modalBio').text(profile.profile.bio || 'No bio provided.');
                $('#modalGender').text(profile.gender || 'N/A');
                $('#modalAge').text(profile.profile.age || 'N/A');
                $('#modalNationality').text(profile.profile.nationality || 'N/A');
                $('#modalCity').text(profile.profile.city || 'N/A');
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
