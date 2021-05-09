@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.usersManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-user mr-2"></i>{{ __('app.headers.usersManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#createUserModal">
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
                            <th>{{ __('app.fields.image') }}</th>
                            <th>{{ __('app.fields.username') }}</th>
                            <th>{{ __('app.fields.email') }}</th>
                            <th>{{ __('app.fields.mobile') }}</th>
                            <th>{{ __('app.fields.userType') }}</th>
                            <th>{{ __('app.fields.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            @include('users.create')
            @include('users.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ["id", "username", "email", "mobile", "user_type_id", "image"];
        // Load Data URL
        const indexUrl = "{{ route('users.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('users.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('users.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "User";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns =  ["id", "image", "username", "email", "mobile", "user_type"];
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
        // Load User Types List
        httpService.get("{{ route('userTypes.index') }}").then(response => {
            $('#user_type_id_create').prepend(
                '<option disabled selected>{{ __('app.texts.selectUserType') }}</option>');
            $('#user_type_id_edit').prepend(
                '<option disabled selected>{{ __('app.texts.selectUserType') }}</option>');
            response.data.forEach(element => {
                $('#user_type_id_create').append(new Option(element.user_type, element.id))
                $('#user_type_id_edit').append(new Option(element.user_type, element.id))
            });
        })
    </script>
@endsection