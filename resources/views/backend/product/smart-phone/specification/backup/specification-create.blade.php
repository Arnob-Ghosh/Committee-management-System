@extends('layouts.master')
@section('title', 'Create Smartphone specificationS')

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
                                <h5 class="m-0"><strong><i class="fas fa-wallet"></i>SMARTPHONE SPECIFICATIONS</strong>
                                </h5>
                            </div>

                            <div class="card-body">
                                <div class="container">
                                    <div id="form_div">

                                        <form id="" method="POST" enctype="multipart/form-data">
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
                                                <div class="col-4">
                                                    <div class="form-group">

                                                        <label for="model_id" class="form-label"
                                                            style="font-weight: normal;">Model Name<span
                                                                class="text-danger"><strong>*</strong></span></label><br>
                                                        <select style="width:50%"
                                                            class="selectpicker border-left-0 border-right-0 border-top-0 rounded-0"
                                                            name="model_id" id="model_id" data-live-search="true"
                                                            title="Select Model Name" data-width="75%">

                                                            <option value="" selected disabled>
                                                            </option>

                                                            {{-- @foreach ($specification_groups as $specification_group)
                                                            <option value="{{ $specification_group->group_name }}">{{
                                                                $specification_group->group_name }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                {{-- <div class="col-4">
                                                <div class="form-group">
                                                    <label for="feature_name" class="form-label"
                                                        style="font-weight: normal;">Feature Name<span
                                                            class="text-danger"><strong>*</strong></span></label>
                                                    <input class="form-control" id="feature_name"
                                                        name="feature_name"></input>

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
                                                        <textarea class="form-control" id="description" name="description"></textarea>

                                                        <h6 class="text-danger pt-1" id="wrongdescription"
                                                            style="font-size: 14px;">
                                                        </h6>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="text-justify form-group pt-2 pl-2 pb-2">
                                                <div class="form-group pt-3">
                                                    <button type="submit" class="btn btn-outline-info">Create</button>
                                                </div>
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
        tinymce.init({
            selector: 'textarea',
            height: 400,
            force_br_newlines: true,
            width: 1000,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                'insertdatetime',
                'media', 'table', 'emoticons', 'template', 'help'
            ],
            menu: {
                file: {
                    title: 'File',
                    items: 'newdocument restoredraft | preview | export print | deleteallconversations'
                },
                edit: {
                    title: 'Edit',
                    items: 'undo redo | cut copy paste pastetext | selectall | searchreplace'
                },
                view: {
                    title: 'View',
                    items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments'
                },
                insert: {
                    title: 'Insert',
                    items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime'
                },
                format: {
                    title: 'Format',
                    items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat'
                },
                tools: {
                    title: 'Tools',
                    items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount'
                },
                table: {
                    title: 'Table',
                    items: 'inserttable | cell row column | advtablesort | tableprops deletetable'
                },
                help: {
                    title: 'Help',
                    items: 'help'
                }
            }
        });
    </script>
    <script>
        $('select[name="brand_id"]').on('change', function() {

            var brand_id = $(this).val();

            $.ajax({
                url: "/get-smart-phone-model/ajax/" + brand_id,
                type: "GET",
                dataType: "json",
                success: function(response) {

                    $('#model_id').empty();
                    $('#model_id').append('<option value="" disabled selected> Select Model</option>');
                    // <option value="option_select" disabled selected>Select District</option>

                    $.each(response.data, function(key, item) {

                        $('#model_id').append('<option value="' + item.id + '">' + item
                            .model_name + '</option>');

                    });
                    $('.selectpicker').selectpicker('refresh');

                },
            });


        });
    </script>
    {{-- <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('js/ckeditor/editor.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/backend/smartPhoneSpecification.js') }}"></script>

@endsection
