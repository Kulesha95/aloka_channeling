@extends('layouts.document')

@section('title', __('app.headers.goodReceiveNote'))

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-10 border border-dark p-3">
                    <div class="row">
                        <div class="col-3">
                            {{ __('app.fields.supplier') }} :-
                        </div>
                        <div class="col-9">
                            <div class="row">{{ $goodReceive->supplier_text }}</div>
                            <div class="row">{{ $goodReceive->supplier->address }}</div>
                            <div class="row">0{{ $goodReceive->supplier->telephone }}</div>
                            <div class="row">{{ $goodReceive->supplier->email }}</div>
                            <div class="row">Reg.No : {{ $goodReceive->supplier->register_number }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 align-items-center d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-3">{{ __('app.fields.number') }}</div>
                    <div class="col-9">: {{ $goodReceive->good_receive_number }}</div>
                </div>
                <div class="row">
                    <div class="col-3">{{ __('app.fields.date') }}</div>
                    <div class="col-9">: {{ $goodReceive->date }}</div>
                </div>
                <div class="row">
                    <div class="col-3">{{ __('app.fields.time') }}</div>
                    <div class="col-9">: {{ $goodReceive->time_text }}</div>
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
                    <td class="text-right">Rs.{{ number_format($item->pivot->purchase_price, 2) }}</td>
                    <td class="text-right">
                        Rs.{{ number_format($item->pivot->purchase_price * $item->pivot->purchase_quantity, 2) }}
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