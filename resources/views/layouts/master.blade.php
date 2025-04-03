<!-- {{ asset('dist/js/adminlte.js') }} -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/govlogo.jpg') }}" type="image/icon type">

    <style type="text/css">
        .action-bar ul {
            padding: 0;
        }
        .action-bar ul li {
            list-style: none;
            display: inline;
            margin: 0px 5px;
        }

        .pos-card-text-title {
            font-size: 16px;
            font-weight: ;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .pos-card-text-body {
            font-size: 14px;
            font-weight: normal;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .round {
            position: relative;
        }

        .round label {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 50%;
            cursor: pointer;
            height: 28px;
            left: 0;
            position: absolute;
            top: 0;
            width: 28px;
        }

        .round label:after {
            border: 2px solid #fff;
            border-top: none;
            border-right: none;
            content: "";
            height: 6px;
            left: 7px;
            opacity: 0;
            position: absolute;
            top: 8px;
            transform: rotate(-45deg);
            width: 12px;
        }

        .round input[type="checkbox"] {
            visibility: hidden;
        }

        .round input[type="checkbox"]:checked+label {
            background-color: #66bb6a;
            border-color: #66bb6a;
        }

        .round input[type="checkbox"]:checked+label:after {
            opacity: 1;
        }

        i.fax {
            display: inline-block;
            background-color: #ededed;
            border-radius: 60px;
            box-shadow: 0 0 2px #ededed;
            padding: 0.8em 0.9em;


        }

        body {
            font-size: 3.2vw;
        }
    </style>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Bootstrap 5 -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.min.css.map') }}">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous"> --}}


    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Data table -->

    <link rel="stylesheet" href="{{ asset('dataTable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dataTable/Buttons-2.2.2/css/buttons.bootstrap5.min.css') }}">



    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">


    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Select2 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-select.min.css') }}">

    {{-- Jquery Date Picker CSS --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


    <!-- DataTable -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.css"/>
 -->
    {{--
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" /> --}}

    <!-- PrintJS -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('https://printjs-4de6.kxcdn.com/print.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('dist/css/print.min.css') }}">

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput-rtl.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- jquery loader -->
    <link rel="stylesheet" href="{{ asset('loader/css/jquery.loadingModal.min.css') }}">
    <link rel="stylesheet" href="{{ asset('loader/scss/jquery.loadingModal.scss') }}">

    <!-- Pace  -->
    <link rel="stylesheet" href="{{ asset('pace/css/pace-theme-flat-top.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('pace/css/pace-theme-loading-bar.css') }}"> -->

    <!-- jQuery treeview -->
    <!-- <link rel="stylesheet" href="{{ asset('dist/css/bstreeview.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('dist/themes/default/style.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('dist/themes/default-dark/style.min.css') }}" /> -->

    <!-- JQUERY -->
    <script src="{{ asset('dist/js/jquery 3.5.1/jquery.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr/toastr.css')}}">
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> --}}

    <!-- Year Picker CSS -->
    <link rel="stylesheet" href="{{ asset('frontview/yearpicker/year.css') }}"/>
    <!-- Year Picker Js -->
    <script src="{{ asset('frontview/yearpicker/year.js') }}"></script>

    {{-- <link rel="stylesheet" href="{{ asset('year_plugin/dist/yearpicker.css') }}">
    <script src="/path/to/cdn/jquery.slim.min.js"></script>
    <script src="{{ asset('year_plugin/dist/yearpicker.js') }}" async></script> --}}


    <!-- <style type="text/css">
        .main-sidebar { background-color: $your-color !important }
    </style> -->
    <style>
        .thumbPic {
            margin: 10px 5px 0 0;
            width: 300px;
            padding: 2px;
        }
    </style>


    <script src="https://cdn.tiny.cloud/1/tqgoeagbvor02ru0sqkmc5us2gzg9l96usm4hfnj08coj2te/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed pace-primary">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>
 -->
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('dashboard') }}" class="nav-link">Dashboard</a>
                </li>

            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->

                <li class="nav-item dropdown">
                    <a class="nav-link notification" data-toggle="dropdown" href="#" style="padding-top: 0px;">
                        <i class="fax fa fa-user-cog"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">Settings</span>
                        <div class="dropdown-divider"></div>
                        <!--<a href="" class="dropdown-item">-->
                        <!--    <i class="fas fa-user mr-2"></i>Profile-->
                        <!--</a>-->

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>


                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            {{-- <a href="#" class="brand-link">
                <img src="{{ asset('assets/images/undp.png')}}" alt="Logo" class="brand-image img-circle elevation-5"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">{{ session()->get('orgNameMaster') }}</span>
            </a> --}}
            <!-- Sidebar -->

            <div class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-2 pb-2 mb-2">
                    <div class="image">

                        <img src="{{ asset('dist/img/user1.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    User Info
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('userInfo') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Personal Info Edit
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Slider
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/slider-add') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Home Slider
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/slider-index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Home Slider List
                                        </p>
                                    </a>
                                </li>
                            </ul>

                            {{-- <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/explore-slider-add') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Explore Pro. Slider
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/explore-slider-index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Explore Pro. Slider List
                                        </p>
                                    </a>
                                </li>
                            </ul> --}}

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p>
                                    Events
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/category-create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Event
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/category-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Event List
                                        </p>
                                    </a>
                                </li>
                            </ul>

                            {{-- <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/brand-create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Brand
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/brand-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Brand List
                                        </p>
                                    </a>
                                </li>
                            </ul> --}}

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fad fa-layer-plus"></i>
                                <p>
                                    Notice Board
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            {{-- <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/exibition-create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Create Notice
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/exibition-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Notice List
                                        </p>
                                    </a>
                                </li>
                            </ul> --}}
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('news.ticker.manage') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            News Ticker
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('speech.manage') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Speech
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('news.vision.manage') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            News Board & Vision
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            {{-- <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fad fa-mobile-alt"></i>
                                        <p>
                                            Feature Phone
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/slider-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Promo Slider
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/slider-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Promo Slider List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/model-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Model
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/model-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Model List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/over-view-image-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Over View Image
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/specification-category-create') }}"
                                                class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Specifications Category
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/specification-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Specifications
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/specification-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Specifications List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/variant-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Verient
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/feature-phone/variant-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Verient List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                            </ul> --}}
                            {{-- <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fal fa-mobile"></i>
                                        <p>
                                            Smart Phone
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/slider-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Promo Slider
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/slider-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Promo Slider List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/model-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Model
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/model-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Model List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/over-view-image-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Over View Image
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/specification-category-create') }}"
                                                class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Specifications Category
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/specification-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Specifications
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/specification-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Specifications List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/variant-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Verient
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/smart-phone/variant-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Verient List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                            </ul> --}}
                            {{-- <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-headphones-alt"></i>
                                        <p>
                                            Exibition
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a> --}}

                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/accessories-category-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Accessories Category
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/accessories-image-link-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Image Link
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/accessories-image-link-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Image Link List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/accessories-create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Create Accessories
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ url('/accessories-list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Accessories List
                                                </p>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                            </ul> --}}


                        </li>


                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-solid fa-book nav-icon"></i>
                                <p>
                                    Collections
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/collection-add') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Collection
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/collection-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Collection List
                                        </p>
                                    </a>
                                </li>
                            </ul>

                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fad fa-window-alt nav-icon"></i>
                                <p>
                                    Dynamic Pages
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/about-us-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            About Us
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/contact-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                         Contact List
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/service-warranty-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Service Warranty
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/warranty-policy-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Warranty Policy
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/support-and-service-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Support & Service
                                        </p>
                                    </a>
                                </li>
                            </ul>

                        </li> --}}

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Setting
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('district.manage')  }}" class="nav-link">
                                        <i class="nav-icon fas fa-image"></i>
                                        <p>
                                            District
                                            {{-- <i class="fas fa-angle-left right"></i> --}}
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('district.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Add New District
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('district.manage')  }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Manage District
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}

                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('thana.manage')  }}" class="nav-link">
                                        <i class="nav-icon fas fa-image"></i>
                                        <p>
                                            Thana
                                            {{-- <i class="fas fa-angle-left right"></i> --}}
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('thana.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Add New Thana
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('thana.manage')  }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Manage Thana
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}

                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('union.manage') }}" class="nav-link">
                                        <i class="nav-icon fas fa-image"></i>
                                        <p>
                                            Union
                                            {{-- <i class="fas fa-angle-left right"></i> --}}
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('union.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Add New Union
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('union.manage') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Manage Union
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}

                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('village.manage') }}" class="nav-link">
                                        <i class="nav-icon fas fa-image"></i>
                                        <p>
                                            Village
                                            {{-- <i class="fas fa-angle-left right"></i> --}}
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('village.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Add New Village
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('village.manage') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Village list
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}

                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                {{-- <i class="nav-icon fas fa-cog"></i> --}}
                                <p>
                                    Photo Gallery
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('gallary.manage')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{-- <i class="nav-icon fas fa-image"></i> --}}
                                        <p>
                                            Gallery List
                                            {{-- <i class="fas fa-angle-left right"></i> --}}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('photo.link.manage')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{-- <i class="nav-icon fas fa-image"></i> --}}
                                        <p>
                                            Photo Drive Link
                                            {{-- <i class="fas fa-angle-left right"></i> --}}
                                        </p>
                                    </a>

                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>
                                    Program
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('programme.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Create Program List
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('programme.manage') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Program Registration List
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class='fas fa-money-check-alt'></i>
                                {{-- <i class="fas fa-users nav-icon"></i> --}}
                                <p>
                                    Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('expensive.manage')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Type of Income & Expense
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('manage.bloodGroup')  }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Blood Group List
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('expensive.amount.create')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Create Income & Expense
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('expensive.amount.manage')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Balance Sheet
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('expensive.yearly.page')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Yearly Report
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>
                                    Job Seeker
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ route('manage.jobSeeker')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Job Seeker List
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class='fas fa-user-plus'></i>
                                {{-- <i class="fas fa-users nav-icon"></i> --}}
                                <p>
                                    Banker Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                {{-- <li class="nav-item">
                                    <a href="{{ route('manage.bloodGroup')  }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Blood Group
                                        </p>
                                    </a>
                                </li> --}}

                                <li class="nav-item">
                                    <a href="{{ route('report.member') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Report of Member
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview pl-3">
                                        <li class="nav-item">
                                            <a href="{{ route('manage.designation') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Designation List
                                                </p>
                                            </a>
                                        </li>
                                    </ul> --}}
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('mourn.manage') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Dead Member
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('manage.bankUser') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Bank User Registration
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pending.bankUser') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Pending Bank Users
                                        </p>
                                    </a>

                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class='fas fa-user-tie'></i>
                                {{-- <i class="nav-icon fa-regular fa-envelope"></i> --}}
                                <p>
                                    Comitte Management
                                    {{-- <i class=""></i> --}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/comitee-designation') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Create Comitee
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/add-new-member') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Member
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/comitee-designation-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Comitee List
                                        </p>
                                    </a>
                                </li>
                            </ul>




                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class='fas fa-user-tie'></i>
                                {{-- <i class="nav-icon fa-regular fa-envelope"></i> --}}
                                <p>
                                    Advisor Management
                                    {{-- <i class=""></i> --}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/add-advisors') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                           Create Advisor
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/add-new-advisor') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Advisor
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/advisors-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Advisor List
                                        </p>
                                    </a>
                                </li>
                            </ul>




                        </li>

                        @role('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    User Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/create-user') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            New User
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/users-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Users List
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{ url('/role-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Roles List
                                        </p>
                                    </a>
                                </li>
                            </ul>
                           <!--<ul class="nav nav-treeview pl-3">-->
                           <!--     <li class="nav-item">-->
                           <!--         <a href="{{ url('/permission-list') }}" class="nav-link">-->
                           <!--             <i class="far fa-circle nav-icon"></i>-->
                           <!--             <p>-->
                           <!--                 Permission List-->
                           <!--             </p>-->
                           <!--        </a>-->
                           <!--     </li>-->
                           <!-- </ul>-->
                            <!--<ul class="nav nav-treeview pl-3">-->
                            <!--    <li class="nav-item">-->
                            <!--        <a href="{{ url('/permission-group-list') }}" class="nav-link">-->
                            <!--            <i class="far fa-circle nav-icon"></i>-->
                            <!--            <p>-->
                            <!--                Permission Group List-->
                            <!--            </p>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                        </li>

                    <!--</ul>-->
                        @endrole
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Main content -->
        @yield('content')






        <div class="layout-footer-fixed">
            <footer class="main-footer">
                <strong>Copyright &copy; <a href="">Dohar-Nawabgonj Banker's Association</a>.</strong>
                All rights reserved.
            </footer>
        </div>


    </div>
    <!-- ./wrapper -->


    <!-- REQUIRED SCRIPTS -->
    @yield('script')

    <!-- jQuery -->
    @yield('jQuery')

    <!-- jQuery -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            var url = window.location;
            // for single sidebar menu
            $('ul.nav-sidebar a').filter(function() {
                return this.href == url;
            }).addClass('active');

            // for sidebar menu and treeview
            $('ul.nav-treeview a').filter(function() {
                    return this.href == url;
                }).parentsUntil(".nav-sidebar > .nav-treeview")
                .css({
                    'display': 'block'
                })
                .addClass('menu-open').prev('a')
                .addClass('active');
        });

    </script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>

    <!-- Bootstrap 5 -->
    <script src="{{ asset('dist/js/umd/popper.min.js') }}"></script>
    {{-- <script src="{{asset('dist/js/umd/popper.min.js.map')}}"> </script> --}}

    <script src="{{ asset('dist/js/bootstrap/bootstrap.min.js') }}"></script>

    <!-- DataTable -->

    <script src="{{ asset('dataTable/datatables.min.js') }}"></script>
    <script src="{{ asset('dataTable/Buttons-2.2.2/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('dataTable/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('dataTable/pdfmake-0.1.36/pdfmake.js') }}"></script>
    <script src="{{ asset('dataTable/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dataTable/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dataTable/Buttons-2.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dataTable/Buttons-2.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dataTable/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dataTable/dataTables.rowsGroup.js') }}"></script>




    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>

    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- Notify JS -->
    <script src="{{ asset('dist/js/notify.min.js') }}"></script>

    <!-- Print a div -->
    <script src="{{ asset('dist/js/jQuery.print.min.js') }}"></script>

    <!-- <script type="text/javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('dist/js/print.min.js') }}"></script>






    <!-- Select2 -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('dist/js/bootstrap/bootstrap-select.min.js') }}"></script>

    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js"
        type="text/javascript"></script> -->
    <script type="text/javascript" src="{{ asset('kartik-v-bootstrap-fileinput-ab06a9c/js/plugins/piexif.min.js') }}">
    </script>

    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js"
        type="text/javascript"></script> -->
    <script type="text/javascript" src="{{ asset('kartik-v-bootstrap-fileinput-ab06a9c/js/plugins/sortable.min.js') }}">
    </script>

    <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="{{ asset('dist/js/bootstrap/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>

    <!-- the main fileinput plugin script JS file -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('kartik-v-bootstrap-fileinput-ab06a9c/js/fileinput.min.js') }}">
    </script>

    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
    <!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/themes/fas/theme.min.js"></script -->

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="{{ asset('dist/js/bootstrap-fileinput@5.2.5/LANG.js') }}"></script>

    <!-- jquery loader -->
    <!-- <script src="//code.jquery.com/jquery-3.1.1.slim.min.js"></script> -->
    <script src="{{ asset('loader/js/jquery.loadingModal.min.js') }}"></script>


    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->


    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->

    <!-- pace -->
    <script src="{{ asset('pace/js/pace.min.js') }}"></script>


    <!-- jQuery treeView -->
    <!-- <script src="{{ asset('dist/js/bstreeview.min.js') }}"></script> -->

    <script src="{{ asset('dist/jstree.min.js') }}"></script>


    <script type="text/javascript" src="{{asset('scripts/toastr/toastr.min.js')}}">
    </script>
    <script src="{{asset('scripts/toastr/sweetalert2.js')}}"></script>
    {{-- <script type="text/javascript" src="{{asset('scripts/sweetalert/sweetAlert.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('scripts/sweetalert/icon.js')}}"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
           case 'info':
           toastr.info(" {{ Session::get('message') }} ");
           break;

           case 'success':
           toastr.success(" {{ Session::get('message') }} ");
           break;

           case 'warning':
           toastr.warning(" {{ Session::get('message') }} ");
           break;

           case 'error':
           toastr.error(" {{ Session::get('message') }} ");
           break;
        }
        @endif
    </script>

</body>

</html>
