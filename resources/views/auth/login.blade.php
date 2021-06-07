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
            <h3 class="mx-auto text-center">{{__('app.headers.welcomeTo')}}</h3>
        </div>
        <div class="row p-2">
            <h5 class="mx-auto text-center">{{env('APP_NAME')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">{{ __('app.fields.username') }}</label>
                    <input id="username" class="form-control @if ($errors->has('username')) is-invalid @endif" type="text"
                    name="username"
                    placeholder="{{ __('app.fields.username') }}" value="{{ old('username') }}">
                    <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('app.fields.password') }}</label>
                    <input id="password" class="form-control @if ($errors->has('password')) is-invalid @endif" type="password"
                    name="password"
                    placeholder="{{ __('app.fields.password') }}">
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    </div>
                    <div class="row d-flex justify-content-end m-3">
                        <a href="#" class="mr-2">{{__('app.texts.forgotPassword')}}</a>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt mr-1"
                                    aria-hidden="true"></i>{{ __('app.buttons.login') }}</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection