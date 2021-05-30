<table id="internal_prescriptions_list_table" class="table table-sm table-striped table-bordered table-hover mt-3"
    style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th>{{ __('app.fields.id') }}</th>
            <th>{{ __('app.fields.prescriptionNumber') }}</th>
            <th>{{ __('app.fields.date') }}</th>
            <th>{{ __('app.fields.time') }}</th>
            <th>{{ __('app.fields.prescriptionType') }}</th>
            <th>{{ __('app.fields.status') }}</th>
            <th>{{ __('app.fields.total') }}</th>
            <th>{{ __('app.fields.actions') }}</th>
        </tr>
    </thead>
</table>

@push('js-stack')
    <script>
        // Prescriptions Create And Edit Forms Inputs
        const inputsInternalPrescriptions = ['prescription_type', 'comment'];
        // Prescriptions Load Data URL
        const indexUrlInternalPrescriptions = "{{ route('prescriptions.internalPrescriptions') }}";
        // Prescriptions View Selected Data URL
        const viewUrlInternalPrescriptions = "{{ route('prescriptions.show', ':id') }}";
        // Prescriptions Delete Data URL
        const deleteUrlInternalPrescriptions = "{{ route('prescriptions.destroy', ':id') }}";
        // Prescriptions Entity Name To Define Form And Model IDs
        const modelInternalPrescriptions = "Prescription";
        // Prescriptions Datatable ID
        const dataTableNameInternalPrescriptions = 'internal_prescriptions_list_table';
        // Prescriptions Table Columns List
        const dataTableColumnsInternalPrescriptions = ["id", "prescription_number", "date", "time",
            "prescription_type_text",
            "status_text", "total_text"
        ];
        // Prescriptions Column Indexes For URL Parameters
        const parameterIndexesInternalPrescriptions = {
            "id": 0
        };
        // Initialize Data Table
        const tableInternalPrescriptions = dataTableHandler.initializeTable(
            dataTableNameInternalPrescriptions,
            dataTableColumnsInternalPrescriptions,
            undefined,
            viewActionContent
        );
        const displayInternalPendingCount = (data) => {
            const pendingCount = data.length;
            if (pendingCount) {
                $('#pendingCountInternal').removeClass('badge-success');
                $('#pendingCountInternal').addClass('badge-danger');
                $('#pendingCountInternal').html(pendingCount);
            } else {
                $('#pendingCountInternal').removeClass('badge-danger');
                $('#pendingCountInternal').addClass('badge-success');
                $('#pendingCountInternal').html(0);
            }
        }
        // Load Data To The Table
        const loadDataInternalPrescriptions = () => {
            dataTableHandler.loadData(tableInternalPrescriptions, indexUrlInternalPrescriptions,
                displayInternalPendingCount);
        };
        const openInternalPrescription = (data) => {
            handleAddSuccessInternalPrescription(data)
            $('#createInternalPrescriptionBillModal').modal('show');
        }
        dataTableHandler.handleCustom(tableInternalPrescriptions, viewUrlInternalPrescriptions,
            parameterIndexesInternalPrescriptions,
            openInternalPrescription, 'view-button');
    </script>
@endpush