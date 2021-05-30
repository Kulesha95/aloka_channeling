<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Prescriptions;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeResource;
use App\Models\Prescription;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function index(Prescription $prescription)
    {
        return ResponseHelper::findSuccess(
            'Incomes',
            IncomeResource::collection($prescription->incomes)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Prescription $prescription)
    {
        $validator = Validator::make(
            $request->only('reason', 'amount'),
            [
                'reason' => "required",
                'amount' => "required|numeric|not_in:0",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Income',
                $validator->errors()
            );
        }
        $income = $prescription->incomes()->create(
            $request->only('reason', 'amount') +
                [
                    'date' => Carbon::now()->format("Y-m-d"),
                    'time' => Carbon::now()->format("H:i:s")
                ]
        );
        if ($prescription->total <= $prescription->paid && $prescription->status == Prescriptions::CONFIRMED_PRESCRIPTION) {
            $prescription->update(['status' => Prescriptions::PAID_PRESCRIPTION]);
        }
        return ResponseHelper::createSuccess(
            'Income',
            new IncomeResource($income)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription, Income $income)
    {
        return ResponseHelper::createSuccess(
            'Income',
            new IncomeResource($income)
        );
    }
}