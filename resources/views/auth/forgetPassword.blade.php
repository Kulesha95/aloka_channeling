@extends('layouts.auth')

@section('content')
    <div class="container-fluid bg-dark d-flex full-height">
        <div class="card bg-white shadow my-auto mx-auto col-10 col-sm-8 col-md-4">
            <br>
            <div class="row m-3">
                <img style="width:40%; border-radius:50%" class="mx-auto img-fluid" src="{{ asset('img/logo.png') }}"
                    alt="">
            </div>
            <div class="row p-2">
                <h3 class="mx-auto text-center">{{ __('app.headers.forgetPassword') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.resetPassword') }}" method="POST" id="passwordResetForm">
                    @csrf
                    <div class="form-group">
                        <label for="username">{{ __('app.fields.username') }}</label>
                        <input id="username" class="form-control @if ($errors->has('username')) is-invalid @endif" type="text"
                        name="username"
                        placeholder="{{ __('app.fields.username') }}" value="{{ old('username') }}">
                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                    </div>
                    <div class="row d-flex justify-content-end m-3">
                        <a href="/" class="mr-auto"><i class="fas fa-globe-asia"></i></a>
                        <a href="{{ route('login') }}" class="mr-2">{{ __('app.texts.login') }}</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        formHandler.handleSave(`passwordResetForm`, ['username'], undefined,
            undefined, "");
    </script>
@endsection