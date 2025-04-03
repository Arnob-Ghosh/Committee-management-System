@extends('layouts.master')
@section('title', 'Collection')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Collection</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <a href="/collection-add"><button type="button" class="btn btn-outline-info"><i
                                        class="fas fa-plus"></i> Create Collection</button></a>


                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="news_table" class="display table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Collection Name</th>
                                                <th>Collection Category</th>
                                                <th>Collection Thumbnail</th>
                                                <th>Collection Image</th>
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

<!-- Edit News Modal -->
<div class="modal fade" id="EDITNewsMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>UPDATE Collection</strong></h5>
            </div>


            <!-- Update News Form -->
            <form id="UPDATENewsFORM" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">

                    <input type="hidden" name="newsid" id="newsid">

                    <div class="form-group mb-3">
                        <label class="form-label">Collection Name<span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="edit_newsname" name="newsname" class="form-control">
                        <div id="" class="form-text"><strong>N.B. </strong>Be sure to make your news name
                            meaningful.</div>
                        <h6 class="text-danger pt-1" id="edit_wrongnewsname" style="font-size: 14px;"></h6>
                    </div>

                    <input type="hidden" id="old_newsimage" name="old_newsimage" class="form-control">

                    <div class="form-group mb-3 pt-3">
                        <img src="" alt="Brnad image" width="100px" height="100px" alt="image"
                            class="rounded-circle pb-3" name="brandimage" id="edit_newsimage_view">
                        <label>Collection Image</label>
                        <input type="file" id="edit_newsimage" name="newsimage" class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- End Update News Form -->

        </div>
    </div>
</div>
<!-- End Edit News Modal -->

<!-- Delete Modal -->

<div class="modal fade" id="DELETENewsMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="DELETENewsFORM" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}


                <div class="modal-body">
                    <input type="hidden" name="" id="newsid">
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
<script type="text/javascript" src="{{asset('js/backend/news.js')}}"></script>
<script type="text/javascript">
    $(document).on('click', '#close', function (e) {
		$('#EDITNewsMODAL').modal('hide');
		$('#edit_wrongnewsname').empty();
	});

	$(document).on('click', '.cancel_btn', function (e) {
		$('#DELETENewsMODAL').modal('hide');

	});
</script>

@endsection
