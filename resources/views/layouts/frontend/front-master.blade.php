<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
    <meta name="description" content="@yield('meta_description','default description')">
    {{-- <meta name="keywords" content="HTML5 Template">
    <meta name="Amigo Alliance BD"
        content="Amigo Alliance BD designs and manufactures affordable, elegant, and innovative mobile devices focusing on satisfying the needs of day-to-day usage."> --}}
    <title>@yield('title')</title>

    <meta name="author" content="p-themes">
    <!-- Favicon -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/images/icons/logo_govt.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frontend/assets/images/icons/logo_govt.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('frontend/assets/images/icons/logo_govt.png') }}">
    <link rel="manifest" href="{{ asset('frontend/assets/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ asset('frontend/assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/icons/logo_govt.png') }}">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="application-name" content="">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('frontend/assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/jquery.countdown.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/demos/demo-11.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    @yield('head')

    <style>
        /* .dropdown .dropbtn {
  font-size: 16px;
  border: transparent;
  outline: transparent;
  color: white;
  margin: 0; /* Important for vertical align on mobile phones
} */
                    /* hr {
            border: 20px solid#609513 !important;
            border-radius: 1px;
            } */
        .categories-menu span:hover>button,
        .categories-menu span.show>button,
        .categories-menu span:active>button {
            color: #39f
                /* amigo:  #0069A7 */
                /* rgb(34, 34, 34)*/

        }

        .categories-menu span>button:focus {
            color: #39f
        }

        /* .header-7:hover {

            background-color: black;


        } */
        .widget-list li {
            margin-top: 2% !important;
            margin-bottom: -2% !important;
            padding: 0px !important;
        }

        /* .widget-list li>a {
            margin-top: 0% !important;
            margin-bottom: -3% !important
        } */
        

        @media screen and (min-width: 826px) {
            .footer-copyright {
                position: relative;
                text-align: center;
                font-weight: 900 !important;
                color: #0085B8;

            }
            .fotter-details-text{
                font-size: 1.6rem!important;
            }
        }

        @media screen and (max-width:825px) {
            .footer-copyright {
                position: relative;
                font-size: 1.1rem;
                text-align: center;
                font-weight: 600 !important;
                color: #0085B8;
            }
            .fotter-details-text{
                font-size: 1.2rem!important;
            }
        }

        @media screen and (max-width: 650px) {
            .footer-copyright {
                position: relative;
                text-align: center;
                font-size: 0.9rem;

                font-weight: 200 !important;
                color: #0085B8;
            }
        }

        @media screen and (max-width:529px) {
            .footer-copyright {
                position: relative;
                font-size: 0.7rem;
                text-align: center;
                font-weight: 600 !important;
                color: #0085B8;
            }
        }
        @media screen and (max-width:414px) {
            .footer-copyright {
                position: relative;
                font-size: 0.5rem;
                text-align: center;
                font-weight: 600 !important;
                color: #0085B8;
            }
        }
    </style>
</head>

<body>
    {{-- @php
    $career_url="abc";
        foreach ($career_link as $link) {
         $career_url= $link->url;
        };
    @endphp --}}
    <div class="page-wrapper">

        <header class="header header-7" id="header-7">
            <div class="header-middle sticky-header">
                <div class="container-fluid">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle  menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('frontend/assets/images/logo/museum11.png') }}" id="logo-img1"
                                alt="logo" width="300">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li>
                                    <a class="sf-with-ul-single" href="{{ url('/') }}">HOME</a>


                                </li>

                                <li class="megamenu-container ">
                                    <a class="sf-with-ul-single" href="{{url('/about-us')}}">ABOUT</a>





                                    {{-- <a href="{{ url('/collections') }}" class="sf-with-ul-single">COLLECTION</a> --}}
                                </li>
                                <li>
                                    <li>
                                        <a href="/collections" class="sf-with-ul-single" >COLLECTION</a>

                                        <!--<ul  style="border-bottom-right-radius: 10px ;border-bottom-left-radius: 10px ; ">-->

                                        <!--    {{-- <li><a href="/collection/terracotta"-->
                                        <!--            style="font-size: 1.4rem!important;font-weight: 500 !important;">TERAACOTTA</a></li>-->
                                        <!--    <li><a href="/collection/sculpture"-->
                                        <!--            style="font-size: 1.4rem!important;font-weight: 500 !important;">SCULPTURE</a>-->
                                        <!--    </li> --}}-->


                                        <!--</ul>-->
                                    </li>

                                </li>
                                <li>
                                    <a href="{{ url('/all-exibition') }}" class="sf">EXIBITION</a>

                                </li>
                                <li>
                                <a href="{{ url('/contact-us') }}" class="sf">CONTACT</a></li>



                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->





                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-csart"></i>

                            </a>

                        </div><!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->


        @yield('content')

        <footer class="footer" style="background-color:#dedede ">

            <div>
                <div class="container">
                    <div class="row" style="margin-left:-1px;margin-right-1px;">

                        <div class="col-sm-6 col-lg-4 col-md-4 col-6 mt-0">
                            <div class="widget ">
                                <h1 class="widget-title text-center"
                                   >
                                </h1>


                                <!-- End .widget-title -->

                                <ul class="widget-list" >
                                    <li style=" font-weight: bolder;!important;font-size:1.9rem!important;"><b>
                                        MENU</b></li>

                                    <li><a href="{{ url('about-us') }}"><li><a href="{{ url('about-us') }}">ABOUT US</a></li></a></li>


                                    <li><a href="{{ url('') }}">EXIBITION</a></li>
                                    <li><a href="{{ url('contact-us') }}">CONTACT</a></li>


                                   

                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div>
                        <div class="col-sm-6 col-lg-4 col-md-4 col-6 mt-0">
                            <div class="widget ">
                                <h1 class="widget-title text-center"
                                    style=" font-weight: bolder;!important;font-size:1.9rem!important;">
                                    <b></b>
                                    {{-- <div class="text-center">
                                        <img src="{{ asset('frontend/assets/images/logo/support.jpg') }}"
                                            style="display: block;
                                        margin-left: auto;
                                        margin-right: auto;">
                                    </div> --}}


                                </h1>

                                <!-- End .widget-title -->

                                <ul  class="widget-list">
                                    {{-- <li ><a href="{{ url('warranty-policy') }}">SUPPORT</a></li> --}}
                                    <li style=" font-weight: bolder;!important;font-size:1.9rem!important;"><b>
                                        OPENING HOURS</b></li>
                                    <li>Tue - Sat: 9am - 5pm</li>
                                    <li>Mon: 2pm - 5pm</li>
                                    <li>Sun: Closed</li>


                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->


                        <div class="col-sm-6 col-lg-4 col-md-3 col-6  mt-0">
                            <div class="widget ">
                                <h1 class="widget-title text-center"
                                    style=" font-weight: bolder;!important;font-size:1.9rem!important;">
                                    
                                </h1>
                                <!-- End .widget-title -->

                                <ul class="widget-list" >
                                    <li style=" font-weight: bolder;!important;font-size:1.9rem!important;"><b>
                                       FOLLOW US</b></li>
                                    <li><a href="{{ url('#') }}"
                                            style="margin:0px !important">Facebook</a></li>
                                    <li><a href="{{ url('#') }}">Instagram</a>
                                    </li>
                                    <li><a href="#">Linkedin</a></li>
                                    {{-- <li><a href="faq.html">FAQ</a></li> --}}

                                </ul><!-- End .widget-list -->

                            </div><!-- End .widget -->

                        </div><!-- End .col-sm-6 col-lg-3 -->

                    </div><!-- End .row -->
                    <div class="text-center fotter-details-text" style="text-align: center">
                        <img src="{{ asset('frontend/assets/images/icons/logo_govt.png') }}"
                            alt="" width="100" height="20"
                            style=" display: block;
                            margin-left: auto;
                            margin-right: auto;
                            margin-top: -15px;
                            margin-bottom: 2px;">
                        <span > Mainamati Archaeological Museum <span></span>
                            department of Archaeology</span>

                        <div class="mb-1"></div>
                        <span>Mainamati Archaeological Museum
                            department of Archaeology
                            Regional Directorate Office
                            chattagram and Sylhet Division,Cumilla 3503.</span><br>
                        <span> <b>E-mail:</b> rd_chittagong@archaeology.gov.bd &nbsp; <b>Call Us:</b> +88 02 33 44 37089</span>
                        {{-- <span style="font-size: 1.6rem;">E-mail:
                        </span> --}}

                    </div>
                    <br>


                </div><!-- End .container -->

            </div><!-- End .footer-middle -->
            <div>
                <div class="footer-copyright" style=" background-color: #776c6c;">
                    {{-- <img src="{{ asset('frontend/assets/images/logo/Copyright-banner.png') }}" class="img-fluid"
                        alt="..."> --}}
                    <div style="position: relative; color:rgb(255, 255, 255);"> COPYRIGHT
                        &copy; @php
                            $thisYear = (int) date('Y');

                            echo $thisYear;
                        @endphp Mainamati Archaeological Museum
                    department of Archaeology ALL RIGHTS RESERVED</div>
                </div>
            </div>

        </footer><!-- End .footer -->

    </div><!-- End .page-wrapper -->
    <!--<button id="scroll-top" class="btn bg-transparent"  title="Back to Top" > <img-->
    <!--        src="{{ asset('frontend/assets/images/logo/UP.png') }}"-->
    <!--        id="logo-img" alt="Logo" width="50px"></button>-->

            <div class="mobile-menu-container mobile-menu-light">
                <div class="mobile-menu-wrapper">
                    <span class="mobile-menu-close"><i class="icon-close"></i></span>

                    {{-- <form action="#" method="get" class="mobile-search">
                        <label for="mobile-search" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                            placeholder="Search in..." required>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </form> --}}

                    <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                                role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane  show active" id="mobile-menu-tab" role="tabpanel"
                            aria-labelledby="mobile-menu-link">
                            <nav class="mobile-nav" >
                                <ul class="mobile-menu">
                                    <li class="active">
                                        <a href="{{ url('/') }}">HOME</a>


                                    </li>

                                    <li>
                                        <a href="{{ url('/collections') }}"  style="color:rgb(0, 0, 0);">Collection</a>
                                        
                                    </li>
                                    <li>
                                        <a href="{{ url('/about-us') }}">About</a>
                                    </li>
                                    <li>
                                        <a href="/all-exibition">Exibition</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('contact-us') }}">CONTACT</a>
                                    </li>

                                </ul>
                            </nav><!-- End .mobile-nav -->
                        </div><!-- .End .tab-pane -->

                    </div><!-- End .tab-content -->

                    {{-- <div class="social-icons">
                        <a href="https://www.facebook.com/AmigoAllianceBD" class="social-icon" target="_blank"
                            title="Facebook"><i class="icon-facebook-f"></i></a>


                        <a href="https://www.instagram.com/amigoalliancebd" class="social-icon" target="_blank"
                            title="Instagram"><i class="icon-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/amigo-alliance-bd" class="social-icon social-linkedin"
                            title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>

                    </div><!-- End .social-icons --> --}}
                </div><!-- End .mobile-menu-wrapper -->
            </div><!-- End .mobile-menu-container -->




         
    <!-- Plugins JS File -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"> </script> --}}
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/demos/demo-4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/frontend/frontEndMaster.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $.ajax({
            type: "get",
            url: "/cat",


            success: function (response) {
                //console.log(response)
                $.each(response.category, function(id,category) {
                    //console.log(category)
                    $('#col').append(' <li><a href="/collection/'+category.category_name+'"style="font-size: 1.4rem!important;font-weight: 500 !important;">'+category.category_name+'</a></li>')
                    $('#coll').append(' <li><a href="/collection/'+category.category_name+'"style="font-size: 1.4rem!important;font-weight: 500 !important;">'+category.category_name+'</a></li>')
                });
            }
        });
        });

    </script>


   @yield('script')

</body>




</html>
