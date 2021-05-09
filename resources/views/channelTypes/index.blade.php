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
        const inputs = ['channel_type'];
        const parameterIndexes = {
            "id": 0
        };
        const table = dataTableHandler.initializeTable(
            'items_list_table',
            ["id", "channel_type"],
            '/api/v1/channelTypes',
            defaultActionContent
        );
        dataTableHandler.handleDelete(table, "{{ route('channelTypes.destroy', ':id') }}", parameterIndexes,
            '/api/v1/channelTypes'
        );
        const loadData = () => {
            dataTableHandler.loadData(table, '/api/v1/channelTypes');
        };
        const loadEditForm = (data) => {
            formHandler.handleShow("editChannelTypeForm", inputs, "editChannelTypeModal", data,
                parameterIndexes);
        }
        dataTableHandler.handleShow(table, "{{ route('channelTypes.show', ':id') }}", parameterIndexes,
            loadEditForm
        );
        formHandler.handleSave("createChannelTypeForm", inputs, loadData, "createChannelTypeModal");
        formHandler.handleEdit("editChannelTypeForm", inputs, loadData, "editChannelTypeModal");
    </script>
@endsection