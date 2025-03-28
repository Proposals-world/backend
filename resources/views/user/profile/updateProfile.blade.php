@extends('user.layouts.app')

@section('content')
 <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Form Wizard</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Library</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">

                <div class="col-12 mb-4">
                    <h5 class="mb-4">Validation</h5>
                    <div class="card mb-4">
                        <div id="smartWizardValidation">
                            <ul class="card-header">
                                <li><a href="#step-0">Step 1<br /><small>First step description</small></a></li>
                                <li><a href="#step-1">Step 2<br /><small>Second step description</small></a></li>
                                <li><a href="#step-2">Step 3<br /><small>Third step description</small></a></li>
                            </ul>

                            <div class="card-body">
                                <div id="step-0">
                                    <form id="form-step-0" class="tooltip-label-right" novalidate>
                                        <div class="form-group position-relative error-l-100">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="emailValidation"
                                                id="emailValidation" placeholder="Your email address" required>
                                        </div>
                                        <div class="form-group position-relative error-l-100">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="passwordValidation"
                                                id="passwordValidation" placeholder="Your password" required>
                                        </div>
                                    </form>
                                </div>
                                <div id="step-1">
                                    <form id="form-step-1" class="tooltip-label-right" novalidate>
                                        <div class="form-group position-relative error-l-75">
                                            <label for="name">First Name</label>
                                            <input type="text" class="form-control" name="nameValidation"
                                                id="nameValidation" placeholder="Your first name" required>
                                        </div>
                                        <div class="form-group position-relative error-l-75">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" name="lastNameValidation"
                                                id="lastNameValidation" placeholder="Your last name" required>
                                        </div>
                                    </form>
                                </div>
                                <div id="step-2">
                                    <h4 class="text-center">Thank you for your feedback!</h4>
                                    <p class="muted text-center p-4">
                                        Podcasting operational change management inside of workflows to establish a
                                        framework. Taking seamless key performance indicators offline to maximise the
                                        long tail. Keeping your eye on the ball while performing a deep dive on the
                                        start-up mentality.
                                    </p>
                                </div>
                            </div>

                            <div class="btn-toolbar custom-toolbar text-center card-body pt-0">
                                <button class="btn btn-secondary prev-btn" type="button">Previous</button>
                                <button class="btn btn-secondary next-btn" type="button">Next</button>
                                <button class="btn btn-secondary finish-btn" type="submit">Finish</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </main>


                </div>
            </div>
            @push('scripts')
            <script>
                $(document).ready(function () {
                    $('#smartWizardValidation').smartWizard({
                        selected: 0,
                        theme: 'dots', // try 'arrows', 'circles', or 'default' if you prefer
                        autoAdjustHeight: true,
                        transition: {
                            animation: 'fade'
                        },
                        toolbar: {
                            showNextButton: false,
                            showPreviousButton: false,
                            position: 'bottom'
                        }
                    });

                    $('.next-btn').on('click', function () {
                        $('#smartWizardValidation').smartWizard("next");
                    });

                    $('.prev-btn').on('click', function () {
                        $('#smartWizardValidation').smartWizard("prev");
                    });

                    $('.finish-btn').on('click', function () {
                        alert("Finished! You can now submit your report.");
                    });
                });
            </script>
            @endpush

@endsection
