$(document).ready(function () {
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url:'/users',
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                $('#addUserModal').modal('hide'); // Use Bootstrap's modal method to hide the modal
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
    $('#addUserModal').on('hidden.bs.modal', function () {
        $(this).find('.alert').remove(); // Remove any error messages
    });

    $('#editUserModal').hide();

    // Event listener for the datatable
    var table = $('#users_table').DataTable({
        lengthMenu: [5, 10, 25, 50, 75, 100], // Customize the options in the dropdown
        pageLength: 10,// Default number of rows to display
        paging: true,
        ajax: {
            url: '/users',
            data: function (d) {
                d.role = $('#UserPlan').val(); // send the selected role to the server
                d.active = $('#userStatus').val(); // send the selected role to the server

            }
        },

        serverSide: true,
        processing: true,
        order: [[5, "desc"]],
        columns: [{data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'ecole', name: 'ecole'},
            {data: 'role', name: 'role'},
            {data: 'active', name: 'active'},
            {data: 'created_at', name: 'created_at'},
            {
            targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    var actionButton = full.active == 'Active' ? 'Disable' : 'Enable';
                    var icon = full.active == 1 ? 'user-x' : 'user-check';
                    return (
                        '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end" data-bs-target="#editUserModal">' +
                                '<span class="dropdown-item edit-user">' +
                                feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Modifier</span>' +
                                '<span class="dropdown-item toggle-user-status disable-user" data-status="' + full.active + '">' +
                                feather.icons[icon].toSvg({ class: 'font-small-4 me-50' }) +
                                actionButton + '</span>' +
                            '</div>' +
                        '</div>'
                    );
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: [{
            extend: 'collection',
            text: 'Export',
            buttons: [{
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
            url: '/users', // Fetch all data
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

    $('#UserPlan').on('change', function () {
        table.ajax.reload(); // Reload the table data based on the new role selection
    });
    $('#userStatus').on('change', function () {
        table.ajax.reload(); // Reload the table data based on the new role selection
    });

    $('#users_table').on('click', '.edit-user', function () {
        var rowData = table.row($(this).closest('tr')).data();
        console.log(rowData,"row data");
        var newStatus = rowData.active == 'Active' ? 1 : 0;
        // Populate modal fields with user data
        $('#editUserId').val(rowData.id); // Set the hidden user ID
        $('#editUserName').val(rowData.name);
        $('#editUserEmail').val(rowData.email);
        $('#editUserEcole').val(rowData.ecole_id);
        $('#editUserRole').val(rowData.role_id);
        $('#mode').prop('checked', newStatus);
        // Show the modal
        $('#editUserModal').modal('show');
    });

    $('#users_table').on('click', '.disable-user', function() {
        var status = $(this).data('status');

        // Determine the new status
        var newStatus = status == 'Active' ? 1 : 0;
        var rowData = table.row($(this).closest('tr')).data();
        var id = rowData.id;
        $.ajax({
            url: '/users/' + id, // Ensure this route exists on the server
            method: 'PUT', // or 'PATCH' if you prefer
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: { id:id,status: newStatus },
            success: function(response) {
                // Handle success response
                $('#success-message').text(response.message).show().delay(3000).fadeOut(); // Show and then hide the success message
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                // Handle error response
                alert('An error occurred while disabling the user.');
            }
        });
    });


    // Handle form submission for editing user
    $('#editUserForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var userId = $('#editUserId').val();
        var status = $('#mode').is(':checked') ? 1 : 0; // Check if the status checkbox is checked
        form.append('<input type="hidden" name="status" value="' + status + '">'); // Append the status value to the form data
        $.ajax({
            url: '/users/' + userId, // Update URL to include user ID
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                $('#editUserModal').modal('hide'); // Close the modal on success
                $('#success-message').text(response.message).show().delay(3000).fadeOut(); // Show and then hide the success message
                form[0].reset();
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
    $('#editUserModal').on('hidden.bs.modal', function () {
        $(this).find('.alert').remove(); // Remove any error messages
    });
});

