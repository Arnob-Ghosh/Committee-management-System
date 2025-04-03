@extends('layouts.master')
@section('title', 'Edit Feature Phone Overview Image')

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
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-wallet"></i>EDIT FFEATURE PHONE OVERVIEW
                                    IMAGE</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div id="form_div">

                                    <form method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="specificationCategory_name"
                                            id="specificationCategory_name" value="{{$data->feature_category}}">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="brand_id" class="form-label"
                                                        style="font-weight: normal;">Brand Name</label>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="brand_id" id="brand_id" data-live-search="true"
                                                        title="Select brand" data-width="75%">

                                                        <option value="{{$data->brand_id }}" selected disabled>{{
                                                            $data['brand']['brand_name'] }}
                                                        </option>

                                                    </select>

                                                    <h6 class="text-danger pt-1" id="wrongbrand_id"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">

                                                    <label for="model_id" class="form-label"
                                                        style="font-weight: normal;">Model Name</label><br>
                                                    <select style="width:50%"
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="model_id" id="model_id" data-live-search="true"
                                                        title="Select Model Name" data-width="75%">

                                                        <option value="{{$data->model_id }}" selected disabled>{{
                                                            $data['model']['model_name'] }}
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="upper_image" class="form-label"
                                                        style="font-weight: normal;">Upper Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <img id="preview_edit_upper_image"
                                                        src="{{ asset($data->upper_image) }}" class="mb-2"
                                                        alt="preview image" style="width:auto;height:160px;">

                                                    <input id="edit_upper_image" value="" name="upper_image" type="file"
                                                        class="form-control w-75" data-browse-on-zone-click="true">
                                                    <input value="{{ $data->upper_image }}" name="old_upper_image"
                                                        type="hidden" class="form-control w-75"
                                                        data-browse-on-zone-click="true">
                                                    <h6 class="text-danger pt-1" id="wrongupper_image"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="lower_image" class="form-label"
                                                        style="font-weight: normal;">Lower Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    @if ($data->lower_image != 'null')
                                                    <img id="preview_edit_lower_image"
                                                        src="{{ asset($data->lower_image) }}" class="mb-2"
                                                        alt="preview image" style="width:auto;height:160px;">

                                                    @else
                                                    <img id="preview_edit_lower_image"
                                                        src="{{ asset('uploads/noimage.png') }}" class="mb-2"
                                                        alt="preview image" style="width:auto;height:160px;">

                                                    @endif


                                                    <input id="edit_lower_image" value="" name="lower_image" type="file"
                                                        class="form-control w-75" data-browse-on-zone-click="true">
                                                    <input value="{{ $data->lower_image }}" name="old_lower_image"
                                                        type="hidden" class="form-control w-75"
                                                        data-browse-on-zone-click="true">
                                                    <h6 class="text-danger pt-1" id="wronglower_image"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3">
                                            <button type="submit" class="btn btn-outline-info">Update</button>
                                        </div>

                                    </form>
                                </div>





                            </div>

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

{{-- <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('js/ckeditor/editor.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('js/backend/smartPhoneSpecification.js')}}"></script> --}}

@endsection
