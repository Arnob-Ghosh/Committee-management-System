@extends('layouts.master')
@section('title', 'Union List')



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
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Update Union Information</h5>
                                </div>
                                <div class="dropdown options ms-auto">
                                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('union.update', $union->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="">Union Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Union Name" value="{{ $union->name }}" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Thana Name</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="thana_id">
                                                <option>Please Select the Thana</option>
                                                @foreach ($thanas as $thana)
                                                    <option value="{{ $thana->id }}"

                                                    @if ( $thana->id == $union->thana_id )
                                                        selected
                                                    @endif

                                                    >{{ $thana->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">District Name</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="district_id">
                                                <option>Please Select the District</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}"

                                                    @if ( $district->id == $union->district_id )
                                                        selected
                                                    @endif

                                                    >{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Active Status</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="status">
                                                <option>Please Select the Status</option>
                                                <option value="1" @if ( $district->status == 1) selected @endif >Active</option>
                                                <option value="0" @if ( $district->status == 0) selected @endif  >Inactive</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

@endsection

@section('script')
{{-- <script type="text/javascript" src="{{asset('js/backend/smartPhone.js')}}"></script> --}}

@endsection
