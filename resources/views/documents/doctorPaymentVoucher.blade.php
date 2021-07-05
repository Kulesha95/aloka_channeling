@extends('layouts.document')

@section('title', __('app.headers.doctorPaymentVoucher'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.doctor') }}</div>
        <div class="col-4">: {{ $expense->expensable->doctor->name }}</div>
        <div class="col-2">{{ __('app.fields.channelingType') }}</div>
        <div class="col-4">: {{ $expense->expensable->doctor->channelType->channel_type }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.channelingDate') }}</div>
        <div class="col-4">: {{ $expense->expensable->repeat_text }}</div>
        <div class="col-2">{{ __('app.fields.channelingTime') }}</div>
        <div class="col-4">: {{ $expense->expensable->time }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.scheduleNumber') }}</div>
        <div class="col-4">: {{ $expense->expensable->schedule_number }}</div>
        <div class="col-2">{{ __('app.fields.commission') }}</div>
        <div class="col-4">: {{ $expense->expensable->doctor->commission_text }}</div>
    </div>
    <table class="table table-sm mt-5 w-50 ml-auto">
        <tbody>
            <tr>
                <th>{{ __('app.fields.payable') }}</th>
                <td class="text-right">{{ $expense->expensable->getBalanceOnTimeText($expense->date, $expense->time) }}
                </td>
            </tr>
            <tr>
                <th>{{ __('app.fields.paid') }}</th>
                <td class="text-right">{{ $expense->amount_text }}</td>
            </tr>
            <tr>
                <th>{{ __('app.fields.balance') }}</th>
                <th class="text-right">
                    {{ $expense->expensable->getBalanceAfterPaymentText($expense->date, $expense->time, $expense->id) }}
                </th>
            </tr>
            <tr>
                <th>{{ __('app.fields.description') }}</th>
                <td class="text-right">{{ $expense->reason }}
            </tr>
        </tbody>
    </table>
@endsection