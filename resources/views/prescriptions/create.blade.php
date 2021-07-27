<div class="modal fade" id="createPrescriptionModal" tabindex="-1" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.createMedicalPrescription') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createMedicalPrescriptionForm" method="POST"
                    action="{{ route('prescriptions.addItem') }}">
                    <input type="hidden" name="prescription_id" id="prescription_id_medical">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="generic_name_id">{{ __('app.fields.name') }}</label>
                            <select name="generic_name_id" id="generic_name_id_medical" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            <label for="dosage">{{ __('app.fields.dosage') }}</label>
                            <input id="dosage_medical" class="form-control" type="number" name="dosage"
                                placeholder="{{ __('app.fields.dosage') }}" step="0.01">
                            <div class="invalid-feedback"></div>
                        </div><div class="form-group col-2">
                            <label for="generic_name_id">&nbsp;</label>
                            <select name="generic_name_id" id="generic_name_id_medical" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            <label for="dosage">{{ __('app.fields.duration') }}</label>
                            <input id="dosage_medical" class="form-control" type="number" name="dosage"
                                placeholder="{{ __('app.fields.dosage') }}" step="0.01">
                            <div class="invalid-feedback"></div>
                        </div><div class="form-group col-2">
                            <label for="generic_name_id">&nbsp;</label>
                            <select name="generic_name_id" id="generic_name_id_medical" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-11">
                            <label for="generic_name_id">{{ __('app.fields.directions') }}</label>
                            <select name="generic_name_id" id="generic_name_id_medical" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-1">
                            <label for="quantity">&nbsp;</label>
                            <button type="submit" class="btn btn-success d-block w-100"><i class="fa fa-plus mr-1"
                                    aria-hidden="true"></i>{{ __('app.buttons.add') }}</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table id="batch_list_table_medical_prescription"
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
                    <h5 id="total_price_medical_prescription"></h5>
                </div>
                <hr>
                <div class="row">
                    <button type="submit" class="btn btn-secondary ml-auto" onclick="clearMedicalPrescriptionData()"><i
                            class="fa fa-minus-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.reset') }}</button>
                    <button type="submit" class="btn btn-danger ml-1"
                        onclick="handleStatusUpdateMedicalPrescription({{ $rejected }})"><i
                            class="fa fa-times-circle mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.reject') }}</button>
                    <button type="submit" class="btn btn-success ml-1"
                        onclick="handleStatusUpdateMedicalPrescription({{ $confirmed }})"><i
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
        const inputsMedicalPrescription = ['batch_id', 'quantity'];
        // Load Data URL
        const indexUrlMedicalPrescription = "{{ route('prescriptions.batches', ':id') }}";
        // Datatable ID
        const dataTableNameMedicalPrescription = 'batch_list_table_medical_prescription';
        // Table Columns List
        const dataTableColumnsMedicalPrescription = ["brand_name", "generic_name", "price_text", "quantity_text",
            "total_text"
        ];
        // Initialize Data Table
        const tableMedicalPrescription = dataTableHandler.initializeTable(
            dataTableNameMedicalPrescription,
            dataTableColumnsMedicalPrescription,
        );
        const handleAddSuccessMedicalPrescription = (data) => {
            $('#prescription_id_medical').val(data.id);
            externalPrescriptionId = data.id;
            httpService.get(indexUrlMedicalPrescription.replace(':id', externalPrescriptionId)).then(response => {
                dataTableHandler.fillData(tableMedicalPrescription, response.data.items);
                $('#total_price_medical_prescription').html(response.data.total_text);
            })
            refreshData();
        }
        const clearMedicalPrescriptionData = () => {
            externalPrescriptionId = 0;
            dataTableHandler.fillData(tableMedicalPrescription, []);
            $('#prescription_id_medical').val("");
            $('#total_price_medical_prescription').html("0.00");
            refreshData();
        }
        const handleStatusUpdateMedicalPrescription = (status) => {
            httpService.put("{{ route('prescriptions.updateStatus', ':id') }}".replace(':id',
                externalPrescriptionId), {
                status,
                _method: "PUT"
            }).then((response) => {
                clearMedicalPrescriptionData();
                messageHandler.successMessage(response.message);
            }).catch(() => {
                refreshData();
            });
        }
        // Handle Create Form Submit
        formHandler.handleSave(`createMedicalPrescriptionForm`, inputsMedicalPrescription,
            handleAddSuccessMedicalPrescription,
            undefined, '_medical');
    </script