@extends('layouts.master')
@section('title', 'Create Accessories')

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
                            <h5 class="m-0"><strong><i class="fas fa-plus"></i> Create Accessories</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form id="AddAccessoriesForm" method="POST" enctype="multipart/form-data">
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

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_id" class="form-label"
                                                    style="font-weight: normal;">Category
                                                    Name<span class="text-danger"><strong>*</strong></span></label>
                                                    <select
                                                    class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                    name="category_id" id="category_id" data-live-search="true"
                                                    title="Select Category" data-width="75%">
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <h6 class="text-danger pt-1" id="wrongcategory_id"
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
                                                <label for="product_name" class="form-label"
                                                    style="font-weight: normal;">Product
                                                    Name<span class="text-danger"><strong>*</strong></span></label>
                                                <input type="text" class="form-control w-75" name="product_name"
                                                    id="product_name" placeholder="e.g. Sony 400BT Bluetooth Headphone">

                                                <h6 class="text-danger pt-1" id="wrongproduct_name"
                                                    style="font-size: 14px;">
                                                </h6>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="default_image" class="form-label"
                                                    style="font-weight: normal;">Default Image<span
                                                        class="text-danger"><strong>*</strong></span></label>
                                                <input type="file" id="default_image" name="default_image"
                                                    class="form-control w-75">


                                                <h6 class="text-danger pt-1" id="wrongdefault_image"
                                                    style="font-size: 14px;">
                                                </h6>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="product_image" class="form-label"
                                                    style="font-weight: normal;">Overview Image<span
                                                        class="text-danger"><strong>*</strong></span></label>
                                                <input type="file" id="product_image" name="product_image"
                                                    class="form-control w-75">


                                                <h6 class="text-danger pt-1" id="wrongproduct_image"
                                                    style="font-size: 14px;">
                                                </h6>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="highlighted_spec" class="form-label"
                                                    style="font-weight: normal;">Highlighted Spec Image<span
                                                        class="text-danger"><strong>*</strong></span></label>
                                                <input type="file" id="highlighted_spec" name="highlighted_spec"
                                                    class="form-control w-75">


                                                <h6 class="text-danger pt-1" id="wronghighlighted_spec"
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

                                                    <option value=1 >Active
                                                    </option>
                                                    <option value=0 >Deactive
                                                    </option>


                                                </select>


                                                <h6 class="text-danger pt-1" id="wrong_status"
                                                    style="font-size: 14px;">
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12">

                                                <div class="form-group">
                                                    <label for="description" class="form-label">Description<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <textarea style="height: 500px;" class="form-control description_area" id="description" name="description"></textarea>

                                                    <h6 class="text-danger pt-1" id="wrong_description" style="font-size: 14px;">
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
<script>
    tinymce.init({selector:'textarea.description_area',   plugins: [
      'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
      'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'media', 'table','advtable', 'emoticons', 'template', 'help'
    ],  menu: {
    file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
    edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
    insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
    table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable | tableinsertcolbefore tableinsertcolafter tabledeletecol | tableinsertrowbefore tableinsertrowafter tabledeleterow| tableinsertdialog tablecellprops tableprops advtablerownumbering' },
    help: { title: 'Help', items: 'help' }
  }});
</script>
{{-- <script src="{{asset('../js/ckeditor/ckeditor.js')}}">
</script>
<script src="{{asset('../js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('../js/ckeditor/editor.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('js/backend/accessories.js')}}"></script>

@endsection
