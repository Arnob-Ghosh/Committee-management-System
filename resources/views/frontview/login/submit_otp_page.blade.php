<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:600,700,900" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        #body {
            font-family: 'Nunito';
            background-color:  #5d8fc9;
        }
        #login-card{
            width:350px;
            border-radius: 25px;
            margin:150px auto;

        }

        #email{
            border-radius:30px;
            background-color: #ebf0fc;
            border-color: #ebf0fc;
            color: #9da3b0;
        }

        #button{
            border-radius:30px;
        }

        #btn{
            position: absolute;
            bottom: -35px;
            padding: 5px;
            margin: 0px 55px;
            align-items: center;
            border-radius: 5px;
        }
        #container{
            margin-top:25px;
        }

        .btn-circle.btn-sm {
            width: 40px;
            height: 40px;
            padding: 2px 0px;
            border-radius: 25px;
            font-size: 14px;
            text-align: center;
            margin: 8px;
        }
    </style>
</head>
<body id="body">

    <div id="login-card" class="card">
        <div class="card-body">
            <h2 class="text-center">Login with OTP</h2>
            <br>
            <form action="" method="" id="submitForm">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $std->email }}" required>
                    <div class="emailError text-danger errors d-none"></div>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="otp" placeholder="Enter otp" name="otp" required>
                </div>
                <button type="submit" id="button" class="btn btn-primary deep-purple btn-block ">Submit</button>
                <br>
                <br>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Toastr JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Toastr calling JS Methods -->
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
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
</script>
<script>
    @if ( Session::has('message') )
        var type = "{{ Session::get('alert-type', 'info') }}" ;

        switch (type) {
            case 'info':
                toastr.info( "{{ Session::get('message') }}" );
            break;
            case 'success':
                toastr.success( "{{ Session::get('message') }}" );
            break;
            case 'warning':
                toastr.warning( "{{ Session::get('message') }}" );
            break;
            case 'error':
                toastr.error( "{{ Session::get('message') }}" );
            break;
        }
    @endif
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('submit', '#submitForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ route('loginWithOtp') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if ( res.status == 400 ) {
                        // $('#otp').reset();
                        Command: toastr["success"]("Please check your email valid OTP!", "OTP do not match.")
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
                    } else {
                        window.location.href = "{{ route('dashboard') }}";
                    }
                }
            });
        });
    });
</script>

</html>

