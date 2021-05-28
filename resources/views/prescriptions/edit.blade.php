<div class="modal fade" id="editPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i
                        class="fas fa-fw fa-file-prescription mr-2"></i>{{ __('app.headers.editPrescription') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-action="{{ route('prescriptions.update', ':id') }}" method="POST" id="editPrescriptionForm">
                    @method('PUT')
                    <input type="hidden" name="appointment_id" id="appointment_id_prescription_edit">
                    <div class="form-group">
                        <label for="prescription_type">{{ __('app.fields.prescriptionType') }}</label>
                        <select id="prescription_type_prescription_edit" class="form-control" name="prescription_type"
                            placeholder="{{ __('app.fields.prescription') }}">
                            <option value="" selected disabled>{{ __('app.texts.selectPrescriptionType') }}</option>
                            <option value="{{ $medicalPrescription }}">{{ __('app.texts.medicalPrescriptions') }}
                            </option>
                            <option value="{{ $testPrescription }}">{{ __('app.texts.testPrescriptions') }}
                            </option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="comment">{{ __('app.fields.comment') }}</label>
                        <textarea id="comment_prescription_edit" class="form-control" name="comment"
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