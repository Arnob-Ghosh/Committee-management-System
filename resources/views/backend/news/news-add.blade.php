@extends('layouts.master')
@section('title', 'Create Collection')

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
                            <h5 class="m-0"><strong><i class="fas fa-plus"></i> Collection</strong></h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form id="AddNewsForm" method="POST" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="newsname" class="form-label" style="font-weight: normal;">Collection
                                            Title<span class="text-danger"><strong>*</strong></span></label>
                                        <input type="text" class="form-control w-75" name="news_title" id="news_title"
                                            placeholder="Collection Title">

                                        <h6 class="text-danger pt-1" id="wrongnewstitle" style="font-size: 14px;">
                                        </h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="news_thumbnail" class="form-label" style="font-weight: normal;">Collection
                                           Thumbnail <span class="text-danger"><strong>*</strong></span></label>
                                        <input type="file" class="form-control w-75" name="news_thumbnail" id="news_thumbnail">

                                        <h6 class="text-danger pt-1" id="wrongnews_thumbnail" style="font-size: 14px;">
                                        </h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="news_image" class="form-label" style="font-weight: normal;">Collection
                                             Title Image <span class="text-danger"><strong>*</strong></span></label>
                                        <input type="file" class="form-control w-75" name="news_image" id="news_image">

                                        <h6 class="text-danger pt-1" id="wrongnews_thumbnail" style="font-size: 14px;">
                                        </h6>
                                    </div>

                                    <div class="form-group">
                                        <label for="news_category" class="form-label" style="font-weight: normal;">Collection
                                            Category<span class="text-danger"><strong>*</strong></span></label>
                                        <select name="news_category" class="form-control w-75" id="news_category">
                                            <option value="" disabled="disabled" selected>Choose Category</option>
                                            @foreach ( $categories as $categories )
                                            <option value="{{$categories->category_name}}">{{$categories->category_name}}</option>
                                            @endforeach


                                        </select>

                                        <h6 class="text-danger pt-1" id="wrongnews_category" style="font-size: 14px;">
                                        </h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="accession_number" class="form-label" style="font-weight: normal;">Accession Number</label>
                                        <input type="text" class="form-control w-75" name="accession_number" id="accession_number"
                                            placeholder="0123...">

                                        <h6 class="text-danger pt-1" id="wrongaccession" style="font-size: 14px;">
                                        </h6>
                                    </div>

                                    <div class="form-group">
                                        <label for="news_description" class="form-label" style="font-weight: normal;">
                                            Description</label>
                                        {{-- <input type="file" class="form-control w-75" name="newsyimage"
                                            id="newsyimage"> --}}
                                        <textarea class="ckeditor news_description form-control" id="news_description"
                                            name="news_description" rows="4"></textarea>

                                        <h6 class="text-danger pt-1" id="wrongnews_description"
                                            style="font-size: 14px;">
                                        </h6>
                                    </div>
                                 

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name ="highlight" value="1" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Highlight
                                        </label>
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

<script type="text/javascript" src="{{asset('js/backend/news.js')}}"></script>
<script>
    tinymce.init({selector:'textarea.news_description',   plugins: [
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

@endsection
