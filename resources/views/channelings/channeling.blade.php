@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.channelingNote') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-heart mr-2"></i>{{ __('app.headers.channelingNote') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-1">
                    <button class="btn btn-primary w-100" onclick="getPreviousAppointment()"><i
                            class="fas fa-chevron-left"></i></button>
                </div>
                <div class="col-10">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ Carbon\Carbon::now()->format('Y-m-d') }}</span>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="scheduleNumber"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="{{ __('app.fields.channelingNumber') }}"
                            aria-label="{{ __('app.fields.channelingNumber') }}" aria-describedby="button-addon2"
                            id="channelingNumber">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" onclick="searchAppointment()"><i
                                    class="fas fa-search mr-1"></i>{{ __('app.buttons.search') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-primary w-100" onclick="getNextAppointment()"><i
                            class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <hr>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-channelingNote-tab" data-toggle="tab"
                        href="#nav-channelingNote" role="tab" aria-controls="nav-channelingNote" aria-selected="true"><i
                            class="fas fa-heart mr-2"></i>{{ __('app.texts.channelingNote') }}</a>
                    <a class="nav-item nav-link" id="nav-prescriptions-tab" data-toggle="tab" href="#nav-prescriptions"
                        role="tab" aria-controls="nav-prescriptions" aria-selected="true"><i
                            class="fas fa-file-prescription mr-2"></i>{{ __('app.texts.prescriptions') }}</a>
                    <a class="nav-item nav-link" id="nav-patient-history-tab" data-toggle="tab" href="#nav-patient-history"
                        role="tab" aria-controls="nav-patient-history" aria-selected="false"><i
                            class="fas fa-history mr-2"></i>{{ __('app.texts.patientHistory') }}<span
                            class="badge badge-success ml-1" id="pendingCount">0</span></a>
                    <a class="nav-item nav-link" id="nav-explorations-tab" data-toggle="tab" href="#nav-explorations"
                        role="tab" aria-controls="nav-explorations" aria-selected="false"><i
                            class="fas fa-weight mr-2"></i>{{ __('app.texts.explorations') }}</a>
                </div>
            </nav>
            <div class="tab-content mt-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-channelingNote" role="tabpanel"
                    aria-labelledby="nav-channelingNote-tab">
                    <form method="POST" id="editAppointmentForm" data-action="{{ route('appointments.update', ':id') }}">
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="patient_id">{{ __('app.fields.patient') }}</label>
                                <input id="patient_id_edit" class="form-control" type="hidden" name="patient_id"
                                    placeholder="{{ __('app.fields.patient') }}" disabled>
                                <input id="patient_name" class="form-control" type="text" name="patient_name"
                                    placeholder="{{ __('app.fields.patient') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-4">
                                <label for="patient_id">{{ __('app.fields.age') }}</label>
                                <input id="patient_age" class="form-control" type="text" name="patient_age"
                                    placeholder="{{ __('app.fields.age') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-4">
                                <label for="patient_id">{{ __('app.fields.gender') }}</label>
                                <input id="patient_gender" class="form-control" type="text" name="patient_gender"
                                    placeholder="{{ __('app.fields.gender') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="patient_id">{{ __('app.fields.height') }}</label>
                                <input id="patient_height" class="form-control" type="text" name="patient_height"
                                    placeholder="{{ __('app.fields.height') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-4">
                                <label for="patient_id">{{ __('app.fields.weight') }}</label>
                                <input id="patient_weight" class="form-control" type="text" name="patient_weight"
                                    placeholder="{{ __('app.fields.weight') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-4">
                                <label for="patient_id">{{ __('app.fields.bmi') }}</label>
                                <input id="patient_bmi" class="form-control" type="text" name="patient_bmi"
                                    placeholder="{{ __('app.fields.bmi') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="reason">{{ __('app.fields.reasons') }}</label>
                                <input id="reason_edit" class="form-control" type="text" name="reason"
                                    placeholder="{{ __('app.fields.reasons') }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="other">{{ __('app.fields.other') }}</label>
                                <input id="other_edit" class="form-control" type="text" name="other"
                                    placeholder="{{ __('app.fields.other') }}" disabled>
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
                            <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                                    aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="nav-prescriptions" role="tabpanel" aria-labelledby="nav-prescriptions-tab">
                    <div class="row">
                        <button type="button" class="btn btn-primary ml-auto mb-2" id="createMedicalPrescriptionButton">
                            <i class="fa fa-plus mr-1"
                                aria-hidden="true"></i>{{ __('app.buttons.newMedicalPrescription') }}
                        </button>
                        <button type="button" class="btn btn-primary ml-1 mb-2" data-toggle="modal"
                            data-target="#createTestPrescriptionModal">
                            <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.newTestPrescription') }}
                        </button>
                    </div>
                    <table id="prescriptions_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.id') }}</th>
                                <th>{{ __('app.fields.prescriptionNumber') }}</th>
                                <th>{{ __('app.fields.date') }}</th>
                                <th>{{ __('app.fields.time') }}</th>
                                <th>{{ __('app.fields.prescriptionType') }}</th>
                                <th>{{ __('app.fields.actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-patient-history" role="tabpanel"
                    aria-labelledby="nav-patient-history-tab">
                    <table id="appointmnets_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.id') }}</th>
                                <th>{{ __('app.fields.appointmentNumber') }}</th>
                                <th>{{ __('app.fields.reason') }}</th>
                                <th>{{ __('app.fields.doctor') }}</th>
                                <th>{{ __('app.fields.date') }}</th>
                                <th>{{ __('app.fields.time') }}</th>
                                <th>{{ __('app.fields.status') }}</th>
                                <th>{{ __('app.fields.actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-explorations" role="tabpanel" aria-labelledby="nav-explorations-tab">
                    <div class="row">
                        <button type="button" class="btn btn-primary ml-auto mb-2" data-toggle="modal"
                            data-target="#createExplorationModal">
                            <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                        </button>
                    </div>
                    <table id="explorations_list_table" class="table table-sm table-striped table-bordered table-hover"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('app.fields.id') }}</th>
                                <th>{{ __('app.fields.explorationType') }}</th>
                                <th>{{ __('app.fields.value') }}</th>
                                <th>{{ __('app.fields.comment') }}</th>
                                <th>{{ __('app.fields.date') }}</th>
                                <th>{{ __('app.fields.time') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <button type="submit" class="btn btn-danger ml-auto" onclick="handleOnHold()"><i
                        class="fa fa-times-circle mr-1" aria-hidden="true"></i>{{ __('app.buttons.onHold') }}</button>
                <button type="submit" class="btn btn-success ml-1" onclick="handleComplete()"><i
                        class="fa fa-check-circle mr-1" aria-hidden="true"></i>{{ __('app.buttons.complete') }}</button>
            </div>
        </div>
        @include('appointments.info')
        @include('prescriptions.medicalPrescription')
        @include('prescriptions.createTestPrescription')
        @include('prescriptions.editTestPrescription')
        @include('explorations.create')
    </div>
@endsection

@section('js')
    @parent
    <script>
        // Doctor Schedule Id
        let scheduleId = 0;
        // Current Appointment Number
        let currentNumber = 0;
        // Current Appointment Id
        let currentId = 0;
        // Appointment Navigation Urls
        const nextUrl = "{{ route('appointments.next', [':id', ':current']) }}";
        const backUrl = "{{ route('appointments.back', [':id', ':current']) }}";
        // Appointment Search Url
        const searchUrl = "{{ route('appointments.search', [':schedule', ':number']) }}";
        // Appointment Search Url
        const updateStatusUrl = "{{ route('appointments.updateStatus', ':id') }}";
        // Patient History Data Url
        const patientHistoryUrl = "{{ route('patients.history', ':patient') }}"
        // Patient Explorations Data Url
        const patientExplorationsUrl = "{{ route('patient.explorations.index', ':patient') }}"
        // Edit Form Inputs
        const inputs = ['patient_id', 'reason', 'comment', 'other'];
        // Entity Name To Define Form And Model IDs
        const model = "Appointment";
        // Data Table Name
        const dataTableName = 'appointmnets_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'appointment_number', 'reason', 'doctor', 'date', 'time', 'status_text'];
        // Column Indexes For URL Parameters
        const parameterIndexesAppointments = {
            "id": 0
        };
        const parameterIndexes = {
            "id": 0
        }
        // Table Actions
        const actionContents =
            viewActionContent
        // Prescriptions Create And Edit Forms Inputs
        const inputsPrescriptions = ['prescription_type', 'comment'];
        // Prescriptions Load Data URL
        const indexUrlPrescriptions = "{{ route('appointments.prescriptions', ':id') }}";
        // Prescriptions View Selected Data URL
        const viewUrlPrescriptions = "{{ route('prescriptions.show', ':id') }}";
        // Prescriptions Delete Data URL
        const deleteUrlPrescriptions = "{{ route('prescriptions.destroy', ':id') }}";
        // Prescriptions Entity Name To Define Form And Model IDs
        const modelPrescriptions = "Prescription";
        // Prescriptions Datatable ID
        const dataTableNamePrescriptions = 'prescriptions_list_table';
        // Prescriptions Table Columns List
        const dataTableColumnsPrescriptions = ["id", "prescription_number", "date", "time", "prescription_type_text"];
        // Prescriptions Column Indexes For URL Parameters
        const parameterIndexesPrescriptions = {
            "id": 0
        };
        // Prescriptions Datatable ID
        const dataTableNameExplorations = 'explorations_list_table';
        // Prescriptions Table Columns List
        const dataTableColumnsExplorations = ["id", "exploration_type", "value_text", "comment", "date", "time"];
        // Initialize Data Table
        const tablePrescriptions = dataTableHandler.initializeTable(
            dataTableNamePrescriptions,
            dataTableColumnsPrescriptions,
            undefined,
            actionContents + defaultActionContent
        );
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            null,
            actionContents
        );
        // Initialize Data Table
        const tableExplorations = dataTableHandler.initializeTable(
            dataTableNameExplorations,
            dataTableColumnsExplorations,
        );
        // Load Data To The Table
        const loadDataPrescriptions = () => {
            dataTableHandler.loadData(tablePrescriptions, indexUrlPrescriptions.replace(':id', currentId));
        };
        // Load Selected Data To The Edit Form
        const loadEditFormPrescriptions = (data) => {
            const modelPrescriptionName = data.prescription_type == "{{ $testPrescription }}" ? "TestPrescription" :
                "MedicalPrescription";
            const prefix = data.prescription_type == "{{ $testPrescription }}" ? "_test_prescription_edit" :
                "_medical_prescription_edit";
            console.log(data);
            formHandler.handleShow(
                `edit${modelPrescriptionName}Form`,
                inputsPrescriptions,
                `edit${modelPrescriptionName}Modal`,
                data,
                parameterIndexesPrescriptions,
                prefix);
            if (data.prescription_type == "{{ $testPrescription }}") {
                $(`#edit${modelPrescriptionName}Form input:checkbox`).attr('checked', false);
                data.exploration_types.forEach(explorationType => {
                    $(`#explorationTypeCheckEdit${explorationType}`).attr("checked", true)
                });
            }else{
                console.log(data);
                handleAddSuccessMedicalPrescription(data);
            }
        }
        const openPrescription = (data) => {
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'prescription', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.id));
        }
        // Page Loading Process
        $(document).ready(() => {
            // Select Doctor Current Schedule
            httpService.get("{{ route('doctors.schedule') }}").then(response => {
                scheduleId = response.data.id;
                $('#scheduleNumber').html(response.data.schedule_number);
                getNextAppointment();
            });
            // Get Tests List
            httpService.get("{{ route('explorationTypes.tests') }}").then(response => {
                $('#tests_list_test_prescription_create').html(response.data.map((explorationType =>
                    `<div class="custom-control custom-checkbox col-3"><input type="checkbox" class="custom-control-input" name="exploration_type_id[]" id="explorationTypeCheckCreate${explorationType.id}" value="${explorationType.id}"><label class="custom-control-label" for="explorationTypeCheckCreate${explorationType.id}">${explorationType.exploration_type}</label></div>`
                )))
                $('#tests_list_test_prescription_edit').html(response.data.map((explorationType =>
                    `<div class="custom-control custom-checkbox col-3"><input type="checkbox" class="custom-control-input" name="exploration_type_id[]" id="explorationTypeCheckEdit${explorationType.id}" value="${explorationType.id}"><label class="custom-control-label" for="explorationTypeCheckEdit${explorationType.id}">${explorationType.exploration_type}</label></div>`
                )))
            });
            // Initialize Summernote Editor
            $('#comment_edit').summernote();
            $('#comment_prescription_create').summernote();
            $('#comment_prescription_edit').summernote();
            $('#comment_test_prescription_create').summernote();
            $('#comment_medical_prescription_edit').summernote();
            // Handle Channeling Note Update
            formHandler.handleEdit(`edit${model}Form`, inputs, searchAppointment);
            // Handle Patient Histoy View Button Click
            dataTableHandler.handleCustom(table, "{{ route('appointments.details', ':id') }}",
                parameterIndexesAppointments,
                loadChannelingInfo, 'view-button');
            // Delete Item
            dataTableHandler.handleDelete(
                tablePrescriptions,
                deleteUrlPrescriptions,
                parameterIndexesPrescriptions,
                undefined,
                searchAppointment
            );
            // Handle Edit Button Click Event In Data Table
            dataTableHandler.handleShow(tablePrescriptions, viewUrlPrescriptions, parameterIndexesPrescriptions,
                loadEditFormPrescriptions);
            // Handle Create Form Submit
            formHandler.handleSave(`create${modelPrescriptions}Form`, inputsPrescriptions, loadDataPrescriptions,
                `create${modelPrescriptions}Modal`, "_prescription_create");
            // Handle Edit Form Submit
            formHandler.handleEdit(`edit${modelPrescriptions}Form`, inputsPrescriptions, loadDataPrescriptions,
                `edit${modelPrescriptions}Modal`, "_prescription_edit");
            // Handle Prescription View Button Click
            dataTableHandler.handleCustom(tablePrescriptions, viewUrlPrescriptions,
                parameterIndexesPrescriptions,
                openPrescription, 'view-button');
        });
        // Load Patient History
        const handleFormLoadSuccess = (data) => {
            $('#patient_name').val(data.patient);
            $('#patient_age').val(data.patient_age);
            $('#patient_gender').val(data.patient_gender);
            $('#patient_height').val(data.patient_height);
            $('#patient_weight').val(data.patient_weight);
            $('#patient_bmi').val(data.patient_bmi);
            dataTableHandler.loadData(table, patientHistoryUrl.replace(`:patient`, data.patient_id), (data) => {
                const pendingCount = data.filter(item => item.status == "{{ $onHold }}").length;
                if (pendingCount) {
                    $('#pendingCount').removeClass('badge-success');
                    $('#pendingCount').addClass('badge-danger');
                    $('#pendingCount').html(pendingCount);
                }
            });
            dataTableHandler.loadData(tableExplorations, patientExplorationsUrl.replace(`:patient`, data.patient_id));
        }
        // Fill Channeling Details To The Form
        const loadChannelingData = (data) => {
            if (data) {
                formHandler.handleShow(
                    `edit${model}Form`,
                    inputs,
                    null,
                    data,
                    parameterIndexes,
                    "_edit",
                    handleFormLoadSuccess
                );
                $('#channelingNumber').val(data.number_text);
                $('#appointment_id_prescription_create').val(data.id);
                $('#appointment_id_test_prescription_create').val(data.id);
                $('#appointment_id_prescription_edit').val(data.id);
                let explorationAddUrl = $(`#createExplorationForm`).data("action");
                explorationAddUrl = explorationAddUrl.replace(`:id`, data.patient_id);
                $(`#createExplorationForm`).attr("action", explorationAddUrl);
                loadDataPrescriptions();
                // If Not Found Reset The Form And Current Appointment Details
            } else {
                currentNumber = 0;
                currentId = 0;
                $('#channelingNumber').val('');
                $('#appointment_id_prescription_create').val('');
                $('#appointment_id_prescription_edit').val('');
                $(`#createExplorationForm`).attr("action", '');
                table.clear().draw();
                tablePrescriptions.clear().draw();
            }
        }
        // Handle Next Appointment Button Click
        const getNextAppointment = () => {
            formHandler.resetForm(`edit${model}Form`, inputs, "_edit");
            $('#pendingCount').removeClass('badge-danger');
            $('#pendingCount').addClass('badge-success');
            $('#pendingCount').html(0);
            const nextAppointmentUrl = nextUrl.replace(`:id`, scheduleId).replace(`:current`, currentNumber);
            httpService.get(nextAppointmentUrl).then(response => {
                currentNumber = response.data.number;
                currentId = response.data.id;
                loadChannelingData(response.data)
            }).catch(() => {
                loadChannelingData(undefined)
            });
        }
        // Handle Previous Appointment button Click
        const getPreviousAppointment = () => {
            formHandler.resetForm(`edit${model}Form`, inputs, "_edit");
            $('#pendingCount').removeClass('badge-danger');
            $('#pendingCount').addClass('badge-success');
            $('#pendingCount').html(0);
            const previousAppointmentUrl = backUrl.replace(`:id`, scheduleId).replace(`:current`, currentNumber);
            httpService.get(previousAppointmentUrl).then(response => {
                currentNumber = response.data.number;
                currentId = response.data.id;
                loadChannelingData(response.data)
            }).catch(() => {
                loadChannelingData(undefined)
            });
        }
        // Handle Search Appointment
        const searchAppointment = () => {
            $('#pendingCount').removeClass('badge-danger');
            $('#pendingCount').addClass('badge-success');
            $('#pendingCount').html(0);
            formHandler.resetForm(`edit${model}Form`, inputs, "_edit");
            const search = $('#channelingNumber').val() ? $('#channelingNumber').val() : 0;
            const searchAppointmentUrl = searchUrl
                .replace(`:number`, search)
                .replace(`:schedule`, scheduleId);
            httpService.get(searchAppointmentUrl).then(response => {
                currentNumber = response.data.number;
                currentId = response.data.id;
                loadChannelingData(response.data)
            }).catch(() => {
                loadChannelingData(undefined)
            });
        }
        // Handle Channeling Status Update
        const handleChannelingNoteStatusUpdate = (id, status) => {
            httpService.put(updateStatusUrl.replace(`:id`, currentId), {
                status,
                _method: "PUT"
            }).then((response) => {
                getNextAppointment();
                messageHandler.successMessage(response.message);
            });
        }
        // Handle Channeling On Hold Action
        const handleOnHold = () => {
            handleChannelingNoteStatusUpdate(currentId, "{{ $onHold }}");
        }
        // Handle Channeling Completed Action
        const handleComplete = () => {
            handleChannelingNoteStatusUpdate(currentId, "{{ $completed }}");
        }
        formHandler.handleSave("createExplorationForm", ["exploration_type_id", "value", "comment"], searchAppointment,
            "createExplorationModal", "_exploration_create");
        $('#createMedicalPrescriptionButton').on('click', () => {
            httpService.post("{{ route('prescriptions.createNew', ':id') }}".replace(":id", currentId), {
                "prescription_type": "{{ $medicalPrescription }}"
            }).then(response => {
                loadDataPrescriptions();
                handleAddSuccessMedicalPrescription(response.data.prescription);
                $('#editMedicalPrescriptionModal').modal('show');
            });
        });
    </script>
    @stack('js-stack')
@endsection