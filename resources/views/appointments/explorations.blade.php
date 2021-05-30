<div class="modal fade" id="createExplorationsModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-weight mr-2"></i>{{ __('app.headers.addExplorations') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('explorations.storeReceptionist', ':id') }}" method="POST"
                    id="createExplorationForm">
                    <div class="form-group">
                        <label for="height">{{ __('app.fields.height') }}</label>
                        <div class="input-group">
                            <input id="height_create" class="form-control" type="text" name="height"
                                placeholder="{{ __('app.fields.height') }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">m</div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="weight">{{ __('app.fields.weight') }}</label>
                        <div class="input-group">
                            <input id="weight_create" class="form-control" type="text" name="weight"
                                placeholder="{{ __('app.fields.weight') }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Kg</div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bmi">{{ __('app.fields.bmi') }}</label>
                        <div class="input-group">
                            <input id="bmi_create" class="form-control" type="text" name="bmi"
                                placeholder="{{ __('app.fields.bmi') }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Kg/m2</div>
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

<script>
    const openAddExplorations = (data) => {
        let explorationUrl = $(`#createExplorationForm`).data("action");
        explorationUrl = explorationUrl.replace(`:id`, data.appointment.patient_id);
        $(`#createExplorationForm`).attr("action", explorationUrl);
        $('#createExplorationsModal').modal('show');
    }
</script>