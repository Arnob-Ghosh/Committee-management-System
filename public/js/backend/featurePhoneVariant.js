
function variantAddToTable() {

    this.event.preventDefault();
    var brand_id =   $("#brand_id").find("option:selected").val();
    var brand_name =   $("#brand_id").find("option:selected").text();
    var model_id =   $("#model_id").find("option:selected").val();
    var model_name =   $("#model_id").find("option:selected").text();
    var colour_name =   $("#colour_name").val();
    // var colour_thumbnail =   '<input type="file" class="form-control w-75" name="colour_thumbnail" id="colour_thumbnail" onchange="previewFile(this)>'
    var preview_colour_thumbnail =   '<img id="preview_colour_thumbnail"  src="../images/no-image.jpg" alt="preview image" style="width:80px;height:30px;">'
    var front_image      =  '<input id="front_image" value="" name="front_image" type="file" class="form-control" data-browse-on-zone-click="true">'
    var back_image =   '<input id="back_image" value="" name="back_image" type="file" class="form-control" data-browse-on-zone-click="true">'
    var over_view_image =    '<input id="over_view_image" value="" name="over_view_image" type="file" class="form-control" data-browse-on-zone-click="true">'
    var over_view_image_large =    '<input id="over_view_image_large" value="" name="over_view_image_large" type="file" class="form-control" data-browse-on-zone-click="true">'


            $('#errorMsg').empty()
            $('#errorMsg1').empty()
            // if(model_id.length != 0 && colour_name.length != 0 && front_image.length != 0 && back_image.length != 0  && over_view_image.length != 0){
            if(model_id.length != 0 && colour_name.length != 0 ){
                $('#variant_transfer_table_body').append('<tr>\
                   <td>'+brand_name+'</td>\
                    <td>'+model_name+'</td>\
                    <td ">'+colour_name+'</td>\
                    <td>'+ '<input type="file" name="colour_thumbnail" class="form-control" id="colour_thumbnail" onchange="previewFile(this)">'+'</td>\
                    <td>'+preview_colour_thumbnail+'</td>\
                    <td>'+front_image+'</td>\
                    <td>'+back_image+'</td>\
                     <td class="hidden">'+over_view_image+'</td>\
                    <td class="hidden">'+model_id+'</td>\
                    <td class="hidden">'+brand_id+'</td>\
                    <td>'+over_view_image_large+'</td>\
                    <td><button class="btn-remove" style="background: transparent;" value=""><i class="fas fa-minus-circle" style="color: red;"></i></button></td>\
                </tr>');
            }else{
                $('#add_btn').notify('Required all fields to add.', {className: 'error', position: 'bottom left'})
            }

}


$("#variant_transfer_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
})

function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#preview_colour_thumbnail").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


function variantAddToServer() {

    this.event.preventDefault();

    let variants = {};
    let variantList = []

    if( $('#variant_transfer_table tr').length > 1){
        // alert('rowCount')
        $('#errorMsg').empty()
        $('#errorMsg1').empty()

        var variantTable = $('#variant_transfer_table');

        $(variantTable).find('> tbody > tr').each(function () {
            let variant = {}

            var colour_thumbnail = $(this).find("td:eq(3) input[type='file']").val().split('\\').pop()
            var front_image = $(this).find("td:eq(5) input[type='file']").val().split('\\').pop()
            var back_image = $(this).find("td:eq(6) input[type='file']").val().split('\\').pop()
            var over_view_image = $(this).find("td:eq(7) input[type='file']").val().split('\\').pop()
            var over_view_image_large = $(this).find("td:eq(10) input[type='file']").val().split('\\').pop()

            variant["brand_name"]       = $(this).find("td:eq(0)").text();
            variant["model_name"]       = $(this).find("td:eq(1)").text();
            variant["colour_name"]  = $(this).find("td:eq(2)").text();
            variant["model_id"]       = $(this).find("td:eq(8)").text();
            variant["brand_id"]       = $(this).find("td:eq(9)").text();
            variant["colour_thumbnail"] = colour_thumbnail;
            variant["front_image"] = front_image;
            variant["back_image"]  =back_image;
            variant["over_view_image"]  =over_view_image ;
            variant["over_view_image_large"]  =over_view_image_large ;


            variantList.push(variant);

        })

        variants["variantList"] = variantList



        productTransfer(variants)


    }else{
        $('#errorMsg1').text('Please add atleast one variant to submit.')
    }
}

function variantImageStore(){


	var T = $('#variant_transfer_table');
	$(T).find('> tbody > tr').each(function (){

		var formData = new FormData();
        formData.append("model_id", $(this).find("td:eq(8)").text());
		formData.append("colour_thumbnail", $(this).find("td:eq(3) input[type='file']").get(0).files[0]);
        formData.append("front_image", $(this).find("td:eq(5) input[type='file']").get(0).files[0]);
        formData.append("back_image", $(this).find("td:eq(6) input[type='file']").get(0).files[0]);
        // formData.append("over_view_image", $(this).find("td:eq(7) input[type='file']").get(0).files[0]);
        formData.append("over_view_image_large", $(this).find("td:eq(10) input[type='file']").get(0).files[0]);

		$.ajax({
			type: "POST",
			url: "/feature-phone/variant-image-store",
			data: formData,
			contentType: false,
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response){
				if(response.status == 200){

				}
			}
		});
	})

}
function productTransfer(jsonData){

    // alert('hytgfh')
    $.when(variantImageStore()).done(function () {
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "/feature-phone/variant-create",
                data: JSON.stringify(jsonData),
                dataType: "json",
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    alert('Variant inserted');

                    $.notify(response.message, { className: 'success', position: 'bottom right' });
                    $(location).attr("href", "/feature-phone/variant-list");

                    resetButton()
                }

            });
        }, 10000);

    });
    // $.ajax({
    //     type: "POST",
    //     url: "/feature-phone/variant-create",
    //     data: JSON.stringify(jsonData),
    //     dataType : "json",
    //     contentType: "application/json",
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     success: function (response) {

    //         $.notify(response.message, {className: 'success', position: 'bottom right'});
    //         // variantImageStore();

    //         $(location).attr("href", "/feature-phone/variant-list");

    //         resetButton()
    //     }

    // });
    // variantImageStore()
}
// endworking code



$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/feature-phone/variant-edit/" + modelid;
});

$(document).ready(function () {
    $('#variant_table').on('click', '.delete_btn', function () {

        var variantid = $(this).val();

        $('#variantid').val(variantid);

        $('#DELETEFvariantFORM').attr('action', '/feature-phone/variant-delete/' + variantid);

        $('#DELETEFvariantMODAL').modal('show');

    });
});






