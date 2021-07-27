<table id="pharmacy_payments_pending_list_table" class="table table-sm table-striped table-bordered table-hover"
    style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th>{{ __('app.fields.id') }}</th>
            <th>{{ __('app.fields.prescriptionNumber') }}</th>
            <th>{{ __('app.fields.date') }}</th>
            <th>{{ __('app.fields.time') }}</th>
            <th>{{ __('app.fields.status') }}</th>
            <th>{{ __('app.fields.total') }}</th>
            <th>{{ __('app.fields.paid') }}</th>
            <th>{{ __('app.fields.balance') }}</th>
            <th>{{ __('app.fields.actions') }}</th>
        </tr>
    </thead>
</table>
@include('payments.pharmacyPayments')

@push('js-stack')
    <script>
        // Load Data URL
        const indexUrlPharmacyPayment = "{{ route('prescriptions.pendingPayments') }}";
        // Get Selected Item Details URL
        const detailsUrlPharmacyPayment = "{{ route('prescriptions.details', ':id') }}";
        // Datatable ID
        const dataTableNamePharmacyPayment = 'pharmacy_payments_pending_list_table';
        // Table Columns List
        const dataTableColumnsPharmacyPayment = ['id', 'prescription_number', 'date', 'time', 'status_text',
            'total_text', 'paid_text', 'balance_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexesPharmacyPayment = {
            "id": 0
        };
        const actionContentsPharmacyPayment =
            "<button class='btn btn-sm btn-outline-primary mr-1 payment-button'><i class='fas fa-dollar-sign fa-fw' ></i></button>";
        const columnOptionsPharmacyPayments = {
            total_text: {
                className: "text-right"
            },
            paid_text: {
                className: "text-right"
            },
            balance_text: {
                className: "text-right"
            }
        }
        // Initialize Data Table
        const tablePharmacyPayment = dataTableHandler.initializeTable(
            dataTableNamePharmacyPayment,
            dataTableColumnsPharmacyPayment,
            indexUrlPharmacyPayment,
            actionContentsPharmacyPayment,
            columnOptionsPharmacyPayments
        );
        // Load Data To The Table
        const loadDataPharmacyPayment = () => {
            dataTableHandler.loadData(tablePharmacyPayment, indexUrlPharmacyPayment);
        };
        $(document).ready(() => {
            // Handle Print Button Click Event In Data Table
            dataTableHandler.handleCustom(tablePharmacyPayment, detailsUrlPharmacyPayment,
                parameterIndexesPharmacyPayment,
                openPharmacyPaymentInvoice, 'print-button');
            // Handle Payment Button Click Event In Data Table
            dataTableHandler.handleCustom(tablePharmacyPayment, detailsUrlPharmacyPayment,
                parameterIndexesPharmacyPayment,
                loadPharmacyPaymentInfo, 'payment-button');
        });
        // Open Print Document
        const openPharmacyPaymentInvoice = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'pharmacyPaymentInvoice', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.appointment.id));
        }
    </script>
@endpush