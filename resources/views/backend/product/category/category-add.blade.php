@extends('layouts.master')
@section('title', 'Create Event')

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
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-plus"></i> EVENT</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form id="AddCategoryForm" method="POST" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="categoryname" class="form-label"
                                            style="font-weight: normal;">Event Name<span
                                                class="text-danger"><strong>*</strong></span></label>
                                        <input type="text" class="form-control w-50" name="categoryname"
                                            id="categoryname" placeholder="e.g. Sculpture">
                                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your event
                                            name meaningful.</div>
                                        <h6 class="text-danger pt-1" id="wrongcategoryname" style="font-size: 14px;">
                                        </h6>
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryname" class="form-label"
                                            style="font-weight: normal;">Event Image<span
                                                class="text-danger"><strong>*</strong></span></label>
                                        <input type="file" class="form-control w-50" name="categoryimage"
                                            id="categoryimage">

                                        <h6 class="text-danger pt-1" id="wrongcategoryname" style="font-size: 14px;">
                                        </h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_titile_image" class="form-label"
                                            style="font-weight: normal;">Title Image<span
                                                class="text-danger"><strong>*</strong></span></label>
                                        <input type="file" class="form-control w-50" name="category_titile_image"
                                            id="categorytitleimage">

                                        <h6 class="text-danger pt-1" id="wrong_category_titile_image" style="font-size: 14px;">
                                        </h6>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="form-label">Description<span
                                                class="text-danger"><strong>*</strong></span></label>
                                        <textarea class="form-control" id="description" name="description"></textarea>

                                        <h6 class="text-danger pt-1" id="wrong_description" style="font-size: 14px;">
                                        </h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc" class="form-label">Short Description<span
                                                class="text-danger"><strong>*</strong></span></label>
                                        <textarea class="form-control desc_area" id="desc" name="desc"></textarea>

                                        <h6 class="text-danger pt-1" id="wrong_desc" style="font-size: 14px;">
                                        </h6>
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
{{-- <script>
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
</script> --}}
<script type="text/javascript" src="{{asset('js/backend/category.js')}}"></script>

@endsection
