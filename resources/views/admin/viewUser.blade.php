@extends('admin.layout.app')

@section('title',  'Customer Profile')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">


            <!-- start page title -->
            <div class="row">

                <div class="col-12">

                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">{{ $user->first_name }} {{ $user->last_name }} Profile</h4>
                        <div class="d-flex justify-content-end">
                            @if ($user->status == 'active')
                            <form action="{{ route('deactivate', $user->id) }}" method="POST" style="display: inline;" id="status-form-{{ $user->id }}">
                                @csrf
                                @method('PUT') <!-- This makes the request a PUT request -->
                                <button type="submit" class="btn btn-sm text-danger bg-danger text-white" onclick="confirmStatusChange({{ $user->id }})">
                                    <i class="ri-close-line"></i> Deactivate User
                                </button>
                            </form>
                            @else
                            <form action="{{ route('active', $user->id) }}" method="POST" style="display: inline;" id="status-form-{{ $user->id }}">
                                @csrf
                                @method('PUT') <!-- This makes the request a PUT request -->
                                <button type="submit" class="btn btn-sm text-info" style="background-color: #9e086c; color: white !important;" onclick="confirmStatusChange({{ $user->id }})">
                                    <i class="ri-check-line"></i> Activate User
                                </button>
                            </form>
                            @endif

                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
  @if($previous)
    <a
      href="{{ route('userprofile', $previous->id) }}"
      class="btn btn-outline-secondary " style="background-color: #9e086c; color: white !important;"
    >
      &laquo; Previous
    </a>
  @else
    <span></span>
  @endif

  @if($next)
    <a
      href="{{ route('userprofile', $next->id) }}"
      class="btn btn-outline-secondary"style="background-color: #9e086c; color: white !important;"
    >
      Next &raquo;
    </a>
  @else
    <span></span>
  @endif
</div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Navigation Pills -->
                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                <li class="nav-item">
                                    <a href="#aboutme" data-bs-toggle="tab" class="nav-link rounded-start active">
                                        <i class="ri-user-line me-1"></i> Customer Information
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="#matches" data-bs-toggle="tab" class="nav-link">
                                        Matches
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#like_dislike" data-bs-toggle="tab" class="nav-link rounded-end">
                                        like & dislike
                                    </a>
                                </li> --}}
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <!-- Customer Information Tab -->
                                  <!-- Form for activating or deactivating user -->

                                <div class="tab-pane fade show active" id="aboutme">
                                    <form>
                                        <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i> Personal Info</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3 text-center">

                                                    <img src="{{ asset(optional($user->photos->firstWhere('is_main', 1))->photo_url) }}" class="img-thumbnail" alt="User Avatar" style="max-width: 250px; height: auto; border-radius:10px">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Bio</label>
                                                    <p>{{ $user->profile->bio_en ?? 'None' }}</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <p>{{ $user->first_name ?? 'None' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <p>{{ $user->last_name ?? 'None' }}</p>
                                                </div>
                                            </div>
                                        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">ID Number</label>
                    <p>{{ $user->profile->id_number ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Verification Status</label>
                    <p>
                        @if(isset($user->profile->id_verification_status))
                            @if($user->profile->id_verification_status === 'verified')
                                <i class="ri-checkbox-circle-line text-success"></i>
                            @else
                                <i class="ri-close-circle-line text-danger"></i>
                            @endif
                            {{ $user->profile->id_verification_status }}
                        @else
                            <i class="ri-close-circle-line text-danger"></i>

                        @endif
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
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Zodiac Sign</label>
                        <p>{{ $user->profile->zodiacSign->name_en ??'None' }}</p>

                    </div>
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
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Area/Neighborhood</label>
            <p>{{ $user->profile->cityLocation->name_en ?? 'None' }}</p>
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
            @if(isset($user->profile->criminal_record_url) && $user->profile->criminal_record_url)
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
              <p>{{ isset($user->profile->employment_status) ? ($user->profile->employment_status ? 'Employed' : 'Unemployed') : 'None' }}</p>
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
              <p>{{ isset($user->profile->car_ownership) ? ($user->profile->car_ownership ? 'Yes' : 'No') : 'None' }}</p>
          </div>
      </div>
      <div class="col-md-6">
          <div class="mb-3">
              <label class="form-label">Smoking Status</label>
              <p>{{ isset($user->profile->smokingStatus) ? ($user->profile->smokingStatus == 1 ? 'Yes' : 'No') : 'None' }}</p>
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
  <div class="row">
      <div class="col-md-6">
          <div class="mb-3">
              <label class="form-label">eye Color</label>
              <p>{{ $user->profile->eyeColor->name_en ?? 'None' }}</p>
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
  <div class="d-flex justify-content-end">
                            @if ($user->status == 'active')
                            <form action="{{ route('deactivate', $user->id) }}" method="POST" style="display: inline;" id="status-form-{{ $user->id }}">
                                @csrf
                                @method('PUT') <!-- This makes the request a PUT request -->
                                <button type="submit" class="btn btn-sm text-danger bg-danger text-white" onclick="confirmStatusChange({{ $user->id }})">
                                    <i class="ri-close-line"></i> Deactivate User
                                </button>
                            </form>
                            @else
                            <form action="{{ route('active', $user->id) }}" method="POST" style="display: inline;" id="status-form-{{ $user->id }}">
                                @csrf
                                @method('PUT') <!-- This makes the request a PUT request -->
                                <button type="submit" class="btn btn-sm text-info" style="background-color: #9e086c; color: white !important;" onclick="confirmStatusChange({{ $user->id }})">
                                    <i class="ri-check-line"></i> Activate User
                                </button>
                            </form>
                            @endif
                        </div>

                                        <!-- Add rest of your form content here -->
                                    </form>
                                </div>

                                {{-- <!-- Matches Tab -->
                                <div class="tab-pane fade" id="matches">
                                    <h5 class="mb-4 text-uppercase"><i class="ri-user-heart-line me-1"></i> Matches</h5>
                                    <div class="row">
                                        @forelse($user->matches as $match)
                                        @php
                                            $matchedUser = $match->user1_id == $user->id ? $match->user2 : $match->user1;
                                        @endphp

                                        <div class="col-sm-6 col-lg-3">
                                            <div class="card">
                                                <img src="{{ asset($matchedUser->profile->avatar_url ?? 'default-avatar.jpg') }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $matchedUser->first_name }} {{ $matchedUser->last_name }}</h5>
                                                    <p class="card-text">{{ Str::limit($matchedUser->profile->bio_en ?? 'No bio available', 50) }}</p>
                                                    <a href="{{ route('userprofile', $matchedUser->id) }}" class="btn btn-primary mt-2">View Full Profile</a>
                                                </div> <!-- end card-body -->
                                            </div> <!-- end card -->
                                        </div> <!-- end col-->
                                    @empty
                                        <p class="text-muted">No matches found.</p>
                                    @endforelse

                                    </div>
                                    <!-- Add your matches content here -->
                                </div> --}}

                                <!-- Settings Tab -->
                                <div class="tab-pane fade" id="like_dislike">
                                    <h5 class="mb-4 text-uppercase"><i class="ri-settings-3-line me-1"></i> Settings</h5>
                                    <p>Settings content goes here...</p>
                                    <!-- Add your settings content here -->
                                </div>
                            </div> <!-- end tab-content -->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
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
     function confirmStatusChange(userId) {
        event.preventDefault(); // Prevent form submission
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to change the user's status?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9e086c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('status-form-' + userId).submit();
            }
        });
    }
    </script>



@endpush
