@extends('layouts.document')

@section('title', __('app.headers.purchaseOrder'))

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-10 border border-dark">
                    <div class="p-3">
                        <div class="row mb-3">{{ __('app.fields.supplier') }} :-</div>
                        <div class="row">{{ $purchaseOrder->supplier_text }}</div>
                        <div class="row">{{ $purchaseOrder->supplier->address }}</div>
                        <div class="row">0{{ $purchaseOrder->supplier->telephone }}</div>
                        <div class="row">{{ $purchaseOrder->supplier->email }}</div>
                        <div class="row">Reg.No : {{ $purchaseOrder->supplier->register_number }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 align-items-center d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-3">{{ __('app.fields.number') }}</div>
                    <div class="col-9">: {{ $purchaseOrder->purchase_order_number }}</div>
                </div>
                <div class="row">
                    <div class="col-3">{{ __('app.fields.date') }}</div>
                    <div class="col-9">: {{ $purchaseOrder->date }}</div>
                </div>
                <div class="row">
                    <div class="col-3">{{ __('app.fields.time') }}</div>
                    <div class="col-9">: {{ $purchaseOrder->time_text }}</div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.brandName') }}</th>
                <th>{{ __('app.fields.genericName') }}</th>
                <th>{{ __('app.fields.quantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseOrder->items as $item)
                <tr>
                    <td>{{ $item->brand_name }}</td>
                    <td>{{ $item->generic_name_text }}</td>
                    <td>{{ $item->pivot->quantity }} {{ $item->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection