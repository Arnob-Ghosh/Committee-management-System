@extends('layouts.master')
@section('title', 'Dynamic Pages - Support and Service')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row mb-2 -->
        </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> SUPPORT AND SERVICE</strong>
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <button type="button" class="create-btn btn btn-outline-info"><i class="fas fa-plus"></i>
                                Create
                                Support and Service</button>


                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="support_and_service_table" class="table-bordered display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- Card-body -->
                    </div> <!-- Card -->

                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<!--Create SupportAndService Modal -->
<div class="modal fade" id="CreateSupportAndServiceModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>CREATE SUPPORT AND SERVICE DESCRIPTION</strong>
                </h5>
            </div>


            <!-- Create SupportAndService Form -->
            <form id="CreateSupportAndServiceForm" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="description" class="form-label">Description<span
                                class="text-danger"><strong>*</strong></span></label>
                        <textarea class="form-control description_area" id="description" name="description"></textarea>

                        <h6 class="text-danger pt-1" id="wrong_description" style="font-size: 14px;">
                        </h6>
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <!-- End Update district Form -->

        </div>
    </div>
</div>
<!-- End Create SupportAndService Modal -->

<!--Edit SupportAndService Modal -->
<div class="modal fade" id="EditSupportAndServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>EDIT SUPPORT AND SERVICE</strong></h5>
            </div>


            <!-- Update SupportAndService Form -->
            <form id="EditSupportAndServiceForm" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="get_SupportAndService_id" name="" class="form-control">

                        <label for="description" class="form-label">Description<span
                                class="text-danger"><strong>*</strong></span></label>
                        <textarea class="form-control description_area" id="edit_description"
                            name="description"></textarea>

                        <h6 class="text-danger pt-1" id="edit_wrong_description" style="font-size: 14px;"></h6>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="edit_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- End Update SupportAndService Form -->

        </div>
    </div>
</div>
<!-- End Edit SupportAndService Modal -->

<!-- End Delete SupportAndService Modal -->
<div class="modal fade" id="DeleteSupportAndServiceModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <input type="hidden" name="" id="SupportAndService_id">
                <h5 class="text-center">Are you sure you want to delete?</h5>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="cancel btn btn-secondary cancel_dlt_btn"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="delete confrim_dlt btn btn-danger">Yes</button>
            </div>

        </div>
    </div>
</div>
<!-- End Delete SupportAndService Modal -->
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
<script type="text/javascript" src="{{asset('js/backend/SupportAndService.js')}}"></script>
<script type="text/javascript">
    $(document).on('click', '#edit_close', function(e) {
            $('#EditSupportAndServiceModal').modal('hide');
            // $('#edit_wrongDistrictname').empty();
        });


</script>

{{-- <script>


</script> --}}
@endsection
