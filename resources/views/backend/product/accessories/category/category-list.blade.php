@extends('layouts.master')
@section('title', 'Accessories Category')

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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> ACCESSORIES CATEGORY</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <button type="button" class="create-btn btn btn-outline-info"><i class="fas fa-plus"></i>
                                Create
                                Accessories Category</button>


                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="accessoriesCategory_table" class="table-bordered display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>accessories Category Name</th>
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

<!--Create accessoriesCategory Modal -->
<div class="modal fade" id="CreateaccessoriesCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>CREATE ACCESSORIES CATEGORY</strong></h5>
            </div>


            <!-- Create accessoriesCategory Form -->
            <form id="CreateaccessoriesCategoryForm" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="accessoriesCategory_name" class="form-label">Accessories Category Name<span
                                class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="accessoriesCategory_name" name="accessoriesCategory_name"
                            class="form-control" placeholder="Ex. Joe Byden">
                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your accessoriesCategory
                            name
                            meaningful.</div>
                        <h6 class="text-danger pt-1" id="wrong_accessoriesCategory_name" style="font-size: 14px;">
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
<!-- End Create accessoriesCategory Modal -->

<!--Edit accessoriesCategory Modal -->
<div class="modal fade" id="EditaccessoriesCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>EDIT ACCESSORIES CATEGORY</strong></h5>
            </div>


            <!-- Update accessoriesCategory Form -->
            <form id="EditaccessoriesCategoryForm" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="get_accessoriesCategory_id" name="" class="form-control">

                        <label for="accessoriesCategory_name" class="form-label">Accessories Category Name<span
                                class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="edit_accessoriesCategory_name" name="accessoriesCategory_name"
                            class="form-control" placeholder="Ex. Joe Byden">
                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your accessoriesCategory
                            name
                            meaningful.</div>
                        <h6 class="text-danger pt-1" id="edit_wrong_accessoriesCategory_name"
                            style="font-size: 14px;"></h6>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="edit_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- End Update accessoriesCategory Form -->

        </div>
    </div>
</div>
<!-- End Edit accessoriesCategory Modal -->

<!-- End Delete accessoriesCategory Modal -->
<div class="modal fade" id="DeleteaccessoriesCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <input type="hidden" name="" id="accessoriesCategory_id">
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
<!-- End Delete accessoriesCategory Modal -->
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/backend/AccessoryCategory.js')}}"></script>
<script type="text/javascript">
    $(document).on('click', '#edit_close', function(e) {
            $('#EditaccessoriesCategoryModal').modal('hide');
            // $('#edit_wrongDistrictname').empty();
        });


</script>

@endsection
