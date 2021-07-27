<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="totalPrescriptions">0</h3>
                    <p>{{ __('app.dashboard.totalPrescriptions') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-copy"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="prescriptionBills">0</h3>
                    <p>{{ __('app.dashboard.prescriptionBills') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-prescription"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="internalPrescriptions">0</h3>
                    <p>{{ __('app.dashboard.internalPrescriptions') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hospital-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="paidPrescriptions">0</h3>
                    <p>{{ __('app.dashboard.paidPrescriptions') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        httpService.get("{{ route('dashboard.prescriptionsDataSummary') }}").then(response => {
            $('#totalPrescriptions').html(response.data.total_prescriptions);
            $('#prescriptionBills').html(response.data.prescription_bills);
            $('#internalPrescriptions').html(response.data.internal_prescriptions);
            $('#paidPrescriptions').html(response.data.paid_prescriptions);
        });
    </script>
@endpush