@extends('layouts.document')

@section('title', __('app.headers.channelingPaymentInvoice'))

@section('content')
    <div class="row">
        <div class="col-1">{{ __('app.fields.patient') }}</div>
        <div class="col-5">: {{ $appointment->patient->name }}</div>
        <div class="col-3">{{ __('app.fields.appointmentNumber') }}</div>
        <div class="col-3">: {{ $appointment->appointment_number }}</div>
    </div>
    <div class="row">
        <div class="col-1">{{ __('app.fields.age') }}</div>
        <div class="col-5">: {{ $appointment->patient->age }} Years</div>
        <div class="col-3">{{ __('app.fields.channelingNumber') }}</div>
        <div class="col-3">: {{ $appointment->number_text }}</div>
    </div>
    <div class="row">
        <div class="col-1">{{ __('app.fields.doctor') }}</div>
        <div class="col-5">: {{ $appointment->schedule->doctor->name }}</div>
        <div class="col-3">{{ __('app.fields.date') }} - {{ __('app.fields.time') }}</div>
        <div class="col-3">: {{ $appointment->date }} - {{ $appointment->time_text }}</div>
    </div>
    <table class="table table-sm mt-5 w-50 ml-auto">
        <tbody>
            <tr>
                <th>{{ __('app.fields.doctorFee') }}</th>
                <td class="text-right">{{ $appointment->schedule->doctor_fee_text }}</td>
            </tr>
            <tr>
                <th>{{ __('app.fields.channelingCenterFee') }}</th>
                <td class="text-right">{{ $appointment->schedule->channeling_center_fee_text }}</td>
            </tr>
            <tr>
                <th>{{ __('app.fields.total') }}</th>
                <th class="text-right">{{ $appointment->fee_text }}</th>
            </tr>
            <tr>
                <th>{{ __('app.fields.paid') }}</th>
                <td class="text-right">{{ $appointment->paid_text }}</td>
            </tr>
            <tr>
                <th>{{ __('app.fields.balance') }}</th>
                <th class="text-right">{{ $appointment->balance_text }}</th>
            </tr>
        </tbody>        
    </table>
@endsection