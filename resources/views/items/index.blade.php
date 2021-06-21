@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.itemsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-pills mr-2"></i>{{ __('app.headers.itemsManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#createItemModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.brandName') }}</th>
                        <th>{{ __('app.fields.genericName') }}</th>
                        <th>{{ __('app.fields.reorderLevel') }}</th>
                        <th>{{ __('app.fields.reorderQuantity') }}</th>
                        <th>{{ __('app.fields.itemType') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('items.create')
            @include('items.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['generic_name_id', 'brand_name', 'reorder_level', 'reorder_quantity', 'item_type_id', 'unit','is_sales_item','is_purchase_item'];
        // Load Data URL
        const indexUrl = "{{ route('items.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('items.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('items.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Item";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'brand_name', 'generic_name_text', 'reorder_level_text', 'reorder_quantity_text',
            'item_type_text'
        ];
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
        // Render Select2 Selected Option
        const templateSelection = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return `${element.item_type}`;
        };
        // Render Select2 Options
        const templateResult = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.item_type}</h6></div><div class="row">${element.description}</div><div class="row font-weight-light">${element.classification??''}</div>`
            );
        };
        const select2Options = {
            templateResult,
            templateSelection,
            placeholder: "{{ __('app.texts.selectItemType') }}",
        };
        const select2OptionsGenericName = {
            placeholder: "{{ __('app.texts.selectGenericName') }}",
        };
        $('#item_type_id_create').select2(select2Options);
        $('#item_type_id_edit').select2(select2Options);
        $('#generic_name_id_create').select2(select2OptionsGenericName);
        $('#generic_name_id_edit').select2(select2OptionsGenericName);
        // Load Item Types List
        httpService.get("{{ route('itemTypes.index') }}").then(response => {
            response.data.forEach(element => {
                $('#item_type_id_create').append(new Option(JSON.stringify(element), element.id), false,
                    false)
                $('#item_type_id_edit').append(new Option(JSON.stringify(element), element.id), false,
                    false)
            });
        })
        // Load Generic Names List
        httpService.get("{{ route('genericNames.index') }}").then(response => {
            response.data.forEach(element => {
                $('#generic_name_id_create').append(new Option(element.name, element.id), false,
                    false)
                $('#generic_name_id_edit').append(new Option(element.name, element.id), false,
                    false)
            });
        })
    </script>
@endsection