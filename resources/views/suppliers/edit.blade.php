<div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-truck mr-2"></i>{{ __('app.headers.editSupplier') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editSupplierForm" data-action="{{ route('suppliers.update', ':id') }}">
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">{{ __('app.fields.name') }}</label>
                            <input id="name_edit" class="form-control" type="text" name="name"
                                placeholder="{{ __('app.fields.name') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="register_number">{{ __('app.fields.registerNumber') }}</label>
                            <input id="register_number_edit" class="form-control" type="text" name="register_number"
                                placeholder="{{ __('app.fields.registerNumber') }}">
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
                            <label for="telephone">{{ __('app.fields.telephone') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+94</div>
                                </div>
                                <input id="telephone_edit" class="form-control" type="text" name="telephone"
                                    placeholder="{{ __('app.fields.telephone') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="address">{{ __('app.fields.address') }}</label>
                                <textarea class="form-control" id="address_edit" name="address"></textarea>
                                <div class="invalid-feedback"></div>
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