<div class="modal fade" id="paymentPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel"><i
                        class="fas fa-fw fa-hand-holding-usd mr-2"></i>{{ __('app.headers.pharmacyPayments') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('prescription.incomes.store', ':id') }}" method="POST"
                    id="paymentPrescriptionForm">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="total">{{ __('app.fields.total') }}</label>
                            <input id="total_pharmacy_payment" class="form-control" type="text"
                                placeholder="{{ __('app.fields.total') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="paid">{{ __('app.fields.paid') }}</label>
                            <input id="paid_pharmacy_payment" class="form-control" type="text"
                                placeholder="{{ __('app.fields.paid') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="balance">{{ __('app.fields.balance') }}</label>
                            <input id="balance_pharmacy_payment" class="form-control" type="text"
                                placeholder="{{ __('app.fields.balance') }}" readonly>
                        </div>
                    </div>
                    @if (Auth::user()->user_type_id == $receptionist)
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="reason">{{ __('app.fields.reason') }}</label>
                                <input id="reason_pharmacy_payment" class="form-control" type="text" name="reason"
                                    placeholder="{{ __('app.fields.reason') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="amount">{{ __('app.fields.amount') }}</label>
                                <input id="amount_pharmacy_payment" class="form-control" type="number" step="0.01" name="amount"
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
                <table id="pharmacy_payments_list_table" class="table table-sm table-striped table-bordered table-hover"
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
    let pharmacyPaymentsTable;
    let prescriptionNumber;
    let prescriptionId;
    const pharmacyPaymentDocumentUrl =
        "{{ route('documents.getPdf', ['type' => 'channelingPayments', 'id' => ':id', 'action' => 'view']) }}";
    document.addEventListener('DOMContentLoaded', () => {
        pharmacyPaymentsTable = dataTableHandler.initializeTable(
            "pharmacy_payments_list_table",
            ["id", "invoice_number", "reason", "date", "time", "amount_text"],
            null,
            null
        );
        formHandler.handleSave(`paymentPrescriptionForm`, ["reason", "amount"], loadPharmacyPaymentTableData, null,
            "_pharmacy_payment");
        $('#print-button').click(() => {
            window.open(pharmacyPaymentDocumentUrl.replace(':id', prescriptionId));
        });
    });
    const loadPharmacyPaymentInfo = (data) => {
        pharmacyPaymentUrl = $(`#paymentPrescriptionForm`).data("action");
        pharmacyPaymentUrl = pharmacyPaymentUrl.replace(`:id`, data.prescription.id);
        $(`#paymentPrescriptionForm`).attr("action", pharmacyPaymentUrl);
        $(`#amount_pharmacy_payment`).val(data.prescription.status === parseInt("{{ $rejected }}") ? data.prescription
            .paid * -1 : data.prescription
            .balance);
        $(`#total_pharmacy_payment`).val(data.prescription.total_text);
        $(`#paid_pharmacy_payment`).val(data.prescription.paid_text);
        $(`#balance_pharmacy_payment`).val(data.prescription.balance_text);
        $(`#paymentPrescriptionModal`).modal("show");
        prescriptionNumber = data.prescription.prescription_number + " - Payment";
        prescriptionId = data.prescription.id;
        loadPharmacyPaymentTableData();
    }
    const loadPharmacyPaymentTableData = () => {
        $(`#reason_pharmacy_payment`).val(prescriptionNumber);
        dataTableHandler.loadData(pharmacyPaymentsTable, pharmacyPaymentUrl);
        loadDataPharmacyPayment();
    }
</script>