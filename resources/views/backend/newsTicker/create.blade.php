@extends('layouts.master')
@section('title', 'Create News Ticker')



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
                <div class="col-lg-10">
                    <div class="card radius-10 w-50">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Add NewsTicker</h5>
                                </div>
                                {{-- <div class="dropdown options ms-auto">
                                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('news.ticker.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="mb-3">
                                            <label for="">Short Description</label>
                                            <textarea name="short_desc" class="form-control" id="" cols="30" rows="3" required></textarea>
                                            {{-- <input type="text" name="short_desc" class="form-control"  autocomplete="off"> --}}
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="">Long Description</label>
                                            <textarea name="long_desc" class="form-control" id="" cols="30" rows="5" required></textarea>
                                        </div> --}}
                                        <div class="mb-3">
                                            <label for="">Breaking News</label>
                                            <textarea name="headline" class="form-control" id="" cols="30" rows="3" required></textarea>
                                            {{-- <input type="text" name="headline" class="form-control"  autocomplete="off"> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="">category</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="speech_role" required>
                                                <option>Please Select the Role</option>
                                                {{-- <option value="President">President</option>
                                                <option value="Secretary">Secretary</option>
                                                <option value="Mission and Vision">Mission and Vision</option>
                                                <option value="Notice Board">Notice Board</option> --}}
                                                <option value="Headlines" selected >Headlines</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Active Status</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="status" required>
                                                <option>Please Select the Status</option>
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Image</label>
                                            <input type="file" name="image" class="form-control"  autocomplete="off" >
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary px-5">Save</button>
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
