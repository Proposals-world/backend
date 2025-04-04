@extends('user.layouts.app')

@section('content')
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

                            {{-- 💬 Feedback icon triggers modal --}}
                            <button type="button"
                                    class="position-absolute badge badge-pill badge-primary"
                                    style="top: 10px; right: 10px; z-index: 10; font-size: 1.25em; padding: 0.5em 1em; border:0"
                                    data-toggle="modal"
                                    data-target="#feedbackModal_{{ $match['id'] }}"
                                    title="{{ __('Give Feedback') }}">
                                <i class="fas fa-comment"></i>
                            </button>

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
                                        {{ __('Email') }}: {{ $match['matched_user_email'] }}
                                    </p>
                                    <p class="text-muted mb-1 text-small">
                                        {{ __('Phone') }}: {{ $match['matched_user_phone'] }}
                                    </p>
                                </div>
                                <div class="text-primary text-small font-weight-medium d-none d-sm-block">
                                    {{ $match['created_at'] }}
                                </div>
                            </div>
                        </div>

                        {{-- 🔽 Modal (one per card) --}}
                        <div class="modal fade modal-right" id="feedbackModal_{{ $match['id'] }}" tabindex="-1" role="dialog"
                            aria-labelledby="feedbackModalLabel_{{ $match['id'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="feedbackModalLabel_{{ $match['id'] }}">
                                            {{ __('Give Feedback for') }} {{ $match['matched_user_name'] }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    {{-- Modal Body --}}
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('feedback.store') }}">
                                            @csrf
                                        {{-- You can customize or leave this as a placeholder --}}
                                            <input type="hidden" name="match_id" value="{{ $match['id'] }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                             {{-- ✅ English Feedback --}}
                                                <div class="form-group">
                                                    <label>{{ __('Feedback (English)') }}</label>
                                                    <textarea name="feedback_text_en" class="form-control" rows="2"></textarea>
                                                </div>

                                                {{-- ✅ Arabic Feedback --}}
                                                <div class="form-group">
                                                    <label>{{ __('Feedback (Arabic)') }}</label>
                                                    <textarea name="feedback_text_ar" class="form-control" rows="2"></textarea>
                                                </div>

                                                {{-- ✅ Outcome --}}
                                                <div class="form-group">
                                                    <label>{{ __('Outcome') }}</label>
                                                    <input type="text" class="form-control" name="outcome" placeholder="{{ __('e.g. Success, No response') }}">
                                                </div>
                                                <div class="form-group d-flex align-items-center">
                                                    <label class="mr-3">{{ __('Is Profile Accurate?') }}</label>
                                                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                                                         data-toggle="tooltip" data-placement="left" title="Is profile accurate?">
                                                        <input class="custom-switch-input" id="isProfileAccurate_{{ $match['id'] }}"
                                                               type="checkbox" name="is_profile_accurate" value="1">
                                                        <label class="custom-switch-btn" for="isProfileAccurate_{{ $match['id'] }}"></label>
                                                    </div>
                                                </div>
                                            </div>
                                              {{-- Footer --}}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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


@endsection
