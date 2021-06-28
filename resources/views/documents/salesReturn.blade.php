@extends('layouts.document')

@section('title', __('app.headers.salesReturn'))

@section('content')
    <div class="row">
            <div class="col-3">{{ __('app.fields.number') }}</div>
            <div class="col-3">: {{ $salesReturn->sales_return_number }}</div>
            <div class="col-2">{{ __('app.fields.date') }}</div>
            <div class="col-4">: {{ $salesReturn->date }}</div>
        </div>
        <div class="row">
            <div class="col-3">{{ __('app.fields.prescriptionNumber') }}</div>
            <div class="col-3">: {{ $salesReturn->prescription->prescription_number }}</div>
            <div class="col-2">{{ __('app.fields.time') }}</div>
            <div class="col-4">: {{ $salesReturn->time_text }}</div>
        </div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.name') }}</th>
                <th class="text-right">{{ __('app.fields.returnedQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.price') }}</th>
                <th class="text-right">{{ __('app.fields.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesReturn->batches as $batch)
                <tr>
                    <td>{{ $batch->item->brand_name }}</td>
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
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <th>{{ __('app.fields.total') }}</th>
                <td class="text-right">{{ $salesReturn->total_text }}</td>
            </tr>
        </tbody>
    </table>
@endsection