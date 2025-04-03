
function specificationAddToTable() {
    tinyMCE.triggerSave();
    this.event.preventDefault();
    var brand_id =   $("#brand_id").find("option:selected").val();
    var brand_name =   $("#brand_id").find("option:selected").text();
    var model_id =   $("#model_id").find("option:selected").val();
    var model_name =   $("#model_id").find("option:selected").text();
    var specificationCategory_id =   $("#specificationCategory_name").val();
    var specificationCategory_name =   $("#specificationCategory_name").find("option:selected").text();
    var feature_name =   $("#feature_name").val();
    // var description=$('textarea#description').val();
     description =$('#description').val();
    // var model_specification = CKEDITOR.instances['model_specification'].getData();
    // var model_specification =  CKEDITOR.instances["model_specification"].getData();

    // var model_specification = $('textarea[name=model_specification]').html();


    // var colour_thumbnail =   '<input type="file" class="form-control w-75" name="colour_thumbnail" id="colour_thumbnail" onchange="previewFile(this)>'



            $('#errorMsg').empty()
            $('#errorMsg1').empty()
            // if(model_id.length != 0 && specificationCategory_name.length != 0 && front_image.length != 0 && back_image.length != 0  && over_view_image.length != 0){
            if(model_id.length != 0 && specificationCategory_id.length != 0 & brand_id.length != 0 ){
                $('#specification_transfer_table_body').append('<tr>\
                <td>'+brand_name+'</td>\
                <td>'+model_name+'</td>\
                <td ">'+specificationCategory_name+'</td>\
                <td>'+feature_name+'</td>\
                <td>'+description+'</td>\
                <td class="hidden">'+model_id+'</td>\
                <td class="hidden">'+brand_id+'</td>\
                <td class="hidden">'+specificationCategory_id+'</td>\
                <td><button class="btn-remove" style="background: transparent;" value=""><i class="fas fa-minus-circle" style="color: red;"></i></button></td>\
                </tr>');
            }else{
                $('#add_btn').notify('Required all fields to add.', {className: 'error', position: 'bottom left'})
            }

}


$("#specification_transfer_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
})

function specificationAddToServer() {

    this.event.preventDefault();

    let specifications = {};
    let specificationList = []

    if( $('#specification_transfer_table tr').length > 1){
        // alert('rowCount')
        $('#errorMsg').empty()
        $('#errorMsg1').empty()

        var specificationTable = $('#specification_transfer_table');

        $(specificationTable).find('> tbody > tr').each(function () {
            let specification = {}

            specification["model_id"]       = $(this).find("td:eq(5)").text();
            specification["brand_id"]       = $(this).find("td:eq(6)").text();

            specification["specificationCategory_name"]       = $(this).find("td:eq(2)").text();
            specification["category_id"]       = $(this).find("td:eq(7)").text();
            specification["feature_name"]  = $(this).find("td:eq(3)").text();
            // specification["description"]  = $(this).find("td:eq(4)").text();
            specification["description"]  = description;


            specificationList.push(specification);

        })

        specifications["specificationList"] = specificationList



        productTransfer(specifications)


    }else{
        $('#errorMsg1').text('Please add atleast one specification to submit.')
    }
}


function productTransfer(jsonData){

    // alert('hytgfh')

    $.ajax({
        type: "POST",
        url: "/smart-phone/specification-create",
        data: JSON.stringify(jsonData),
        dataType : "json",
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            $.notify(response.message, {className: 'success', position: 'bottom right'});
            // specificationImageStore();

            $(location).attr("href", "/smart-phone/specification-list");

            resetButton()
        }

    });
}
// endworking code



$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/smart-phone/specification-edit/" + modelid;
});

$(document).ready(function () {
    $('#specification_table').on('click', '.delete_btn', function () {

        var specificationid = $(this).val();

        $('#specificationid').val(specificationid);

        $('#DELETEFspecificationFORM').attr('action', '/smart-phone/specification-delete/' + specificationid);

        $('#DELETEFspecificationMODAL').modal('show');

    });
});






