<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-user-md mr-2"></i>{{ __('app.dashboard.doctorPayments') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="doctorPayments" class="w-100"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-truck-loading mr-2"></i>{{ __('app.dashboard.supplierPayments') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="supplierPayments" class="w-100"></div>
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
        var doctorPaymentsChart = new ApexCharts(
            document.querySelector("#doctorPayments"),
            options
        );
        var supplierPaymentsChart = new ApexCharts(
            document.querySelector("#supplierPayments"),
            options
        );
        doctorPaymentsChart.render();
        supplierPaymentsChart.render();
        httpService.get("{{ route('dashboard.expenseGraphData') }}").then(response => {
            doctorPaymentsChart.updateSeries([{
                name: "Doctor Payments",
                data: response.data.doctorPaymentsGraphData
            }]);
            supplierPaymentsChart.updateSeries([{
                name: "Supplier Payments",
                data: response.data.supplierPaymentsGraphData
            }]);
        });
    </script>
@endpush