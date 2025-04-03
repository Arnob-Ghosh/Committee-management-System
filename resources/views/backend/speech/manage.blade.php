
@extends('layouts.master')
@section('title', 'Speech List')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Speech List</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" >Role </label>
                                        <select class="selectpicker form-control" data-live-search="true" name="role" id="role">
                                            <option  disabled selected>plesse select</option>
                                            <option value="President">President</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Advisor">Advisor</option>

                                            <!-- Add more years as needed -->
                                        </select>
                                        <div class="roleError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" placeholder="">
                                        <div class="imageError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Status</label>
                                        <select class="selectpicker form-control" data-live-search="true" name="status" id="status">
                                        <option disabled selected>please select a value</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>

                                            <!-- Add more years as needed -->
                                        </select>
                                        <div class="statusError text-danger errors d-none"></div>
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label class="form-label" for="">Title</label>
                                        <textarea name="title" class="form-control" id="title" cols="30" rows="2"></textarea>
                                        {{-- <input type="text" class="form-control" id="title" placeholder=""> --}}
                                        <div class="titleError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Description</label>
                                        <textarea name="long_desc" class="form-control" id="long_desc" cols="30" rows="2"></textarea>
                                        <div class="long_descError text-danger errors d-none"></div>

                                        {{-- <input type="text" class="form-control" id="year2" placeholder="Enter end year"> --}}
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
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        {{-- <th class="hidden">check</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ( $speeches as $key => $speech )
                                        <tr>
                                            <th scope="row">{{ ++$key}}</th>
                                            <td>
                                                @if ( !is_null($speech->image) )
                                                    <img src="{{ asset('images/news/' . $speech->image ) }}" alt="" height="50" width="50" class="img-fluid">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $speech->title }}</td>
                                            <td>{{ $speech->long_desc }}</td>
                                            <td>{{ $speech->role }}</td>
                                            <td>
                                                @if( $speech->status == 1 )
                                                    <span class="badge bg-primary">Active</span>
                                                @elseif( $speech->status == 0 )
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" id="{{ $speech->id }}" class="editIcon" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i></a>
                                                {{-- <a href="{{ route('destroy.bankUser', $bankUser->id) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash" style="color: red"></i></a> --}}
                                                <a href="" id="{{ $speech->id }}"  class="deleteIcon" >
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

@include('backend.speech.edit_modal')
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
                url: "{{ route('speech.store') }}",
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
                        $('.long_descError').text(res.errors.long_desc);
                        $('.roleError').text(res.errors.role);
                        $('.imageError').text(res.errors.image);
                        $('.statusError').text(res.errors.status);
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
                url: "{{ route('speech.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    $("#edit_title").val(res.title);
                    $("#edit_long_desc").val(res.long_desc);
                    $("#edit_role").val(res.role);
                    $("#edit_status").val(res.status);
                    $("#edit_image").html(
                        '<img src="{{ asset('images/news') }}/' + res.image + '" width="100" class="img-fluid img-thumbnail">'
                    );
                    $("#speech_id").val(res.id);
                    $("#speech_img").val(res.image);
                }
            });
        });

        // Update data ajax request
        $(document).on('submit', '#updateForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            let id     = $('#speech_id').val();

            $.ajax({
                type: "POST",
                url: "{{ route('speech.update') }}",
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
                        $('.long_descError').text(res.errors.long_desc);
                        $('.roleError').text(res.errors.role);
                        $('.imageError').text(res.errors.image);
                        $('.statusError').text(res.errors.status);
                    } else {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('#updateForm')[0].reset();
                        $("#updateModal").modal('hide');
                        // $('.table').load(location.href+' .table');
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

        // delete user ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            // let user_id     = $(this).data('id');
            let id = $(this).attr('id');

            if (confirm('Are you sure to delete this user ??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('speech.destroy') }}",
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










