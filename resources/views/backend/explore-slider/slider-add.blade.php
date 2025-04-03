@extends('layouts.master')
@section('title', 'Add Explore Product Slider')

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
                            <h5 class="m-0">Add Explore Product Slider</h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form method="POST" action="{{route('explore.slider.create')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" id="category_name" name="category_name">
                                    <div class="mb-3">
                                          <label for="category_id" class="form-label" style="font-weight: normal;">
                                            Category<span class="text-danger"><strong>*</strong></span></label><br>
                                        <select class="form-control w-50 selectpicker " name="category_id"
                                            id="category_id" data-live-search="true" title="Select Category" required>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <h6 class="text-danger pt-1" id="wrongcategory_id" style="font-size: 14px;">
                                        </h6>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Slider url</label>
                                            <textarea class="form-control" id="slider_url" name="slider_url" rows="3"
                                                placeholder="Enter Slider Url"></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Slider Image</label>
                                            <input type="file" class="form-control-file" id="slider" name="slider"
                                                id="exampleFormControlFile1">
                                            @error('slider')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="disabledSelect" class="form-label"> Select Status</label>
                                        <select id="status" name="status" class="form-select">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>

                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>

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

@section('script')
<script>
    $("#category_id").change(function(){
    var category_id=$('#category_id option:selected').text()
    $('#category_name').val(category_id)
    // alert(category_id)
});
</script>
@endsection
