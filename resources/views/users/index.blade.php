@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">{{ __('app.headers.home') }}</a></li>
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
                <table id="items_list_table" class="table display responsive nowrap" width="100%">
                    <thead>
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
        const inputs = ["id", "username", "email", "mobile", "user_type_id", "image"];
        const parameterIndexes = {
            "id": 0
        };
        const table = dataTableHandler.initializeTable(
            'items_list_table',
            ["id", "image", "username", "email", "mobile", "user_type"],
            '/api/v1/users',
            defaultActionContent
        );
        dataTableHandler.handleDelete(table, "{{ route('users.destroy', ':id') }}", parameterIndexes,
            '/api/v1/users'
        );
        const loadData = () => {
            dataTableHandler.loadData(table, '/api/v1/users');
        };
        const loadEditForm = (data) => {
            formHandler.handleShow("editUserForm", inputs, "editUserModal", data,
                parameterIndexes);
        }
        dataTableHandler.handleShow(table, "{{ route('users.show', ':id') }}", parameterIndexes,
            loadEditForm
        );
        formHandler.handleSave("createUserForm", inputs, loadData, "createUserModal");
        formHandler.handleEdit("editUserForm", inputs, loadData, "editUserModal");
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