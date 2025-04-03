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
          <h2>Advisor</h2>
          <ol>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="">Advisor</a></li>
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
                        <p>Our Advisor</p>
                    </div>
                </div>
                <div class="col-lg-3 my-2">
                    <form action="" method="" id="searchComitee" class="d-flex">
                        <select class="form-select" name="duration" id="duration" aria-label="Default select example" required>
                            <option disabled selected>Select Current Committee</option>
                            @foreach ( App\Models\Advisor::distinct()->get('duration') as $doharSubComitee )
                                <option value="{{ $doharSubComitee->duration }}">{{ $doharSubComitee->duration }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="row" id="tbody">
                @foreach ( $doharSubComitees as $doharSubComitee )
                    <div class="col-lg-3 col-sm-6 my-3">
                        <div class="card h-100">
                            @if ($doharSubComitee->bankUser)
                                <img src="{{ asset('images/user/' . $doharSubComitee->bankUser->image) }}"  class="mx-auto d-block mt-4"  width="200px" alt="...">
                            @else
                                <img src="" class="mx-auto d-block mt-4" width="200px" alt="No Image found">
                            @endif
                            
                            <div class="card-body ">
                                <h6 class="card-text text-start"><strong>Name:</strong> {{ $doharSubComitee->name }}</h6>
                                <h6 class="card-text text-start"><strong>Designation:</strong> {{ $doharSubComitee->designation }}</h6>
                                <h6 class="card-text text-start"><strong>Bank Name:</strong> {{ $doharSubComitee->bank_name }}</h6>
                                @if ($doharSubComitee->bankUser)
                                    <h6 class="card-text text-start"><strong>Email:</strong> {{ $doharSubComitee->bankUser->email }}</h6>
                                @endif
                                <h6 class="card-text text-start"style="font-family:Arial;" ><strong>Phone:</strong> {{ $doharSubComitee->mobile_no }}</h6>
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
            
            let duration     = $('#duration').val();
            $.ajax({
                type: "GET",
                url: "/advisors-list-data",
                data: {
                    duration: duration,
                   
                },
                success: function (res) {
                    console.log(res)
                    $('#tbody').empty();
                    if ( res.data.length > 0 ) {
                        $.each(res.data, function(key,item){
                            $('#tbody').append(
                                "<div class='col-lg-3 col-sm-6 my-3'>"+
                                    "<div class='card h-100'>"+
                                        "<img src='{{ asset("images/user/") }}/"+ item.bank_user.image +" '  class='mx-auto d-block mt-4'  width='200px'>"+
                                        "<div class='card-body'>"+
                                            "<h6 class='card-text text-start'><strong>Name:</strong>"+ item.name +"</h6>"+
                                            "<h6 class='card-text text-start'><strong>Designation:</strong>"+ item.bank_user.designation_id +"</h6>"+
                                            "<h6 class='card-text text-start'><strong>Bank Name:</strong>"+ item.bank_name +"</h6>"+
                                            "<h6 class='card-text text-start'><strong>Email:</strong>"+ item.bank_user.email +"</h6>"+
                                            "<h6 class='card-text text-start'style='font-family:Arial;'><strong>Phone:</strong>"+ item.bank_user.contact +"</h6>"+
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
