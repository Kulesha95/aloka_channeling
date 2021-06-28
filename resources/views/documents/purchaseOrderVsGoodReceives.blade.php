@extends('layouts.document')

@section('title', __('app.headers.purchaseOrderVsGoodReceiveNotes'))

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
                            <div class="row">{{ $purchaseOrder->supplier->name }}</div>
                            <div class="row">0{{ $purchaseOrder->supplier->telephone }}</div>
                            <div class="row">{{ $purchaseOrder->supplier->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="w-100">
                <div class="row">
                    <div class="col-7">{{ __('app.fields.purchaseOrderNumber') }}</div>
                    <div class="col-5">: {{ $purchaseOrder->purchase_order_number }}</div>
                </div>
                <div class="row">
                    <div class="col-7">{{ __('app.fields.date') }}</div>
                    <div class="col-5">: {{ $purchaseOrder->date }}</div>
                </div>
                <div class="row">
                    <div class="col-7">{{ __('app.fields.time') }}</div>
                    <div class="col-5">: {{ $purchaseOrder->time_text }}</div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.brandName') }}</th>
                <th>{{ __('app.fields.genericName') }}</th>
                <th class="text-right">{{ __('app.fields.orderQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.receivedQuantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseOrder->items as $item)
                <tr>
                    <td>{{ $item->brand_name }}</td>
                    <td>{{ $item->generic_name_text }}</td>
                    <td class="text-right">{{ $item->pivot->quantity }} {{ $item->unit }}</td>
                    <td class="text-right">{{ $goodReceiveItems[$item->id] ?? 0 }} {{ $item->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($purchaseOrder->goodReceives->count())
        <hr class="my-5">
        <div class="row justify-content-center mb-1">
            <h6 class="text-center font-weight-bold mx-auto"><u>{{ __('app.headers.goodReceiveNotes')}}</u></h6>
        </div>
        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>{{ __('app.fields.goodReceiveNoteNumber') }}</th>
                    <th>{{ __('app.fields.date') }}</th>
                    <th>{{ __('app.fields.time') }}</th>
                    <th class="text-right">{{ __('app.fields.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchaseOrder->goodReceives as $goodReceive)
                    <tr>
                        <td>{{ $goodReceive->good_receive_number }}</td>
                        <td>{{ $goodReceive->date }}</td>
                        <td>{{ $goodReceive->time_text }}</td>
                        <td class="text-right">{{ $goodReceive->total_text }}</td>
                    </tr>
                @endforeach                
            </tbody>
        </table>
    @endif
@endsection