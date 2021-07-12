<div class="modal fade" id="createDisposalModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-recycle mr-2"></i>{{ __('app.headers.createDisposal') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('disposals.store') }}" method="POST" id="createDisposalForm">
                    <table id="disposals_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.brandName') }}</th>
                                <th>{{ __('app.fields.returnableQuantity') }}</th>
                                <th>{{ __('app.fields.price') }}</th>
                                <th>{{ __('app.fields.disposedQuantity') }}</th>
                                <th>{{ __('app.fields.disposedReason') }}</th>
                                <th>{{ __('app.fields.actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        // Datatable ID
        const dataTableNameDisposals = 'disposals_list_table';
        // Table Columns List
        const dataTableColumnsDisposals = ["item_brand_name", "returnable_quantity",
            "purchase_price_text",
            "return_quantity", "return_reason"
        ];
        const columnOptions = {
            returnable_quantity: {
                render: (data, type, row, meta) => {
                    return `${data} ${row.item_unit}`;
                }
            },
            return_quantity: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input type="hidden" name="batch_id[${meta.row}]" value="${data}"><input type="number" step="0.01" class="form-control" name="return_quantity[${meta.row}]" placeholder="{{ __('app.fields.returnQuantity') }}" value="0">`;
                }
            },
            return_reason: {
                data: "id",
                render: (data, type, row, meta) => {
                    return `<input class="form-control" name="return_reason[${meta.row}]" placeholder="{{ __('app.fields.returnReason') }}" value="Expired">`;
                }
            }
        }
        const tableDisposals = dataTableHandler.initializeTable(
            dataTableNameDisposals,
            dataTableColumnsDisposals,
            undefined,
            "<button type='button' class='btn btn-sm btn-outline-success mr-1 copy-button'><i class='fas fa-copy fa-fw' ></i></button>",
            columnOptions
        );
        const openCreateDisposalModal = () => {
            httpService.get("{{ route('batches.returnable') }}").then(response => {
                dataTableHandler.fillData(tableDisposals, response.data);
            })
            $(`#createDisposalModal`).modal("show");
        }
        const cloneItem = (data) => {
            tableDisposals.row.add(data).draw();
        }
        dataTableHandler.handleCustomTableData(tableDisposals,
            cloneItem, 'copy-button');
        $('#createDisposalForm').on('submit', e => {
            e.preventDefault();
            formData = new FormData();
            var params = tableDisposals.$('input,select').serializeArray();
            $.each(params, function() {
                if (!$.contains(document, '#createDisposalForm')) {
                    formData.append(this.name, this.value);
                }
            });
            httpService.post($(`#createDisposalForm`).attr("action"), formData)
                .then((response) => {
                    $('#createDisposalForm').trigger("reset");
                    $(`#createDisposalModal`).modal("hide");
                    messageHandler.successMessage(response.message);
                    loadData();
                });
        })
    </script>
@endpush