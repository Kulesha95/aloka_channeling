<div class="modal fade" id="supplierItemsModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-pills mr-2"></i>{{ __('app.headers.itemsManagement') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('supplier.items.index', ':id') }}" method=" POST" id="supplierItemsForm">
                    <div class="form-group">
                        <label for="colour">{{ __('app.fields.items') }}</label>
                        <select name="item_id[]" id="item_id_create" class="form-control col-12" multiple="multiple">
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
                <hr>
                <table id="supplier_items_table" class="table table-sm table-striped table-bordered table-hover"
                    style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.id') }}</th>
                            <th>{{ __('app.fields.genericName') }}</th>
                            <th>{{ __('app.fields.brandName') }}</th>
                            <th>{{ __('app.fields.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        // Create And Edit Forms Inputs
        const inputsItems = ['reason'];
        // Load Data URL
        const indexUrlItems =
            "{{ route('supplier.items.index', ['supplier' => ':supplier']) }}";
        // Delete Data URL
        const deleteUrlItems =
            "{{ route('supplier.items.destroy', ['supplier' => ':supplier', 'item' => ':id']) }}";
        // Datatable ID
        const dataTableNameItems = 'supplier_items_table';
        // Table Columns List
        const dataTableColumnsItems = ["id", "generic_name_text", "brand_name"];
        // Column Indexes For URL Parameters
        const parameterIndexesItems = {
            "id": 0
        };
        let currentSupplier = 0;
        // Initialize Data Table
        const tableItems = dataTableHandler.initializeTable(
            dataTableNameItems,
            dataTableColumnsItems,
            null,
            deleteActionContent
        );
        // Load Data To The Table
        const loadDataItems = () => {
            loadItemsList();
            dataTableHandler.loadData(tableItems, indexUrlItems.replace(':supplier',
                currentSupplier));
        };
        // Handle Create Form Submit
        formHandler.handleSave("supplierItemsForm", inputsItems, loadDataItems, null);
        const openItemsManagement = (data) => {
            currentSupplier = data.id;
            loadDataItems();
            // Delete Item
            dataTableHandler.handleDelete(
                tableItems,
                deleteUrlItems.replace(':supplier', currentSupplier),
                parameterIndexesItems,
                indexUrlItems.replace(':supplier', currentSupplier),
				loadItemsList
            );
            let itemsAddUrl = $(`#supplierItemsForm`).data("action");
            itemsAddUrl = itemsAddUrl.replace(`:id`, currentSupplier);
            $(`#supplierItemsForm`).attr("action", itemsAddUrl);
            $('#supplierItemsModal').modal('show');
        }
        // Render Select2 Selected Option
        const templateSelection = (item) => {
            if (!item.id || item.id == 0) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return element.brand_name;
        };
        // Render Select2 Options
        const templateResult = (item) => {
            if (!item.id || item.id == 0) {
                return $(`<div class="row"><h6 class="font-weight-bold">${item.text}</h6></div>`);
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.brand_name}</h6></div><div class="row">${element.generic_name_text}</div>`
            );
        };
        const select2Options = {
            templateResult,
            templateSelection,
            placeholder: "{{ __('app.texts.selectItems') }}",
        };
        $('#item_id_create').select2(select2Options);
        // Load Non Supplying Items List
        const loadItemsList = () => {
            $('#item_id_create').empty();
            $('#item_id_create').append(new Option("", undefined), false, false);
            httpService.get("{{ route('suppliers.nonSupplyingItems', ':supplier') }}".replace(':supplier',
                currentSupplier)).then(response => {
                response.data.forEach(element => {
                    $('#item_id_create').append(new Option(JSON.stringify(element), element.id),
                        false, false)
                });
            })
        }
    </script>
@endpush