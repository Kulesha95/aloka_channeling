<div class="modal fade" id="editDosageUnitModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-copyright mr-2"></i>{{ __('app.headers.editDosageUnit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editDosageUnitForm" data-action="{{ route('dosageUnits.update', ':id') }}">
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">{{ __('app.fields.name') }}</label>
                        <input id="name_edit" class="form-control" type="text" name="name"
                            placeholder="{{ __('app.fields.name') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="unit">{{ __('app.fields.unit') }}</label>
                        <input id="unit_edit" class="form-control" type="text" name="unit"
                            placeholder="{{ __('app.fields.unit') }}">
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