$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //CREATE smart-Phone
    $(document).on('submit', '#AddFmodelForm', function (e) {
        e.preventDefault();

        let formData = new FormData($('#AddFmodelForm')[0]);

        $.ajax({
            type: "POST",
            url: "/smart-phone/model-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {

                    $(location).attr('href', '/smart-phone/model-list');

                } else {
                    console.log(response.error)
                    printErrorMsg(response.error);
                }
            }
        });

    });

    $(document).on('submit', '#EditFmodelForm', function (e) {
        e.preventDefault();
        model_id=$('#model_id').val();

        let formData = new FormData($('#EditFmodelForm')[0]);

        $.ajax({
            type: "POST",
            url: "/smart-phone/model-edit/"+ model_id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {

                    $(location).attr('href', '/smart-phone/model-list');

                } else {
                    // console.log(response.error)
                    printErrorMsg(response.error);
                }
            }
        });

    });

    function printErrorMsg(message) {

        $('#wrongmodel_name').empty();
        $('#wrongbrand_id').empty();
        $('#wrongproduct_id').empty();
        $('#wrongnum_colour').empty();
        $('#wrongdisplay_size').empty();
        $('#wrongbattery').empty();
        $('#wrongcamera').empty();

        // $('#info_model_specification').hide();
        $('#wrongmodel_specification').show();
        $('#wrongmodel_specification').empty();
        $('#wrongin_box_image').empty();
        $('#wrongnetwork_parameter').empty();
        $('#wrong_os').empty();
        $('#wrong_memory').empty();
        $('#wrong_processor').empty();
        $('#wrong_default_image').empty();

        if (message.model_name == null) {
            model_name = ""
        } else {
            model_name = message.model_name[0]
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

        if (message.num_colour == null) {
            num_colour = ""
        } else {
            num_colour = message.num_colour[0]
        }

        if (message.display_size == null) {
            display_size = ""
        } else {
            display_size = message.display_size[0]
        }
        if (message.battery == null) {
            battery = ""
        } else {
            battery = message.battery[0]
        }
        if (message.camera == null) {
            camera = ""
        } else {
            camera = message.camera[0]
        }
        if (message.file == null) {
            file = ""
        } else {
            file = message.file[0]
        }

        if (message.network_parameter == null) {
            network_parameter = ""
        } else {
            network_parameter = message.network_parameter[0]
        }

        if (message.processor == null) {
            processor = ""
        } else {
            processor = message.processor[0]
        }
        if (message.memory == null) {
            memory = ""
        } else {
            memory = message.memory[0]
        }
        if (message.os == null) {
            os = ""
        } else {
            os = message.os[0]
        }
        if (message.in_box_image == null) {
            in_box_image = ""
        } else {
            in_box_image = message.in_box_image[0]
        }
        if (message.default_image == null) {
            default_image = ""
        } else {
            default_image = message.default_image[0]
        }
        $('#wrongbrand_id').append('<span id="">' + brand_id + '</span>');
        $('#wrongmodel_name').append('<span id="">' + model_name + '</span>');
        $('#wrongproduct_id').append('<span id="">' + product_id + '</span>');
        $('#wrongnum_colour').append('<span id="">' + num_colour + '</span>');
        $('#wrongdisplay_size').append('<span id="">' + display_size + '</span>');
        $('#wrongbattery').append('<span id="">' + battery + '</span>');
        $('#wrongcamera').append('<span id="">' + camera + '</span>');
        $('#wrongmodel_specification').append('<span id="">' + file + '</span>');
        $('#wrongnetwork_parameter').append('<span id="">' + network_parameter + '</span>');
        $('#wrong_processor').append('<span id="">' + processor + '</span>');
        $('#wrong_memory').append('<span id="">' + memory + '</span>');
        $('#wrong_os').append('<span id="">' + os + '</span>');
        $('#wrongin_box_image').append('<span id="">' + in_box_image + '</span>');
        $('#wrong_default_image').append('<span id="">' + default_image + '</span>');

        // });
    }


})

$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/smart-phone/model-edit/" + modelid;
});

$(document).ready(function () {
    $('#model_table').on('click', '.delete_btn', function () {

        var modelid = $(this).val();

        $('#modelid').val(modelid);

        $('#DELETEFmodelFORM').attr('action', '/smart-phone/model-delete/' + modelid);

        $('#DELETEFmodelMODAL').modal('show');

    });
});


