@extends('layouts.document')

@section('title', __('app.headers.channelingNote'))

@section('content')
    <div class="row">
        <div class="col-2">{{ __('app.fields.patient') }}</div>
        <div class="col-4">: {{ $appointment->patient->name }}</div>
        <div class="col-3">{{ __('app.fields.appointmentNumber') }}</div>
        <div class="col-3">: {{ $appointment->appointment_number }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.age') }}</div>
        <div class="col-4">: {{ $appointment->patient->age }} Years</div>
        <div class="col-3">{{ __('app.fields.channelingNumber') }}</div>
        <div class="col-3">: {{ $appointment->number_text }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.doctor') }}</div>
        <div class="col-4">: {{ $appointment->schedule->doctor->name }}</div>
        <div class="col-3">{{ __('app.fields.date') }}</div>
        <div class="col-3">: {{ $appointment->date }}</div>
    </div>
    <div class="row">
        <div class="col-2">{{ __('app.fields.channelType') }}</div>
        <div class="col-4">: {{ $appointment->schedule->doctor->channelType->channel_type }}</div>
        <div class="col-3">{{ __('app.fields.time') }}</div>
        <div class="col-3">: {{ $appointment->time_text }}</div>
    </div>
    <hr>
    <h6 class="font-weight-bold"><u>{{ __('app.fields.reasons') }}</u></h6>
    <ul>
        @foreach ($appointment->channelReasons as $channelReason)
            <li>{{ $channelReason->reason }}</li>
        @endforeach
    </ul>
    <h6 class="font-weight-bold"><u>{{ __('app.fields.other') }}</u></h6>
    <p>{{ $appointment->other }}</p>
    <h6 class="font-weight-bold"><u>{{ __('app.fields.comment') }}</u></h6>
    <p>{{ $appointment->comment }}</p>
    <hr>
    <div class="row justify-content-center mb-3">
        <h5 class="text-center font-weight-bold mx-auto"><u>{{ __('app.headers.explorations') }}</u></h5>
    </div>
    <table class="table table-sm mt-5">
        <thead>
            <tr>
                <th>{{ __('app.fields.explorationType') }}</th>
                <th>{{ __('app.fields.comment') }}</th>
                <th class="text-right">{{ __('app.fields.value') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointment->patient->explorations->where('date', $appointment->date) as $exploration)
                <tr>
                    <td>{{ $exploration->explorationType->exploration_type }}</td>
                    <td>{!! $exploration->comment !!}</td>
                    <td class="text-right">{{ $exploration->value }} {{ $exploration->explorationType->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>




    @if ($appointment->prescriptions->where('prescription_type', app\constants\Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION)->count())
        <div class="row justify-content-center mb-3 always-before-page-break">
            <h5 class="text-center font-weight-bold mx-auto"><u>{{ __('app.headers.medicalPrescriptions') }}</u></h5>
        </div>
        @foreach ($appointment->prescriptions->where('prescription_type', app\constants\Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION) as $prescription)
            <div class="container border-bottom py-3 avoid-page-break">

                <div class="row mb-3">
                    <img src="{{ public_path('img/rx.png') }}" class="img-fluid ml-5 mt-2" style="max-width: 50px;">
                </div>
                <ul>
                    @foreach ($prescription->genericNames as $item)
                        <li>{{ $item->pivot->generic_name_text }} - {{ $item->pivot->dosage_text }} -
                            {{ $item->pivot->duration_text }} - {{ $item->pivot->directions }}
                        </li>
                    @endforeach
                </ul>
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
            </div>
        @endforeach
    @endif


    @if ($appointment->prescriptions->where('prescription_type', app\constants\Prescriptions::TEST_PRESCRIPTION)->count())
        <div class="row justify-content-center mb-3 always-before-page-break">
            <h5 class="text-center font-weight-bold mx-auto"><u>{{ __('app.headers.testPrescriptions') }}</u></h5>
        </div>
        @foreach ($appointment->prescriptions->where('prescription_type', app\constants\Prescriptions::TEST_PRESCRIPTION) as $prescription)
            <div class="container border-bottom py-3 avoid-page-break">

                <div class="row mb-3">
                    <img src="{{ public_path('img/rx.png') }}" class="img-fluid ml-5 mt-2" style="max-width: 50px;">
                </div>
                <ul>
                    @foreach ($prescription->explorationTypes as $explorationType)
                        <li>{{ $explorationType->exploration_type }}</li>
                    @endforeach
                </ul>
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
            </div>
        @endforeach
    @endif
@endsection