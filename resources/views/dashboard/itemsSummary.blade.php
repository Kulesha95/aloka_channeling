<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="deficitItemsCount">0</h3>
                    <p>{{ __('app.dashboard.deficitItems') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
            <div class="callout callout-warning">
                <h5 class="text-center mx-auto"><u>{{ __('app.dashboard.deficitItems') }}</u></h5>
                <ul class="list-group items-list-callout" id="deficitItemsList">
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="expiredItemsCount">0</h3>
                    <p>{{ __('app.dashboard.expiredItems') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
            <div class="callout callout-danger">
                <h5 class="text-center mx-auto"><u>{{ __('app.dashboard.expiredItems') }}</u></h5>
                <ul class="list-group items-list-callout" id="expiredItemsList">
                </ul>
            </div>
        </div>
    </div>
</div>

@push('js-stack')
    <script>
        httpService.get("{{ route('dashboard.itemsSummaryData') }}").then(response => {
            const deficitItemsList = response.data.deficitItems.map(item =>
                `<li class="list-group-item d-flex justify-content-between align-items-center">${item.brand_name}<span class="badge badge-warning badge-pill">${item.stock_text}</span></li>`
            );
            const expiredItemsList = response.data.expiredItems.map(item =>
                `<li class="list-group-item d-flex justify-content-between align-items-center">${item.item_brand_name}<span class="badge badge-danger badge-pill">${item.returnable_quantity} ${item.item_unit}</span></li>`
            );
            $('#deficitItemsCount').html(response.data.deficitItemsCount);
            $('#deficitItemsList').html(deficitItemsList);
            $('#expiredItemsCount').html(response.data.expiredItemsCount);
            $('#expiredItemsList').html(expiredItemsList);
        });
    </script>
@endpush