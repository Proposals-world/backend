@extends('frontend.layouts.app')
@section('section')
<div>
    <section class="breadcrumb-area d-flex align-items-center" style="background-image:url({{ asset('frontend/img/bg/test-bg.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title mt-60 mb-30">
                            <h2>News Details</h2>                                  
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">News Details</li>
                            </ol>
                        </nav>
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
                            {{-- <img src="{{asset('frontend/img/blog/inner_b1.jpg')}}" alt=""> --}}
                        </div>
                        <div class="details__content pb-50">
                            <h2>With our vastly improved notifications system, users
                                have more control on your mind.</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip
                                ex ea commodo amet set for your cool happiness for lyour loyal city.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat
                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deser unt
                                mollit anim id est
                                laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusant ium doloremque
                                laudantium, totam rem
                                aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo. Nemo enim
                                ipsam voluptatem quia voluptas sit asperna tur aut odit aut fugit, sed quia consequuntur magni dolores
                                eos qui
                                ratione voluptatem sequi nesciunt. Neque porro quisquam est.</p>
                            <blockquote>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                with ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation a deef
                                ullamco laboris nisi ut aliquip ex ea commodo consequat see you again tommorow.
                                <footer>- Rosalina Pong</footer>
                            </blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip
                                ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat
                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deser unt
                                mollit anim id est
                                laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusant.</p>
                            <div class="details__content-img">
                                <img src="{{asset('frontend/img/blogs/blog-1.jpeg')}}" alt="">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip
                                ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat
                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deser unt
                                mollit anim id est
                                laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusan tium doloremque
                                laudantium, totam rem
                                aperiam, eaque ipsa quae ab illo inventore veritatis et quasi archi tecto beatae vitae dicta sunt
                                explicabo. Nemo enim
                                ipsam voluptatem quia voluptas sit asperna tur aut odit aut fugit, sed quia consequuntur magni dolores
                                eos qui
                                ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                                consectetur,
                                adipisci velit, sed quia non num quam eius modi tempora incidunt ut labore et dolore magnam aliquam
                                quaerat voluptatem.
                                Lorem ipsum dolor sit amet,consectetur adipisicing elit, sed do eiusmod incididunt.</p>
                            <figure>
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
                            </figure>
                     
                        </div>
                        <div class="posts_navigation pt-35 pb-35">
                            <div class="row align-items-center">
                                <div class="col-xl-4 col-md-5">
                                    <div class="prev-link">
                                        <span>Prev Post</span>
                                        <h4><a href="#">Tips on Minimalist</a></h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-2 text-left text-md-center">
                                    <a  class="blog-filter"><img src="{{asset('frontend/img/icon/c_d01.png')}}" alt=""></a>
                                </div>
                                <div class="col-xl-4 col-md-5">
                                    <div class="next-link text-left text-md-right">
                                        <span>next Post</span>
                                        <h4><a href="#">Less Is More</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="related__post mt-45 mb-85">
                            <div class="post-title">
                                <h4>Related Post</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="related-post-wrap mb-30">
                                        <div class="post-thumb">
                                            <img src="{{asset('frontend/img/blogs/blog-3.jpeg')}}" alt="">
                                        </div>
                                        <div class="rp__content">
                                            <h3><a href="#">A series of iOS 7 inspire
                                                    vector icons.</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or
                                                incididunt ut labore et dolore.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="related-post-wrap mb-30">
                                        <div class="post-thumb">
                                            <img src="{{asset('frontend/img/blogs/blog-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="rp__content">
                                            <h3><a href="#">Sed ut perspiciatis unde omnis iste natus.</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or
                                                incididunt ut labore et dolore.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside>
                        <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>Search</h4>
                            </div>
                            <div class="slidebar__form">
                                <form action="#">
                                    <input type="text" placeholder="Search your keyword...">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>Follow Us</h4>
                            </div>
                            <div class="widget-social text-center">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-wordpress"></i></a>
                            </div>
                        </div>
                        <div class="widget mb-40">
                            <div class="widget-title text-center">
                                <h4>Categories</h4>
                            </div>
                            <ul class="cat__list">
                                <li><a href="#">Lifestyle <span>(05)</span></a></li>
                                <li><a href="#">Travel <span>(34)</span></a></li>
                                <li><a href="#">Fashion <span>(89)</span></a></li>
                                <li><a href="#">Music <span>(92)</span></a></li>
                                <li><a href="#">Branding <span>(56)</span></a></li>
                            </ul>
                        </div>

                        <div class="widget mb-40">
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
                        </div>                               
                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection