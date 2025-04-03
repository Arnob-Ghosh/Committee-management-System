@extends('layouts.master')
@section('title', 'Create Program')



@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Create Program</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Program Name </label>
                                        <input type="text" class="form-control" name="programme_name" id="programme_name">
                                        <div class="programme_nameError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Program Start Date </label>
                                        <input type="date" class="form-control" name="start_date" id="start_date">
                                        <div class="start_dateError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Program End Date </label>
                                        <input type="date" class="form-control" name="end_date" id="end_date">
                                        <div class="end_dateError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Program Status</label>
                                        <select class="form-control" data-live-search="true" name="status" id="status">
                                            <option  disabled selected>please select</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="statusError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Registration Fees </label>
                                        <input type="text" class="form-control" name="registration_fees" id="registration_fees">
                                        <div class="registration_feesError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 pb-2 pt-1" id="addtotable">Save</button>
                                    </div>
                                </div>
                            </form>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Program Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Registration Fees</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
</div>
</div>

@include('backend.programme.edit_status_model')
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

        // Add data
        $(document).on('submit', '#addForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            // const fd = new FormData(this);
            // console.log(fd);
            $.ajax({
                type: "POST",
                url: "{{ route('programme.date.store') }}",
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
                        $('.start_dateError').text(res.errors.start_date);
                        $('.end_dateError').text(res.errors.end_date);
                        $('.statusError').text(res.errors.status);
                    } else {
                        $('#addForm')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        // $('.table').load(location.href+' .table');
                        location.reload();
                        // window.location.href = "{{ route('expensive.amount.manage') }}";

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

        // List View Datatable Ajax
        $('#myTable').DataTable( {
            order: [[0, 'asc']],
            paging: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "{{ route('programme.date.list') }}",
                method: "GET",
            },
            columns: [
                {
                    data: "id",
                    "render": function ( data, type, row, meta ) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: "programme_name" },
                { data: "start_date" },
                { data: "end_date" },
                { data: "registration_fees" },
                {
                    data: "status",
                    "render": function ( data, type, row, meta ) {
                        if(data !== 0){
                            return '<span class="badge bg-primary">Active</span>';
                        }else{
                            return '<span class="badge bg-warning">Inactive</span>';
                        }
                    }
                },
                {
                    data: null,
                    "render": function (data, type, row) {
                        // Generate buttons using HTML
                        return '<a href="" id="' + row.id + '" class="editIcon" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i></a>' +
                                '<a href="" id="' + row.id + '" class="deleteIcon"><i class="fas fa-trash" style="color: red"></i></a>';
                    }
                },
                /*and so on, keep adding data elements here for all your columns.*/
            ],

        });

        // edit user ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            // alert(id);
            $.ajax({
                type: "GET",
                url: "{{ route('programme.date.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    $("#edit_programme_name").val(res.programme_name);
                    $("#edit_start_date").val(res.start_date);
                    $("#edit_end_date").val(res.end_date);
                    $("#edit_status").val(res.status);
                    $("#edit_registration_fees").val(res.registration_fees);
                    $("#programme_id").val(res.id);
                }
            });
        });

        //Update data ajax request
        $(document).on('submit', '#updateForm', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('programme.date.update') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.edit_programme_nameError').text(res.errors.edit_programme_name);
                        $('.edit_start_dateError').text(res.errors.edit_start_date);
                        $('.edit_end_dateError').text(res.errors.edit_end_date);
                        $('.edit_statusError').text(res.errors.edit_status);
                    } else {
                        $('#updateForm')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $("#updateModal").modal('hide');
                        location.reload();
                        // $(location).attr('href','/bank-user/manage');
                        // $('.table').load(location.href+' .table');

                        Command: toastr["success"]("Upadated!", "Successfully")
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

            if (confirm('Are you sure to delete this info ?')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('programme.date.destroy') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status == 200) {
                            // $('#myTable').load(location.href+' #myTable');
                            location.reload();

                            Command: toastr["success"]("Deleted!", "Successfully")
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










