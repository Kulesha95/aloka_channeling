@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.prescriptionsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.prescriptionsManagement') }}
                </h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createPrescriptionModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.prescriptionNumber') }}</th>
                        <th>{{ __('app.fields.date') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.prescriptionType') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                    </tr>
                </thead>
            </table>
            @include('prescriptions.create')
            @include('prescriptions.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['prescription_type', 'comment'];
        // Load Data URL
        const indexUrl = "{{ route('prescriptions.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('prescriptions.show', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('prescriptions.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Prescription";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ["id", "prescription_number", "date", "time", "prescription_type_text"];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        // View Button
        const actionContents =
            "<button class='btn btn-sm btn-outline-info mr-1 view-button'><i class='fas fa-eye fa-fw' ></i></button>"
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            actionContents + defaultActionContent
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
                parameterIndexes,
                '_prescription_edit'
            );
        }
        $('#comment_prescription_create').summernote();
        $('#comment_prescription_edit').summernote();
        // Open Selected Prescription
        const openPrescription = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'prescription', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.id));
        }
        // Handle Edit Button Click Event In Data Table
        dataTableHandler.handleShow(table, viewUrl, parameterIndexes, loadEditForm);
        // Handle Create Form Submit
        formHandler.handleSave(`create${model}Form`, inputs, loadData, `create${model}Modal`,
            '_prescription_create');
        // Handle Edit Form Submit
        formHandler.handleEdit(`edit${model}Form`, inputs, loadData, `edit${model}Modal`,
            '_prescription_edit');
        // Handle Prescription View Button Click
        dataTableHandler.handleCustom(table, viewUrl, parameterIndexes, openPrescription, 'view-button');
    </script>
@endsection