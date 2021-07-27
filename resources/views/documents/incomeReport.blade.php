@extends('layouts.document')

@section('title', __('app.headers.incomeReport'))

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
                <th>{{ __('app.fields.invoiceNumber') }}</th>
                <th>{{ __('app.fields.description') }}</th>
                <th>{{ __('app.fields.date') }}</th>
                <th>{{ __('app.fields.time') }}</th>
                <th class="text-right">{{ __('app.fields.amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incomes as $income)
                <tr>
                    <td>{{ $income->invoice_number }}</td>
                    <td>{{ $income->reason }}</td>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->time_text }}</td>
                    <td class="text-right">{{ $income->amount_text }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3"></th>
                <th>{{ __('app.fields.total') }}</th>
                <th class="text-right">
                    {{ number_format($incomes->sum('amount'), 2) }}
                </th>
        </tfoot>
    </table>
@endsection