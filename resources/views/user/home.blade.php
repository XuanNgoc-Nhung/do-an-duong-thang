@extends('user.layouts.app')
@section('title')
    <title>Trang chủ - Mua sắm thả ga</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding-top: 120px">
            <div class="col-12">
                <div class="owl-carousel">
                    <div><img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="d-block w-100" alt="Wild Landscape" /> </div>
                    <div >
                        <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="d-block w-100" alt="Camera" />
                    </div>
                    <div >
                        <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100" alt="Exotic Fruits" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="user-home">
        <user-home/>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="section section-blogs">
                    <div class="container-fluid">
                        <!-- Section Header -->
                        <div class="section-header text-center aos" data-aos="fade-up">
                            <h2>Bài viết nổi bật</h2>
                            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <!-- /Section Header -->

                        <div class="row blog-grid-row aos" data-aos="fade-up">
                            <div class="col-md-6 col-lg-3 col-sm-12">

                                <!-- Blog Post -->
                                <div class="blog grid-blog">
                                    <div class="blog-image">
                                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="entry-meta meta-item">
                                            <li>
                                                <div class="post-author">
                                                    <a href="doctor-profile.html"><img src="assets/img/doctors/doctor-thumb-01.jpg" alt="Post Author"> <span>Dr. Ruby Perrin</span></a>
                                                </div>
                                            </li>
                                            <li><i class="far fa-clock"></i> 4 Dec 2019</li>
                                        </ul>
                                        <h3 class="blog-title"><a href="blog-details.html">Doccure – Making your clinic painless visit?</a></h3>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                                    </div>
                                </div>
                                <!-- /Blog Post -->

                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-12">

                                <!-- Blog Post -->
                                <div class="blog grid-blog">
                                    <div class="blog-image">
                                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt="Post Image"></a>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="entry-meta meta-item">
                                            <li>
                                                <div class="post-author">
                                                    <a href="doctor-profile.html"><img src="assets/img/doctors/doctor-thumb-02.jpg" alt="Post Author"> <span>Dr. Darren Elder</span></a>
                                                </div>
                                            </li>
                                            <li><i class="far fa-clock"></i> 3 Dec 2019</li>
                                        </ul>
                                        <h3 class="blog-title"><a href="blog-details.html">What are the benefits of Online Doctor Booking?</a></h3>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                                    </div>
                                </div>
                                <!-- /Blog Post -->

                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-12">

                                <!-- Blog Post -->
                                <div class="blog grid-blog">
                                    <div class="blog-image">
                                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt="Post Image"></a>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="entry-meta meta-item">
                                            <li>
                                                <div class="post-author">
                                                    <a href="doctor-profile.html"><img src="assets/img/doctors/doctor-thumb-03.jpg" alt="Post Author"> <span>Dr. Deborah Angel</span></a>
                                                </div>
                                            </li>
                                            <li><i class="far fa-clock"></i> 3 Dec 2019</li>
                                        </ul>
                                        <h3 class="blog-title"><a href="blog-details.html">Benefits of consulting with an Online Doctor</a></h3>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                                    </div>
                                </div>
                                <!-- /Blog Post -->

                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-12">

                                <!-- Blog Post -->
                                <div class="blog grid-blog">
                                    <div class="blog-image">
                                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-04.jpg" alt="Post Image"></a>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="entry-meta meta-item">
                                            <li>
                                                <div class="post-author">
                                                    <a href="doctor-profile.html"><img src="assets/img/doctors/doctor-thumb-04.jpg" alt="Post Author"> <span>Dr. Sofia Brient</span></a>
                                                </div>
                                            </li>
                                            <li><i class="far fa-clock"></i> 2 Dec 2019</li>
                                        </ul>
                                        <h3 class="blog-title"><a href="blog-details.html">5 Great reasons to use an Online Doctor</a></h3>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                                    </div>
                                </div>
                                <!-- /Blog Post -->

                            </div>
                        </div>
                        <div class="view-all text-center aos" data-aos="fade-up">
                            <a href="blog-list.html" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section("js_location")
    <script >
        $(document).ready(function(){
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items:1,
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                autoplayHoverPause:true
            });
            $('.play').on('click',function(){
                owl.trigger('play.owl.autoplay',[1000])
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            })
        });
    </script>
    <script src="{{asset('js/user-home.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
