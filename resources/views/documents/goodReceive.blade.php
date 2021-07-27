@extends('layouts.document')

@section('title', __('app.headers.goodReceiveNote'))

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
                    <div class="col-7">{{ __('app.fields.date') }}</div>
                    <div class="col-5">: {{ $goodReceive->date }}</div>
                </div>
                <div class="row">
                    <div class="col-7">{{ __('app.fields.time') }}</div>
                    <div class="col-5">: {{ $goodReceive->time_text }}</div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.name') }}</th>
                <th>{{ __('app.fields.expireDate') }}</th>
                <th class="text-right">{{ __('app.fields.receivedQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.freeQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.price') }}</th>
                <th class="text-right">{{ __('app.fields.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goodReceive->items as $item)
                <tr>
                    <td>{{ $item->brand_name }}</td>
                    <td>{{ $item->pivot->expire_date }}</td>
                    <td class="text-right">{{ $item->pivot->purchase_quantity }} {{ $item->unit }}</td>
                    <td class="text-right">{{ $item->pivot->good_receive_quantity - $item->pivot->purchase_quantity }}
                        {{ $item->unit }}
                    </td>
                    <td class="text-right">{{ number_format($item->pivot->purchase_price, 2) }}</td>
                    <td class="text-right">
                        {{ number_format($item->pivot->purchase_price * $item->pivot->purchase_quantity, 2) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.total') }}</th>
                <td class="text-right">{{ $goodReceive->total_text }}</td>
            </tr>
        </tbody>
    </table>
@endsection