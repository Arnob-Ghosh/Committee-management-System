@extends('frontview.layout.template')

@section('page-css')

@endsection
@section('page-title')

@endsection
@section('body-content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

          <div class="d-flex justify-content-between align-items-center">
            <h2>Program Registration Form</h2>
            <ol>
              <li><a href="{{ route('homepage') }}">Home</a></li>
              <li>Program Registration Page</li>
            </ol>
          </div>

        </div>
      </section><!-- End Breadcrumbs -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          {{-- <div>
            <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
          </div> --}}

          <div class="row mt-5">

            <div class="col-lg-5">
              <div class="info">
                <div class="text-center">
                    <img src="{{ asset('frontview/img/wepik-export-202401061043563VHc.jpeg') }}" alt="" class="img-fluid rounded" width="500px" height="500px">
                </div>
              </div>
            </div>

            <div class="col-lg-7 mt-5 mt-lg-0">
                <div>
                    <h4 id='message' class="text-success text-center"></h4>
                </div>
                @if ( $programmeDate->count() > 0 )
                    @foreach ( $programmeDate as $programme )
                        <div class="mt-3 text-center">
                            <u><h3>{{ $programme->programme_name }}</h3></u>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <strong>Register Start Date:</strong> <span style="color: #991199">{{ $programme->start_date }}</span>
                            </div>
                            <div class="col-6">
                                <strong>Register End Date:</strong> <span class="text-danger">{{ $programme->end_date }}</span>
                            </div>
                            <div class="col-12">
                                <strong class="text-dark fw-bold">Registration Fees:</strong> <span class="text-success">{{ $programme->registration_fees }}</span>
                            </div>
                        </div>
                    @endforeach

                    @foreach ( $programmeDate as $programme )
                        <form action="" method="" role="form" id="programmeForm" class="php-email-form mt-3">
                            @csrf
                            <div class="row">
                                {{-- <div class="col-md-6 form-group"> --}}
                                    <input type="hidden" name="programme_name" class="form-control" id="name" value="{{ $programme->programme_name }}" readonly>
                                    <div class="programme_nameError text-danger errors d-none"></div>
                                {{-- </div> --}}
                                {{-- <div class="col-md-6 form-group mt-3 mt-md-0"> --}}
                                    <input type="hidden" class="form-control" name="start_date" id="start_date" value="{{ $programme->start_date }}" readonly>
                                    <div class="start_dateError text-danger errors d-none"></div>
                                {{-- </div> --}}
                                {{-- <div class="col-md-6 form-group mt-3 mt-md-0"> --}}
                                    <input type="hidden" class="form-control" name="end_date" id="end_date" value="{{ $programme->end_date }}" readonly>
                                    <div class="end_dateError text-danger errors d-none"></div>
                                {{-- </div> --}}
                                <!--<div class="col-md-6 form-group mt-3 mt-md-0 text-success fw-bold">-->
                                    <input type="hidden" class="form-control" name="registration_fees" id="registration_fees" value="{{ $programme->registration_fees }}" readonly >
                                    <div class="registration_feesError text-danger errors d-none"></div>
                                <!--</div>-->
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Applicant Name:<input type="text" class="form-control" name="applicant_name" id="applicant_name" placeholder=" Enter Applicant Name" >
                                    <div class="applicant_nameError text-danger errors d-none"></div>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Union:<input type="text" class="form-control" name="union" id="union" placeholder="Enter your union" >
                                    <div class="unionError text-danger errors d-none"></div>
                                </div>
                                {{-- <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Email:<input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" >
                                    <div class="emailError text-danger errors d-none"></div>
                                </div> --}}
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Phone No:<input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone no" >
                                    <div class="phoneError text-danger errors d-none"></div>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    0-5 Years (Age):<input type="number" class="form-control" name="child_age1" id="child_age1" placeholder="Enter number" >
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Applicants+Guest:<input type="number" class="form-control" name="child_age2" id="child_age2" placeholder="Enter number" >
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Total Participants No:<input type="number" class="form-control" name="participants_num" id="participants_num" placeholder="Enter Total participants no." >
                                    <div class="participants_numError text-danger errors d-none"></div>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    Transanction ID:<input type="text" class="form-control" name="father_name" id="father_name" placeholder="Enter Transaction ID" >
                                    <div class="father_nameError text-danger errors d-none"></div>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" class="add_programme_btn">Submit</button></div>
                        </form>
                    @endforeach
                @else
                    <div class="alert alert-info">Sorry! No Programme Available Now</div>
                @endif

            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
@section('page-script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        //Add data ajax request
        $(document).on('submit', '#programmeForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('programme.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.programme_nameError').text(res.errors.programme_name);
                        // $('.start_dateError').text(res.errors.date);
                        // $('.end_dateError').text(res.errors.date);
                        $('.applicant_nameError').text(res.errors.applicant_name);
                        $('.father_nameError').text(res.errors.father_name);
                        $('.unionError').text(res.errors.union);
                        $('.emailError').text(res.errors.email);
                        $('.phoneError').text(res.errors.phone);
                        $('.registration_feesError').text(res.errors.registration_fees);
                        $('.participants_numError').text(res.errors.participants_num);
                        // $('.child_ageError').text(res.errors.child_age);
                    } else {
                        $('#programmeForm')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        alert("Registered successfully!");
                        window.location.href = '/'; // Redirect after the alert
                        // $('#message').text(res.message);
                        // $(location).attr('href','/bank-user/manage');
                        // $('.table').load(location.href+' .table');

                        // Command: toastr["success"]("Send!", "Successfully")
                        //     toastr.options = {
                        //     "closeButton": true,
                        //     "debug": false,
                        //     "newestOnTop": false,
                        //     "progressBar": true,
                        //     "positionClass": "toast-bottom-right",
                        //     "preventDuplicates": false,
                        //     "onclick": null,
                        //     "showDuration": "300",
                        //     "hideDuration": "1000",
                        //     "timeOut": "5000",
                        //     "extendedTimeOut": "1000",
                        //     "showEasing": "swing",
                        //     "hideEasing": "linear",
                        //     "showMethod": "fadeIn",
                        //     "hideMethod": "fadeOut"
                        // }
                    }
                }
            });
        });
    </script>
@endsection
