@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.schedulesManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-calendar-alt mr-2"></i>{{ __('app.headers.schedulesManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createScheduleModal">
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
                        <th>{{ __('app.fields.doctor') }}</th>
                        <th>{{ __('app.fields.channelingFee') }}</th>
                        <th>{{ __('app.fields.dateFrom') }}</th>
                        <th>{{ __('app.fields.dateTo') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.repeat') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('schedules.create')
            @include('schedules.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['date_from', 'date_to', 'time_from', 'time_to', 'doctor_id', 'channeling_fee', 'repeat'];
        // Load Data URL
        const indexUrl = "{{ route('schedules.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('schedules.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('schedules.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Schedule";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'channel_type', 'doctor', 'channeling_fee_text', 'date_from', 'date_to', 'time',
            'repeat_text'
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
            return `${element.name} - ${element.channel_type} - ${element.commission} Per Appointment`;
        };
        // Render Select2 Options
        const templateResult = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.name}</h6></div><div class="row">${element.channel_type}</div><div class="row font-weight-light">${element.commission} Per Appointment</div>`
            );
        };
        const select2Options = {
            templateResult,
            templateSelection,
            placeholder: "{{ __('app.texts.selectDoctor') }}",
        };
        $('#doctor_id_create').select2(select2Options);
        $('#doctor_id_edit').select2(select2Options);
        // Load Doctors List
        httpService.get("{{ route('doctors.index') }}").then(response => {
            response.data.forEach(element => {
                $('#doctor_id_create').append(new Option(JSON.stringify(element), element.id), false, false)
                $('#doctor_id_edit').append(new Option(JSON.stringify(element), element.id), false, false)
            });
        })
    </script>
@endsection