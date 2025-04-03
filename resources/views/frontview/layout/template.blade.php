<!DOCTYPE html>
<html lang="en">

<head>
  @include('frontview.include.header')

  @include('frontview.include.css')
  @yield('page-css')

  <!-- =======================================================
  * Template Name: Sailor
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('frontview.include.topbar')

  <!-- ======= Hero Section ======= -->
  @yield('body-content')

  @include('frontview.include.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('frontview.include.script')
  @yield('page-script')

</body>

</html>
