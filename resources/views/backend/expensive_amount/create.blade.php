
@extends('layouts.master')
@section('title', 'Create Income & Expense')



@section('content')
<div class="content-wrapper">
    {{-- <!-- Content Header (Page header) -->
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
    </div> <!-- /.content-header --> --}}

    {{-- <div class="content-header">
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
    </div> <!-- /.content-header --> --}}

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary mt-2">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i>Create Income & Expense</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" id="addForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label" >Income & Expense Type </label>
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
                                    {{-- <div class="col-md-3">
                                        <label class="form-label" >Cash in </label>
                                        <input type="number" class="form-control" name="cash_in" id="cash_in">
                                        <div class="cash_inError text-danger errors d-none"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" >Cash out </label>
                                        <input type="number" class="form-control" name="cash_out" id="cash_out">
                                        <div class="cash_outError text-danger errors d-none"></div>
                                    </div> --}}
                                    <div class="col-md-3">
                                        <label class="form-label" >Payment Date </label>
                                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="date" id="date">
                                        <div class="dateError text-danger errors d-none"></div>
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

                    {{-- <div class="col-12">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ( $expensiveAmounts as $key => $expensiveAmount )
                                        <tr>
                                            <th scope="row">{{ ++$key}}</th>
                                            <td>{{ date('d M Y, g:i a', strtotime($expensiveAmount->created_at)) }}</td>
                                            <td>{{ $expensiveAmount->remark }}</td>
                                            <td>{{ $expensiveAmount->entry_by }}</td>
                                            <td>{{ $expensiveAmount->name }}</td>
                                            <td>{{ $expensiveAmount->mode }}</td>
                                            <td><strong class="text-success">{{ $expensiveAmount->cash_in }}</strong></td>
                                            <td><strong class="text-danger">{{ $expensiveAmount->cash_out }}</strong></td>
                                            <td>{{
                                                    $balance = $expensiveAmount->cash_in - $expensiveAmount->cash_out
                                                }}
                                             </td>
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
                    </div> --}}


                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
</div>
</div>

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
                url: "{{ route('expensive.amount.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);

                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.expensiveError').text(res.errors.expensive);
                        $('.modeError').text(res.errors.mode);
                        $('.payment_typeError').text(res.errors.payment_type);
                        $('.amountError').text(res.errors.amount);
                        $('.remarkError').text(res.errors.remark);
                        $('.dateError').text(res.errors.date);
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

    });
</script>

@endsection










