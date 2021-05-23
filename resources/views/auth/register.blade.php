@extends('layouts.front')

@section('content')
    <div class="container-fluid bg-dark d-flex">
        <div class="card bg-white shadow mx-auto col-10 col-sm-8 col-md-6 my-5">
            <br>
            <div class="row m-3">
                <img style="width:150px; border-radius:50%" class="mx-auto img-fluid" src="{{ asset('img/logo.png') }}"
                    alt="">
            </div>
            <div class="row p-2">
                <h3 class="mx-auto text-center">{{ __('app.headers.welcomeTo') }}</h3>
            </div>
            <div class="row p-2">
                <h5 class="mx-auto text-center">{{ env('APP_NAME') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_type_id" value="3">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">{{ __('app.fields.name') }}</label>
                            <input id="name_create" class="form-control @if ($errors->has('name')) is-invalid @endif" type="text"
                            name="name"
                            placeholder="{{ __('app.fields.name') }}" value="{{ old('name') }}">
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="birth_date">{{ __('app.fields.birthDate') }}</label>
                            <input id="birth_date_create" class="form-control @if ($errors->has('birth_date')) is-invalid @endif" type="date"
                            name="birth_date"
                            placeholder="{{ __('app.fields.birthDate') }}" value="{{ old('birth_date') }}">
                            <div class="invalid-feedback">{{ $errors->first('birth_date') }}</div>
                        </div>
                        <div class="form-group col-6">
                            <label for="gender">{{ __('app.fields.gender') }}</label>
                            <select name="gender" id="gender_create" class="form-control @if ($errors->has('gender')) is-invalid @endif">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male" @if (old('gender') == 'Male') {{ 'Selected' }} @endif>Male</option>
                                <option value="Female" @if (old('gender') == 'Female') {{ 'Selected' }} @endif>Female</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="address">{{ __('app.fields.address') }}</label>
                            <textarea id="address_create" class="form-control @if ($errors->has('address')) is-invalid @endif" type="text" name="address"
                                            placeholder="{{ __('app.fields.address') }}">{{ old('address') }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="id_type">{{ __('app.fields.idType') }}</label>
                            <select name="id_type" id="id_type_create" class="form-control @if ($errors->has('id_type')) is-invalid @endif">
                                <option value="" selected disabled>Select Id Type</option>
                                <option value="NIC" @if (old('id_type') == 'NIC') {{ 'Selected' }} @endif>NIC</option>
                                <option value="Driving License" @if (old('id_type') == 'Driving License') {{ 'Selected' }} @endif>Driving License</option>
                                <option value="Passport" @if (old('id_type') == 'Passport') {{ 'Selected' }} @endif>Passport</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('id_type') }}</div>
                        </div>
                        <div class="form-group col-6">
                            <label for="id_number">{{ __('app.fields.idNumber') }}</label>
                            <input id="id_number_create" class="form-control @if ($errors->has('id_number')) is-invalid @endif" type="text"
                            name="id_number"
                            placeholder="{{ __('app.fields.idNumber') }}" value="{{ old('id_number') }}">
                            <div class="invalid-feedback">{{ $errors->first('id_number') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="mobile">{{ __('app.fields.mobile') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+94</div>
                                </div>
                                <input id="mobile_create" class="form-control @if ($errors->has('mobile')) is-invalid @endif" type="text"
                                name="mobile"
                                placeholder="{{ __('app.fields.mobile') }}" value="{{ old('mobile') }}">
                                <div class="invalid-feedback">{{ $errors->first('mobile') }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username">{{ __('app.fields.username') }}</label>
                            <input id="username_create" class="form-control @if ($errors->has('username')) is-invalid @endif" type="text"
                            name="username"
                            placeholder="{{ __('app.fields.username') }}" value="{{ old('username') }}">
                            <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                        </div>
                        <div class="form-group col-6">
                            <label for="email">{{ __('app.fields.email') }}</label>
                            <input id="email_create" class="form-control @if ($errors->has('email')) is-invalid @endif" type="text"
                            name="email"
                            placeholder="{{ __('app.fields.email') }}" value="{{ old('email') }}">
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password">{{ __('app.fields.password') }}</label>
                            <input id="password_create" class="form-control @if ($errors->has('password')) is-invalid @endif" type="password"
                            name="password"
                            placeholder="{{ __('app.fields.password') }}">
							<div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        </div>
                        <div class="form-group col-6">
							<label for="password_confirmation">{{ __('app.fields.confirmPassword') }}</label>
                            <input id="password_confirmation_create" class="form-control @if ($errors->has('password')) is-invalid @endif" type="password"
                            name="password_confirmation"
                            placeholder="{{ __('app.fields.confirmPassword') }}">
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-sign-in-alt mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.signUp') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection