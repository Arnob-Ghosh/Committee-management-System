 <!-- Modal -->
 <div class="modal fade" id="editJobSeekerModal{{ $jobSeeker->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('update.jobSeeker') }}" method="POST" id="" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Job Seeker Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="jobSeeker_id" id="jobSeeker_id" value="{{ $jobSeeker->id }}">
                    {{-- <input type="hidden" name="bankUser_img" id="bankUser_img"> --}}

                    <div class="row">

                        <div class="col-lg-4">
                            <div class="">
                                <label for="">Active Status</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="status" id="status" >
                                    <option disabled selected>Please Select the Status</option>
                                    <option value="Processing" @if ( $jobSeeker->status == 'Processing') selected @endif >Processing</option>
                                    {{-- <option value="0" @if ( $jobSeeker->status == 0) selected @endif >Inactive</option> --}}
                                    <option value="Pending" @if ( $jobSeeker->status == 'Pending') selected @endif >Pending</option>
                                </select>
                                <div class="statusError text-danger errors d-none"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="">
                                {{-- <label for="">Comment</label> --}}
                                <textarea name="comment" id="comment" cols="100" rows="5" placeholder="Comment here..">{{ $jobSeeker->comment }}</textarea>
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
