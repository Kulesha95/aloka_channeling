@extends('layouts.document')

@section('title', __('app.headers.expenseReport'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.dateFrom') }}</div>
        <div class="col-4">: {{ $fromDate }}</div>
        <div class="col-2">{{ __('app.fields.dateTo') }}</div>
        <div class="col-4">: {{ $toDate }}</div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.voucherNumber') }}</th>
                <th>{{ __('app.fields.description') }}</th>
                <th>{{ __('app.fields.date') }}</th>
                <th>{{ __('app.fields.time') }}</th>
                <th class="text-right">{{ __('app.fields.amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->voucher_number }}</td>
                    <td>{{ $expense->reason }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->time_text }}</td>
                    <td class="text-right">{{ $expense->amount_text }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3"></th>
                <th>{{ __('app.fields.total') }}</th>
                <th class="text-right">
                    {{ number_format($expenses->sum('amount'), 2) }}
                </th>
        </tfoot>
    </table>
@endsection