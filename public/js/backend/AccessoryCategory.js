$(document).on('click', '.create-btn', function (e) {
    e.preventDefault();
    $('#CreateaccessoriesCategoryModal').modal('show');

});

$(document).on('click', '#close', function (e) {
    $('#CreateaccessoriesCategoryModal').modal('hide');

});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var count = 1;
    //CREATE accessoriesCategory
    $(document).on('submit', '#CreateaccessoriesCategoryForm', function (e) {
        e.preventDefault();

        let formData = new FormData($('#CreateaccessoriesCategoryForm')[0]);

        $.ajax({
            type: "POST",
            url: "/accessories-category-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {
                    $('#CreateaccessoriesCategoryModal').modal('hide');
                    $('#CreateaccessoriesCategoryModal form :input').val("");
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#accessoriesCategory_table').DataTable().ajax.reload();

                } else {
                    printErrorMsg(response.error);
                }
            }
        });

    });

    function printErrorMsg(message) {
        $('#wrong_accessoriesCategory_name').empty();


        if (message.accessoriesCategory_name == null) {
            accessoriesCategory_name = ""
        } else {
            accessoriesCategory_name = message.accessoriesCategory_name[0]
        }



        $('#wrong_accessoriesCategory_name').append('<span id="">' + accessoriesCategory_name + '</span>');


    }

    $("#accessoriesCategory_table").DataTable({
        responsive: true,
        ajax: {
            url: "/accessories-category-list-data",
            dataSrc: "data",
        },

        columns: [{
                data: null,
                render: function (data, type, full, meta) {
                    return count++;
                },
            },
            {
                data: "category_name"
            },

            {
                data: "id",
                render: getBtns,
            },

        ],
        dom: '<"dom_wrapper fh-fixedHeader"Bf>tip',
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "colvis"],
        pageLength: 10,
        fixedHeader: true,
    });

    function getBtns(data, type, full, meta) {
        var id = data;
        return (
            '<button type="button" value="' +
            id +
            '" class="edit_btn btn btn-outline-secondary btn-sm"><i class="fas fa-edit">view</i> </button>' + ' ' +
            '<button type="button" value="' +
            id +
            '" class="dlt_btn btn btn-outline-danger btn-sm"><i class="fas fa-trash">delete</i></button> '
        );
    }


    $(document).on("destroy.dt", function (e, settings) {
        var api = new $.fn.dataTable.Api(settings);
        api.off("order.dt");
        api.off("preDraw.dt");
        api.off("column-visibility.dt");
        api.off("search.dt");
        api.off("page.dt");
        api.off("length.dt");
        api.off("xhr.dt");
    });


    function printEditErrorMsg(message) {
        $('#edit_wrong_accessoriesCategory_name').empty();


        if (message.accessoriesCategory_name == null) {
            accessoriesCategory_name = ""
        } else {
            accessoriesCategory_name = message.accessoriesCategory_name[0]
        }



        $('#edit_wrong_accessoriesCategory_name').append('<span id="">' + accessoriesCategory_name + '</span>');



    }


    $("#accessoriesCategory_table").on("click", ".edit_btn", function (e) {
        e.preventDefault();

        var id = $(this).val();
        // alert(id)
        $('#EditaccessoriesCategoryModal').modal('show');

        $.ajax({
            type: "GET",
            url: "/accessories-category-edit/" + id,
            success: function (response) {
                if (response.status == 200) {
                    $('#edit_accessoriesCategory_name').val(response.data.category_name);

                    $('#get_accessoriesCategory_id').val(id);
                }
            }
        });

    });

    $(document).on('submit', '#EditaccessoriesCategoryForm', function (e) {
        e.preventDefault();

        var id = $('#get_accessoriesCategory_id').val();

        let EditFormData = new FormData($('#EditaccessoriesCategoryForm')[0]);

        EditFormData.append('_method', 'PUT');

        $.ajax({
            type: "POST",
            url: "/accessories-category-edit/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    $('#EditaccessoriesCategoryModal').modal('hide');
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#accessoriesCategory_table').DataTable().ajax.reload();
                } else {
                    printEditErrorMsg(response.error);

                }
            }
        });
    });


    $("#accessoriesCategory_table").on("click", ".dlt_btn", function (e) {
        e.preventDefault();

        var id = $(this).val();
        $('#DeleteaccessoriesCategoryModal').modal('show');
        $('#accessoriesCategory_id').val(id);
        $(document).on("click", ".confrim_dlt", function () {
            $.ajax({
                type: "get",
                url: "/accessories-category-delete/" + id,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response.message);
                    $('#DeleteaccessoriesCategoryModal').modal('hide');
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#accessoriesCategory_table').DataTable().ajax.reload();
                }
            });
        });

    });

    $(document).on('click', '.cancel_dlt_btn', function (e) {
        $('#DeleteaccessoriesCategoryModal').modal('hide');

    });

});
