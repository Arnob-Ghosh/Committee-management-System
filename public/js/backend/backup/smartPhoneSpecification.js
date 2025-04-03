
function variantAddToTable() {

    this.event.preventDefault();
    var brand_id =   $("#brand_id").find("option:selected").val();
    var brand_name =   $("#brand_id").find("option:selected").text();
    var model_id =   $("#model_id").find("option:selected").val();
    var model_name =   $("#model_id").find("option:selected").text();
    var specificationCategory_id =   $("#specificationCategory_name").val();
    var specificationCategory_name =   $("#specificationCategory_name").find("option:selected").text();
    // var model_specification=$('textarea#editor2').val();
    var model_specification = $('textarea[name=model_specification]').val();
    alert(1)
    // var model_specification = $("#editor2").val();
    console.log('model_specification '+model_specification)
    // var colour_thumbnail =   '<input type="file" class="form-control w-75" name="colour_thumbnail" id="colour_thumbnail" onchange="previewFile(this)>'



            $('#errorMsg').empty()
            $('#errorMsg1').empty()
            // if(model_id.length != 0 && specificationCategory_name.length != 0 && front_image.length != 0 && back_image.length != 0  && over_view_image.length != 0){
            if(model_id.length != 0 && specificationCategory_id.length != 0 & brand_id.length != 0 ){
                $('#variant_transfer_table_body').append('<tr>\
                   <td>'+brand_name+'</td>\
                    <td>'+model_name+'</td>\
                    <td ">'+specificationCategory_name+'</td>\
                    <td>'+model_specification+'</td>\
                    <td class="hidden">'+model_id+'</td>\
                    <td class="hidden">'+brand_id+'</td>\
                    <td class="hidden">'+specificationCategory_id+'</td>\
                    <td><button class="btn-remove" style="background: transparent;" value=""><i class="fas fa-minus-circle" style="color: red;"></i></button></td>\
                </tr>');
            }else{
                $('#add_btn').notify('Required all fields to add.', {className: 'error', position: 'bottom left'})
            }

}


$("#variant_transfer_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
})

// function variantAddToServer() {

//     this.event.preventDefault();

//     let variants = {};
//     let variantList = []

//     if( $('#variant_transfer_table tr').length > 1){
//         // alert('rowCount')
//         $('#errorMsg').empty()
//         $('#errorMsg1').empty()

//         var variantTable = $('#variant_transfer_table');

//         $(variantTable).find('> tbody > tr').each(function () {
//             let variant = {}
//             variant["model_id"]       = $(this).find("td:eq(4)").text();
//             variant["brand_id"]       = $(this).find("td:eq(5)").text();
//             variant["specificationCategory_name"]  = $(this).find("td:eq(2)").text();
//             variant["model_specification"]       = $(this).find("td:eq(3)").text();


//             variantList.push(variant);

//         })

//         variants["variantList"] = variantList



//         productTransfer(variants)


//     }else{
//         $('#errorMsg1').text('Please add atleast one variant to submit.')
//     }
// }


// function productTransfer(jsonData){

//     // alert('hytgfh')

//     $.ajax({
//         type: "POST",
//         url: "/smart-phone/variant-create",
//         data: JSON.stringify(jsonData),
//         dataType : "json",
//         contentType: "application/json",
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function (response) {

//             $.notify(response.message, {className: 'success', position: 'bottom right'});
//             // variantImageStore();

//             $(location).attr("href", "/smart-phone/variant-list");

//             resetButton()
//         }

//     });
// }
// endworking code



$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/smart-phone/variant-edit/" + modelid;
});

$(document).ready(function () {
    $('#variant_table').on('click', '.delete_btn', function () {

        var variantid = $(this).val();

        $('#variantid').val(variantid);

        $('#DELETEFvariantFORM').attr('action', '/smart-phone/variant-delete/' + variantid);

        $('#DELETEFvariantMODAL').modal('show');

    });
});






