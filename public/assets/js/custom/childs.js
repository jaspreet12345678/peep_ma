$(document).ready(function () {
    var table = $('#child_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/enfants',
            type: 'GET',
        },
        order: [[0, "desc"]],
        columns: [
            { data: 'nom', name: 'nom' },
            { data: 'ecole_name', name: 'ecole_name' },
            { data: 'class_name', name: 'class_name' },
            { data: 'assurance_scolaire', name: 'assurance_scolaire' },
            { data: 'assurance_frais', name: 'assurance_frais' },
            { data: 'attestation_num', name: 'attestation_num' },
            { data: 'parent_nom', name: 'parent_nom' },
            { data: 'parent_telephone', name: 'parent_telephone' },
            { data: 'parent_email', name: 'parent_email' },
            { data: 'dob', name: 'dob' },
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
            url: '/assurances', // Fetch all data
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

    $('#side-close').click(function() {
        $("#modals-slide-in").hide();
        $(".modal-backdrop").hide();
        $("body.pace-done").css({
            "overflow": "",
            "padding-right": ""
        });
    });

    $('#child_table').on('click', '.view', function () {
        var rowData = table.row($(this).closest('tr')).data();
        console.log(rowData,'fdsf');
        $.ajax({
            url: '/childViewDetails',
            type: 'POST',
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: {
                rowDataId: rowData.id,
                parent_id: rowData.parent_id // Send the row data as part of the request payload
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
