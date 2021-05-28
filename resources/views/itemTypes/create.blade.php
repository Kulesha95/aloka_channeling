<div class="modal fade" id="createItemTypeModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-tag mr-2"></i>{{ __('app.headers.createItemType') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('itemTypes.store') }}" method="POST" id="createItemTypeForm">
                    <div class="form-group">
                        <label for="item_type">{{ __('app.fields.itemType') }}</label>
                        <input id="item_type_create" class="form-control" type="text" name="item_type"
                            placeholder="{{ __('app.fields.itemType') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('app.fields.description') }}</label>
                        <textarea id="description_create" class="form-control" name="description"
                            placeholder="{{ __('app.fields.description') }}"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="colour">{{ __('app.fields.parent') }}</label>
                        <select name="parent_id" id="parent_id_create" class="form-control col-12">
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
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