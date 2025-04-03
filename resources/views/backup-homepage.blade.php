@extends('layouts.frontend.front-master')
@section('title', 'Amigo - Home')

@section('head')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/skins/skin-demo-4.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/demos/demo-4.css') }}">
@endsection
<style>
    #news_list:hover {
        transition: transform .3s;
        -ms-transform: scale(1.05);
        /* IE 9 */
        -webkit-transform: scale(1.05);
        /* Safari 3-8 */
        transform: scale(1.05);

    }

    .exp_slider img {
        width: 100%;
        max-height: 450px !important;
    }

    #exp_product_head h3 {
        font-weight: 500;
        line-height: 1.1;
        color: #333;
        /* letter-spacing: -0.02em; */
    }

    #news_dev h3 {
        font-weight: 500;
        line-height: 1.1;
        color: #333;

        /* letter-spacing: -0.02em; */
    }

    #brand_name h3 {
        font-weight: 500;
        line-height: 1.1;
        color: #333;
    }

    .news-toggle a:hover {
        color: #39f;
    }

    /* .news-toggle a:hover,
    .news-toggle a:focus,
    .news-toggle.active a {
        color: #39f;
    } */




    /* .carousel-item-img img {
        width: 100% !important;
        max-height: 550px !important;
    } */
    @media all and (min-width: 768px) {
        .carousel-item-img img {
            width: 100% !important;
            max-height: 570px !important;
        }
    }

    @media all and (min-width: 480px) {
        .carousel-item-img img {
            width: 100% !important;
            max-height: 550px !important;
        }
    }

    @media all and (min-width: 1200px) {
        .carousel-item-img img {
            width: 100% !important;
            max-height: 700px !important;
        }
    }


    .carousel-item-img img {
        width: 100%;
        max-height: 570px !important;
    }


    /* @media all and (max-height: 2160) and (min-height: 1800px) {
        .carousel-item-img img {
            width: 100% !important;
            max-height: 550px !important;
        }
    } */

    /* @media screen and (max-height: 1800px) {


        .carousel-item-img img {
            width: 100% !important;
            height: 580px !important;
        }
    } */

    @media screen and (min-height: 3600px) {

        .carousel-item-img img {
            width: 100% !important;
            height: 450px !important;
        }
    }
</style>

@section('content')
<main class="main" style="background-color:#f3f3f3">


    {{-- <div id="slider" class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
        data-owl-options='{"nav": false}'>
        @foreach ($sliders as $slider)
        <div class="intro-slide" style="background-image:url('{{ asset($slider->slider) }}');">
            <div class="container intro-content">
                <h4 class="intro-title"> {{ $slider->title }}</h4><!-- End .h3 intro-subtitle -->
                <h2 class="intro-title">{{ $slider->description }}</h2><!-- End .intro-title -->

            </div><!-- End .container intro-content -->
        </div><!-- End .intro-slide -->
        @endforeach


    </div><!-- End .owl-carousel owl-simple --> --}}
    <div id="myCarousel" class="carousel slide">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li class="item1 active"></li>
            <li class="item2"></li>
            <li class="item3"></li>
        </ul>
        @php
        $j = 1;
        @endphp
        <!-- The slideshow -->
        <div class="carousel-inner carousel-item-img" id="carousel-item-img">
            @foreach ($sliders as $slider)
            <div class="carousel-item{{ $j == 1 ? ' active' : '' }} ">
                <img src="{{ asset($slider->slider) }}" alt="Los Angeles">
            </div>
            {{ $j++ }}
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="javascript:void(0)">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="javascript:void(0)">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    {{-- <span class="slider-loader text-white"></span><!-- End .slider-loader --> --}}


    <div class="mb-3 mb-lg-2" id="exp"></div><!-- End .mb-3 mb-lg-5 -->

    {{-- <div class="mb-4"></div><!-- End .mb-4 --> --}}

    {{-- Categories --}}
    {{-- <div class="container">
        <h2 class="title-lg text-center mb-2">Categories</h2><!-- End .title-lg text-center -->

        <div class="row">
            @foreach ($categories as $category)
            <div class=" col-md-8 col-lg-4 col-xl-4">
                <div class="banner banner-display banner-link-anim">
                    <a href="#">
                        <img src="{{ asset($category->category_image) }}" class="img-fluid " alt="Banner">
                    </a>

                    <div class="banner-content banner-content-center">
                        <h2 class="banner-title text-white"><a href="#">{{ $category->category_name }}</a>
                        </h2>
                        <!-- End .banner-title -->
                        <a href="#" class="btn btn-outline-white banner-link">View<i
                                class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div>
            </div><!-- End .col-sm-6 col-lg-3 -->
            @endforeach

        </div><!-- End .row -->
    </div><!-- End .container --> --}}

    {{-- Categories --}}

    <div class="container" id="exp_product_head">
        <h3 class=" text-center" style="font-weight: bold;">EXPLORE OUR PRODUCTS</h3>

        <!-- End .title-lg text-center -->
        <div class="text-center mb-2 categories-menu">
            <a id="exp_feature_phn_btn" href="javascript: void(0)" style="background-color:#f3f3f3;
            color: black;
            border: 1px solid #f3f3f3;">FEATURE
                PHONE</a> |
            <a id="exp_smart_phn_btn" href="javascript: void(0)" style="background-color:#f3f3f3;
            color: black;
            border: 1px solid #f3f3f3;">SMARTPHONE</a>|
            <a id="exp_accessories_btn" href="javascript: void(0)" style="background-color:#f3f3f3;
            color: black;
            border: 1px solid #f3f3f3;">ACCESSORIES</a>
        </div>
        {{-- <div id="myCarousel" class="carousel slide">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li class="item1 active"></li>
                <li class="item2"></li>
                <li class="item3"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner" style="border-radius: 15px ; ">
                <div class="carousel-item active">
                    <img src="https://www.w3schools.com/bootstrap4/la.jpg" alt="Los Angeles" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://www.w3schools.com/bootstrap4/chicago.jpg" alt="Chicago" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://www.w3schools.com/bootstrap4/ny.jpg" alt="New York" width="1100" height="500">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div> --}}
        <div id="myCarousel" class="carousel slide">
            <div id="feature_phone_promo_slide">
                <!-- Indicators -->
                @php
                $i = 1;
                @endphp

                {{-- <ul class="carousel-indicators">

                    <li class="item1 active"></li>

                    <li class="item2"></li>
                    <li class="item3"></li>
                </ul> --}}

                <!-- The slideshow -->
                <div class="carousel-inner exp_slider" id="feature_phone_promo_slide_append"
                    style="border-radius: 20px ; ">
                    @foreach ($feature_promo_sliders as $feature_promo_slider)
                    <div class="carousel-item{{ $i == 1 ? ' active' : '' }} ">
                        <img src="{{ asset($feature_promo_slider->slider) }}" alt="Los Angeles">
                    </div>

                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>

                <!-- Left and right controls -->


                <a class="carousel-control-prev" href="#exp">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#exp">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div id="smart_phone_promo_slide">
                <div class="carousel-inner exp_slider" id="smart_phone_promo_slide_append"
                    style="border-radius: 20px ; ">
                    {{-- <div class="carousel-item active">
                        <img src="https://www.w3schools.com/bootstrap4/ny.jpg" alt="Los Angeles">
                    </div> --}}

                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#exp">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#exp">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div id="accessories_promo_slide">
                <div class="carousel-inner exp_slider" id="exp_slider" style="border-radius: 20px ; ">
                    <div class="carousel-item active">
                        <img src="uploads/accessories.jpeg" alt="Los Angeles">
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#exp">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#exp">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div><!-- End .container -->


    <div class="mb-2"></div><!-- End .mb-4 -->
    {{-- <div class="bg-light ">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="frontend/assets/images/demos/demo-4/banners/banner-1.png" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle"><a href="#">Smart Offer</a></h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title"><a href="#">Save $150 <strong>on Samsung <br>Galaxy
                                        Note9</strong></a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="frontend/assets/images/demos/demo-4/banners/banner-2.jpg" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle"><a href="#">Time Deals</a></h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title"><a href="#"><strong>Bose SoundSport</strong> <br>Time Deal
                                    -30%</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="frontend/assets/images/demos/demo-4/banners/banner-3.png" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle"><a href="#">Clearance</a></h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title"><a href="#"><strong>GoPro - Fusion 360</strong> <br>Save
                                    $70</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div> --}}
    <div class="blog-posts pt-2 pb-2">
        <div class="container">
            <div id="news_dev">
                <h3 class="text-center" style="font-weight: bold;">NEWS & EVENTS</h3>
            </div>
            <div class="text-center mb-2 news-toggle" style="font-weight: 600;
            font-size: 1.5rem;">
                <a id="news_feature_phn_btn" href="javascript: void(0)" style="background-color:#f3f3f3;
                color: black;
                border: 1px solid #f3f3f3;">FEATURE
                    PHONE</a> |
                <a id="news_smart_phn_btn" href="javascript: void(0)" style="background-color:#f3f3f3;
                color: black;
                border: 1px solid #f3f3f3;">SMARTPHONE</a>|
                <a id="news_accessories_btn" href="javascript: void(0)" style="background-color:#f3f3f3;
                color: black;
                border: 1px solid #f3f3f3;">ACCESSORIES</a><br>
                <a href="{{ url('/all-news') }}" style="background-color:#f3f3f3;
                 color: black;
                 border: 1px solid #f3f3f3;">ALL
                    NEWS</a>




            </div>

            {{-- <h2 class="title">News</h2><!-- End .title-lg text-center --> --}}



            <div class="mb-2"></div>

            <div id="feature_phone_news_div">
                <div class="row">
                    @foreach ($feature_phone_news as $news)
                    <div class="col-sm-6 col-md-4 col-lg-4 " style=" border-radius:15px!important ;">
                        <div style=" border-radius:15px!important ;  background-color:#54BEDC;margin-bottom: 3rem;"
                            id="news_list">
                            {{-- <figure "> --}}
                                    <div style=" background-color: #ccc; border-radius:10px!important ;">
                                <a href="{{ route('front.news.details', $news->id) }}">
                                    <img src="{{ asset($news->news_image) }}" class="img-fluid  mx-auto d-block"
                                        style="width: 376px; height:250px;  border-top-left-radius:10px; border-top-right-radius:10px!important ;"
                                        alt="image desc">
                                </a>
                        </div>
                        {{--
                        </figure><!-- End .entry-media --> --}}
                        <div class="entry-body" style="padding:1.6rem 2rem 1.8rem;">


                            <h3 class="entry-title">
                                <a href="{{ route('front.news.details', $news->id) }}">{{ $news->news_title }}</a>
                            </h3><!-- End .entry-title -->

                        </div><!-- End .entry-body -->


                    </div>

                </div>
                @endforeach


            </div>
        </div>

        <div id="smart_phone_news_div">
            <div class="row" id="smart_phone_news_append">
                <h3>test smart</h3>
            </div>
        </div>

        <div id="accessories_news_div">
            <div class="row" id="accessories_news_append">
                <h3>test access</h3>
            </div>
        </div>
        {{-- <h6> <a class="read-more" href="{{url('/all-news')}}" style="float: right; ">All News</a></h6> --}}


        <div class="owl-dots disabled"></div>
    </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
    </div>

    {{-- <div class="mb-3"></div><!-- End .mb-5 --> --}}


    {{-- <div class="mb-6"></div><!-- End .mb-6 --> --}}

    <div style="background-color:#f3f3f3">
        <div class="container">
            <div id="brand_name">
                <h3 class="text-center" style="font-weight: bold;">OUR BRANDS</h3>
            </div>

            {{-- <h6 class="title mt-2">Brands</h6><!-- End .title-lg text-center --> --}}
            <hr style="margin: 0">
            <div class="owl-carousel mt-2 owl-simple" data-toggle="owl" data-owl-options='{
                        "nav": false,
                        "dots": false,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            }
                        }
                    }'>
                @foreach ($brands as $brand)
                <a href="#" class="brand" style="margin-bottom: 30px;">
                    <img src="{{ asset($brand->brand_logo) }}" alt="Brand Name">
                </a>
                @endforeach


                {{-- <a href=" #" class="brand">
                    <img src="frontend/assets/images/brands/2.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/3.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/4.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/5.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/6.png" alt="Brand Name">
                </a> --}}
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div>

    {{-- <div class="mb-5" style="background-color:#f3f3f3!important;"></div><!-- End .mb-5 --> --}}

    {{-- <div class="mb-4"></div><!-- End .mb-4 --> --}}
    <div style="background-color:#f3f3f3">
        <div class="container">

        </div>
</main><!-- End .main -->

@endsection
@section('script')
{{-- <script src="frontend/homePage.js"></script> --}}
<script>
    var owl = $('#slider');
        owl.owlCarousel({
            // items:4,
            // items change number for slider display on desktop
            items: 1,
            loop: true,
            // margin:10,
            // autoplay:true,
            // autoplayTimeout:5000,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true

            // autoplayHoverPause:true,


        });


        $('#smart_phone_promo_slide').hide();
        $('#accessories_promo_slide').hide();
        $("#smart_phone_news_div").hide();
        $("#accessories_news_div").hide();
        $(document).ready(function() {

            // Activate Carousel
            $("#myCarousel").carousel();

            // Enable Carousel Indicators
            $(".item1").click(function() {
                $("#myCarousel").carousel(0);
            });
            $(".item2").click(function() {
                $("#myCarousel").carousel(1);
            });
            $(".item3").click(function() {
                $("#myCarousel").carousel(2);
            });

            // Enable Carousel Controls
            $(".carousel-control-prev").click(function() {
                $("#myCarousel").carousel("prev");
            });
            $(".carousel-control-next").click(function() {
                $("#myCarousel").carousel("next");
            });
        });

        $("#exp_feature_phn_btn").click(function() {
            $('#feature_phone_promo_slide').show();
            $('#smart_phone_promo_slide').hide();
            $('#accessories_promo_slide').hide();
        });
        $("#exp_smart_phn_btn").click(function() {
            $('#feature_phone_promo_slide').hide();
            $('#smart_phone_promo_slide').show();
            $('#accessories_promo_slide').hide();
            $('#smart_phone_promo_slide_append').empty();
            $.ajax({
                type: "get",
                url: "/get-front-smart-phone-promo-slider",
                contentType: false,
                processData: false,
                success: function(response) {
                    let i = 1;
                    let is_active;
                    console.log(response.data);
                    if (response.data == '') {
                        $('#smart_phone_promo_slide_append').append(' <div class="col-md-3">\
                    <h6>No Prouducts</h6>\
                </div>\
                ');

                    } else {
                        if (i == 1) {
                            is_active = ' active'
                        } else {
                            is_active = ''
                        }

                        $.each(response.data, function(key, item) {


                            $('#smart_phone_promo_slide_append').append(
                                '<div class="carousel-item' + is_active + '">\
                                        <img src="/' + item.slider + '" alt="Los Angeles">\
                                    </div>\
                                        ');

                            i++;
                        });

                    }

                }
            });
        });
        $("#exp_accessories_btn").click(function() {
            $('#feature_phone_promo_slide').hide();
            $('#smart_phone_promo_slide').hide();
            $('#accessories_promo_slide').show();
        });

        //NEWS & EVENTS
        $("#news_feature_phn_btn").click(function() {
            $("#feature_phone_news_div").show();
            $("#smart_phone_news_div").hide();
            $("#accessories_news_div").hide();

        });


        $("#news_smart_phn_btn").click(function() {
            $("#feature_phone_news_div").hide();
            $("#smart_phone_news_div").show();
            $("#accessories_news_div").hide();
            $("#smart_phone_news_append").empty();


            $.ajax({
                type: "get",
                url: "/get-front-smart-phone-news",
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log(response.data);
                    if (response.data == '') {
                        $('#smart_phone_news_append').append('<h6>No Prouducts</h6>\
                ');

                    } else {

                        $.each(response.data, function(key, item) {
                            $('#smart_phone_news_append').append(
                                '<div class="col-sm-6 col-md-4 col-lg-4 " style=" border-radius:15px!important ;">\
                            <div style=" border-radius:15px!important ;  background-color:#54BEDC;margin-bottom: 3rem;" id="news_list">\
                                        <div style=" background-color: #ccc; border-radius:10px!important ;">\
                                    <a href="/news-details/' + item.id + '">\
                                        <img src="' + item.news_image + '" class="img-fluid  mx-auto d-block" style="width: 376px; height:250px;  border-top-left-radius:10px; border-top-right-radius:10px!important ;" alt="image desc">\
                                    </a>\
                            </div>\
                            <div class="entry-body" style="padding:1.6rem 2rem 1.8rem;">\
                                <h3 class="entry-title">\
                                    <a href="/news-details/' + item.id + '">' + item.news_title + '</a>\
                                </h3>\
                            </div>\
                        </div>\
                    </div>\
                     ');

                        });

                    }

                }
            });
        });

        $("#news_accessories_btn").click(function() {
            $("#feature_phone_news_div").hide();
            $("#smart_phone_news_div").hide();
            $("#accessories_news_div").show();
            $("#accessories_news_append").empty();

            $.ajax({
                type: "get",
                url: "/get-front-accessories-news",
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log(response.data);
                    if (response.data == '') {
                        $('#accessories_news_append').append('<h6>No Prouducts</h6>\
                ');

                    } else {

                        $.each(response.data, function(key, item) {
                            $('#accessories_news_append').append(
                                '<div class="col-sm-6 col-md-4 col-lg-4 " style=" border-radius:15px!important ;">\
                            <div style=" border-radius:15px!important ;  background-color:#54BEDC;margin-bottom: 3rem;" id="news_list">\
                                        <div style=" background-color: #ccc; border-radius:10px!important ;">\
                                    <a href="/news-details/' + item.id + '">\
                                        <img src="' + item.news_image + '" class="img-fluid  mx-auto d-block" style="width: 376px; height:250px;  border-top-left-radius:10px; border-top-right-radius:10px!important ;" alt="image desc">\
                                    </a>\
                            </div>\
                            <div class="entry-body" style="padding:1.6rem 2rem 1.8rem;">\
                                <h3 class="entry-title">\
                                    <a href="/news-details/' + item.id + '">' + item.news_title + '</a>\
                                </h3>\
                            </div>\
                        </div>\
                    </div>\
                     ');

                        });

                    }

                }
            });
        });
</script>
@endsection
