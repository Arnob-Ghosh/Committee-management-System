$('.category_page').hide();
$('#main_page_div').hide();
$("#page_type").change(function () {
    var page_type = $(this).val();
    if (page_type == 'main_page') {
        $('#main_page_div').show();
        $('.category_page').hide();
        $('#specification_transfer_table_body').empty()
    }
    else {
        $('#main_page_div').hide();
        $('.category_page').show();
    }
});
$("#main_page_name").change(function () {
    var main_page_name = $(this).val();

});
$("#category_id").change(function () {
    var category_id = $(this).val();
    if (category_id == 777) {
        $.ajax({
            type: "GET",
            url: "/meta-get-all-news" ,
            dataType: "json",
            success: function (response) {

                $('#model_id').empty();
                $('#model_id').append('<option value="" disabled selected> Select News</option>');
                // <option value="option_select" disabled selected>Select District</option>

                $.each(response.data, function (key, item) {

                    $('#model_id').append('<option value="' + item.id + '">' + item.news_title + '</option>');

                });
                $('.selectpicker').selectpicker('refresh');
            }

        });
    }
    else if (category_id == 2) {

        $.ajax({
            type: "GET",
            url: "/meta-get-featurephone-model/" + category_id,
            dataType: "json",
            success: function (response) {

                $('#model_id').empty();
                $('#model_id').append('<option value="" disabled selected> Select Model</option>');
                // <option value="option_select" disabled selected>Select District</option>

                $.each(response.data, function (key, item) {

                    $('#model_id').append('<option value="' + item.model_id + '">' + item.model_name + '</option>');

                });
                $('.selectpicker').selectpicker('refresh');
            }

        });
    }
    else if (category_id == 1) {

        $.ajax({
            type: "GET",
            url: "/meta-get-smartphone-model/" + category_id,
            dataType: "json",
            success: function (response) {

                $('#model_id').empty();
                $('#model_id').append('<option value="" disabled selected> Select Model</option>');
                // <option value="option_select" disabled selected>Select District</option>

                $.each(response.data, function (key, item) {

                    $('#model_id').append('<option value="' + item.model_id + '">' + item.model_name + '</option>');

                });
                $('.selectpicker').selectpicker('refresh');
            }

        });
    }
    else if (category_id == 3) {

        $.ajax({
            type: "GET",
            url: "/meta-get-accessories-model/" + category_id,
            dataType: "json",
            success: function (response) {

                $('#model_id').empty();
                $('#model_id').append('<option value="" disabled selected> Select Product</option>');
                // <option value="option_select" disabled selected>Select District</option>

                $.each(response.data, function (key, item) {

                    $('#model_id').append('<option value="' + item.model_id + '">' + item.model_name + '</option>');

                });
                $('.selectpicker').selectpicker('refresh');
            }

        });
    }

    else {

        // $.ajax({
        //     type: "GET",
        //     url: "/meta-get-model/"+category_id,
        //     dataType: "json",
        //     success: function (response) {

        //         $.notify(response.message, { className: 'success', position: 'bottom right' });
        //         // specificationImageStore();

        //         $(location).attr("href", "/feature-phone/specification-list");

        //         resetButton()
        //     }

        // });
    }

});

function metaAddToTable() {

    this.event.preventDefault();
    var category_id = $("#category_id").find("option:selected").val();

    var category_id = $("#category_id").find("option:selected").val();
    var category_name = $("#category_id").find("option:selected").text();
    var model_id = $("#model_id").find("option:selected").val();
    var model_name = $("#model_id").find("option:selected").text();
    var main_page_name=$("#main_page_name").find("option:selected").text();
    var main_page_id=$("#main_page_name").find("option:selected").val();




    $('#errorMsg').empty()
    $('#errorMsg1').empty()
    // if(model_id.length != 0 && colour_name.length != 0 && front_image.length != 0 && back_image.length != 0  && over_view_image.length != 0){
    if (model_id.length != 0 || main_page_id.length != 0) {
        if(model_name==''){
            model_name='N/A'
        }
        if(category_name==''){
            category_name='N/A'
        }
        if(main_page_name==''){
            main_page_name='N/A'

        }

        $('#specification_transfer_table_body').append('<tr>\
                   <td>'+ category_name + '</td>\
                    <td>'+ model_name + '</td>\
                    <td>'+ main_page_name + '</td>\
                    <td>'+ '<input type="text" name="meta_title" class="form-control" id="meta_title">' + '</td>\
                    <td>'+ '  <textarea id="meta_description" class="form-control" name="meta_description" rows="4" ></textarea>' + '</td>\
                    <td class="hidden">'+ category_id + '</td>\
                    <td class="hidden">'+ model_id + '</td>\
                    <td class="hidden">'+ main_page_id + '</td>\
                    <td><button class="btn-remove" style="background: transparent;" value=""><i class="fas fa-minus-circle" style="color: red;"></i></button></td>\
                </tr>');
    } else {
        $('#add_btn').notify('Required all fields to add.', { className: 'error', position: 'bottom left' })
    }

}


$("#specification_transfer_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
})

function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $("#preview_colour_thumbnail").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


function specificationAddToServer() {

    this.event.preventDefault();

    let specifications = {};
    let specificationList = []

    if ($('#specification_transfer_table tr').length > 1) {
        // alert('rowCount')
        $('#errorMsg').empty()
        $('#errorMsg1').empty()

        var specificationTable = $('#specification_transfer_table');

        $(specificationTable).find('> tbody > tr').each(function () {
            let specification = {}

            var meta_title = $(this).find("td:eq(3) input[type='text']").val()
            var meta_description = $(this).find("textarea").val();
            // var back_image = $(this).find("td:eq(6) input[type='file']").val().split('\\').pop()
            // var over_view_image = $(this).find("td:eq(7) input[type='file']").val().split('\\').pop()
            // var over_view_image_large = $(this).find("td:eq(10) input[type='file']").val().split('\\').pop()

            specification["category_name"] = $(this).find("td:eq(0)").text();
            if( specification["category_name"]==''){
                specification["category_name"]="N/A"
            }

            if( specification["model_name"]==''){
                specification["model_name"]="N/A"
            }
            specification["model_name"] = $(this).find("td:eq(1)").text();
            specification["main_page_name"] = $(this).find("td:eq(2)").text();

            specification["category_id"] = $(this).find("td:eq(5)").text();
            specification["model_id"] = $(this).find("td:eq(6)").text();
            specification["main_page_id"] = $(this).find("td:eq(7)").text();
            specification["meta_title"] = meta_title;
            specification["meta_description"] = meta_description;
            // specification["over_view_image"] = over_view_image;
            // specification["over_view_image_large"] = over_view_image_large;


            specificationList.push(specification);

        })

        specifications["specificationList"] = specificationList



        productTransfer(specifications)


    } else {
        $('#errorMsg1').text('Please add atleast one specification to submit.')
    }
}

// function specificationImageStore() {


//     var T = $('#specification_transfer_table');
//     $(T).find('> tbody > tr').each(function () {

//         var formData = new FormData();
//         formData.append("model_id", $(this).find("td:eq(8)").text());
//         formData.append("colour_thumbnail", $(this).find("td:eq(3) input[type='file']").get(0).files[0]);
//         formData.append("front_image", $(this).find("td:eq(5) input[type='file']").get(0).files[0]);
//         formData.append("back_image", $(this).find("td:eq(6) input[type='file']").get(0).files[0]);
//         formData.append("over_view_image", $(this).find("td:eq(7) input[type='file']").get(0).files[0]);
//         formData.append("over_view_image_large", $(this).find("td:eq(10) input[type='file']").get(0).files[0]);

//         $.ajax({
//             type: "POST",
//             url: "/feature-phone/specification-image-store",
//             data: formData,
//             contentType: false,
//             processData: false,
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function (response) {
//                 if (response.status == 200) {

//                 }
//             }
//         });
//     })

// }
function productTransfer(jsonData) {

//    console.log(jsonData)

    $.ajax({
        type: "POST",
        url: "/meta-tag-add",
        data: JSON.stringify(jsonData),
        dataType: "json",
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            $.notify(response.message, { className: 'success', position: 'bottom right' });
            // specificationImageStore();

            $(location).attr("href", "/meta-tag-list");

            resetButton()
        }

    });
    // specificationImageStore()
}
// endworking code



$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/feature-phone/specification-edit/" + modelid;
});

$(document).ready(function () {
    $('#model_table').on('click', '.delete_btn', function () {

        var specificationid = $(this).val();

        $('#specificationid').val(specificationid);

        $('#DELETEFspecificationFORM').attr('action', '/meta-tag-delete/' + specificationid);

        $('#DELETEFspecificationMODAL').modal('show');

    });
});







