// Handle Load Data To The Datatable
exports.loadData = (table, url) => {
    // Get data from the API
    httpService.get(url).then((response) => {
        // Clear Existing Table Data
        table.clear();
        // Insert New Data To The Table
        table.rows.add(response.data).draw();
    });
};

// Handle Datatable Initialization
exports.initializeTable = (
    tableId,
    columns,
    indexUrl = undefined,
    actionContent = undefined
) => {
    // Generate Columns List
    const tableColumns = columns.map((column) => {
        // If Column Contains Image Field Return Image Preview Instead Of Raw Data
        if (column === "image") {
            return {
                data: column,
                // Convert Raw Data To Image Preview
                render: function (data) {
                    return (
                        '<img class="img-circle image-preview-table" src="' +
                        data +
                        '" />'
                    );
                },
            };
        }
        // Return Column Definition As Raw Data And Hide ID Column
        return {
            data: column,
            visible: column !== "id",
        };
    });
    // If Table Needs Action Column Add It To The Columns List
    if (actionContent) {
        tableColumns.push({ data: null, defaultContent: actionContent });
    }
    // Initialize Datatable
    const dataTable = $(`#${tableId}`).DataTable({
        responsive: true,
        columns: tableColumns,
    });
    // If Data Loading URL Is Provided Load Data From The API
    if (indexUrl) {
        this.loadData(dataTable, indexUrl);
    }
    // Return Data Table
    return dataTable;
};

// Handle Delete Action
exports.handleDelete = (
    table,
    url,
    parameters = undefined,
    refreshUrl = undefined
) => {
    // Add Listenr For The Delete Button
    table.on("click", ".delete-button", function () {
        // Get Selected Row Data
        const data = table.row($(this).parents("tr")).data();
        // Ask For Delete Confirmation
        sweetAlert
            .fire({
                title: "Are you sure you want to delete this?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
            })
            .then((confirmation) => {
                // If Confirmed Handle Delete Process
                if (confirmation.isConfirmed) {
                    // Prepare Delete API Call URL Using Provided Parameter Indexes
                    let deleteUrl = url;
                    Object.keys(parameters).forEach((urlParameter) => {
                        deleteUrl = deleteUrl.replace(
                            `:${urlParameter}`,
                            data[urlParameter]
                        );
                    });
                    // Delete Record From The Database
                    httpService.delete(deleteUrl).then((response) => {
                        // If Data Loading URL Is Provided Refresh The Table Data
                        if (refreshUrl) {
                            dataTableHandler.loadData(table, refreshUrl);
                        }
                        // Display Success Message
                        messageHandler.successMessage(response.message);
                    });
                }
            });
    });
};

// Handle Display Data 
exports.handleShow = (
    table,
    url,
    parameters = undefined,
    handleShowCallback
) => {
    // Add Listener To The Edit Button
    table.on("click", ".edit-button", function () {
        // Get Selected Row Data
        const data = table.row($(this).parents("tr")).data();
        // Prepare Data Retrieve API Call URL Using Provided Parameter Indexes
        let editUrl = url;
        Object.keys(parameters).forEach((urlParameter) => {
            editUrl = editUrl.replace(`:${urlParameter}`, data[urlParameter]);
        });
        // Get Data From The API
        httpService.get(editUrl).then((response) => {
            // Pass Data To The Call Back Function For Display
            handleShowCallback(response.data);
        });
    });
};