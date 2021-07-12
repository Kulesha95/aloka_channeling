<div class="modal fade" id="editBatchModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-boxes mr-2"></i>{{ __('app.headers.batchPriceManagement') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editBatchForm" data-action="{{ route('batches.update', ':id') }}">
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="item_brand_name">{{ __('app.fields.brandName') }}</label>
                            <input id="item_brand_name_edit" class="form-control" type="text"
                                name="item_brand_name_edit" placeholder="{{ __('app.fields.brandName') }}" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="purchase_price">{{ __('app.fields.purchasePrice') }}</label>
                            <input id="purchase_price_text_edit" class="form-control" type="text" name="purchase_price"
                                placeholder="{{ __('app.fields.purchasePrice') }}" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="price">{{ __('app.fields.sellingPrice') }}</label>
                            <input id="price_edit" class="form-control" type="number" step="0.01" name="price"
                                placeholder="{{ __('app.fields.sellingPrice') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="discount_type">{{ __('app.fields.discountType') }}</label>
                            <select name="discount_type" id="discount_type_edit" class="form-control col-12">
                                <option selected disabled>Select Discount Type</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Rate">Rate</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="discount_amount">{{ __('app.fields.discountAmount') }}</label>
                            <input id="discount_amount_edit" class="form-control" type="text" name="discount_amount"
                                placeholder="{{ __('app.fields.discountAmount') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-edit mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>