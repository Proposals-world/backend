@extends('frontend.layouts.app')

@section('section')
<style>
    .textalignment{
        @if (app()->getLocale() === 'ar')
            text-align: right;
            /* direction: rtl; */
        @else
            text-align: left;
            /* direction: ltr; */
        @endif
    }
    .terms-content:before  {
        content: "- ";
        display: inline;
    }
    .terms-content h3 {
    margin-top: 2rem;
    font-size: 1.5rem;
    font-weight: bold;
}
.terms-content p {
    margin-bottom: 1rem;
    line-height: 1.6;
}
.terms-content ul {
    list-style-type: disc;
    margin-left: 2rem;
    margin-bottom: 1rem;
}
.terms-content ul li {
    margin-bottom: 0.5rem;
}
</style>
<div>
    <section class="breadcrumb-area d-flex align-items-center"
        style="
        @if (app()->getLocale() === 'ar')
            background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }});
            background-position: left 0;
            direction: rtl;
            text-align: right;
        @else
            background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }});
            background-position: right 0;
            direction: ltr;
            text-align: left;
        @endif
        background-repeat: no-repeat;
        background-size: cover;
    ">
        <div class="container">
            <div class="row">
                <div class="@if(app()->getLocale() === 'ar') col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 text-center mx-auto @else col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 text-center @endif">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title mt-60 mb-30">
                            <h2>{{ __('TermsAndConditions.title') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="terms-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   @foreach(__('TermsAndConditions.sections') as $section)
    <h3 class="textalignment">{{ $section['title'] }}</h3>
    @if(is_array($section['content']))
        @if(isset($section['content']['cancellation']))
            {{-- Special handling for cancellation_refund section --}}
            <h4 class="textalignment">{{ $section['content']['cancellation']['title'] }}</h4>
            <ul>
                @foreach($section['content']['cancellation']['items'] as $item)
                    <li class="textalignment terms-content">{{ e($item) }}</li>
                @endforeach
            </ul>

            <h4 class="textalignment">{{ $section['content']['refund']['title'] }}</h4>
            <ul>
                @foreach($section['content']['refund']['items'] as $item)
                    <li class="textalignment terms-content">{{ e($item) }}</li>
                @endforeach
            </ul>

            <p class="textalignment">{{ e($section['content']['contact']) }}</p>
        @elseif(isset($section['content']['items']) && is_array($section['content']['items']))
            {{-- Handle sections with intro, items, and conclusion --}}
            @if(isset($section['content']['intro']))
                <p class="textalignment">{!! nl2br(e($section['content']['intro'])) !!}</p>
            @endif
            <ul>
                @foreach($section['content']['items'] as $item)
                    <li class="textalignment terms-content">{{ e($item) }}</li>
                @endforeach
            </ul>
            @if(isset($section['content']['conclusion']))
                <p class="textalignment">{!! nl2br(e($section['content']['conclusion'])) !!}</p>
            @endif
        @else
            {{-- Handle sections with simple list content --}}
            <ul>
                @foreach($section['content'] as $key => $item)
                    <li class="textalignment terms-content">{{ e($item) }}</li>
                @endforeach
            </ul>
        @endif
    @else
        {{-- Handle sections with string content --}}
        <p class="textalignment">{!! nl2br(e($section['content'])) !!}</p>
    @endif
@endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
