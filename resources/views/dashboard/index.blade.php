@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
    </ol>
@stop