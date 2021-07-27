@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.sendMessage') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-comment-dots mr-2"></i>{{ __('app.headers.sendMessage') }}</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('schedules.sendMessage') }}" method="POST" id="sendMessageForm">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="schedule_id">{{ __('app.fields.schedule') }}</label>
                        <select name="schedule_id" id="schedule_id_create" class="form-control col-12">
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="date">{{ __('app.fields.date') }}</label>
                        <select name="date" id="date_create" class="form-control col-12">
                            <option selected disabled>{{ __('app.texts.selectDate') }}</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="patients">{{ __('app.fields.patients') }}</label>
                        <select name="patient_id[]" id="patient_id_create" class="form-control col-12" multiple="multiple">
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="message">{{ __('app.fields.message') }}</label>
                        <input id="message_create" class="form-control" type="text" name="message"
                            placeholder="{{ __('app.fields.message') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row m-1">
                    <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-paper-plane mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.send') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        // Render Select2 Selected Option
        const templateSelectionDoctor = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return `${element.doctor} - ${element.channel_type} - ${element.repeat_text}`;
        };
        const templateSelectionPatient = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return `${element.name} - 0${element.mobile}`;
        };
        // Render Select2 Options
        const templateResultDoctor = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.doctor}</h6></div><div class="row">${element.channel_type}</div><div class="row font-weight-light">${element.repeat_text} from ${moment(element.time_from, "HH:mm:ss").format('hh:mm A')} to ${moment(element.time_to, "HH:mm:ss").format('hh:mm A')}</div>`
            );
        };
        const templateResultPatient = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.name}</h6></div><div class="row">0${element.mobile}</div><div class="row font-weight-light">${element.email}</div>`
            );
        };
        const select2OptionsDoctor = {
            templateResult: templateResultDoctor,
            templateSelection: templateSelectionDoctor,
            placeholder: "{{ __('app.texts.selectSchedule') }}"
        };
        const select2OptionsPatient = {
            templateResult: templateResultPatient,
            templateSelection: templateSelectionPatient,
            placeholder: "{{ __('app.texts.selectPatients') }}"
        };
        $('#schedule_id_create').select2(select2OptionsDoctor);
        $('#patient_id_create').select2(select2OptionsPatient);
        httpService.get("{{ route('schedules.index') }}").then(response => {
            response.data.forEach(element => {
                $('#schedule_id_create').append(new Option(JSON.stringify(element), element.id), false,
                    false)
            });
        })
        $('#schedule_id_create').on('change', e => {
            $('#patient_id_create').empty();
            $('#date_create').empty();
            $('#date_create').append(
                `<option disabled selected>{{ __('app.texts.selectDate') }}</option>`)
            if (e.target.value) {
                httpService.get("{{ route('schedules.getDates', ':schedule') }}".replace(":schedule", e.target
                        .value))
                    .then(response => {
                        response.data.forEach(element => {
                            $('#date_create').append(new Option(element, element), false, false)
                        });
                    })
            }
        })
        $('#date_create').on('change', () => {
            if ($('#date_create').val()) {
                httpService.get(
                        "{{ route('schedules.patients', ['schedule' => ':schedule', 'date' => ':date']) }}"
                        .replace(":schedule", $('#schedule_id_create').val())
                        .replace(":date", $('#date_create').val()))
                    .then(response => {
                        $('#patient_id_create').empty();
                        response.data.forEach(element => {
                            $('#patient_id_create').append(new Option(JSON.stringify(element), element
                                .user_id,
                                true, true))
                        });
                    })
            }
        })
        formHandler.handleSave(`sendMessageForm`, ['schedule_id', 'patient_id', 'date', 'message']);
    </script>
@endsection