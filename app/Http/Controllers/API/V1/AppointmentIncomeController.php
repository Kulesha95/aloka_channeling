<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Appointments;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeResource;
use App\Models\Appointment;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function index(Appointment $appointment)
    {
        return ResponseHelper::findSuccess(
            'Incomes',
            IncomeResource::collection($appointment->incomes)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Appointment $appointment)
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
        $income = $appointment->incomes()->create(
            $request->only('reason', 'amount') +
                [
                    'date' => Carbon::now()->format("Y-m-d"),
                    'time' => Carbon::now()->format("H:i:s")
                ]
        );
        if ($appointment->fee <= $appointment->paid && $appointment->status == Appointments::CONFIRMED) {
            $appointment->update(['status' => Appointments::PAID]);
        }
        return ResponseHelper::createSuccess(
            'Income',
            new IncomeResource($income)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment, Income $income)
    {
        return ResponseHelper::createSuccess(
            'Income',
            new IncomeResource($income)
        );
    }
}