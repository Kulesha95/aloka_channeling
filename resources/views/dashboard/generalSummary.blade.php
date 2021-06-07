<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="doctorsCount">0</h3>
                    <p>{{ __('app.dashboard.registeredDoctors') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="patientsCount">0</h3>
                    <p>{{ __('app.dashboard.registeredPatients') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="monthlyAppointments">0</h3>
                    <p>{{ __('app.dashboard.monthlyAppointments') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="monthlyIncome">0</h3>
                    <p>{{ __('app.dashboard.monthlyIncome') }}</p>
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
        httpService.get("{{ route('dashboard.generalDataSummary') }}").then(response => {
            $('#doctorsCount').html(response.data.doctors_count);
            $('#patientsCount').html(response.data.patients_count);
            $('#monthlyIncome').html(response.data.monthly_income);
            $('#monthlyAppointments').html(response.data.monthly_appointments);
        });
    </script>
@endpush