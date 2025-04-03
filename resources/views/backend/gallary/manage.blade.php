
@extends('layouts.master')
@section('title', 'Photo Gallary List')



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
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Photo Gallary</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" >Gallary Photo </label>
                                        <input type="file" class="form-control" name="gallary" id="gallary">
                                        <div class="gallaryError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 pb-2 pt-1" id="addtotable">Save</button>
                                    </div>
                                </div>
                            </form>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Gallary Photo</th>
                                        <th>Action</th>
                                        {{-- <th class="hidden">check</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ( $photoGallaries as $key => $photoGallary )
                                        <tr>
                                            <th scope="row">{{ ++$key}}</th>
                                            <td>
                                                @if ( !is_null($photoGallary->image) )
                                                    <img src="{{ asset('images/gallary/' . $photoGallary->image ) }}" alt="" width="100">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" id="{{ $photoGallary->id }}" class="editIcon" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i></a>
                                                {{-- <a href="{{ route('destroy.bankUser', $bankUser->id) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash" style="color: red"></i></a> --}}
                                                <a href="" id="{{ $photoGallary->id }}"  class="deleteIcon" >
                                                    <i class="fas fa-trash" style="color: red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                        {{-- <button id="submit" class="btn btn-success">Submit </button> --}}
                    </div>


                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
</div>
</div>

@include('backend.gallary.edit_modal')
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
<script>
    $(document).ready(function () {
        // let table = new DataTable('#myTable');
        $("#myTable").DataTable({
            responsive: true
        });

        // Add data
        $(document).on('submit', '#addForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            // const fd = new FormData(this);
            // console.log(fd);
            $.ajax({
                type: "POST",
                url: "{{ route('gallary.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);

                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.gallaryError').text(res.errors.gallary);
                    } else {
                        $('#addForm')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('.table').load(location.href+' .table');

                        Command: toastr["success"]("Added!", "Successfully")
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

        // edit user ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            // alert(id);
            $.ajax({
                type: "GET",
                url: "{{ route('gallary.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    // $("#edit_expensive").val(res.name);
                    $("#edit_image").html(
                        '<img src="{{ asset('images/gallary') }}/' + res.image + '" width="100" class="img-fluid img-thumbnail">'
                    );
                    $("#gallary_id").val(res.id);
                    $("#gallary_img").val(res.image);
                }
            });
        });

        // Update data ajax request
        $(document).on('submit', '#updateForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            // let id     = $('#expensiveType_id').val();

            $.ajax({
                type: "POST",
                url: "{{ route('gallary.update') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.gallaryError').text(res.errors.image);
                    } else {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('#updateForm')[0].reset();
                        $("#updateModal").modal('hide');
                        $(location).attr('href','/photo-gallary/manage');
                        // $('.table').load(location.href+' .table');

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

        // delete user ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            // let user_id     = $(this).data('id');
            let id = $(this).attr('id');

            if (confirm('Are you sure to delete this Photo ??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('gallary.destroy') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status == 200) {
                            $('.table').load(location.href+' .table');

                            Command: toastr["error"]("Deleted!", "Successfully")
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
            }
        });

    });
</script>

@endsection










