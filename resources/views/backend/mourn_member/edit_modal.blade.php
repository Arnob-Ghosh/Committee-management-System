<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Mourn Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="errMsgContainer mb-2"></div> --}}
                    <input type="hidden" name="mourn_id" id="mourn_id">
                    {{-- <input type="hidden" name="speech_img" id="speech_img"> --}}

                    <div class="col-md-5">
                        <label class="form-label" >Member ID </label>
                        <select class="form-control" data-live-search="true" name="member_id" id="edit_member_id">
                            <option  disabled selected>plesse select</option>
                            @foreach ( $bankUsers as $bankUser )
                                <option value="{{ $bankUser->member_id }}">{{ $bankUser->member_id }}</option>
                            @endforeach
                            <!-- Add more years as needed -->
                        </select>
                        <div class="member_idError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" >Name </label>
                            <input type="text" class="form-control" name="name" id="edit_name">
                        <div class="nameError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" >Dead Date </label>
                        <input type="date" class="form-control" name="mourn_date" id="edit_mourn_date">
                        <div class="mourn_dateError text-danger errors d-none"></div>
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
