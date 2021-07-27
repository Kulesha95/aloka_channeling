<div class="modal fade" id="createPurchaseReturnModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-history mr-2"></i>{{ __('app.headers.createPurchaseReturn') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('purchaseReturns.store') }}" method="POST" id="createPurchaseReturnForm">
                    <div class="row d-block">
                        <label for="supplier_id">{{ __('app.fields.supplier') }}</label>
                        <select name="supplier_id" id="supplier_id_create" class="form-control col-12">
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <hr>
                    <table id="purchase_returns_list_table"
                        class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.brandName') }}</th>
                                <th>{{ __('app.fields.genericName') }}</th>
                                <th>{{ __('app.fields.returnableQuantity') }}</th>
                                <th>{{ __('app.fields.price') }}</th>
                                <th>{{ __('app.fields.returnQuantity') }}</th>
                                <th>{{ __('app.fields.returnReason') }}</th>
                                <th>{{ __('app.fields.returnPrice') }}</th>
                                <th>{{ __('app.fields.actions') }}</th>
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
        const dataTableNamePurchaseReturns = 'purchase_returns_list_table';
        // Table Columns List
        const dataTableColumnsPurchaseReturns = ["item_brand_name", "item_generic_name", "returnable_quantity",
            "purchase_price_text",
            "return_quantity", "return_reason", "return_price"
        ];
        const columnOptions = {
            returnable_quantity: {
                render: (data, type, row, meta) => {
                    return `${data} ${row.item_unit}`;
                }
            },
            return_quantity: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input type="hidden" name="batch_id[${meta.row}]" value="${data}"><input type="number" step="0.01" class="form-control" name="return_quantity[${meta.row}]" placeholder="{{ __('app.fields.returnQuantity') }}" value="0">`;
                }
            },
            return_reason: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input class="form-control" name="return_reason[${meta.row}]" placeholder="{{ __('app.fields.returnReason') }}" value="Expired">`;
                }
            },
            return_price: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input type="number" step="0.01" class="form-control" name="return_price[${meta.row}]" placeholder="{{ __('app.fields.returnPrice') }}" value="${row.purchase_price}">`;
                }
            },
            purchase_price_text: {
                className: "text-right",
            },
        }
        const tablePurchaseReturns = dataTableHandler.initializeTable(
            dataTableNamePurchaseReturns,
            dataTableColumnsPurchaseReturns,
            undefined,
            "<button type='button' class='btn btn-sm btn-outline-success mr-1 copy-button'><i class='fas fa-copy fa-fw' ></i></button>",
            columnOptions
        );
        const select2OptionsSupplier = {
            placeholder: "{{ __('app.texts.selectSupplier') }}"
        }
        $('#supplier_id_create').select2(select2OptionsSupplier);
        const openCreatePurchaseReturnModal = () => {
            $('#supplier_id_create').empty();
            $('#supplier_id_create').append(new Option("", undefined), false, false)
            httpService.get("{{ route('suppliers.index') }}").then(response => {
                response.data.forEach(element => {
                    $('#supplier_id_create').append(new Option(element.name, element
                            .id),
                        false, false)
                });
            })
            dataTableHandler.fillData(tablePurchaseReturns, []);
            $(`#createPurchaseReturnModal`).modal("show");
        }
        const cloneItem = (data) => {
            tablePurchaseReturns.row.add(data).draw();
        }
        dataTableHandler.handleCustomTableData(tablePurchaseReturns,
            cloneItem, 'copy-button');
        $('#supplier_id_create').on('change', (e) => {
            const supplier = $('#supplier_id_create').val();
            if (supplier) {
                httpService.get("{{ route('supplier.returnable', ':supplier') }}".replace(':supplier',
                        supplier))
                    .then(response => {
                        dataTableHandler.fillData(tablePurchaseReturns, response.data);
                    });
            } else {
                dataTableHandler.fillData(tablePurchaseReturns, []);
            }
        });
        $('#createPurchaseReturnForm').on('submit', e => {
            e.preventDefault();
            formData = new FormData();
            var params = tablePurchaseReturns.$('input,select').serializeArray();
            $.each(params, function() {
                if (!$.contains(document, '#createPurchaseReturnForm')) {
                    formData.append(this.name, this.value);
                }
            });
            formData.append('supplier_id', $('#supplier_id_create').val());
            httpService.post($(`#createPurchaseReturnForm`).attr("action"), formData)
                .then((response) => {
                    $('#createPurchaseReturnForm').trigger("reset");
                    $(`#createPurchaseReturnModal`).modal("hide");
                    messageHandler.successMessage(response.message);
                    loadData();
                });
        })
    </script>
@endpush