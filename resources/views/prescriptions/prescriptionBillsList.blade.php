<table id="prescriptions_list_table" class="table table-sm table-striped table-bordered table-hover mt-3"
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
        const inputsPrescriptions = ['prescription_type', 'comment'];
        // Prescriptions Load Data URL
        const indexUrlPrescriptions = "{{ route('prescriptions.prescriptionBills') }}";
        // Prescriptions View Selected Data URL
        const viewUrlPrescriptions = "{{ route('prescriptions.show', ':id') }}";
        // Prescriptions Delete Data URL
        const deleteUrlPrescriptions = "{{ route('prescriptions.destroy', ':id') }}";
        // Prescriptions Entity Name To Define Form And Model IDs
        const modelPrescriptions = "Prescription";
        // Prescriptions Datatable ID
        const dataTableNamePrescriptions = 'prescriptions_list_table';
        // Prescriptions Table Columns List
        const dataTableColumnsPrescriptions = ["id", "prescription_number", "date", "time", "prescription_type_text",
            "status_text", "total_text"
        ];
        // Prescriptions Column Indexes For URL Parameters
        const parameterIndexesPrescriptions = {
            "id": 0
        };
        // Initialize Data Table
        const tablePrescriptions = dataTableHandler.initializeTable(
            dataTableNamePrescriptions,
            dataTableColumnsPrescriptions,
            undefined,
            viewActionContent
        );
        const displayPendingCont = (data) => {
            const pendingCount = data.filter(item => item.status == "{{ $pending }}").length;
            if (pendingCount) {
                $('#pendingCount').removeClass('badge-success');
                $('#pendingCount').addClass('badge-danger');
                $('#pendingCount').html(pendingCount);
            } else {
                $('#pendingCount').removeClass('badge-danger');
                $('#pendingCount').addClass('badge-success');
                $('#pendingCount').html(0);
            }
        }
        // Load Data To The Table
        const loadDataPrescriptions = () => {
            dataTableHandler.loadData(tablePrescriptions, indexUrlPrescriptions, displayPendingCont);
        };
        const openPrescription = (data) => {
            if (data.status == "{{ $pending }}") {
                handleAddSuccessExternalPrescription(data)
                $('#createPrescriptionBillModal').modal('show');
            }
        }
        dataTableHandler.handleCustom(tablePrescriptions, viewUrlPrescriptions, parameterIndexesPrescriptions,
            openPrescription, 'view-button');
    </script>
@endpush