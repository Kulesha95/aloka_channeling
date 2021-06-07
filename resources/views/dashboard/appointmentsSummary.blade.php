<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="totalAppointments">0</h3>
                    <p>{{ __('app.dashboard.totalAppointments') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-copy"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="confirmationsPending">0</h3>
                    <p>{{ __('app.dashboard.confirmationsPending') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="paymentsPending">0</h3>
                    <p>{{ __('app.dashboard.paymentsPending') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="rejectedAppointments">0</h3>
                    <p>{{ __('app.dashboard.rejectedAppointments') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        httpService.get("{{ route('dashboard.appointmentsDataSummary') }}").then(response => {
            $('#totalAppointments').html(response.data.total_appointments);
            $('#confirmationsPending').html(response.data.confirmations_pending);
            $('#paymentsPending').html(response.data.payments_pending);
            $('#rejectedAppointments').html(response.data.rejected_appointments);
        });
    </script>
@endpush