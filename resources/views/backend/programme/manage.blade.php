@extends('layouts.master')
@section('title', 'Registration Complete Lists')



@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary mt-2">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Program Details</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="" id="addForm" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Program Name </label>
                                        {{-- <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date" autocomplete="off"> --}}
                                        <select class="form-control" data-live-search="true" name="programme_name" id="programme_name">
                                            <option disabled selected>Please Select</option>
                                            @foreach ( $programmes as $programme )
                                                <option value="{{ $programme->programme_name }}">{{ $programme->programme_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 pb-2 pt-1" id="generate_table">Generate</button>
                                        <button type="reset" class="btn btn-danger mt-4 pb-2 pt-1" id="">Reset</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-12">
                                    <u><h2 class="text-center pg_name" hidden></h2></u>
                                </div>
                                <div class="col-12">
                                    <h5 class="text-center from" hidden></h5>
                                    <h5 class="text-center to" hidden></h5>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>#SL.</th>
                                                <th>Applicant Name</th>
                                                <th>Union</th>
                                                <th>Phone No.</th>
                                                <th>0-5 Years Age</th>
                                                <th>Applicants+Guest</th>
                                                <th>Total Participants No</th>
                                                <th>Tansaction ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <button id="submit" class="btn btn-success">Submit </button> --}}
                            </div>
                        </div>
                    </div>




                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
</div>
</div>

@include('backend.programme.edit_modal')
@endsection


@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
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
        $('#myTable').DataTable();

        $(document).on('submit', '#addForm', function (e) {
            e.preventDefault();
            let programme_name = $('#programme_name').val();

            $('.pg_name').text(programme_name);
            $('.pg_name').removeAttr("hidden");
            $.ajax({
                type: "GET",
                url: "{{ route('programme.listView') }}",
                data: {
                    programme_name: programme_name,
                    // _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    $('.from').text('Program Start Date: ' + data[0].start_date);
                    $('.to').text('Program End Date: ' + data[0].end_date);
                    $('.from').removeAttr("hidden");
                    $('.to').removeAttr("hidden");

                    $('#myTable').DataTable( {
                        destroy: true,
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
                        data: data,
                        columns: [
                            {
                                data: "id",
                                "render": function ( data, type, row, meta ) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            { data: "applicant_name" },
                            { data: "unions" },
                            { data: "phone" },
                            { data: "child_age1" },
                            { data: "child_age2" },
                            { data: "participants_num" },
                            { data: "father_name" },
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
                url: "{{ route('programme.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    $("#edit_programme_name").val(res.programme_name);
                    $("#edit_applicant_name").val(res.applicant_name);
                    $("#edit_father_name").val(res.father_name);
                    $("#edit_union").val(res.unions);
                    // $("#edit_email").val(res.email);
                    $("#edit_phone").val(res.phone);
                    $("#edit_participants_num").val(res.participants_num);
                    $("#edit_child_age1").val(res.child_age1);
                    $("#edit_child_age2").val(res.child_age2);
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
                url: "{{ route('programme.update') }}",
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
                        $('.edit_dateError').text(res.errors.edit_date);
                        $('.edit_applicant_nameError').text(res.errors.edit_applicant_name);
                        $('.edit_father_nameError').text(res.errors.edit_father_name);
                        $('.edit_unionError').text(res.errors.edit_union);
                        // $('.edit_emailError').text(res.errors.edit_email);
                        $('.edit_phoneError').text(res.errors.edit_phone);
                        $('.edit_participants_numError').text(res.errors.edit_participants_num);
                        $('.edit_child_ageError').text(res.errors.edit_child_age);
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
                    url: "{{ route('programme.destroy') }}",
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










