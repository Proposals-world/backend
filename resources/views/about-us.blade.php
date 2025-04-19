@extends('frontend.layouts.app')
@section('section')
<style>
    .row {
        align-items: unset;
    }

    .about-us-section {
        font-size: 18px;
        line-height: 1.8;
        color: #333;
    }

    .about-us-section .about-item {
        margin-bottom: 20px;
        position: relative;
        padding-left: 25px;
    }

    .about-us-section .about-item::before {
        content: "–";
        position: absolute;
        left: 0;
        color: #6c63ff;
        font-weight: bold;
    }

    .highlight {
        background-color: #e8a5d3;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 500;
        color: #fff;
    }
</style>

<div>
    <section class="breadcrumb-area d-flex align-items-center"
    style="
    @if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/pink-header-bg-rtl.png') }});
        background-position: left 0;
    @else
        background-image: url({{ asset('frontend/img/bg/pink-header-bg.png') }});
        background-position: right 0; @endif
    background-repeat: no-repeat;
    background-size: 65%;">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title mt-60 mb-30">
                            <h2>{{ __('home.about-us') }}</h2>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('home.about-us') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="inner-blog b-details-p pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 about-us-section">
                    <h3 class="mb-4 fw-bold text-dark">Why Proposals?</h3>

                    <div class="about-item">There’s a lack of existence for spontaneous opportunities for healthy and serious relationship.</div>

                    <div class="about-item">
                        Choosing the right soulmate and ultimate partner for marriage does not only depend on
                        <span class="highlight">looks</span> nor on distance, it also depends on various important factors like:
                        <span class="highlight">Origin</span> & Background,
                        <span class="highlight">education</span>,
                        <span class="highlight">social level</span>,
                        <span class="highlight">work</span> & position,
                        <span class="highlight">values</span>,
                        <span class="highlight">financial</span> aspect,
                        <span class="highlight">hobbies</span> and more.
                    </div>

                    <div class="about-item">With proposals, we take into account the priorities of both women and men who deserve to find their aspired partners in a way that meets their needs.</div>

                    <div class="about-item">Men nowadays, have a different mentality from their surroundings and need a way to shorten the process of searching for a dream girl that suits their aspirations.</div>

                    <div class="about-item">Ladies are working hard on themselves just as men and as they advance and improve their abilities and skills, they look forward to find a suitable partner that meet their aspirations.</div>

                    <div class="about-item">We believe that the best options can be met through knocking the door & that marriage requires sincere steps that are built upon trust and in the presence of families.</div>

                    <div class="about-item">We highlight the importance of efficient meetups that depend on previewing each other's characteristics with an initial approval and acceptance for both parties before the visit.</div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
