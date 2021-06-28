@extends('layouts.document')

@section('title', __('app.headers.purchaseReturn'))

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
                    <div class="row">{{ $purchaseReturn->supplier_text }}</div>
                    <div class="row">{{ $purchaseReturn->supplier->address }}</div>
                    <div class="row">0{{ $purchaseReturn->supplier->telephone }}</div>
                    <div class="row">{{ $purchaseReturn->supplier->email }}</div>
                    <div class="row">Reg.No : {{ $purchaseReturn->supplier->register_number }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-5">
    <div class="w-100">
        <div class="row">
            <div class="col-7">{{ __('app.fields.purchaseReturnNumber') }}</div>
            <div class="col-5">: {{ $purchaseReturn->purchase_return_number }}</div>
        </div>
        <div class="row">
            <div class="col-7">{{ __('app.fields.date') }}</div>
            <div class="col-5">: {{ $purchaseReturn->date }}</div>
        </div>
        <div class="row">
            <div class="col-7">{{ __('app.fields.time') }}</div>
            <div class="col-5">: {{ $purchaseReturn->time_text }}</div>
        </div>
    </div>
</div>
</div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.name') }}</th>
                <th>{{ __('app.fields.goodReceiveNoteNumber') }}</th>
                <th>{{ __('app.fields.returnReason') }}</th>
                <th class="text-right">{{ __('app.fields.returnedQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.returnPrice') }}</th>
                <th class="text-right">{{ __('app.fields.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseReturn->batches as $batch)
                <tr>
                    <td>{{ $batch->item->brand_name }}</td>
                    <td>{{ $batch->goodReceive->good_receive_number }}</td>
                    <td>{{ $batch->pivot->reason }}</td>
                    <td class="text-right">{{ $batch->pivot->quantity }}
                        {{ $batch->item->unit }}
                    </td>
                    <td class="text-right">Rs.{{ number_format($batch->pivot->price, 2) }}</td>
                    <td class="text-right">
                        Rs.{{ number_format($batch->pivot->price * $batch->pivot->quantity, 2) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.total') }}</th>
                <td class="text-right">{{ $purchaseReturn->total_text }}</td>
            </tr>
        </tbody>
    </table>
@endsection