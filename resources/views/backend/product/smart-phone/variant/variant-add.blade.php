@extends('layouts.master')
@section('title', 'Create Smartphone Varients')

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
                            <h5 class="m-0"><strong><i class="fas fa-wallet"></i>SMARTPHONE VARIANTS</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div id="form_div">

                                    <form id="" method="" enctype="multipart/form-data">
                                        {{-- {{ csrf_field() }} --}}
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
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}
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
                                                        @foreach($models as $model)
                                                        <option value="{{ $model->id }}">{{
                                                            $model->model_name }}</option>
                                                        @endforeach
                                                        {{-- @foreach($variant_groups as $variant_group)
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
                                                        id="colour_name" placeholder="Enter colour Name">
                                                    <h6 class="text-danger pt-1" id="wrong_colour_name"
                                                        style="font-size: 14px;"></h6>

                                                </div>
                                            </div>
                                            {{-- <div class="col-3">
                                                <div class=" form-group">
                                                    <label for="colour_thumbnail" class="form-label"
                                                        style="font-weight: normal;"></label>
                                                    <div class="form-label col-10">
                                                        <button id="add_btn" type="button"
                                                            class="btn btn-primary float-right ml-2"
                                                            onclick="variantAddToTable()"><i class="fas fa-plus"></i>
                                                            Add</button>
                                                        <button type="reset" value="Reset"
                                                            class="btn btn-outline-danger float-right"
                                                            onclick="resetButton()"><i class="fas fa-eraser"></i>
                                                            Reset</button>
                                                    </div>

                                                </div>
                                            </div> --}}

                                        </div>
                                        <div class="text-justify form-group pt-2 pl-2 pb-2">
                                            <button id="add_btn" type="button" class="btn btn-primary"
                                                onclick="variantAddToTable()"> <i class="fas fa-plus"></i> Add</button>
                                            <button type="reset" value="Reset" class="btn btn-outline-danger"><i
                                                    class="fas fa-eraser" onclick="resetButton()"></i> Reset</button>
                                        </div>
                                        {{-- <div class="row">

                                            <div class="row form-group pt-3">
                                                <div class="col-10">
                                                    <button id="add_btn" type="button"
                                                        class=" w-30 btn btn-primary float-right ml-2"
                                                        onclick="variantAddToTable()"><i class="fas fa-plus"></i>
                                                        Add</button>
                                                    <button type="reset" value="Reset"
                                                        class="btn btn-outline-danger float-right"
                                                        onclick="resetButton()"><i class="fas fa-eraser"></i>
                                                        Reset</button>
                                                </div>

                                            </div>
                                        </div> --}}
                                        {{-- <table id="variant_table_data" class="table table-bordered">
                                            <thead>

                                            </thead>
                                            <tbody id="variant_table_data_body">

                                            </tbody>
                                        </table> --}}
                                    </form>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <form id="AddVariantFrom" method="POST" enctype="multipart/form-data">
                                                    {{-- @csrf --}}
                                                    <table id="variant_transfer_table" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Brand Name</th>
                                                                <th scope="col">Model Name</th>

                                                                <th scope="col">Colour Name</th>
                                                                <th scope="col"> Colour Thumbnail</th>
                                                                <th scope="col"></th>
                                                                <th scope="col">Front Image</th>

                                                                <th scope="col">Back Image</th>
                                                                <th scope="col">Overview Image</th>
                                                                <th scope="col" class="hidden">Model Id</th>
                                                                <th scope="col" class="hidden">Brand Id</th>
                                                                <th scope="col">Overview Image Large</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="variant_transfer_table_body">


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
                                                {{-- <button type="submit"
                                                    class="btn btn-primary float-right">Create</button> --}}
                                                <button id="" type="button" class=" w-30 btn btn-primary float-right"
                                                    onclick="variantAddToServer();">
                                                    Create Variant</button>
                                                {{-- <button type="submit" class=" w-30 btn btn-primary float-right">
                                                    Create
                                                    variant</button> --}}
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
<script type="text/javascript" src="{{asset('js/backend/smartPhoneVariant.js')}}"></script>

@endsection
