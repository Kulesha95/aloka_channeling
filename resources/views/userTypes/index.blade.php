@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.userTypesManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-user-shield mr-2"></i>{{ __('app.headers.userTypesManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createUserTypeModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
            <thead class="thead-dark">
                <thead>
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.userType') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('userTypes.create')
            @include('userTypes.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        const inputs = ['user_type'];
        const parameterIndexes = {
            "id": 0
        };
        const table = dataTableHandler.initializeTable(
            'items_list_table',
            ["id", "user_type"],
            '/api/v1/userTypes',
            defaultActionContent
        );
        dataTableHandler.handleDelete(table, "{{ route('userTypes.destroy', ':id') }}", parameterIndexes,
            '/api/v1/userTypes'
        );
        const loadData = () => {
            dataTableHandler.loadData(table, '/api/v1/userTypes');
        };
        const loadEditForm = (data) => {
            formHandler.handleShow("editUserTypeForm", inputs, "editUserTypeModal", data,
                parameterIndexes);
        }
        dataTableHandler.handleShow(table, "{{ route('userTypes.show', ':id') }}", parameterIndexes,
            loadEditForm
        );
        formHandler.handleSave("createUserTypeForm", inputs, loadData, "createUserTypeModal");
        formHandler.handleEdit("editUserTypeForm", inputs, loadData, "editUserTypeModal");
    </script>
@endsection