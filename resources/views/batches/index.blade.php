@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.batchPriceManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-boxes mr-2"></i>{{ __('app.headers.batchPriceManagement') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <table id="batches_list_table" class="table table-sm table-striped table-bordered table-hover"
                style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.brandName') }}</th>
                        <th>{{ __('app.fields.genericName') }}</th>
                        <th>{{ __('app.fields.purchasePrice') }}</th>
                        <th>{{ __('app.fields.sellingPrice') }}</th>
                        <th>{{ __('app.fields.discount') }}</th>
                        <th>{{ __('app.fields.discountedPrice') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('batches.edit')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['batch_id', 'item_brand_name', 'purchase_price_text', 'price', 'discount_type', 'discount_amount'];
        // Load Data URL
        const indexUrl = "{{ route('batches.available') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('batches.show', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Batch";
        // Datatable ID
        const dataTableName = 'batches_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'item_brand_name', 'item_generic_name',
            'purchase_price_text', 'price_text', 'discount_text', 'discounted_price_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const columnOptions = {
            purchase_price_text: {
                className: "text-right"
            },
            price_text: {
                className: "text-right"
            },
            discounted_price_text: {
                className: "text-right"
            },
            discount_text: {
                className: "text-right"
            }
        }
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            editActionContent,
            columnOptions
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