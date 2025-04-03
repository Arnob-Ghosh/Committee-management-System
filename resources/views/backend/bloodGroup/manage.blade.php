@extends('layouts.master')
@section('title', 'Blood Group List')



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

                    <div class="card">
                        <div class="card-header bg-light d-flex align-items-center">
                            <h5 class=" text-dark mb-0 flex-grow-1">Manage Blood Group</h5>
                            <div class="flex-shrink-0">
                                <button href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBloodGroupModal">
                                    <i class="bi-plus-circle"> Add New Blood Group</i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body mt-2" id="show_all_bloodGroups">
                          {{-- <h5 class="card-title">Manage Blood Group</h5> --}}

                          <!-- Table with stripped rows -->
                          {{-- <table class="table table-bordered table-striped datatable">
                            <thead>
                              <tr>
                                <th scope="col">#SL.</th>
                                <th scope="col">Blood Group Name</th>
                                <th scope="col">Blood Group Sign</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ( $bloodGroups->count() > 0 )
                                @php
                                    $i = 1;
                                @endphp
                                    @foreach ( $bloodGroups as $bloodGroup )
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $bloodGroup->blood_group }}</td>
                                            <td>
                                                @if ( $bloodGroup->blood_sign == 1 )
                                                    <span class="badge bg-success">Positive</span>
                                                @else
                                                    <span class="badge bg-danger">Negative</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href=""><i class="ri-edit-box-fill" style="color: green"></i></a>
                                                <a href=""><i class="ri-delete-bin-fill" style="color: red"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @else
                                    <h1 class="text-center text-secondary my-5">No record present in the database!</h1>
                                @endif


                            </tbody>
                          </table> --}}
                          <!-- End Table with stripped rows -->

                        </div>
                      </div> <!-- Card -->

                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->


 {{-- add new blood group modal start --}}
 <div class="modal fade" id="addBloodGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Blood Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/store" method="POST" id="add_blood_group_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="blood_group" class="form-label">Blood Group Name</label>
                            <input type="text" name="blood_group" class="form-control" id="blood_group" required>
                            <div class="invalid-feedback">
                                Please write a blood group name.
                            </div>
                        </div>
                        <div class="col-lg-12 my-2">
                            <label for="blood_sign" class="form-label">Blood Group Sign</label>
                            <select id="blood_sign" name="blood_sign" class="form-select" required>
                            <option selected disabled value="">Choose a blood group sign</option>
                            <option value="1">Positive</option>
                            <option value="0">Negative</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a blood group sign.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_blood_group_btn" class="btn btn-primary">Add Blood Group</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new blood group modal end --}}

{{-- edit blood group modal start --}}
<div class="modal fade" id="editBloodGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Edit Blood Group</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <form action="#" method="POST" id="edit_blood_group_form" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="blood_group_id" id="blood_group_id">
             <div class="modal-body p-4 bg-light">
                 <div class="row">
                     <div class="col-lg-12">
                         <label for="blood_group" class="form-label">Blood Group Name</label>
                         <input type="text" name="edit_blood_group" class="form-control" id="edit_blood_group" required>
                         <div class="invalid-feedback">
                             Please write a blood group name.
                         </div>
                     </div>
                     <div class="col-lg-12 my-2">
                         <label for="blood_sign" class="form-label">Blood Group Sign</label>
                         <select id="edit_blood_sign" name="edit_blood_sign" class="form-select" required>
                         <option selected disabled value="">Choose a blood group sign</option>
                         <option value="1">Positive</option>
                         <option value="0">Negative</option>
                         </select>
                         <div class="invalid-feedback">
                             Please select a blood group sign.
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" id="edit_blood_group_btn" class="btn btn-primary">Update Blood Group</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
</div>
{{-- edit blood group modal end --}}

@endsection

@section('script')
{{-- <script type="text/javascript" src="{{asset('js/backend/smartPhone.js')}}"></script> --}}


     <script>
        // fetch all blood groups ajax request
        fetchAllBloodGroups();

        function fetchAllBloodGroups() {
            $.ajax({
                url: '{{ route('fetchAll.bloodGroup') }}',
                method: 'get',
                success: function (res) {
                    $("#show_all_bloodGroups").html(res);
                    $("table").DataTable({
                        order: [0, 'asc']
                    });
                }
            });
        }
        // add new blood group ajax request
        $("#add_blood_group_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_blood_group_btn").text('Adding...');
            $.ajax({
            url: '{{ route('store.bloodGroup') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Blood Group Added Successfully!',
                            'success'
                        )
                        fetchAllBloodGroups();
                    }
                    $("#add_blood_group_btn").text('Add Blood Group');
                    $("#add_blood_group_form")[0].reset();
                    $("#addBloodGroupModal").modal('hide');
                }
            });
        });

        // edit blood group ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            // alert(id);
            $.ajax({
                url: '{{ route('edit.bloodGroup') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // console.log(res.id);
                    $("#edit_blood_group").val(res.blood_group);
                    $("#edit_blood_sign").val(res.blood_sign);
                    $("#blood_group_id").val(res.id);
                }
            });
        });

        // update blood group ajax request
        $("#edit_blood_group_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_blood_group_btn").text('Updating...');
            $.ajax({
            url: '{{ route('update.bloodGroup') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            // dataType: 'json',
            success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'Blood Group Updated Successfully!',
                            'success'
                        )
                        fetchAllBloodGroups();
                    }
                    $("#edit_blood_group_btn").text('Update Blood Group');
                    $("#edit_blood_group_form")[0].reset();
                    $("#editBloodGroupModal").modal('hide');
                }
            });
        });

        // delete blood group ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                        url: '{{ route('destroy.bloodGroup') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            fetchAllBloodGroups();
                        }
                    });
                }
            })
        });

    </script>


@endsection
