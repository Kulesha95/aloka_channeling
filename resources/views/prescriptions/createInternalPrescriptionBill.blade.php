<div class="modal fade" id="createInternalPrescriptionBillModal" tabindex="-1" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.createInternalPrescriptionBill') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4 border-right">
                        <div class="row">
                            <div class="container-fluid my-auto">
                                <ul id="prescription_items">
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="container-fluid my-auto" id="prescription_comment"></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <form id="createPrescriptionBillInternalForm" method="POST"
                            action="{{ route('prescriptions.addBatch') }}">
                            <input type="hidden" name="prescription_id" id="prescription_id_internal">
                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="batch_id">{{ __('app.fields.itemBatch') }}</label>
                                    <select name="batch_id" id="batch_id_internal" class="form-control col-12">
                                        <option></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group col-5">
                                    <label for="quantity">{{ __('app.fields.quantity') }}</label>
                                    <input id="quantity_internal" class="form-control" type="number" name="quantity"
                                        placeholder="{{ __('app.fields.quantity') }}" step="0.01">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group col-2">
                                    <label for="quantity">&nbsp;</label>
                                    <button type="submit" class="btn btn-success d-block"><i class="fa fa-plus mr-1"
                                            aria-hidden="true"></i>{{ __('app.buttons.add') }}</button>
                                </div>
                            </div>
                        </form>
                        <table id="batch_list_table_internal_prescription"
                            class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                <tr>
                                    <th>{{ __('app.fields.genericName') }}</th>
                                    <th>{{ __('app.fields.brandName') }}</th>
                                    <th>{{ __('app.fields.price') }}</th>
                                    <th>{{ __('app.fields.quantity') }}</th>
                                    <th>{{ __('app.fields.total') }}</th>
                                </tr>
                                </tr>
                            </thead>
                        </table>
                        <hr>
                        <div class="row mt-2 mr-2">
                            <h5 class="font-weight-bold ml-auto mr-2">{{ __('app.fields.total') }} :</h5>
                            <h5 id="total_price_internal_prescription"></h5>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-danger ml-auto"
                        onclick="handleStatusUpdateInternalPrescription({{ $rejected }})"><i
                            class="fa fa-times-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.reject') }}</button>
                    <button type="submit" class="btn btn-success ml-1"
                        onclick="handleStatusUpdateInternalPrescription({{ $confirmed }})"><i
                            class="fa fa-check-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        let internalPrescriptionId = 0;
        // Create And Edit Forms Inputs
        const inputsInternalPrescription = ['batch_id', 'quantity'];
        // Load Data URL
        const indexUrlInternalPrescription = "{{ route('prescriptions.batches', ':id') }}";
        const indexUrlInternalPrescriptionItems = "{{ route('prescriptions.items', ':id') }}";
        // Datatable ID
        const dataTableNameInternalPrescription = 'batch_list_table_internal_prescription';
        // Table Columns List
        const dataTableColumnsInternalPrescription = ["brand_name", "generic_name", "price_text", "quantity_text",
            "total_text"
        ];
        // Initialize Data Table
        const tableInternalPrescription = dataTableHandler.initializeTable(
            dataTableNameInternalPrescription,
            dataTableColumnsInternalPrescription,
        );
        const handleAddSuccessInternalPrescription = (data) => {
            $('#prescription_id_internal').val(data.id);
            $('#prescription_comment').html(data.comment);
            internalPrescriptionId = data.id;
            httpService.get(indexUrlInternalPrescriptionItems.replace(':id', internalPrescriptionId)).then(response => {
                const itemsList = response.data.map(item =>
                    `<li>${item.generic_name} - ${item.dosage} - ${item.duration} - ${item.directions}</li>`
                );
                $('#prescription_items').html(itemsList);
            })
            httpService.get(indexUrlInternalPrescription.replace(':id', internalPrescriptionId)).then(response => {
                dataTableHandler.fillData(tableInternalPrescription, response.data.items);
                $('#total_price_internal_prescription').html(response.data.total_text);
            })
            refreshData();
        }
        const clearInternalPrescriptionData = () => {
            internalPrescriptionId = 0;
            dataTableHandler.fillData(tableInternalPrescription, []);
            $('#prescription_id_internal').val("");
            $('#total_price_internal_prescription').html("Rs. 0.00");
            $('#prescription_comment').html();
            $('#createInternalPrescriptionBillModal').modal('hide');
            refreshData();
        }
        const handleStatusUpdateInternalPrescription = (status) => {
            httpService.put("{{ route('prescriptions.updateStatus', ':id') }}".replace(':id',
                internalPrescriptionId), {
                status,
                _method: "PUT"
            }).then((response) => {
                clearInternalPrescriptionData();
                messageHandler.successMessage(response.message);
            }).catch(() => {
                refreshData();
            });
        }
        // Handle Create Form Submit
        formHandler.handleSave(`createPrescriptionBillInternalForm`, inputsInternalPrescription,
            handleAddSuccessInternalPrescription,
            undefined, '_internal');
    </script>
@endpush