<table id="prescriptions_paid_list_table" class="table table-sm table-striped table-bordered table-hover mt-3"
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
        // Prescriptions Load Data URL
        const indexUrlPaidPrescriptions = "{{ route('prescriptions.paid') }}";
        // Prescriptions View Selected Data URL
        const viewUrlPaidPrescriptions = "{{ route('prescriptions.show', ':id') }}";
        // Prescriptions Datatable ID
        const dataTableNamePaidPrescriptions = 'prescriptions_paid_list_table';
        // Prescriptions Table Columns List
        const dataTableColumnsPaidPrescriptions = ["id", "prescription_number", "date", "time", "prescription_type_text",
            "status_text", "total_text"
        ];
        // Prescriptions Column Indexes For URL Parameters
        const parameterIndexesPaidPrescriptions = {
            "id": 0
        };
        // Initialize Data Table
        const tablePaidPrescriptions = dataTableHandler.initializeTable(
            dataTableNamePaidPrescriptions,
            dataTableColumnsPaidPrescriptions,
            undefined,
            viewActionContent,
            {total_text:{className:"text-right"}}
        );
        const displayPaidCount = (data) => {
            const paidCount = data.length;
            if (paidCount) {
                $('#paidCount').removeClass('badge-success');
                $('#paidCount').addClass('badge-danger');
                $('#paidCount').html(paidCount);
            } else {
                $('#paidCount').removeClass('badge-danger');
                $('#paidCount').addClass('badge-success');
                $('#paidCount').html(0);
            }
        }
        // Load Data To The Table
        const loadDataPaidPrescriptions = () => {
            dataTableHandler.loadData(tablePaidPrescriptions, indexUrlPaidPrescriptions, displayPaidCount);
        };
        const openPaidPrescription = (data) => {
            loadpaidPrescriptionItems(data);
            $('#issuePrescriptionModel').modal('show');
        }
        dataTableHandler.handleCustom(tablePaidPrescriptions, viewUrlPaidPrescriptions, parameterIndexesPaidPrescriptions,
            openPaidPrescription, 'view-button');
    </script>
@endpush