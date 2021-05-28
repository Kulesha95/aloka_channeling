<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            ["date" => now()->toDateString(), "time" => now()->toTimeString()]);
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
        //
    }
}