@extends('layouts.document')

@section('title', __('app.headers.profitAndLossReport')))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.dateFrom') }}</div>
        <div class="col-4">: {{ $fromDate }}</div>
        <div class="col-2">{{ __('app.fields.dateTo') }}</div>
        <div class="col-4">: {{ $toDate }}</div>
    </div>
    <table class="table table-sm table-bordered mt-5">
        <thead>
            <tr>
                <th class="text-center">{{ __('app.fields.debit') }}</th>
                <th class="text-center">{{ __('app.fields.credit') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-50">
                    <div class="container">
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.channelingIncome') }}</div>
                            <div>{{ number_format($channelingIncome, 2) }}</div>
                        </div>
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.internalPrescriptionsIncome') }}</div>
                            <div>{{ number_format($internalPrescriptionIncome, 2) }}</div>
                        </div>
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.externalPrescriptionsIncome') }}</div>
                            <div>{{ number_format($externalPrescriptionIncome, 2) }}</div>
                        </div>
                    </div>
                </td>
                <td class="w-50">
                    <div class="container">
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.doctorPayments') }}</div>
                            <div>{{ number_format($doctorPayments, 2) }}</div>
                        </div>
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.supplierPayments') }}</div>
                            <div>{{ number_format($supplierPayments, 2) }}</div>
                        </div>
                    </div>
                </td>
            </tr>
        <tfoot>
            <tr>
                <th class="px-2">
                    <div class="container">
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.total') }}</div>
                            <div>{{ number_format($totalIncome, 2) }}</div>
                        </div>
                    </div>
                </th>
                <th class="px-2">
                    <div class="container">
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ __('app.fields.total') }}</div>
                            <div>{{ number_format($totalExpense, 2) }}</div>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th class="px-2">
                    <div class="container">
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ $totalProfit >= 0 ? __('app.fields.profit') : '' }}</div>
                            <div>{{ $totalProfit >= 0 ? number_format($totalProfit, 2) : '' }}</div>
                        </div>
                    </div>
                </th>
                <th class="px-2">
                    <div class="container">
                        <div class="row d-flex justify-content-between px-2">
                            <div>{{ $totalProfit < 0 ? __('app.fields.loss') : '' }}</div>
                            <div>{{ $totalProfit < 0 ? number_format($totalProfit * -1, 2) : '' }}</div>
                        </div>
                    </div>
                </th>
            </tr>
        </tfoot>
        </tbody>
    </table>

@endsection