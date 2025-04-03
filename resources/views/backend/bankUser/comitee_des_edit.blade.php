@extends('layouts.master')
@section('title', 'Comitee Management')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Comitee Management</strong></h5>
                        </div>
                        <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label" >Comitee </label>
                            <select class="selectpicker form-control" data-live-search="true" id="comitee">
                                <option  disabled selected>plesse select</option>
                                <option value="Nawabganj">Nawabganj</option>
                                <option value="Dohar">Dohar</option>
                                <option value="Central">Central</option>

                                <!-- Add more years as needed -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="committee">Committee Year:</label>
                            {{-- <input type="text" class="form-control" id="committee_year" placeholder="Selec committee"> --}}
                            <select class="selectpicker form-control" data-live-search="true" id="committee_year">
                                <option  disabled selected>plesse select</option>


                                <!-- Add more years as needed -->
                            </select>
                        </div>
                        {{-- <div class="col-md-3">
                            <label class="form-label" for="year2">End Year:</label>

                            <input type="text" class="form-control" id="year2" placeholder="Enter end year">
                        </div> --}}
                        <div class="col-md-2">
                            <button class="btn btn-primary mt-4 pb-2 pt-1" id="list" >Submit</button>

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
                                        <th>Committee Designation</th>
                                        <th>Form</th>
                                        <th>To</th>
                                        <th>Comitee</th>
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
                    <div class="col-md-6">
                        <label for="committeeDesignation">Committee Designation</label>
                         <select class="selectpicker form-control" data-live-search="true" id="committeeDesignation">
                            {{-- <option disabled selected>plesse select</option> --}}
                            <option value="President">President</option>
                            <option value="Senior Vice President">Senior Vice President</option>
                            <option value="Vice President">Vice President</option>
                            <option value="General Secretary">General Secretary</option>
                            <option value="Joint Secretary">Joint Secretary</option>
                            <option value="Finance Secretary">Finance Secretary</option>
                            <option value="Assistant Finance Secretary">Assistant Finance Secretary</option>
                            <option value="Organiging Secretary">Organiging Secretary</option>
                            <option value="Assistant Organiging Secretary">Assistant Organiging Secretary</option>
                            <option value="Office Secretary">Office Secretary</option>
                            <option value="Assistant Office Secretary">Assistant Office Secretary</option>
                            <option value="Education Literature Secretary">Education Literature Secretary</option>
                            <option value="Assistant Education Literature Secretary">Assistant Education Literature Secretary</option>
                            <option value="Social Welfare Secretary">Social Welfare Secretary</option>
                            <option value="Assistant Social Welfare Secretary">Assistant Social Welfare Secretary</option>
                            <option value="Publicity & Publication Secretary">Publicity & Publication Secretary</option>
                            <option value="Assistant Publicity & Publication Secretary">Assistant Publicity & Publication Secretary</option>
                            <option value="Sports & Cultural Secretary">Sports & Cultural Secretary</option>
                            <option value="Assistant Sports & Cultural Secretary">Assistant Sports & Cultural Secretary</option>
                            <option value="Research & Planning Secretary">Research & Planning Secretary</option>
                            <option value="Assistant Research & Planning Secretary">Assistant Research & Planning Secretary</option>
                            <option value="Women Affairs Secretary">Women Affairs Secretary</option>
                            <option value="Assistant Women Affairs Secretary">Assistant Women Affairs Secretary</option>
                            <option value="Convener">Convener</option>
                            <option value="Member Secretary">Member Secretary</option>
                            <option value="Executive Member">Executive Member</option>
                            <option value="Member">Member</option>
                         </select>
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
                {{-- <div class="row"> --}}
                    {{-- <div class="col-md-6"> --}}
                        {{-- <label for="comitee">Comitee</label> --}}
                        <input type="hidden" id="comitee"  name="comitee">
                    {{-- </div> --}}
                {{-- </div> --}}
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
         
    });
    $(".yearpicker2").yearpicker({
            year: 2022,
          
    });
</script>
<script>
    $(document).ready(function () {

        $("#comitee").change(function (e) {
        e.preventDefault();
        var selectedCommittee = $(this).val(); // Assuming the value corresponds to the committee name

            $.ajax({
                type: "GET",
                url: "/comitee-get",
                data: {
                    comitee: selectedCommittee
                },
                success: function (response) {
                    // console.log(response);
                    var selectElement = $("#committee_year");
                    selectElement.find('option:not(:first)').remove();

                    if (response.status === 200 && Array.isArray(response.comitee)) {
                        response.comitee.forEach(function (item) {
                            selectElement.append($('<option>', {
                                value: item.duration,
                                text: item.duration
                            }));
                        });
                    } else {
                        console.error("Error in response or structure.");
                        // Handle other cases or errors here
                    }

                    // Refresh selectpicker after appending options
                    selectElement.selectpicker('refresh');
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                }
            });

        });




        $("#list").click(function (e) {
            e.preventDefault();
            var duration=  $('#committee_year').val();
            //  var year1=  $('#year1').val();
             var comitee=  $('#comitee').val();
            if(comitee && duration)
            {

             $.ajax({
                type: "get",
                url: "designation-list",
                data:{comitee: comitee, duration: duration },
                success: function (response) {
                if (response.status === 200) {
                    // console.log(response)

                    var dataTable = $('#dataTable');
                    dataTable.DataTable().destroy();
                    $('#dataTable').DataTable({
                    data: response.data,
                    columns: [
                        {data : 'id', visible: false},
                        { data: 'name' },
                        { data: 'mobile_no' },
                        { data: 'nid' },
                        { data: 'designation' },
                        { data: 'bank_name' },
                        { data: 'comitee_designation' },
                        { data: 'form' },
                        { data: 'to_year' },
                        { data: 'comitee' },
                        { data: 'priority' },

                        {
                            data: null,
                            render: function (data, type, row) {
                                // Generate buttons using HTML
                                return '<button id="edit_btn" data-id="' + row.id + '" data-comitee="' + row.comitee + '" class="btn btn-primary edit_btn btn-sm"><i class="fas fa-edit"></i></button>' +
                                '<button id="del_btn" data-id="' + row.id + '" data-comitee="' + row.comitee + '" class="btn btn-danger del_btn btn-sm"><i class="fas fa-trash-alt"></i></button>';
                            }
                        }
                    ],
                    "ordering": true,
                    "searching": true,
                    });

                    $('#dataTable').on('click', '.edit_btn', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id'); // Retrieves the value of data-id attribute
                        var comitee = $(this).data('comitee');
                        // alert(id);
                        // alert(comitee);
                        $.ajax({
                            type: "get",
                            url: "designation-list-edit/"+id,
                            data: {comitee: comitee},
                            success: function (response) {
                                // console.log(response);
                                responses= response.data;
                                $('#id').val(responses.id);
                                $('#name').val(responses.name);
                                $('#mobileNumber').val(responses.mobile_no);
                                $('#nid').val(responses.nid);
                                $('#designation').val(responses.designation);
                                $('#bankName').val(responses.bank_name);
                                $('#committeeDesignation').val(responses.comitee_designation);
                                $('#committeeDesignation').selectpicker('refresh');
                                $('#form').val(responses.form);
                                $('#to').val(responses.to_year);
                                $('#comitee').val(comitee);
                                $('#priority').val(responses.priority);

                            }
                        });

                        $('#editModal').modal('show');

                    });

                    $('#dataTable').on('click', '#del_btn', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id'); // Retrieves the value of data-id attribute
                        var comitee = $(this).data('comitee');
                        // alert(id);
                        // alert(comitee);
                        $.ajax({
                            type: "post",
                            url: "designation-list-delete/"+id,
                            data: {comitee: comitee},
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                if(response.status===200)
                                {
                                    $.notify('Deleted Successfully', 'success')
                                    $(location).attr('href','/comitee-designation-list');


                                }
                                else{
                                    $.notify('Something Went Wrong', 'danger')

                                }

                            }
                        });


                    });



                }


                }
                });
            }

        });


        $("#save").click(function (e) {
            e.preventDefault();
            let formData = {
                id: $('#id').val(),
                name: $('#name').val(),
                mobileNumber: $('#mobileNumber').val(),
                nid: $('#nid').val(),
                designation: $('#designation').val(),
                bankName: $('#bankName').val(),
                committeeDesignation: $('#committeeDesignation').val(),
                form: $('#form').val(),
                to: $('#to').val(),
                comitee: $('#comitee').val(),
                priority: $('#priority').val()
                };


            $.ajax({
                type: "post",
                url: "update_designation",
                data:  JSON.stringify(formData),
                dataType: "json",
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if (response.status===200)
                    {
                     $.notify('Updated Successfully', 'success')
                     $('#editModal').modal('hide');
                    $(location).attr('href','/comitee-designation-list');


                    }
                    else{
                     $.notify('Something went wrong', 'success')

                    }


                }
            });

        });


    });












</script>

@endsection

