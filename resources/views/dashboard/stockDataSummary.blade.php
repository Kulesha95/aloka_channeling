<div class="container-fluid">
    <div class="row">
        <div class="card w-100 mx-2">
            <div class="card-header">
                <h4><i class="fas fa-fw fa-cubes mr-2"></i>{{ __('app.dashboard.stockSummary') }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-bordered table-hover" style="width:100%"
                    id="stock_table">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('app.fields.brandName') }}</th>
                            <th>{{ __('app.fields.genericName') }}</th>
                            <th>{{ __('app.fields.reorderLevel') }}</th>
                            <th>{{ __('app.fields.stockQuantity') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        const columnOptions = {
            stock_text: {
                data: {
                    stock: "stock",
                    stock_text: "stock_text",
                    reorder_level: "reorder_level"
                },
                render: (data) => {
                    return data.stock > data.reorder_level ? data.stock_text :
                        `<h6><span class="badge badge-pill badge-warning">${data.stock_text}</span></h6>`;
                }
            }
        }
        const table = dataTableHandler.initializeTable(
            "stock_table",
            ["brand_name", "generic_name", "reorder_level_text", "stock_text"],
            "{{ route('dashboard.stockSummaryData') }}",
            undefined,
            columnOptions
        );
    </script>
@endpush