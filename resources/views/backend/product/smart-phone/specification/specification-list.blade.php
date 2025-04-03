@extends('layouts.master')
@section('title', 'Smart Phone Model List')



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
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> Smart Phone Model
                                    List</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <a href="{{url('/smart-phone/specification-create')}}"><button type="button"
                                    class="btn btn-outline-info"><i class="fas fa-plus"></i> Create
                                    Specification</button></a>

                            <a href="{{url('/smart-phone/specification-category-create')}}"><button type="button"
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
                                                <td>{{$item['smart_phone']['model_name']}}</td>
                                                {{-- <td>{{$item->feature_category}}</td>
                                                <td>{{$item->feature_name}} </td> --}}
                                                <td>{!!$item->description!!} </td>

                                                <td>
                                                    <a href="{{route('smart.phone.specification.edit.view',$item->id)}}"
                                                        class="edit_btn btn btn-info"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('smart.phone.specification.destroy',$item->id)}}"
                                                        class="
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
    $(document).on('click', '#close', function (e) {
		$('#DELETEFmodelMODAL').modal('hide');
		$('#edit_wrongmodelname').empty();
	});

	$(document).on('click', '.cancel_btn', function (e) {
		$('#DELETEFmodelMODAL').modal('hide');

	});
</script>

@endsection
