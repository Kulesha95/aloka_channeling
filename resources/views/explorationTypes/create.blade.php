<div class="modal fade" id="createExplorationTypeModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-thermometer mr-2"></i>{{ __('app.headers.createExplorationType') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('explorationTypes.store') }}" method="POST" id="createExplorationTypeForm">
                    <div class="form-group">
                        <label for="exploration_type">{{ __('app.fields.explorationType') }}</label>
                        <input id="exploration_type_create" class="form-control" type="text" name="exploration_type"
                            placeholder="{{ __('app.fields.explorationType') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="unit">{{ __('app.fields.unit') }}</label>
                        <input id="unit_create" class="form-control" type="text" name="unit"
                            placeholder="{{ __('app.fields.unit') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="is_test">{{ __('app.fields.isTest') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_test" id="is_test_create"
                                    value="1">
                                <label class="custom-control-label" for="is_test_create"></label>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="is_test">{{ __('app.fields.isNumericValue') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_numeric_value" id="is_numeric_value_create"
                                    value="1">
                                <label class="custom-control-label" for="is_numeric_value_create"></label>
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