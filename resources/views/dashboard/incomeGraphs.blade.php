<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-heart mr-2"></i>{{ __('app.dashboard.dailyChannelingIncome') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="channelingIncome" class="w-100"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-pills mr-2"></i>{{ __('app.dashboard.dailyPharmacyIncome') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="pharmacyIncome" class="w-100"></div>
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
        var channelingIncomeChart = new ApexCharts(
            document.querySelector("#channelingIncome"),
            options
        );
        var pharmacyIncomeChart = new ApexCharts(
            document.querySelector("#pharmacyIncome"),
            options
        );
        channelingIncomeChart.render();
        pharmacyIncomeChart.render();
        httpService.get("{{ route('dashboard.incomeGraphData') }}").then(response => {
            channelingIncomeChart.updateSeries([{
                name: "Channeling Income",
                data: response.data.channelingIncomeGraphData
            }]);
            pharmacyIncomeChart.updateSeries([{
                name: "Pharmacy Income",
                data: response.data.pharmacyIncomeGraphData
            }]);
        });
    </script>
@endpush