<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="lastAppointment">N/A</h3>
                    <p>{{ __('app.dashboard.lastAppointment') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="nextAppointment">N/A</h3>
                    <p>{{ __('app.dashboard.nextAppointment') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="reportsPendingAppointments">0</h3>
                    <p>{{ __('app.dashboard.reportsPendingAppointments') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="treatmentsEnd">N/A</h3>
                    <p>{{ __('app.dashboard.treatmentsEnd') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pills"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        httpService.get("{{ route('dashboard.channelingDataSummary') }}").then(response => {
            $('#lastAppointment').html(response.data.lastAppointment);
            $('#nextAppointment').html(response.data.nextAppointment);
            $('#reportsPendingAppointments').html(response.data.reportsPendingAppointments);
            $('#treatmentsEnd').html(response.data.treatmentsEnd);
        });
    </script>
@endpush