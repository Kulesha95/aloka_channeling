exports.loadData = (table, url) => {
    httpService.get(url).then((response) => {
        table.clear();
        table.rows.add(response.data).draw();
    });
};

exports.initializeTable = (
    tableId,
    columns,
    indexUrl = undefined,
    actionContent = undefined
) => {
    const tableColumns = columns.map((column) => ({
        data: column,
        visible: column !== "id",
    }));
    if (actionContent) {
        tableColumns.push({ data: null, defaultContent: actionContent });
    }
    const dataTable = $(`#${tableId}`).DataTable({
        columns: tableColumns,
    });
    if (indexUrl) {
        this.loadData(dataTable, indexUrl);
    }
    return dataTable;
};

exports.handleDelete = (
    table,
    url,
    parameters = undefined,
    refreshUrl = undefined
) => {
    table.on("click", ".delete-button", function () {
        const data = table.row($(this).parents("tr")).data();
        sweetAlert
            .fire({
                title: "Are you sure you want to delete this?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
            })
            .then((confirmation) => {
                if (confirmation.isConfirmed) {
                    let deleteUrl = url;
                    Object.keys(parameters).forEach((urlParameter) => {
                        deleteUrl = deleteUrl.replace(
                            `:${urlParameter}`,
                            data[urlParameter]
                        );
                    });
                    httpService.delete(deleteUrl).then((response) => {
                        if (refreshUrl) {
                            dataTableHandler.loadData(table, refreshUrl);
                        }
                        sweetAlert.fire({
                            title: response.message,
                            icon: "success",
                        });
                    });
                }
            });
    });
};

exports.handleShow = (
    table,
    url,
    parameters = undefined,
    handleShowCallback
) => {
    table.on("click", ".edit-button", function () {
        const data = table.row($(this).parents("tr")).data();
        let editUrl = url;
        Object.keys(parameters).forEach((urlParameter) => {
            editUrl = editUrl.replace(`:${urlParameter}`, data[urlParameter]);
        });
        httpService.get(editUrl).then((response) => {
            handleShowCallback(response.data);
        });
    });
};