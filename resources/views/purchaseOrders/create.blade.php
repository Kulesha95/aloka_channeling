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
                <div class="row d-block">
                    <label for="supplier_id">{{ __('app.fields.supplier') }}</label>
                    <select name="supplier_id" id="supplier_id_create" class="form-control col-12">
                        <option></option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <hr>
                <form action="{{ route('purchaseOrders.store') }}" method="POST" id="createPurchaseOrderForm">
                    <table id="deficit_items_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.brandName') }}</th>
                                <th>{{ __('app.fields.genericName') }}</th>
                                <th>{{ __('app.fields.reorderLevel') }}</th>
                                <th>{{ __('app.fields.stockQuantity') }}</th>
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
        const dataTableColumnsDeficitItems = ["brand_name", "generic_name", "reorder_level_text", "stock_text",
            "reorder_quantity"
        ];
        const columnOptions = {
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
        const tableSupplierItems = dataTableHandler.initializeTable(
            dataTableNameDeficitItems,
            dataTableColumnsDeficitItems,
            undefined,
            undefined,
            columnOptions
        );
        const select2OptionsSupplier = {
            placeholder: "{{ __('app.texts.selectSupplier') }}"
        }
        $('#supplier_id_create').select2(select2OptionsSupplier);
        const openCreatePurchaseOrderModal = () => {
            $('#supplier_id_create').empty();
            $('#supplier_id_create').append(new Option("", undefined), false, false)
            httpService.get("{{ route('suppliers.index') }}").then(response => {
                response.data.forEach(element => {
                    $('#supplier_id_create').append(new Option(element.name, element.id),
                        false, false)
                });
            })
            dataTableHandler.fillData(tableSupplierItems, []);
            $(`#createPurchaseOrderModal`).modal("show");
        }
        $('#supplier_id_create').on('change', (e) => {
            const supplier = $('#supplier_id_create').val();
            if (supplier) {
                httpService.get("{{ route('supplier.items.index', ':supplier') }}".replace(':supplier',
                        supplier))
                    .then(response => {
                        dataTableHandler.fillData(tableSupplierItems, response.data);
                    });
            } else {
                dataTableHandler.fillData(tableSupplierItems, []);
            }
        });
        $('#createPurchaseOrderForm').on('submit', e => {
            e.preventDefault();
            formData = new FormData();
            var params = tableSupplierItems.$('input,select').serializeArray();
            $.each(params, function() {
                if (!$.contains(document, '#createPurchaseOrderForm')) {
                    formData.append(this.name, this.value);
                }
            });
            formData.append('supplier_id', $('#supplier_id_create').val());
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