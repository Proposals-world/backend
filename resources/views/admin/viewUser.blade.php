@extends('admin.layout.app')

@section('title', isset($blog) ? 'Edit Blog' : 'Create Blog')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Profile</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Jidox</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}" alt="user-image" height="42"
                            alt="profile-image">

                            <h4 class="mb-1 mt-2">{{ $user->first_name }}</h4>
                            <p class="text-muted">
                                @if($user->profile->id_verification_status === 'verified')
                                    <i class="ri-checkbox-circle-line text-success"></i>
                                @else
                                    <i class="ri-close-circle-line text-danger"></i>
                                @endif
                                {{ $user->profile->id_verification_status }}
                            </p>

                            <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                            <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>

                            <div class="text-start mt-3">
                                <h4 class="fs-13 text-uppercase">About Me :</h4>
                                <p class="text-muted mb-3">
                                    {{ $user->profile->bio_en }}
                                </p>
                                <p class="text-muted mb-2"><strong>Full Name :</strong> <span class="ms-2">{{ $user->first_name }}  {{ $user->last_name }}</span></p>

                                <p class="text-muted mb-2"><strong>Mobile :</strong><span class="ms-2">(962)
                                        {{ $user->phone_number }}</span></p>

                                <p class="text-muted mb-2"><strong>Email :</strong> <span class="ms-2 ">{{ $user->email }}</span></p>

                                <p class="text-muted mb-1"><strong>Gender :</strong> <span class="ms-2">{{$user->gender }}</span></p>
                                <p class="text-muted mb-1"><strong>Nationality :</strong> <span class="ms-2">{{ $user->profile->nationality->name_en  }}</span></p>
                            </div>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="ri-facebook-circle-fill"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="ri-google-fill"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="ri-twitter-fill"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="ri-github-fill"></i></a>
                                </li>
                            </ul>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->

                    <!-- Messages-->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title">Messages</h4>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                            </div>

                            <div class="inbox-widget">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Tomaslau</p>
                                    <p class="inbox-item-text">I've finished it! See you so...</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-link text-info fs-13"> Reply </a>
                                    </p>
                                </div>
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Stillnotdavid</p>
                                    <p class="inbox-item-text">This theme is awesome!</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-link text-info fs-13"> Reply </a>
                                    </p>
                                </div>
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Kurafire</p>
                                    <p class="inbox-item-text">Nice to meet you</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-link text-info fs-13"> Reply </a>
                                    </p>
                                </div>

                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Shahedk</p>
                                    <p class="inbox-item-text">Hey! there I'm available...</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-link text-info fs-13"> Reply </a>
                                    </p>
                                </div>
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-6.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Adhamdannaway</p>
                                    <p class="inbox-item-text">This theme is awesome!</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-link text-info fs-13"> Reply </a>
                                    </p>
                                </div>
                            </div> <!-- end inbox-widget -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->

                </div> <!-- end col-->

                <div class="col-xl-8 col-lg-7">

                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                <li class="nav-item">
                                    <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-start rounded-0 active">
                                        Customer Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#matches" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                        Matches
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-end rounded-0">
                                        Settings
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="aboutme">


                                 <div class="tab-pane" id="settings">
    <form>
        <!-- Personal Information -->
        <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i> Personal Info</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Profile Picture</label>
                    <div>
                        <img src="{{ asset($user->profile->avatar_url) }}" class="img-thumbnail" alt="User Avatar" height="100px" width="200px">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <p>{{ $user->first_name }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <p>{{ $user->last_name }}</p>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">ID Number</label>
                    <p>{{ $user->profile->id_number }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Verification Status</label>
                    <p>
                        @if($user->profile->id_verification_status === 'verified')
                            <i class="ri-checkbox-circle-line text-success"></i>
                        @else
                            <i class="ri-close-circle-line text-danger"></i>
                        @endif
                        {{ $user->profile->id_verification_status }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nationality</label>
                        <p>{{ $user->profile->nationality->name_en ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <p>{{ $user->profile->age ?? 'None' }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Zodiac Sign</label>
                        <p>{{ $user->profile->zodiacSign->name_en ??'None' }}</p>

                    </div>
        </div>
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-global-line me-1"></i> Location Info</h5>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nationality</label>
            <p>{{ $user->profile->nationality->name_en ?? 'None' }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Origin</label>
            <p>{{ $user->profile->origin->name_en ?? 'None' }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Country of Residence</label>
            <p>{{ $user->profile->countryOfResidence->name_en ?? 'None' }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">City</label>
            <p>{{ $user->profile->city->name_en ?? 'None' }}</p>
        </div>
    </div>
</div>

         <!-- Employment & Financial -->
         <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-briefcase-line me-1"></i> Employment & Financial Info</h5>
         <div class="row">
             <div class="col-md-6">
                 <div class="mb-3">
                     <label class="form-label">Sector</label>
                     <p>{{ $user->profile->sector->name_en ??'None' }}</p>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="mb-3">
                     <label class="form-label">Position Level</label>
                     <p>{{ $user->profile->positionLevel->name_en??'None'  }}</p>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-6">
                 <div class="mb-3">
                     <label class="form-label">Job Title</label>
                     <p>{{ $user->profile->jobTitle->name_en ?? 'None' }}</p>
                 </div>
             </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Financial Status</label>
                    <p>{{ $user->profile->financialStatus->name_en ??'None' }}</p>
                </div>
            </div>
        </div>
        <!-- Criminal Record Information -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-file-user-line me-1"></i> Criminal Record</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Criminal Record</label>
                    @if($user->profile->criminal_record_url)
                        <a href="{{ asset($user->profile->criminal_record_url) }}" target="_blank">View Record</a>
                    @else
                        <p>Not Available</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Record Status</label>
                    <p>{{ $user->profile->criminal_record_status??'None'  }}</p>
                </div>
            </div>
        </div>

        <!-- Employment & Education -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-graduation-cap-line me-1"></i> Employment & Education</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Educational Level</label>
                    <p>{{ $user->profile->educationalLevel->name_en ??'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Specialization</label>
                    <p>{{ $user->profile->specialization->name_en ??'None' }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Employment Status</label>
                    <p>{{ $user->profile->employment_status ? 'Employed' : 'Unemployed' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Position Level</label>
                    <p>{{ $user->profile->positionLevel->name_en??'None'  }}</p>
                </div>
            </div>
        </div>

        <!-- Lifestyle & Habits -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-leaf-line me-1"></i> Lifestyle & Habits</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Car Ownership</label>
                    <p>{{ $user->profile->car_ownership ? 'Yes' : 'No' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Smoking Status</label>
                    <p>{{ $user->profile->smokingStatus == 1 ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Drinking Status</label>
                    <p>{{ $user->profile->drinkingStatus->name_en ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Sports Activity</label>
                    <p>{{ $user->profile->sportsActivity->name_en ?? 'None' }}</p>
                </div>
            </div>
        </div>
 <!-- Housing Information -->
 <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-home-3-line me-1"></i> Housing</h5>
 <div class="row">
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Housing Status</label>
             <p>{{ $user->profile->housingStatus->name_en ??'None' }}</p>
         </div>
     </div>
 </div>
 <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-group-line me-1"></i> Marital Status</h5>
 <div class="row">
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Marital Status</label>
             <p>{{ $user->profile->maritalStatus->name_en ?? 'None' }}</p>
         </div>
     </div>
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Children</label>
             <p>{{ $user->profile->children ?? 'None' }}</p>
         </div>
     </div>
 </div>
 <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-book-3-line me-1"></i> Religion & Hijab</h5>
 <div class="row">
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Religion</label>
             <p>{{ $user->profile->religion->name_en ?? 'None' }}</p>
         </div>
     </div>
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Hijab Status</label>
             <p>{{ isset($user->profile->hijab_status) ? ($user->profile->hijab_status == 1 ? 'Yes' : 'No') : 'None' }}</p>
         </div>
     </div>
 </div>
 <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-global-line me-1"></i> Social Media</h5>
 <div class="row">
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Social Media Presence</label>
             <p>{{ $user->profile->socialMediaPresence->name_en ?? 'None' }}</p>
         </div>
     </div>
 </div>

 <!-- Sleep Habit -->
 <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-moon-line me-1"></i> Sleep Habit</h5>
 <div class="row">
     <div class="col-md-6">
         <div class="mb-3">
             <label class="form-label">Sleep Habit</label>
             <p>{{ $user->profile->sleepHabit->name_en??'None'  }}</p>
         </div>
     </div>
 </div>

        <!-- Appearance -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-palette-line me-1"></i> Physical Appearance</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Skin Color</label>
                    <p>{{ $user->profile->skinColor->name_en ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Hair Color</label>
                    <p>{{ $user->profile->hairColor->name_en ?? 'None' }}</p>
                </div>
            </div>
        </div>

        <!-- Religion & Marriage -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-book-3-line me-1"></i> Religion & Marriage</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Religiosity Level</label>
                    <p>{{ $user->profile->religiosityLevel->name_en ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Marriage Budget</label>
                    <p>{{ $user->profile->marriageBudget->budget_en ?? 'None' }}</p>
                </div>
            </div>
        </div>

        <!-- Sleep & Health -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-heart-pulse-line me-1"></i> Health & Sleep</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Health Issues (English)</label>
                    <p>{{ $user->profile->health_issues_en ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Health Issues (Arabic)</label>
                    <p>{{ $user->profile->health_issues_ar ?? 'None' }}</p>
                </div>
            </div>
        </div>

        <!-- Guardian Contact -->
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-user-line me-1"></i> Guardian Contact</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Guardian Contact (Encrypted)</label>
                    <p>{{ $user->profile->guardian_contact_encrypted ?? 'None' }}</p>
                </div>
            </div>
        </div>


    </form>
</div>
{{-- matches of the user  --}}
<div class="tab-pane " id="matches">
    <p>Matches content goes here...</p>
</div>


                                </div>
                                <!-- end settings content-->

                            </div> <!-- end tab-content -->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div>
        <!-- container -->
    </div>

@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/assets/vendor/select2/js/select2.min.js') }}"></script>
    <link href="{{ asset('admin/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" />

    <!-- Quill Editor -->
    <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quillEn = new Quill('#editor-en', {
                theme: 'snow'
            });

            var quillAr = new Quill('#editor-ar', {
                theme: 'snow'
            });

            document.getElementById("blogForm").addEventListener("submit", function() {
                document.getElementById("content_en").value = quillEn.root.innerHTML;
                document.getElementById("content_ar").value = quillAr.root.innerHTML;
            });

            // Initialize Select2
            $('#categories').select2();

        });
    </script>
@endpush
