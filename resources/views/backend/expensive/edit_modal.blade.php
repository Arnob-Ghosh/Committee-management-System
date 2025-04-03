<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Expensive Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="errMsgContainer mb-2"></div> --}}
                    <input type="hidden" name="expensiveType_id" id="expensiveType_id">
                    {{-- <input type="hidden" name="speech_img" id="speech_img"> --}}

                    <div class="col-md-6">
                        <label for="" class="form-label">Type Name</label>
                        <input type="text" name="expensive" class="form-control" id="edit_expensive">
                        <div class="expensiveError text-danger errors d-none"></div>
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
