$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //CREATE Feature-Phone
    $(document).on('submit', '#AddAccessoriesForm', function (e) {
        e.preventDefault();

        let formData = new FormData($('#AddAccessoriesForm')[0]);

        $.ajax({
            type: "POST",
            url: "/accessories-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {
                    $.notify(response.message, 'success')

                    setTimeout(function(){
                        $(location).attr('href', '/accessories-list');
                    },500)


                } else {
                    // console.log(response.error)
                    printErrorMsg(response.error);
                }
            }
        });

    });

    $(document).on('submit', '#EditAccessoriesForm', function (e) {
        e.preventDefault();
        accessories_id=$('#accessories_id').val();

        let formData = new FormData($('#EditAccessoriesForm')[0]);

        $.ajax({
            type: "POST",
            url: "/accessories-edit/"+ accessories_id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {
                    $.notify(response.message, 'success')

                    setTimeout(function(){
                        $(location).attr('href', '/accessories-list');
                    },500)


                } else {
                    // console.log(response.error)
                    printErrorMsg(response.error);
                }
            }
        });

    });

    function printErrorMsg(message) {

        $('#wrongcategory_id').empty();
        $('#wrongbrand_id').empty();
        $('#wrongproduct_id').empty();
        $('#wrongproduct_image').empty();
        $('#wronghighlighted_spec').empty();
        $('#wrong_description').empty();
        $('#wrongproduct_name').empty();
        $('#wrong_status').empty();

        if (message.product_name == null) {
            product_name = ""
        } else {
            product_name = message.product_name[0]
        }
        if (message.category_id == null) {
            category_id = ""
        } else {
            category_id = message.category_id[0]
        }
        if (message.brand_id == null) {
            brand_id = ""
        } else {
            brand_id = message.brand_id[0]
        }

        if (message.product_id == null) {
            product_id = ""
        } else {
            product_id = message.product_id[0]
        }

        if (message.product_image == null) {
            product_image = ""
        } else {
            product_image = message.product_image[0]
        }

        if (message.highlighted_spec == null) {
            highlighted_spec = ""
        } else {
            highlighted_spec = message.highlighted_spec[0]
        }
        if (message.description == null) {
            description = ""
        } else {
            description = message.description[0]
        }
        if (message.status == null) {
            status = ""
        } else {
            status = message.status[0]
        }

        $('#wrongbrand_id').append('<span id="">' + brand_id + '</span>');
        $('#wrongcategory_id').append('<span id="">' + category_id + '</span>');
        $('#wrongproduct_id').append('<span id="">' + product_id + '</span>');
        $('#wrongproduct_image').append('<span id="">' + product_image + '</span>');
        $('#wronghighlighted_spec').append('<span id="">' + highlighted_spec + '</span>');
        $('#wrong_description').append('<span id="">' + description + '</span>');
        $('#wrongproduct_name').append('<span id="">' + product_name + '</span>');
        $('#wrong_status').append('<span id="">' + status + '</span>');


    }


})

$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/accessories-edit/" + modelid;
});

$(document).ready(function () {
    $('#model_table').on('click', '.delete_btn', function () {

        var modelid = $(this).val();

        $('#modelid').val(modelid);

        $('#DELETEAccessoriesFORM').attr('action', '/accessories-delete/' + modelid);

        $('#DELETEAccessoriesMODAL').modal('show');

    });
});


