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

                    <div class="col-md-5">
                        <label class="form-label" >Expensive Type </label>
                        <select class="form-control" data-live-search="true" name="edit_expensive" id="edit_expensive">
                            <option  disabled selected>plesse select</option>
                            @foreach ( $expensiveTypes as $expensiveType )
                                <option value="{{ $expensiveType->name }}">{{ $expensiveType->name }}</option>
                            @endforeach
                            <!-- Add more years as needed -->
                        </select>
                        <div class="edit_expensiveError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" >Payment Mode </label>
                        <input type="text"class="form-control" name="edit_mode" id="edit_mode">
                        {{-- <select class="selectpicker form-control" data-live-search="true" name="edit_mode" id="edit_mode">
                            <option  disabled selected>plesse select</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Upay">Upay</option>
                            <option value="Rocket">Rocket</option>
                        </select> --}}
                        <div class="edit_modeError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Payment Date</label>
                        <input type="date" name="edit_date" class="form-control" id="edit_date">
                        <div class="edit_dateError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Cash in</label>
                        <input type="number" name="edit_cash_in" class="form-control" id="edit_cash_in">
                        <div class="edit_cash_inError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Cash out</label>
                        <input type="number" name="edit_cash_out" class="form-control" id="edit_cash_out">
                        <div class="edit_cash_outError text-danger errors d-none"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Remark</label>
                        <input type="text" name="edit_remark" class="form-control" id="edit_remark">
                        <div class="edit_remarkError text-danger errors d-none"></div>
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
