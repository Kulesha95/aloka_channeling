@extends('layouts.document')

@section('title', $prescription->prescription_type == app\constants\Prescriptions::TEST_PRESCRIPTION ?
    __('app.headers.testPrescription') : __('app.headers.pharmacyPaymentInvoice'))

@section('content')
    <div class="row">
        <div class="col-3">{{ __('app.fields.prescriptionNumber') }}</div>
        <div class="col-3">: {{ $prescription->prescription_number }}</div>
        <div class="col-3">{{ __('app.fields.invoiceNumber') }}</div>
        <div class="col-3">: {{ $prescription->invoice_number }}</div>
    </div>
    <div class="row">
        <div class="col-3">{{ __('app.fields.date') }}</div>
        <div class="col-3">: {{ $prescription->invoice_date }}</div>
        <div class="col-3">{{ __('app.fields.time') }}</div>
        <div class="col-3">: {{ $prescription->invoice_time }}</div>
    </div>
    <hr>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.brandName') }}</th>
                <th>{{ __('app.fields.quantity') }}</th>
                <th class="text-right">{{ __('app.fields.price') }}</th>
                <th class="text-right">{{ __('app.fields.discount') }}</th>
                <th class="text-right">{{ __('app.fields.discountedPrice') }}</th>
                <th class="text-right">{{ __('app.fields.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prescription->batches as $batch)
                <tr>
                    <td>{{ $batch->item->brand_name }}</td>
                    <td>{{ $batch->pivot->quantity_text }}</td>
                    <td class="text-right">{{ $batch->price_text }}</td>
                    <td class="text-right">{{ $batch->discount_text }}</td>
                    <td class="text-right">{{ $batch->discounted_price_text }}</td>
                    <td class="text-right">{{ $batch->pivot->total_text }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.total') }}</th>
                <td class="text-right">{{ $prescription->sub_total_text }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.discount') }}</th>
                <td class="text-right">{{ $prescription->discount_text }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.payable') }}</th>
                <td class="text-right">{{ $prescription->total_text }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.paid') }}</th>
                <td class="text-right">{{ $prescription->paid_text }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <th>{{ __('app.fields.balance') }}</th>
                <td class="text-right">{{ $prescription->balance_text }}</td>
            </tr>
        </tbody>
    </table>

@endsection