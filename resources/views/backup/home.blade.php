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
    /* @media all and (min-width: 768px) {
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
    } */


    /* .carousel-item-img img {
        width: 100%;
        max-height: 570px !important;
    } */

    /* last added */

    /* @media only screen and (max-width: 600px) {
        .carousel-item>img {
            height: 300px !important;
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 768px) {
        .carousel-item>img {
            height: 680px !important;
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 900px) {
        .carousel-item>img {
            height: 950px !important;
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 1024px) {
        .carousel-item>img {
            height: 850px !important;
            width: 100% !important;
        }
    }

    @media only screen and (max-width:1280px) {
        .carousel-item>img {
            max-height: 80%;
            height: 600px !important;
            width: 100% !important;
        }
    } */
    @media only screen and (device-width : 768px) and (device-height:1024px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width : 1024px) and (device-height: 768px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width : 1280px) and (device-height: 1024px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width : 1280px) and (device-height: 800px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width : 1600px) and (device-height: 900px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1280px) and (device-height:720px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1440px) and (device-height:900px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1536px) and (device-height:864px) {
        .carousel-item>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1920px) and (device-height:1080px) {
        .carousel-item>img {
            max-height: 880px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1366px) and (device-height:768px) {
        .carousel-item>img {
            height: 570px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :2560px) and (device-height:1440px) {
        .carousel-item>img {
            height: 1100px !important;
            width: 100% !important;
        }
    }

    .exp-product-menu span:hover>button {
        color: #39f
            /* amigo:  #0069A7 */
            /* rgb(34, 34, 34)*/
    }

    .exp-product-menu span>button:focus {
        color: #39f
    }

    .news-menu span:hover>button {
        color: #39f
            /* amigo:  #0069A7 */
            /* rgb(34, 34, 34)*/
    }

    .news-menu span>button:focus {
        color: #39f
    }

    /* #all_new_hover:hover {
        color: #39f
    } */
    /* *,
    *:after,
    *:before {
        box-sizing: border-box;
    }

    .owl-centered .owl-stage {
        display: table !important;
    }

    .owl-centered .owl-item {
        display: table-cell;
        float: none;
        vertical-align: middle;
    }

    .owl-centered .owl-item>div {
        padding: 0 10px;
    } */
</style>

@section('content')
<main class="main" style="background-color:#f3f3f3">

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li class="item1 active" style="background-color:#39f;width:65px;"></li>
            <li class="item2" style="background-color:#39f;width:65px;"></li>
            <li class="item3" style="background-color:#39f;width:65px;"></li>
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



    <div class="mb-3 mb-lg-2" id="exp"></div><!-- End .mb-3 mb-lg-5 -->


    <div class="container" id="exp_product_head">
        <h3 class=" text-center" style="font-weight: bold;">EXPLORE OUR PRODUCTS</h3>

        <!-- End .title-lg text-center -->
        <div class="text-center mb-2 exp-product-menu" style="font-weight: 500;
        font-size: 1.5rem;">
            <span> <button id="exp_feature_phn_btn" style="background-color:#f3f3f3;

            border: 1px solid #f3f3f3;">FEATURE
                    PHONE</button> |</span>
            <span> <button id="exp_smart_phn_btn" style="background-color:#f3f3f3;

            border: 1px solid #f3f3f3;">SMARTPHONE</button>|</span>

            <span> <button id="exp_accessories_btn" style="background-color:#f3f3f3;

                border: 1px solid #f3f3f3;">ACCESSORIES</button></span>
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
        <div id="myCarousel_feature" class="carousel slide myCarousel_feature_phone" data-bs-ride="carousel">
            <div id="feature_phone_promo_slide">
                <!-- Indicators -->
                @php
                $i = 1;
                @endphp

                <!-- The slideshow -->
                <div class="carousel-inner exp_slider" id="feature_phone_promo_slide_append"
                    style="border-radius: 20px ; ">
                    @foreach ($feature_promo_sliders as $feature_promo_slider)
                    <div class="carousel-item{{ $i == 1 ? ' active' : '' }} ">
                        <a href="{{ url('/feature-phone') }}"> <img src="{{ asset($feature_promo_slider->slider) }}"
                                class="d-block w-100"></a>
                    </div>

                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>

                <!-- Left and right controls -->


                <a class="carousel-control-prev feature-phone-prv" id="feature-phone-prv" href="#exp" >
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next feature-phone-nxt" id="feature-phone-nxt" href="#exp">
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
                <div class="carousel-inner exp_slider" id="accessories_promo_slide_append" style="border-radius: 20px ; ">
                    {{-- <div class="carousel-item active">
                        <img src="uploads/accessories.jpeg" alt="Los Angeles">
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
        </div>
    </div><!-- End .container -->


    <div class="mb-2"></div><!-- End .mb-4 -->

    <div class="blog-posts pt-2 pb-2">
        <div class="container">
            <div id="news_dev">
                <h3 class="text-center" style="font-weight: bold;">NEWS & EVENTS</h3>
            </div>
            <div class="text-center mb-2 news-toggle news-menu" style="font-weight: 500;
            font-size: 1.5rem;">
                {{-- <span> <button id="news_feature_phn_btn" href="javascript: void(0)" style="background-color:#f3f3f3;

                border: 1px solid #f3f3f3;">FEATURE
                        PHONE</button> |</span>
                <span> <button id="news_smart_phn_btn" href="javascript: void(0)" style="background-color:#f3f3f3;

                border: 1px solid #f3f3f3;">SMARTPHONE</button>|</span>
                <span> <button id="news_accessories_btn" href="javascript: void(0)" style="background-color:#f3f3f3;

                border: 1px solid #f3f3f3;">ACCESSORIES</button></span><br> --}}

                {{-- <a id="all_new_hover" href="{{ url('/all-news') }}" style="background-color:#f3f3f3;color:#333;

                    border: 1px solid #f3f3f3;">ALL
                    NEWS</a> --}}
                <span><button id="all_new_hover" href="{{ url('/all-news') }}" style="background-color:#f3f3f3;

                    border: 1px solid #f3f3f3;">ALL
                        NEWS</button></span>




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
                                        style="width: 100%; height:250px;  border-top-left-radius:10px; border-top-right-radius:10px!important ;"
                                        alt="image desc">
                                </a>
                        </div>
                        {{--
                        </figure><!-- End .entry-media --> --}}
                        <div class="entry-body" style="padding:1.6rem 2rem 1.8rem;">


                            <h3 class="entry-title" style="color: #333;font-weight: 600;">
                                <a href="{{ route('front.news.details', $news->id) }}" style="color: #333">{{
                                    $news->news_title }}</a>
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

                <div style=" display: flex;align-items: center;justify-content: center;">
                    @foreach ($brands as $brand)
                    <a href="javascript:void(0)" class="brand text-center"
                        style="margin-bottom: 20px;margin-top: 15px; margin-left:2%;margin-right:2%">
                        <img src=" {{ asset($brand->brand_logo) }}" class=" mx-auto d-block" alt="Brand Name">
                    </a>
                    @endforeach
                </div>

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
            // autoplayHoverPause: false,

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

            // Activate Carousel feature phone
            $("#myCarousel_feature").carousel();

            // Enable Carousel Indicators
            // $(".feature-phone1").click(function() {
            //     $("#myCarousel_feature").carousel(0);
            // });
            // $(".feature-phone2").click(function() {
            //     $("#myCarousel_feature").carousel(1);
            // });
            // $(".feature-phone3").click(function() {
            //     $("#myCarousel_feature").carousel(2);
            // });

            // Enable Carousel Controls
            $("#feature-phone-prv").click(function() {

                $(".myCarousel_feature_phone").carousel("prev");
                $("#myCarousel").carousel('pause');
            });
            $("#feature-phone-nxt").click(function() {

                $(".myCarousel_feature_phone").carousel("next");
                $("#myCarousel").carousel('pause');
            });
        });


        $("#exp_feature_phn_btn").click(function() {
            $('#feature_phone_promo_slide').show('normal');
            $('#smart_phone_promo_slide').hide('slow').fadeOut(300);
            $('#accessories_promo_slide').hide('slow').fadeOut(300);
        });
        $("#exp_smart_phn_btn").click(function() {
            $('#feature_phone_promo_slide').hide('slow').fadeOut(300);
            $('#smart_phone_promo_slide').show().fadeIn(300);
            $('#accessories_promo_slide').hide('slow').fadeOut(300);
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
                                            <a href=' + '/smart-phone' + '><img src="/' + item.slider + '" alt="Los Angeles"></a>\
                                        </div>\
                                            ');

                            i++;
                        });

                    }

                }
            });
        });
        $("#exp_accessories_btn").click(function() {
            $('#feature_phone_promo_slide').hide('slow');
            $('#smart_phone_promo_slide').hide('slow');
            $('#accessories_promo_slide').show('normal');
            $('#accessories_promo_slide_append').empty();
            $.ajax({
                type: "get",
                url: "/get-front-accessories-promo-slider",
                contentType: false,
                processData: false,
                success: function(response) {
                    let i = 1;
                    let is_active;
                    console.log(response.data);
                    if (response.data == '') {
                        $('#accessories_promo_slide_append').append(' <div class="col-md-3">\
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


                            $('#accessories_promo_slide_append').append(
                                '<div class="carousel-item' + is_active + '">\
                                            <a href=' + '/accessories' + '><img src="/' + item.slider + '" alt="Los Angeles"></a>\
                                        </div>\
                                            ');

                            i++;
                        });

                    }

                }
            });
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
        $('#all_new_hover').click(function() {
            window.location.href = '/all-news'; //Will take you to Google.
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
