$('select[name="brand_id"]').on('change', function () {

    var brand_id = $(this).val();

    $.ajax({
        url: "/get-smart-phone-model/ajax/" + brand_id,
        type: "GET",
        dataType: "json",
        success: function (response) {

            $('#model_id').empty();
			$('#model_id').append('<option value="" disabled selected> Select Model</option>');
			// <option value="option_select" disabled selected>Select District</option>

            $.each(response.data, function (key, item) {

                $('#model_id').append('<option value="' + item.id + '">' + item.model_name +'</option>');

            });
            $('.selectpicker').selectpicker('refresh');

        },
    });


});

function overviewImageAddToTable() {

    this.event.preventDefault();
    var brand_id =   $("#brand_id").find("option:selected").val();
    var brand_name =   $("#brand_id").find("option:selected").text();
    var model_id =   $("#model_id").find("option:selected").val();
    var model_name =   $("#model_id").find("option:selected").text();

    // var upper_image =   '<input type="file" class="form-control w-75" name="upper_image" id="upper_image" onchange="previewFile(this)>'
    // var preview_upper_image =   '<img id="preview_upper_image"  src="../images/no-image.jpg" alt="preview image" style="width:80px;height:30px;">'
    var upper_image      =  '<input type="file" class="form-control" id="upper_image" name="upper_image"></input>'
    var lower_image =  '<input type="file" class="form-control" id="lower_image" name="lower_image"></input>'



            $('#errorMsg').empty()
            $('#errorMsg1').empty()
            // if(model_id.length != 0 && colour_name.length != 0 && lower_image.length != 0 && back_image.length != 0  && over_view_image.length != 0){
            if(model_name.length != 0 && brand_name.length != 0 ){
                $('#specification_transfer_table_body').append('<tr>\
                   <td>'+brand_name+'</td>\
                    <td>'+model_name+'</td>\
                    <td>'+upper_image+'</td>\
                    <td>'+lower_image+'</td>\
                    <td class="hidden">'+brand_id+'</td>\
                    <td class="hidden">'+model_id+'</td>\
                    <td><button class="btn-remove" style="background: transparent;" value=""><i class="fas fa-minus-circle" style="color: red;"></i></button></td>\
                </tr>');
            }else{
                $('#add_btn').notify('Required all fields to add.', {className: 'error', position: 'bottom left'})
            }

}


$("#specification_transfer_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
})

function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#preview_upper_image").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


function overviewImageAddToServer() {

    this.event.preventDefault();

    let overviewImages = {};
    let overviewImageList = []

    if( $('#specification_transfer_table tr').length > 1){
        // alert('rowCount')
        $('#errorMsg').empty()
        $('#errorMsg1').empty()

        var overviewImageTable = $('#specification_transfer_table');

        $(overviewImageTable).find('> tbody > tr').each(function () {
            let overviewImage = {}

            var upper_image = $(this).find("td:eq(2) input[type='file']").val().split('\\').pop()
            var lower_image = $(this).find("td:eq(3) input[type='file']").val().split('\\').pop()


            overviewImage["brand_name"]       = $(this).find("td:eq(0)").text();
            overviewImage["model_name"]       = $(this).find("td:eq(1)").text();
            overviewImage["brand_id"]       = $(this).find("td:eq(4)").text();
            overviewImage["model_id"]       = $(this).find("td:eq(5)").text();
            overviewImage["upper_image"] = upper_image;
            overviewImage["lower_image"] = lower_image;



            overviewImageList.push(overviewImage);

        })

        overviewImages["overviewImageList"] = overviewImageList



        productTransfer(overviewImages)


    }else{
        $('#errorMsg1').text('Please add atleast one overviewImage to submit.')
    }
}


function productTransfer(jsonData){

    // alert('hytgfh')
    $.when(overviewImageImageStore()).done(function () {
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "/smart-phone/over-view-image-create",
                data: JSON.stringify(jsonData),
                dataType: "json",
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    alert('Variant inserted');

                    $.notify(response.message, { className: 'success', position: 'bottom right' });
                    $(location).attr("href", "/smart-phone/over-view-image-list");

                    resetButton()
                }

            });
        }, 10000);

    });
    // $.ajax({
    //     type: "POST",
    //     url: "/smart-phone/over-view-image-create",
    //     data: JSON.stringify(jsonData),
    //     dataType : "json",
    //     contentType: "application/json",
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     success: function (response) {

    //         $.notify(response.message, {className: 'success', position: 'bottom right'});
    //         // overviewImageImageStore();

    //         $(location).attr("href", "/smart-phone/over-view-image-list");

    //         resetButton()
    //     }

    // });
    // overviewImageImageStore()
}
function overviewImageImageStore(){


	var T = $('#specification_transfer_table');
	$(T).find('> tbody > tr').each(function (){

		var formData = new FormData();
        formData.append("model_id", $(this).find("td:eq(5)").text());
		formData.append("upper_image", $(this).find("td:eq(2) input[type='file']").get(0).files[0]);
        formData.append("lower_image", $(this).find("td:eq(3) input[type='file']").get(0).files[0]);


		$.ajax({
			type: "POST",
			url: "/smart-phone/overview-image-store",
			data: formData,
			contentType: false,
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response){
				if(response.status == 200){
                   alert(200)
				}
			}
		});
	})

}
// endworking code



$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var modelid = $(this).val();

    window.location.href = "/smart-phone/overviewImage-edit/" + modelid;
});

$(document).ready(function () {
    $('#overviewImage_table').on('click', '.delete_btn', function () {

        var overviewImageid = $(this).val();

        $('#overviewImageid').val(overviewImageid);

        $('#DELETEFoverviewImageFORM').attr('action', '/smart-phone/overviewImage-delete/' + overviewImageid);

        $('#DELETEFoverviewImageMODAL').modal('show');

    });
});






