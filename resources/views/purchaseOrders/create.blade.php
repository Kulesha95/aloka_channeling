<div class="modal fade" id="createPurchaseOrderModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-shopping-cart mr-2"></i>{{ __('app.headers.createPurchaseOrder') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('purchaseOrders.store') }}" method="POST" id="createPurchaseOrderForm">
                    <table id="deficit_items_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.brandName') }}</th>
                                <th>{{ __('app.fields.genericName') }}</th>
                                <th>{{ __('app.fields.reorderLevel') }}</th>
                                <th>{{ __('app.fields.stockQuantity') }}</th>
                                <th>{{ __('app.fields.supplier') }}</th>
                                <th>{{ __('app.fields.orderQuantity') }}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        // Datatable ID
        const dataTableNameDeficitItems = 'deficit_items_list_table';
        // Table Columns List
        const dataTableColumnsDeficitItems = ["brand_name", "generic_name", "reorder_level_text", "stock_text", "suppliers",
            "reorder_quantity"
        ];
        const columnOptions = {
            suppliers: {
                data: {
                    id: "id",
                    suppliers: "suppliers"
                },
                render: (data) => {
                    const supplierOptions = data.suppliers.map(supplier => {
                        return `<option value="${supplier.id}">${supplier.name}</option>`;
                    });
                    supplierOptions.unshift(
                        "<option selected value='0'>{{ __('app.texts.selectSupplier') }}</option>");
                    return `<select class="form-control" name="supplier_id[${data.id}]">${supplierOptions}</select>`
                }
            },
            reorder_quantity: {
                data: {
                    id: "id",
                    reorder_quantity: "reorder_quantity"
                },
                render: (data) => {
                    return `<input type="number" class="form-control" name="quantity[${data.id}]" placeholder="{{ __('app.fields.quantity') }}" value="${data.reorder_quantity}">`;
                }
            },
            stock_text: {
                data: {
                    stock: "stock",
                    stock_text: "stock_text",
                    reorder_level: "reorder_level"
                },
                render: (data) => {
                    return `<h5><span class="badge badge-pill badge-${data.stock > data.reorder_level ? "success" : "danger"} d-block">${data.stock_text}</span></h5>`;
                }
            }
        }
        const tableDeficitItems = dataTableHandler.initializeTable(
            dataTableNameDeficitItems,
            dataTableColumnsDeficitItems,
            undefined,
            undefined,
            columnOptions
        );
        const openCreatePurchaseOrderModal = () => {
            httpService.get("{{ route('items.getPurchasingItems') }}").then(response => {
                dataTableHandler.fillData(tableDeficitItems, response.data);
            });
            $(`#createPurchaseOrderModal`).modal("show");
        }
        $('#createPurchaseOrderForm').on('submit', e => {
            e.preventDefault();
            formData = new FormData();
            var params = tableDeficitItems.$('input,select').serializeArray();
            $.each(params, function() {
                if (!$.contains(document, '#createPurchaseOrderForm')) {
                    formData.append(this.name, this.value);
                }
            });
            httpService.post($(`#createPurchaseOrderForm`).attr("action"), formData)
                .then((response) => {
                    $('#createPurchaseOrderForm').trigger("reset");
                    $(`#createPurchaseOrderModal`).modal("hide");
                    messageHandler.successMessage(response.message);
                    loadData();
                })
        })
    </script>
@endpush