<div class="modal fade" id="editExplorationTypeModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-thermometer mr-2"></i>{{ __('app.headers.editExplorationType') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editExplorationTypeForm" data-action="{{ route('explorationTypes.update', ':id') }}">
                    @method('PUT')
                    <div class="form-group">
                        <label for="exploration_type">{{ __('app.fields.explorationType') }}</label>
                        <input id="exploration_type_edit" class="form-control" type="text" name="exploration_type"
                            placeholder="{{ __('app.fields.explorationType') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="unit">{{ __('app.fields.unit') }}</label>
                        <input id="unit_edit" class="form-control" type="text" name="unit"
                            placeholder="{{ __('app.fields.unit') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="is_test">{{ __('app.fields.isTest') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="is_test" id="is_test_edit"
                                value="1">
                            <label class="custom-control-label" for="is_test_edit"></label>
                        </div>
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