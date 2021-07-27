<div class="modal fade" id="expenseSupplierModal" tabindex="-1" role="dialog" aria-labelledby="expenseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModalLabel"><i
                        class="fas fa-fw fa-truck-loading mr-2"></i>{{ __('app.headers.supplierPayments') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('goodReceive.expenses.store', ':id') }}" method="POST"
                    id="expenseSupplierForm">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="fee">{{ __('app.fields.fee') }}</label>
                            <input id="fee_expense" class="form-control" type="text"
                                placeholder="{{ __('app.fields.fee') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="paid">{{ __('app.fields.paid') }}</label>
                            <input id="paid_expense" class="form-control" type="text"
                                placeholder="{{ __('app.fields.paid') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="balance">{{ __('app.fields.balance') }}</label>
                            <input id="balance_expense" class="form-control" type="text"
                                placeholder="{{ __('app.fields.balance') }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="reason">{{ __('app.fields.reason') }}</label>
                            <input id="reason_expense" class="form-control" type="text" name="reason"
                                placeholder="{{ __('app.fields.reason') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="amount">{{ __('app.fields.amount') }}</label>
                            <input id="amount_expense" class="form-control" type="number" step="0.01" name="amount"
                                placeholder="{{ __('app.fields.amount') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-dollar-sign mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.pay') }}</button>
                    </div>
                </form>
                <hr>
                <table id="expenses_list_table" class="table table-sm table-striped table-bordered table-hover"
                    style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.id') }}</th>
                            <th>{{ __('app.fields.voucherNumber') }}</th>
                            <th>{{ __('app.fields.reason') }}</th>
                            <th>{{ __('app.fields.date') }}</th>
                            <th>{{ __('app.fields.time') }}</th>
                            <th>{{ __('app.fields.amount') }}</th>
                        </tr>
                    </thead>
                </table>
                <div class="row m-1">
                    <button type="button" class="btn btn-success ml-auto" id="print-button"><i class="fas fa-print mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.print') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let expensesTable;
    let appointmentNumber;
    let appointmentId;
    const documentUrl =
        "{{ route('documents.getPdf', ['type' => 'supplierPayments', 'id' => ':id', 'action' => 'view']) }}";
    document.addEventListener('DOMContentLoaded', () => {
        expensesTable = dataTableHandler.initializeTable(
            "expenses_list_table",
            ["id", "voucher_number", "reason", "date", "time", "amount_text"],
            null,
            null, {
                amount_text: {
                    className: "text-right"
                }
            }
        );
        formHandler.handleSave(`expenseSupplierForm`, ["reason", "amount"], loadSupplierExpenseTableData, null,
            "_expense");
        $('#print-button').click(() => {
            window.open(documentUrl.replace(':id', appointmentId));
        });
    });
    const loadSupplierExpenseInfo = (data) => {
        expenseUrl = $(`#expenseSupplierForm`).data("action");
        expenseUrl = expenseUrl.replace(`:id`, data.id);
        $(`#expenseSupplierForm`).attr("action", expenseUrl);
        $(`#amount_expense`).val(data.balance);
        $(`#fee_expense`).val(data.total_text);
        $(`#paid_expense`).val(data.paid_text);
        $(`#balance_expense`).val(data.balance_text);
        $(`#expenseSupplierModal`).modal("show");
        appointmentNumber = data.good_receive_number + " - Payment";
        appointmentId = data.id;
        loadSupplierExpenseTableData();
    }
    const loadSupplierExpenseTableData = () => {
        $(`#reason_expense`).val(appointmentNumber);
        dataTableHandler.loadData(expensesTable, expenseUrl);
        loadData();
    }
</script>