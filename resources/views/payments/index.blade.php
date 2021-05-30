@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.paymentsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-hand-holding-usd mr-2"></i>{{ __('app.headers.paymentsManagement') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-channeling-payment-tab" data-toggle="tab"
                        href="#nav-channeling-payment" role="tab" aria-controls="nav-channeling-payment"
                        aria-selected="true"><i
                            class="fas fa-heartbeat mr-1"></i>{{ __('app.texts.channelingPayments') }}</a>
                    <a class="nav-item nav-link" id="nav-pharmacy-payment-tab" data-toggle="tab"
                        href="#nav-pharmacy-payment" role="tab" aria-controls="nav-pharmacy-payment"
                        aria-selected="false"><i class="fas fa-pills mr-1"></i>{{ __('app.texts.pharmacyPayments') }}</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-channeling-payment" role="tabpanel"
                    aria-labelledby="nav-channeling-payment-tab">
                    <table id="channeling_payments_list_table"
                        class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.id') }}</th>
                                <th>{{ __('app.fields.appointmentNumber') }}</th>
                                <th>{{ __('app.fields.patient') }}</th>
                                <th>{{ __('app.fields.doctor') }}</th>
                                <th>{{ __('app.fields.status') }}</th>
                                <th>{{ __('app.fields.fee') }}</th>
                                <th>{{ __('app.fields.paid') }}</th>
                                <th>{{ __('app.fields.balance') }}</th>
                                <th>{{ __('app.fields.actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-pharmacy-payment" role="tabpanel"
                    aria-labelledby="nav-pharmacy-payment-tab">
                    @include('payments.pharmacyPaymentsList')
                </div>
            </div>
            @include('payments.channelingPayments')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Load Data URL
        const indexUrl = "{{ route('appointments.pendingPayments') }}";
        // Get Selected Item Details URL
        const detailsUrl = "{{ route('appointments.details', ':id') }}";
        // Datatable ID
        const dataTableName = 'channeling_payments_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'appointment_number', 'patient', 'doctor', 'status_text',
            'fee_text', 'paid_text', 'balance_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const actionContents =
            "<button class='btn btn-sm btn-outline-primary mr-1 payment-button'><i class='fas fa-dollar-sign fa-fw' ></i></button>";
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            actionContents
        );
        // Load Data To The Table
        const loadData = () => {
            dataTableHandler.loadData(table, indexUrl);
        };
        // Handle Payment Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadChannelingPaymentInfo, 'payment-button');
        $(document).ready(() => {
            // Handle Print Button Click Event In Data Table
            dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
                openPaymentInvoice, 'print-button');
        });
        // Open Print Document
        const openPaymentInvoice = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'channelingPaymentInvoice', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.appointment.id));
        }
    </script>
    @stack('js-stack')
@endsection