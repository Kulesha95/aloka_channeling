<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered dialog-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-user-shield mr-2"></i>{{ __('app.headers.editUser') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editUserForm" data-action="{{ route('users.update', ':id') }}">
                    @method('PUT')
                    <div class="row">
                        <img src="" alt="" id="image_preview" class="img-circle mx-auto image-preview">
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">{{ __('app.fields.name') }}</label>
                            <input id="name_edit" class="form-control" type="text" name="name"
                                placeholder="{{ __('app.fields.name') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="username">{{ __('app.fields.username') }}</label>
                            <input id="username_edit" class="form-control" type="text" name="username"
                                placeholder="{{ __('app.fields.username') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email">{{ __('app.fields.email') }}</label>
                            <input id="email_edit" class="form-control" type="text" name="email"
                                placeholder="{{ __('app.fields.email') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="mobile">{{ __('app.fields.mobile') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+94</div>
                                </div>
                                <input id="mobile_edit" class="form-control" type="text" name="mobile"
                                    placeholder="{{ __('app.fields.mobile') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="user_type_id">{{ __('app.fields.userType') }}</label>
                            <select name="user_type_id" id="user_type_id_edit" class="form-control"
                                placeholder="{{ __('app.fields.userType') }}">

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="image">{{ __('app.fields.image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_edit" name="image">
                                <label class="custom-file-label" for="image">{{ __('app.fields.image') }}</label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
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