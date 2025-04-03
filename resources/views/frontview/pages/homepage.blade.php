@extends('frontview.layout.template')

@section('page-css')

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> --}}
    <!-- Link Swiper's CSS -->
    <style>
            .glyphicon
            {
                margin-right:4px !important;
            }

            .pagination .glyphicon
            {
                margin-right:0px !important;
            }

            .pagination a
            {
                color:#555;
            }

            .panel ul
            {
                padding:0px;
                margin:0px;
                list-style:none;
            }

            .news-item
            {
                padding:4px 4px;
                margin:0px;
                border-bottom:1px dotted #555;
            }
    </style>
@endsection
@section('page-title')

@endsection
@section('body-content')

    <main id="main">

        {{-- Banner Section --}}
        <!--<section id="banner">-->
        <!--    <div class="row">-->
        <!--        <div class="col-lg-12">-->
        <!--            <img src="{{ asset('frontview/img/banner.jpeg') }}" class="border" width="100%" height="120px" alt="">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

        {{-- News Ticker --}}
        <section id="news-ticker">
            {{-- <div style="padding: 32px;"></div> --}}
            {{-- <div class="container-fluid"> --}}
                <div class="ticker-wrap border">
                    <div class="ticker-heading">Recent News</div>
                    <div class="ticker">
                        @foreach ( App\Models\NewsTicker::where('speech_role', 'headlines')->where('status', 1)->latest()->take(3)->get() as $newsTicker )
                            <div class="ticker__item">
                                {{ $newsTicker->headline }}
                            </div>
                        @endforeach
                    </div>
                </div>
            {{-- </div> --}}
        </section>

        {{-- Slider Section --}}
        <section id="hero" style="padding-bottom: 70px">

            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    @foreach ($sliders as $slider )
                        <div class="carousel-item active" href="" style="background-image: url( {{ asset($slider->slider) }} )">
                            <div class="carousel-container">
                                <div class="container">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </section>

        {{-- <section>
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider )
                    <div class="swiper-slide"><img src="{{ asset($slider->slider) }}" alt=""></div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section> --}}

        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="padding-top: 70px">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center text-dark mb-2" style="color: black;">Notices & Speeches</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="col-md-12 mt-2 mb-2">
                        <div class="card text-dark text-center bg-light" style="align-content: center">
                            @foreach ( $advisors as $advisor )
                                <a href="{{ route('speechPage', $advisor->id) }}"><img src="{{ asset('images/news/' . $advisor->image ) }}" class="mx-auto d-block mt-3"  width="84px" alt="..."></a>
                                <div class="card-body">
                                    <b><strong class="card-title">{{ $advisor->role}} Speech</strong></b>
                                    <p class="card-text" style="font-size: 10px; font-weight: 500; text-align: left;">{{ substr($advisor->long_desc, 0, 100) }}<a href="{{ route('speechPage', $advisor->id) }}" class="text-danger">  Read more...</a></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="card text-dark text-center bg-light" style="align-content: center">
                            @foreach ( $presidents as $president )
                                <a href="{{ route('speechPage', $president->id) }}"><img src="{{ asset('images/news/' . $president->image ) }}" class="mx-auto d-block mt-3"  width="84px" alt="..."></a>
                                <div class="card-body">
                                    <b><strong class="card-title">President Speech</strong></b>
                                    <p class="card-text" style="font-size: 10px; font-weight: 500; text-align: left;">{{ substr($president->long_desc, 0, 100) }}<a href="{{ route('speechPage', $president->id) }}" class="text-danger">  Read more...</a></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card text-dark  text-center bg-light">
                            @foreach ( $secretaries as $secretary )
                                <a href="{{ route('speechPage', $secretary->id) }}"><img src="{{ asset('images/news/' . $secretary->image ) }}" class="mx-auto d-block mt-3"  width="84px" alt="..."></a>
                                <div class="card-body">
                                   <b> <strong class="card-title">Secretary Speech</strong></b>
                                    <p class="card-text" style="font-size: 10px; font-weight: 500; text-align: left;">{{ substr($secretary->long_desc, 0, 100) }}<a href="{{ route('speechPage', $secretary->id) }}" class="text-danger"> Read more...</a></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card p-5 text-dark bg-light mt-2">
                        @foreach ( $visions as $vision )
                            <a href="{{ route('noticePage', $vision->id) }}"><img src="{{ asset('images/news/' . $vision->image ) }}" class="mx-auto d-block mt-4"  width="200px" alt="..."></a>
                            <div class="card-body text-center">
                                <b><strong class="card-title">Mission And Vision</strong></b>
                                <p class="card-text" style="font-size: 12px; text-align: start;">
                                    {{ substr($vision->long_desc, 0, 1000) }} <a href="{{ route('noticePage', $vision->id) }}" class="text-danger"> Read more...</a>
                                </p>
                            </div>
                        @endforeach
                        {{-- @if ( $newsTicker= App\Models\NewsTicker::where('speech_role', 'Mission and Vision')->latest()->first() )
                            <a href=""><img src="{{ asset('images/news/' . $newsTicker->image ) }}" class="mx-auto d-block mt-4"  width="200px" alt="..."></a>
                            <div class="card-body text-center">
                                <b><strong class="card-title">Mission And Vision</strong></b>
                                <p class="card-text">
                                    {{ $newsTicker->long_desc }}
                                </p>
                            </div>
                        @endif --}}
                    </div>
                </div>
                {{-- <div class="col-lg-3 scroll">
                    <div class="card text-white bg-success">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Notice Board</h5>
                            @foreach ($accessories_promo_sliders as $notice )
                                <p class="card-text">
                                    {{ $notice->description }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-3">
                    <div class="panel panel-default mt-2">
                        <div class="panel-heading border py-1">
                            <span class="glyphicon glyphicon-list-alt"></span><i class="bi bi-card-list"></i><b> Notice Board</b>
                        </div>
                        <div class="panel-body border border-bottom-0">
                            <div class="row">
                                <div class="col-xs-12">
                                    <ul id="demo3">
                                        @foreach ( $notice_boards as $notice_board )
                                            <li class="news-item">
                                                <table cellpadding="4">
                                                    <tr>
                                                        <td><a href="{{ route('noticePage', $notice_board->id) }}"><img src="{{ asset('images/news/' . $notice_board->image) }}" width="200px" class="img-fluid px-2"></a></td>
                                                        <td style="font-size: 12px">{{ substr($notice_board->long_desc, 0, 300) }} <a href="{{ route('noticePage', $notice_board->id) }}" class="text-danger">Read more...</a></td>
                                                    </tr>
                                                </table>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer"></div>
                    </div>

                </div>
            </div>

        </div>
        </section><!-- End About Section -->

        <!-- ======= Clients Section ======= -->
        {{-- <section id="clients" class="clients section-bg">
        <div class="container">

            <div class="row">

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('frontview/img/clients/client-1.png') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('frontview/img/clients/client-2.png') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('frontview/img/clients/client-3.png') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('frontview/img/clients/client-4.png') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('frontview/img/clients/client-5.png') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('frontview/img/clients/client-6.png') }}" class="img-fluid" alt="">
            </div>

            </div>

        </div>
        </section><!-- End Clients Section --> --}}

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center text-dark mb-2" style="color: black;">Events</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $category )
                    <div class="col-lg-4 col-md-6">
                        <div class="card-group">
                            <div class="card ml-2 my-2 event">
                               <a href="{{ route('eventPage', $category->id) }}"><img src="{{ asset($category->category_image) }}" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                    <a href="{{ route('eventPage', $category->id) }}"><h5 class="card-title text-center">{{ $category->category_name }}</h5></a>
                                    <a href="{{ route('eventPage', $category->id) }}"><p class="card-text">{{ $category->desc }} <strong> Read more...</strong></p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        </section><!-- End Services Section -->

        <!-- ======= Portfolio Section ======= -->
        {{-- <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-app">App</li>
                    <li data-filter=".filter-card">Card</li>
                    <li data-filter=".filter-web">Web</li>
                    </ul>
                </div>
                </div>

                <div class="row portfolio-container">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-1.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 1</h4>
                        <p>App</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-1.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-2.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Web 3</h4>
                        <p>Web</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-2.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-3.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 2</h4>
                        <p>App</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-3.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-4.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Card 2</h4>
                        <p>Card</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-4.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-5.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Web 2</h4>
                        <p>Web</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-5.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-6.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 3</h4>
                        <p>App</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-6.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-7.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Card 1</h4>
                        <p>Card</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-7.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-8.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Card 3</h4>
                        <p>Card</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-8.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                    <img src="{{ asset('frontview/img/portfolio/portfolio-9.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Web 3</h4>
                        <p>Web</p>
                        <div class="portfolio-links">
                        <a href="{{ asset('frontview/img/portfolio/portfolio-9.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                </div>

            </div>
        </section><!-- End Portfolio Section --> --}}

    </main><!-- End #main -->
@endsection
@section('page-script')
    <script type="text/javascript">
        $(function () {
            $(".demo1").bootstrapNews({
                newsPerPage: 5,
                autoplay: true,
                pauseOnHover:true,
                direction: 'up',
                newsTickerInterval: 4000,
                onToDo: function () {
                    //console.log(this);
                }
            });

            $(".demo2").bootstrapNews({
                newsPerPage: 3,
                autoplay: true,
                pauseOnHover: true,
                navigation: false,
                direction: 'down',
                newsTickerInterval: 2500,
                onToDo: function () {
                    //console.log(this);
                }
            });

            $("#demo3").bootstrapNews({
                newsPerPage: 3,
                autoplay: true,
                newsTickerInterval: 2500,

                onToDo: function () {
                    //console.log(this);
                }
            });
        });
    </script>
@endsection
