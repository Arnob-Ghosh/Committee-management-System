@extends('layouts.master')
@section('title', 'Create Model')

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
                    <div class="col-lg-8">
                        <div class="card card-primary ">
                            <div class="card-header">
                                <h5 class="m-0"><strong><i class="fas fa-plus"></i> Create Model</strong></h5>
                            </div>

                            <div class="card-body">
                                <div class="container">

                                    <form id="AddFmodelForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="brand_id" class="form-label"
                                                        style="font-weight: normal;">Brand Name<span
                                                            class="text-danger"><strong>*</strong></span></label><br>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="brand_id" id="brand_id" data-live-search="true"
                                                        title="Select brand" data-width="75%">
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <h6 class="text-danger pt-1" id="wrongbrand_id"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="model_name" class="form-label"
                                                        style="font-weight: normal;">Model
                                                        Name<span class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="model_name"
                                                        id="model_name" placeholder="e.g. Nokia 1100">

                                                    <h6 class="text-danger pt-1" id="wrongmodel_name"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="product_id" class="form-label"
                                                        style="font-weight: normal;">Product
                                                        Id<span class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="product_id"
                                                        id="product_id" placeholder="e.g. N-1100F">

                                                    <h6 class="text-danger pt-1" id="wrongproduct_id"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="num_colour" class="form-label"
                                                        style="font-weight: normal;">Number
                                                        of Colour<span class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="num_colour"
                                                        id="num_colour" placeholder="e.g. 3">

                                                    <h6 class="text-danger pt-1" id="wrongnum_colour"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="display_size" class="form-label"
                                                        style="font-weight: normal;">Display Size<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="display_size"
                                                        id="display_size" placeholder="e.g. 5.6'' ">

                                                    <h6 class="text-danger pt-1" id="wrongdisplay_size"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-6">

                                                <div class="form-group">
                                                    <label for="camera" class="form-label"
                                                        style="font-weight: normal;">Camera<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="camera"
                                                        id="camera" placeholder="e.g. 2 Megapixel ">

                                                    <h6 class="text-danger pt-1" id="wrongcamera"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="battery" class="form-label"
                                                        style="font-weight: normal;">Battery<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="battery"
                                                        id="battery" placeholder="e.g. 5000 mAh ">

                                                    <h6 class="text-danger pt-1" id="wrongbattery"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="network_parameter" class="form-label"
                                                        style="font-weight: normal;">Network Parameters<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="network_parameter" id="network_parameter"
                                                        data-live-search="true" title="Select Network Parameter"
                                                        data-width="75%">

                                                        <option value="2G">2G
                                                        </option>
                                                        <option value="3G">3G
                                                        </option>
                                                        <option value="4G">4G
                                                        </option>

                                                    </select>

                                                    <h6 class="text-danger pt-1" id="wrongnetwork_parameter"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>


                                        </div>

                                        {{-- <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="model_specification" class="form-label"
                                                    style="font-weight: normal;">Specifications<span
                                                        class="text-danger"><strong>*</strong></span></label>
                                                <textarea class="form-control" id="editor2"
                                                    name="model_specification"></textarea>

                                                <h6 class="text-danger pt-1" id="wrongmodel_specification"
                                                    style="font-size: 14px;">
                                                </h6>
                                            </div>
                                        </div>



                                    </div> --}}


                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="highlighted_spec" class="form-label"
                                                        style="font-weight: normal;">Highlighted Spec Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="file" id="highlighted_spec" name="highlighted_spec"
                                                        class="form-control w-75">


                                                    <h6 class="text-danger pt-1" id="wrongmodel_specification"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="in_box_image" class="form-label"
                                                        style="font-weight: normal;">In
                                                        The Box Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="file" id="in_box_image" name="in_box_image"
                                                        class="form-control w-75">


                                                    <h6 class="text-danger pt-1" id="wrongin_box_image"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            {{-- <div class="col-6">
                                            <div class="form-group">
                                                <label for="model_specification" class="form-label"
                                                    style="font-weight: normal;">Specifications<span
                                                        class="text-danger"><strong>*</strong></span></label>
                                                <input type="file" id="file" name="file" class="form-control w-75">

                                                <h6 class="text-info pt-1" id="info_model_specification"
                                                    style="font-size: 14px;">*Upload
                                                    xlsx,csv files Only
                                                </h6>
                                                <h6 class="text-danger pt-1" id="wrongmodel_specification"
                                                    style="font-size: 14px;">
                                                </h6>
                                            </div>
                                        </div> --}}
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="default_image" class="form-label"
                                                        style="font-weight: normal;">Default Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="file" id="default_image" name="default_image"
                                                        class="form-control w-75">


                                                    <h6 class="text-danger pt-1" id="wrong_default_image"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="status" class="form-label"
                                                        style="font-weight: normal;">Status<span
                                                            class="text-danger"><strong>*</strong></span></label> <br>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="status" id="status"
                                                        data-live-search="true" title="Select Status" data-width="75%">
                                                        <option value="" disabled selected>Select Model Status
                                                        </option>
                                                        <option value=1 >Active
                                                        </option>
                                                        <option value=0>Deactive
                                                        </option>


                                                    </select>


                                                    <h6 class="text-danger pt-1" id="wrong_status"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pt-3">
                                            <button type="submit" class="btn btn-primary">Create</button>
                                            <button type="reset" value="Reset" class="btn btn-outline-danger"><i
                                                    class="fas fa-eraser"></i> Reset</button>
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
    {{-- <script src="{{asset('../js/ckeditor/ckeditor.js')}}">
</script>
<script src="{{asset('../js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('../js/ckeditor/editor.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/backend/featurePhone.js') }}"></script>

@endsection
