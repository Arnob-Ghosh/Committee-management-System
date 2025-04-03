@extends('layouts.master')
@section('title', 'Designation List')



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
                            <h5 class=" text-dark mb-0 flex-grow-1">Manage Designation</h5>
                            <div class="flex-shrink-0">
                                <button href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDesignationModal">
                                    <i class="bi-plus-circle"> Add New Designation</i>
                                </button>
                            </div>
                        </div>
                        {{-- <div class="d-flex mb-2 me-2">
                            <h5 class="mt-3 ms-2">Manage Designation</h5>
                            <a href="" class="btn btn-success mt-2 ms-auto" data-bs-toggle="modal" data-bs-target="#addDesignationModal">Add Designation</a>
                        </div> --}}
                        <div class="card-body mt-2" id="show_all_designation">



                          <!-- Table with stripped rows -->
                          {{-- <table class="table table-striped" id="">
                            <thead>
                              <tr>
                                <th scope="col">#SL.</th>
                                <th scope="col">Designation Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Brandon Jacob</td>
                                <td>
                                    <a href=""><i class="ri-edit-box-fill" style="color: green"></i></a>
                                    <a href=""><i class="ri-delete-bin-fill" style="color: red"></i></a>
                                </td>
                              </tr>

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


<!-- Add Modal -->
<div class="modal fade" id="addDesignationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <form action="" method="POST" id="add_designation_form" class="needs-validation was-validation" novalidate>
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Add Designation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- <div class="errMsgContainer"></div> --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control" id="designation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="submit" class="btn btn-primary add_designation">Add Designation</button>
                </div>
            </div>
        </div>
    </form>
</div><!-- End Basic Modal-->

<!-- Edit Modal -->
<div class="modal fade" id="editDesignationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <form action="" method="POST" id="edit_designation_form" class="needs-validation was-validation" novalidate>
        @csrf
        <input type="hidden" name="designation_id" id="designation_id">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Update Designation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- <div class="errMsgContainer"></div> --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="designation" class="form-label">Designation Name</label>
                        <input type="text" name="editDesignation" class="form-control" id="edit_designation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_designation_btn" class="btn btn-primary">Update Designation</button>
                </div>
            </div>
        </div>
    </form>
</div><!-- End Basic Modal-->

@endsection

@section('script')
{{-- <script type="text/javascript" src="{{asset('js/backend/smartPhone.js')}}"></script> --}}

<script src="">
    $(document).ready( function () {
        $('#designationTBL').DataTable();
    });
</script>


<script>

    // fetch all designation ajax request
    fetchAllDesignations();

    function fetchAllDesignations() {
        $.ajax({
            url: '{{ route('fetchAll.designation') }}',
            method: 'get',
            success: function (res) {
                $("#show_all_designation").html(res);
                $("table").DataTable({
                    order: [0, 'asc']
                });
            }
        });
    }

    // add new designation ajax request
    $("#add_designation_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_designation_btn").text('Adding...');
        $.ajax({
        url: '{{ route('store.designation') }}',
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
                        'Designation Added Successfully!',
                        'success'
                    )
                    fetchAllDesignations();
                }
                $("#add_designation_btn").text('Add Blood Group');
                $("#add_designation_form")[0].reset();
                $("#addDesignationModal").modal('hide');
                // $(location).attr('href','/designation/manage');
                location.reload();
            }
        });
    });

    // edit designation ajax request
    $(document).on('click', '.editIcon', function (e) {
        e.preventDefault();
        let id = $(this).attr('id');
        // console.log(id);
        // alert(id);
        $.ajax({
            url: '{{ route('edit.designation') }}',
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                // console.log(res.id);
                $("#edit_designation").val(res.designation);
                $("#designation_id").val(res.id);
            }
        });
    });

    // update designation ajax request
    $("#edit_designation_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_designation_btn").text('Updating...');
        $.ajax({
        url: '{{ route('update.designation') }}',
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
                if (response.status == 200) {
                    Swal.fire(
                        'Updated!',
                        'Designation Updated Successfully!',
                        'success'
                    )
                    fetchAllDesignations();
                }
                $("#edit_designation_btn").text('Update Designation');
                $("#edit_designation_form")[0].reset();
                $("#editDesignationModal").modal('hide');
                $(location).attr('href','/designation/manage');
            }
        });
    });

    // delete designation ajax request
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
                    url: '{{ route('destroy.designation') }}',
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
                        fetchAllDesignations();
                    }
                });
            }
        })
    });
</script>


@endsection
