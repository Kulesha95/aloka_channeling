@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.prescriptionsManagement') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.prescriptionsManagement') }}
                </h4>
                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal"
                    data-target="#createExternalPrescriptionBillModal">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('app.buttons.createNew') }}
                </button>
            </div>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-prescription-bills-tab" data-toggle="tab"
                        href="#nav-prescription-bills" role="tab" aria-controls="nav-prescription-bills"
                        aria-selected="true"><i
                            class="fas fa-comment-dollar mr-1"></i>{{ __('app.texts.prescriptionBills') }}<span
                            class="badge badge-success ml-1" id="pendingCount">0</span></a>
                    <a class="nav-link" id="nav-internal-prescriptions-tab" data-toggle="tab"
                        href="#nav-internal-prescriptions" role="tab" aria-controls="nav-internal-prescriptions"
                        aria-selected="false"><i
                            class="fas fa-file-prescription mr-1"></i>{{ __('app.texts.internalPrescriptions') }}<span
                            class="badge badge-success ml-1" id="pendingCountInternal">0</span></a>
                    <a class="nav-link" id="nav-paid-prescriptions-tab" data-toggle="tab" href="#nav-paid-prescriptions"
                        role="tab" aria-controls="nav-paid-prescriptions" aria-selected="false"><i
                            class="fas fa-hand-holding-usd mr-1"></i>{{ __('app.texts.paidPrescriptionBills') }}<span
                            class="badge badge-success ml-1" id="paidCount">0</span></a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-prescription-bills" role="tabpanel"
                    aria-labelledby="nav-prescription-bills-tab">
                    @include('prescriptions.prescriptionBillsList')
                </div>
                <div class="tab-pane fade" id="nav-internal-prescriptions" role="tabpanel"
                    aria-labelledby="nav-internal-prescriptions-tab">
                    @include('prescriptions.internalPrescriptions')
                </div>
                <div class="tab-pane fade" id="nav-paid-prescriptions" role="tabpanel"
                    aria-labelledby="nav-paid-prescriptions-tab">
                    @include('prescriptions.paidPrescriptionsList')
                </div>
            </div>
            @include('prescriptions.createExternalPrescriptionBill')
            @include('prescriptions.createInternalPrescriptionBill')
            @include('prescriptions.issuePrescription')
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        // Render Select2 Selected Option
        const templateSelection = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return element.item_brand_name;
        };
        // Render Select2 Options
        const templateResult = (item) => {
            if (!item.id) {
                return item.text;
            }
            element = JSON.parse(item.text);
            return $(
                `<div class="row"><h6 class="font-weight-bold">${element.item_brand_name}</h6><h6 class="font-weight-bold ml-auto">${element.price_text}</h6></div><div class="row">${element.item_generic_name}</div><div class="row font-weight-light">${element.stock_quantity} ${element.item_unit} Available</div><div class="row font-weight-light">Expires on ${element.expire_date}</div>`
            );
        };
        const select2Options = {
            templateResult,
            templateSelection,
            placeholder: "{{ __('app.texts.selectItemBatch') }}",
        };
        $('#batch_id_external').select2(select2Options);
        $('#batch_id_internal').select2(select2Options);
        // Load Batches List
        const loadBatchesList = () => {
            httpService.get("{{ route('batches.available') }}").then(response => {
                $('#batch_id_external').empty();
                $('#batch_id_internal').empty();
                $('#batch_id_external').append(new Option("", undefined), false, false)
                $('#batch_id_internal').append(new Option("", undefined), false, false)
                response.data.forEach(element => {
                    $('#batch_id_external').append(new Option(JSON.stringify(element), element.id),
                        false,
                        false)
                    $('#batch_id_internal').append(new Option(JSON.stringify(element), element.id),
                        false,
                        false)
                });
            });
        }
        const refreshData = () => {
            loadBatchesList();
            loadDataPrescriptions();
            loadDataInternalPrescriptions();
            loadDataPaidPrescriptions();
        }
        $(document).ready(() => {
            refreshData();
        });
    </script>
    @stack('js-stack')
@endsection