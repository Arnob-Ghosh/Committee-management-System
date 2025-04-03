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
          <h2>In Recognition of Our Departed Member</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="">Dead Member</a></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

     <!-- ======= Team Section ======= -->
     <section id="team" class="team section-bg">
        <div class="container">
          <div class="section-title">
            <h2>DNBA</h2>
            <p>In Loving Memory of Our Passed Members</p>
          </div>
            <div class="row">
                @foreach ( $mournMembers as $mournMember )
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="member d-flex align-items-start" style="margin: 20px 20px">
                            <div class="pic mt-5"><img src="{{ asset('images/user/' . $mournMember->image) }}" class="img-fluid" alt=""></div>
                            <div class="member-info mt-4">
                                <h4>{{ $mournMember->name }}</h4>
                                <p><strong>Member ID: </strong>{{ $mournMember->member_id }}</p>
                                <span><strong>Date of death: </strong>{{ $mournMember->died_date }}</span>
                                <p><strong>Member Type: </strong>{{ $mournMember->comitee_designation }}</p>
                                <p><strong>Designation: </strong>{{ $mournMember->designation_id }}</p>
                                <p><strong>Bank Name: </strong>{{ $mournMember->bank_name }}</p>
                                <p><strong>Branch: </strong>{{ $mournMember->branch }}</p>
                                <p><strong>District: </strong>{{ $mournMember->section }}</p>
                                <p><strong>Email: </strong>{{ $mournMember->email }}</p>
                                <p><strong>Phone: </strong> +{{ $mournMember->contact }}</p>
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
