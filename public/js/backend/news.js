fetchNews();
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //CREATE CATEGORY
    $(document).on("submit", "#AddNewsForm", function (e) {
        e.preventDefault();

        let formData = new FormData($("#AddNewsForm")[0]);

        $.ajax({
            type: "POST",
            url: "/collection-add",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.error);

                if ($.isEmptyObject(response.error)) {
                    $(location).attr("href", "/collection-list");
                } else {
                    // console.log(response.error)
                    printErrorMsg(response.error);
                }
            },
        });
    });

    function printErrorMsg(message) {
        $("#wrongnewstitle").empty();
        $("#wrongnews_image").empty();
        $("#wrongnews_thumbnail").empty();
        $("#wrongnews_description").empty();
        $("#wrongnews_category").empty();

        if (message.news_title == null) {
            news_title = "";
        } else {
            news_title = message.news_title[0];
        }
        if (message.news_image == null) {
            news_image = "";
        } else {
            news_image = message.news_image[0];
        }

        if (message.news_description == null) {
            news_description = "";
        } else {
            news_description = message.news_description[0];
        }
        if (message.news_category == null) {
            news_category = "";
        } else {
            news_category = message.news_category[0];
        }

        if (message.news_thumbnail == null) {
            news_thumbnail = "";
        } else {
            news_thumbnail = message.news_thumbnail[0];
        }


        $("#wrongnewstitle").append(
            '<span id="">' + news_title + "</span>"
        );
        $("#wrongnews_image").append(
            '<span id="">' + news_image + "</span>"
        );
        $("#wrongnews_description").append(
            '<span id="">' + news_description + "</span>"
        );
        $("#wrongnews_category").append(
            '<span id="">' + news_category + "</span>"
        );
        $("#wrongnews_thumbnail").append(
            '<span id="">' + news_thumbnail + "</span>"
        );

    }
});
//CATEGORY LIST


function fetchNews() {
    $.ajax({
        type: "GET",
        url: "/news-list-data",
        dataType: "json",
        success: function(response) {
            $("tbody").html("");
            var serialNumber = 1;
            $.each(response.news, function(key, item) {
                var row = "<tr>" +
                    "<td>"+serialNumber+"</td>" +
                    "<td>" + item.news_title + "</td>" +
                    "<td>" + item.news_category + "</td>" +
                    "<td><img src='" + item.news_thumbnail + "' width='100px' height='100px' alt='image' class='rounded'></td>" +
                    "<td><img src='" + item.news_image + "' width='100px' height='100px' alt='image' class='rounded'></td>" +
                    "<td>" +
                    "<button type='button' value='" + item.id + "' class='edit_btn btn btn-secondary btn-sm'><i class='fas fa-edit'></i></button>" +
                    "<a href='javascript:void(0)' class='delete_btn btn btn-outline-danger btn-sm' data-value='" + item.id + "'><i class='fas fa-trash'></i></a>" +
                    "</td>" +
                    "</tr>";
                $("tbody").append(row);
                serialNumber++;
            });
        },
    });
}

//EDIT CATEGORY
$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var newsId = $(this).val();

    window.location.href = '/collection-edit/'+ newsId;

    // alert(newsId);


    // $.ajax({
    //     type: "GET",
    //     url: "/news-edit/" + newsId,
    //     success: function (response) {
    //         if (response.status == 200) {
    //             console.log("sxs " + response.news.news_image);
    //             $("#edit_newsname").val(response.news.news_name);
    //             $("#newsid").val(newsId);
    //             $("#old_newsimage").val(response.news.news_image);
    //             $("#edit_newsimage_view").attr(
    //                 "src",
    //                 "/" + response.news.news_image
    //             );
    //             // $("#edit_newsimage").attr(
    //             //     "src",
    //             //     response.news.news_image
    //             // );
    //         }
    //     },
    // });
});

//UPDATE CATEGORY
$(document).on("submit", "#UPDATENewsForm", function (e) {
    e.preventDefault();

    var id = $("#news_id").val();

    let EditFormData = new FormData($("#UPDATENewsForm")[0]);
  // console.log(EditFormData);

    EditFormData.append("_method", "PUT");

    $.ajax({
        type: "POST",
        url: "/collection-edit/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function (response) {
           // console.log(EditFormData);
            if ($.isEmptyObject(response.error)) {
                // alert(response.message);
                // $("#EDITCategoryMODAL").modal("hide");
                $.notify(response.message, 'success')
                $(location).attr("href", "/collection-list");
            } else {
                // console.log(response.error)
                // printErrorMsg(response.error);
                $("#wrongnewstitle").empty();

                $("#wrongnews_description").empty();

                if (message.news_title == null) {
                    news_title = "";
                } else {
                    news_title = message.news_title[0];
                }
                if (message.news_category == null) {
                    news_title = "";
                } else {
                    news_category = message.news_category[0];
                }
                if (message.news_description == null) {
                    news_description = "";
                } else {
                    news_description = message.news_description[0];
                }
                if (message.accession_number == null) {
                    news_description = "";
                } else {
                    accession_number = message.accession_number[0];
                }

                if (message.highlight == null) {
                    highlight = "";
                } else {
                    highlight = message.highlight[0];
                }


                $("#wrongnewstitle").append(
                    '<span id="">' + news_title + "</span>"
                );

                $("#wrongnews_description").append(
                    '<span id="">' + news_description + "</span>"
                );
            }
        },
    });
});

//DELETE CATEGORY
$(document).ready(function () {
    $("#news_table").on("click", ".delete_btn", function () {
        var newsId = $(this).data("value");

        $("#newsid").val(newsId);

        $("#DELETENewsFORM").attr(
            "action",
            "/news-delete/" + newsId
        );

        $("#DELETENewsMODAL").modal("show");
    });
});

//DATA TABLE
$(document).ready(function () {
    $("#news_table").DataTable({
        pageLength: 10,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, "Todos"],
        ],
        fnRowCallback: function (
            nRow,
            aData,
            iDisplayIndex,
            iDisplayIndexFull
        ){
            //debugger;
            var index = iDisplayIndexFull + 1;

            return nRow;
        },
    });
});
