<div class="modal fade" id="viewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"><i
                        class="fas fa-fw fa-calendar-plus mr-2"></i>{{ __('app.headers.viewAppointment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!Auth::user()->patient)
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-channel-tab" data-toggle="tab"
                                href="#nav-channel" role="tab" aria-controls="nav-channel" aria-selected="true"><i
                                    class="fas fa-heartbeat mr-2"></i>{{ __('app.texts.channelDetails') }}</a>
                            <a class="nav-item nav-link" id="nav-patient-tab" data-toggle="tab" href="#nav-patient"
                                role="tab" aria-controls="nav-patient" aria-selected="false"><i
                                    class="fas fa-user-injured mr-2"></i>{{ __('app.texts.patientDetails') }}</a>
                        </div>
                    </nav>
                @endif
                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-channel" role="tabpanel"
                        aria-labelledby="nav-channel-tab">
                        <div class="row">
                            <div class="col-3">
                                <img src="" class="img-fluid" id="doctorImage">
                            </div>
                            <div class="col-9">
                                <table>
                                    <tr>
                                        <th>{{ __('app.fields.doctor') }}</th>
                                        <td>: <span id="doctorName"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.channelType') }}</th>
                                        <td>: <span id="channelType"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.date') }}</th>
                                        <td>: <span id="channelDate"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.estimatedTime') }}</th>
                                        <td>: <span id="channelEstimatedTime"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.number') }}</th>
                                        <td>: <span id="channelNumber"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.appointmentNumber') }}</th>
                                        <td>: <span id="appointmentNumber"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.fee') }}</th>
                                        <td>: <span id="fee"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-patient" role="tabpanel" aria-labelledby="nav-patient-tab">
                        <div class="row">
                            <div class="col-3">
                                <img src="" class="img-fluid" id="patientImage">
                            </div>
                            <div class="col-9">
                                <table>
                                    <tr>
                                        <th>{{ __('app.fields.name') }}</th>
                                        <td>: <span id="patientName"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.gender') }}</th>
                                        <td>: <span id="patientGender"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.birthDate') }}</th>
                                        <td>: <span id="patientBirthDate"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.age') }}</th>
                                        <td>: <span id="patientAge"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.address') }}</th>
                                        <td>: <span id="patientAddress"></span></td>
                                    </tr>
                                    <tr>
                                        <th><span id="patientIdType"></th>
                                        <td>: <span id="patientIdNumber"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.email') }}</th>
                                        <td>: <span id="patientEmail"></span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('app.fields.mobile') }}</th>
                                        <td>: <span id="patientMobile"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!Auth::user()->patient)
                    <div class="row m-1" id="button-row">
                        <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                        <button type="submit" class="btn btn-primary ml-1"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const loadChannelingInfo = (data) => {
        $(`#doctorImage`).attr('src', data.doctor.image);
        $(`#doctorName`).html(data.doctor.name);
        $(`#channelType`).html(data.channelType.channel_type);
        $(`#channelDate`).html(data.appointment.date);
        $(`#channelEstimatedTime`).html(moment(data.appointment.time, "HH:mm:ss").format("hh:mm A"));
        $(`#channelNumber`).html(data.appointment.number_text);
        $(`#appointmentNumber`).html(data.appointment.appointment_number);
        $(`#fee`).html(data.appointment.fee);
        $(`#patientImage`).attr('src', data.patient.image);
        $(`#patientName`).html(data.patient.name);
        $(`#patientGender`).html(data.patient.gender);
        $(`#patientBirthDate`).html(data.patient.birth_date);
        $(`#patientAge`).html(data.patient.age);
        $(`#patientAddress`).html(data.patient.address);
        $(`#patientEmail`).html(data.patient.email);
        $(`#patientMobile`).html(data.patient.mobile);
        $(`#patientIdType`).html(data.patient.id_type);
        $(`#patientIdNumber`).html(data.patient.id_number);
        $(`#viewAppointmentModal`).modal("show");
        if (data.appointment.status === 1) {
            $('#button-row').html(
                `<button type="submit" class="btn btn-danger ml-auto" onclick="handleStatusUpdate(${data.appointment.id},{{ $rejected }})"><i class="fa fa-times-circle mr-1"
                    aria-hidden="true"></i>{{ __('app.buttons.reject') }}</button>
                <button type="submit" class="btn btn-success ml-1" onclick="handleStatusUpdate(${data.appointment.id},{{ $confirmed }})"><i class="fa fa-check-circle mr-1"
                    aria-hidden="true"></i>{{ __('app.buttons.confirm') }}</button>`
            );
        } else {
            $('#button-row').html("");
        }
    }
    const handleStatusUpdate = (id, status) => {
        httpService.put("{{ route('appointments.updateStatus', ':id') }}".replace(':id', id), {
            status,
            _method: "PUT"
        }).then((response) => {
            loadData();
            messageHandler.successMessage(response.message);
            $(`#viewAppointmentModal`).modal("hide");
        });
    }
</script>