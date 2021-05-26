@extends('layouts.document')

@section('title', __('app.headers.channelingPaymentInvoice'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.patient') }}</div>
        <div class="col-3">: {{ $appointment->patient->name }}</div>
        <div class="col-3">{{ __('app.fields.appointmentNumber') }}</div>
        <div class="col-4">: {{ $appointment->appointment_number }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.age') }}</div>
        <div class="col-3">: {{ $appointment->patient->age }} Years</div>
        <div class="col-3">{{ __('app.fields.channelingNumber') }}</div>
        <div class="col-4">: {{ $appointment->number_text }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.doctor') }}</div>
        <div class="col-3">: {{ $appointment->schedule->doctor->name }}</div>
        <div class="col-3">{{ __('app.fields.date') }}</div>
        <div class="col-4">: {{ $appointment->date }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.consultant') }}</div>
        <div class="col-3">: {{$appointment->schedule->doctor->channelType->channel_type}}</div>
        <div class="col-3">{{ __('app.fields.time') }}</div>
        <div class="col-4">: {{ $appointment->time_text }}</div>
    </div>
    <table class="table table-sm mt-5 w-50 ml-auto">
        <tbody>
            <tr>
                <th>{{ __('app.fields.doctorFee') }}</th>
                <td class="text-right">{{ $appointment->schedule->doctor_fee }}</td>
            </tr>
            <tr>
                <th>{{ __('app.fields.channelingCenterFee') }}</th>
                <td class="text-right">{{ $appointment->schedule->channelingCenterFee }}</td>
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