@extends('layouts.master')
@section('title', 'Create Feature Phone Specifications')

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
                                <h5 class="m-0"><strong><i class="fal fa-mobile-android-alt"></i> FEATURE PHONE
                                        OVERVIEW IMAGE</strong>
                                </h5>
                            </div>

                            <div class="card-body">
                                <div class="container">
                                    <div id="form_div">

                                        <form method="post" action="{{ route('feature.phone.overview.img.store') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="brand_id" class="form-label"
                                                            style="font-weight: normal;">Brand Name<span
                                                                class="text-danger"><strong>*</strong></span></label>
                                                        <select
                                                            class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                            name="brand_id" id="brand_id" data-live-search="true"
                                                            title="Select brand" data-width="75%">
                                                            @foreach ($brands as $item)
                                                                <option value="{{ $item->id }}">{{ $item->brand_name }}
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
                                                        <label for="model_id" class="form-label"
                                                            style="font-weight: normal;">Model Name<span
                                                                class="text-danger"><strong>*</strong></span></label>
                                                        <select
                                                            class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                            name="model_id" id="model_id" data-live-search="true"
                                                            title="Select Model" data-width="75%">

                                                        </select>

                                                        <h6 class="text-danger pt-1" id="wrongbrand_id"
                                                            style="font-size: 14px;">
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div id="image_preview"></div>
                                                    <div class="form-group">

                                                        <label for="upper_image" class="form-label"
                                                            style="font-weight: normal;">Upper Image<span
                                                                class="text-danger"><strong>*</strong></span></label><br>
                                                        <input name="upper_image"
                                                            id="upper_image" type="file" class="file_upload form-control"
                                                            multiple></input>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">

                                                        <label for="lower_image" class="form-label"
                                                            style="font-weight: normal;">Lower Image<span
                                                                class="text-danger"><strong>*</strong></span></label><br>
                                                        <input name="lower_image" id="lower_image" type="file"
                                                            class="file_upload form-control" multiple></input>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group pt-3">
                                                <button type="submit" class="btn btn-outline-info">Create</button>
                                            </div>
                                        </form>

                                    </div>
                                    {{-- <div class="text-justify form-group pt-2 pl-2 pb-2">
                                    <button id="add_btn" type="button" class="btn btn-primary"
                                        onclick="overviewImageAddToTable()"> <i class="fas fa-plus"></i> Add</button>
                                    <button type="reset" value="Reset" class="btn btn-outline-danger"><i
                                            class="fas fa-eraser" onclick="resetButton()"></i> Reset</button>
                                </div> --}}


                                    {{-- <div class="row">

                                    <div class="row form-group pt-3">
                                        <div class="col-10">
                                            <button id="add_btn" type="button"
                                                class=" w-30 btn btn-primary float-right ml-2"
                                                onclick="specificationAddToTable()"><i class="fas fa-plus"></i>
                                                Add</button>
                                            <button type="reset" value="Reset"
                                                class="btn btn-outline-danger float-right" onclick="resetButton()"><i
                                                    class="fas fa-eraser"></i>
                                                Reset</button>
                                        </div>

                                    </div>
                                </div> --}}
                                    {{-- <table id="specification_table_data" class="table table-bordered">
                                    <thead>

                                    </thead>
                                    <tbody id="specification_table_data_body">

                                    </tbody>
                                </table> --}}

                                    {{-- <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <form id="AddspecificationFrom" method="POST" enctype="multipart/form-data">

                                                <table id="specification_transfer_table" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Brand Name</th>
                                                            <th scope="col">Model Name</th>

                                                            <th scope="col">Upper Image</th>
                                                            <th scope="col">Lower Image</th>
                                                            <th scope="col" class="hidden">Brand Id</th>
                                                            <th scope="col" class="hidden">Model Id</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody id="specification_transfer_table_body">


                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-9">
                                            <h6 class="text-danger float-right"><strong id="errorMsg1"></strong>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-10" style="padding-top: 10px">

                                            <button id="" type="button" class=" w-30 btn btn-primary float-right"
                                                onclick="overviewImageAddToServer();">
                                                Create </button>

                                        </div>
                                    </div>
                                </div> --}}


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
    <script type="text/javascript" src="{{ asset('js/backend/featurePhoneOverviewImage.js') }}"></script>

    <script>

        // function preview_image() {
        //     var upperImageList = new Array();
        //     var total_file = document.getElementById("upper_image").files.length;
        //     for (var i = 0; i < total_file; i++) {
        //         $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
        //         var list=event.target.files[i];
        //         upperImageList.push(list);
        //     }
        //     console.log(upperImageList)
        // }
                 $(document).ready(function() {
            var url1 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
                url2 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg';
            $(".file_upload").fileinput({
                uploadAsync: false,
                initialPreviewAsData: true,
                showPreview: true,
                showRemove: true,
                maxFilesNum: 10,
                deleteUrl: "/site/file-delete",
                overwriteInitial: false,
                maxFileSize: 10000,
                initialCaption: "Select Files"
            });
        });
    </script>

@endsection
