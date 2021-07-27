@extends('layouts.document')

@section('title', $prescription->prescription_type == app\constants\Prescriptions::TEST_PRESCRIPTION ?
    __('app.headers.testPrescription') : __('app.headers.medicalPrescription'))

@section('content')
    <div class="row">
        <div class="col-1">{{ __('app.fields.patient') }}</div>
        <div class="col-5">: {{ $prescription->appointment->patient->name }}</div>
        <div class="col-3">{{ __('app.fields.appointmentNumber') }}</div>
        <div class="col-3">: {{ $prescription->appointment->appointmentNumber }}</div>
    </div>
    <div class="row">
        <div class="col-1">{{ __('app.fields.age') }}</div>
        <div class="col-5">: {{ $prescription->appointment->patient->age }} Years</div>
        <div class="col-3">{{ __('app.fields.prescriptionNumber') }}</div>
        <div class="col-3">: {{ $prescription->prescription_number }}</div>
    </div>
    <div class="row">
        <div class="col-1">{{ __('app.fields.gender') }}</div>
        <div class="col-5">: {{ $prescription->appointment->patient->gender }}</div>
        <div class="col-3">{{ __('app.fields.doctor') }}</div>
        <div class="col-3">: {{ $prescription->appointment->schedule->doctor->name }}</div>
    </div>
    <div class="row">
        <div class="col-1">{{ __('app.fields.date') }}</div>
        <div class="col-5">: {{ $prescription->date }}</div>
        <div class="col-3">{{ __('app.fields.time') }}</div>
        <div class="col-3">: {{ $prescription->time_text }}</div>
    </div>
    <hr>
    <div class="row mb-3">
        <img src="{{ public_path('img/rx.png') }}" class="img-fluid ml-5 mt-2" style="max-width: 50px;">
    </div>
    @if ($prescription->prescription_type == app\constants\Prescriptions::TEST_PRESCRIPTION)
        <ul>
            @foreach ($prescription->explorationTypes as $explorationType)
                <li>{{ $explorationType->exploration_type }}</li>
            @endforeach
        </ul>
    @else
        <ul>
            @foreach ($prescription->genericNames as $item)
                <li>{{ $item->pivot->generic_name_text }} - {{ $item->pivot->dosage_text }} -
                    {{ $item->pivot->duration_text }} - {{ $item->pivot->directions }}
                    @if ($issuedItems != [] && !$issuedItems->contains($item->pivot->generic_name_id))
                    - <span class="text-danger">{{ __('app.texts.notIssued') }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
    @isset($prescription->comment)
        <hr>
        <div class="container mt-4">
            {!! $prescription->comment !!}
        </div>
        <hr>
    @endisset
    <div class="row mt-3">
        <div class="col-4 ml-auto">
            <div class="row">
                {{ $prescription->appointment->schedule->doctor->name }}
            </div>
            <div class="row">
                {{ $prescription->appointment->schedule->doctor->qualification }}
            </div>
            <div class="row">
                {{ $prescription->appointment->schedule->doctor->channelType->channel_type }}
            </div>
            <div class="row">
                {{ $prescription->appointment->schedule->doctor->works_at }}
            </div>
        </div>
    </div>
@endsection