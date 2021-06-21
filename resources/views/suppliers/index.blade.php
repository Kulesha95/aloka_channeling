@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.suppliersManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-truck mr-2"></i>{{ __('app.headers.suppliersManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#createSupplierModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover"
                    style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.id') }}</th>
                            <th>{{ __('app.fields.name') }}</th>
                            <th>{{ __('app.fields.address') }}</th>
                            <th>{{ __('app.fields.email') }}</th>
                            <th>{{ __('app.fields.telephone') }}</th>
                            <th>{{ __('app.fields.registerNumber') }}</th>
                            <th>{{ __('app.fields.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            @include('suppliers.create')
            @include('suppliers.edit')
            @include('suppliers.items')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ["name", "address", "email", "telephone", "register_number"];
        // Load Data URL
        const indexUrl = "{{ route('suppliers.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('suppliers.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('suppliers.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Supplier";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ["id", "name", "address", "email", "telephone", "register_number"];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        // Items Button
        const itemsActionContent =
            "<button class='btn btn-sm btn-outline-info mr-1 items-button'><i class='fas fa-list-alt fa-fw'></i></button>";
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            itemsActionContent+defaultActionContent
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
        $(document).ready(() => {
            // Handle Supplier Itemms Management
            dataTableHandler.handleCustom(table, viewUrl, parameterIndexes, openItemsManagement,
                'items-button');
        });
    </script>
    @stack('js-stack')
@endsection