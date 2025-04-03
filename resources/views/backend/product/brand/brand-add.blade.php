@extends('layouts.master')
@section('title', 'Create Brand')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Header -->
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-copyright"></i> BRAND</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form id="AddBrandForm" method="POST" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="brandcategory" class="form-label" style="font-weight: normal;">Brand
                                            Category<span class="text-danger"><strong>*</strong></span></label><br>
                                        <select class="form-control w-50 selectpicker " name="category_id"
                                            id="category_id" data-live-search="true" title="Select Category">
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <h6 class="text-danger pt-1" id="wrongbrandcategory" style="font-size: 14px;">
                                        </h6>

                                    </div>
                                    <div class="form-group">
                                        <label for="brandname" class="form-label" style="font-weight: normal;">Brand
                                            Name<span class="text-danger"><strong>*</strong></span></label>
                                        <input type="text" class="form-control w-50" name="brandname" id="brandname"
                                            placeholder="Enter brand name">
                                        <h6 class="text-danger pt-1" id="wrongbrandname" style="font-size: 14px;"></h6>

                                    </div>

                                    <div class="form-group pt-1">
                                        <label for="brandlogo" class="form-label" style="font-weight: normal;">Brand
                                            Logo <span
                                                style="font-weight: normal;font-size: 14px; color: grey;"></span></label>
                                        <input type="file" class="form-control w-50" name="brandlogo" id="brandlogo">
                                        <h6 class="text-danger pt-1" id="wrongbrandlogo" style="font-size: 14px;"></h6>
                                    </div>
                                    <div class="form-group pt-1">
                                        <label for="brandlogo" class="form-label" style="font-weight: normal;">Homepage Visiblity <span
                                                style="font-weight: normal;font-size: 14px; color: grey;"></span></label>

                                        <select name="visiblity" id="visiblity" class="form-control w-50" name="brandlogo" id="brandlogo">
                                            <option value="" selected disabled>Select Visiblity</option>
                                            <option value=1>Yes</option>
                                            <option value=0>No</option>
                                          </select>
                                          <h6 class="text-danger pt-1" id="wrongvisiblity" style="font-size: 14px;"></h6>
                                    </div>

                                    <div class="form-group pt-3">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="reset" value="Reset" class="btn btn-outline-danger"
                                            onclick="resetButton()"><i class="fas fa-eraser"></i> Reset</button>
                                    </div>

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
<script type="text/javascript" src="{{asset('js/backend/brand.js')}}"></script>

@endsection
