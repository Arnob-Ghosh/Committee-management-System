<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function () {
        // let table = new DataTable('#myTable');

        $('#myTable').DataTable( {
            responsive: true
        } );

        $("#thana_id").click(function () {
            let thana = $("#thana_id").val();
            // alert(thana);
            // Initiate Union Field Options
            $("#union_id").html();
            let option = "";

            $.get("/get-unions/" + thana, function ( data ) {
                data = JSON.parse( data );
                // console.log(data);
                data.forEach( function ( element ) {
                    option += "<option value='" + element.id + "'>" + element.name + "</option>";
                });
                $("#union_id").html( option );
            });
        });

        $("#union_id").click(function () {
            let union = $("#union_id").val();
            // alert(thana);
            // Initiate Union Field Options
            $("#village_id").html();
            let option = "";

            $.get("/get-villages/" + union, function ( data ) {
                data = JSON.parse( data );
                // console.log(data);
                data.forEach( function ( element ) {
                    option += "<option value='" + element.id + "'>" + element.name + "</option>";
                });
                $("#village_id").html( option );
            });
        });

        //Add data ajax request
        $(document).on('submit', '#add_bank_user_form', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('store.bankUser') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    // console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.nameError').text(res.errors.name);
                        $('.father_nameError').text(res.errors.father_name);
                        $('.mother_nameError').text(res.errors.mother_name);
                        $('.spouse_nameError').text(res.errors.spouse_name);
                        $('.birth_dateError').text(res.errors.birth_date);
                        $('.blood_groupError').text(res.errors.blood_group);
                        $('.nationalityError').text(res.errors.nationality);
                        $('.national_idError').text(res.errors.national_id);
                        $('.facebook_idError').text(res.errors.facebook_id);
                        $('.religionError').text(res.errors.religion);
                        $('.contactError').text(res.errors.contact);
                        $('.mobileError').text(res.errors.mobile);
                        $('.emailError').text(res.errors.email);
                        $('.imageError').text(res.errors.image);
                        $('.districtError').text(res.errors.district);
                        $('.thana_idError').text(res.errors.thana_id);
                        $('.union_idError').text(res.errors.union_id);
                        $('.village_idError').text(res.errors.village_id);
                        $('.post_officeError').text(res.errors.post_office);
                        $('.designation_idError').text(res.errors.designation_id);
                        $('.branchError').text(res.errors.branch);
                        $('.bank_nameError').text(res.errors.bank_name);
                        $('.sectionError').text(res.errors.section);
                        $('.present_addressError').text(res.errors.present_address);
                        $('.statusError').text(res.errors.status);
                    } else {
                        $('#add_bank_user_form')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $(location).attr('href','/bank-user/manage');
                        // $('.table').load(location.href+' .table');

                        Command: toastr["success"]("Added!", "Successfully")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        });

        // edit user ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            // alert(id);
            $.ajax({
                type: "GET",
                url: "{{ route('edit.bankUser') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    // console.log(res);
                    $("#member_id").val(res.member_id);
                    $("#name").val(res.name);
                    $("#father_name").val(res.father_name);
                    $("#mother_name").val(res.mother_name);
                    $("#spouse_name").val(res.spouse_name);
                    $("#birth_date").val(res.birth_date);
                    $("#blood_group").val(res.blood_group);
                    $("#nationality").val(res.nationality);
                    $("#national_id").val(res.nid);
                    $("#facebook_id").val(res.facebook_id);
                    $("#religion").val(res.religion);
                    $("#contact").val(res.contact);
                    $("#mobile").val(res.mobile);
                    $("#email").val(res.email);
                    $("#district").val(res.district);
                    $("#thana_id").val(res.thana_id);
                    // $("#union_id").val(res.union_id);
                    $("#union_id").append('<option value="'+res.union_id+'" selected>'+res.union_name+'</option>');
                    // $("#village_id").val(res.village_id);
                    $("#village_id").append('<option value="'+res.village_id+'" selected>'+res.village_name+'</option>');
                    $("#post_office").val(res.post_office);
                    $("#designation_id").val(res.designation_id);
                    $("#comitee_designation").val(res.comitee_designation);
                    $("#branch").val(res.branch);
                    $("#section").val(res.section);
                    $("#bank_name").val(res.bank_name);
                    $("#present_address").val(res.present_address);
                    $("#status").val(res.status);
                    $("#edit_image").html(
                        '<img src="{{ asset('images/user') }}/' + res.image + '" width="100" class="img-fluid img-thumbnail">'
                    );
                    $("#bankUser_id").val(res.id);
                    $("#bankUser_img").val(res.image);
                }
            });
        });

        //Update data ajax request
        $(document).on('submit', '#update_bank_user_form', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('update.bankUser') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.member_idError').text(res.errors.member_id);
                        $('.nameError').text(res.errors.name);
                        $('.father_nameError').text(res.errors.father_name);
                        $('.mother_nameError').text(res.errors.mother_name);
                        $('.spouse_nameError').text(res.errors.spouse_name);
                        $('.birth_dateError').text(res.errors.birth_date);
                        $('.blood_groupError').text(res.errors.blood_group);
                        $('.nationalityError').text(res.errors.nationality);
                        $('.national_idError').text(res.errors.national_id);
                        $('.facebook_idError').text(res.errors.facebook_id);
                        $('.religionError').text(res.errors.religion);
                        $('.contactError').text(res.errors.contact);
                        $('.mobileError').text(res.errors.mobile);
                        $('.emailError').text(res.errors.email);
                        $('.imageError').text(res.errors.image);
                        $('.districtError').text(res.errors.district);
                        $('.thana_idError').text(res.errors.thana_id);
                        $('.union_idError').text(res.errors.union_id);
                        $('.village_idError').text(res.errors.village_id);
                        $('.post_officeError').text(res.errors.post_office);
                        $('.designation_idError').text(res.errors.designation_id);
                        $('.comitee_designationError').text(res.errors.comitee_designation);
                        $('.branchError').text(res.errors.branch);
                        $('.bank_nameError').text(res.errors.bank_name);
                        $('.sectionError').text(res.errors.section);
                        $('.present_addressError').text(res.errors.present_address);
                        $('.statusError').text(res.errors.status);
                    } else {
                        $('#update_bank_user_form')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $("#editBankUserModal").modal('hide');
                        $(location).attr('href','/bank-user/manage');
                        // $('.table').load(location.href+' .table');

                        Command: toastr["success"]("Upadated!", "Successfully")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        });

        //Pending User Update data ajax request
        $(document).on('submit', '#pending_update_bank_user_form', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('pending.update.bankUser') }}",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    console.log(res);
                    if (res.status == 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');

                        $('.member_idError').text(res.errors.member_id);
                        $('.nameError').text(res.errors.name);
                        $('.father_nameError').text(res.errors.father_name);
                        $('.mother_nameError').text(res.errors.mother_name);
                        $('.spouse_nameError').text(res.errors.spouse_name);
                        $('.birth_dateError').text(res.errors.birth_date);
                        $('.blood_groupError').text(res.errors.blood_group);
                        $('.nationalityError').text(res.errors.nationality);
                        $('.national_idError').text(res.errors.national_id);
                        $('.facebook_idError').text(res.errors.facebook_id);
                        $('.religionError').text(res.errors.religion);
                        $('.contactError').text(res.errors.contact);
                        $('.mobileError').text(res.errors.mobile);
                        $('.emailError').text(res.errors.email);
                        $('.imageError').text(res.errors.image);
                        $('.districtError').text(res.errors.district);
                        $('.thana_idError').text(res.errors.thana_id);
                        $('.union_idError').text(res.errors.union_id);
                        $('.village_idError').text(res.errors.village_id);
                        $('.post_officeError').text(res.errors.post_office);
                        $('.designation_idError').text(res.errors.designation_id);
                        $('.comitee_designationError').text(res.errors.comitee_designation);
                        $('.branchError').text(res.errors.branch);
                        $('.bank_nameError').text(res.errors.bank_name);
                        $('.sectionError').text(res.errors.section);
                        $('.present_addressError').text(res.errors.present_address);
                        $('.statusError').text(res.errors.status);
                    } else {
                        $('#pending_update_bank_user_form')[0].reset();
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $("#editBankUserModal").modal('hide');
                        location.reload();
                        // $(location).attr('href','/bank-user/manage');
                        // $('.table').load(location.href+' .table');

                        Command: toastr["success"]("Upadated!", "Successfully")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        });

        // delete user ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            // let user_id     = $(this).data('id');
            let id = $(this).attr('id');

            if (confirm('Are you sure to delete this user ??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('destroy.bankUser') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status == 200) {
                            $('.table').load(location.href+' .table');

                            Command: toastr["error"]("Deleted!", "Successfully")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                        }
                    }
                });
            }
        });

    });
</script>
