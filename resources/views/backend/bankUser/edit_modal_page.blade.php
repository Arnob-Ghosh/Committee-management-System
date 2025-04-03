 <!-- Modal -->
 <div class="modal fade" id="editBankUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="" id="update_bank_user_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Bank User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="errMsgContainer mb-2"></div> --}}
                    {{-- <input type="hidden" name="speech_id" id="speech_id">
                    <input type="hidden" name="speech_img" id="speech_img"> --}}
                    <input type="hidden" name="bankUser_id" id="bankUser_id">
                    <input type="hidden" name="bankUser_img" id="bankUser_img">

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" >
                                <div class="nameError text-danger errors d-none"></div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="">Division Name</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="division_id">
                                    <option>Please Select the Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Father's Name</label>
                                <input type="text" name="father_name" id="father_name" class="form-control"  >
                                <div class="father_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Mother's Name</label>
                                <input type="text" name="mother_name" id="mother_name" class="form-control" >
                                <div class="mother_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Spouse Name</label>
                                <input type="text" name="spouse_name" id="spouse_name" class="form-control" >
                                <div class="spouse_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Date of Birth</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control"  >
                                <div class="birth_dateError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Blood Group</label>
                                <select class="form-select mb-2" aria-label="Default select example" name="blood_group" id="blood_group" >
                                    <option>Please Select the Blood Group</option>
                                    <option value="A+" >A+</option>
                                    <option value="A-"  >A-</option>
                                    <option value="B+"  >B+</option>
                                    <option value="B-"  >B-</option>
                                    <option value="AB+"  >AB+</option>
                                    <option value="AB-"  >AB-</option>
                                    <option value="O+"  >O+</option>
                                    <option value="O-"  >O-</option>
                                </select>
                                <div class="blood_groupError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Nationality</label>
                                <input type="text" name="nationality" id="nationality" class="form-control"  >
                                <div class="nationalityError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">National ID No.</label>
                                <input type="number" name="national_id" id="national_id" class="form-control" >
                                <div class="national_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Religion</label>
                                <input type="text" name="religion" id="religion" class="form-control"  >
                                <div class="religionError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Contact/Phone</label>
                                <input type="number" name="contact" id="contact" class="form-control"  >
                                <div class="contactError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">mobile</label>
                                <input type="number" name="mobile" id="mobile" class="form-control"  >
                                <div class="mobileError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control"  >
                                <div class="emailError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Image</label>
                                <input type="file" name="image" id="image" class="form-control" placeholder="Your Image" >
                                <div class="imageError text-danger errors d-none"></div>
                                <div class="edit_image"  id="edit_image" ></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="my-2">Address(Permanent)</h4>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="district">District</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="district" id="district" >
                                    <option selected disabled value="0">Please Select the District</option>
                                    <option value="Dhaka" selected>Dhaka</option>
                                </select>
                                <div class="districtError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="thana" class="form-label">Upzila/Thana</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="thana_id" id="thana_id" >
                                    <option selected disabled value="0">Please Select the Upzila</option>
                                    <option value="1" >Nawabganj</option>
                                    <option value="3" >Dohar</option>
                                </select>
                                <div class="thana_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="union" class="form-label">Union</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="union_id" id="union_id" >
                                    <option selected disabled value="0">Please Select the Union</option>
                                </select>
                                <div class="union_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="village" class="form-label">Village</label>
                                <!--<input type="text" name="village_id" id="village_id" class="form-control"  >-->
                                <select class="form-select mb-3" aria-label="Default select example" name="village_id" id="village_id" >
                                    <option selected disabled value="0">Please Select the Village</option>
                                </select>
                                <div class="village_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Post Office</label>
                                <input type="text" name="post_office" id="post_office" class="form-control"  >
                                <div class="post_officeError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="my-2 text-dark">Address(Present):</h4>
                          </div>
                        <div class="col-lg-12">
                        <textarea class="form-control w-100" rows="4" name = "present_address" id="present_address" placeholder="Enter your present address here"></textarea>
                        <div class="present_addressError text-danger errors d-none"></div>
                        
                        </div>
                        <div class="col-lg-12">
                            <h4 class="my-2">Address(Office)</h4>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Member ID</label>
                                <input type="text" name="member_id" id="member_id" class="form-control"  >
                                <div class="member_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" name="designation_id" id="designation_id" class="form-control"  >
                                <!--<select class="form-select mb-3" aria-label="Default select example" name="designation_id" id="designation_id" >-->
                                <!--    <option selected disabled value="0">Please Select the Designation</option>-->
                                <!--    @foreach ($designations as $designation)-->
                                <!--        <option value="{{ $designation->designation }}">{{ $designation->designation }}</option>-->
                                <!--    @endforeach-->
                                <!--</select>-->
                                <div class="designation_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="comitee_designation" class="form-label">Member Type</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="comitee_designation" id="comitee_designation" >
                                    <option selected disabled value="0">Please Select</option>
                                    <!--<option value="President">President</option>-->
                                    <!--<option value="Secretary">Secretary</option>-->
                                    <option value="Lifetime Member">Lifetime Member</option>
                                    <option value="General Member">General Member</option>
                                </select>
                                <div class="comitee_designationError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Office/Branch</label>
                                <input type="text" name="branch" id="branch" class="form-control" >
                                <div class="branchError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control" >
                                <div class="bank_nameError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Division/Section</label>
                                <input type="text" name="section" id="section" class="form-control"  >
                                <div class="sectionError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <!--<div class="col-lg-3">-->
                        <!--    <div class="">-->
                        <!--        <label for="">Present Address</label>-->
                        <!--        <input type="text" name="present_address" id="present_address" class="form-control"  >-->
                        <!--        <div class="present_addressError text-danger errors d-none"></div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Facebook ID</label>
                                <input type="text" name="facebook_id" id="facebook_id" class="form-control"  >
                                <div class="facebook_idError text-danger errors d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                <label for="">Active Status</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="status" id="status" >
                                    <option>Please Select the Status</option>
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                    {{-- <option value="2" >Pending</option> --}}
                                </select>
                                <div class="statusError text-danger errors d-none"></div>
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
