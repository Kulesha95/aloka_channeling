<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Prescriptions;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrescriptionBatchResource;
use App\Http\Resources\PrescriptionGenericNameResource;
use App\Http\Resources\PrescriptionResource;
use App\Models\Appointment;
use App\Models\Batch;
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
            $request->only(['prescription_type']),
            [
                'prescription_type' => "required"
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
        if ($prescription->prescription_type == Prescriptions::TEST_PRESCRIPTION) {
            $prescription->explorationTypes()->sync($request->get('exploration_type_id'));
        }
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
        if ($prescription->prescription_type == Prescriptions::TEST_PRESCRIPTION) {
            $prescription->explorationTypes()->sync($request->get('exploration_type_id'));
        }
        $prescription->update($request->only(['comment']));
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
        $date = now()->toDateString();
        $time = now()->toTimeString();
        if ($request->get('prescription_id')) {
            $prescription = Prescription::find($request->get('prescription_id'));
        } else {
            // If new prescription replace with canceled prescription to avoid unwanted data collection or assign new one
            $prescription = Prescription::firstOrCreate(
                ['status' => Prescriptions::CANCELED_PRESCRIPTION],
                [
                    'prescription_type' => Prescriptions::EXTERNAL_MEDICAL_PRESCRIPTION,
                    'date' => $date,
                    'time' => $time
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
        // Check if the item exists on the prescription or else add item to the prescription
        $prescriptionItem = $prescription->batches->find($request->get('batch_id'));
        if ($prescriptionItem) {
            $prescriptionItemQuantity = $prescriptionItem->pivot->quantity;
            $requestedItemQuantity = $request->get('quantity');
            $difference = $requestedItemQuantity - $prescriptionItemQuantity;
            // If the requested quantity is 0 remove the item from the prescription
            if ($requestedItemQuantity == "0") {
                $quantity = $prescriptionItemQuantity;
                $fromStock = "Reserved Stock";
                $fromColumn = "reserved_quantity";
                $toStock = "Main Stock";
                $toColumn = "stock_quantity";
                $reason = "Remove Reserved Item From The Prescription";
                $prescription->batches()->detach($request->get('batch_id'));
            } else {
                // Check the quantity difference and adjust the inventory accordingly
                if ($difference > 0) {
                    $quantity = $difference;
                    $fromStock = "Main Stock";
                    $fromColumn = "stock_quantity";
                    $toStock = "Reserved Stock";
                    $toColumn = "reserved_quantity";
                    $reason = "Reserve Item For The Prescription";
                } else {
                    $quantity = $difference * -1;
                    $fromStock = "Reserved Stock";
                    $fromColumn = "reserved_quantity";
                    $toStock = "Main Stock";
                    $toColumn = "stock_quantity";
                    $reason = "Remove Reserved Item From The Prescription";
                }
                $prescription->batches()->syncWithoutDetaching([$request->get('batch_id') => ['quantity' => $request->get('quantity')]]);
            }
        } else {
            $quantity = $request->get('quantity');
            $fromStock = "Main Stock";
            $fromColumn = "stock_quantity";
            $toStock = "Reserved Stock";
            $toColumn = "reserved_quantity";
            $reason = "Reserve Item For The Prescription";
            $prescription->batches()->syncWithoutDetaching([$request->get('batch_id') => ['quantity' => $request->get('quantity')]]);
        }
        // Update stocks
        $batch = Batch::find($request->get('batch_id'));
        $batch->update([$fromColumn => $batch[$fromColumn] - $quantity, $toColumn => $batch[$toColumn] + $quantity]);
        // Insert items movement record
        $prescription->batchMovements()->create([
            'from' => $fromStock,
            'from_batch' => $request->get('batch_id'),
            'from_quantity' => $quantity,
            'to' => $toStock,
            'to_batch' => $request->get('batch_id'),
            'to_quantity' => $quantity,
            'date' => $date,
            'time' => $time,
            'reason' => $reason
        ]);
        return ResponseHelper::success(
            'Item has been added successfully',
            new PrescriptionResource($prescription)
        );
    }

    /**
     * Add Item To The Prescriptions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        $validator = Validator::make(
            $request->only(['dosage', 'dosage_unit_id', 'duration', 'duration_type', 'direction_id', 'generic_name_id']),
            [
                'generic_name_id' => "required",
                'dosage' => "required",
                'dosage_unit_id' => "required",
                'duration' => "required",
                'duration_type' => "required",
                'direction_id' => "required",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Prescription medicine',
                $validator->errors()
            );
        }
        // Find related prescription or assign prescription if a new one
        $prescription = Prescription::find($request->get('prescription_id'));
        // If quantity is 0 remove the existing items or else add the item
        if ($request->get('dosage') == "0") {
            $prescription->genericNames()->detach($request->get('generic_name_id'));
        } else {
            $itemPrescription = $prescription->genericNames()->syncWithoutDetaching([$request->get('generic_name_id') => [
                'dosage' => $request->get('dosage'),
                'dosage_unit_id' => $request->get('dosage_unit_id'),
                'duration' => $request->get('duration'),
                'duration_type' => $request->get('duration_type'),
                'directions' => implode("|", $request->get('direction_id'))
            ]]);
        }
        return ResponseHelper::success(
            'Item has been added successfully',
            new PrescriptionResource($prescription)
        );
    }

    /**
     * Get Batches From The Prescriptions
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
     * Get Items From The Prescriptions
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function items(Prescription $prescription)
    {
        return ResponseHelper::findSuccess(
            'Items',
            PrescriptionGenericNameResource::collection($prescription->genericNames)
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
        $date = now()->toDateString();
        $time = now()->toTimeString();
        if (
            $request->get('status') == Prescriptions::CANCELED_PRESCRIPTION ||
            $request->get('status') == Prescriptions::ISSUED_PRESCRIPTION
        ) {
            if ($request->get('status') == Prescriptions::CANCELED_PRESCRIPTION) {
                $fromStock = "Reserved Stock";
                $fromColumn = "reserved_quantity";
                $toStock = "Main Stock";
                $toColumn = "stock_quantity";
                $reason = "Remove Reserved Item From The Prescription";
            } else {
                $fromStock = "Reserved Stock";
                $fromColumn = "reserved_quantity";
                $toStock = "Sold Stock";
                $toColumn = "sold_quantity";
                $reason = "Issue Prescription Items";
            }
            foreach ($prescription->batches as $batch) {
                $batch->update([
                    $fromColumn => $batch[$fromColumn] - $batch->pivot->quantity,
                    $toColumn => $batch[$toColumn] + $batch->pivot->quantity
                ]);
                $prescription->batchMovements()->create([
                    'from' => $fromStock,
                    'from_batch' => $batch->id,
                    'from_quantity' => $batch->pivot->quantity,
                    'to' => $toStock,
                    'to_batch' => $batch->id,
                    'to_quantity' => $batch->pivot->quantity,
                    'date' => $date,
                    'time' => $time,
                    'reason' => $reason
                ]);
            }
        }
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
            ->get()->where('status', Prescriptions::NEW_PRESCRIPTION);
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

    /**
     * Create new empty prescription
     *
     * @param  \App\Models\Prescription  $appointment
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function createNew(Request $request, Appointment $appointment)
    {
        $prescription = $appointment->prescriptions()->create($request->all() + [
            "date" => now()->toDateString(),
            "time" => now()->toTimeString(),
            "status" => Prescriptions::NEW_PRESCRIPTION
        ]);
        $data = [
            'prescription' => new PrescriptionResource($prescription),
        ];
        return ResponseHelper::findSuccess('Prescription', $data);
    }

    /**
     * Get all returnable prescription details
     *
     * @return \Illuminate\Http\Response
     */
    public function returnable()
    {
        $data = Prescription::where('status', Prescriptions::ISSUED_PRESCRIPTION)
            ->where('date', '>=', Carbon::now()->subWeek()->toDateString())
            ->get();
        return ResponseHelper::findSuccess('Prescription', PrescriptionResource::collection($data));
    }
}