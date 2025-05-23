@extends('layouts.master')
@section('title', 'Events')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> EVENTS</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <a href="/category-create"><button type="button" class="btn btn-outline-info"><i
                                        class="fas fa-plus"></i> Create Event</button></a>


                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="category_table" class="display table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Event Name</th>
                                                <th>Event Image</th>
                                                <th>Event Title</th>

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

<!-- Edit Category Modal -->
<div class="modal fade" id="EDITCategoryMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>UPDATE EVENT</strong></h5>
            </div>


            <!-- Update Category Form -->
            <form id="UPDATECategoryFORM" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">

                    <input type="hidden" name="categoryid" id="categoryid">

                    <div class="form-group mb-3">
                        <label class="form-label">Event Name<span
                                class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="edit_categoryname" name="categoryname" class="form-control">
                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your event name
                            meaningful.</div>
                        <h6 class="text-danger pt-1" id="edit_wrongcategoryname" style="font-size: 14px;"></h6>
                    </div>

                    <input type="hidden" id="old_categoryimage" name="old_categoryimage" class="form-control">

                    <div class="form-group mb-3 pt-3">
                        <img src=""  width="100px" height="100px" alt="image"
                            class="rounded-circle pb-3" name="brandimage" id="edit_categoryimage_view">
                        <label>Event Image</label>
                        <input type="file" id="edit_categoryimage" name="categoryimage" class="form-control">
                    </div>
                    <input type="hidden" id="old_titleimage" name="old_titleimage" class="form-control">

                    <div class="form-group mb-3 pt-3">
                        <img src=""  width="100px" height="100px" alt="image"
                            class="rounded-circle pb-3" name="edit_titleimage" id="edit_titleimage_view">
                        <label>Event Title</label>
                        <input type="file" id="old_titleimage" name="titleimage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit_description" class="form-label">Description<span
                                class="text-danger"><strong>*</strong></span></label>
                        <textarea class="form-control description_area" id="edit_description" name="edit_description"></textarea>

                        <h6 class="text-danger pt-1" id="wrong_description" style="font-size: 14px;">
                        </h6>
                    </div>
                    <div class="form-group">
                        <label for="desc" class="form-label">Short Description<span
                                class="text-danger"><strong>*</strong></span></label>
                        <textarea class="form-control desc_area" id="edit_desc" name="edit_desc"></textarea>

                        <h6 class="text-danger pt-1" id="wrong_desc" style="font-size: 14px;">
                        </h6>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- End Update Category Form -->

        </div>
    </div>
</div>
<!-- End Edit Category Modal -->

<!-- Delete Modal -->

<div class="modal fade" id="DELETECategoryMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="DELETECategoryFORM" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}


                <div class="modal-body">
                    <input type="hidden" name="" id="categoryid">
                    <h5 class="text-center">Are you sure you want to delete?</h5>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="cancel btn btn-secondary cancel_btn"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="delete btn btn-danger">Yes</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- END Delete Modal -->

@endsection

@section('script')

<script type="text/javascript" src="{{asset('js/backend/category.js')}}"></script>
<script type="text/javascript">
    $(document).on('click', '#close', function (e) {
		$('#EDITCategoryMODAL').modal('hide');
		$('#edit_wrongcategoryname').empty();
	});

	$(document).on('click', '.cancel_btn', function (e) {
		$('#DELETECategoryMODAL').modal('hide');

	});
</script>

@endsection
