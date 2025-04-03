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
                            <input type="hidden" id="member_id">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" >Comitee </label>
                            <select class="selectpicker form-control" data-live-search="true" id="comitee">
                                <option  disabled selected>plesse select</option>
                                <option value="Nawabganj">Nawabganj</option>
                                <option value="Dohar">Dohar</option>
                                <option value="Central">Central</option>

                                <!-- Add more years as needed -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="year1">Start Year:</label>
                            <input type="text" class="yearpicker1 form-control" id="year1" >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="year2">End Year:</label>

                            <input type="text" class="yearpicker2 form-control" id="year2" >
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-label" for="yearSelector">Select  Member :</label>
                            <select class="selectpicker form-control" data-live-search="true" id="bankuserSelector">
                            <option disabled selected>please selecta value</option>

                            @foreach($data as $datas)
                                <option value={{$datas->id}}>{{$datas->name}}</option>
                                @endforeach

                                <!-- Add more years as needed -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" >Designation</label>
                            <select class="selectpicker form-control" data-live-search="true" id="designation">
                                <option disabled selected>plesse select</option>
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
                        <div class="col-md-4">
                            <label class="form-label" for="priority">Priority</label>

                            <input type="number" class="form-control" id="priority" placeholder="1,2,3...">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input " type="checkbox" value="" id="check" >
                                <label class="form-label" for="flexCheckChecked">
                                  Current Comitee
                                </label>
                              </div>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary mt-4 pb-2 pt-1" id="addtotable">Add</button>

                        </div>

                    </div>








                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
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
                                        <th class="hidden">check</th>
                                        <th class="hidden">Member_ID</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                        <button id="submit" class="btn btn-success">Submit </button>
                    </div>


                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
</div> <!-- /.content-wrapper -->
</div> <!-- /.content-wrapper -->





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
        var bankuser;
        var year2;
        var year1;
        var comitee_des;
        var comitee;
        // var designation

    $('#bankuserSelector').change(function (e) {
        e.preventDefault();
        let bankuser = $('#bankuserSelector').val();


        $.ajax({
            type: "get",
            url: "bankuser-info",
            data:{bankuser:bankuser},
            success: function (response) {
                if (response.status === 200) {
                    // console.log(response)
                    let responses=response.data;

                    name= responses.name;
                    nid= responses.nid;
                    mobile= responses.contact;
                    designation= responses.designation_id;
                    // $.ajax({
                    //     type: "GET",
                    //     url: "/designation-get/"+id,
                    //     success: function (response) {
                    //         // console.log(response)
                    //         designation = response.designation;

                    //     }
                    // });
                    bank= responses.bank_name;
                    member_id= responses.id


                }


            }
        });

    });
    $('#addtotable').click(function (e) {
                    e.preventDefault();
                    var year2=  $('#year2').val();
                    var year1=  $('#year1').val();
                    // console.log(year1)
                    // console.log(year2)
                    var comitee_des=  $('#designation').val();
                    var comitee=  $('#comitee').val();
                    let bankuser = $('#bankuserSelector').val();
                    let checkbox = document.getElementById('check');
                    let priority =$('#priority').val();


                    // Check if the checkbox is checked
                    let check = checkbox.checked ? 1 : 0;



        if (year2 !== '' && year1 !== '' && comitee_des !== null && comitee !== null && bankuser!==null && priority!==null) {
                    $('#tbody').append(`
                <tr>
                    <td>${name}</td>
                    <td>${mobile}</td>
                    <td>${nid}</td>
                    <td>${designation}</td>
                    <td>${bank}</td>
                    <td>${comitee_des}</td>
                    <td>${year1}</td>
                    <td>${year2}</td>
                    <td>${comitee}</td>
                    <td>${priority}</td>
                    <td class="hidden">${check}</td>
                    <td class="hidden">${member_id}</td>


                </tr>`);

                // $('#bankuserSelector').val('');
                // $('#year2').val('');
                // $('#year1').val('');
                $('#bankuserSelector').selectpicker('val', '');
                $('#designation').selectpicker('val', '');
                // $('#comitee').selectpicker('val', '');
                name = null;
                nid = null;
                mobile = null;
                designation = null;
                bank = null;
            }
            else
            {

                $.notify('all feilds must be filled', 'danger')

            }


                });
});

</script>
<script>

    $('#submit').click(function (e) {
        e.preventDefault();
        let data= {};

        var datas=[];

        $('.table tbody > tr').each(function () {
        const designation = {};
        designation["name"] = $(this).find("td:eq(0)").text();
        designation["contact"] = $(this).find("td:eq(1)").text();
        designation["nid"] = $(this).find("td:eq(2)").text();
        designation["designation"] = $(this).find("td:eq(3)").text();
        designation["bank"] = $(this).find("td:eq(4)").text();
        designation["comitee_des"] = $(this).find("td:eq(5)").text();
        designation["year1"] = $(this).find("td:eq(6)").text();
        designation["year2"] = $(this).find("td:eq(7)").text();
        designation["comitee"] = $(this).find("td:eq(8)").text();
        designation["priority"] = $(this).find("td:eq(9)").text();
        designation["check"] = $(this).find("td:eq(10)").text();
        designation["member_id"] = $(this).find("td:eq(11)").text();

        datas.push(designation);
            });

        data["designations"]=datas;
        // console.log(data)

            $.ajax({
                type: "post",
                url: "\store_designation",
                data: JSON.stringify(data),
                dataType: "json",
                contentType: "application/json",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                     $.notify(response.messsege, 'success')
                    $(location).attr('href','/comitee-designation-list');
                }
            });

    });
</script>



@endsection
