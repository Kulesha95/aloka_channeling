<div class="modal fade" id="createUserTypeModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-user-shield mr-2"></i>{{ __('app.headers.createUserType') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('userTypes.store') }}" method="POST" id="createUserTypeForm">
                    <div class="form-group">
                        <label for="user_type">{{ __('app.fields.userType') }}</label>
                        <input id="user_type_create" class="form-control" type="text" name="user_type"
                            placeholder="{{ __('app.fields.userType') }}">
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