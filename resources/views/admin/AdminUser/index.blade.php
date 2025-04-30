@extends('admin.layout.app')

@section('title', 'Users')

@section('page-title', 'Users Dashboard - Users')

@section('subtitle', 'Users')


@section('content')

{{-- <link rel="stylesheet" href="{{ asset('dashboard/css/findAmatch.css') }}" /> --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Users List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users List</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a class="btn btn-primary mb-3" id="add_btn">Add User</a> --}}
                            <div class="table-responsive">
                                {{ $dataTable->table([
                                    'class' => 'table table-bordered table-hover  w-100',
                                    'style' => 'width:100% !important'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                                    </div>
                <div class="modal-body" id="modal-body"></div>
            </div>
        </div>
    </div>
    {{-- Match Profile Modal
    <div class="modal fade"
        id="profileModalRight"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
        data-backdrop="static"
        >

    <div class="modal-dialog modal-lg" role="document">
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
                                <strong>{{ __('userDashboard.likeMe.gender') }}:</strong> <span id="modalGender"></span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>{{ __('userDashboard.likeMe.age') }}:</strong> <span id="modalAge"></span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>{{ __('userDashboard.likeMe.nationality') }}:</strong> <span id="modalNationality"></span>
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

                <form method="POST" action="{{ route('user.like') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="liked_user_id" value="">
                    <button class="btn btn-sm btn-outline-primary" type="submit">
                        <i class="simple-icon-like"></i> {{ __('userDashboard.likeMe.like') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('user.dislike') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="disliked_user_id" value="">
                    <button class="btn btn-sm btn-outline-danger" type="submit">
                        <i class="simple-icon-dislike"></i> {{ __('userDashboard.likeMe.Fdislike') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@push('scripts')

<script>
    addModal('add_btn', '{{ route('manageUsers.create') }}', 'Add User ', 'userForm', 'users-table');
    editModal('edit_btn', 'admin/manageUsers', 'Edit User', 'userForm', 'users-table');
    remove('remove_btn', 'admin/manageUsers', 'users-table', '{{ csrf_token() }}');
    // function populateExtraDetails(details) {
    //     const container = $('#extraDetails');
    //     container.empty();

    //     Object.entries(details).forEach(([category, fields]) => {
    //         container.append(`<div class="col-md-12"><h6 class="text-primary mt-3">${category}</h6></div>`);
    //         Object.entries(fields).forEach(([label, value]) => {
    //             if (!value || value === 'N/A' || (Array.isArray(value) && !value.length)) return;
    //             if (Array.isArray(value)) {
    //                 const badges = [...new Set(value)].map(item =>
    //                     `<span class="badge badge-info mr-1 mb-1">${item}</span>`).join('');
    //                 container.append(
    //                     `<div class="col-md-6 mb-3"><strong>${label}:</strong><br>${badges}</div>`);
    //             } else {
    //                 container.append(
    //                     `<div class="col-md-6 mb-2"><strong>${label}:</strong> ${value}</div>`);
    //             }
    //         });
    //     });
    // }

    // function categorizeDetails(profile) {
    //     return {
    //         "{{ __('userDashboard.likeMe.personal') }}": {
    //             "{{ __('userDashboard.likeMe.date_of_birth') }}": profile.profile.date_of_birth,
    //             "{{ __('userDashboard.likeMe.religion') }}": profile.profile.religion,
    //             "{{ __('userDashboard.likeMe.marital_status') }}": profile.profile.marital_status,
    //             "{{ __('userDashboard.likeMe.children') }}": profile.profile.children ?? 'N/A',
    //             "{{ __('userDashboard.likeMe.skin_color') }}": profile.profile.skin_color,
    //             "{{ __('userDashboard.likeMe.hair_color') }}": profile.profile.hair_color,
    //         },
    //         "{{ __('userDashboard.likeMe.professional') }}": {
    //             "{{ __('userDashboard.likeMe.educational_level') }}": profile.profile.educational_level,
    //             "{{ __('userDashboard.likeMe.specialization') }}": profile.profile.specialization,
    //             "{{ __('userDashboard.likeMe.employment_status') }}": profile.profile.employment_status
    //                 ? "{{ __('userDashboard.likeMe.employed') }}"
    //                 : "{{ __('userDashboard.likeMe.unemployed') }}",
    //             "{{ __('userDashboard.likeMe.job_title') }}": profile.profile.job_title,
    //             "{{ __('userDashboard.likeMe.position_level') }}": profile.profile.position_level,
    //             "{{ __('userDashboard.likeMe.financial_status') }}": profile.profile.financial_status,
    //         }
    //     };
    // }

    // $(document).on('click', '.view-user-profile', function () {
    //     // const user = $(this).data('profile');
    //     const userId =$(this).data('profile');

    //     $.ajax({
    //         method: 'GET',
    //         url: `/admin/user-profile?user_id=${userId}`,
    //         success: function (response) {
    //             const user = response.data;
    //             const mainPhoto = user.profile?.photos?.find(photo => photo.is_main === 1)?.photo_url;

    //             $('#modalAvatar').attr('src', mainPhoto || '/dashboard/logos/profile-icon.jpg');
    //             $('#modalName').text(`${user.first_name} ${user.last_name}`);
    //             $('#modalBio').text(user.profile?.bio || 'No bio provided.');
    //             $('input[name="liked_user_id"]').val(userId);
    //             $('input[name="disliked_user_id"]').val(userId);
    //             $('#modalGender').text(user.gender || 'N/A');
    //             $('#modalAge').text(user.profile?.age || 'N/A');
    //             $('#modalNationality').text(user.profile?.nationality || 'N/A');
    //             $('#modalCity').text(user.profile?.city || 'N/A');

    //             const details = categorizeDetails(user);
    //             populateExtraDetails(details);
    //             $('#profileModalRight').modal('show');
    //         }
    //     });
    // });
</script>
{{ $dataTable->scripts() }}

@endpush

