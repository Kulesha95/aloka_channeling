<div class="modal fade" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-calendar-plus mr-2"></i>{{ __('app.headers.createAppointment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('appointments.store') }}" method="POST" id="createAppointmentForm">
                    @if (Auth::user()->patient)
                        <input type="hidden" name="patient_id" value="{{ Auth::user()->patient->id }}">
                    @endif
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
                        <div class="form-group col-4">
                            <label for="channeling_fee_text">{{ __('app.fields.channelingFee') }}</label>
                            <input id="channeling_fee_text_create" class="form-control" type="text"
                                placeholder="{{ __('app.fields.channelingFee') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="current_number">{{ __('app.fields.currentNumber') }}</label>
                            <input id="current_number_create" class="form-control" type="text"
                                placeholder="{{ __('app.fields.currentNumber') }}" readonly>
                            <small class="text-danger">{{ __('app.texts.thisCanBeSlightlyChanged') }}</small>
                        </div>
                        <div class="form-group col-4">
                            <label for="estimated_time">{{ __('app.fields.estimatedTime') }}</label>
                            <input id="estimated_time_create" class="form-control" type="text"
                                placeholder="{{ __('app.fields.estimatedTime') }}" readonly>
                            <small class="text-danger">{{ __('app.texts.thisCanBeSlightlyChanged') }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="patient_id">{{ __('app.fields.patient') }}</label>
                            @if (Auth::user()->patient)
                                <input class="form-control" type="text" value="{{ Auth::user()->name }}" readonly>
                            @else
                                <select name="patient_id" id="patient_id_create" class="form-control col-12">
                                    <option></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="date">{{ __('app.fields.date') }}</label>
                            <input id="date_create" class="form-control" type="date" name="date"
                                placeholder="{{ __('app.fields.date') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="channel_reason_id_create">{{ __('app.fields.reasons') }}</label>
                            <select name="channel_reason_id[]" id="channel_reason_id_create" class="form-control col-12"
                                multiple="multiple">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="other">{{ __('app.fields.other') }}</label>
                            <textarea id="other_create" class="form-control" name="other"
                                placeholder="{{ __('app.fields.other') }}"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>