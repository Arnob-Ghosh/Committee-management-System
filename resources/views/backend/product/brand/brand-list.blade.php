@extends('layouts.master')
@section('title', 'Brands')

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
                            <h5 class="m-0"><strong><i class="fas fa-clone"></i> BRANDS</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <a href="/brand-create"><button type="button" class="btn btn-outline-info"><i
                                        class="fas fa-plus"></i> Create Brand</button></a>

                            <input type="hidden" name="" id="subscriberid" value="{{auth()->user()->subscriber_id}}">
                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="brand_table" class="display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Logo</th>
                                                <th>Visiblity</th>
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

<!-- Edit Brand Modal -->
<div class="modal fade" id="EDITBrandMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>UPDATE BRAND</strong></h5>
            </div>


            <!-- Update Brand Form -->
            <form id="UPDATEBrandFORM" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">

                    <input type="hidden" name="brandid" id="brandid">

                    <div class="form-group  mb-3">
                        <label for="brandcategory" class="form-label" style="font-weight: normal;">Brand
                            Category<span class="text-danger"><strong>*</strong></span></label><br>
                        <select class="form-control w-50 selectpicker " name="category_id" id="edit_category_id"
                            data-live-search="true" title="Select Category">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                        <h6 class="text-danger pt-1" id="wrongbrandcategory" style="font-size: 14px;">
                        </h6>

                    </div>
                    <div class="form-group mb-3">
                        <label>Brand Name<span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" id="edit_brandname" name="brandname" class="form-control">
                        <h6 class="text-danger pt-1" id="wrongbrandname" style="font-size: 14px;"></h6>

                    </div>
                    <div class="form-group mb-3 pt-3">
                        <img src="" alt="Brnad image" width="100px" height="100px" alt="image" class="rounded pb-3"
                            name="brandimage" id="edit_brandimage">
                        <label>Brand Logo</label>
                        <input type="hidden" id="old_brand_logo" name="old_brand_logo" class="form-control">
                        <input type="file" id="edit_brandlogo" name="brandlogo" class="form-control">
                        <h6 class="text-danger pt-1" id="wrongbrandlogo" style="font-size: 14px;"></h6>
                    </div>

                    <div class="form-group pt-1">
                        <label for="brandlogo" class="form-label" style="font-weight: normal;">Homepage Visiblity<span class="text-danger"><strong>*</strong></span> <span
                                style="font-weight: normal;font-size: 14px; color: grey;"></span></label>

                        <select name="visiblity" id="edit_visiblity" class="form-control w-50" name="brandlogo" id="brandlogo">
                            <option value="" selected disabled>Select Visiblity</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                          </select>
                          <h6 class="text-danger pt-1" id="wrongvisiblity" style="font-size: 14px;"></h6>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- End Update Brand Form -->

        </div>
    </div>
</div>
<!-- End Edit Brand Modal -->

<!-- Delete Modal -->

<div class="modal fade" id="DELETEBrandMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="DELETEBrandFORM" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}


                <div class="modal-body">
                    <input type="hidden" name="" id="brandid">
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
<script type="text/javascript" src="{{asset('js/backend/brand.js')}}"></script>
<script type="text/javascript">
    $(document).on('click', '#close', function (e) {
		$('#EDITBrandMODAL').modal('hide');
	});

	$(document).on('click', '.cancel_btn', function (e) {
		$('#DELETEBrandMODAL').modal('hide');
	});
</script>

@endsection
