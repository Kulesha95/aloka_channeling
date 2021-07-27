@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.doctorPaymentsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-user-md mr-2"></i>{{ __('app.headers.doctorPaymentsManagement') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <table id="doctor_expenses_list_table" class="table table-sm table-striped table-bordered table-hover"
                style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.scheduleNumber') }}</th>
                        <th>{{ __('app.fields.doctor') }}</th>
                        <th>{{ __('app.fields.channelType') }}</th>
                        <th>{{ __('app.fields.date') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.balance') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('expenses.doctorPayments')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Load Data URL
        const indexUrl = "{{ route('schedules.all') }}";
        // Get Selected Item Details URL
        const detailsUrl = "{{ route('schedules.show', ':id') }}";
        // Datatable ID
        const dataTableName = 'doctor_expenses_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'schedule_number', 'doctor', 'channel_type', 'repeat_text',
            'time_text', 'balance_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const actionContents =
            "<button class='btn btn-sm btn-outline-primary mr-1 expense-button'><i class='fas fa-dollar-sign fa-fw' ></i></button>";
        const columnOptions = {
            balance_text: {
                className: "text-right"
            }
        }
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
        // Handle Expense Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadDoctorExpenseInfo, 'expense-button');
        // Open Print Document
        const openExpenseInvoice = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'doctorExpenseInvoice', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.appointment.id));
        }
    </script>
    @stack('js-stack')
@endsection