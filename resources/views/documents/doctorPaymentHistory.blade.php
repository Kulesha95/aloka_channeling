@extends('layouts.document')

@section('title', __('app.headers.doctorPaymentsHistory'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.doctor') }}</div>
        <div class="col-4">: {{ $schedule->doctor->name }}</div>
        <div class="col-2">{{ __('app.fields.channelingType') }}</div>
        <div class="col-4">: {{ $schedule->doctor->channelType->channel_type }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.channelingDate') }}</div>
        <div class="col-4">: {{ $schedule->repeat_text }}</div>
        <div class="col-2">{{ __('app.fields.channelingTime') }}</div>
        <div class="col-4">: {{ $schedule->time }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.scheduleNumber') }}</div>
        <div class="col-4">: {{ $schedule->schedule_number }}</div>
        <div class="col-2">{{ __('app.fields.commission') }}</div>
        <div class="col-4">: {{ $schedule->doctor->commission_text }}</div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.voucherNumber') }}</th>
                <th>{{ __('app.fields.reason') }}</th>
                <th>{{ __('app.fields.date') }}</th>
                <th>{{ __('app.fields.time') }}</th>
                <th class="text-right">{{ __('app.fields.amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedule->expenses as $espense)
                <tr>
                    <td>{{ $espense->voucher_number }}</td>
                    <td>{{ $espense->reason }}</td>
                    <td>{{ $espense->date }}</td>
                    <td>{{ $espense->time_text }}</td>
                    <td class="text-right">{{ $espense->amount_text }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection