@extends('layouts.document')

@section('title', __('app.headers.channelingPayments'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.patient') }}</div>
        <div class="col-3">: {{ $appointment->patient->name }}</div>
        <div class="col-3">{{ __('app.fields.appointmentNumber') }}</div>
        <div class="col-4">: {{ $appointment->appointment_number }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.doctor') }}</div>
        <div class="col-3">: {{ $appointment->schedule->doctor->name }}</div>
        <div class="col-3">{{ __('app.fields.appointmentTime') }}</div>
        <div class="col-4">: {{ $appointment->date }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.consultant') }}</div>
        <div class="col-3">: {{$appointment->schedule->doctor->channelType->channel_type}}</div>
        <div class="col-3">{{ __('app.fields.time') }}</div>
        <div class="col-4">: {{ $appointment->time_text }}</div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.invoiceNumber') }}</th>
                <th>{{ __('app.fields.reason') }}</th>
                <th>{{ __('app.fields.date') }}</th>
                <th>{{ __('app.fields.time') }}</th>
                <th class="text-right">{{ __('app.fields.amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointment->incomes as $income)
                <tr>
                    <td>{{ $income->invoice_number }}</td>
                    <td>{{ $income->reason }}</td>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->time_text }}</td>
                    <td class="text-right">{{ $income->amount_text }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>{{ __('app.fields.paid') }}</th>
                <td class="text-right">{{ $appointment->paid_text }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>{{ __('app.fields.fee') }}</th>
                <td class="text-right">{{ $appointment->fee_text }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>{{ __('app.fields.balance') }}</th>
                <td class="text-right">{{ $appointment->balance_text }}</td>
            </tr>
        </tbody>
    </table>
@endsection