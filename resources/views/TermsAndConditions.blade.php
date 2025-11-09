@extends('frontend.layouts.app')

@section('section')
<style>
    .terms-content {
        background: #fff;
        padding: 40px 30px;
        position: relative;
        z-index: 1;
        height: auto;
        line-height: 1.8;
        font-size: 1rem;
        color: #222;
    }

    .terms-content * {
        text-align: inherit !important;
    }

    .terms-content[dir="ltr"] {
        text-align: left !important;
        direction: ltr !important;
    }

    .terms-content[dir="rtl"] {
        text-align: right !important;
        direction: rtl !important;
    }

    .terms-content ul {
        list-style: disc;
        padding-left: 1.5rem;
        margin: 1rem 0;
    }

    .terms-content p {
        margin-bottom: 1rem;
    }

    .terms-content h3,
    .terms-content h4 {
        margin-top: 2rem;
        font-weight: bold;
    }

    .processing-box {
        background: #fff7fb;
        border: 1px dashed #d7a8c2;
        text-align: center;
        padding: 50px 25px;
        border-radius: 12px;
        color: #9c0c58;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .processing-box i {
        font-size: 40px;
        color: #9c0c58;
        display: block;
        margin-bottom: 15px;
    }
</style>

<div>
    {{-- ========== Breadcrumb ========== --}}
    <section class="breadcrumb-area d-flex align-items-center"
        style="
        @if (app()->getLocale() === 'ar')
            background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }}); background-position: left 0;
        @else
            background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }}); background-position: right 0;
        @endif
        background-repeat: no-repeat;
        background-size: cover;
    ">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title mt-60 mb-30">
                            <h2>{{ __('TermsAndConditions.title') }}</h2>
                            <small class="d-block">
                                {{ __('TermsAndConditions.last_updated') }}:
                                {{ isset($term) && $term->effective_date ? \Carbon\Carbon::parse($term->effective_date)->format('d M Y') : now()->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== Terms & Conditions ========== --}}
    <section class="inner-terms b-details-p pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-details-wrap">
                        <div class="details__content pb-50">
                            @if ($term)
                                {{-- Title --}}
                                <h2 style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">
                                    {{ app()->getLocale() === 'ar' ? $term->title_ar : $term->title_en }}
                                </h2>

                                {{-- Content --}}
                                <div class="terms-content"
                                    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                    {!! app()->getLocale() === 'ar' ? $term->content_ar : $term->content_en !!}
                                </div>
                            @else
                                {{-- Under Processing Message --}}
                                <div class="processing-box">
                                    <i class="ri-time-line"></i>
                                    {{ app()->getLocale() === 'ar'
                                        ? 'الشروط والأحكام قيد المعالجة حالياً. يرجى العودة لاحقاً.'
                                        : 'Terms & Conditions are currently under processing. Please check back later.' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
