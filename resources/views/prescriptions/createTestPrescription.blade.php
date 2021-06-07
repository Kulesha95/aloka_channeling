<div class="modal fade" id="createTestPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.createTestPrescription') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('prescriptions.store') }}" method="POST" id="createTestPrescriptionForm">
                    <input type="hidden" name="appointment_id" id="appointment_id_test_prescription_create">
                    <input type="hidden" name="prescription_type" value="{{ $testPrescription }}">
                    <div class="row m-1" id="tests_list_test_prescription_create">

                    </div>
                    <hr>
                    <div class="form-group mt-2">
                        <label for="comment">{{ __('app.fields.comment') }}</label>
                        <textarea id="comment_test_prescription_create" class="form-control" name="comment"
                            placeholder="{{ __('app.fields.comment') }}"></textarea>
                        <div class="invalid-feedback"></div>
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

@push('js-stack')
    <script>
        // Handle Create Form Submit
        formHandler.handleSave(`createTestPrescriptionForm`, ['comment'], loadDataPrescriptions,
            `createTestPrescriptionModal`, "_test_prescription_create");
    </script>
@endpush