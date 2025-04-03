@extends('layouts.master')
@section('title', 'Edit Exibition')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Header -->
            </div>
        </div>
    </div>

    <div class="content pt-4 ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-header">
                            <h5 class="m-0">Edit Exibition</h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form method="POST" action="{{route('accessories.slider.update',$data->id )}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="old_image" value=" {{$data->slider}} ">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" id="title" name="title" class="form-control"
                                            placeholder="Enter Slider Title" value="{{$data->title}}">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                placeholder="Enter Slider Description"> {{$data->description}}</textarea>
                                        </div>
                                    </div>
                                     <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">thumbnail Image</label>
                                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail"
                                                id="exampleFormControlFile1">
                                            @error('slider')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Exibition Image</label>
                                            <input type="file" class="form-control-file" id="slider" name="slider"
                                                id="exampleFormControlFile1">
                                            @error('slider')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="from-group mb-3">
                                        <label for="start">Start date:</label>

                                    <input type="date" id="start" name="start" value="{{$data->start_date}}">

                                    <label for="start">END date:</label>

                                    <input type="date" id="end" name="end" value="{{$data->end_date}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="disabledSelect" class="form-label"> Select Status</label>
                                        <select id="status" name="status" class="form-select" v>
                                            @if($data->status==1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                            @elseif($data->status==0)
                                            <option value="0" selected>Inactive</option>
                                            <option value="1">Active</option>
                                            @else
                                            <option>not selected</option>
                                            @endif

                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>

                                </form>

                            </div> <!-- container -->
                        </div> <!-- card-body -->
                    </div> <!-- card card-primary card-outline -->
                </div> <!-- col-lg-5 -->
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </div> <!-- content -->

</div> <!-- content-wrapper -->

@endsection


