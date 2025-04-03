
@extends('layouts.master')
@section('title', 'Dead Member List')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Dead Members</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Member ID </label>
                                        <select class="selectpicker form-control" data-live-search="true" name="member_id" id="member_id">
                                            <option  disabled selected>please select</option>
                                            @foreach ( $bankUsers as $bankUser )
                                                <option value="{{ $bankUser->member_id }}">{{ $bankUser->member_id }}</option>
                                            @endforeach
                                            <!-- Add more years as needed -->
                                        </select>
                                        <div class="member_idError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Name </label>
                                        <input type="text" class=" form-control" name="name" id="name">
                                        {{-- <select class=" form-control" data-live-search="true" name="name" id="name">
                                            <option  disabled selected>please select</option>
                                            <!-- Add more years as needed -->
                                        </select> --}}
                                        <div class="nameError text-danger errors d-none"></div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <label class="form-label" >Name </label>
                                        <input type="text" class="form-control" name="name" id="name">
                                        <div class="nameError text-danger errors d-none"></div>
                                    </div> --}}
                                    <div class="col-md-3">
                                        <label class="form-label" >Dead Date </label>
                                        <input type="date" class="form-control" name="mourn_date" id="mourn_date">
                                        <div class="mourn_dateError text-danger errors d-none"></div>
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
                                        {{-- <th>Image</th> --}}
                                        <th>Member ID</th>
                                        <th>Name</th>
                                        <th>Dead Date</th>
                                        <th>Action</th>
                                        {{-- <th class="hidden">check</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ( $mournMembers as $key => $mournMember )
                                        <tr>
                                            <th scope="row">{{ ++$key}}</th>
                                            {{-- <td>
                                                @if ( !is_null($mournMember->bankUser->image) )
                                                    <img src="{{ asset('images/user/' . $mournMember->bankUser->image ) }}" alt="" width="70" class="img-fluid img-thumbnail">
                                                @else
                                                    N/A
                                                @endif
                                            </td> --}}
                                            {{-- <td>{{ $mournMember->user->name }}</td> --}}
                                            <td>{{ $mournMember->member_id }}</td>
                                            <td>{{ $mournMember->name }}</td>
                                            <td>{{ $mournMember->died_date }}</td>
                                            <td>
                                                <a href="" id="{{ $mournMember->id }}" class="editIcon" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i></a>
                                                {{-- <a href="{{ route('destroy.bankUser', $bankUser->id) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash" style="color: red"></i></a> --}}
                                                <a href="" id="{{ $mournMember->id }}"  class="deleteIcon" >
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
</div> <!-- /.content-wrapper -->
</div> <!-- /.content-wrapper -->

@include('backend.mourn_member.edit_modal')
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
                url: "{{ route('mourn.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);

                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.member_idError').text(res.errors.member_id);
                        $('.nameError').text(res.errors.name);
                        $('.mourn_dateError').text(res.errors.mourn_date);
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
                url: "{{ route('mourn.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    $("#edit_member_id").val(res.member_id);
                    $("#edit_name").val(res.name);
                    $("#edit_mourn_date").val(res.died_date);
                    $("#mourn_id").val(res.id);
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
                url: "{{ route('mourn.update') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.member_idError').text(res.errors.member_id);
                        $('.nameError').text(res.errors.name);
                        $('.mourn_dateError').text(res.errors.mourn_date);
                    } else {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('#updateForm')[0].reset();
                        $("#updateModal").modal('hide');
                        $(location).attr('href','/mourn-member/manage');
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

            if (confirm('Are you sure to delete this Mourn Member Info ??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('mourn.destroy') }}",
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

        // find user ajax request
        $("#member_id").change(function (e) {
            e.preventDefault();
            let member_id = $(this).val();
            // console.log(member_id);
            $.ajax({
                type: "GET",
                url: "{{ route('mourn.find') }}",
                data: {
                    member_id: member_id,
                },
                success: function (res) {
                    // console.log(res.name);
                    $("#name").val(res.name);
                }
            });
        });

    });
</script>

@endsection










