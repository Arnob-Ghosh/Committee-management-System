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
            <h2>Job Seeker</h2>
            <ol>
              <li><a href="{{ route('homepage') }}">Home</a></li>
              <li>Job Seeker</li>
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
                <div>
                    <img src="{{ asset('frontview/img/we-are-hiring-collage-concept.jpg') }}" alt="" class="img-fluid" width="500px" height="582px">
                </div>
              </div>
            </div>

            <div class="col-lg-7 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col-md-12">
                        <p>If you have previously applied in this job form, click on the status button to check your job status.</p>
                    </div>
                    <form action="{{ route('search.job.status') }}" method="GET" class="d-flex">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="job_id" id="job_id" placeholder="Enter your Job ID/ Phone no." autocomplete="off">
                            {{-- <button type="button" class="btn btn-danger">Job Status</button> --}}
                        </div>
                        <div class="col-md-2 ms-2">
                            <button type="submit" class="btn btn-success">JOB STATUS</button>
                        </div>
                    </form>
                </div>
                <div class="mt-3 text-center">
                    <h3>Job Seeker Form</h3>
                </div>

                <div id="apply-status"></div>

              <form action="" method="" role="form" id="jobSeekerForm" class="php-email-form">
                @csrf
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                    <strong id="name_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    <strong id="email_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Your Phone" required>
                    <strong id="phone_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Your Father Name" required>
                    <strong id="father_name_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Your Mother Name" required>
                    <strong id="mother_name_error" class="form-text text-danger"></strong>
                  </div>
                  {{-- <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="district" id="district" placeholder="Your District" required>
                  </div> --}}
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <select class="form-select" name="district" id="district_id" aria-label="Default select example" required>
                        <option disabled selected>Select to The District</option>
                        <option value="Dhaka" selected>Dhaka</option>
                        {{-- @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach --}}
                    </select>
                    <strong id="district_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <select class="form-select" name="thana" id="thana_id" aria-label="Default select example" required>
                        <option disabled selected>Select to The Thana</option>
                        <option value="1">Nawabganj</option>
                        <option value="3">Dohar</option>
                        {{-- @foreach ($thanas as $thana)
                            <option value="{{ $thana->id }}">{{ $thana->name }}</option>
                        @endforeach --}}
                    </select>
                    <strong id="thana_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <select class="form-select" name="union" id="union_id" aria-label="Default select example" required>
                        <option selected>Select to The Union</option>
                        {{-- @foreach ($unions as $union)
                            <option value="{{ $union->id }}">{{ $union->name }}</option>
                        @endforeach --}}
                    </select>
                    <strong id="union_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="village" id="village" placeholder="Your Village" required>
                    <strong id="village_error" class="form-text text-danger"></strong>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="present_address" id="present_address" placeholder="Present Address" required >
                    <strong id="present_address_error" class="form-text text-danger"></strong>
                  </div>
                  {{-- <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="permanent_address" id="permanent_address" placeholder="Permanent Address" required>
                    <strong id="permanent_address_error" class="form-text text-danger"></strong>
                  </div> --}}
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control" name="education_details" id="education_details" rows="5" placeholder="Your Education Details" required></textarea>
                    <strong id="education_details_error" class="form-text text-danger"></strong>
                </div>
                {{-- <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div> --}}
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit" class="add_jobSeeker_btn">Apply</button></div>
              </form>

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
    <script type="text/javascript">
        $("#district_id").change(function () {
            let district = $("#district_id").val();
            // alert(district);
            // Initiate District Field Options
            $("#thana_id").html();
            let option = "";

            $.get("/get-thanas/" + district, function ( data ) {
                data = JSON.parse( data );
                // console.log(data);
                data.forEach( function ( element ) {
                    option += "<option value='" + element.id + "'>" + element.name + "</option>";
                });
                $("#thana_id").html( option );
            });
        });

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
    </script>

    <script>
        // add new job seeker info ajax request
        $(document).on('click', '.add_jobSeeker_btn', function(e) {
            e.preventDefault();

            $('#name_error').text('');
            $('#email_error').text('');
            $('#phone_error').text('');
            $('#father_name_error').text('');
            $('#mother_name_error').text('');
            $('#district_error').text('');
            $('#thana_error').text('');
            $('#union_error').text('');
            $('#village_error').text('');
            $('#present_address_error').text('');
            // $('#permanent_address_error').text('');
            $('#education_details_error').text('');

            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let father_name = $('#father_name').val();
            let mother_name = $('#mother_name').val();
            let district = $('#district_id').val();
            let thana = $('#thana_id').val();
            let union = $('#union_id').val();
            let village = $('#village').val();
            let present_address = $('#present_address').val();
            // let permanent_address = $('#permanent_address').val();
            let education_details = $('#education_details').val();
            // var fd = new FormData($('#addUserForm')[0]);
            // console.log(fd);

            // console.log(name + email + phone + father_name + mother_name + district + thana + union + village +
            // present_address + permanent_address + education_details);
            $.ajax({
                url: '{{ route('submit.jobSeeker.form') }}',
                method: 'post',
                data: {
                    name:name, email:email, phone:phone, father_name:father_name, mother_name:mother_name, district:district,
                    thana:thana, union:union, village:village, present_address:present_address, education_details:education_details
                },
                // processData: false,
                // contentType: false,
                cache: false,
                success: function(res){
                    // console.log(res.data.job_id);
                    if (res.status == 200) {
                        let response=res.data;

                        $("#jobSeekerForm")[0].reset();
                        $("#jobSeekerForm").hide();
                        $("#apply-status").html(
                            '<div class="alert alert-info" role="alert"><strong> Congratulation ! </strong> Please, Collect Your Job ID: <b>'+ response.job_id +'</b></div>'
                        );
                        // $("#addUserModal").modal('hide');
                        // $('.table').load(location.href+' .table');

                        Command: toastr["success"]("You are Applied!", "Successfully")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function(err){
                    // let error = err.responseJSON;
                    // $.each(error.errors, function(index, value){
                    //     $('.errMsgContainer').append('<strong class="text-danger">'+value+'</strong>'+'<br>');
                    // });
                    let error = $.parseJSON(err.responseText);
                    console.log(error);
                    $.each(error.errors, function(index, value){
                        $("#" + index + "_error").text(value[0]);
                    });
                },
            });
        });
    </script>
@endsection
