@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.supplierPaymentsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-truck-loading mr-2"></i>{{ __('app.headers.supplierPaymentsManagement') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <table id="supplier_expenses_list_table" class="table table-sm table-striped table-bordered table-hover"
                style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.goodReceiveNoteNumber') }}</th>
                        <th>{{ __('app.fields.date') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.total') }}</th>
                        <th>{{ __('app.fields.paid') }}</th>
                        <th>{{ __('app.fields.balance') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('expenses.supplierPayments')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Load Data URL
        const indexUrl = "{{ route('goodReceives.index') }}";
        // Get Selected Item Details URL
        const detailsUrl = "{{ route('goodReceives.show', ':id') }}";
        // Datatable ID
        const dataTableName = 'supplier_expenses_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'good_receive_number', 'date', 'time', 'total_text',
            'paid_text', 'balance_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const actionContents =
            "<button class='btn btn-sm btn-outline-primary mr-1 expense-button'><i class='fas fa-dollar-sign fa-fw' ></i></button>";
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
        // Handle Expense Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadSupplierExpenseInfo, 'expense-button');
        // Open Print Document
        const openExpenseInvoice = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'supplierExpenseInvoice', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.appointment.id));
        }
    </script>
    @stack('js-stack')
@endsection