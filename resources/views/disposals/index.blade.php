@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.disposalsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-recycle mr-2"></i>{{ __('app.headers.disposalsManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" id="createButton" onclick="openCreateDisposalModal()">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.number') }}</th>
                        <th>{{ __('app.fields.date') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.total') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('disposals.create')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Load Data URL
        const indexUrl = "{{ route('disposals.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('disposals.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('disposals.destroy', ':id') }}";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ["id", "disposal_number", "date", "time", "total_text"];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            "<button class='btn btn-sm btn-outline-info mr-1 print-button'><i class='fas fa-print fa-fw' ></i></button>" +
            deleteActionContent, {
                total_text: {
                    className: "text-right",
                },
            }
        );
        // Delete Item
        dataTableHandler.handleDelete(
            table,
            deleteUrl,
            parameterIndexes,
            indexUrl
        );
        // Load Data To The Table
        const loadData = () => {
            dataTableHandler.loadData(table, indexUrl);
        };
        // Open Print Document
        const openDisposal = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'disposal', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.id));
        }
        // Handle Exploration Button Click Event In Data Table
        dataTableHandler.handleCustom(table, viewUrl, parameterIndexes,
            openDisposal, 'print-button');
    </script>
    @stack('js-stack')
@endsection