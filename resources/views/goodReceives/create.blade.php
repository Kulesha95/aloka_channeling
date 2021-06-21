<div class="modal fade" id="createGoodsReceiveModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-truck-loading mr-2"></i>{{ __('app.headers.createGoodReceive') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('goodReceives.store') }}" method="POST" id="createGoodsReceiveForm">
                    <div class="row">
                        <label for="supplier_id">{{ __('app.fields.supplier') }}</label>
                        <select name="supplier_id" id="supplier_id_create" class="form-control"
                            placeholder="{{ __('app.fields.supplier') }}">
                            <option disabled selected>{{ __('app.texts.selectSupplier') }}</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <hr>
                    <table id="good_receives_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.brandName') }}</th>
                                <th>{{ __('app.fields.genericName') }}</th>
                                <th>{{ __('app.fields.receivedQuantity') }}</th>
                                <th>{{ __('app.fields.freeQuantity') }}</th>
                                <th>{{ __('app.fields.purchasePrice') }}</th>
                                <th>{{ __('app.fields.sellingPrice') }}</th>
                                <th>{{ __('app.fields.expireDate') }}</th>
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
        const dataTableNameGoodReceives = 'good_receives_list_table';
        // Table Columns List
        const dataTableColumnsGoodReceives = ["brand_name", "generic_name_text", "received_quantity", "free_quantity",
            "purchase_price",
            "selling_price", "expire_date"
        ];
        const columnOptions = {
            received_quantity: {
                data: "id",
                render: (data) => {
                    return `<input type="number" class="form-control" name="received_quantity[${data}]" placeholder="{{ __('app.fields.receivedQuantity') }}" value="0">`;
                }
            },
            free_quantity: {
                data: "id",
                render: (data) => {
                    return `<input type="number" class="form-control" name="free_quantity[${data}]" placeholder="{{ __('app.fields.freeQuantity') }}" value="0">`;
                }
            },
            purchase_price: {
                data: "id",
                render: (data) => {
                    return `<input type="number" step="0.01" class="form-control" name="purchase_price[${data}]" placeholder="{{ __('app.fields.purchasePrice') }}" value="0.00">`;
                }
            },
            selling_price: {
                data: "id",
                render: (data) => {
                    return `<input type="number" step="0.01" class="form-control" name="selling_price[${data}]" placeholder="{{ __('app.fields.sellingPrice') }}" value="0.00">`;
                }
            },
            expire_date: {
                data: "id",
                render: (data) => {
                    return `<input type="date" class="form-control" name="expire_date[${data}]" placeholder="{{ __('app.fields.expireDate') }}">`;
                }
            }
        }
        const tableGoodReceives = dataTableHandler.initializeTable(
            dataTableNameGoodReceives,
            dataTableColumnsGoodReceives,
            undefined,
            undefined,
            columnOptions
        );
        const openCreateGoodsReceiveModal = () => {
            $('#supplier_id_create').empty();
            $('#supplier_id_create').append(
                `<option disabled selected>{{ __('app.texts.selectSupplier') }}</option>`)
            httpService.get("{{ route('suppliers.index') }}").then(response => {
                response.data.forEach(element => {
                    $('#supplier_id_create').append(new Option(element.name, element.id),
                        false, false)
                });
            })
            dataTableHandler.fillData(tableGoodReceives, []);
            $(`#createGoodsReceiveModal`).modal("show");
        }
        $('#supplier_id_create').on('change', (e) => {
            const supplier = $('#supplier_id_create').val();
            if (supplier) {
                httpService.get("{{ route('supplier.items.index', ':supplier') }}".replace(':supplier',
                        supplier))
                    .then(response => {
                        dataTableHandler.fillData(tableGoodReceives, response.data);
                    });
            } else {
                dataTableHandler.fillData(tableGoodReceives, []);
            }
        });
        $('#createGoodsReceiveForm').on('submit', e => {
            e.preventDefault();
            formData = new FormData();
            var params = tableGoodReceives.$('input,select').serializeArray();
            $.each(params, function() {
                if (!$.contains(document, '#createGoodsReceiveForm')) {
                    formData.append(this.name, this.value);
                }
            });
            formData.append('supplier_id', $('#supplier_id_create').val());
            httpService.post($(`#createGoodsReceiveForm`).attr("action"), formData)
                .then((response) => {
                    $('#createGoodsReceiveForm').trigger("reset");
                    $(`#createGoodsReceiveModal`).modal("hide");
                    messageHandler.successMessage(response.message);
                    loadData();
                });
        })
    </script>
@endpush