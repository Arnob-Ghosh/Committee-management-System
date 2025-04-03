// function addVariant(){
// 	this.event.preventDefault();

// 	// var filename = $('input[type=file]').val().split('\\').pop();
// 	// var filename = $('#variantimage').val().split('\\').pop()

// 	var variantName			=	$("#variantname").val();
// 	var variantMeasurement	=	$("#measurement option:selected").val();
// 	var variantDescription  =   $("#variantdescription").val();
//     var variantimage  		=   '<input id="variantimage" value="" name="variantimage" type="file" class="form-control" data-browse-on-zone-click="true">'

//     if(variantName != ''){

//     	// if($('#variant_table tr > td:contains('+variantName+')').length == 0){
//     	// 	alert(1)
//     	// }else{
//     	// 	alert(0)
//     	// }

//     	if($('#variant_transfer_table tr > td:first-child:contains('+variantName+')').length == 0){
//     		$("#variant_transfer_table tbody").append(
// 			"<tr>" +
// 				"<td width='20%'>"+variantName+"</td>"+
// 				"<td width='20%'>"+variantMeasurement+"</td>"+
// 				"<td width='25%'>"+variantDescription+"</td>"+
// 				"<td width='25%'>"+variantimage+"</td>"+
// 				"<td width='10%'>"+
// 					"<button type='button' class='delete-btn btn btn-outline-danger btn-sm'><i class='fas fa-trash'></button>"+
// 				"</td>"+
// 			"</tr>");

// 			$("#measurement").selectpicker("refresh");
// 			$("#variantname").val("");
// 			// $("#variantimage").val("");
// 			$("#variantdescription").val("");
//     	}else{
//     		$.notify("Variant already added once!", {className: 'error', position: 'bottom right'});
//     	}





//     }else{
//     	$.notify("Please fill up all the required fields.", {className: 'error', position: 'bottom right'});
//     }
// }



// $("#variant_transfer_table").on('click', '.delete-btn', function () {
//     $(this).closest('tr').remove();
// });

//working code
function variantAddToTable() {

    this.event.preventDefault();

    var model_id =   $("#model_id").find("option:selected").val();
    var model_name =   $("#model_id").find("option:selected").text();
    var colour_name =   $("#colour_name").val();
    // var colour_thumbnail =   '<input type="file" class="form-control w-75" name="colour_thumbnail" id="colour_thumbnail" onchange="previewFile(this)>'
    var preview_colour_thumbnail =   '<img id="preview_colour_thumbnail"  src="../images/no-image.jpg" alt="preview image" style="width:80px;height:30px;">'
    var front_image      =  '<input id="front_image" value="" name="front_image" type="file" class="form-control" data-browse-on-zone-click="true">'
    var back_image =   '<input id="back_image" value="" name="back_image" type="file" class="form-control" data-browse-on-zone-click="true">'
    var over_view_image =    '<input id="over_view_image" value="" name="over_view_image" type="file" class="form-control" data-browse-on-zone-click="true">'



            $('#errorMsg').empty()
            $('#errorMsg1').empty()
            // if(model_id.length != 0 && colour_name.length != 0 && front_image.length != 0 && back_image.length != 0  && over_view_image.length != 0){
            if(model_id.length != 0 && colour_name.length != 0 ){
                $('#variant_transfer_table_body').append('<tr>\
                    <td>'+model_name+'</td>\
                    <td ">'+colour_name+'</td>\
                    <td>'+ '<input type="file" name="colour_thumbnail" class="form-control" id="colour_thumbnail" onchange="previewFile(this)">'+'</td>\
                    <td>'+preview_colour_thumbnail+'</td>\
                    <td>'+front_image+'</td>\
                    <td>'+back_image+'</td>\
                    <td>'+over_view_image+'</td>\
                    <td class="hidden">'+model_id+'</td>\
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

            var colour_thumbnail = $(this).find("td:eq(2) input[type='file']").val().split('\\').pop()
            var front_image = $(this).find("td:eq(4) input[type='file']").val().split('\\').pop()
            var back_image = $(this).find("td:eq(5) input[type='file']").val().split('\\').pop()
            var over_view_image = $(this).find("td:eq(6) input[type='file']").val().split('\\').pop()


            variant["model_name"]       = $(this).find("td:eq(0)").text();
            variant["colour_name"]  = $(this).find("td:eq(1)").text();
            variant["model_id"]       = $(this).find("td:eq(7)").text();
            variant["colour_thumbnail"] = colour_thumbnail;
            variant["front_image"] = front_image;
            variant["back_image"]  =back_image;
            variant["over_view_image"]  =over_view_image ;


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
        formData.append("model_id", $(this).find("td:eq(7)").text());
		formData.append("colour_thumbnail", $(this).find("td:eq(2) input[type='file']").get(0).files[0]);
        formData.append("front_image", $(this).find("td:eq(4) input[type='file']").get(0).files[0]);
        formData.append("back_image", $(this).find("td:eq(5) input[type='file']").get(0).files[0]);
        formData.append("over_view_image", $(this).find("td:eq(6) input[type='file']").get(0).files[0]);

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

    $.ajax({
        type: "POST",
        url: "/feature-phone/variant-create",
        data: JSON.stringify(jsonData),
        dataType : "json",
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            $.notify(response.message, {className: 'success', position: 'bottom right'});
            // variantImageStore();

            $(location).attr("href", "/feature-phone/variant-list");

            resetButton()
        }
        // success: function () {

        //     // $.notify(response.message, {className: 'success', position: 'bottom right'});
        //     // variantImageStore();

        //     $(location).attr("href", "/feature-phone/variant-list");

        //     resetButton()
        // }
    });
    variantImageStore()
}
// endworking code

// $(document).on('submit', '#AddVariantFrom', function (e) {
//     e.preventDefault();

//     let formData = new FormData($('#AddVariantFrom')[0]);
// console.log(formData)
//     $.ajax({
//         type: "POST",
//         url: "/feature-phone/variant-create",
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function (response) {
//             // console.log(response.message);

//             // if ($.isEmptyObject(response.error)) {

//                 $(location).attr('href', '/feature-phone/varient-list');

//             // } else {
//             //     // console.log(response.error)
//             //     printErrorMsg(response.error);
//             // }
//         }
//     });

// });

// $(document).on('submit', '#AddVariantFrom', function (e) {
//     e.preventDefault();

//     var employeedepartment_name = $("#employeedepartment").find("option:selected").text()
//     var salary_grade = $("#salarygrade").find("option:selected").text()


// //console.log('employeedepartment '+employeedepartment)

//     let formData = new FormData($('#AddVariantFrom')[0]);

//     formData.append('employeedepartment_name', employeedepartment_name);
//     formData.append('salary_grade', salary_grade);
//     let formData = new FormData($('#AddVariantFrom')[0]);
//     var T = $('#variant_table_data');
// 	$(T).find('> tbody > tr').each(function (){
//         formData.append("model_name",$(this).find("td:eq(0)").text());
//         formData.append("colour_name",$(this).find("td:eq(1)").text());
//         formData.append("model_id",$(this).find("td:eq(7)").text());
//     })


//     $.ajax({
//         type: "POST",
//         url: "/feature-phone/variant-create",
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function(response){
//             ////console.log(response.message);

//             if ($.isEmptyObject(response.error)) {
//                 $(location).attr('href','/employee-list');
//             } else {
//                 printErrorMsg(response.error);
//             }
//         }
//     });

// });



