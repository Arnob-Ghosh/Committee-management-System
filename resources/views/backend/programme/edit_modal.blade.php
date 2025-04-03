<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Expensive Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="programme_id" id="programme_id">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Programme Name</label>
                                <input type="text" name="edit_programme_name" class="form-control" id="edit_programme_name">
                                <div class="edit_programme_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Programme Date</label>
                                <input type="date" name="edit_date" class="form-control" id="edit_date">
                                <div class="edit_dateError text-danger errors d-none"></div>
                            </div>
                        </div> --}}
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Applicant Name</label>
                                <input type="text" name="edit_applicant_name" class="form-control" id="edit_applicant_name">
                                <div class="edit_applicant_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Transaction ID</label>
                                <input type="text" name="edit_father_name" class="form-control" id="edit_father_name">
                                <div class="edit_father_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Union</label>
                                <input type="text" name="edit_union" class="form-control" id="edit_union">
                                <div class="edit_unionError text-danger errors d-none"></div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="edit_email" class="form-control" id="edit_email">
                                <div class="edit_emailError text-danger errors d-none"></div>
                            </div>
                        </div> --}}
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Phone No.</label>
                                <input type="text" name="edit_phone" class="form-control" id="edit_phone">
                                <div class="edit_phoneError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Total Participants No</label>
                                <input type="number" name="edit_participants_num" class="form-control" id="edit_participants_num">
                                <div class="edit_participants_numError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">0-5 Years Age</label>
                                <input type="number" name="edit_child_age1" class="form-control" id="edit_child_age1">
                                <div class="edit_child_age1Error text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="">
                                <label for="" class="form-label">Applicants+Guest</label>
                                <input type="number" name="edit_child_age2" class="form-control" id="edit_child_age2">
                                <div class="edit_child_age2Error text-danger errors d-none"></div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="">
                                <label class="form-label" >Child Age </label>
                                <select class="selectpicker form-control" data-live-search="true" name="edit_child_age" id="edit_child_age">
                                    <option disabled selected>Select to the child age</option>
                                    <option value="0-5 years">0-5 years</option>
                                    <option value="5 years above">5 years above</option>
                                    <!-- Add more years as needed -->
                                </select>
                                <div class="edit_child_ageError text-danger errors d-none"></div>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div class="col-md-5">
                        <label for="" class="form-label">Programme Name</label>
                        <input type="text" name="edit_programme_name" class="form-control" id="edit_programme_name">
                        <div class="edit_programme_nameError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Programme Date</label>
                        <input type="date" name="edit_date" class="form-control" id="edit_date">
                        <div class="edit_dateError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Applicant Name</label>
                        <input type="text" name="edit_applicant_name" class="form-control" id="edit_applicant_name">
                        <div class="edit_applicant_nameError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Father Name</label>
                        <input type="text" name="edit_applicant_name" class="form-control" id="edit_father_name">
                        <div class="edit_father_nameError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Email</label>
                        <input type="text" name="edit_email" class="form-control" id="edit_email">
                        <div class="edit_emailError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Phone No.</label>
                        <input type="text" name="edit_phone" class="form-control" id="edit_phone">
                        <div class="edit_phoneError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Participants Number</label>
                        <input type="text" name="edit_participants_num" class="form-control" id="edit_participants_num">
                        <div class="edit_participants_numError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" >Child Age </label>
                        <select class="selectpicker form-control" data-live-search="true" name="edit_mode" id="edit_mode">
                            <option disabled selected>Select to the child age</option>
                            <option value="0-5 years">0-5 years</option>
                            <option value="5 years above">5 years above</option>
                        </select>
                        <div class="edit_child_ageError text-danger errors d-none"></div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_user_btn">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
