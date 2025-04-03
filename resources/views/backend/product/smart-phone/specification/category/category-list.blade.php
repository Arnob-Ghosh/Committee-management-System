@extends('layouts.master')
@section('title', 'Specification Category')

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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Specification
                                    Category</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <button type="button" class="create-btn btn btn-outline-info"><i class="fas fa-plus"></i>
                                Create
                                Specification Category</button>


                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="specificationCategory_table" class="table-bordered display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Specification Category Name</th>
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

<!--Create specificationCategory Modal -->
<div class="modal fade" id="CreatespecificationCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>CREATE specificationCategory</strong></h5>
            </div>


            <!-- Create specificationCategory Form -->
            <form id="CreatespecificationCategoryForm" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="specificationCategory_name" class="form-label">specificationCategory Name<span
                                class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="specificationCategory_name" name="specificationCategory_name"
                            class="form-control" placeholder="Ex. Joe Byden">
                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your specificationCategory
                            name
                            meaningful.</div>
                        <h6 class="text-danger pt-1" id="wrong_specificationCategory_name" style="font-size: 14px;">
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
<!-- End Create specificationCategory Modal -->

<!--Edit specificationCategory Modal -->
<div class="modal fade" id="EditspecificationCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>EDIT specificationCategory</strong></h5>
            </div>


            <!-- Update specificationCategory Form -->
            <form id="EditspecificationCategoryForm" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="get_specificationCategory_id" name="" class="form-control">

                        <label for="specificationCategory_name" class="form-label">specificationCategory Name<span
                                class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="edit_specificationCategory_name" name="specificationCategory_name"
                            class="form-control" placeholder="Ex. Joe Byden">
                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your specificationCategory
                            name
                            meaningful.</div>
                        <h6 class="text-danger pt-1" id="edit_wrong_specificationCategory_name"
                            style="font-size: 14px;"></h6>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="edit_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- End Update specificationCategory Form -->

        </div>
    </div>
</div>
<!-- End Edit specificationCategory Modal -->

<!-- End Delete specificationCategory Modal -->
<div class="modal fade" id="DeletespecificationCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <input type="hidden" name="" id="specificationCategory_id">
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
<!-- End Delete specificationCategory Modal -->
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/backend/specificationCategory.js')}}"></script>
<script type="text/javascript">
    $(document).on('click', '#edit_close', function(e) {
            $('#EditspecificationCategoryModal').modal('hide');
            // $('#edit_wrongDistrictname').empty();
        });


</script>

@endsection
