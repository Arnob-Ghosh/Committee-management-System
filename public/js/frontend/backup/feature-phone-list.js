$('.item-hover-variant-image a').hover(

    function () {
        var id_str = $(this).attr('id');
        var id = id_str.replace('ab-', '');

        var image = $(this).find('img').attr('src')
        var first_image = image.replace('http://127.0.0.1:8000/uploads/product/featurephone/variant/', '');


        $.ajax({
            type: "GET",
            url: "get-variant-images/" + first_image,
            success: function (response) {
                if (response.status == 200) {

                    $.each(response.data, function (key, item) {

                        var front_image = '/' + item.front_image
                        var back_image = '/' + item.back_image

                      var record=  $('#record' + id).attr('src', back_image);
                      var  sleeve= $('#sleeve' + id).attr('src', front_image);
                      record.fadeIn(300);
                      sleeve.fadeIn(300);
                        // $("#record").fadeOut(500, function() {
                        //     $('#record' + id).attr('src', back_image);
                        //     $('#sleeve' + id).attr('src', front_image);
                        // }).fadeIn(500);
                    });


                }
            },
        });

    }

);


  $(document).on('click', '.checkbox', function() {
            // let displayList = {};
            let cameraList = new Array();
            let displayList = new Array();
            let batteryList = new Array();
            let networkList = new Array();

            $('input:checkbox[name=checkbox]:checked').each(function() {
               var id=  $(this).attr('id')
               var id_string= id.toString();
            //    alert('id '+id_string)
            var camera_check = id_string.indexOf("camera");
            var display_check = id_string.indexOf("size");
            var battery_check = id_string.indexOf("battery");
            var network_check = id_string.indexOf("network");
                if(camera_check !== -1){
                    camera_size= $(this).val();
                    // alert(id)
                    cameraList.push(camera_size);
                    // console.log(cameraList)
                }
                if(display_check !== -1){
                    display_size= $(this).val();
                    // alert(id)
                    // displayList.pop()
                    displayList.push(display_size);

                }
                if(battery_check !== -1){
                    battery_size= $(this).val();
                    // alert(id)
                    // displayList.pop()
                    batteryList.push(battery_size);

                }
                if(network_check !== -1){
                    network_parameter= $(this).val();
                    // alert(id)
                    // displayList.pop()
                    networkList.push(network_parameter);

                }


            });




            if (displayList.length == 0 && cameraList.length == 0  && batteryList.length == 0) {
                $('#product-loaded').show();
                $('#display-product-append').hide();

            } else {
                  submitToServer(cameraList,displayList,batteryList,networkList)

            }

        });

        function submitToServer(cameraList,displayList,batteryList,networkList) {
                 if(cameraList.length == 0 ){
                    cameraList=null;
                 }
                 if(displayList.length == 0 ){
                    displayList=null;
                 }
                 if(batteryList.length == 0 ){
                    batteryList=null;
                 }
                 if(networkList.length == 0 ){
                    networkList=null;
                 }


            $.ajax({
                type: "get",
                contentType: "application/json",
                url: "/feature-phone/get-device-by-display/" + cameraList+'/'+displayList+'/'+batteryList+'/'+networkList,
                // data: JSON.stringify(jsonData),
                dataType: "json",
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $('#product-loaded').hide();
                    $('#product-append').hide();
                    $('#brand-product-append').hide();
                    $('#display-product-append').show();
                    $('#display-product-append').empty();
                    // $('#brand-product-append').empty();
                    console.log(response.status);
                    var i = 1;
                    var j = 0;

                    var front_image;
                    var back_image;
                    var main_model_id;
                    var variant_model_id;


                    $.each(response.data, function(key, item) {
                        main_model_id = item.id;
                        console.log('main_model_id ' + main_model_id)

                        console.log("j ; " + j)
                        console.log(item.feature_phone[0].front_image)

                        $('#display-product-append').append('<div class="col-6 col-md-4 col-lg-4 ">\
                <div class="product product-7 text-center">\
                    <figure class="product-media">\
                        <a href="product.html" id="display-append-img-div-' + i + '" class="display-append-item-hover">\
                            <img src="' + item.feature_phone[0].back_image +
                            '" alt="Product image" class="record" id="display-append-record' + i + '" style=" position: relative;left: 40px; bottom: 0px;z-index: 1;">\
                            <img src="' + item.feature_phone[0].front_image +
                            '" alt="Product image" class="sleeve" id="display-append-sleeve' + i + '" style=" position: absolute;left: 0px;bottom: 0px;z-index: 1;">\
                        </a>\
                    </figure>\
                    <div class="product-body">\
                        <h2 class="product-title"><a href="product.html">' + item.model_name +
                            '</a></h2>\
                        <div class="product-nav product-nav-thumbs display-append-item-hover-variant-image" id="display-append-variant-image-' +
                            i + '">\
                        </div>\
                    </div>\
                </div>\
            </div>\
             ');
                        $.each(item.feature_phone, function(index, data) {

                            $('#display-append-variant-image-' + i + '').append(
                                '<a href="#" id="display-append-ab-' + i + '" class="append-active">\
                <img src="' + data.colour_thumbnail + '" alt="product desc" style="width: 40px;height:40px;">\
            </a>\
                ');
                        });
                        j++;
                        i++;

                    });


                }
            });
        }

        $(document).on('mouseover', '.display-append-item-hover-variant-image a', function() {

            var id_str = $(this).attr('id');
            var id = id_str.replace('display-append-ab-', '');

            var image = $(this).find('img').attr('src')
            var first_image = image.replace('uploads/product/featurephone/variant/', '');


            $.ajax({
                type: "GET",
                url: "get-variant-images/" + first_image,
                success: function(response) {
                    if (response.status == 200) {

                        $.each(response.data, function(key, item) {

                            var front_image = '/' + item.front_image
                            var back_image = '/' + item.back_image

                            var record=  $('#display-append-record' + id).attr('src', back_image);
                            var  sleeve= $('#display-append-sleeve' + id).attr('src', front_image);
                            record.fadeIn(300);
                            sleeve.fadeIn(300);
                            // $('#display-append-record' + id).attr('src', back_image);
                            // $('#display-append-sleeve' + id).attr('src', front_image);

                        });


                    }
                },
            });



        });

        $('.item-hover img:nth-of-type(2)').hover(

    function () {



        $(this).prev().animate({
            left: '+=70'
        }, 500);

    },

    function () {

        $(this).prev().animate({
            left: '-=70'
        }, 500);

    }

    //end Current

);

$(document).on('mouseover', '.display-append-item-hover img:nth-of-type(2)', function () {


$(this).prev().animate({
    left: '+=70'
}, 500);
});


$(document).on('mouseleave', '.display-append-item-hover img:nth-of-type(2)', function () {

$(this).prev().animate({
    left: '-=70'
}, 500);
});

$(document).on('click', '.brand-sort', function() {


var brand_id = $(this).data("value");
$.ajax({
    type: "get",
    url: "/feature-phone/get-device-by-brand/" + brand_id,
    contentType: false,
    processData: false,
    success: function (response) {
        $('#product-loaded').hide();
        $('#product-append').hide();
        $('#display-product-append').hide();
        $('#brand-product-append').show();
        $('#brand-product-append').empty();
        console.log(response.status);
       if(response.data == ''){
        $('#brand-product-append').append('<div class="col-6 col-md-4 col-lg-4 ">\
        <h3>No Product Found</h3>\
        </div>\
        ');

       }else{
        var i = 1;
        var j = 0;

        var front_image;
        var back_image;
        var   main_model_id;
        var   variant_model_id;


        $.each(response.data, function (key, item) {
            main_model_id=item.id;
             console.log('main_model_id '+main_model_id)

            console.log("j ; "+j)
            console.log(item.feature_phone[0].front_image)

            $('#brand-product-append').append('<div class="col-6 col-md-4 col-lg-4 ">\
    <div class="product product-7 text-center">\
        <figure class="product-media">\
            <a href="product.html" id="brand-append-img-div-' + i + '" class="brand-append-item-hover">\
                <img src="' + item.feature_phone[0].back_image + '" alt="Product image" class="record" id="brand-append-record' + i + '" style=" position: relative;left: 40px; bottom: 0px;z-index: 1;">\
                <img src="' + item.feature_phone[0].front_image + '" alt="Product image" class="sleeve" id="brand-append-sleeve' + i + '" style=" position: absolute;left: 0px;bottom: 0px;z-index: 1;">\
            </a>\
        </figure>\
        <div class="product-body">\
            <h2 class="product-title"><a href="product.html">' + item.model_name + '</a></h2>\
            <div class="product-nav product-nav-thumbs brand-append-item-hover-variant-image" id="brand-append-variant-image-' + i + '">\
            </div>\
        </div>\
    </div>\
</div>\
 ');
 $.each(item.feature_phone, function (index, data) {
    console.log('front_image '+data.feature_phone)
    console.log('\n')
    $('#brand-append-variant-image-' + i + '').append('<a href="#" id="brand-append-ab-' + i + '" class="append-active">\
    <img src="' + data.colour_thumbnail + '" alt="product desc" style="width: 40px;height:40px;">\
</a>\
    ');
});
 j++;
            i++;

        });


       }



    }
});
});
$(document).on('mouseover', '.brand-append-item-hover-variant-image a', function () {

    var id_str = $(this).attr('id');
    var id = id_str.replace('brand-append-ab-', '');

    var image = $(this).find('img').attr('src')
    var first_image = image.replace('uploads/product/featurephone/variant/', '');
    //  alert(first_image)

    $.ajax({
        type: "GET",
        url: "get-variant-images/" + first_image,
        success: function (response) {
            if (response.status == 200) {

                $.each(response.data, function (key, item) {

                    var front_image = '/' + item.front_image
                    var back_image = '/' + item.back_image

                    var record=  $('#brand-append-record' + id).attr('src', back_image);
                    var  sleeve= $('#brand-append-sleeve' + id).attr('src', front_image);
                    record.fadeIn(300);
                    sleeve.fadeIn(300);

                    // $('#brand-append-record' + id).attr('src', back_image);
                    // $('#brand-append-sleeve' + id).attr('src', front_image);

                });


            }
        },
    });



});

//brand append

$(document).on('mouseover', '.brand-append-item-hover img:nth-of-type(2)', function () {


$(this).prev().animate({
    left: '+=70'
}, 500);
});


$(document).on('mouseleave', '.brand-append-item-hover img:nth-of-type(2)', function () {

$(this).prev().animate({
    left: '-=70'
}, 500);
});


$(document).on('click', '.all-product', function() {

$('#product-loaded').show();
$('#product-append').hide();
$('#display-product-append').hide();
$('#brand-product-append').hide();
});
