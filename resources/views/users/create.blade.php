<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-user-shield mr-2"></i>{{ __('app.headers.createUser') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
                    <div class="form-group">
                        <label for="username">{{ __('app.fields.username') }}</label>
                        <input id="username_create" class="form-control" type="text" name="username"
                            placeholder="{{ __('app.fields.username') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('app.fields.email') }}</label>
                        <input id="email_create" class="form-control" type="text" name="email"
                            placeholder="{{ __('app.fields.email') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="mobile">{{ __('app.fields.mobile') }}</label>
                        <input id="mobile_create" class="form-control" type="text" name="mobile"
                            placeholder="{{ __('app.fields.mobile') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="user_type_id">{{ __('app.fields.userType') }}</label>
                        <select name="user_type_id" id="user_type_id_create" class="form-control"
                            placeholder="{{ __('app.fields.userType') }}">

                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ __('app.fields.image') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image_create" name="image">
                            <label class="custom-file-label" for="image">{{ __('app.fields.image') }}</label>
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