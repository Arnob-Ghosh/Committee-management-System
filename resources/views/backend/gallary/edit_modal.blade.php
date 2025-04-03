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
                    <input type="hidden" name="gallary_id" id="gallary_id">
                    <input type="hidden" name="gallary_img" id="gallary_img">
                    {{-- <input type="hidden" name="speech_img" id="speech_img"> --}}

                    <div class="col-md-6">
                        <label for="" class="form-label">Gallary Photo</label>
                        <input type="file" name="gallary" class="form-control" id="gallary">
                        <div class="gallaryError text-danger errors d-none"></div>
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
