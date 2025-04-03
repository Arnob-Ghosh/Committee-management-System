@extends('layouts.frontend.front-master')
@section('title', 'ARCHAEOLOGICAL MUSEUM')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/skins/skin-demo-4.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/demos/demo-4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" integrity="sha512-eMxdaSf5XW3ZW1wZCrWItO2jZ7A9FhuZfjVdztr7ZsKNOmt6TUMTQgfpNoVRyfPE5S9BC0A4suXzsGSrAOWcoQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
@endsection
<style>.google-map {
    padding-bottom: 30%;
    position: relative;

  }

  .google-map iframe {
    height: 85%;
    width: 100%;
    left: 0;
    top: 0;
    position: absolute;

  }</style>
<style>
    #news_list:hover {
        transition: transform .1s;
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
    .image-cropper {

    height: 180px;
    width: 70%;
    position: relative;
    overflow: hidden;
    border-radius: 50%;
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
            height: 60% !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width : 1024px) and (device-height: 768px) {
        .carousel-item>img {
            height: 60% !important;
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

    @media only screen and (device-width : 60%) and (device-height: 900px) {
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
        .carousel-item>a>img {
            height: 600px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1920px) and (device-height:1080px) {
        .carousel-item>a>img {
            max-height: 350px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :1366px) and (device-height:768px) {
        .carousel-item>a>img {
            height: 300px !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :2560px) and (device-height:1440px) {
        .carousel-item>img {
            height: 60% !important;
            width: 100% !important;
        }
    }
    @media only screen and (device-width :2048px) and (device-height:1080px) {
        .carousel-item>img {
            height: 60% !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :3840px) and (device-height:2160px) {
        .carousel-item>img {
            height: 60% !important;
            width: 100% !important;
        }
    }

    @media only screen and (device-width :4096px) and (device-height:2160px) {
        .carousel-item>img {
            height: 60% !important;
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
    .carousel img {

    margin: auto;


}


</style>
@section('content')
    <main class="main" style="background-color:#f3f3f3">

        {{-- <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

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
    </div> --}}

<div id="demo2" class="carousel slide" data-ride="carousel">
    <!-- The slideshow -->
    @php
        $j = 1;
    @endphp
    <div class="carousel-inner">
        @foreach ($sliders as $slider)
            <div class="carousel-item{{ $j == 1 ? ' active' : '' }}">
                <a href="{{$slider->slider_url}}"><img src="{{asset($slider->slider)}}" alt=""></a>
            </div>
            @php
            $j++ ;
            @endphp
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo2" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo2" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>




{{-- <hr style="margin-top:0px;"> --}}

        {{-- <div class="mb-3 mb-lg-2" id="exp"></div><!-- End .mb-3 mb-lg-5 --> --}}
        <div class="container-fluid  my-3 ">
            <div class="row">

                <div class="col-12">
            <h2 class="text-center"style="font-family: Times New Roman;">About Us</h2>
            <p class="h5 pb-1 justify-content-center " style="font-family: Times New Roman; word-spacing: 3px;">The Archaeological Museum offers a unique and engaging
                experience for all. We are dedicated to educating, inspiring and preserving the rich
                history of archaeology. From spectacular artifacts to interactive displays, there is something for everyone.
                Our mission is to share the stories of the past in order to better understand the
                present and build a more knowledgeable future. Our experienced staff are passionate about the field
                and strive to create an enjoyable and educational environment for all. Visit us today and explore the wonders of archaeology.
                 </p>
               <div class="d-flex justify-content-center">
        <a href="{{url('/about-us')}}" class="btn btn-dark text-center">VIEW DETAILS</a>
    </div>
                </div>
            </div>
        </div>
        {{-- <hr> --}}

        <div class="container-fluid " id="exp_product_head">
            <h3 class=" text-center mt-8 mb-2" style="font-weight: bold;">COLLECTIONS</h3>
            <div class="row">
                <div class=" mt-1"></div>
                @foreach ($categories as $categories)
                    <div class="col-sm-4 col-md-3 col-lg-3 col-12   ">
                        <div id="news_list">

                            <div class="card bg-transparent ">

                                <a href="/collection/{{$categories->category_name}}">
                                    <img src="{{ asset($categories->category_image) }}"
                                        style="width: 80%; height:160px; margin:auto;"
                                        alt="image desc">
                                </a>
                            </div>

                            <div class="entry-body" style="height:76px;">


                                <h3 class="entry-title text-center mt-1" style="color: #333;font-weight: 600;">

                                    <a  href="/collection/{{$categories->category_name}}"
                                        style="text-transform: capitalize; color: #333;" class="text-center ">{{$categories->category_name}}</a>
                                </h3><!-- End .entry-title -->
                                <h6>{{$categories->desc}}</h6>

                            </div><!-- End .entry-body -->


                        </div>

                    </div>
                @endforeach


            </div>




        </div><!-- End .container -->

{{-- <hr style="margin-top:-2px"> --}}


        <div class="blog-posts ">
            <div class="container-fluid" style="background-color:#ffffff; width: 100%;">
                <div id="news_dev">
                    <h3 class="text-center mt-3" style="font-weight: bold;">EXIBITIONS</h3>
                </div>
                <div class="text-center mb-2 news-toggle news-menu"
                    style="font-weight: 500;
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
                    <span><a id="all_new_hover" href="{{ url('/all-exibition') }}"
                            style="background-color:#ffffff text-color:black;">ALL EXIBITIONS</a></span>




                </div>


                <div id="feature_phone_news_div" style="margin-top:3px;">
                    <div class="row">
                        @foreach ($accessories_promo_sliders as $accessories_promo_sliders)
                            <div class="col-sm-3 col-md-3 col-lg-3 mb-3">
                                <div style="   background-color:#ffffff; "
                                    id="news_list">
                                    {{-- <figure "> --}}
                                    <div style=" background-color:#ffffff;">
                                        {{-- {{ route('front.news.details', $accessories_promo_sliders->id) }} --}}
                                        <a href="{{ route('front.exibition.details', $accessories_promo_sliders->id) }}">
                                            <img src="{{ asset($accessories_promo_sliders->thumbnail) }}" class="img-fluid  mx-auto d-block"
                                                style="width: 100%; height:180px; margin:auto;"
                                                alt="image desc">
                                        </a>
                                    </div>
                                    {{--
                        </figure><!-- End .entry-media --> --}}
                                    <div class="entry-body" style="padding:1.6rem 2rem 1.8rem;height:76px;">


                                        <h3 class="entry-title text-justify" style="color: #333;font-weight: 600;">
                                            {{-- {{ route('front.news.details', $news->id) }} --}}
                                            <a href="{{ route('front.exibition.details', $accessories_promo_sliders->id) }}"
                                                style="color: #333">{{ $accessories_promo_sliders->title }} </a>
                                        </h3><!-- End .entry-title -->
                                        <h6>{{Carbon\Carbon::parse($accessories_promo_sliders->start_date)->format('j F Y')}} - {{Carbon\Carbon::parse($accessories_promo_sliders->end_date)->format('j F Y')}}</h5>

                                    </div><!-- End .entry-body -->


                                </div>

                            </div>
                        @endforeach


                    </div>
                </div>


            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->

        {{-- <hr style="margin-bottom:-2px; margin-top:-2px;"> --}}
        <div style="background-color:#ffffff">
            <div class="container-fluid " style="margin-left:0px; margin-right:0px;">
                <div class="">
                <div id="brand_name">
                    <h3 class="text-center  py-3" style="font-weight: bold;">FIND US</h3>
                </div>

                <div class="google-map" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1830.510498059399!2d91.13632457685517!3d23.42360869739969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37547e7fae2b56cd%3A0xe49f0defe18cf32a!2sMainamati%20Museum!5e0!3m2!1sen!2sbd!4v1687777473276!5m2!1sen!2sbd" width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
            </div><!-- End .owl-carousel -->
            </div>
        </div><!-- End .container -->
{{-- <hr style="margin-bottom:-1px; margin-top:12px;"> --}}
    </main><!-- End .main -->

@endsection
@section('script')

    <script>

$( document ).ready(function() {
    $("#demo2").carousel();
});

//     $('#all_new_hover').click(function() {
//     window.location.href = '/all-exibition'; //Will take you to Google.
// });


    </script>
@endsection
