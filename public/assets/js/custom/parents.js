$(document).ready(function () {
    var table = $('#parent_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/parents',
            type: 'GET',
        },
        order: [[0, "desc"]],
        columns: [
            { data: 'last_payment_date', name: 'last_payment_date' },
            { data: 'membership_number', name: 'membership_number' },
            { data: 'parent_name', name: 'parent_name' },
            { data: 'parent_telephone', name: 'parent_telephone' },
            { data: 'parent_email', name: 'parent_email' },
            { data: 'member_adherent', name: 'member_adherent' },
            { data: 'insured_child', name: 'insured_child' },
            { data: 'number_child', name: 'number_child' },
            { data: 'role', name: 'role' },
            { data: 'school', name: 'school' },
            { data: 'class_names', name: 'class_names' },
            {
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    var actions = '<div class="btn-group">' +
                        '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown" data-row-id="' + full.id + '">' +
                        feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                        '</a>' +
                        '<div class="dropdown-menu dropdown-menu-end">';
                    actions += '<a class="dropdown-item view">' +
                        feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                        'View Detail</a>';

                    actions += '</div></div>';
                    return actions;
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        action: function(e, dt, button, config) {
                            exportAllData('copy', 'copyHtml5', e, dt, button, config);
                        }
                    },
                    {
                        extend: 'csv',
                        action: function(e, dt, button, config) {
                            exportAllData('csv', 'csvHtml5', e, dt, button, config);
                        }
                    },
                    {
                        extend: 'excel',
                        action: function(e, dt, button, config) {
                            exportAllData('excel', 'excelHtml5', e, dt, button, config);
                        }
                    },
                    {
                        extend: 'pdf',
                        action: function(e, dt, button, config) {
                            exportAllData('pdf', 'pdfHtml5', e, dt, button, config);
                        }
                    },
                    {
                        extend: 'print',
                        action: function(e, dt, button, config) {
                            exportAllData('print', 'print', e, dt, button, config);
                        }
                    }
                ]
            },
            {
                extend: 'colvis',
                collectionLayout: 'fixed columns',
                popoverTitle: 'Column visibility control'
            }
        ]
    });


    function exportAllData(buttonType, exportType, e, dt, button, config) {
        var searchParams = dt.ajax.params();

        $.ajax({
            url: '/parents', // Fetch all data
            data: Object.assign(searchParams, { length: -1 }), // No pagination
            success: function(data) {
                var fullData = data.data;
                // Create a temporary table with the full data
                var tempTable = $('#tempTable').DataTable({
                    data: fullData,
                    columns: dt.settings().init().columns,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: exportType,
                        exportOptions: {
                            columns: table.columns(':visible').indexes().filter(index => index !== table.columns().indexes().length - 1).toArray()
                        }
                    }],
                    paging: false,
                    searching: false,
                    info: false,
                    ordering: false,
                    destroy: true // Ensure previous instances are destroyed
                });

                $('#tempTable_wrapper').find('button.buttons-' + buttonType)
                    .trigger('click');
            }
        });
    }

    $('#parentSchool').on('change', function () {
        table.ajax.reload(); // Reload the table data based on the new role selection
    });

    $('#side-close').click(function() {
        $("#modals-slide-in").hide();
        $(".modal-backdrop").hide();
        $("body.pace-done").css({
            "overflow": "",
            "padding-right": ""
        });
    });

    $('#parent_table').on('click', '.view', function () {
        var rowData = table.row($(this).closest('tr')).data();
        console.log(rowData.parent_email,'fdsf');
        $.ajax({
            url: '/parentViewDetails',
            type: 'POST',
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: {
                rowDataEmail: rowData.parent_email // Send the row data as part of the request payload
            },
            success: function (response) {
                $("#modals-slide-in").show();
				$(".modal-backdrop").show();
				$(".modal-backdrop").css("display","");
                $(".sssss1").html("");
                $(".sssss1").append(response);
 				$("#modals-slide-in").height($(window).outerHeight(true));
 				$("#modals-slide-in").modal("show");
            },
            error: function (xhr, status, error) {
                // Handle errors
            }
        });
    });
});
