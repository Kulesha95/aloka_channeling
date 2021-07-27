@extends('layouts.document')

@section('title', __('app.headers.disposal'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.disposalNumber') }}</div>
        <div class="col-10">: {{ $disposal->disposal_number }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.date') }}</div>
        <div class="col-4">: {{ $disposal->date }}</div>
        <div class="col-2">{{ __('app.fields.time') }}</div>
        <div class="col-4">: {{ $disposal->time_text }}</div>
    </div>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.name') }}</th>
                <th>{{ __('app.fields.goodReceiveNoteNumber') }}</th>
                <th>{{ __('app.fields.disposedReason') }}</th>
                <th class="text-right">{{ __('app.fields.disposedQuantity') }}</th>
                <th class="text-right">{{ __('app.fields.price') }}</th>
                <th class="text-right">{{ __('app.fields.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disposal->batches as $batch)
                <tr>
                    <td>{{ $batch->item->brand_name }}</td>
                    <td>{{ $batch->goodReceive->good_receive_number }}</td>
                    <td>{{ $batch->pivot->reason }}</td>
                    <td class="text-right">{{ $batch->pivot->quantity }}
                        {{ $batch->item->unit }}
                    </td>
                    <td class="text-right">{{ number_format($batch->purchase_price, 2) }}</td>
                    <td class="text-right">
                        {{ number_format($batch->purchase_price * $batch->pivot->quantity, 2) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.total') }}</th>
                <td class="text-right">{{ $disposal->total_text }}</td>
            </tr>
        </tbody>
    </table>
@endsection