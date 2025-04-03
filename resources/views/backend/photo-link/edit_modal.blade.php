<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Gallary Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="errMsgContainer mb-2"></div> --}}
                    <input type="hidden" name="photo_id" id="photo_id">
                    {{-- <input type="hidden" name="gallary_img" id="gallary_img"> --}}
                    {{-- <input type="hidden" name="speech_img" id="speech_img"> --}}

                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label" >Title </label>
                            <input type="text" class="form-control" name="title" id="edit_title">
                            <div class="titleError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label" >Photo Drive Link </label>
                            <input type="text" class="form-control" name="photo_link" id="edit_photo_link">
                            <div class="photo_linkError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Date </label>
                            <input type="date" class="form-control" name="date" id="edit_date">
                            <div class="dateError text-danger errors d-none"></div>
                        </div>
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
