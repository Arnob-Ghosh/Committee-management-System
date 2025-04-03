@extends('layouts.master')
@section('title', 'Explore Product Slider Image List')

{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}

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
	                <h5 class="m-0">Explore Product Slider Image List</h5>
	              </div>
	              <div class="card-body">
	                <!-- <h6 class="card-title">Special title treatment</h6> -->
	                <!-- Table -->

                	<a href="{{route('explore.slider.create.view')}}"><button type="button" class="btn btn-primary">Add Image</button></a>


                    <div class="pt-2">
                        <div class="table-responsive">
											<table id="slider_image_table" class="display table  table-bordered">
											    <thead>
											        <tr>
											            <th >ID</th>
														<th >Link</th>
											            <th >Status</th>
                                                        <th >Category</th>
											            <th >Slider Image</th>
											            <th >Action</th>
											        </tr>
											    </thead>
                                                @php
                                                    $i=1;
                                                @endphp
											    <tbody>
													@foreach($sliders as $item)
                                                     <tr>
														<td>{{$i++}}</td>
														<td>{{$item->slider_url}}</td>
														<td>
														@if($item->status==1)
															<span class="badge badge-success"> Active</span>
														 @else
														 <span class="badge badge-danger">Inactive</span>
														@endif
													    </td>
                                                        <td>{{$item->category_name}}</td>
														 <td><img src="{{asset($item->slider)}}" style="width: 400; height:200"></td>
														 <td>
															<a class="btn btn-info" href="{{route('explore.slider.edit.view',$item->id)}}">Edit</a>
															<a class="btn btn-danger" href="{{route('explore.slider.destroy',$item->id)}}" id="delete">Delate</a>
														 </td>

													 </tr>
                                                    @endforeach
											    </tbody>
										    </table>
										</div>
                                    </div>
	              </div> <!-- Card-body -->
	            </div>	<!-- Card -->

	        </div>   <!-- /.col-lg-6 -->
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



