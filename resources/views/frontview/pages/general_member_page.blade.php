@extends('frontview.layout.template')

@section('page-css')

@endsection
@section('page-title')

@endsection
@section('body-content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>General Member</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="">General Member</a></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

     <!-- ======= Team Section ======= -->
     <section id="team" class="team section-bg">
        <div class="container">
          <div class="section-title">
            <h2>DNBA</h2>
            <p>Our General Member</p>
          </div>
            <div class="row">
                @foreach ( $generalMembers as $generalMember )
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="member d-flex align-items-start" style="margin: 20px 20px">
                            <div class="pic mt-5"><img src="{{ asset('images/user/' . $generalMember->image) }}" class="img-fluid" alt=""></div>
                            <div class="member-info mt-4">
                                <h4>{{ $generalMember->name }}</h4>
                                <p><strong>Member Type: </strong>{{ $generalMember->comitee_designation }}</p>
                                <span><strong>Designation: </strong>{{ $generalMember->designation_id }}</span>
                                <p><strong>Bank Name: </strong>{{ $generalMember->bank_name }}</p>
                                <p><strong>Branch: </strong>{{ $generalMember->branch }}</p>
                                <p><strong>District: </strong>{{ $generalMember->section }}</p>
                                <p><strong>Email: </strong>{{ $generalMember->email }}</p>
                                <p><strong>Phone: </strong> +{{ $generalMember->contact }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      </section><!-- End Team Section -->


  </main><!-- End #main -->

@endsection
@section('page-script')

@endsection
