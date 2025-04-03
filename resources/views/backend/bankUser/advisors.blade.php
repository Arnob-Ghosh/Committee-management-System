@extends('layouts.master')
@section('title', 'Advisor Management')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Add Advisors</strong></h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="member_id">

                    <div class="row mb-3">
                        
                        <div class="col-md-4">
                            <label class="form-label" for="year1">Start Year:</label>
                            <input type="text" class="yearpicker1 form-control" id="year1" >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="year2">End Year:</label>

                            <input type="text" class="yearpicker2 form-control" id="year2" >
                        </div>
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
                    </div>

                    <div class="row mb-3">

                        
                      
                        <div class="col-md-4">
                            <label class="form-label" for="priority">Priority</label>

                            <input type="number" class="form-control" id="priority" placeholder="1,2,3...">
                        </div>
                        <div class="col-md-3 pl-5">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input " type="checkbox" value="" id="check" >
                                <label class="form-label" for="flexCheckChecked">
                                  Current Comitee
                                </label>
                              </div>
                        </div>

                        <div class="col-md-3">
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
                                        <th>Form</th>
                                        <th>To</th>
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
            startYear: 2019,
            endYear: 2050,
    });
    $(".yearpicker2").yearpicker({
            year: 2022,
            startYear: 2022,
            endYear: 2055,
    });
</script>
<script>
$(document).ready(function () {
        var bankuser;
        var year2;
        var year1;
        var designation

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
                    let bankuser = $('#bankuserSelector').val();
                    let checkbox = document.getElementById('check');
                    let priority =$('#priority').val();


                    // Check if the checkbox is checked
                    let check = checkbox.checked ? 1 : 0;



        if (year2 !== '' && year1 !== '' && bankuser!==null && priority!==null) {
                    $('#tbody').append(`
                <tr>
                    <td>${name}</td>
                    <td>${mobile}</td>
                    <td>${nid}</td>
                    <td>${designation}</td>
                    <td>${bank}</td>
                    <td>${year1}</td>
                    <td>${year2}</td>
                    <td>${priority}</td>
                    <td class="hidden">${check}</td>
                    <td class="hidden">${member_id}</td>


                </tr>`);

                // $('#bankuserSelector').val('');
                // $('#year2').val('');
                // $('#year1').val('');
                $('#bankuserSelector').selectpicker('val', '');
                // $('#designation').selectpicker('val', '');
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
        const advisor = {};
        advisor["name"] = $(this).find("td:eq(0)").text();
        advisor["contact"] = $(this).find("td:eq(1)").text();
        advisor["nid"] = $(this).find("td:eq(2)").text();
        advisor["designation"] = $(this).find("td:eq(3)").text();
        advisor["bank"] = $(this).find("td:eq(4)").text();
        advisor["year1"] = $(this).find("td:eq(5)").text();
        advisor["year2"] = $(this).find("td:eq(6)").text();
        advisor["priority"] = $(this).find("td:eq(7)").text();
        advisor["check"] = $(this).find("td:eq(8)").text();
        advisor["member_id"] = $(this).find("td:eq(9)").text();

        datas.push(advisor);
            });

        data["advisors"]=datas;
        // console.log(data)

            $.ajax({
                type: "post",
                url: "store-advisors",
                data: JSON.stringify(data),
                dataType: "json",
                contentType: "application/json",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                     $.notify(response.messsege, 'success')
                    $(location).attr('href','/advisors-list');
                }
            });

    });
</script>



@endsection
