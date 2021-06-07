<div class="modal fade" id="editTestPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.editTestPrescription') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('prescriptions.update', ':id') }}" method="POST"
                    id="editTestPrescriptionForm">
                    @method('PUT')
                    <input type="hidden" name="appointment_id" id="appointment_id_test_prescription_edit">
                    <input type="hidden" name="prescription_type" value="{{ $testPrescription }}">
                    <div class="row m-1" id="tests_list_test_prescription_edit">

                    </div>
                    <hr>
                    <div class="form-group mt-2">
                        <label for="comment">{{ __('app.fields.comment') }}</label>
                        <textarea id="comment_test_prescription_edit" class="form-control" name="comment"
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
        formHandler.handleEdit(`editTestPrescriptionForm`, ['comment'], loadDataPrescriptions,
            `editTestPrescriptionModal`, "_test_prescription_edit");
    </script>
@endpush