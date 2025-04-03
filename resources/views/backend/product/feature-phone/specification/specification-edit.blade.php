@extends('layouts.master')
@section('title', 'Edit Feature Phone Specification')

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
                            <h5 class="m-0"><strong><i class="fas fa-wallet"></i>EDIT FEATURE PHONE
                                    SPECIFICATION</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div id="form_div">

                                    <form id="EditSpecificationForm" method="post" enctype="multipart/form-data">
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
                                                            $data['feature_phone']['model_name'] }}
                                                        </option>

                                                        {{-- @foreach($specification_groups as $specification_group)
                                                        <option value="{{ $specification_group->group_name }}">{{
                                                            $specification_group->group_name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-4">
                                                <div class="form-group">

                                                    <label for="specificationCategory_name" class="form-label"
                                                        style="font-weight: normal;">Specification Categoy</label><br>
                                                    <select style="width:50%"
                                                        class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                        name="specificationCategory_name"
                                                        id="specificationCategory_name" data-live-search="true"
                                                        title="Select Model Name" data-width="75%">
                                                        <option value="{{$data->model_id }}" selected disabled>{{
                                                            $data['category']['specificationCategory_name'] }}
                                                        </option>

                                                    </select>
                                                </div>
                                            </div> --}}

                                        </div>
                                        <div class="row">
                                            {{-- <div class="col-4">
                                                <div class="form-group">
                                                    <label for="feature_name" class="form-label"
                                                        style="font-weight: normal;">Feature Name<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input class="form-control" id="feature_name" name="feature_name"
                                                        value="{{$data->feature_name}}"></input>

                                                    <h6 class="text-danger pt-1" id="wrongfeature_name"
                                                        style="font-size: 14px;">
                                                    </h6>
                                                </div>
                                            </div> --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="description" class="form-label"
                                                        style="font-weight: normal;">Description<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <textarea class="form-control" id="description"
                                                        name="description">{!!$data->description!!}</textarea>

                                                    <h6 class="text-danger pt-1" id="wrongdescription"
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
<script>
    tinymce.init({selector:'textarea',  height: 500,force_br_newlines : true,force_p_newlines : false,
        width: 1000, plugins: [
      'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
      'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'media', 'table', 'emoticons', 'template', 'help'
    ],  menu: {
    file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
    edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
    insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
    table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' },
    help: { title: 'Help', items: 'help' }
  }});
</script>
{{-- <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('js/ckeditor/editor.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('js/backend/smartPhoneSpecification.js')}}"></script>

@endsection
