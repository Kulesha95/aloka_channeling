<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="todayAppointmentsCount">0</h3>
                    <p>{{ __('app.dashboard.todayAppointments') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="paymentsPending">0</h3>
                    <p>{{ __('app.dashboard.paymentsPending') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="totalShedulesCount">0</h3>
                    <p>{{ __('app.dashboard.totalSchedules') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        httpService.get("{{ route('dashboard.doctorChannelingsSummary') }}").then(response => {
            $('#todayAppointmentsCount').html(response.data.today_appointments_count);
            $('#paymentsPending').html(response.data.payments_pending);
            $('#totalShedulesCount').html(response.data.total_shedules_count);
        });
    </script>
@endpush