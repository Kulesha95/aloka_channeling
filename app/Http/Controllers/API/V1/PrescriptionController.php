<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Prescriptions;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrescriptionBatchResource;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Prescriptions',
            PrescriptionResource::collection(Prescription::all())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->only(['prescription_type', 'comment']),
            [
                'prescription_type' => "required",
                'comment' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Prescription',
                $validator->errors()
            );
        }
        $prescription = Prescription::create($request->only(['prescription_type', 'comment', 'appointment_id']) +
            ["date" => now()->toDateString(), "time" => now()->toTimeString(), "status" => Prescriptions::NEW_PRESCRIPTION]);
        return ResponseHelper::createSuccess(
            'Prescription',
            new PrescriptionResource($prescription)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        return ResponseHelper::findSuccess(
            'Prescription',
            new PrescriptionResource($prescription)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validator = Validator::make(
            $request->only(['prescription_type', 'comment']),
            [
                'prescription_type' => "required",
                'comment' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Prescription',
                $validator->errors()
            );
        }
        $prescription->update($request->only(['prescription_type', 'comment', 'appointment_id']));
        return ResponseHelper::updateSuccess(
            'Prescription',
            new PrescriptionResource($prescription)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return ResponseHelper::deleteSuccess('Prescription');
    }

    /**
     * Add Batch To The Prescriptions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addBatch(Request $request)
    {
        $validator = Validator::make(
            $request->only(['batch_id', 'quantity']),
            [
                'batch_id' => "required",
                'quantity' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Prescription',
                $validator->errors()
            );
        }
        // Find related prescription or assign prescription if a new one
        if ($request->get('prescription_id')) {
            $prescription = Prescription::find($request->get('prescription_id'));
        } else {
            // If new prescription replace with canceled prescription to avoid unwanted data collection or assign new one
            $prescription = Prescription::firstOrCreate(
                ['status' => Prescriptions::CANCELED_PRESCRIPTION],
                [
                    'prescription_type' => Prescriptions::EXTERNAL_MEDICAL_PRESCRIPTION,
                    'date' => now()->toDateString(),
                    'time' => now()->toTimeString()
                ]
            );
            // If a Cancelled prescription make it empty
            $prescription->batches()->detach();
        }
        // If a new prescription or canceled update the status to pending
        if ($prescription->status == Prescriptions::NEW_PRESCRIPTION || $prescription->status == Prescriptions::CANCELED_PRESCRIPTION) {
            $prescription->update(['status' => Prescriptions::PENDING_PRESCRIPTION]);
        }
        // If not a pending prescription avoid modifying
        if ($prescription->status != Prescriptions::PENDING_PRESCRIPTION) {
            return ResponseHelper::error("Can not modified items list of this prescription", []);
        }
        // If quantity is 0 remove the existing items or else add the item
        $request->get('quantity') == "0"
            ? $prescription->batches()->detach($request->get('batch_id'))
            : $prescription->batches()->syncWithoutDetaching([$request->get('batch_id') => ['quantity' => $request->get('quantity')]]);
        return ResponseHelper::success(
            'Item has been added successfully',
            new PrescriptionResource($prescription)
        );
    }

    /**
     * Get Items From The Prescriptions
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function batches(Prescription $prescription)
    {
        return ResponseHelper::findSuccess(
            'Batches',
            [
                "items" => PrescriptionBatchResource::collection($prescription->batches),
                "total" => $prescription->total,
                "total_text" => $prescription->total_text,
            ]
        );
    }

    /**
     * Update status of the prescriptions
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Prescription $prescription)
    {
        $prescription->update(["status" => $request->get('status')]);
        return ResponseHelper::updateSuccess('Prescription', new PrescriptionResource($prescription));
    }

    /**
     * Get Prescription Bills
     *
     * @return \Illuminate\Http\Response
     */
    public function prescriptionBills()
    {
        $prescriptions = Prescription::all()->whereIn("status", [Prescriptions::PENDING_PRESCRIPTION, Prescriptions::CONFIRMED_PRESCRIPTION]);
        return ResponseHelper::updateSuccess('Prescription', PrescriptionResource::collection($prescriptions));
    }

    /**
     * Get Pending Internal Prescriptions
     *
     * @return \Illuminate\Http\Response
     */
    public function internalPrescriptions()
    {
        $prescriptions = Prescription::where('prescription_type', Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION)
            ->get()->whereIn('status', [Prescriptions::NEW_PRESCRIPTION, Prescriptions::PENDING_PRESCRIPTION]);
        return ResponseHelper::updateSuccess('Prescription', PrescriptionResource::collection($prescriptions));
    }

    /**
     * Get Payment Pending Prescriptions List
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingPayments()
    {
        $prescriptions = Prescription::all()->filter(function ($prescription) {
            return $prescription->balance != 0 && $prescription->status == Prescriptions::CONFIRMED_PRESCRIPTION;
        });
        return ResponseHelper::findSuccess('Prescriptions', PrescriptionResource::collection($prescriptions));
    }

    /**
     * Get payment Completed Prescriptions List
     *
     * @return \Illuminate\Http\Response
     */
    public function paid()
    {
        $prescriptions = Prescription::where('status', Prescriptions::PAID_PRESCRIPTION)->get();
        return ResponseHelper::findSuccess('Prescriptions', PrescriptionResource::collection($prescriptions));
    }

    /**
     * Get all prescription details
     *
     * @param  \App\Models\Prescription  $appointment
     * @return \Illuminate\Http\Response
     */
    public function prescriptionDetails(Prescription $prescription)
    {
        $data = [
            'prescription' => new PrescriptionResource($prescription),
        ];
        return ResponseHelper::findSuccess('Prescription', $data);
    }
}