<div class="modal fade" id="createChanelResonsModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-heartbeat mr-2"></i>{{ __('app.headers.channelReasonsManagement') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('channelType.channelReasons.index', ':id') }}" method=" POST"
                    id="createChanelResonsForm">
                    <div class="form-group">
                        <label for="reason">{{ __('app.fields.reason') }}</label>
                        <input id="reason_create" class="form-control" type="text" name="reason"
                            placeholder="{{ __('app.fields.reason') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
                <hr>
                <table id="items_list_table_channel_reasons"
                    class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.id') }}</th>
                            <th>{{ __('app.fields.reason') }}</th>
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
        const inputsChannelReasons = ['reason'];
        // Load Data URL
        const indexUrlChannelReasons =
            "{{ route('channelType.channelReasons.index', ['channelType' => ':channelType']) }}";
        // Delete Data URL
        const deleteUrlChannelReasons =
            "{{ route('channelType.channelReasons.destroy', ['channelType' => ':channelType', 'channelReason' => ':id']) }}";
        // Datatable ID
        const dataTableNameChannelReasons = 'items_list_table_channel_reasons';
        // Table Columns List
        const dataTableColumnsChannelReasons = ["id", "reason"];
        // Column Indexes For URL Parameters
        const parameterIndexesChannelReasons = {
            "id": 0
        };
        let currentChannelType = 0;
        // Initialize Data Table
        const tableChannelReasons = dataTableHandler.initializeTable(
            dataTableNameChannelReasons,
            dataTableColumnsChannelReasons,
            null,
            deleteActionContent
        );
        // Load Data To The Table
        const loadDataChannelReasons = () => {
            dataTableHandler.loadData(tableChannelReasons, indexUrlChannelReasons.replace(':channelType',
                currentChannelType));
        };
        // Handle Create Form Submit
        formHandler.handleSave("createChanelResonsForm", inputsChannelReasons, loadDataChannelReasons, null);
        const openChannelingResonsManagement = (data) => {
            currentChannelType = data.id;
            loadDataChannelReasons();
            // Delete Item
            dataTableHandler.handleDelete(
                tableChannelReasons,
                deleteUrlChannelReasons.replace(':channelType', currentChannelType),
                parameterIndexesChannelReasons,
                indexUrlChannelReasons.replace(':channelType', currentChannelType)
            );
            let reasonCreateUrl = $(`#createChanelResonsForm`).data("action");
            reasonCreateUrl = reasonCreateUrl.replace(`:id`, currentChannelType);
            $(`#createChanelResonsForm`).attr("action", reasonCreateUrl);
            $('#createChanelResonsModel').modal('show');
        }
    </script>
@endpush