@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
    </ol>
@stop

@section('content')
    @if (Auth::user()->is_admin || Auth::user()->is_super_admin)
        @include('dashboard.generalSummary')
        @include('dashboard.incomeGraphs')
        @include('dashboard.expenseGraphs')
    @endif
    @if (Auth::user()->is_receptionist)
        @include('dashboard.appointmentsSummary')
        @include('dashboard.incomeGraphs')
    @endif
    @if (Auth::user()->is_store_keeper)
        @include('dashboard.itemsSummary')
        @include('dashboard.stockDataSummary')
    @endif
    @if (Auth::user()->is_doctor)
        @include('dashboard.doctorChannelingsSummary')
        @include('dashboard.doctorIncomeGraph')
    @endif
    @if (Auth::user()->is_patient)
        @include('dashboard.channelingsDataSummary')
        @include('dashboard.explorationsHistory')
    @endif
    @if (Auth::user()->is_pharmacist)
        @include('dashboard.prescriptionSummary')
        @include('dashboard.pharmacySalesGraphs')
    @endif
@endsection

@section('js')
    @parent
    @stack('js-stack')
@endsection