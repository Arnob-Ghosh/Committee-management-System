@extends('layouts.master')
@section('title', 'Edit News Ticker')



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
                            <form action="{{ route('news.ticker.update', $newsTicker->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="mb-3">
                                            <label for="">Short Description</label>
                                            <textarea name="short_desc" class="form-control" id="" cols="30" rows="3" required>{{ $newsTicker->short_desc }}</textarea>
                                            {{-- <input type="text" name="short_desc" class="form-control"  autocomplete="off"> --}}
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="">Long Description</label>
                                            <textarea name="long_desc" class="form-control" id="" cols="30" rows="5" required>{{ $newsTicker->long_desc }}</textarea>
                                        </div> --}}
                                        <div class="mb-3">
                                            <label for="">Breaking News</label>
                                            <textarea name="headline" class="form-control" id="" cols="30" rows="3" required>{{ $newsTicker->headline }}</textarea>
                                            {{-- <input type="text" name="headline" class="form-control"  autocomplete="off"> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Speech Role</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="speech_role" required>
                                                <option>Please Select the Role</option>
                                                {{-- <option value="President" @if ( $newsTicker->speech_role == 'President') selected @endif >President</option>
                                                <option value="Secretary" @if ( $newsTicker->speech_role == 'Secretary') selected @endif >Secretary</option>
                                                <option value="Mission and Vision" @if ( $newsTicker->speech_role == 'Mission and Vision') selected @endif >Mission and Vision</option>
                                                <option value="Notice Board" @if ( $newsTicker->speech_role == 'Notice Board') selected @endif >Notice Board</option> --}}
                                                <option value="Headlines" @if ( $newsTicker->speech_role == 'Headlines') selected @endif >Headlines</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Active Status</label>
                                            <select class="form-select mb-3" aria-label="Default select example" name="status" required>
                                                <option>Please Select the Status</option>
                                                <option value="1" @if ( $newsTicker->status == 1) selected @endif >Active</option>
                                                <option value="0" @if ( $newsTicker->status == 0) selected @endif >Inactive</option>
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
