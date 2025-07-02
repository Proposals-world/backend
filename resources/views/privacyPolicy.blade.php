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
     .privacy-policy-content:before  {
        content: "- ";
        display: inline;
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
                            <h2>{{ __('privacy_policy.title') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="privacy-policy-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach(__('privacy_policy.sections') as $section)
                        <h3 class="textalignment " >{{ $section['title'] }}</h3>
                        @if(is_array($section['content']))
                            @if(isset($section['content']['items']))
                                <!-- Handle sections with intro, items, and conclusion (e.g., membership_violation) -->
                                @if(isset($section['content']['intro']) && is_string($section['content']['intro']))
                                    <p class="textalignment  ">{!! nl2br(e($section['content']['intro'])) !!}</p>
                                @else
                                    @if(isset($section['content']['intro']))
                                        <p>Debug: Intro for section '{{ $section['title'] }}' is not a string.</p>
                                    @endif
                                @endif
                                <ul class="textalignment">
                                    @foreach($section['content']['items'] as $item)
                                        @if(is_string($item))
                                            <li class="textalignment ">{!! nl2br(e($item)) !!}</li>
                                        @else
                                            <li>Debug: Item in section '{{ $section['title'] }}' is not a string.</li>
                                        @endif
                                    @endforeach
                                </ul>
                                @if(isset($section['content']['conclusion']) && is_string($section['content']['conclusion']))
                                    <p class="textalignment ">{!! nl2br(e($section['content']['conclusion'])) !!}</p>
                                @else
                                    @if(isset($section['content']['conclusion']))
                                        <p>Debug: Conclusion for section '{{ $section['title'] }}' is not a string.</p>
                                    @endif
                                @endif
                            @elseif(collect($section['content'])->contains(function ($value) { return isset($value['title']); }))
                                <!-- Handle nested sections with sub-sections (e.g., collected_data) -->
                                @foreach($section['content'] as $subSection)
                                    <h4 class="textalignment">{{ $subSection['title'] }}</h4>
                                    @if(isset($subSection['content']) && is_string($subSection['content']))
                                        <p class="textalignment ">{!! nl2br(e($subSection['content'])) !!}</p>
                                    @else
                                        @if(isset($subSection['content']))
                                            <p>Debug: Content for sub-section '{{ $subSection['title'] }}' in section '{{ $section['title'] }}' is not a string.</p>
                                        @endif
                                    @endif
                                    @if(isset($subSection['items']))
                                        <ul class="textalignment">
                                            @foreach($subSection['items'] as $item)
                                                @if(is_string($item))
                                                    <li class="textalignment privacy-policy-content">{!! nl2br(e($item)) !!}</li>
                                                @else
                                                    <li>Debug: Item in sub-section '{{ $subSection['title'] }}' is not a string.</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if(isset($subSection['purpose']) && is_string($subSection['purpose']))
                                        <p class="textalignment">{!! nl2br(e($subSection['purpose'])) !!}</p>
                                    @else
                                        @if(isset($subSection['purpose']))
                                            <p>Debug: Purpose for sub-section '{{ $subSection['title'] }}' in section '{{ $section['title'] }}' is not a string.</p>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <!-- Handle sections with simple list content (e.g., data_usage, user_rights) -->
                                <ul>
                                    @foreach($section['content'] as $key => $item)
                                        @if(is_string($item))
                                            <li class="textalignment">{!! nl2br(e($item)) !!}</li>
                                        @else
                                            <li>Debug: Item in section '{{ $section['title'] }}' (key: {{ $key }}) is not a string.</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        @else
                            <!-- Handle sections with string content -->
                            <p class="textalignment">{!! nl2br(e($section['content'])) !!}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
