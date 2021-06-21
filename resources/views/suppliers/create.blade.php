<div class="modal fade" id="createSupplierModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-truck mr-2"></i>{{ __('app.headers.createSupplier') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.store') }}" method="POST" id="createSupplierForm">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">{{ __('app.fields.name') }}</label>
                            <input id="name_create" class="form-control" type="text" name="name"
                                placeholder="{{ __('app.fields.name') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="register_number">{{ __('app.fields.registerNumber') }}</label>
                            <input id="register_number_create" class="form-control" type="text" name="register_number"
                                placeholder="{{ __('app.fields.registerNumber') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email">{{ __('app.fields.email') }}</label>
                            <input id="email_create" class="form-control" type="text" name="email"
                                placeholder="{{ __('app.fields.email') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="telephone">{{ __('app.fields.telephone') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+94</div>
                                </div>
                                <input id="telephone_create" class="form-control" type="text" name="telephone"
                                    placeholder="{{ __('app.fields.telephone') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="address">{{ __('app.fields.address') }}</label>
                            <textarea class="form-control" id="address_create" name="address" placeholder="{{__('app.fields.address')}}"></textarea>
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