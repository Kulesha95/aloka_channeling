<div class="modal fade" id="createPatientModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-user-injured mr-2"></i>{{ __('app.headers.createPatient') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('patients.store') }}" method="POST" id="createPatientForm">
                    <input type="hidden" name="user_type_id" value="3">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">{{ __('app.fields.name') }}</label>
                            <input id="name_create" class="form-control" type="text" name="name"
                                placeholder="{{ __('app.fields.name') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="birth_date">{{ __('app.fields.birthDate') }}</label>
                            <input id="birth_date_create" class="form-control" type="date" name="birth_date"
                                placeholder="{{ __('app.fields.birthDate') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="gender">{{ __('app.fields.gender') }}</label>
                            <select name="gender" id="gender_create" class="form-control">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="address">{{ __('app.fields.address') }}</label>
                            <textarea id="address_create" class="form-control" type="text" name="address"
                                placeholder="{{ __('app.fields.address') }}"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="id_type">{{ __('app.fields.idType') }}</label>
                            <select name="id_type" id="id_type_create" class="form-control">
                                <option value="" selected disabled>Select Id Type</option>
                                <option value="NIC">NIC</option>
                                <option value="Driving License">Driving License</option>
                                <option value="Passport">Passport</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="id_number">{{ __('app.fields.idNumber') }}</label>
                            <input id="id_number_create" class="form-control" type="text" name="id_number"
                                placeholder="{{ __('app.fields.idNumber') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username">{{ __('app.fields.username') }}</label>
                            <input id="username_create" class="form-control" type="text" name="username"
                                placeholder="{{ __('app.fields.username') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="email">{{ __('app.fields.email') }}</label>
                            <input id="email_create" class="form-control" type="text" name="email"
                                placeholder="{{ __('app.fields.email') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="mobile">{{ __('app.fields.mobile') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+94</div>
                                </div>
                                <input id="mobile_create" class="form-control" type="text" name="mobile"
                                    placeholder="{{ __('app.fields.mobile') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="image">{{ __('app.fields.image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_create" name="image">
                                <label class="custom-file-label" for="image">{{ __('app.fields.image') }}</label>
                                <div class="invalid-feedback"></div>
                            </div>
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