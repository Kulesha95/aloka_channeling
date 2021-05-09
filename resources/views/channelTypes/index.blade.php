@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.channelTypesManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-heartbeat mr-2"></i>{{ __('app.headers.channelTypesManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createChannelTypeModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.channelType') }}</th>
                        <th>{{ __('app.fields.description') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('channelTypes.create')
            @include('channelTypes.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['channel_type', 'description', 'colour'];
        // Load Data URL
        const indexUrl = "{{ route('channelTypes.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('channelTypes.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('channelTypes.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "ChannelType";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ["id", "channel_type", "description"];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            defaultActionContent
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
        // Load Selected Data To The Edit Form
        const loadEditForm = (data) => {
            formHandler.handleShow(
                `edit${model}Form`,
                inputs,
                `edit${model}Modal`,
                data,
                parameterIndexes);
        }
        // Handle Edit Button Click Event In Data Table
        dataTableHandler.handleShow(table, viewUrl, parameterIndexes, loadEditForm);
        // Handle Create Form Submit
        formHandler.handleSave(`create${model}Form`, inputs, loadData, `create${model}Modal`);
        // Handle Edit Form Submit
        formHandler.handleEdit(`edit${model}Form`, inputs, loadData, `edit${model}Modal`);
    </script>
@endsection