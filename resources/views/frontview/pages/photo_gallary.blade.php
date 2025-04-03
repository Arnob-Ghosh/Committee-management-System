@extends('frontview.layout.template')

@section('page-css')
    {{-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js'></script> --}}
    {{-- <title>Photo Gallary</title> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root {
        --lightbox: rgb(0 0 0 / 0.75);
        --carousel-text: #fff;
        }
        a {
            text-decoration: none;
            color: #000;
        }

        body {
            /* margin: 1.5rem 0 3.5rem; */
            background-color: white;
            color: #000;
        }

        @keyframes zoomin {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .gallery-item {
            display: block;
        }

        .gallery-item img {
            box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.2s;
        }

        .gallery-item:hover img {
            box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.35);
        }

        .lightbox-modal .modal-content {
            background-color: var(--lightbox);
        }

        .lightbox-modal .btn-close {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            font-size: 1.25rem;
            z-index: 10;
            filter: invert(1) grayscale(100);
        }

        .lightbox-modal .modal-body {
            display: flex;
            align-items: center;
            padding: 0;
        }

        .lightbox-modal .lightbox-content {
            width: 100%;
        }

        .lightbox-modal .carousel-indicators {
            margin-bottom: 0;
        }

        .lightbox-modal .carousel-indicators [data-bs-target] {
            background-color: var(--carousel-text) !important;
        }

        .lightbox-modal .carousel-inner {
            width: 75%;
        }

        .lightbox-modal .carousel-inner img {
            animation: zoomin 10s linear infinite;
        }

        .lightbox-modal .carousel-item .carousel-caption {
            right: 0;
            bottom: 0;
            left: 0;
            padding-bottom: 2rem;
            background-color: var(--lightbox);
            color: var(--carousel-text) !important;
        }

        .lightbox-modal .carousel-control-prev,
        .lightbox-modal .carousel-control-next {
            width: auto;
        }

        .lightbox-modal .carousel-control-prev {
            left: 1.25rem;
        }

        .lightbox-modal .carousel-control-next {
            right: 1.25rem;
        }

        @media (min-width: 1400px) {
            .lightbox-modal .carousel-inner {
                max-width: 60%;
            }
        }

        [data-bs-theme = "dark"] .lightbox-modal .carousel-control-next-icon,
        [data-bs-theme = "dark"] .lightbox-modal .carousel-control-prev-icon {
            filter: none;
        }

        /* (1) Change buttons (excluding active or disabled)*/
        .pagination>li>a {
            background-color: #ADD8E6;
            border-color: #F0F8FF;
            color: #000000;
        }

        /* (2) Change disabled buttons*/
        .pagination>.disabled>a,
        .pagination>.disabled>a:hover,
        .pagination>.disabled>a:focus {
            background-color: #E0FFFF;
            border-color: #F0F8FF;
            color: #000000;
        }

        /* (3) Change active or hover button color*/
        .pagination>.active>a,
        .pagination>.active>a:hover,
        .pagination>.active>a:focus,
        .pagination>li>a:hover,
        .pagination>li>a:focus {
            background-color: #87CEFA;
            border-color: #F0F8FF;
            color: #000000;
        }

    </style>
@endsection
@section('page-title')

@endsection
@section('body-content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Photo Gallery</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="blog.html">Gallery Page</a></li>
            {{-- <li>Blog Single</li> --}}
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="photo-gallery">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 gallery-grid">
                @foreach ( $photoGallaries as $photoGallary )
                    <div class="col">
                        <a class="gallery-item" href="{{ asset('images/gallary/' . $photoGallary->image) }}">
                        <img src="{{ asset('images/gallary/' . $photoGallary->image) }}" class="img-fluid" width="600px" height="400px" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {!! $photoGallaries->links('vendor.pagination.custom') !!}
            </div>

        </div>
        {{-- {{ $photoGallaries->links() }} --}}
    </section>

    <div class="modal fade lightbox-modal" id="lightbox-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="lightbox-content">
                <!-- JS content here -->
                </div>
            </div>
            </div>
        </div>
    </div>

    <section class="photo-link">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-hover table-bordered">
                        <thead class="table-success">
                          <tr>
                            <th scope="col">#SL.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Photo Link</th>
                          </tr>
                        </thead>
                        <tbody class="table-light">
                            @foreach ( $photoLinks as $key => $photoLink )
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $photoLink->title }}</td>
                                    <td>{{ $photoLink->date }}</td>
                                    <td><a href="{{ $photoLink->photo_link }}" target=”_blank” >Photo Link <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
@section('page-script')
    <script>
        const html = document.querySelector('html');
        html.setAttribute('data-bs-theme', 'dark');

        const galleryGrid = document.querySelector(".gallery-grid");
        const links = galleryGrid.querySelectorAll("a");
        const imgs = galleryGrid.querySelectorAll("img");
        const lightboxModal = document.getElementById("lightbox-modal");
        const bsModal = new bootstrap.Modal(lightboxModal);
        const modalBody = lightboxModal.querySelector(".lightbox-content");

        function createCaption (caption) {
            return `<div class="carousel-caption d-none d-md-block">
                <h4 class="m-0">${caption}</h4>
                </div>`;
        }

        function createIndicators (img) {
            let markup = "", i, len;

            const countSlides = links.length;
            const parentCol = img.closest('.col');
            const curIndex = [...parentCol.parentElement.children].indexOf(parentCol);

            for (i = 0, len = countSlides; i < len; i++) {
                markup += `
                <button type="button" data-bs-target="#lightboxCarousel"
                    data-bs-slide-to="${i}"
                    ${i === curIndex ? 'class="active" aria-current="true"' : ''}
                    aria-label="Slide ${i + 1}">
                </button>`;
            }

            return markup;
        }

        function createSlides (img) {
            let markup = "";
            const currentImgSrc = img.closest('.gallery-item').getAttribute("href");

            for (const img of imgs) {
                const imgSrc = img.closest('.gallery-item').getAttribute("href");
                const imgAlt = img.getAttribute("alt");

                markup += `
                <div class="carousel-item${currentImgSrc === imgSrc ? " active" : ""}">
                    <img class="d-block img-fluid w-100" src=${imgSrc} alt="${imgAlt}">
                    ${imgAlt ? createCaption(imgAlt) : ""}
                </div>`;
            }

            return markup;
        }

        function createCarousel (img) {
            const markup = `
                <!-- Lightbox Carousel -->
                <div id="lightboxCarousel" class="carousel slide carousel-fade" data-bs-ride="true">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    ${createIndicators(img)}
                </div>
                <!-- Wrapper for Slides -->
                <div class="carousel-inner justify-content-center mx-auto">
                    ${createSlides(img)}
                </div>
                <!-- Controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
                `;

            modalBody.innerHTML = markup;
        }

        for (const link of links) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const currentImg = link.querySelector("img");
                const lightboxCarousel = document.getElementById("lightboxCarousel");

                if (lightboxCarousel) {
                const parentCol = link.closest('.col');
                const index = [...parentCol.parentElement.children].indexOf(parentCol);

                const bsCarousel = new bootstrap.Carousel(lightboxCarousel);
                bsCarousel.to(index);
                } else {
                createCarousel(currentImg);
                }

                bsModal.show();
            });
        }
    </script>
@endsection
