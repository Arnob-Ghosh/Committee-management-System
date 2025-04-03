<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center opacity-100">
    <div class="container d-flex align-items-center justify-content-center">

        <!--<h1 class="logo me-auto"><a href="{{ route('homepage') }}">DNBA</a></h1>-->
        <!--<h1 class="logo me-auto mt-1"><a href="{{ route('homepage') }}" class="logo"><img src="{{ asset('frontview/img/dnba.png') }}" alt="" class="img-fluid"></a></h1>-->
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
            <li><a href="{{ route('homepage') }}" class="active">Home</a></li>
            <li class="dropdown"><a href="#"><span>Council</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="{{ route('advisorComitee') }}">Advisors</a></li>
                    <li><a href="{{ route('centralCommunity') }}">Central Committee</a></li>
                    <li><a href="{{ route('nawabganjSubComitee') }}">Nawabgonj Sub-Committee</a></li>
                    <li><a href="{{ route('doharSubComitee') }}">Dohar Sub-Committee</a></li>
                    <!--<li><a href="{{ route('advisorComitee') }}">Advisor</a></li>-->
                </ul>
            </li>
            <li class="dropdown"><a href="#"><span>Member</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="{{ route('lifetimeMember') }}">Lifetime Member</a></li>
                    <li><a href="{{ route('generalMember') }}">General Member</a></li>
                    <li><a href="{{ route('mournMember') }}">The ones we'have lost</a></li>
                    <li><a href="{{ route('searchPage') }}">Find Member</a></li>
                </ul>
            </li>
            <li><a href="{{ route('jobSeeker.form') }}">Job Seeker</a></li>
            <li><a href="{{ route('photo.gallary') }}">Gallery</a></li>
            <li class="dropdown"><a href="#"><span>Registration</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="{{ route('register.form') }}">Online Registration Form</a></li>
                    <li><a href="{{ route('program.register.form') }}">Program Registration Form</a></li>
                    <li><a href="{{ route('download.form.link') }}" target="_blank">Download Registration Form</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="{{ route('userLogin') }}"><span>Report</span></a>
            </li>
            {{-- <li>
                <form action="{{ route('findMember') }}" method="GET" class="d-flex">
                    <input type="search" class="form-control ms-3 mx-2" name="search" placeholder="Name/Phone...">
                    <div class="col-md-3 form-group mt-3 mt-md-0">
                        <select class="form-select" name="search" id="thana_id" aria-label="Default select example" required>
                            <option disabled selected>Select to The Thana/Upzila</option>
                            <option value="3">Dohar</option>
                            <option value="1">Nawabganj</option>
                        </select>
                        <strong id="thana_error" class="form-text text-danger"></strong>
                    </div>
                    <button type="submit" class="btn btn-warning me-1">Search</button>
                </form>
            </li> --}}
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('userLogin') }}" class="getstarted">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  
  {{-- Banner Section --}}
    <section id="banner">
        <div class="row">
            <div class="col-lg-12">
                <img src="{{ asset('frontview/img/banner.jpeg') }}" class="border" width="100%" height="120px" alt="">
            </div>
        </div>
    </section>

