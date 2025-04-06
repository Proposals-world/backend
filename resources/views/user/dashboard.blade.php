@extends('user.layouts.app')

@section('content')
<style>

.feedback-btn {
    font-size: 1.25em;
    padding: 0.5em 1em;
    border: 0
    }
    @media (max-width: 576px) {

       /* Base styling to keep switch aligned left */
.switch-wrapper {
    display: inline-block;
}

/* Make it smaller and still aligned left on mobile */
@media (max-width: 576px) {
    .switch-wrapper {
        transform: scale(0.85);
        transform-origin: left center;
    }
}

    .feedback-btn {
        font-size: 1.07em ;
                padding: 0.4em 0.8em;
    }
    .modal-left .modal-dialog {
    position: fixed;
    margin: 0;
    right: auto;
    left: 0;
    top: 0;
    bottom: 0;
    transform: translateX(-100%);
    transition: transform 0.3s ease-out;
}

.modal-left.show .modal-dialog {
    transform: translateX(0);
}
 /* Override default modal position on mobile */
 .modal.fade.modal-right .modal-dialog,
    .modal.fade.modal-left .modal-dialog {
        position: fixed;
        bottom: 0;
        top: auto;
        left: 0;
        right: 0;
        margin: 0 auto;
        transform: translateY(100%);
        transition: transform 0.3s ease-out;
        width: 100%;
        height: 100vh;
        max-height: 65vh; /* Optional: so it doesn't exceed the screen */
        min-height: 45vh; /* Optional: so it doesn't exceed the screen */
        border-radius: 1rem 1rem 0 0;
    }
    .modal.modal-bottom .modal-dialog {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .modal-content {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .modal-body {
        flex: 1;
        overflow-y: auto;
    }

    .modal-footer {
        flex-shrink: 0;
        padding: 1rem;
        border-top: 1px solid #dee2e6;
        background: #fff;
    }
    .modal.fade.modal-right.show .modal-dialog,
    .modal.fade.modal-left.show .modal-dialog {
        transform: translateY(0);
    }

}
.scroll.dashboard-list-with-thumbs {
    max-height: 500px; /* Adjust as needed */
    overflow-y: auto;
}
</style>
    {{-- {{ dd($matches) }} --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="text-primary">
                    <i class="iconsminds-happy-face" style="font-size: 1.5em; vertical-align: middle;"></i>
                    Welcome, {{ Auth::check() ? Auth::user()->first_name : 'Guest' }}
                </h2> {{-- <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav> --}}
                <div class="separator mb-5"></div>
            </div>

            <div class="col-lg-12 col-xl-6">
                <!-- Additional Cards -->
                <a href="#" class="card mb-3">
                    <div class="card-body text-center">
                        <i class="iconsminds-check" style="font-size: xx-large;"></i>
                        <p class="card-text mb-0">Half Matchs</p>
                        <p class="lead text-center">42</p>
                    </div>
                </a>
                <!-- Existing Pending Orders Card -->
                <a href="#" class="card mb-3">
                    <div class="card-body text-center">
                        <i class="iconsminds-clock" style="font-size: xx-large;"></i>
                        <p class="card-text mb-0">Matchs</p>
                        <p class="lead text-center">16</p>
                    </div>
                </a>



                <a href="#" class="card mb-3">
                    <div class="card-body text-center">
                        <i class="iconsminds-remove" style="font-size: xx-large;"></i>
                        <p class="card-text mb-0">Remaining Contacts</p>
                        <p class="lead text-center">5</p>
                    </div>
                </a>
            </div>

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Recent Feedback</h5>
                        <div class="scroll dashboard-list-with-thumbs">
                            <!-- Recent orders remain unchanged -->
                            @if(count($matches))
                        @foreach ($matches as $match)
                        {{-- Card wrapper --}}
                        <div class="d-flex flex-row mb-3 position-relative">

                            {{-- Matched user image --}}
                            <a class="d-block" href="#">
                                <img src="{{ $match['matched_user_photo'] ?? asset('dashboard/img/users/default-user.jpg') }}"
                                    alt="{{ $match['matched_user_name'] }}"
                                    class="list-thumbnail border-0" />
                            </a>


                            {{-- Match info --}}
                            <div class="pl-3 pt-2 pr-2 pb-2 w-100">
                                <p class="list-item-heading mb-1">
                                    {{ $match['matched_user_name'] }}
                                </p>
                                <div class="pr-4 d-none d-sm-block">
                                    <p class="text-muted mb-1 text-small">
                                        {{ __('City') }}: {{ $match['matched_user_city'] ?? __('Unknown') }}
                                    </p>

                                    <p class="text-muted mb-1 text-small">
                                        {{ __('Phone') }}: {{ $match['matched_user_phone'] }}
                                    </p>
                                </div>
                                <div class="text-primary text-small font-weight-medium d-none d-sm-block">
                                    {{ $match['created_at'] }}
                                </div>
                            </div>
                            {{-- 💬 Feedback icon triggers modal --}}
                            <div class="d-flex justify-content-end align-items-center mb-2 ">
                                <button type="button"
                                        class="badge badge-pill badge-primary feedback-btn"
                                        data-toggle="modal"
                                        data-target="#feedbackModal_{{ $match['id'] }}"
                                        title="{{ __('Give Feedback') }}">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </div>

                        {{-- 🔽 Modal (one per card) --}}
                    <div class="modal fade {{ app()->getLocale() === 'ar' ? 'modal-left' : 'modal-right' }}"
                        id="feedbackModal_{{ $match['id'] }}"
                        tabindex="-1" role="dialog"
                        aria-labelledby="feedbackModalLabel_{{ $match['id'] }}"
                        aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary" >
                                        <div class="modal-drag-handle d-block d-sm-none">

                                        <h5 class="modal-title" id="feedbackModalLabel_{{ $match['id'] }}">
                                            <i class="fas fa-comment-dots"></i> {{ __('Give Feedback for') }}<b> {{ $match['matched_user_name'] }}</b>
                                        </h5>
                                    </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-white">&times;</span>
                                        </button>
                                    </div>

                                    {{-- Modal Body --}}
                                    <div class="modal-body">
                                        <div id="feedback-form-container">
                                            <form class="feedback-form" data-match-id="{{ $match['id'] }}">
                                                @csrf
                                                <input type="hidden" name="match_id" value="{{ $match['id'] }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                @if(app()->getLocale() === 'ar')
                                                    <div class="form-group">
                                                        <label><label>{{ __('feedback.Feedback') }}</label>
                                                    </label>
                                                        <textarea name="feedback_text_ar" class="form-control" rows="2"></textarea>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label><label>{{ __('feedback.Feedback') }}</label>
                                                    </label>
                                                        <textarea name="feedback_text_en" class="form-control" rows="2"></textarea>
                                                    </div>
                                                @endif

                                                <div class="form-group">
                                                    <label>{{ __('feedback.Outcome') }}</label>
                                                    <input type="text" class="form-control" name="outcome">
                                                </div>

                                                <div class="form-group">
                                                    <label class="mb-2 d-block">{{ __('feedback.Is_Profile_Accurate') }}</label>
                                                    <div class="custom-switch custom-switch-primary-inverse custom-switch-large switch-wrapper">
                                                        <input class="custom-switch-input" id="isProfileAccurate_{{ $match['id'] }}"
                                                               type="checkbox" name="is_profile_accurate" value="1">
                                                        <label class="custom-switch-btn" for="isProfileAccurate_{{ $match['id'] }}"></label>
                                                    </div>
                                                </div>


                                                <div class="feedback-success alert alert-success mt-3 d-none">
                                                    {{ __('feedback.Feedback submitted successfully.') }}
                                                </div>
                                            </div>

                                        </div>
                                        {{-- Footer --}}
                                        <div class="modal-footer justify-content-between">

                                                <button type="submit" class="btn btn-primary">{{ __('feedback.Submit') }}</button>
                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">{{ __('feedback.Cancel') }}</button>

                                        </div>



                                            </form>



                                </div>
                            </div>
                        </div>
                    @endforeach


                        @else
                            <p class="text-muted text-small">{{ __('No recent matches found.') }}</p>
                        @endif


                            <!-- Add additional recent orders here -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
    <script>
 document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.feedback-form');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            form.querySelectorAll('.text-danger').forEach(el => el.remove());

            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('feedback.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(async res => {
                const data = await res.json();

                if (res.status === 201) {
                    // ✅ Success
                    const successAlert = form.querySelector('.feedback-success');
                    if (successAlert) {
                        successAlert.classList.remove('d-none');
                    }

                    form.reset();

                    // Close modal after 1 second
                    setTimeout(() => {
                        $(form.closest('.modal')).modal('hide');
                    }, 1000);

                } else if (res.status === 422) {
                    // ❌ Validation error
                    const errors = data.errors;
                    Object.keys(errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            const errorText = document.createElement('div');
                            errorText.classList.add('text-danger', 'mt-1');
                            errorText.textContent = errors[field][0];
                            input.parentNode.appendChild(errorText);
                        }
                    });
                } else {
                    console.error('Unexpected error', data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    // drage the modal
    const modals = document.querySelectorAll('.modal');

modals.forEach(modal => {
    let startY = 0;
    let currentY = 0;
    let isDragging = false;

    const dialog = modal.querySelector('.modal-dialog');

    // Apply full modal height always on mobile
    if (window.innerWidth <= 576 && dialog) {
        // Ensure modal opens fully
        modal.addEventListener('shown.bs.modal', function () {
            dialog.style.transform = 'translateY(0)';
        });

        dialog.addEventListener('touchstart', function (e) {
            startY = e.touches[0].clientY;
            isDragging = true;
        });

        dialog.addEventListener('touchmove', function (e) {
            if (!isDragging) return;
            currentY = e.touches[0].clientY;

            const diff = currentY - startY;
            if (diff > 0) {
                dialog.style.transform = `translateY(${diff}px)`;
            }
        });

        dialog.addEventListener('touchend', function () {
            const diff = currentY - startY;

            if (diff > 100) {
                // Close modal
                $(modal).modal('hide');
            } else {
                // Snap back
                dialog.style.transform = 'translateY(0)';
            }

            isDragging = false;
            startY = 0;
            currentY = 0;
        });
    }
});

});


    </script>
    @endpush


@endsection
