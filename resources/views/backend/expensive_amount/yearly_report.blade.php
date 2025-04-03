
@extends('layouts.master')
@section('title', 'Yearly Reports')



@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                <strong>Duration: </strong>
                                @foreach ( App\Models\ExpensiveAmount::oldest()->take(1)->get() as $lastDate )
                                    {{ date('d M Y', strtotime($lastDate->created_at)) }}
                                @endforeach
                                @foreach ( App\Models\ExpensiveAmount::latest()->take(1)->get() as $lastDate )
                                    - {{ date('d M Y', strtotime($lastDate->created_at)) }}
                                @endforeach
                            </h5>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row mb-2 -->
        </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Total Cash in</h4>
                            <h5 class="text-success mx-2">
                                @if ( App\Models\ExpensiveAmount::totalCashInAmount() == 0 )
                                    0 BDT
                                @else
                                    {{ App\Models\ExpensiveAmount::totalCashInAmount() }} BDT
                                @endif
                            </h5>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Total Cash out</h4>
                            <h5 class="text-danger mx-2">
                                @if ( App\Models\ExpensiveAmount::totalCashOutAmount() == 0 )
                                    0 BDT
                                @else
                                    {{ App\Models\ExpensiveAmount::totalCashOutAmount() }} BDT
                                @endif
                            </h5>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Final Balance</h4>
                            <h5 class="text-dark mx-2">
                                @if ( App\Models\ExpensiveAmount::totalBalanceAmount() == 0 )
                                    0 BDT
                                @else
                                    {{ App\Models\ExpensiveAmount::totalBalanceAmount() }} BDT
                                @endif
                            </h5>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row mb-2 -->
        </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary mt-2">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Income & Expense Reports</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('expensive.yearly.page') }}" method="GET" id="addForm" enctype="multipart/form-data">
                                <!--@csrf-->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Start Date </label>
                                        <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date" autocomplete="off">
                                        {{-- <div class="amountError text-danger errors d-none"></div> --}}
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >End Date </label>
                                        <input type="date" class="form-control" name="end_date" id="end_date" placeholder="End Date" autocomplete="off">
                                        {{-- <div class="remarkError text-danger errors d-none"></div> --}}
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 pb-2 pt-1" id="generate_table">Generate</button>
                                        <button type="" id="reset" class="btn btn-danger mt-4 pb-2 pt-1" id="">Reset</button>
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
                                        <th>SL.</th>
                                        <th>Date</th>
                                        <th>Remark</th>
                                        <th>Entry by</th>
                                        <th>Expensive Type</th>
                                        <th>Mode</th>
                                        <th>Cash in (Taka)</th>
                                        <th>Cash out (Taka)</th>
                                        <th>Balance</th>
                                        {{-- <th class="hidden">check</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @if ( $expensiveAmounts )
                                        @php
                                            $totalBalance = 0;
                                        @endphp
                                        @foreach ( $expensiveAmounts as $key => $expensiveAmount )
                                            <tr>
                                                <th scope="row">{{ ++$key}}</th>
                                                <td>{{ date('d M Y', strtotime($expensiveAmount->created_at)) }}</td>
                                                <td>{{ $expensiveAmount->remark }}</td>
                                                <td>{{ $expensiveAmount->entry_by }}</td>
                                                <td>{{ $expensiveAmount->name }}</td>
                                                <td>{{ $expensiveAmount->mode }}</td>
                                                <td><strong class="text-success">{{ $expensiveAmount->cash_in }}</strong></td>
                                                <td><strong class="text-danger">{{ $expensiveAmount->cash_out }}</strong></td>
                                                <td>
                                                    @if($expensiveAmount->cash_in == 0)
                                                        <?php $totalBalance = $totalBalance - $expensiveAmount->cash_out; ?>
                                                    @else
                                                        <?php $totalBalance += $expensiveAmount->cash_in; ?>
                                                    @endif
                                                    {{ $totalBalance}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

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
        $('#myTable').DataTable( {
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>
<script>
    $(document).ready(function () {
        $('#reset').click(function (e) {
            e.preventDefault();
            $(location).attr('href','/expensive-amount/yearly-report');
        });
    });
</script>
<script>
    // $( function() {
    //     $( "#start_date" ).datepicker({
    //         "dateFormate": "yy-mm-dd"
    //     });
    //     $( "#end_date" ).datepicker({
    //         "dateFormate": "yy-mm-dd"
    //     });
    // });

    // $(document).ready(function () {

    //     $(document).on('submit', '#addForm', function (e) {
    //         e.preventDefault();
    //         let start_date     = $('#start_date').val();
    //         let end_date       = $('#end_date').val();
    //         $.ajax({
    //             type: "GET",
    //             url: "{{ route('expensive.yearly.report') }}",
    //             data: {
    //                 start_date: start_date,
    //                 end_date:   end_date,
    //                 // _token: '{{ csrf_token() }}'
    //             },
    //             success: function (data) {
    //                 // console.log(data);
    //                 $('#myTable').DataTable( {
    //                     destroy: true,
    //                     order: [[0, 'asc']],
    //                     paging: true,
    //                     pageLength: 10,
    //                     lengthMenu: [
    //                         [10, 25, 50, -1],
    //                         [10, 25, 50, 'All']
    //                     ],
    //                     dom: 'lBfrtip',
    //                     buttons: [
    //                         'copy', 'csv', 'excel', 'pdf', 'print'
    //                     ],
    //                     data: data,
    //                     columns: [
    //                         {
    //                             data: "id",
    //                             "render": function ( data, type, row, meta ) {
    //                                 return meta.row + meta.settings._iDisplayStart + 1;
    //                             }
    //                         },
    //                         {
    //                             data: "created_at",
    //                             "render": function (data, type, row) {
    //                                 return moment(new Date(data)).format('lll');
    //                             }
    //                         },
    //                         { data: "remark" },
    //                         { data: "entry_by" },
    //                         { data: "name" },
    //                         { data: "mode" },
    //                         {
    //                             data: "cash_in",
    //                             "render": function ( data, type, row, meta ) {
    //                                 return '<span class="text-success">'+data+'</span>';
    //                             }
    //                         },
    //                         {
    //                             data: "cash_out",
    //                             "render": function ( data, type, row, meta ) {
    //                                 return '<span class="text-danger">'+data+'</span>';
    //                             }
    //                         },
    //                         { data: "amount"},
    //                         /*and so on, keep adding data elements here for all your columns.*/
    //                     ],

    //                 });
    //             }
    //         });
    //     });


    //     // $('#myTable').DataTable( {
    //     //     order: [[0, 'asc']],
    //     //     paging: true,
    //     //     pageLength: 10,
    //     //     lengthMenu: [
    //     //         [10, 25, 50, -1],
    //     //         [10, 25, 50, 'All']
    //     //     ],
    //     //     dom: 'lBfrtip',
    //     //     buttons: [
    //     //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     //     ],
    //     //     ajax: {
    //     //         url: "{{ route('expensive.yearly.report') }}",
    //     //         method: "GET",
    //     //     },
    //     //     columns: [
    //     //         {
    //     //             data: "id",
    //     //             "render": function ( data, type, row, meta ) {
    //     //                 return meta.row + meta.settings._iDisplayStart + 1;
    //     //             }
    //     //         },
    //     //         {
    //     //             data: "created_at",
    //     //             "render": function (data, type, row) {
    //     //                 return moment(new Date(data)).format('lll');
    //     //             }
    //     //             // "render": function ( data, type, row, meta ) {
    //     //             //     return '<a href="'+data+'">Download</a>';
    //     //             // }
    //     //         },
    //     //         { data: "remark" },
    //     //         { data: "entry_by" },
    //     //         { data: "name" },
    //     //         { data: "mode" },
    //     //         {
    //     //             data: "cash_in",
    //     //             "render": function ( data, type, row, meta ) {
    //     //                 return '<span class="text-success">'+data+'</span>';
    //     //             }
    //     //         },
    //     //         {
    //     //             data: "cash_out",
    //     //             "render": function ( data, type, row, meta ) {
    //     //                 return '<span class="text-danger">'+data+'</span>';
    //     //             }
    //     //         },
    //     //         { data: "amount"},
    //     //         /*and so on, keep adding data elements here for all your columns.*/
    //     //     ],

    //     // });
    // });
</script>

@endsection










