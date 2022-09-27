$(function () {
    let datatableOptions = {};

    datatableOptions.processing = true;
    datatableOptions.serverSide = true;
    datatableOptions.ajax = DATATABLE_URL_AJAX;
    datatableOptions.columns = [
        {data: "subject"},
        {
            "data": "sender",
            render: function (data, type, row) {
                return row.senderName + ' - ' + row.senderEmail;
            }
        },
        {data: "date"},
        {
            className: 'actions',
            searchable: false,
            orderable: false,
            data: null,
            render: function (data, type, row) {
                return '' +
                    '<a href="' + makeShowUrlName(row.id) + '" ><i class="far fa-eye"></i></a>' +
                    '';
            }
        },
    ];

    $("#ordersDataTable").DataTable(datatableOptions)
        .buttons().container().appendTo('#ordersDataTable_wrapper .col-md-6:eq(0)');
});
