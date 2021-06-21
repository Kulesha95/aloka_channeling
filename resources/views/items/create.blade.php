<div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-pills mr-2"></i>{{ __('app.headers.createItem') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('items.store') }}" method="POST" id="createItemForm">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="generic_name_id">{{ __('app.fields.genericName') }}</label>
                            <select name="generic_name_id" id="generic_name_id_create" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="brand_name">{{ __('app.fields.brandName') }}</label>
                            <input id="brand_name_create" class="form-control" type="text" name="brand_name"
                                placeholder="{{ __('app.fields.brandName') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="reorder_level">{{ __('app.fields.reorderLevel') }}</label>
                            <input id="reorder_level_create" class="form-control" type="number" step="0.01"
                                name="reorder_level" placeholder="{{ __('app.fields.reorderLevel') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="reorder_quantity">{{ __('app.fields.reorderQuantity') }}</label>
                            <input id="reorder_quantity_create" class="form-control" type="number" step="0.01"
                                name="reorder_quantity" placeholder="{{ __('app.fields.reorderQuantity') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="item_type_id">{{ __('app.fields.itemType') }}</label>
                            <select name="item_type_id" id="item_type_id_create" class="form-control col-12">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="unit">{{ __('app.fields.unit') }}</label>
                            <input id="unit_create" class="form-control" type="text" name="unit"
                                placeholder="{{ __('app.fields.unit') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="form-group col-6">
                            <label for="is_purchase_item">{{ __('app.fields.isPurchaseItem') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_purchase_item" id="is_purchase_item_create"
                                    value="1">
                                <label class="custom-control-label" for="is_purchase_item_create"></label>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="is_sales_item">{{ __('app.fields.isSalesItem') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_sales_item" id="is_sales_item_create"
                                    value="1">
                                <label class="custom-control-label" for="is_sales_item_create"></label>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>