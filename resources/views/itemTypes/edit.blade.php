<div class="modal fade" id="editItemTypeModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-tag mr-2"></i>{{ __('app.headers.editItemType') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editItemTypeForm" data-action="{{ route('itemTypes.update', ':id') }}">
                    @method('PUT')
                    <div class="form-group">
                        <label for="item_type">{{ __('app.fields.itemType') }}</label>
                        <input id="item_type_edit" class="form-control" type="text" name="item_type"
                            placeholder="{{ __('app.fields.itemType') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('app.fields.description') }}</label>
                        <textarea id="description_edit" class="form-control" name="description"
                            placeholder="{{ __('app.fields.description') }}"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="parent">{{ __('app.fields.parent') }}</label>
                        <select name="parent_id" id="parent_id_edit" class="form-control col-12">
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
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