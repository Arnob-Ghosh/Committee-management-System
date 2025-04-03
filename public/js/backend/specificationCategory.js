$(document).on('click', '.create-btn', function (e) {
    e.preventDefault();
    $('#CreatespecificationCategoryModal').modal('show');

});

$(document).on('click', '#close', function (e) {
    $('#CreatespecificationCategoryModal').modal('hide');

});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var count = 1;
    //CREATE specificationCategory
    $(document).on('submit', '#CreatespecificationCategoryForm', function (e) {
        e.preventDefault();

        let formData = new FormData($('#CreatespecificationCategoryForm')[0]);

        $.ajax({
            type: "POST",
            url: "/smart-phone/specification-category-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response.message);

                if ($.isEmptyObject(response.error)) {
                    $('#CreatespecificationCategoryModal').modal('hide');
                    $('#CreatespecificationCategoryModal form :input').val("");
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#specificationCategory_table').DataTable().ajax.reload();

                } else {
                    printErrorMsg(response.error);
                }
            }
        });

    });

    function printErrorMsg(message) {
        $('#wrong_specificationCategory_name').empty();


        if (message.specificationCategory_name == null) {
            specificationCategory_name = ""
        } else {
            specificationCategory_name = message.specificationCategory_name[0]
        }



        $('#wrong_specificationCategory_name').append('<span id="">' + specificationCategory_name + '</span>');


    }

    $("#specificationCategory_table").DataTable({
        responsive: true,
        ajax: {
            url: "/smart-phone/specification-category-list-data",
            dataSrc: "data",
        },

        columns: [{
                data: null,
                render: function (data, type, full, meta) {
                    return count++;
                },
            },
            {
                data: "specificationCategory_name"
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
        $('#edit_wrong_specificationCategory_name').empty();


        if (message.specificationCategory_name == null) {
            specificationCategory_name = ""
        } else {
            specificationCategory_name = message.specificationCategory_name[0]
        }



        $('#edit_wrong_specificationCategory_name').append('<span id="">' + specificationCategory_name + '</span>');



    }


    $("#specificationCategory_table").on("click", ".edit_btn", function (e) {
        e.preventDefault();

        var id = $(this).val();
        // alert(id)
        $('#EditspecificationCategoryModal').modal('show');

        $.ajax({
            type: "GET",
            url: "/smart-phone/specification-category-edit/" + id,
            success: function (response) {
                if (response.status == 200) {
                    $('#edit_specificationCategory_name').val(response.data.specificationCategory_name);

                    $('#get_specificationCategory_id').val(id);
                }
            }
        });

    });

    $(document).on('submit', '#EditspecificationCategoryForm', function (e) {
        e.preventDefault();

        var id = $('#get_specificationCategory_id').val();

        let EditFormData = new FormData($('#EditspecificationCategoryForm')[0]);

        EditFormData.append('_method', 'PUT');

        $.ajax({
            type: "POST",
            url: "/smart-phone/specification-category-edit/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    $('#EditspecificationCategoryModal').modal('hide');
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#specificationCategory_table').DataTable().ajax.reload();
                } else {
                    printEditErrorMsg(response.error);

                }
            }
        });
    });


    $("#specificationCategory_table").on("click", ".dlt_btn", function (e) {
        e.preventDefault();

        var id = $(this).val();
        $('#DeletespecificationCategoryModal').modal('show');
        $('#specificationCategory_id').val(id);
        $(document).on("click", ".confrim_dlt", function () {
            $.ajax({
                type: "get",
                url: "/smart-phone/specification-category-delete/" + id,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response.message);
                    $('#DeletespecificationCategoryModal').modal('hide');
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#specificationCategory_table').DataTable().ajax.reload();
                }
            });
        });

    });

    $(document).on('click', '.cancel_dlt_btn', function (e) {
        $('#DeletespecificationCategoryModal').modal('hide');

    });

});
