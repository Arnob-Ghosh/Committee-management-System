<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Program Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="programme_id" id="programme_id">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Program Name</label>
                                <input type="text" name="edit_programme_name" class="form-control" id="edit_programme_name">
                                <div class="edit_programme_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Start Date</label>
                                <input type="date" name="edit_start_date" class="form-control" id="edit_start_date">
                                <div class="edit_start_dateError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">End Date</label>
                                <input type="date" name="edit_end_date" class="form-control" id="edit_end_date">
                                <div class="edit_end_dateError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Registration Fees</label>
                                <input type="text" name="edit_registration_fees" class="form-control" id="edit_registration_fees">
                                <div class="edit_registration_feesError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Status</label>
                                <select class="form-control" data-live-search="true" name="edit_status" id="edit_status">
                                    <option disabled selected>Select to the status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    <!-- Add more years as needed -->
                                </select>
                                <div class="edit_statusError text-danger errors d-none"></div>
                            </div>
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
