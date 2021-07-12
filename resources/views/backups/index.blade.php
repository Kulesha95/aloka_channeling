@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.backupsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-database mr-2"></i>{{ __('app.headers.backupsManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" onclick="createBackup()">
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
                            <th>{{ __('app.fields.name') }}</th>
                            <th>{{ __('app.fields.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Load Data URL
        const indexUrl = "{{ route('backups.index') }}";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ["name", 'path'];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const columnOptions = {
            path: {
                data: 'path',
                render: (data) => {
                    return `<a href='${data}' class='btn btn-primary'><i class='fas fa-download fa-fw mr-2' ></i>Download</a><button data-delete='${data}' class='btn btn-danger ml-2 delete-button'><i class='fas fa-trash fa-fw mr-2' ></i>Delete</button>`;
                }
            }
        }
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            undefined,
            columnOptions
        );
        // Load Data To The Table
        const loadData = () => {
            dataTableHandler.loadData(table, indexUrl);
        };
        const createBackup = () => {
            httpService.post("{{ route('backups.store') }}").then(response => {
                loadData();
                messageHandler.successMessage(response.message);
            })
        }
        table.on("click", ".delete-button", function() {
            // Get Selected Row Data
            const data = table.row($(this).parents("tr")).data();
            console.log(data);
            httpService.post("{{ route('backups.destroy') }}", {
                path: data.path
            }).then(response => {
                loadData();
                messageHandler.successMessage(response.message);
            })
        });
    </script>
@endsection