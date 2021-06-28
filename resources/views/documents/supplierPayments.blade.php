@extends('layouts.document')

@section('title', __('app.headers.supplierPayments'))

@section('content')
    <div class="row">
        <div class="col-7">
            <div class="row">
                <div class="col-10">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-end">
                            {{ __('app.fields.supplier') }} :
                        </div>
                        <div class="col-9">
                            <div class="row">{{ $goodReceive->supplier->name }}</div>
                            <div class="row">{{ $goodReceive->supplier->address }}</div>
                            <div class="row">0{{ $goodReceive->supplier->telephone }}</div>
                            <div class="row">{{ $goodReceive->supplier->email }}</div>
                            <div class="row">Reg.No : {{ $goodReceive->supplier->register_number }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5 align-items-center">
            <div class="w-100">
                @if ($goodReceive->supplierable_type == app\constants\GoodReceives::PURCHASE_ORDER)
                    <div class="row">
                        <div class="col-7">{{ __('app.fields.purchaseOrderNumber') }}</div>
                        <div class="col-5">: {{ $goodReceive->supplierable->purchase_order_number }}</div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-7">{{ __('app.fields.goodReceiveNote') }}</div>
                    <div class="col-5">: {{ $goodReceive->good_receive_number }}</div>
                </div>
                <div class="row">
                    <div class="col-7">{{ __('app.fields.goodReceiveDate') }}</div>
                    <div class="col-5">: {{ $goodReceive->date }}</div>
                </div>
                <div class="row">
                    <div class="col-7">{{ __('app.fields.goodReceiveTime') }}</div>
                    <div class="col-5">: {{ $goodReceive->time_text }}</div>
                </div>
            </div>
        </div>
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
            @foreach ($goodReceive->expenses as $expense)
                <tr>
                    <td>{{ $expense->voucher_number }}</td>
                    <td>{{ $expense->reason }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->time_text }}</td>
                    <td class="text-right">{{ $expense->amount_text }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>{{ __('app.fields.paid') }}</th>
                <td class="text-right">{{ $goodReceive->paid_text }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>{{ __('app.fields.total') }}</th>
                <td class="text-right">{{ $goodReceive->total_text }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>{{ __('app.fields.balance') }}</th>
                <td class="text-right">{{ $goodReceive->balance_text }}</td>
            </tr>
        </tbody>
    </table>
@endsection