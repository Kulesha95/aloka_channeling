@extends('layouts.document')

@section('title', __('app.headers.deficitItemsReport'))

@section('content')    
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.brandName') }}</th>
                <th>{{ __('app.fields.genericName') }}</th>
                <th class="text-right">{{ __('app.fields.reorderLevel') }}</th>
                <th class="text-right">{{ __('app.fields.stockQuantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deficitItems as $item)
                <tr>
                    <td>{{ $item->brand_name }}</td>
                    <td>{{ $item->generic_name_text }}</td>
                    <td class="text-right">{{ $item->reorder_level }} {{ $item->unit }}</td>
                    <td class="text-right">{{ $item->stock }} {{ $item->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection