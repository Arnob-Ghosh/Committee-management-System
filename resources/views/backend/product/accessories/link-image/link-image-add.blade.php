@extends('layouts.master')
@section('title', 'Add Image Link')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Header -->
            </div>
        </div>
    </div>

    <div class="content pt-4 ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-header">
                            <h5 class="m-0">Create Image Link</h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <form method="POST" action="{{route('accessories.link.store')}}"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="mb-3">
                                        <input type="hidden" name="url" id="url">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1"> Image</label>
                                            <input type="file" class="form-control" id="file" name="file"
                                                id="exampleFormControlFile1">
                                            @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>

                            </div> <!-- container -->
                        </div> <!-- card-body -->
                    </div> <!-- card card-primary card-outline -->
                </div> <!-- col-lg-5 -->
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </div> <!-- content -->

</div> <!-- content-wrapper -->

@endsection

@section('script')
<script>
    $(document).ready(function () {

   let url=window.location.origin;
   $('#url').val(url);
});
</script>

@endsection


