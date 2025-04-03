@extends('layouts.master')
@section('title', 'Feature Phone Model List')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Feature Phone Model
                                    List</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <a href="{{url('/feature-phone/specification-create')}}"><button type="button"
                                    class="btn btn-outline-info"><i class="fas fa-plus"></i> Create
                                    Specification</button></a>

                            <a href="{{url('/feature-phone/specification-category-create')}}"><button type="button"
                                    class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create Specification
                                    Category</button></a>

                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="model_table" class="display table-bordered " width="100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>SL</th> --}}
                                                {{-- <th>Brand Name</th> --}}
                                                <th>Model Name</th>
                                                {{-- <th>Feature Category</th>
                                                <th>Feature Name</th> --}}
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i=1;
                                            @endphp
                                            @foreach($data as $item)
                                            <tr>
                                                {{-- <td>{{$i++}}</td> --}}
                                                {{-- <td>{{$item ['brand']['brand_name']}}</td> --}}
                                                <td>{{$item['feature_phone']['model_name']}}</td>
                                                {{-- <td>{{$item->feature_category}}</td>
                                                <td>{{$item->feature_name}} </td> --}}
                                                <td>{!!$item->description!!} </td>

                                                <td>
                                                    <a href="{{route('feature.phone.specification.edit.view',$item->id)}}"
                                                        class="edit_btn btn btn-info"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('feature.phone.specification.destroy',$item->id)}}"" class="
                                                        delete_btn btn btn-danger" id="delete"><i
                                                            class=" fal fa-trash-alt"></i></a>
                                                </td>

                                            </tr>
                                            @endforeach
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
{{-- <div class="modal fade" id="DELETEFSpecificationMODAL" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="DELETEFmodelFORM" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}


                <div class="modal-body">
                    <input type="hidden" name="" id="spec_id">
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
</div> --}}

<!-- Edit model Modal -->

<!-- End Edit model Modal -->

<!-- Delete Modal -->



<!-- END Delete Modal -->

@endsection

@section('script')
{{-- <script type="text/javascript" src="{{asset('js/backend/smartPhone.js')}}"></script> --}}

<script type="text/javascript">
    $(document).ready( function () {
    	$('#model_table').DataTable({
            responsive: true,
            rowsGroup: [0,1]
        });
	});
    $(document).on('click', '.cancel_btn', function (e) {
		$('#DELETEFSpecificationMODAL').modal('hide');
	});

    $('#model_table').on('click', '.delete_btn', function () {

        var id = $(this).val();

        $('#spec_id').val(id);

        $('#DELETEFvariantFORM').attr('action', '/feature-phone/specification-delete/' + id);

        $('#DELETEFSpecificationMODAL').modal('show');

    });



	$(document).on('click', '.cancel_btn', function (e) {
		$('#DELETEFmodelMODAL').modal('hide');

	});
</script>

@endsection
