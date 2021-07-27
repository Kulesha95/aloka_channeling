<div class="modal fade" id="scheduleExceptionsModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-calendar-times mr-2"></i>{{ __('app.headers.exceptionsManagement') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('schedule.exceptions.index', ':id') }}" method=" POST"
                    id="scheduleExceptionsForm">
                    <div class="form-group">
                        <label for="colour">{{ __('app.fields.date') }}</label>
                        <input id="date_exception_create" class="form-control" type="date" name="date"
                            placeholder="{{ __('app.fields.date') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
                <hr>
                <table id="schedule_exceptions_table" class="table table-sm table-striped table-bordered table-hover"
                    style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.id') }}</th>
                            <th>{{ __('app.fields.date') }}</th>
                            <th>{{ __('app.fields.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        // Create And Edit Forms Inputs
        const inputsItems = ['date'];
        // Load Data URL
        const indexUrlItems =
            "{{ route('schedule.exceptions.index', ['schedule' => ':schedule']) }}";
        // Delete Data URL
        const deleteUrlItems =
            "{{ route('schedule.exceptions.destroy', ['schedule' => ':schedule', 'exception' => ':id']) }}";
        // Datatable ID
        const dataTableNameItems = 'schedule_exceptions_table';
        // Table Columns List
        const dataTableColumnsItems = ["id", "date"];
        // Column Indexes For URL Parameters
        const parameterIndexesItems = {
            "id": 0
        };
        let currentSchedule = 0;
        // Initialize Data Table
        const tableItems = dataTableHandler.initializeTable(
            dataTableNameItems,
            dataTableColumnsItems,
            null,
            deleteActionContent
        );
        // Load Data To The Table
        const loadDataItems = () => {
            dataTableHandler.loadData(tableItems, indexUrlItems.replace(':schedule',
                currentSchedule));
        };
        // Handle Create Form Submit
        formHandler.handleSave("scheduleExceptionsForm", inputsItems, loadDataItems, null, "_exception_create");
        const openExceptionsManagement = (data) => {
            currentSchedule = data.id;
            loadDataItems();
            dataTableHandler.fillData(tableItems, []);
            // Delete Item
            dataTableHandler.handleDelete(
                tableItems,
                deleteUrlItems.replace(':schedule', currentSchedule),
                parameterIndexesItems,
                indexUrlItems.replace(':schedule', currentSchedule)
            );
            let itemsAddUrl = $(`#scheduleExceptionsForm`).data("action");
            itemsAddUrl = itemsAddUrl.replace(`:id`, currentSchedule);
            $(`#scheduleExceptionsForm`).attr("action", itemsAddUrl);
            $('#scheduleExceptionsModal').modal('show');
        }
    </script>
@endpush