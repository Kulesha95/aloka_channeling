@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.appointmentsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-calendar-plus mr-2"></i>{{ __('app.headers.appointmentsManagement') }}</h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createAppointmentModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="items_list_table" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.fields.id') }}</th>
                        <th>{{ __('app.fields.appointmentNumber') }}</th>
                        <th>{{ __('app.fields.patient') }}</th>
                        <th>{{ __('app.fields.doctor') }}</th>
                        <th>{{ __('app.fields.date') }}</th>
                        <th>{{ __('app.fields.time') }}</th>
                        <th>{{ __('app.fields.status') }}</th>
                        <th>{{ __('app.fields.fee') }}</th>
                        <th>{{ __('app.fields.paid') }}</th>
                        <th>{{ __('app.fields.balance') }}</th>
                        <th>{{ __('app.fields.actions') }}</th>
                    </tr>
                </thead>
            </table>
            @include('appointments.create')
            @include('appointments.edit')
            @include('appointments.info')
            @include('appointments.payments')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Create And Edit Forms Inputs
        const inputs = ['schedule_id', 'number', 'time', 'fee_text', 'patient_id', 'date', 'reason', 'comment'];
        // Load Data URL
        const indexUrl = "{{ route('appointments.index') }}";
        // View Selected Data URL
        const viewUrl = "{{ route('appointments.show', ':id') }}";
        // Get Selected Item Details URL
        const detailsUrl = "{{ route('appointments.details', ':id') }}";
        // Delete Data URL
        const deleteUrl = "{{ route('appointments.destroy', ':id') }}";
        // Entity Name To Define Form And Model IDs
        const model = "Appointment";
        // Datatable ID
        const dataTableName = 'items_list_table';
        // Table Columns List
        const dataTableColumns = ['id', 'appointment_number', 'patient', 'doctor', 'date', 'time', 'status_text',
            'fee_text', 'paid_text', 'balance_text'
        ];
        // Column Indexes For URL Parameters
        const parameterIndexes = {
            "id": 0
        };
        const actionContents =
            "<button class='btn btn-sm btn-outline-info mr-1 view-button'><i class='fas fa-eye fa-fw' ></i></button>" +
            "<button class='btn btn-sm btn-outline-primary mr-1 payment-button'><i class='fas fa-dollar-sign fa-fw' ></i></button>" +
            "<button class='btn btn-sm btn-outline-dark mr-1 print-button'><i class='fas fa-print fa-fw' ></i></button>" +
            defaultActionContent;
        // Initialize Data Table
        const table = dataTableHandler.initializeTable(
            dataTableName,
            dataTableColumns,
            indexUrl,
            actionContents
        );
        // Delete Item
        dataTableHandler.handleDelete(
            table,
            deleteUrl,
            parameterIndexes,
            indexUrl
        );
        // Load Data To The Table
        const loadData = () => {
            dataTableHandler.loadData(table, indexUrl);
        };
        // Load Selected Data To The Edit Form
        const loadEditForm = (data) => {
            formHandler.handleShow(
                `edit${model}Form`,
                inputs,
                `edit${model}Modal`,
                data,
                parameterIndexes);
        }
        // Handle Edit Button Click Event In Data Table
        dataTableHandler.handleShow(table, viewUrl, parameterIndexes, loadEditForm);
        // Handle View Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadChannelingInfo, 'view-button');
        // Handle Payment Button Click Event In Data Table
        dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
            loadPaymentInfo, 'payment-button');
        // Handle Create Form Submit
        formHandler.handleSave(`create${model}Form`, inputs, loadData, `create${model}Modal`);
        // Handle Edit Form Submit
        formHandler.handleEdit(`edit${model}Form`, inputs, loadData, `edit${model}Modal`);
        $(document).ready(() => {
            // Handle Print Button Click Event In Data Table
            dataTableHandler.handleCustom(table, detailsUrl, parameterIndexes,
                openPaymentInvoice, 'print-button');
        });
        // Open Print Document
        const openPaymentInvoice = (data) => {
            console.log(data);
            const documentUrl =
                "{{ route('documents.getPdf', ['type' => 'channelingPaymentInvoice', 'id' => ':id', 'action' => 'view']) }}";
            window.open(documentUrl.replace(':id', data.appointment.id));
        }
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
            return `${element.name} - ${element.id_number}`;
        };
        // Render Select2 Options
        const templateResultDoctor = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.doctor}</h6></div><div class="row">${element.channel_type}</div><div class="row">${element.channeling_fee_text}</div><div class="row font-weight-light">${element.repeat_text} from ${moment(element.time_from, "HH:mm:ss").format('hh:mm A')} to ${moment(element.time_to, "HH:mm:ss").format('hh:mm A')}</div>`
            );
        };
        const templateResultPatient = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.name}</h6></div><div class="row">${element.id_number}</div><div class="row font-weight-light">${element.address}</div>`
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
            placeholder: "{{ __('app.texts.selectPatient') }}"
        };
        $('#schedule_id_create').select2(select2OptionsDoctor);
        $('#schedule_id_edit').select2(select2OptionsDoctor);
        $('#patient_id_create').select2(select2OptionsPatient);
        $('#patient_id_edit').select2(select2OptionsPatient);
        $('#comment_create').summernote();
        $('#comment_edit').summernote();
        // Load Doctors List
        httpService.get("{{ route('schedules.index') }}").then(response => {
            response.data.forEach(element => {
                $('#schedule_id_create').append(new Option(JSON.stringify(element), element.id), false,
                    false)
                $('#schedule_id_edit').append(new Option(JSON.stringify(element), element.id), false, false)
                let url = new URL(window.location.href);
                const date = url.searchParams.get('date');
                const schedule = url.searchParams.get('id');
                if (date && schedule) {
                    $('#schedule_id_create').val(schedule).trigger('change');
                    $('#date_create').val(date).trigger('change');
                    $(`#create${model}Modal`).modal("show");
                }
            });
        })
        // Load Patients List
        httpService.get("{{ route('patients.index') }}").then(response => {
            response.data.forEach(element => {
                $('#patient_id_create').append(new Option(JSON.stringify(element), element.id), false,
                    false)
                $('#patient_id_edit').append(new Option(JSON.stringify(element), element.id), false, false)
            });
        })
        // Load Schedule Details
        let scheduleId = null;
        let scheduleDate = null;
        $('#schedule_id_create').on('change', () => {
            const selectedSchedule = $('#schedule_id_create').val();
            if (selectedSchedule && selectedSchedule !== scheduleId) {
                scheduleId = selectedSchedule;
                displayAppintmentApproximations(scheduleId, scheduleDate);
            }
        });
        $('#date_create').on('change', () => {
            const selectedDate = $('#date_create').val();
            if (scheduleId && selectedDate && selectedDate !== scheduleDate) {
                scheduleDate = selectedDate;
                displayAppintmentApproximations(scheduleId, scheduleDate);
            }
        });
        // Display Estimated Number, Time And Correct Dates If Incorrect
        const displayAppintmentApproximations = (scheduleId, scheduleDate) => {
            httpService.get(
                "{{ route('schedules.summary', [':id', ':date']) }}"
                .replace(":id", scheduleId)
                .replace(":date", scheduleDate)).then(
                response => {
                    $('#current_number_create').val(response.data.number);
                    $('#estimated_time_create').val(response.data.time);
                    $('#channeling_fee_text_create').val(response.data.channeling_fee_text);
                    $('#date_create').val(response.data.date);
                })
        }
    </script>
@endsection