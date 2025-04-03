
@extends('layouts.master')
@section('title', 'Photo Drive Link List')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Photo Link List</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Title </label>
                                        <input type="text" class="form-control" name="title" id="title">
                                        <div class="titleError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Date </label>
                                        <input type="date" class="form-control" name="date" id="date">
                                        <div class="dateError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Photo Drive Link </label>
                                        <input type="text" class="form-control" name="photo_link" id="photo_link">
                                        <div class="photo_linkError text-danger errors d-none"></div>
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
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Photo Drive Link</th>
                                        <th>Action</th>
                                        {{-- <th class="hidden">check</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ( $photoLinks as $key => $photoLink )
                                        <tr>
                                            <th scope="row">{{ ++$key}}</th>
                                            <td>{{ $photoLink->title }}</td>
                                            <td>{{ $photoLink->date }}</td>
                                            <td>{{ $photoLink->photo_link }}</td>
                                            <td>
                                                <a href="" id="{{ $photoLink->id }}" class="editIcon" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i>
                                                </a>
                                                <a href="" id="{{ $photoLink->id }}"  class="deleteIcon" >
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

@include('backend.photo-link.edit_modal')
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
                url: "{{ route('photo.link.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);

                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.titleError').text(res.errors.title);
                        $('.dateError').text(res.errors.date);
                        $('.photo_linkError').text(res.errors.photo_link);
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
                url: "{{ route('photo.link.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    // $("#edit_expensive").val(res.name);
                    // $("#edit_image").html(
                    //     '<img src="{{ asset('images/gallary') }}/' + res.image + '" width="100" class="img-fluid img-thumbnail">'
                    // );
                    $("#edit_title").val(res.title);
                    $("#edit_date").val(res.date);
                    $("#edit_photo_link").val(res.photo_link);
                    $("#photo_id").val(res.id);
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
                url: "{{ route('photo.link.update') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.titleError').text(res.errors.title);
                        $('.dateError').text(res.errors.date);
                        $('.photo_linkError').text(res.errors.photo_link);
                    } else {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('#updateForm')[0].reset();
                        $("#updateModal").modal('hide');
                        location.reload();
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

            if (confirm('Are you sure to delete this Photo Drive Link ??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('photo.link.destroy') }}",
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










