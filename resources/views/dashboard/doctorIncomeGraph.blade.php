<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-12">
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
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-fw fa-dollar-sign mr-2"></i>{{ __('app.dashboard.paymentsReceived') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div id="receivedPayments" class="w-100"></div>
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
                type: 'datetime'
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
        var receivedPaymentsChart = new ApexCharts(
            document.querySelector("#receivedPayments"),
            options
        );
        channelingIncomeChart.render();
        receivedPaymentsChart.render();
        httpService.get("{{ route('dashboard.doctorIncomeGraphData') }}").then(response => {
            channelingIncomeChart.updateSeries([{
                name: "Channeling Income",
                data: response.data.channelingIncomeGraphData
            },]);
            receivedPaymentsChart.updateSeries([{
                name: "Payments Received",
                data: response.data.receivedPaymentsGraphData
            },]);
        });
    </script>
@endpush