<div class="modal fade" id="createChannelTypeModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-heartbeat mr-2"></i>{{ __('app.headers.createChannelType') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('channelTypes.store') }}" method="POST" id="createChannelTypeForm">
                    <div class="form-group">
                        <label for="channel_type">{{ __('app.fields.channelType') }}</label>
                        <input id="channel_type_create" class="form-control" type="text" name="channel_type"
                            placeholder="{{ __('app.fields.channelType') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('app.fields.description') }}</label>
                        <textarea id="description_create" class="form-control" name="description"
                            placeholder="{{ __('app.fields.description') }}"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="colour">{{ __('app.fields.colour') }}</label>
                        <input id="colour_create" class="form-control" name="colour"
                            placeholder="{{ __('app.fields.colour') }}" type="color" value="#0069D9">
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