@extends('layouts.master')
@section('title', 'Exibition')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Exibiton List</h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <a href="/exibition-create"><button type="button"
                                    class="btn btn-primary">Add
                                    Exibition</button></a>


                            <div class="pt-2">
                                <table id="slider_image_table" class="display">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Exibition Image</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sliders as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>
                                                @if($item->status==1)
                                                <span class="badge badge-success"> Active</span>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td><img src="{{asset($item->slider)}}" style="width: 500; height:250"></td>
                                            <td>{{$item->start_date}} - {{$item->end_date}}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{route('exibition.edit',$item->id)}}">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="{{route('exibition.destroy',$item->id)}}"
                                                    id="delete">Delate</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- Card-body -->
                    </div> <!-- Card -->

                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- content-wrapper -->


<!-- Edit Image Modal -->

<!-- End Edit Image Modal -->

<!-- Delete Modal -->



<!-- END Delete Modal -->




@endsection

@section('script')
<script type="text/javascript">
    $(document).ready( function () {
    	$('#slider_image_table').DataTable();
	});

	$(document).on('click', '#close', function (e) {
		$('#EDITImageModal').modal('hide');
	});

	$(document).on('click', '.cancel_btn', function (e) {
		$('#DeleteSliderModal').modal('hide');
	});
</script>

@endsection
