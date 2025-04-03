@extends('frontview.layout.template')

@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- Year Picker CSS -->
    <link rel="stylesheet" href="{{ asset('frontview/yearpicker/year.css') }}"/>
@endsection
@section('page-title')

@endsection
@section('body-content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Nawabgonj Sub-Committee</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="">Nawabgonj Sub-Committee</a></li>
            {{-- <li>Blog Single</li> --}}
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section id="" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="section-title">
                        <h2>DNBA</h2>
                        <p>Our Nawabgonj Sub-Committee</p>
                    </div>
                </div>
                <div class="col-lg-3 my-2">
                    <form action="" method="" id="searchComitee" class="d-flex">
                        <select class="form-select" name="duration" id="duration" aria-label="Default select example" required>
                            <option disabled selected>Select Current Committee</option>
                            @foreach ( App\Models\NawabganjSubComitee::distinct()->get('duration') as $nawabganjSubComitee )
                                <option value="{{ $nawabganjSubComitee->duration }}">{{ $nawabganjSubComitee->duration }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="row" id="tbody">
                @foreach ( $nawabganjSubComitees as $nawabganjSubComitee )
                    <div class="col-lg-3 col-sm-6 my-3">
                        <div class="card h-100">
                            @if ($nawabganjSubComitee->bankUser)
                                <img src="{{ asset('images/user/' . $nawabganjSubComitee->bankUser->image) }}"  class="mx-auto d-block mt-4"  width="200px" alt="...">
                            @else
                                <img src="" class="mx-auto d-block mt-4" width="200px" alt="No Image found">
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-text text-center"><strong>{{ $nawabganjSubComitee->comitee_designation }}</strong></h5>
                                <h6 class="card-text text-start"><strong>Name:</strong> {{ $nawabganjSubComitee->name }}</h6>
                                <h6 class="card-text text-start"><strong>Designation:</strong> {{ $nawabganjSubComitee->designation }}</h6>
                                <h6 class="card-text text-start"><strong>Bank Name:</strong> {{ $nawabganjSubComitee->bank_name }}</h6>
                                @if ($nawabganjSubComitee->bankUser)
                                    <h6 class="card-text text-start"><strong>Email:</strong> {{ $nawabganjSubComitee->bankUser->email }}</h6>
                                @endif
                                <h6 class="card-text text-start" style="font-family:Arial;"><strong>Phone:</strong> {{ $nawabganjSubComitee->mobile_no }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ======= Blog Single Section ======= -->
    <!-- End Blog Single Section -->

  </main><!-- End #main -->

@endsection
@section('page-script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Moment Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<!-- Year Picker Js -->
<script src="{{ asset('frontview/yearpicker/year.js') }}"></script>

<script>
    $(document).ready(function () {
        $(".yearpicker1").yearpicker({
                year: 2019,
                startYear: 2019,
                endYear: 2050,
        });
        $(".yearpicker2").yearpicker({
                year: 2022,
                startYear: 2019,
                endYear: 2050,
        });

        $(document).on('submit', '#searchComitee', function (e) {
            e.preventDefault();
            // let year1     = $('#form').val();
            // let year2     = $('#to_year').val();
            let duration     = $('#duration').val();
            $.ajax({
                type: "GET",
                url: "{{ route('findNawabganjSubComitee') }}",
                data: {
                    duration: duration,
                    // form:    year1,
                    // to_year: year2,
                    // _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res.members);
                    $('#tbody').empty();
                    if ( res.members.length > 0 ) {
                        $.each(res.members, function(key,item){
                            $('#tbody').append(
                                "<div class='col-lg-3 col-sm-6 my-3'>"+
                                    "<div class='card h-100'>"+
                                        "<img src='{{ asset("images/user/") }}/"+ item.image +" '  class='mx-auto d-block mt-4'  width='200px'>"+
                                        "<div class='card-body '>"+
                                            "<h5 class='card-text text-center'><strong>"+ item.comitee_designation +"</strong></h5>"+
                                            "<h6 class='card-text text-start'><strong>Name:</strong>"+ item.name +"</h6>"+
                                            "<h6 class='card-text text-start'><strong>Designation:</strong>"+ item.designation_id +"</h6>"+
                                            "<h6 class='card-text text-start'><strong>Bank Name:</strong>"+ item.bank_name +"</h6>"+
                                            "<h6 class='card-text text-start'><strong>Email:</strong>"+ item.email +"</h6>"+
                                            "<h6 class='card-text text-start' style='font-family:Arial;'><strong>Phone:</strong>"+ item.contact +"</h6>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"
                            );
                        });
                    } else {
                        $('#tbody').html(
                            '<strong class="text-center text-danger my-3">No Member Found</strong>'
                        );
                    }

                },
            });
        });
    });
</script>
@endsection
