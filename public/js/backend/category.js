$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //CREATE CATEGORY
    $(document).on("submit", "#AddCategoryForm", function (e) {
        e.preventDefault();

        let formData = new FormData($("#AddCategoryForm")[0]);

        $.ajax({
            type: "POST",
            url: "/category-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {
                    $(location).attr("href", "/category-list");
                } else {
                    // console.log(response.error)
                    printErrorMsg(response.error);
                }
            },
        });
    });

    function printErrorMsg(message) {
        // $(".print-error-msg").find("ul").html('');
        // $(".print-error-msg").css('display','block');

        // $.each( message, function( key, item ) {
        // $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        $("#wrongcategoryname").empty();

        if (message.categoryname == null) {
            categoryname = "";
        } else {
            categoryname = message.categoryname[0];
        }

        $("#wrongcategoryname").append(
            '<span id="">' + categoryname + "</span>"
        );
    }
});
//CATEGORY LIST
fetchCategory();
function fetchCategory() {
    $.ajax({
        type: "GET",
        url: "/category-list-data",
        dataType: "json",
        success: function (response) {
            $("tbody").html("");
            $.each(response.category, function (key, item) {
                $("tbody").append(
                    "<tr>\
					<td></td>\
					<td>" +
                        item.category_name +
                        '</td>\
						<td><img src="' +
                        item.category_image +
                        '" width="100px" height="100px" alt="image" class="rounded-circle"></td>\
                        <td><img src="' +
                        item.title_image +
                        '" width="100px" height="100px" alt="image" class="rounded-circle"></td>\
                        <td>\
        				<button type="button" value="' +
                        item.id +
                        '" class="edit_btn btn btn-secondary btn-sm"><i class="fas fa-edit"></i>\
                    	</button>\
                    	<a href="javascript:void(0)" class="delete_btn btn btn-outline-danger btn-sm" data-value="' +
                        item.id +
                        '"><i class="fas fa-trash"></i></a>\
        			</td>\
        		</tr>'
                );
            });
        },
    });
}

//EDIT CATEGORY
$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var categoryId = $(this).val();
    // alert(categoryId);
    $("#EDITCategoryMODAL").modal("show");

    $.ajax({
        type: "GET",
        url: "/category-edit/" + categoryId,
        success: function (response) {
            if (response.status == 200) {

                $("#edit_categoryname").val(response.category.category_name);
                $("#categoryid").val(categoryId);
                $("#old_categoryimage").val(response.category.category_image);
                $("#old_titleimage").val(response.category.title_image);
                $('#edit_description').val(response.category.description);
                $("#edit_desc").val(response.category.desc);

                // $("#edit_description").textarea(response.category.description);
            //    console.log(response.category.description);

                $("#edit_categoryimage_view").attr(
                    "src",
                    "/" + response.category.category_image
                );
                $("#edit_titleimage_view").attr(
                    "src",
                    "/" + response.category.title_image
                );
                // $("#edit_categoryimage").attr(
                //     "src",
                //     response.category.category_image
                // );
            }
        },
    });
});

//UPDATE CATEGORY
$(document).on("submit", "#UPDATECategoryFORM", function (e) {
    e.preventDefault();

    var id = $("#categoryid").val();

    let EditFormData = new FormData($("#UPDATECategoryFORM")[0]);

    EditFormData.append("_method", "PUT");
// console.log(EditFormData);
    $.ajax({
        type: "POST",
        url: "/category-edit/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function (response) {
            // console.log(response)
            if ($.isEmptyObject(response.error)) {
                // alert(response.message);
                $("#EDITCategoryMODAL").modal("hide");
                // $.notify(response.message, 'success')
                $(location).attr("href", "/category-list");
            } else {
                // console.log(response.error)
                // printErrorMsg(response.error);
                $("#edit_wrongcategoryname").empty();

                if (response.error.categoryname == null) {
                    categoryname = "";
                } else {
                    categoryname = response.error.categoryname[0];
                }

                if (response.error.description == null) {
                    description = "";
                } else {
                    description = response.error.description[0];
                }

                if (response.error.desc == null) {
                    desc = "";
                } else {
                    desc = response.error.desc[0];
                }

                $("#edit_wrongcategoryname").append(
                    '<span id="">' + categoryname + "</span>"
                );
            }
        },
    });
});

//DELETE CATEGORY
$(document).ready(function () {
    $("#category_table").on("click", ".delete_btn", function () {
        var categoryId = $(this).data("value");

        $("#categoryid").val(categoryId);

        $("#DELETECategoryFORM").attr(
            "action",
            "/category-delete/" + categoryId
        );

        $("#DELETECategoryMODAL").modal("show");
    });
});

//DATA TABLE
$(document).ready(function () {
    $("#category_table").DataTable({
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
        ) {
            //debugger;
            var index = iDisplayIndexFull + 1;
            $("td:first", nRow).html(index);
            return nRow;
        },
    });
});
