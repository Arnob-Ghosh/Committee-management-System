@extends('layouts.master')
@section('title', 'Edit Varients')

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
                            <h5 class="m-0"><strong><i class="fas fa-wallet"></i> EDIT VARIANTS</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div id="form_div">

                                    <form id="" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" class="form-control w-75" name="brand_name" id="brand_name"
                                            value="{{ $data->brand_name }}">
                                        <div class="row">
                                            <div class="col-4">

                                                <div class="form-group">
                                                    <label for="brand_id" class="form-label"
                                                        style="font-weight: normal;">Brand Name<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="brand_id" id="brand_id" data-live-search="true"
                                                        title="Select brand" data-width="75%">
                                                        @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $brand->id ==
                                                            $data->brand_id ? 'selected' : '' }}>
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <h6 class="text-danger pt-1" id="wrongbrand_id"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">

                                                    <label for="model_id" class="form-label"
                                                        style="font-weight: normal;">Model Name<span
                                                            class="text-danger"><strong>*</strong></span></label><br>
                                                    <select style="width:50%"
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="model_id" id="model_id" data-live-search="true"
                                                        title="Select Model Name" data-width="75%">
                                                        @foreach ($models as $model)
                                                        <option value="{{ $model->id }}" {{ $model->id ==
                                                            $data->model_id ? 'selected' : '' }}>
                                                            {{ $model->model_name }}</option>
                                                        @endforeach
                                                        {{-- @foreach ($variant_groups as $variant_group)
                                                        <option value="{{ $variant_group->group_name }}">{{
                                                            $variant_group->group_name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="colour_name" class="form-label"
                                                        style="font-weight: normal;">Colour Name<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input type="text" class="form-control w-75" name="colour_name"
                                                        id="edit_colour_name" value="{{ $data->colour_name }}">
                                                    <h6 class="text-danger pt-1" id="wrong_colour_name"
                                                        style="font-size: 14px;"></h6>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="colour_thumbnail	" class="form-label"
                                                        style="font-weight: normal;">Colour Thumbnail <span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <img id="preview_edit_colour_thumbnail"
                                                        src="{{ asset($data->colour_thumbnail) }}" class="mb-2"
                                                        alt="preview image" style="width:80px;height:80px;">
                                                    <input id="edit_colour_thumbnail" value="" name="colour_thumbnail"
                                                        type="file" class="form-control w-75"
                                                        data-browse-on-zone-click="true">
                                                    <input value="{{ $data->colour_thumbnail }}"
                                                        name="old_colour_thumbnail" type="hidden"
                                                        class="form-control w-75" data-browse-on-zone-click="true">
                                                    <h6 class="text-danger pt-1" id="wrong_colour_thumbnail	"
                                                        style="font-size: 14px;"></h6>

                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="front_image" class="form-label"
                                                        style="font-weight: normal;">Front Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <img id="preview_edit_front_image"
                                                        src="{{ asset($data->front_image) }}" class="mb-2"
                                                        alt="preview image" style="width:80px;height:80px;">
                                                    <input id="edit_front_image" value="" name="front_image" type="file"
                                                        class="form-control w-75" data-browse-on-zone-click="true">
                                                    <input value="{{ $data->front_image }}" name="old_front_image"
                                                        type="hidden" class="form-control w-75"
                                                        data-browse-on-zone-click="true">
                                                    <h6 class="text-danger pt-1" id="wrong_front_image"
                                                        style="font-size: 14px;"></h6>

                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="back_image" class="form-label"
                                                        style="font-weight: normal;">Back Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <img id="preview_edit_back_image"
                                                        src="{{ asset($data->back_image) }}" class="mb-2"
                                                        alt="preview image" style="width:80px;height:80px;">
                                                    <input id="edit_back_image" value="" name="back_image" type="file"
                                                        class="form-control w-75" data-browse-on-zone-click="true">
                                                    <input value="{{ $data->back_image }}" name="old_back_image"
                                                        type="hidden" class="form-control w-75"
                                                        data-browse-on-zone-click="true">
                                                    <h6 class="text-danger pt-1" id="wrong_back_image"
                                                        style="font-size: 14px;"></h6>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="over_view_image" class="form-label"
                                                        style="font-weight: normal;">Overview Image<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <img id="preview_edit_over_view_image"
                                                        src="{{ asset($data->over_view_image) }}" class="mb-2"
                                                        alt="preview image" style="width:80px;height:80px;">
                                                    <input id="edit_over_view_image" value="" name="over_view_image"
                                                        type="file" class="form-control w-75"
                                                        data-browse-on-zone-click="true">
                                                    <input value="{{ $data->over_view_image }}"
                                                        name="old_over_view_image" type="hidden"
                                                        class="form-control w-75" data-browse-on-zone-click="true">
                                                    <h6 class="text-danger pt-1" id="wrong_over_view_image"
                                                        style="font-size: 14px;"></h6>

                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="over_view_image_large" class="form-label"
                                                        style="font-weight: normal;">Overview Image Large<span
                                                            class="text-danger"><strong>*</strong></span></label>

                                                    <img id="preview_edit_over_view_image_large"
                                                        src="{{ asset($data->over_view_image_large) }}" class="mb-2"
                                                        alt="preview image" style="width:80px;height:80px;">

                                                    <input id="edit_over_view_image_large" value=""
                                                        name="over_view_image_large" type="file"
                                                        class="form-control w-75" data-browse-on-zone-click="true">

                                                    <input value="{{ $data->over_view_image_large }}"
                                                        name="old_over_view_image_large" type="hidden"
                                                        class="form-control w-75" data-browse-on-zone-click="true">

                                                    <h6 class="text-danger pt-1" id="wrong_over_view_image_large"
                                                        style="font-size: 14px;"></h6>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="text-justify form-group pt-2 pl-2 pb-2">
                                            <button id="add_btn" type="submit" class="btn btn-primary"> <i
                                                    class="fas fa-edit"></i></i>
                                                Update</button>
                                            <button type="reset" value="Reset" class="btn btn-outline-danger"><i
                                                    class="fas fa-eraser" onclick="resetButton()"></i> Reset</button>
                                        </div>

                                    </form>


                                    </form>
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
<script type="text/javascript" src="{{ asset('js/backend/featurePhoneVariant.js') }}"></script>
<script>
    $('#edit_colour_thumbnail').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview_edit_colour_thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
        $('#edit_front_image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview_edit_front_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });

        $('#edit_back_image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview_edit_back_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
        $('#edit_over_view_image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview_edit_over_view_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
        $('#edit_over_view_image_large').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview_edit_over_view_image_large').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
        $('#brand_id').on('change', function(e) {
            $('#brand_name').empty();
            var brand_name = $("#brand_id").find("option:selected").text();

            $('#brand_name').val(brand_name);

        });
</script>

@endsection
