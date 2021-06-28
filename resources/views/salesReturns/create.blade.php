<div class="modal fade" id="createSalesReturnModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-history mr-2"></i>{{ __('app.headers.createSalesReturn') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('salesReturns.store') }}" method="POST" id="createSalesReturnForm">
                    <div class="row">
                        <label for="prescription_id">{{ __('app.fields.prescription') }}</label>
                        <select name="prescription_id" id="prescription_id_create" class="form-control"
                            placeholder="{{ __('app.fields.prescription') }}">
                            <option disabled selected>{{ __('app.texts.selectPrescription') }}</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <hr>
                    <table id="sales_returns_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.brandName') }}</th>
                                <th>{{ __('app.fields.genericName') }}</th>
                                <th>{{ __('app.fields.issuedQuantity') }}</th>
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
        const dataTableNameSalesReturns = 'sales_returns_list_table';
        // Table Columns List
        const dataTableColumnsSalesReturns = ["brand_name", "generic_name", "quantity_text", "price_text",
            "return_quantity", "return_reason", "return_price"
        ];
        const columnOptions = {
            return_quantity: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input type="hidden" name="batch_id[${meta.row}]" value="${data}"><input type="number" step="0.01" class="form-control" name="return_quantity[${meta.row}]" placeholder="{{ __('app.fields.returnQuantity') }}" value="0">`;
                }
            },
            return_reason: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input class="form-control" name="return_reason[${meta.row}]" placeholder="{{ __('app.fields.returnReason') }}" value="Damaged">`;
                }
            },
            return_price: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input type="number" step="0.01" class="form-control" name="return_price[${meta.row}]" placeholder="{{ __('app.fields.returnPrice') }}" value="${row.price}">`;
                }
            },
        }
        const tableSalesReturns = dataTableHandler.initializeTable(
            dataTableNameSalesReturns,
            dataTableColumnsSalesReturns,
            undefined,
            "<button type='button' class='btn btn-sm btn-outline-success mr-1 copy-button'><i class='fas fa-copy fa-fw' ></i></button>",
            columnOptions
        );
        const openCreateSalesReturnModal = () => {
            $('#prescription_id_create').empty();
            $('#prescription_id_create').append(
                `<option disabled selected>{{ __('app.texts.selectPrescription') }}</option>`)
            httpService.get("{{ route('prescriptions.returnable') }}").then(response => {
                response.data.forEach(element => {
                    $('#prescription_id_create').append(new Option(element.prescription_number, element
                            .id),
                        false, false)
                });
            })
            dataTableHandler.fillData(tableSalesReturns, []);
            $(`#createSalesReturnModal`).modal("show");
        }
        const cloneItem = (data) => {
            tableSalesReturns.row.add(data).draw();
        }
        dataTableHandler.handleCustomTableData(tableSalesReturns,
            cloneItem, 'copy-button');
        $('#prescription_id_create').on('change', (e) => {
            const prescription = $('#prescription_id_create').val();
            if (prescription) {
                httpService.get("{{ route('prescriptions.batches', ':prescription') }}".replace(':prescription',
                        prescription))
                    .then(response => {
                        dataTableHandler.fillData(tableSalesReturns, response.data.items);
                    });
            } else {
                dataTableHandler.fillData(tableSalesReturns, []);
            }
        });
        $('#createSalesReturnForm').on('submit', e => {
            e.preventDefault();
            formData = new FormData();
            var params = tableSalesReturns.$('input,select').serializeArray();
            $.each(params, function() {
                if (!$.contains(document, '#createSalesReturnForm')) {
                    formData.append(this.name, this.value);
                }
            });
            formData.append('prescription_id', $('#prescription_id_create').val());
            httpService.post($(`#createSalesReturnForm`).attr("action"), formData)
                .then((response) => {
                    $('#createSalesReturnForm').trigger("reset");
                    $(`#createSalesReturnModal`).modal("hide");
                    messageHandler.successMessage(response.message);
                    loadData();
                });
        })
    </script>
@endpush