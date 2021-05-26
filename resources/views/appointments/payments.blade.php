<div class="modal fade" id="paymentAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel"><i
                        class="fas fa-fw fa-dollar-sign mr-2"></i>{{ __('app.headers.appointmentPayments') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('appointment.incomes.store', ':id') }}" method="POST"
                    id="paymentAppointmentForm">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="fee">{{ __('app.fields.fee') }}</label>
                            <input id="fee_payment" class="form-control" type="text"
                                placeholder="{{ __('app.fields.fee') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="paid">{{ __('app.fields.paid') }}</label>
                            <input id="paid_payment" class="form-control" type="text"
                                placeholder="{{ __('app.fields.paid') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="balance">{{ __('app.fields.balance') }}</label>
                            <input id="balance_payment" class="form-control" type="text"
                                placeholder="{{ __('app.fields.balance') }}" readonly>
                        </div>
                    </div>
                    @if (Auth::user()->user_type_id == $receptionist)
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="reason">{{ __('app.fields.reason') }}</label>
                                <input id="reason_payment" class="form-control" type="text" name="reason"
                                    placeholder="{{ __('app.fields.reason') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="amount">{{ __('app.fields.amount') }}</label>
                                <input id="amount_payment" class="form-control" type="number" step="0.01" name="amount"
                                    placeholder="{{ __('app.fields.amount') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row m-1">
                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-dollar-sign mr-1"
                                    aria-hidden="true"></i>{{ __('app.buttons.pay') }}</button>
                        </div>
                    @endif
                </form>
                <hr>
                <table id="payments_list_table" class="table table-sm table-striped table-bordered table-hover"
                    style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.id') }}</th>
                            <th>{{ __('app.fields.invoiceNumber') }}</th>
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
    let paymentsTable;
    let appointmentNumber;
    let appointmentId;
    const documentUrl =
        "{{ route('documents.getPdf', ['type' => 'channelingPayments', 'id' => ':id', 'action' => 'view']) }}";
    document.addEventListener('DOMContentLoaded', () => {
        paymentsTable = dataTableHandler.initializeTable(
            "payments_list_table",
            ["id", "invoice_number", "reason", "date", "time", "amount_text"],
            null,
            null
        );
        formHandler.handleSave(`paymentAppointmentForm`, ["reason", "amount"], loadPaymentTableData, null,
            "_payment");
        $('#print-button').click(() => {
            window.open(documentUrl.replace(':id', appointmentId));
        });
    });
    const loadPaymentInfo = (data) => {
        paymentUrl = $(`#paymentAppointmentForm`).data("action");
        paymentUrl = paymentUrl.replace(`:id`, data.appointment.id);
        $(`#paymentAppointmentForm`).attr("action", paymentUrl);
        $(`#amount_payment`).val(data.appointment.balance);
        $(`#fee_payment`).val(data.appointment.fee_text);
        $(`#paid_payment`).val(data.appointment.paid_text);
        $(`#balance_payment`).val(data.appointment.balance_text);
        $(`#paymentAppointmentModal`).modal("show");
        appointmentNumber = data.appointment.appointment_number + " - Payment";
        appointmentId = data.appointment.id;
        loadPaymentTableData();
    }
    const loadPaymentTableData = () => {
        $(`#reason_payment`).val(appointmentNumber);
        dataTableHandler.loadData(paymentsTable, paymentUrl);
        loadData();
    }
</script>