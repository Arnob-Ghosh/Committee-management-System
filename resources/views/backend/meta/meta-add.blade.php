@extends('layouts.master')
@section('title', 'Create Meta Tag')

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
                            <h5 class="m-0"><strong><i class="fal fa-mobile-android-alt"></i> META TAG</strong>
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div id="form_div">

                                    <form id="" method="" enctype="multipart/form-data">
                                        {{-- {{ csrf_field() }} --}}
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="page_type" class="form-label"
                                                        style="font-weight: normal;">Select Page Type<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="page_type" id="page_type" data-live-search="true"
                                                        title="Select Category" data-width="75%">

                                                        <option value='main_page'> Main Pages
                                                        </option>
                                                        <option value='category_page'> Category pages
                                                        </option>
                                                    </select>

                                                    <h6 class="text-danger pt-1" id="wrongpage_type"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-4 category_page">
                                                <div class="form-group">
                                                    <label for="category_id" class="form-label"
                                                        style="font-weight: normal;">Category Name<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="category_id" id="category_id" data-live-search="true"
                                                        title="Select Category" data-width="75%">
                                                        @foreach($categories as $item)
                                                        <option value="{{ $item->id }}">{{ $item->category_name}}
                                                        </option>
                                                        @endforeach
                                                        <option value=777>News
                                                        </option>
                                                    </select>

                                                    <h6 class="text-danger pt-1" id="wrongcategory_id"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-4 category_page">
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
                                            <div class="col-4" id="main_page_div">
                                                <div class="form-group">
                                                    <label for="main_page_name" class="form-label"
                                                        style="font-weight: normal;">Main Page Tags<span
                                                            class="text-danger"><strong>*</strong></span></label><br>
                                                    <select
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="main_page_name" id="main_page_name" data-live-search="true"
                                                        title="Select Model" data-width="75%">
                                                        <option value='homepage'>Home Page</option>
                                                        <option value='feature-phone'>Feature Phone List Page</option>
                                                        <option value='smart-phone'>Smart Phone List Page</option>
                                                        <option value='accessories'>Accessories List Page</option>
                                                        <option value='all-news'>News and Events Page</option>
                                                        <option value='about-us'>Company Info Page</option>
                                                        <option value='support-and-service'>Support and Service Page</option>
                                                        <option value='contact-us'>Contact Us Page</option>
                                                        <option value='service-warranty'>Service Warranty Page</option>
                                                        <option value='warranty-policy'>Warranty Policy Page</option>
                                                    </select>



                                                    <h6 class="text-danger pt-1" id="wrongbrand_id"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div>
                                            {{-- <div class="col-4">
                                                <div class="form-group">

                                                    <label for="upper_image" class="form-label"
                                                        style="font-weight: normal;">Upper Image<span
                                                            class="text-danger"><strong>*</strong></span></label><br>
                                                    <input type="file" class="form-control" id="upper_image"
                                                        name="upper_image"></input>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-4">
                                                <div class="form-group">

                                                    <label for="lower_image" class="form-label"
                                                        style="font-weight: normal;">Lower Image<span
                                                            class="text-danger"><strong>*</strong></span></label><br>
                                                    <input type="file" class="form-control" id="lower_image"
                                                        name="lower_image"></input>
                                                </div>
                                            </div> --}}

                                        </div>


                                </div>
                                <div class="text-justify form-group pt-2 pl-2 pb-2">
                                    <button id="add_btn" type="button" class="btn btn-primary"
                                        onclick="metaAddToTable()"> <i class="fas fa-plus"></i> Add</button>
                                    <button type="reset" value="Reset" class="btn btn-outline-danger"><i
                                            class="fas fa-eraser" onclick="resetButton()"></i> Reset</button>
                                </div>
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
                                </form>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <form id="AddspecificationFrom" method="POST" enctype="multipart/form-data">
                                                {{-- @csrf --}}
                                                <div class="table-responsive">
                                                <table id="specification_transfer_table" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Category Name</th>
                                                            <th scope="col">Model Name</th>

                                                            <td> Main Page Name</td>
                                                            <th scope="col">Meta Title</th>
                                                            <th scope="col">Meta Description</th>
                                                            <th scope="col" class="hidden">Category Id</th>
                                                            <th scope="col" class="hidden">Model Id</th>
                                                            <th scope="col" class="hidden">Main page Id</th>
                                                            <th scope="col"></th>



                                                        </tr>
                                                    </thead>
                                                    <tbody id="specification_transfer_table_body">


                                                    </tbody>
                                                </table>
                                                </div>
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
                                            {{-- <button type="submit"
                                                class="btn btn-primary float-right">Create</button> --}}
                                            <button id="" type="button" class=" w-30 btn btn-primary float-right"
                                                onclick="specificationAddToServer();">
                                                Create specification</button>
                                            {{-- <button type="submit" class=" w-30 btn btn-primary float-right">
                                                Create
                                                specification</button> --}}
                                        </div>
                                    </div>
                                </div>

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

<script type="text/javascript" src="{{asset('js/backend/meta-tag.js')}}"></script>
{{-- <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('js/ckeditor/editor.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('js/backend/featurePhoneOverviewImage.js')}}"></script> --}}

@endsection
