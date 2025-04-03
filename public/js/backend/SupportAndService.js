$(document).on('click', '.create-btn', function (e) {
    e.preventDefault();
    $('#CreateSupportAndServiceModal').modal('show');

});

$(document).on('click', '#close', function (e) {
    $('#CreateSupportAndServiceModal').modal('hide');

});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var count = 1;
    //CREATE SupportAndService
    $(document).on('submit', '#CreateSupportAndServiceForm', function (e) {
        e.preventDefault();

        let formData = new FormData($('#CreateSupportAndServiceForm')[0]);

        $.ajax({
            type: "POST",
            url: "/support-and-service-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

                if ($.isEmptyObject(response.error)) {
                    $('#CreateSupportAndServiceModal').modal('hide');
                    $('#CreateSupportAndServiceModal form :input').val("");

                    var tinymce_editor_id = 'description';
                   tinymce.get(tinymce_editor_id).setContent('');

                    $.notify(response.message, 'success')
                    count = 1;
                    $('#support_and_service_table').DataTable().ajax.reload();

                } else {
                    printErrorMsg(response.error);
                }
            }
        });

    });

    function printErrorMsg(message) {
        $('#wrong_description').empty();


        if (message.description == null) {
            description = ""
        } else {
            description = message.description[0]
        }



        $('#wrong_description').append('<span id="">' + description + '</span>');


    }

    $("#support_and_service_table").DataTable({
        responsive: true,
        ajax: {
            url: "/support-and-service-list-data",
            dataSrc: "data",
        },

        columns: [{
                data: null,
                render: function (data, type, full, meta) {
                    return count++;
                },
            },
            {
                data: "description"
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
        $('#edit_wrong_description').empty();


        if (message.description == null) {
            description = ""
        } else {
            description = message.description[0]
        }



        $('#edit_wrong_description').append('<span id="">' + description + '</span>');



    }


    $("#support_and_service_table").on("click", ".edit_btn", function (e) {
        e.preventDefault();

        var id = $(this).val();
        // alert(id)
        $('#EditSupportAndServiceModal').modal('show');

        $.ajax({
            type: "GET",
            url: "/support-and-service-edit/" + id,
            success: function (response) {
                if (response.status == 200) {
                    var data=response.data.description
                    tinymce.get('edit_description').setContent(data);
                    // tinymce.init({
                    //     selector: "#edit_description",
                    //     setup: function (editor) {
                    //         editor.on('init', function () {
                    //             var content =data;
                    //             editor.setContent(content);
                    //         });
                    //     }
                    // });
                    $('#get_SupportAndService_id').val(id);
                }
            }
        });

    });

    $(document).on('submit', '#EditSupportAndServiceForm', function (e) {
        e.preventDefault();

        var id = $('#get_SupportAndService_id').val();

        let EditFormData = new FormData($('#EditSupportAndServiceForm')[0]);

        EditFormData.append('_method', 'PUT');

        $.ajax({
            type: "POST",
            url: "/support-and-service-edit/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    $('#EditSupportAndServiceModal').modal('hide');
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#support_and_service_table').DataTable().ajax.reload();
                } else {
                    printEditErrorMsg(response.error);

                }
            }
        });
    });


    $("#support_and_service_table").on("click", ".dlt_btn", function (e) {
        e.preventDefault();

        var id = $(this).val();
        $('#DeleteSupportAndServiceModal').modal('show');
        $('#SupportAndService_id').val(id);
        $(document).on("click", ".confrim_dlt", function () {
            $.ajax({
                type: "get",
                url: "/support-and-service-delete/" + id,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response.message);
                    $('#DeleteSupportAndServiceModal').modal('hide');
                    $.notify(response.message, 'success')
                    count = 1;
                    $('#support_and_service_table').DataTable().ajax.reload();
                }
            });
        });

    });

    $(document).on('click', '.cancel_dlt_btn', function (e) {
        $('#DeleteSupportAndServiceModal').modal('hide');

    });

});
