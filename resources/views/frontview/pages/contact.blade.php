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
            <h2>Contact</h2>
            <ol>
              <li><a href="{{ route('homepage') }}">Home</a></li>
              <li>Contact</li>
            </ol>
          </div>

        </div>
      </section><!-- End Breadcrumbs -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116944.39139936853!2d90.07058568921266!3d23.657633171156533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375591e51311c6a5%3A0x331e0e7dc425cfe!2sNawabganj%20Upazila!5e0!3m2!1sen!2sbd!4v1704302494024!5m2!1sen!2sbd" width="100%" height="270px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!--<iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>-->
          </div>

          <div class="row mt-5">

            <div class="col-lg-4">
              <div class="info">
                <div class="address">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>Dohar-Nawabgonj, Dhaka, Bangladesh</p>
                </div>

                <div class="email">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info.dnba@gmail.com</p>
                </div>

                <div class="phone">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>01977449960</p>
                  <p>01799384759</p>
                </div>

              </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0">

                <form action="" method="" role="form" id="sendForm" class="php-email-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Name">
                            <div class="nameError text-danger errors d-none"></div>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
                            <div class="emailError text-danger errors d-none"></div>
                        </div>
                        {{-- <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Your Phone">
                            <div class="phoneError text-danger errors d-none"></div>
                        </div> --}}
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                        <div class="subjectError text-danger errors d-none"></div>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
                        <div class="messageError text-danger errors d-none"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="send_mail">Send Message</button>
                    </div>
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
<script>
    $(document).on('submit', '#sendForm', function (e) {
        e.preventDefault;
        let name = $('#name').val();
        let email = $('#email').val();
        let subject = $('#subject').val();
        let message = $('#message').val();

        // console.log(name + email + subject + message);

        $.ajax({
            type: "POST",
            url: "{{ route('contactMail') }}",
            data: {
                name:name, email:email, subject:subject, message:message
            },
            success: function (res) {
                // $("#sendForm")[0].reset();
                // location.reload();
                // console.log(response);
                if (res.status == 400) {
                    $('.errors').html('');
                    $('.errors').removeClass('d-none');

                    $('.nameError').text(res.errors.name);
                    $('.emailError').text(res.errors.email);
                    $('.subjectError').text(res.errors.subject);
                    $('.messageError').text(res.errors.message);
                } else {
                    $('#sendForm')[0].reset();
                    $('.errors').html('');
                    $('.errors').removeClass('d-none');

                    Command: toastr["success"]("We Have Received Your Mail", "Thank You!")
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
            }
        });
    });
</script>
@endsection
