
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
                    <div class="col-lg-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Add New Member</strong></h5>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_id">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" >Comitee </label>
                                            <select class="selectpicker form-control" data-live-search="true" id="comitee">
                                                <option  disabled selected>plesse select</option>
                                            <option value="Nawabganj">Nawabganj</option>
                                            <option value="Dohar">Dohar</option>
                                            <option value="Central">Central</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" >Duration </label>
                                            <select class="selectpicker form-control" data-live-search="true" id="committee_year">
                                                <option  disabled selected>plesse select</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" hidden>
                                            <div class="form-check mt-4 pt-2">
                                                <input class="form-check-input " type="checkbox" value="" id="check" >
                                                <label class="form-label" for="flexCheckChecked">
                                                Current Comitee
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                <div class="row mb-3">

                                    <div class="col-md-6">
                                        <label class="form-label" for="yearSelector">Select  Member :</label>
                                        <select class="selectpicker form-control" data-live-search="true" id="bankuserSelector">
                                        <option disabled selected>please select a value</option>

                                        @foreach($data as $datas)
                                            <option value={{$datas->id}}>{{$datas->name}}</option>
                                            @endforeach

                                            <!-- Add more years as needed -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
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
                                            <option value="Executive Member">Executive Member</option>
                                            <option value="Member">Member</option>
                                        </select>

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="priority">Priority</label>

                                        <input type="number" class="form-control" id="priority" placeholder="1,2,3...">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5"></div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary mt-4 pb-2 pt-1" id="submit">Submit</button>

                                    </div>

                                </div>
                                <div class="row" hidden>
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

                                    </div>
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
$(document).ready(function () {
        var bankuser;
        var year2;
        var year1;
        var comitee_des;
        var comitee;


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
                    // console.log(designation);

                    bank= responses.bank_name;
                    member_id= responses.id


                }


            }
        });

    });

});

</script>
<script>


$("#comitee").change(function (e) {
        e.preventDefault();
        $('#priority').val('');

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

        $('#committee_year').change(function (e) {
            e.preventDefault();
            $('#priority').val('');

            var comitee=  $('#comitee').val();

            duration=$('#committee_year').val();
            $.ajax({
                type: "GET",
                url: "/priority-get",
                data:{ duration : duration, comitee : comitee },
                success: function (response) {
                    priority= parseInt(response.data.priority)
                    priority=priority+1;
                    $('#priority').val(priority);
                    var current = response.data.current;
                    if (current === 1) {
                        $('#check').prop('checked', true);
                    } else {
                        $('#check').prop('checked', false);
                    }


                }
            });

        });

    $('#submit').click(function (e) {
        e.preventDefault();
                let duration = $('#committee_year').val();
                    let rangeValues = duration.split('-');

                    // let startYear = rangeValues[0];
                    // let endYear = rangeValues[1];
                    var year2=  rangeValues[1];
                    var year1=  rangeValues[0];
                    // console.log(year1)
                    // console.log(year2)
                    var comitee_des=  $('#designation').val();
                    var comitee=  $('#comitee').val();
                    let bankuser = $('#bankuserSelector').val();
                    let checkbox = document.getElementById('check');
                    let priority =$('#priority').val();



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










