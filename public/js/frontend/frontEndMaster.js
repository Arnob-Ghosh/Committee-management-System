$('#smart-phone-div').hide()
$("#smart_phn_btn").click(function () {
    $('#smart-phone-div').show('normal')
    $('#feature-phone-div').hide('slow')
    $('#accessories-phone-div').hide('slow')

    $('#smart-phone-product').empty();
    $('#smart_view_more').empty();
    $.ajax({
        type: "get",
        url: "/get-smart-phone-home-product",
        contentType: false,
        processData: false,
        success: function (response) {

            console.log(response.status);
            if (response.data == '') {
                $('#smart-phone-product').append(' <div class="col-md-3">\
    <h6>No Prouducts</h6>\
</div>\
');

            } else {

                $.each(response.data, function (key, item) {


                    $('#smart-phone-product').append('<div class="col-md-3">\
    <a href="/smart-phone-view/'+ item.id + '">\
        <img src="/' + item.default_image + '" alt="..." class="img-fluid img-thumbnail" style="border-radius: 10px ;">\
        <h6 class="text-center mt-2 mb-2">\
            ' + item.model_name + '\
        </h6>\
    </a>\
</div>\
');
                });

                $('#smart_view_more').append('\
<a style="border-radius: 10px;" href="/smart-phone" class="btn btn-outline-primary-2"><span>View All </span><i class="icon-long-arrow-right"></i></a>\
');


            }

        }
    });
});

$("#feature_phn_btn").click(function () {
    $('#smart-phone-div').hide('slow')
    $('#accessories-phone-div').hide('slow')
    $('#feature-phone-div').show('normal')

});
$("#view_all_feature_phone").click(function () {
    window.location.href = '/feature-phone';

});

$("#accessories_btn").click(function () {
    $('#smart-phone-div').hide('slow')
    $('#feature-phone-div').hide('slow')
    $('#accessories-phone-div').show('normal')

    $('#accessories-product').empty();
    $('#accessories_view_more').empty();

    //     $('#accessories-product').append('<div class="col-md-8" style="margin-left:15%;margin-right:10%;">\
    //     <a href="index-1.html">\
    //         <img src="/uploads/comingsoon.jpg" alt="..." class="img-fluid img-thumbnail" style="border-radius: 10px ;">\
    //         <h6 class="text-center mt-2 mb-2">\
    //             coming Soon\
    //         </h6>\
    //     </a>\
    // </div>\
    // ');

    $.ajax({
        type: "get",
        url: "/get-accessories-home-product",
        contentType: false,
        processData: false,
        success: function (response) {

            console.log(response.status);
            if (response.data == '') {
                $('#accessories-product').append(' <div class="col-md-3">\
<h6>No Prouducts</h6>\
</div>\
');

            } else {

                $.each(response.data, function (key, item) {


                    $('#accessories-product').append('<div class="col-md-3">\
<a  href="/accessories-view/'+ item.id + '">\
    <img src="/' + item.default_image + '" alt="..." class="img-fluid img-thumbnail" style="border-radius: 10px ;">\
    <h6 class="text-center mt-2 mb-2">\
        ' + item.product_name + '\
    </h6>\
</a>\
</div>\
');
                });

                $('#accessories_view_more').append('\
<a style="border-radius: 10px;" href="/accessories" class="btn btn-outline-primary-2"><span>View All </span><i class="icon-long-arrow-right"></i></a>\
');


            }

        }
    });

});
