@extends('layouts.document')

@section('title', __('app.headers.stockReport'))

@section('content')    
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.brandName') }}</th>
                <th>{{ __('app.fields.expireDate') }}</th>
                <th class="text-right">{{ __('app.fields.purchasePrice') }}</th>
                <th class="text-right">{{ __('app.fields.sellingPrice') }}</th>
                <th class="text-right">{{ __('app.fields.reorderLevel') }}</th>
                <th class="text-right">{{ __('app.fields.stockQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.reservedQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.returnableQuantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stock as $batch)
                <tr>
                    <td>{{ $batch->item->brand_name }}</td>
                    <td>{{ $batch->expire_date }}</td>
                    <td class="text-right">{{ $batch->purchase_price_text }}</td>
                    <td class="text-right">{{ $batch->price_text }}</td>
                    <td class="text-right">{{ $batch->item->reorder_level }} {{ $batch->item->unit }}</td>
                    <td class="text-right">{{ $batch->stock_quantity }} {{ $batch->item->unit }}</td>
                    <td class="text-right">{{ $batch->reserved_quantity }} {{ $batch->item->unit }}</td>
                    <td class="text-right">{{ $batch->returnable_quantity }} {{ $batch->item->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection