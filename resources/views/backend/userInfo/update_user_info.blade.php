@extends('layouts.master')
@section('title', 'Update Personal Info')



@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row mb-2 -->
        </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Edit Personal Information</h5>
                                </div>
                                <div class="dropdown options ms-auto">
                                    {{-- <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @role('admin')
                            @else
                            @endrole --}}
                            <form action="{{ route('update.userInfo') }}" id="update_user_info_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ( Auth::user()->bankUser )

                                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->bankUser->id }}" >

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">Designation</label>
                                                <input type="text" name="designation_id" id="designation_id" class="form-control" value="{{ Auth::user()->bankUser->designation_id }}" >
                                                <div class="designation_idError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">Bank Name</label>
                                                <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ Auth::user()->bankUser->bank_name }}" >
                                                <div class="bank_nameError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">Branch</label>
                                                <input type="text" name="branch" id="branch" class="form-control" value="{{ Auth::user()->bankUser->branch }}" >
                                                <div class="branchError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">District</label>
                                                <input type="text" name="district" id="district" class="form-control" value="{{ Auth::user()->bankUser->district }}" >
                                                <div class="districtError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">phone</label>
                                                <input type="text" name="contact" id="contact" class="form-control" value="{{ Auth::user()->bankUser->contact }}" >
                                                <div class="contactError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">Image</label>
                                                <input type="file" name="image" id="image" class="form-control" value="" >
                                                <img src="{{ asset('images/user/'. Auth::user()->bankUser->image ) }}" alt="" width="100" class="img-fluid">
                                                <div class="imageError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label for="">Signature</label>
                                                <input type="file" name="signature" id="signature" class="form-control" value="" >
                                                <img src="{{ asset('images/signature/'. Auth::user()->bankUser->signature ) }}" alt="" width="100" class="img-fluid">
                                                <div class="signatureError text-danger errors d-none"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mt-2">
                                            <button type="submit" id="" class="btn btn-primary px-5 add_bank_user_btn">Save Changes</button>
                                        </div>

                                    </div>
                                @endif
                            </form>
                            {{-- <form action="{{ route('update.userInfo') }}" id="update_user_info_form" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->bankUser->id }}" >

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="">
                                            <label for="">Designation</label>
                                            <input type="text" name="designation_id" id="designation_id" class="form-control" value="{{ Auth::user()->bankUser->designation_id }}" >
                                            <div class="designation_idError text-danger errors d-none"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="">
                                            <label for="">Bank Name</label>
                                            <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ Auth::user()->bankUser->bank_name }}" >
                                            <div class="bank_nameError text-danger errors d-none"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="">
                                            <label for="">Branch</label>
                                            <input type="text" name="branch" id="branch" class="form-control" value="{{ Auth::user()->bankUser->branch }}" >
                                            <div class="branchError text-danger errors d-none"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="">
                                            <label for="">District</label>
                                            <input type="text" name="district" id="district" class="form-control" value="{{ Auth::user()->bankUser->district }}" >
                                            <div class="districtError text-danger errors d-none"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="">
                                            <label for="">phone</label>
                                            <input type="text" name="contact" id="contact" class="form-control" value="{{ Auth::user()->bankUser->contact }}" >
                                            <div class="contactError text-danger errors d-none"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-2">
                                        <button type="submit" id="" class="btn btn-primary px-5 add_bank_user_btn">Save Changes</button>
                                    </div>

                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

@endsection

@section('script')

<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
{{-- <script>
    $(document).ready(function () {

        // Update data ajax request
        $(document).on('submit', '#update_user_info_form', function (e) {
            e.preventDefault();
            // let fd = new FormData(this);
            let id              = $('#user_id').val();
            let designation     = $('#designation_id').val();
            let bank_name       = $('#bank_name').val();
            let branch          = $('#branch').val();
            let district        = $('#district').val();
            let contact         = $('#contact').val();
            alert(designation);

            $.ajax({
                type: "POST",
                url: "{{ route('x') }}",
                data: {
                    designation:designation,
                    bank_name:bank_name,
                    branch:branch,
                    district:district,
                    contact:contact
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.designation_idError').text(res.errors.designation_id);
                        $('.bank_nameError').text(res.errors.bank_name);
                        $('.branchError').text(res.errors.branch);
                        $('.districtError').text(res.errors.district);
                        $('.contactError').text(res.errors.contact);
                    } else {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('#update_user_info_form')[0].reset();
                        location.reload();

                        Command: toastr["success"]("Updated!", "Successfully")
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

    });
</script> --}}

@endsection
