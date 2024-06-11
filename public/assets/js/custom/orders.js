$(document).ready(function () {
    $('#updateStatusForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url:'/updateOrderStatus',
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                $('#updateStatusModal').modal('hide'); // Use Bootstrap's modal method to hide the modal
                $('#success-message').text(response.message).show().delay(3000).fadeOut(); // Show and then hide the success message
                form[0].reset(); // Reset the form fields
                table.ajax.reload(null, false);
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                form.find('.alert').remove();
                $.each(errors, function (key, value) {
                    form.find('[name="' + key + '"]').after('<div class="alert alert-danger">' + value[0] + '</div>');
                });
            }
        });
    });

    $('#updateStatusModal').on('hidden.bs.modal', function () {
        $(this).find('.alert').remove(); // Remove any error messages
    });

    // var table = $('#order_table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //         url: '/assurances',
    //     },
    //     serverSide: true,
    //     order: [[5, "desc"]],
    //     columns: [
    //         {data: 'parent_nom', name: 'parent_nom'}, // Parents
    //         {data: 'parent_telephone', name: 'parent_telephone'}, // Tel
    //         {data: 'parent_email', name: 'parent_email'}, // Email
    //         {data: 'code', name: 'code'}, // Num. De Commande
    //         {data: 'total_amount', name: 'total_amount'}, // TOTAL
    //         {data: 'status', name: 'status'}, // status
    //         {data: 'utilisateur', name: 'utilisateur'}, // utilisateur
    //         {data: 'mode', name: 'mode'}, // mode
    //         {data: 'cash_2023', name: 'cash_2023'}, // Cash 2023
    //         {data: 'date', name: 'date'}, // Date
    //         {
    //             targets: -1,
    //             title: 'Actions',
    //             orderable: false,
    //             render: function (data, type, full, meta) {
    //                 // Determine the status of the current row
    //                 var status = full.status;
    //                 console.log(status,"status");
    //                 var actions = '<div class="btn-group">' +
    //                     '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown" data-row-id="' + full.id + '">' +
    //                     feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
    //                     '</a>' +
    //                     '<div class="dropdown-menu dropdown-menu-end">';

    //                 if (status == "Payé") {
    //                     actions += '<a class="dropdown-item view">' +
    //                         feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
    //                         'Voir Detail</a>' +
    //                         '<a class="dropdown-item update-status" data-bs-target="#updateStatusModal" data-order_id = "">' +
    //                         feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
    //                         'Modifier Status</a>' +
    //                         '<a class="dropdown-item generateOrderCertificate" data-bs-target="#generateOrderCertificate">' +
    //                         feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
    //                         'Generer et envoyer attestation</a>' +
    //                         `<a class="dropdown-item downloadPdf" href="http://127.0.0.1:8000/downloadPdf/${full.id}" data-id="${full.id}" data-bs-target="#downloadPdf">
    //                             ${feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' })}
    //                             Generer pdf
    //                         </a>`;
    //                 } else {
    //                     actions += '<a class="dropdown-item view">' +
    //                     feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
    //                     'Voir Detail</a>' +
    //                     '<a class="dropdown-item update-status" data-bs-target="#updateStatusModal" data-order_id = "">' +
    //                     feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
    //                     'Modifier Status</a>';
    //                 }

    //                 actions += '</div></div>';
    //                 return actions;
    //             }
    //         }
    //     ],
    //     dom: 'Bfrtip',
    //     buttons: [{
    //             extend: 'collection',
    //             text: 'Export',
    //             buttons: [{
    //                     extend: 'copy',
    //                     action: function(e, dt, button, config) {
    //                         exportAllData('copy', 'copyHtml5', e, dt, button, config);
    //                     }
    //                 },
    //                 {
    //                     extend: 'csv',
    //                     action: function(e, dt, button, config) {
    //                         exportAllData('csv', 'csvHtml5', e, dt, button, config);
    //                     }
    //                 },
    //                 {
    //                     extend: 'excel',
    //                     action: function(e, dt, button, config) {
    //                         exportAllData('excel', 'excelHtml5', e, dt, button, config);
    //                     }
    //                 },
    //                 {
    //                     extend: 'pdf',
    //                     action: function(e, dt, button, config) {
    //                         exportAllData('pdf', 'pdfHtml5', e, dt, button, config);
    //                     }
    //                 },
    //                 {
    //                     extend: 'print',
    //                     action: function(e, dt, button, config) {
    //                         exportAllData('print', 'print', e, dt, button, config);
    //                     }
    //                 }
    //             ]
    //         },
    //         {
    //             extend: 'colvis',
    //             collectionLayout: 'fixed columns',
    //             popoverTitle: 'Column visibility control'
    //         }
    //     ]
    // });

    var table = $('#order_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/assurances',
            type: 'GET'
        },
        order: [[9, "desc"]],
        columns: [
            {data: 'parent_name', name: 'parent_name'}, // Parents
            {data: 'parent_telephone', name: 'parent_telephone'}, // Tel
            {data: 'parent_email', name: 'parent_email'}, // Email
            {data: 'code', name: 'code'}, // Num. De Commande
            {data: 'total', name: 'total'}, // TOTAL
            {data: 'status', name: 'status'}, // status
            {data: 'utilisateur', name: 'utilisateur'}, // utilisateur
            {data: 'mode', name: 'mode'}, // mode
            {data: 'cash_2023', name: 'cash_2023'}, // Cash 2023
            {data: 'date', name: 'date'}, // Date
            {
                data: null,
                orderable: false,
                render: function (data, type, full, meta) {
                    var status = full.status;
                    var actions = `
                        <div class="btn-group">
                            <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown" data-row-id="${full.id}">
                                ${feather.icons['more-vertical'].toSvg({ class: 'font-small-4' })}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item view">
                                    ${feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' })} Voir Detail
                                </a>
                                <a class="dropdown-item update-status" data-bs-target="#updateStatusModal" data-order_id="${full.id}">
                                    ${feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' })} Modifier Status
                                </a>
                                ${status == "Payé" ? `
                                <a class="dropdown-item generateOrderCertificate" data-bs-target="#generateOrderCertificate">
                                    ${feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' })} Generer et envoyer attestation
                                </a>
                                <a class="dropdown-item downloadPdf" href="/downloadPdf/${full.id}" data-id="${full.id}" data-bs-target="#downloadPdf">
                                    ${feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' })} Generer pdf
                                </a>` : ''}
                            </div>
                        </div>`;
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

    $('#order_table').on('click', '.update-status', function () {
        function newStatus(status) {
            switch (status) {
                case "Non Payé":
                    return "0";
                case "Payé":
                    return "1";
                case "Annulé":
                    return "2";
                case "Modifier":
                    return "3";
                case "Rembourser":
                    return "4";
                case "Payée Cash":
                    return "5";
                case "Encaissé":
                    return "6";
                default:
                    return "Unknown";
            }
        }
        var rowData = table.row($(this).closest('tr')).data();
        console.log(rowData,"row data");
        var newStatus = newStatus(rowData.status);
        $('#updateStatus').val(newStatus);
        $('#orderId').val(rowData.id);
        $('#updateStatusModal').modal('show');
    });

    $('#side-close').click(function() {
        $("#modals-slide-in").hide();
        $(".modal-backdrop").hide();
        $("body.pace-done").css({
            "overflow": "",
            "padding-right": ""
        });
    });

    $('#order_table').on('click', '.view', function () {
        var rowData = table.row($(this).closest('tr')).data();
        // console.log(rowData, "row data");
        // Make an AJAX request with the row data
        $.ajax({
            url: '/viewDetails',
            type: 'POST',
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: {
                rowDataId: rowData.id // Send the row data as part of the request payload
            },
            success: function (response) {
                $("#modals-slide-in").show();
				$(".modal-backdrop").show();
				$(".modal-backdrop").css("display","");
                $(".sssss").html("");
                $(".sssss").append(response);
 				$("#modals-slide-in").height($(window).outerHeight(true));
 				$("#modals-slide-in").modal("show");
            },
            error: function (xhr, status, error) {
                // Handle errors
            }
        });
    });

    $('#order_table').on('click', '.generateOrderCertificate', function () {
        // console.log("jaspreet");
        var rowData = table.row($(this).closest('tr')).data();
        // console.log(rowData, "row data");
        // Make an AJAX request with the row data
        $.ajax({
            url: '/generateOrderCertificate',
            type: 'POST',
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: {
                rowDataId: rowData.id // Send the row data as part of the request payload
            },
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
            }
        });
    });
});

