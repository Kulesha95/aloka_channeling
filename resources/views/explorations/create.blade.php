<div class="modal fade" id="createExplorationModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-weight mr-2"></i>{{ __('app.headers.createExploration') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('patient.explorations.store', ':id') }}" method="POST"
                    id="createExplorationForm">
                    <div class="form-group">
                        <label for="exploration_type_id">{{ __('app.fields.explorationType') }}</label>
                        <select id="exploration_type_id_exploration_create" class="form-control" type="text"
                            name="exploration_type_id" placeholder="{{ __('app.fields.explorationType') }}">
                            <option selected disabled>{{ __('app.texts.selectExplorationType') }}</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="value">{{ __('app.fields.value') }}</label>
                        <input id="value_exploration_create" class="form-control" type="text" name="value"
                            placeholder="{{ __('app.fields.value') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="value">{{ __('app.fields.comment') }}</label>
                        <textarea id="comment_exploration_create" class="form-control" type="text" name="comment"
                            placeholder="{{ __('app.fields.comment') }}"></textarea>
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

@push('js-stack')
    <script>
        $('#comment_exploration_create').summernote();
        // Load Exploration Types List
        httpService.get("{{ route('explorationTypes.index') }}").then(response => {
            response.data.forEach(element => {
                $('#exploration_type_id_exploration_create').append(new Option(`${element.exploration_type} (${element.unit})`,
                        element.id), false,
                    false)
                $('#exploration_type_id_exploration_edit').append(new Option(`${element.exploration_type} (${element.unit})`,
                    element.id), false, false)
            });
        });
    </script>
@endpush