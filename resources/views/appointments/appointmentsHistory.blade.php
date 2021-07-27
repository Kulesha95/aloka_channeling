@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.appointmentsHistory') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-history mr-2"></i>{{ __('app.headers.appointmentsHistory') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.appointmentNumber') }}</th>
                        <th>{{ __('app.fields.doctor') }}</th>
                        <th>{{ __('app.fields.date') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.status') }}</th>
                        <th>{{ __('app.fields.fee') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('appointments.info')
            @include('appointments.payments')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Load Data URL
        const indexUrl = "{{ route('appointments.history') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('appointments.show', ':id') }}";
        // Get Selected Item Details URL
        const detailsUrl = "{{ route('appointments.details', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Appointment";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'appointment_number', 'doctor', 'date', 'time', 'status_text',
            'fee_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const actionContents =
            viewActionContent +
            "<button class='btn btn-sm btn-outline-success mr-1 payment-button'><i class='fas fa-dollar-sign fa-fw' ></i></button>" +
            "<button class='btn btn-sm btn-outline-danger mr-1 print-button'><i class='fas fa-print fa-fw' ></i></button>";
        const columnOptions = {
            fee_text: {
                className: "text-right"
            }
        };
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            actionContents,
            columnOptions
        );
        // Load Data To The Table
        const loadData = () => {
            dataTableHandler.loadData(table, indexUrl);
        };
        // Handle View Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadChannelingInfo, 'view-button');
        // Handle Payment Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadPaymentInfo, 'payment-button');
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
@endsection