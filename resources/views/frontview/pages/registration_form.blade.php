@extends('frontview.layout.template')

@section('page-css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('page-title')

@endsection
@section('body-content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

          <div class="d-flex justify-content-between align-items-center">
            <h2>Registration Form</h2>
            <ol>
              <li><a href="{{ route('homepage') }}">Home</a></li>
              <li>Registration</li>
            </ol>
          </div>

        </div>
      </section><!-- End Breadcrumbs -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">


          <div class="row mt-5">

            

            <div class="col-lg-12 mt-5 mt-lg-0">
                <div class="mt-3 text-center">
                    <h3><u>Membership Form</u></h3>
                </div>

              <form action="" method="" role="form" id="add_register_form" class="php-email-form">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="my-2 text-dark">Personal Information:</h4>
                    </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Full Name:<input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" >
                    <div class="nameError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Father Name:<input type="text" name="father_name" id="father_name" class="form-control" placeholder="Enter Father Name" >
                    <div class="father_nameError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Mother Name:<input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="Enter Mother Name" >
                    <div class="mother_nameError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Spouse Name:<input type="text" name="spouse_name" id="spouse_name" class="form-control" placeholder="Enter Spouse Name" >
                    <div class="spouse_nameError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Date of Birth:<input type="date" data-date-format="DD/MM/YYYY"name="birth_date" id="birth_date" class="form-control" placeholder="Enter Your Birth Date" >
                    <div class="birth_dateError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Blood Group:<select class="form-select mb-2" aria-label="Default select example" name="blood_group" id="blood_group" >
                        <option disabled selected >Please Select Your Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <div class="blood_groupError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Nationality:<select class="form-select mb-3" aria-label="Default select example" name="nationality" id="nationality" >
                        <option value="Bangladeshi" selected>Bangladeshi</option>
                    </select>
                    <div class="nationalityError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    NID:<input type="number" name="national_id" id="national_id" class="form-control" placeholder="Enter Your National ID No." >
                    <div class="national_idError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Religion:<input type="text" name="religion" id="religion" class="form-control" placeholder="Enter Religion" >
                    <div class="religionError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Phone:<input type="number" name="contact" id="contact" class="form-control" placeholder="Enter Phone Number" >
                    <div class="contactError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Mobile:<input type="number" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile Number" >
                    <div class="mobileError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Email:<input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email Address" >
                    <div class="emailError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Photo:<input type="file" name="image" id="image" class="form-control" placeholder="Your Image" >
                    <div class="imageError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Signature:<input type="file" name="signature" id="signature" class="form-control" placeholder="Your Signature" >
                    <div class="signatureError text-danger errors d-none"></div>
                  </div>


                  <div class="col-lg-12">
                    <h4 class="my-2 text-dark">Address(Permanent):</h4>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    District:<select class="form-select mb-3" aria-label="Default select example" name="district" id="district" >
                        <option value="Dhaka" selected>Dhaka</option>
                    </select>
                    <div class="districtError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Upzila/Thana:<select class="form-select mb-3" aria-label="Default select example" name="thana_id" id="thana_id" >
                        <option disabled selected>Please Select the Upzila</option>
                        <option value="1">Nawabgonj</option>
                        <option value="3">Dohar</option>
                    </select>
                    <div class="thana_idError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Union:<select class="form-select mb-3" aria-label="Default select example" name="union_id" id="union_id" >
                        <option disabled selected>Please Select the Union</option>
                    </select>
                    <div class="union_idError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    <!--Village:<input type="text" name="village_id" id="village_id" class="form-control" placeholder="Enter Village" >-->
                    Village:<select class="form-select mb-3" aria-label="Default select example" name="village_id" id="village_id" >
                        <option disabled selected>Please Select the Village</option>
                    </select>
                    <div class="village_idError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Post Office:<input type="text" name="post_office" id="post_office" class="form-control" placeholder="Enter Post Office" >
                    <div class="post_officeError text-danger errors d-none"></div>
                  </div>
                  <div class="col-lg-12">
                    <h4 class="my-2 text-dark">Address(Present):</h4>
                  </div>
                  <div class="col-lg-12">
                    <textarea class="form-control w-100" rows="4" name = "present_address" id="present_address" placeholder="Enter your present address here"></textarea>
                    <div class="present_addressError text-danger errors d-none"></div>
                  
                  </div>
                  <div class="col-lg-12">
                    <h4 class="my-2 text-dark">Address(Office):</h4>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Designation:<input type="text" name="designation_id" id="designation_id" class="form-control" placeholder="Enter Designation" >
                    <div class="designation_idError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Member Type:<select class="form-select mb-3" aria-label="Default select example" name="comitee_designation" id="comitee_designation" >
                        <option disabled selected>Please Select</option>
                        <option value="Lifetime Member">Lifetime Member</option>
                        <option value="General Member">General Member</option>
                    </select>
                    <div class="comitee_designationError text-danger errors d-none"></div>
                  </div>
                 
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Office/Branch:<input type="text" name="branch" id="branch" class="form-control" placeholder=" Enter Office or Branch" >
                    <div class="branchError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Bank Name:<input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name" >
                    <div class="bank_nameError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    District:<input type="text" name="section" id="section" class="form-control" placeholder="Enter Division or Section" >
                    <div class="sectionError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Facebook ID:<input type="text" name="facebook_id" id="facebook_id" class="form-control" placeholder="Enter Your Facebook ID" >
                    <div class="facebook_idError text-danger errors d-none"></div>
                  </div>
                  <div class="col-md-3 form-group mt-3 mt-md-0">
                    Transaction ID:<input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="Enter Transaction ID" >
                    <div class="transaction_idError text-danger errors d-none"></div>
                  </div>
                </div>
                <div class="col-md-12 mt-2">
                    <b>First Pay your registration lifetime member fee: 5000/- taka or General member fee: 500/- taka to <strong class="text-danger">01728222693</strong>(Personal) bkash number then submit the membership form with bkash transaction ID.</b>
                </div>
                <div class="text-center mt-2"><button type="submit" class="add_jobSeeker_btn">Submit</button></div>
              </form>

            </div>
            
            <div id="apply-status"></div>

            <div class="row">
                <form action="{{ route('download.register.form') }}" method="GET" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="member_id" id="member_id" placeholder="Enter your Membership ID/ Phone no." autocomplete="off">
                    </div>
                    <div class="col-md-2 ms-2">
                        <button type="submit" class="btn btn-success">Download</button>
                    </div>
                </form>
                <div class="col-md-12 mt-2">
                    <p>If you have previously applied in this form, click on the download button to collect your pdf register form.</p>
                </div>
            </div>

        </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
         flatpickr("#birth_date", {
        dateFormat: "d/m/Y", // Set the desired format
        onChange: function(selectedDates, dateStr, instance) {
            // Optional: Do something when the date changes
        }
    });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">

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

        $("#union_id").click(function () {
            let union = $("#union_id").val();
            // alert(thana);
            // Initiate Union Field Options
            $("#village_id").html();
            let option = "";

            $.get("/get-villages/" + union, function ( data ) {
                data = JSON.parse( data );
                // console.log(data);
                data.forEach( function ( element ) {
                    option += "<option value='" + element.id + "'>" + element.name + "</option>";
                });
                $("#village_id").html( option );
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            //Add data ajax request
            $(document).on('submit', '#add_register_form', function (e) {
                e.preventDefault();
                let fd = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('submit.register.form') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (res) {
                        // console.log(res);
                        if (res.status == 400) {
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');

                            $('.nameError').text(res.errors.name);
                            $('.father_nameError').text(res.errors.father_name);
                            $('.mother_nameError').text(res.errors.mother_name);
                            $('.spouse_nameError').text(res.errors.spouse_name);
                            $('.birth_dateError').text(res.errors.birth_date);
                            $('.blood_groupError').text(res.errors.blood_group);
                            $('.nationalityError').text(res.errors.nationality);
                            $('.national_idError').text(res.errors.national_id);
                            $('.facebook_idError').text(res.errors.facebook_id);
                            $('.religionError').text(res.errors.religion);
                            $('.contactError').text(res.errors.contact);
                            $('.mobileError').text(res.errors.mobile);
                            $('.emailError').text(res.errors.email);
                            $('.imageError').text(res.errors.image);
                            $('.signatureError').text(res.errors.signature);
                            $('.districtError').text(res.errors.district);
                            $('.thana_idError').text(res.errors.thana_id);
                            $('.union_idError').text(res.errors.union_id);
                            $('.village_idError').text(res.errors.village_id);
                            $('.post_officeError').text(res.errors.post_office);
                            $('.designation_idError').text(res.errors.designation_id);
                            $('.comitee_designationError').text(res.errors.comitee_designation);
                            $('.transaction_idError').text(res.errors.transaction_id);
                            $('.branchError').text(res.errors.branch);
                            $('.bank_nameError').text(res.errors.bank_name);
                            $('.sectionError').text(res.errors.section);
                        } else {
                            $('#add_register_form')[0].reset();
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');
                            $("#apply-status").html(
                                '<div class="alert alert-info mt-2" role="alert"><strong> Successfully  </strong>,you have done Registration..</b></div>'
                            );
                            // $('.table').load(location.href+' .table');

                            // Command: toastr["success"]("Registration!", "Successfully")
                            //     toastr.options = {
                            //     "closeButton": true,
                            //     "debug": false,
                            //     "newestOnTop": false,
                            //     "progressBar": true,
                            //     "positionClass": "toast-top-right",
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
        });
    </script>
@endsection
