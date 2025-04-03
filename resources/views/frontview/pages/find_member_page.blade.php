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
          <h2>Find Member</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="">Find Member</a></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

     <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-info opacity-75">
                            <form action="{{ route('findMember') }}" method="GET" id="searchForm" class="d-flex">
                                <div class="col-md-3 form-group mt-3 mx-1 mt-md-0">
                                    <select class="form-select" name="thana" id="thana_id" aria-label="Default select example" required>
                                        <option disabled selected>Select to The Thana/Upzila</option>
                                        <option value="3">Dohar</option>
                                        <option value="1">Nawabganj</option>
                                    </select>
                                    <strong id="thana_error" class="form-text text-danger"></strong>
                                </div>
                                <div class="col-md-3 form-group mt-3 mx-1 mt-md-0">
                                    <select class="form-select" name="union" id="union_id" aria-label="Default select example" required>
                                        <option disabled selected>Select to The Union</option>
                                    </select>
                                    <strong id="union_error" class="form-text text-danger"></strong>
                                </div>
                                <button type="submit" class="btn btn-warning me-1">Submit</button>
                            </form>
                            {{-- <form action="{{ route('findMember') }}" method="GET" role="form" id="searchForm" class="php-email-form">
                                <div class="row">
                                    <div class="col-md-3 form-group mt-3 mt-md-0">
                                        <select class="form-select" name="search" id="thana_id" aria-label="Default select example" required>
                                            <option disabled selected>Select to The Thana/Upzila</option>
                                            <option value="3">Dohar</option>
                                            <option value="1">Nawabganj</option>
                                        </select>
                                        <strong id="thana_error" class="form-text text-danger"></strong>
                                    </div>
                                    <div class="col-md-3 form-group mt-3 mt-md-0">
                                        <select class="form-select" name="union" id="union_id" aria-label="Default select example" required>
                                            <option disabled selected>Select to The Union</option>
                                        </select>
                                        <strong id="union_error" class="form-text text-danger"></strong>
                                    </div>
                                    <div class="col-md-3 form-group mt-3 mt-md-0">
                                        <button type="submit" class="mt-1 bg-danger text-white opacity-100">Submit</button>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        <div class="card-body">
                            @if ( $search_members->count() > 0 )
                                <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#SL</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone No.</th>
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Section</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $search_members as $key => $search_member )
                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    <img src="{{ asset('images/user/' . $search_member->image) }}" alt="" width="40px" class="img-fluid">
                                                </td>
                                                <td>{{ $search_member->name }}</td>
                                                <td>{{ $search_member->email }}</td>
                                                <td>{{ $search_member->contact }}</td>
                                                <td>{{ $search_member->bank_name }}</td>
                                                <td>{{ $search_member->designation->designation }}</td>
                                                <td>{{ $search_member->branch }}</td>
                                                <td>{{ $search_member->section }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="col-lg-12">
                                    <div class="alert alert-info">Sorry! No Member Found in this Page.</div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Team Section -->


  </main><!-- End #main -->

@endsection
@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    {{-- <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script> --}}
    <script>
        $(document).ready(function () {
            // $("#myTable").DataTable({
            //     responsive: true;
            // });

            $("#thana_id").click(function () {
                let thana = $("#thana_id").val();
                // alert(thana);
                // Initiate Union Field Options
                $("#union_id").html();
                let option = "";

                $.get("/get-unions/" + thana, function ( data ) {
                    data = JSON.parse( data );
                    // console.log(data);
                    data.forEach( function ( element ) {
                        option += "<option value='" + element.id + "'>" + element.name + "</option>";
                    });
                    $("#union_id").html( option );
                });
            });
        });
    </script>

@endsection
