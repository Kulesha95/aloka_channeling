<div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-calendar-plus mr-2"></i>{{ __('app.headers.editAppointment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editAppointmentForm" data-action="{{ route('appointments.update', ':id') }}">
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="schedule_id">{{ __('app.fields.schedule') }}</label>
                            <select name="schedule_id" id="schedule_id_edit" class="form-control col-12" disabled>
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="channeling_fee_text">{{ __('app.fields.channelingFee') }}</label>
                            <input id="fee_text_edit" class="form-control" type="text"
                                placeholder="{{ __('app.fields.channelingFee') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="current_number">{{ __('app.fields.number') }}</label>
                            <input id="number_edit" class="form-control" type="text"
                                placeholder="{{ __('app.fields.number') }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="estimated_time">{{ __('app.fields.estimatedTime') }}</label>
                            <input id="time_edit" class="form-control" type="time"
                                placeholder="{{ __('app.fields.estimatedTime') }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="patient_id">{{ __('app.fields.patient') }}</label>
                            <select name="patient_id" id="patient_id_edit" class="form-control col-12" disabled>
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="date">{{ __('app.fields.date') }}</label>
                            <input id="date_edit" class="form-control" type="date" name="date"
                                placeholder="{{ __('app.fields.date') }}" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="channel_reason_id_edit">{{ __('app.fields.reasons') }}</label>
                            <select name="channel_reason_id[]" id="channel_reason_id_edit" class="form-control col-12"
                                multiple="multiple">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="other">{{ __('app.fields.other') }}</label>
                            <textarea id="other_edit" class="form-control" name="other"
                                placeholder="{{ __('app.fields.other') }}"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-edit mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>