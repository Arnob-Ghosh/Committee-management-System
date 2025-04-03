@extends('frontview.layout.template')

@section('page-css')

@endsection
@section('page-title')

@endsection
@section('body-content')
     <!-- ======= Header ======= -->
  {{-- <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Sailor</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html">Home</a></li>

          <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="about.html">About</a></li>
              <li><a href="team.html">Team</a></li>
              <li><a href="testimonials.html">Testimonials</a></li>

              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li><a href="blog.html" class="active">Blog</a></li>

          <li><a href="contact.html">Contact</a></li>
          <li><a href="index.html" class="getstarted">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header --> --}}

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Event Details</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="">Event Page</a></li>
            {{-- <li>Blog Single</li> --}}
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    {{-- <section id="hero" style="padding-bottom: 70px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

                        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                        <div class="carousel-inner" role="listbox">

                            <!-- Slide 1 -->
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
                </div>
            </div>
        </div>
    </section><!-- End Hero --> --}}
    <section id="" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card w-100 mb-3">
                        <img src="{{ asset( $category->category_image ) }}" class="" height="600px" alt="...">
                    </div>

                </div><!-- End blog entries list -->
            </div>
        </div>
    </section>

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-12 entries">

                <article class="entry entry-single">

                    {{-- <div class="entry-img">
                        <img src="{{ asset( $category->category_image ) }}" alt="" width="300" height="300" class="img-fluid mt-4" style="margin-left: 28px">
                    </div> --}}

                    {{-- <div class="entry-img">
                        <img src="{{ asset($category->category_image) }}" alt="" class="">
                    </div> --}}

                    <h2 class="entry-title">
                        <a href="blog-single.html">{{ $category->category_name }}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="">Event</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href=""><time datetime="2020-01-01">{{ date('M d, Y', strtotime($category->created_at)) }}</time></a></li>
                        {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li> --}}
                        </ul>
                    </div>

                    <div class="entry-content">
                        <p>
                            {!! $category->description !!}
                        </p>

                    </div>

                </article><!-- End blog entry -->

            </div><!-- End blog entries list -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->

@endsection
@section('page-script')

@endsection
