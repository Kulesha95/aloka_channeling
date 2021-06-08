<div class="modal fade" id="createDosageUnitModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-copyright mr-2"></i>{{ __('app.headers.createDosageUnit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dosageUnits.store') }}" method="POST" id="createDosageUnitForm">
                    <div class="form-group">
                        <label for="name">{{ __('app.fields.name') }}</label>
                        <input id="name_create" class="form-control" type="text" name="name"
                            placeholder="{{ __('app.fields.name') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="unit">{{ __('app.fields.unit') }}</label>
                        <input id="unit_create" class="form-control" type="text" name="unit"
                            placeholder="{{ __('app.fields.unit') }}">
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