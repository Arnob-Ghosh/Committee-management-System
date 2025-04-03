
@extends('layouts.master')
@section('title', 'Report of Member')



@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary mt-2">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Report of Member</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="" id="addForm" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Member Type </label>
                                        {{-- <input type="text" class="form-control" name="member_type" id="member_type" placeholder="Member Type" autocomplete="off"> --}}
                                        <select class="form-control" data-live-search="true" name="member_type" id="member_type">
                                            <option disabled selected>Please Select</option>
                                            <option value="Lifetime Member">Lifetime Member</option>
                                            <option value="General Member">General Member</option>
                                            <option value="All">All</option>
                                        </select>
                                        {{-- <div class="amountError text-danger errors d-none"></div> --}}
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 pb-2 pt-1" id="generate_table">Generate</button>
                                        <button type="reset" class="btn btn-danger mt-4 pb-2 pt-1" id="">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#SL.</th>
                                        <th>Member ID</th>
                                        {{-- <th>Image</th> --}}
                                        {{-- <th>Signature</th> --}}
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <th>Blood Group</th>
                                        <th>NID</th>
                                        <th>Nationality</th>
                                        <th>Religion</th>
                                        <th>Date of Birth</th>
                                        <th>Facebook ID</th>
                                        <th>Bank Name</th>
                                        <th>Designation</th>
                                        <th>Branch</th>
                                        <th>District</th>
                                        {{-- <th>Thana</th> --}}
                                        <th>Village</th>
                                        <th>Post Office</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

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

{{-- @include('backend.expensive_amount.edit_modal') --}}
@endsection


@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {

        $(document).on('submit', '#addForm', function (e) {
            e.preventDefault();
            let member_type     = $('#member_type').val();
            $.ajax({
                type: "GET",
                url: "{{ route('show.report.member') }}",
                data: {
                    member_type: member_type,
                    // _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    // console.log(data);
                    $('#myTable').DataTable( {
                        responsive: true,
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
                            'copy', 'csv', 'excel'
                        ],
                        data: data,
                        columns: [
                            {
                                data: "id",
                                "render": function ( data, type, row, meta ) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            { data: "member_id" },
                            // {
                            //     data: "image",
                            //     "render": function ( data, type, row, meta ) {
                            //         return '<img src="{{ asset('images/user') }}/' + data + '" width="100" class="img-fluid img-thumbnail">';
                            //     }
                            // },
                            // {
                            //     data: "signature",
                            //     "render": function ( data, type, row, meta ) {
                            //         return '<img src="{{ asset('images/signature') }}/' + data + '" width="100" class="img-fluid img-thumbnail">';
                            //     }
                            // },
                            { data: "name" },
                            { data: "email" },
                            { data: "contact" },
                            { data: "blood_group" },
                            { data: "nid" },
                            { data: "nationality" },
                            { data: "religion" },
                            { data: "birth_date" },
                            { data: "facebook_id" },
                            { data: "bank_name" },
                            { data: "designation_id" },
                            { data: "branch" },
                            { data: "section" },
                            { data: "village" },
                            { data: "post_office" },
                            /*and so on, keep adding data elements here for all your columns.*/
                        ],

                    });
                }
            });
        });

    });
</script>

@endsection










