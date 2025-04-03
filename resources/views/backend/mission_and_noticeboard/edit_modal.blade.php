<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Notice Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="errMsgContainer mb-2"></div> --}}
                    <input type="hidden" name="notice_id" id="notice_id">
                    <input type="hidden" name="notice_img" id="notice_img">

                    <div class="col-md-12">
                        <label for="" class="form-label">Title</label>
                        <textarea name="title" class="form-control" id="edit_title" cols="30" rows="2"></textarea>
                        <div class="titleError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Desscription</label>
                        <textarea name="long_desc" class="form-control" id="edit_long_desc" cols="30" rows="2"></textarea>
                        <div class="long_descError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Role</label>
                        <select class="form-select" name="role" id="edit_role" aria-describedby="" >
                            <option selected disabled value="">Please select a Role</option>
                            <option value="Mission and Vision">Mission and Vision</option>
                            <option value="Notice Board">Notice Board</option>
                        </select>
                        <div class="roleError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Status</label>
                        <select class="form-select" name="status" id="edit_status" aria-describedby="" >
                          <option selected disabled value="">Please select a Status</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                        <div class="statusError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="up_image" aria-describedby="" >
                        <div class="imageError text-danger errors d-none"></div>
                        <div class="edit_image"  id="edit_image" ></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_user_btn">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
