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
                        <div class="form-group col-6">
                            <label for="current_number">{{ __('app.fields.currentNumber') }}</label>
                            <input id="number_edit" class="form-control" type="text"
                                placeholder="{{ __('app.fields.currentNumber') }}" readonly>
                        </div>
                        <div class="form-group col-6">
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
                            <label for="reason">{{ __('app.fields.reason') }}</label>
                            <input id="reason_edit" class="form-control" type="text" name="reason"
                                placeholder="{{ __('app.fields.reason') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="comment">{{ __('app.fields.comment') }}</label>
                            <textarea id="comment_edit" class="form-control" type="number" name="comment"
                                placeholder="{{ __('app.fields.comment') }}"></textarea>
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