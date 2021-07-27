<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-hospital-alt mr-2"></i>{{ __('app.dashboard.internalPrescriptionsSales') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="internalPrescriptionsSales" class="w-100"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-external-link-square-alt mr-2"></i>{{ __('app.dashboard.externalPrescriptionsSales') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="externalPrescriptionsSales" class="w-100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        var options = {
            chart: {
                height: 350,
                type: 'area',
            },
            dataLabels: {
                enabled: false
            },
            series: [],
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'MMM dd',
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return "Rs." + parseFloat(value).toFixed(2).toLocaleString();
                    }
                },
            },
        }
        var internalPrescriptionsSales = new ApexCharts(
            document.querySelector("#internalPrescriptionsSales"),
            options
        );
        var externalPrescriptionsSales = new ApexCharts(
            document.querySelector("#externalPrescriptionsSales"),
            options
        );
        internalPrescriptionsSales.render();
        externalPrescriptionsSales.render();
        httpService.get("{{ route('dashboard.pharmacySalesGraphData') }}").then(response => {
            internalPrescriptionsSales.updateSeries([{
                name: "Internal Prescriptions Sales",
                data: response.data.internalPrescriptionsSales
            }]);
            externalPrescriptionsSales.updateSeries([{
                name: "External Prescriptions Sales",
                data: response.data.externalPrescriptionsSales
            }]);
        });
    </script>
@endpush