$(document).on('click', '.checkbox', function () {

    let categoryList = new Array();

    $('input:checkbox[name=checkbox]:checked').each(function () {
        var id = $(this).attr('id')
        var id_string = id.toString();
        //    alert('id '+id_string)
        var category_check = id_string.indexOf("category");

        if (category_check !== -1) {
            category_size = $(this).val();
            // alert(id)
            categoryList.push(category_size);

        }

    });

    if (categoryList.length == 0) {
        $('#product-loaded').show();
        $('#category-product-append').hide();

    } else {
        submitToServer(categoryList)

    }

});

function submitToServer(cameraList) {


    $.ajax({

        type: "get",
        contentType: "application/json",
        url: "/accessories/get-product-by-category/" + cameraList,
        dataType: "json",
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            $('#product-loaded').hide();
            $('#product-append').hide();
            $('#brand-product-append').hide();
            $('#category-product-append').show();
            $('#category-product-append').empty();

            $.each(response.data, function (key, item) {
                $.each(item.accesory, function (index, data) {
                    $('#category-product-append').append('<div class="col-6 col-md-4 col-xl-4">\
                        <div class="product">\
                            <figure class="product-media">\
                                <a href="/accessories-view/'+ data.id + '">\
                                    <img src="'+ data.default_image + '" alt="Product image" class="product-image">\
                                </a>\
                            </figure>\
                            <div class="product-body " style="text-align: center!important">\
                                <div class="product-cat">\
                                    <a href="/accessories-view/'+ data.id + '">' + item.category_name + '</a>\
                                </div>\
                                <h1 class="product-title" style="font-weight: 600;font-size: 1.1em; margin-bottom:5px;color:black"><a href="/accessories-view/'+ data.id + '" >' + data.product_name + '</a></h1>\
                            </div>\
                        </div>\
                    </div>\
     ');
                })
            })
        }
    });
}

$(document).on('click', '.brand-sort', function () {


    var brand_id = $(this).data("value");
    $.ajax({
        type: "get",
        url: "/accessories-get-product-by-brand/" + brand_id,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#product-loaded').hide();
            $('#product-append').hide();
            $('#category-product-append').hide();
            $('#brand-product-append').show();
            $('#brand-product-append').empty();
            if (response.data == '') {
                $('#brand-product-append').append('<div class="col-6 col-md-4 col-lg-4 ">\
            <h3>No Product Found</h3>\
            </div>\
            ');

            } else {

                $.each(response.data, function (key, item) {

                        $('#brand-product-append').append('<div class="col-6 col-md-4 col-xl-4">\
                            <div class="product">\
                                <figure class="product-media">\
                                    <a href="/accessories-view/'+ item.id + '">\
                                        <img src="'+ item.default_image + '" alt="Product image" class="product-image">\
                                    </a>\
                                </figure>\
                                <div class="product-body " style="text-align: center!important">\
                                    <div class="product-cat">\
                                        <a href="/accessories-view/'+ item.id + '">' + item.category.category_name + '</a>\
                                    </div>\
                                    <h1 class="product-title" style="font-weight: 600;font-size: 1.1em; margin-bottom:5px;color:black"><a href="/accessories-view/'+ item.id + '" >' + item.product_name + '</a></h1>\
                                </div>\
                            </div>\
                        </div>\
         ');

                })

            }



        }
    });
});


$(document).on('click', '.all-product', function() {

    $('#product-loaded').show();
    $('#product-append').hide();
    $('#category-product-append').hide();
    $('#brand-product-append').hide();
    });
