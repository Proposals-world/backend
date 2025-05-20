@extends('frontend.layouts.app')
@section('section')
<style>
   .row {
    align-items:unset;
}
</style>
<div>
    <section class="breadcrumb-area d-flex align-items-center"
    style="
    @if (app()->getLocale() === 'ar') background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }}); background-position: left 0;
    @else background-image: url({{ asset('frontend/img/bg/breadcrumb.png') }}); background-position: right 0; @endif
    background-repeat: no-repeat;
    background-size: cover;
">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title mt-60 mb-30">
                            <h2>{{ $formattedBlog['title'] }}</h2>
                        </div>
                        {{-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $formattedBlog['title'] }}</li>
                            </ol>
                        </nav> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <!-- inner-blog -->
    <section class="inner-blog b-details-p pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-wrap">
                    <div class="bsingle__post-thumb mb-30">
                        <img src="{{asset('storage/' . $formattedBlog['image']) }}" alt="">
                    </div>
                        <div class="details__content pb-50">
                            {{-- blog title --}}
                            <h2>{{ $formattedBlog['title'] }}</h2>

                            <p>{!! $formattedBlog['content'] !!}</p>
                            {{-- .details__content blockquote {
 --}}

                            {{-- <div class="details__content-img">
                                <img src="{{asset('frontend/img/blogs/blog-1.jpeg')}}" alt="">
                            </div> --}}

                            {{-- <figure>
                                <img src="{{asset('frontend/img/blogs/blog-4.jpeg')}}" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                    et dolore magna
                                    ali qua. Ut enim ad minim veniam, quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea
                                    commodo consequat.
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur. Excepteur sint
                                    occaecat cupida tat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed
                                    ut perspiciatis
                                    unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
                                    eaque ipsa quae ab
                                    illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                            </figure> --}}

                        </div>
                        <div class="posts_navigation pt-35 pb-35">
                            <div class="row align-items-center">
                                <div class="col-xl-4 col-md-5">
                                    @if($previousBlog)
                                        <div class="prev-link">
                                            <span>{{ __('blog.Prev_Post') }}</span>
                                            <h4><a href="{{ route('blog-details', $previousBlog['id']) }}">{{ $previousBlog['title'] }}</a></h4>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xl-4 col-md-2 text-left text-md-center">
                                    <a class="blog-filter"><img src="{{asset('frontend/img/icon/c_d01.png')}}" alt=""></a>
                                </div>
                                <div class="col-xl-4 col-md-5">
                                    @if($nextBlog)
                                        <div class="next-link text-left text-md-right">
                                            <span>{{ __('blog.Next_Post') }}</span>
                                            <h4><a href="{{ route('blog-details', $nextBlog['id']) }}">{{ $nextBlog['title'] }}</a></h4>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="related__post mt-45 mb-85">
                            <div class="post-title">
                                <h4>{{ __('blog.Other_Blogs') }}</h4>
                            </div>
                            <div class="row">
                                @foreach ($otherBlogs as $blog)
                                    <div class="col-md-6">
                                        <div class="related-post-wrap mb-30">
                                            <div class="post-thumb">
                                                <img src="{{asset('storage/' . $blog['image']) }}" alt="">
                                            </div>
                                            <div class="rp__content">
                                                <h3><a href="{{ route('blog-details', $blog['id']) }}">{{ $blog['title'] }}</a></h3>
                                                <p>{!! Str::limit($blog['excerpt'], 100) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside>
                        {{-- <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>Search</h4>
                            </div>
                            <div class="slidebar__form">
                                <form action="#">
                                    <input type="text" placeholder="Search your keyword...">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div> --}}

                        {{-- <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>{{ __('blog.Follow_Us') }}</h4>
                            </div>
                            <div class="widget-social text-center">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-wordpress"></i></a>
                            </div>
                        </div> --}}
                        {{-- <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>{{ __('blog.Categories') }}</h4>
                            </div>
                            <ul class="cat__list">
                                @foreach ($formattedBlog['categories'] as $category)
                                    <li><a>{{ $category['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div> --}}

                        {{-- <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>Tags</h4>
                            </div>
                            <div class="widget__tag">
                                <ul>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Lifestyle</a></li>
                                    <li><a href="#">Photo</a></li>
                                    <li><a href="#">Adventures</a></li>
                                    <li><a href="#">Musician</a></li>
                                    <li><a href="#">08</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Lifestyle</a></li>
                                    <li><a href="#">Photo</a></li>
                                    <li><a href="#">Adventures</a></li>
                                    <li><a href="#">Musician</a></li>
                                    <li><a href="#">08</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
