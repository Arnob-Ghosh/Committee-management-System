
@extends('layouts.master')
@section('title', 'Expense Amount Details')



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
                            {{-- <h6>akram</h6> --}}
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Balance Sheet Details</strong></h5>
                        </div>
                        {{-- <div class="card-body">
                            <form action="" method="POST" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Expensive Type </label>
                                        <select class="selectpicker form-control" data-live-search="true" name="expensive" id="expensive">
                                            <option  disabled selected>plesse select</option>
                                            @foreach ( $expensiveTypes as $expensiveType )
                                                <option value="{{ $expensiveType->name }}">{{ $expensiveType->name }}</option>
                                            @endforeach
                                            <!-- Add more years as needed -->
                                        </select>
                                        <div class="expensiveError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Payment Mode </label>
                                        <input type="text" class="form-control" name="mode" id="mode">
                                        <!--<select class="selectpicker form-control" data-live-search="true" name="mode" id="mode">-->
                                        <!--    <option  disabled selected>plesse select</option>-->
                                        <!--    <option value="Bkash">Bkash</option>-->
                                        <!--    <option value="Nagad">Nagad</option>-->
                                        <!--    <option value="Upay">Upay</option>-->
                                        <!--    <option value="Rocket">Rocket</option>-->
                                        <!--</select>-->
                                        <div class="modeError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Payment Type </label>
                                        <select class="selectpicker form-control" data-live-search="true" name="payment_type" id="payment_type">
                                            <option  disabled selected>plesse select</option>
                                            <option value="1">Cash in</option>
                                            <option value="0">Cash out</option>
                                            <!-- Add more years as needed -->
                                        </select>
                                        <div class="payment_typeError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Amount </label>
                                        <input type="number" class="form-control" name="amount" id="amount">
                                        <div class="amountError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Remark </label>
                                        <input type="text" class="form-control" name="remark" id="remark">
                                        <div class="remarkError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 pb-2 pt-1" id="addtotable">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Date</th>
                                        <th>Entry by</th>
                                        <th>Type</th>
                                        <th>Mode</th>
                                        <th>Cash in (Taka)</th>
                                        <th>Cash out (Taka)</th>
                                        <th>Balance</th>
                                        <th>Remark</th>
                                        <th>Action</th>
                                        {{-- <th class="hidden">check</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php
                                        $totalBalance = 0;
                                    @endphp
                                    @foreach ( $expensiveAmounts as $key => $expensiveAmount )
                                        <tr>
                                            <th scope="row">{{ ++$key}}</th>
                                            <td>{{ date('d M Y', strtotime($expensiveAmount->created_at)) }}</td>
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
                                            <td>{{ $expensiveAmount->remark }}</td>
                                            <td>
                                                <a href="" id="{{ $expensiveAmount->id }}" class="editIcon" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i>
                                                </a>
                                                <a href="" id="{{ $expensiveAmount->id }}"  class="deleteIcon" >
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
</div>
</div>

@include('backend.expensive_amount.edit_modal')
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
        $('#myTable').DataTable( {
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

        // Add data
        // $(document).on('submit', '#addForm', function (e) {
        //     e.preventDefault();
        //     let fd = new FormData(this);
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('expensive.amount.store') }}",
        //         data: fd,
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         success: function (res) {
        //             if (res.status == 400) {
        //                 $('.errors').html('');
        //                 $('.errors').removeClass('d-none');

        //                 $('.expensiveError').text(res.errors.expensive);
        //                 $('.modeError').text(res.errors.mode);
        //                 $('.payment_typeError').text(res.errors.payment_type);
        //                 $('.amountError').text(res.errors.amount);
        //                 $('.remarkError').text(res.errors.remark);
        //             } else {
        //                 $('#addForm')[0].reset();
        //                 $('.errors').html('');
        //                 $('.errors').removeClass('d-none');
        //                 location.reload();

        //                 Command: toastr["success"]("Added!", "Successfully")
        //                     toastr.options = {
        //                     "closeButton": true,
        //                     "debug": false,
        //                     "newestOnTop": false,
        //                     "progressBar": true,
        //                     "positionClass": "toast-top-right",
        //                     "preventDuplicates": false,
        //                     "onclick": null,
        //                     "showDuration": "300",
        //                     "hideDuration": "1000",
        //                     "timeOut": "5000",
        //                     "extendedTimeOut": "1000",
        //                     "showEasing": "swing",
        //                     "hideEasing": "linear",
        //                     "showMethod": "fadeIn",
        //                     "hideMethod": "fadeOut"
        //                 }
        //             }
        //         }
        //     });
        // });

        // edit user ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            // alert(id);
            $.ajax({
                type: "GET",
                url: "{{ route('expensive.amount.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    $("#edit_expensive").val(res.name);
                    $("#edit_mode").val(res.mode);
                    // Assuming res.created_at is a valid date string, you can create a new Date object from it
                    var createdDate = new Date(res.created_at);
                    
                    // Function to format date to "yyyy-MM-dd" format
                    function formatDateToISO(date) {
                        var year = date.getFullYear();
                        var month = ('0' + (date.getMonth() + 1)).slice(-2); // Month is zero-based
                        var day = ('0' + date.getDate()).slice(-2);

                        return year + '-' + month + '-' + day;
                    }

                    // Format createdDate to "yyyy-MM-dd"
                    var formattedDate = formatDateToISO(createdDate);

                    // // Define an array with month names
                    // var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    //                 "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                    // // Format the date string as desired (d M Y, g:i a)
                    // var formattedDate = (createdDate.getDate() < 10 ? '0' : '') + createdDate.getDate() + ' ' +
                    //                     monthNames[createdDate.getMonth()] + ' ' + createdDate.getFullYear() + ', ' +
                    //                     ((createdDate.getHours() % 12) || 12) + ':' + (createdDate.getMinutes() < 10 ? '0' : '') + createdDate.getMinutes() + ' ' +
                    //                     (createdDate.getHours() >= 12 ? 'pm' : 'am');

                    // Set the value of the input field
                    $("#edit_date").val(formattedDate);
                    $("#edit_cash_in").val(res.cash_in);
                    $("#edit_cash_out").val(res.cash_out);
                    $("#edit_remark").val(res.remark);
                    $("#expensiveType_id").val(res.id);
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
                url: "{{ route('expensive.amount.update') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.edit_expensiveError').text(res.errors.edit_expensive);
                        $('.edit_modeError').text(res.errors.edit_mode);
                        $('.edit_cash_inError').text(res.errors.edit_cash_in);
                        $('.edit_cash_outError').text(res.errors.edit_cash_out);
                        $('.edit_remarkError').text(res.errors.edit_remark);
                    } else {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('#updateForm')[0].reset();
                        $("#updateModal").modal('hide');
                        // $('.table').load(location.href+' .table');
                        location.reload();

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

            if (confirm('Are you sure to delete this Expensive Amount Info ??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('expensive.amount.destroy') }}",
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

    });
</script>

@endsection










