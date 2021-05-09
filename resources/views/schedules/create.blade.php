<div class="modal fade" id="createScheduleModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-calendar-alt mr-2"></i>{{ __('app.headers.createSchedule') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules.store') }}" method="POST" id="createScheduleForm">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="doctor_id">{{ __('app.fields.doctor') }}</label>
                            <select name="doctor_id" id="doctor_id_create" class="form-control col-12"
                                placeholder="{{ __('app.fields.doctor') }}">

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="date_from">{{ __('app.fields.dateFrom') }}</label>
                            <input id="date_from_create" class="form-control" type="date" name="date_from"
                                placeholder="{{ __('app.fields.dateFrom') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="date_to">{{ __('app.fields.dateTo') }}</label>
                            <input id="date_to_create" class="form-control" type="date" name="date_to"
                                placeholder="{{ __('app.fields.dateTo') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="time_from">{{ __('app.fields.timeFrom') }}</label>
                            <input id="time_from_create" class="form-control" type="time" name="time_from"
                                placeholder="{{ __('app.fields.timeFrom') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="time_to">{{ __('app.fields.timeTo') }}</label>
                            <input id="time_to_create" class="form-control" type="time" name="time_to"
                                placeholder="{{ __('app.fields.timeTo') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="channeling_fee">{{ __('app.fields.channelingFee') }}</label>
                            <input id="channeling_fee_create" class="form-control" type="number" name="channeling_fee"
                                placeholder="{{ __('app.fields.channelingFee') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="repeat">{{ __('app.fields.repeat') }}</label>
                            <select name="repeat" id="repeat_create" class="form-control col-12"
                                placeholder="{{ __('app.fields.repeat') }}">
                                <option value="" selected disabled>{{ __('app.texts.selectRepeat') }}</option>
                                <option value="0">{{ __('app.texts.noRepeat') }}</option>
                                <option value="7">{{ __('app.texts.everyWeek') }}</option>
                            </select>
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