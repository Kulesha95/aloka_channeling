<div class="modal fade" id="editMedicalPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
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
                <form method="POST" action="{{ route('prescriptions.addItem') }}" id="addItemMedicalPrescriptionForm">
                    <input type="hidden" name="prescription_id" id="prescription_id_medical_prescription_edit">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="generic_name_id">{{ __('app.fields.name') }}</label>
                            <select name="generic_name_id" id="generic_name_id_medical_prescription_edit"
                                class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            <label for="dosage">{{ __('app.fields.dosage') }}</label>
                            <input id="dosage_medical_prescription_edit" class="form-control" type="number"
                                name="dosage" placeholder="{{ __('app.fields.dosage') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            <label for="dosage_unit_id">&nbsp;</label>
                            <select name="dosage_unit_id" id="dosage_unit_id_medical_prescription_edit"
                                class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            <label for="duration">{{ __('app.fields.duration') }}</label>
                            <input id="duration_medical_prescription_edit" class="form-control" type="number"
                                name="duration" placeholder="{{ __('app.fields.duration') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            <label for="duration_type">&nbsp;</label>
                            <select name="duration_type" id="duration_type_medical_prescription_edit"
                                class="form-control col-12">
                                <option value="" selected disabled>{{ __('app.texts.selectDurationType') }}</option>
                                <option value="365">Days</option>
                                <option value="52">Weeks</option>
                                <option value="12">Months</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-11">
                            <label for="direction_id">{{ __('app.fields.directions') }}</label>
                            <select name="direction_id[]" id="direction_id_medical_prescription_edit"
                                class="form-control col-12" multiple="multiple">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-1">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success d-block w-100"><i class="fa fa-plus mr-1"
                                    aria-hidden="true"></i>{{ __('app.buttons.add') }}</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table id="batch_list_table_medical_prescription_edit_prescription"
                    class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                        <tr>
                            <th>{{ __('app.fields.genericName') }}</th>
                            <th>{{ __('app.fields.dosage') }}</th>
                            <th>{{ __('app.fields.duration') }}</th>
                            <th>{{ __('app.fields.directions') }}</th>
                        </tr>
                        </tr>
                    </thead>
                </table>
                <hr>
                <form data-action="{{ route('prescriptions.update', ':id') }}" method="POST"
                    id="editMedicalPrescriptionForm">
                    @method('PUT')
                    <div class="form-group mt-2">
                        <label for="comment">{{ __('app.fields.comment') }}</label>
                        <textarea id="comment_medical_prescription_edit" class="form-control" name="comment"
                            placeholder="{{ __('app.fields.comment') }}"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
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
        let externalPrescriptionId = 0;
        // Item Forms Inputs
        const inputsInternalPrescription = ['generic_name_id', 'dosage', 'dosage_unit_id', 'duration', 'duration_type',
            'direction_id'
        ];
        // Load Data URL
        const indexUrlMedicalPrescription = "{{ route('prescriptions.items', ':id') }}";
        // Datatable ID
        const dataTableNameMedicalPrescription = 'batch_list_table_medical_prescription_edit_prescription';
        // Table Columns List
        const dataTableColumnsMedicalPrescription = ["generic_name", "dosage", "duration", "directions"];
        // Initialize Data Table
        const tableMedicalPrescription = dataTableHandler.initializeTable(
            dataTableNameMedicalPrescription,
            dataTableColumnsMedicalPrescription,
        );
        const handleAddSuccessMedicalPrescription = (data) => {
            $('#prescription_id_medical_prescription_edit').val(data.id);
            externalPrescriptionId = data.id;
            httpService.get(indexUrlMedicalPrescription.replace(':id', externalPrescriptionId)).then(response => {
                dataTableHandler.fillData(tableMedicalPrescription, response.data);
            })
        }
        const clearMedicalPrescriptionData = () => {
            externalPrescriptionId = 0;
            dataTableHandler.fillData(tableMedicalPrescription, []);
            $('#prescription_id_medical_prescription_edit').val("");
        }
        const handleStatusUpdateMedicalPrescription = (status) => {
            httpService.put("{{ route('prescriptions.updateStatus', ':id') }}".replace(':id',
                externalPrescriptionId), {
                status,
                _method: "PUT"
            }).then((response) => {
                clearMedicalPrescriptionData();
                messageHandler.successMessage(response.message);
            })
        }
        // Handle Create Form Submit
        formHandler.handleEdit('editMedicalPrescriptionForm', ['comment'], clearMedicalPrescriptionData, "editMedicalPrescriptionModal",
            '_medical_prescription_edit');
        $('#generic_name_id_medical_prescription_edit').select2({
            placeholder: "{{ __('app.texts.selectItemName') }}"
        });
        $('#direction_id_medical_prescription_edit').select2({
            placeholder: "{{ __('app.texts.selectDirections') }}"
        });
        $('#dosage_unit_id_medical_prescription_edit').select2({
            placeholder: "{{ __('app.texts.selectDosageUnit') }}"
        });
        httpService.get("{{ route('genericNames.index') }}").then(response => {
            response.data.forEach(element => {
                $('#generic_name_id_medical_prescription_edit').append(new Option(element.name, element.id),
                    false,
                    false)
            });
        });
        httpService.get("{{ route('directions.index') }}").then(response => {
            response.data.forEach(element => {
                $('#direction_id_medical_prescription_edit').append(new Option(element.direction, element
                        .code),
                    false,
                    false)
            });
        });
        httpService.get("{{ route('dosageUnits.index') }}").then(response => {
            response.data.forEach(element => {
                $('#dosage_unit_id_medical_prescription_edit').append(new Option(element.unit, element.id),
                    false,
                    false)
            });
        });
        // Handle Add Item Form Submit
        formHandler.handleSave('addItemMedicalPrescriptionForm', inputsInternalPrescription,
            handleAddSuccessMedicalPrescription,
            undefined, '_medical_prescription_edit');
    </script>
@endpush