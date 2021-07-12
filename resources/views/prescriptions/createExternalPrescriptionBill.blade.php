<div class="modal fade" id="createExternalPrescriptionBillModal" tabindex="-1" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.createExternalPrescriptionBill') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPrescriptionBillExternalForm" method="POST"
                    action="{{ route('prescriptions.addBatch') }}">
                    <input type="hidden" name="prescription_id" id="prescription_id_external">
                    <div class="row">
                        <div class="form-group col-5">
                            <label for="batch_id">{{ __('app.fields.itemBatch') }}</label>
                            <select name="batch_id" id="batch_id_external" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-4">
                            <label for="quantity">{{ __('app.fields.quantity') }}</label>
                            <input id="quantity_external" class="form-control" type="number" name="quantity"
                                placeholder="{{ __('app.fields.quantity') }}" step="0.01">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-auto">
                            <label for="quantity">{{ __('app.fields.discount') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="discount"
                                    id="discount_external" value="1" checked>
                                <label class="custom-control-label" for="discount_external"></label>
                            </div>
                        </div>
                        <div class="form-group col-auto">
                            <label for="quantity">&nbsp;</label>
                            <button type="submit" class="btn btn-success d-block"><i class="fa fa-plus mr-1"
                                    aria-hidden="true"></i>{{ __('app.buttons.add') }}</button>
                        </div>
                    </div>
                </form>
                <table id="batch_list_table_external_prescription"
                    class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.brandName') }}</th>
                            <th>{{ __('app.fields.price') }}</th>
                            <th>{{ __('app.fields.discount') }}</th>
                            <th>{{ __('app.fields.discountedPrice') }}</th>
                            <th>{{ __('app.fields.quantity') }}</th>
                            <th>{{ __('app.fields.total') }}</th>
                        </tr>
                    </thead>
                </table>
                <hr>
                <div class="row mt-2 mr-2">
                    <h5 class="font-weight-bold ml-auto mr-2">{{ __('app.fields.total') }} :</h5>
                    <h5 id="total_price_external_prescription"></h5>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-2 ml-auto">
                        <h5 class="font-weight-bold text-right mr-2">{{ __('app.fields.total') }} :</h5>
                    </div>
                    <div class="col-4">
                        <input id="total_price_text_external_prescription"
                            class="form-control form-control-sm text-right" disabled>
                        <input id="total_price_external_prescription" type="hidden" type="number"
                            class="form-control form-control-sm text-right" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 ml-auto">
                        <h5 class="font-weight-bold text-right mr-2">{{ __('app.fields.discount') }} :</h5>
                    </div>
                    <div class="col-4">
                        <input id="discount_external_prescription" type="number"
                            class="form-control form-control-sm text-right">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 ml-auto">
                        <h5 class="font-weight-bold text-right mr-2">{{ __('app.fields.payable') }} :</h5>
                    </div>
                    <div class="col-4">
                        <input id="payable_external_prescription" class="form-control form-control-sm text-right"
                            disabled>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <button type="submit" class="btn btn-secondary ml-auto" onclick="clearExternalPrescriptionData()"><i
                            class="fa fa-minus-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.reset') }}</button>
                    <button type="submit" class="btn btn-danger ml-1"
                        onclick="handleStatusUpdateExternalPrescription({{ $rejected }})"><i
                            class="fa fa-times-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.reject') }}</button>
                    <button type="submit" class="btn btn-success ml-1"
                        onclick="handleStatusUpdateExternalPrescription({{ $confirmed }})"><i
                            class="fa fa-check-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        let externalPrescriptionId = 0;
        // Create And Edit Forms Inputs
        const inputsExternalPrescription = ['batch_id', 'quantity', 'discount'];
        // Load Data URL
        const indexUrlExternalPrescription = "{{ route('prescriptions.batches', ':id') }}";
        // Datatable ID
        const dataTableNameExternalPrescription = 'batch_list_table_external_prescription';
        // Table Columns List
        const dataTableColumnsExternalPrescription = ["brand_name", "price_text", "discount_text",
            "discounted_price_text", "quantity_text", "total_text"
        ];
        // Initialize Data Table
        const tableExternalPrescription = dataTableHandler.initializeTable(
            dataTableNameExternalPrescription,
            dataTableColumnsExternalPrescription,
        );
        const handleAddSuccessExternalPrescription = (data) => {
            $('#prescription_id_external').val(data.id);
            externalPrescriptionId = data.id;
            httpService.get(indexUrlExternalPrescription.replace(':id', externalPrescriptionId)).then(response => {
                dataTableHandler.fillData(tableExternalPrescription, response.data.items);
                $('#total_price_text_external_prescription').val(response.data.total_text);
                $('#total_price_external_prescription').val(response.data.total);
                $('#payable_external_prescription').val(response.data.total_text);
                $('#discount_external_prescription').val('').trigger('change');
            })
            refreshData();
        }
        const clearExternalPrescriptionData = () => {
            externalPrescriptionId = 0;
            dataTableHandler.fillData(tableExternalPrescription, []);
            $('#prescription_id_external').val("");
            $('#total_price_text_external_prescription').val("Rs. 0.00");
            $('#payable_external_prescription').val("Rs. 0.00");
            $('#total_price_external_prescription').val(0);
            $('#discount_external_prescription').val('').trigger('change');
            $('#prescription_comment').html();
            $('#createInternalPrescriptionBillModal').modal('hide');
            refreshData();
        }
        const handleStatusUpdateExternalPrescription = (status) => {
            httpService.put("{{ route('prescriptions.updateStatus', ':id') }}".replace(':id',
                externalPrescriptionId), {
                status,
                discount: isNaN($('#discount_external_prescription').val()) ? 0 : $(
                    '#discount_external_prescription').val(),
                _method: "PUT"
            }).then((response) => {
                clearExternalPrescriptionData();
                messageHandler.successMessage(response.message);
            }).catch(() => {
                refreshData();
            });
        }
        // Handle Create Form Submit
        formHandler.handleSave(`createPrescriptionBillExternalForm`, inputsExternalPrescription,
            handleAddSuccessExternalPrescription,
            undefined, '_external');
        const calculatePayableExternal = () => {
            const total = $('#total_price_external_prescription').val();
            const discount = $('#discount_external_prescription').val();
            $('#payable_external_prescription').val(
                "Rs." + Number((isNaN(total) || isNaN(discount) ? total : total - discount).toFixed(2))
                .toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })
            );
        }
        $('#discount_external_prescription').keyup(() => {
            calculatePayableExternal();
        })
        $('#discount_external_prescription').change(() => {
            calculatePayableExternal();
        })
    </script>
@endpush