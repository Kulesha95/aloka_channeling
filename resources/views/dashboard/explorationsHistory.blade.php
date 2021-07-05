<div class="container-fluid">
    <div class="row" id="explorationsContainer"></div>
</div>

@push('js-stack')
    <script>
        httpService.get("{{ route('dashboard.explorationsData') }}").then(response => {
            response.data.explorations.forEach(exploration => {
                $('#explorationsContainer').append(
                    `<div class="col-6">
						<div class="card">
							<div class="card-header">
								<h5><i class="fas fa-fw fa-history mr-2"></i>${exploration.name} History
								</h5>
							</div>
							<div class="card-body">
								<div id="exploration${exploration.id}" class="w-100"></div>
							</div>
						</div>
       				</div>`
                );
                const options = {
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
                                return parseFloat(value).toFixed(2).toLocaleString() +
                                    ` ${exploration.unit}`;
                            }
                        },
                    },
                }
                const chart = new ApexCharts(
                    document.querySelector(`#exploration${exploration.id}`),
                    options
                );
                chart.render();
                chart.updateSeries([{
                    name: exploration.name,
                    data: exploration.values
                }]);
            });
        });
    </script>
@endpush