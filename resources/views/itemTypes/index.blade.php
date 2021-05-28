@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.itemTypesManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-tag mr-2"></i>{{ __('app.headers.itemTypesManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createItemTypeModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.itemType') }}</th>
                        <th>{{ __('app.fields.description') }}</th>
                        <th>{{ __('app.fields.classification') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('itemTypes.create')
            @include('itemTypes.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['item_type', 'description', 'parent_id'];
        // Load Data URL
        const indexUrl = "{{ route('itemTypes.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('itemTypes.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('itemTypes.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "ItemType";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ["id", "item_type", "description",
            "classification"
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
            loadItemTypes();
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
            if (!item.id || item.id == 0) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return element.item_type;
        };
        // Render Select2 Options
        const templateResult = (item) => {
            if (!item.id || item.id == 0) {
                return $(`<div class="row"><h6 class="font-weight-bold">${item.text}</h6></div>`);
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.item_type}</h6></div><div class="row">${element.description}</div><div class="row font-weight-light">${element.description} Per Appointment</div>`
            );
        };
        const select2Options = {
            templateResult,
            templateSelection,
            placeholder: "{{ __('app.texts.selectParent') }}",
        };
        const loadItemTypes = () => {
            $('#parent_id_create').select2(select2Options);
            $('#parent_id_edit').select2(select2Options);
            $('#parent_id_create').empty();
            $('#parent_id_edit').empty();
            $('#parent_id_create').append(new Option("", undefined), false, false)
            $('#parent_id_edit').append(new Option("", undefined), false, false)
            $('#parent_id_create').append(new Option("Parent Item Type", 0), false, false)
            $('#parent_id_edit').append(new Option("Parent Item Type", 0), false, false)
            // Load Doctors List
            httpService.get("{{ route('itemTypes.index') }}").then(response => {
                response.data.forEach(element => {
                    $('#parent_id_create').append(new Option(JSON.stringify(element), element.id),
                        false, false)
                    $('#parent_id_edit').append(new Option(JSON.stringify(element), element.id), false,
                        false)
                });
            })
        }
        loadItemTypes();
    </script>
@endsection