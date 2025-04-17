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
                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="{{ asset('dashboard/img/products/marble-cake-thumb.jpg') }}" alt="Marble Cake"
                                        class="list-thumbnail border-0" />
                                    <span
                                        class="badge badge-pill badge-theme-2 position-absolute badge-top-right">NEW</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Marble Cake</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Latashia Nagy - 100-148 Warwick
                                                Trfy, Kansas City, USA</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">
                                            09.04.2018</div>
                                    </a>
                                </div>
                            </div>

                            <!-- Add additional recent orders here -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="flower-container"></div>

@endsection
