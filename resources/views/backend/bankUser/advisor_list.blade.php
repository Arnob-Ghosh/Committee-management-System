@extends('layouts.master')
@section('title', 'Advisor Manangement')



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
                                <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Advisor Management</strong>
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="row mb-3">

                                    <div class="col-md-3">
                                        <label class="form-label" for="committee"> Year:</label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                            id="committee_year">
                                            <option disabled selected>plesse select</option>
                                            @foreach ($data as $data)
                                                <option value={{ $data->duration }}>{{ $data->duration }}</option>
                                            @endforeach


                                            <!-- Add more years as needed -->
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary mt-4 pb-2 pt-1" id="list">Submit</button>

                                    </div>

                                </div>


                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="hidden">id</th>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>NID</th>
                                                    <th>Designation</th>
                                                    <th>Bank Name</th>
                                                    <th>Form</th>
                                                    <th>To</th>
                                                    <th>Priority</th>
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
        </div> <!-- /.content-wrapper -->
    </div> <!-- /.content-wrapper -->








    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name"readonly>
                                <input type="hidden" id="id" class="form-control" name="id">
                            </div>
                            <div class="col-md-6">
                                <label for="mobileNumber">Mobile Number</label>
                                <input type="text" id="mobileNumber" class="form-control" name="mobileNumber"readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nid">NID</label>
                                <input type="text" id="nid" class="form-control" name="nid"readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="designation">Designation</label>
                                <input type="text" id="designation" class="form-control" name="designation"readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="bankName">Bank Name</label>
                                <input type="text" id="bankName" class="form-control" name="bankName"readonly>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="form">Form</label>
                                <input type="text" id="form" class="yearpicker1 form-control" name="form">
                            </div>
                            <div class="col-md-6">
                                <label for="to">To</label>
                                <input type="text" id="to" class="yearpicker2 form-control" name="to">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="form">Priority</label>
                                <input type="text" id="priority" class="form-control" name="priority">
                            </div>

                        </div>

                        <input type="hidden" id="comitee" name="comitee">

                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id ="save"class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>







@endsection

@section('script')
    <script>
        $(".yearpicker1").yearpicker({
            year: 2019,
            startYear: 2019,
            endYear: 2050,
        });
        $(".yearpicker2").yearpicker({
            year: 2022,
            startYear: 2022,
            endYear: 2050,
        });
    </script>
    <script>
        $(document).ready(function() {






            $("#list").click(function(e) {
                e.preventDefault();
                var duration = $('#committee_year').val();

                if (duration) {

                    $.ajax({
                        type: "get",
                        url: "/advisors-list-data",
                        data: {
                            duration: duration
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                // console.log(response)

                                var dataTable = $('#dataTable');
                                dataTable.DataTable().destroy();
                                $('#dataTable').DataTable({
                                    data: response.data,
                                    columns: [{
                                            data: 'id',
                                            visible: false
                                        },
                                        {
                                            data: 'name'
                                        },
                                        {
                                            data: 'mobile_no'
                                        },
                                        {
                                            data: 'nid'
                                        },
                                        {
                                            data: 'designation'
                                        },
                                        {
                                            data: 'bank_name'
                                        },
                                        {
                                            data: 'form'
                                        },
                                        {
                                            data: 'to_year'
                                        },
                                        {
                                            data: 'priority'
                                        },

                                        {
                                            data: null,
                                            render: function(data, type, row) {
                                                // Generate buttons using HTML
                                                return '<button id="edit_btn" data-id="' +
                                                    row.id +

                                                    '" class="btn btn-primary edit_btn btn-sm"><i class="fas fa-edit"></i></button>' +
                                                    '<button id="del_btn" data-id="' +
                                                    row.id +
                                                    '" class="btn btn-danger del_btn btn-sm"><i class="fas fa-trash-alt"></i></button>';
                                            }
                                        }
                                    ],
                                    "ordering": true,
                                    "searching": true,
                                });

                                $('#dataTable').on('click', '.edit_btn', function(e) {
                                    e.preventDefault();
                                    var id = $(this).data(
                                        'id'
                                        ); // Retrieves the value of data-id attribute
                                    // alert(id);
                                    // alert(comitee);
                                    $.ajax({
                                        type: "get",
                                        url: "advisors-list-edit/" + id,
                                      
                                        success: function(response) {
                                            // console.log(response);
                                            responses = response.data;
                                            $('#id').val(responses.id);
                                            $('#name').val(responses.name);
                                            $('#mobileNumber').val(responses.mobile_no);
                                            $('#nid').val(responses.nid);
                                            $('#designation').val(responses.designation);
                                            $('#bankName').val(responses.bank_name);
                                            $('#form').val(responses.form);
                                            $('#to').val(responses.to_year);
                                            $('#priority').val(responses
                                                .priority);

                                        }
                                    });

                                    $('#editModal').modal('show');

                                });

                                $('#dataTable').on('click', '#del_btn', function(e) {
                                    e.preventDefault();
                                    var id = $(this).data(
                                        'id'
                                        ); // Retrieves the value of data-id attribute
                                 
                                    $.ajax({
                                        type: "post",
                                        url: "advisors-list-delete/" + id,
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]')
                                                .attr('content'),
                                        },
                                        success: function(response) {
                                            if (response.status === 200) {
                                                $.notify(
                                                    'Deleted Successfully',
                                                    'success')
                                                $(location).attr('href',
                                                    '/advisors-list'
                                                );


                                            } else {
                                                $.notify(
                                                    'Something Went Wrong',
                                                    'danger')

                                            }

                                        }
                                    });


                                });



                            }


                        }
                    });
                }

            });


            $("#save").click(function(e) {
                e.preventDefault();
                let formData = {
                    id: $('#id').val(),
                    name: $('#name').val(),
                    mobileNumber: $('#mobileNumber').val(),
                    nid: $('#nid').val(),
                    designation: $('#designation').val(),
                    bankName: $('#bankName').val(),
                    form: $('#form').val(),
                    to: $('#to').val(),
                    priority: $('#priority').val()
                };


                $.ajax({
                    type: "post",
                    url: "/update-advisor",
                    data: JSON.stringify(formData),
                    dataType: "json",
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            $.notify('Updated Successfully', 'success')
                            $('#editModal').modal('hide');
                            $(location).attr('href', '/advisors-list');


                        } else {
                            $.notify('Something went wrong', 'error')

                        }


                    }
                });

            });


        });
    </script>

@endsection
