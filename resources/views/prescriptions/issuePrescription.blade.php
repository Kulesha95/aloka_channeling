<div class="modal fade" id="issuePrescriptionModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.issuePrescriptionItems') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="batch_list_table_paid_prescription"
                    class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                        <tr>
                            <th>{{ __('app.fields.genericName') }}</th>
                            <th>{{ __('app.fields.brandName') }}</th>
                            <th>{{ __('app.fields.price') }}</th>
                            <th>{{ __('app.fields.quantity') }}</th>
                            <th>{{ __('app.fields.total') }}</th>
                        </tr>
                        </tr>
                    </thead>
                </table>
                <hr>
                <div class="row mt-2 mr-2">
                    <h5 class="font-weight-bold ml-auto mr-2">{{ __('app.fields.total') }} :</h5>
                    <h5 id="total_price_paid_prescription"></h5>
                </div>
                <hr>
                <div class="row">
                    <button href="button" class="btn btn-primary ml-auto mr-2 text-light"
                        onclick="openPrescriptionDocumentView()"><i class="fa fa-print mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.print') }}</button>
                    <button type="submit" class="btn btn-success mr-2"
                        onclick="handleStatusUpdatePaidPrescription({{ $issued }})"><i class="fa fa-gift mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.issue') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        // Prescriptions Datatable ID
        const dataTableNamePaidPrescriptionItemss = 'batch_list_table_paid_prescription';
        // Load Data URL
        const indexUrlPrescriptionItems = "{{ route('prescriptions.batches', ':id') }}";
        // Prescriptions Table Columns List
        const dataTableColumnsPaidPrescriptionItemss = ["generic_name", "brand_name", "price_text", "quantity_text",
            "total_text"
        ];
        let currentPaidPrescriptionId = 0;
        const columnOptionsIssue = {
            price_text: {
                className: "text-right"
            },
            total_text: {
                className: "text-right"
            }
        }
        // Initialize Data Table
        const tablePaidPrescriptionItemss = dataTableHandler.initializeTable(
            dataTableNamePaidPrescriptionItemss,
            dataTableColumnsPaidPrescriptionItemss,
            null,
            null,
            columnOptionsIssue
        );
        const openPrescriptionDocumentView = () => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'prescription', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', currentPaidPrescriptionId));
        }
        const loadpaidPrescriptionItems = (data) => {
            currentPaidPrescriptionId = data.id;
            httpService.get(indexUrlPrescriptionItems.replace(':id', currentPaidPrescriptionId)).then(response => {
                dataTableHandler.fillData(tablePaidPrescriptionItemss, response.data.items);
                $('#total_price_paid_prescription').html(response.data.total_text);
            })
        }
        const clearPaidPrescriptionData = () => {
            currentPaidPrescriptionId = 0;
            dataTableHandler.fillData(tablePaidPrescriptionItemss, []);
            $('#total_price_paid_prescription').html("0.00");
            $('#issuePrescriptionModel').modal('hide');
            refreshData();
        }
        const handleStatusUpdatePaidPrescription = (status) => {
            httpService.put("{{ route('prescriptions.updateStatus', ':id') }}".replace(':id',
                currentPaidPrescriptionId), {
                status,
                _method: "PUT"
            }).then((response) => {
                clearPaidPrescriptionData();
                messageHandler.successMessage(response.message);
            }).catch(() => {
                refreshData();
            });
        }
    </script>
@endpush