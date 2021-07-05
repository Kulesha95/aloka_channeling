<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function index(Schedule $schedule)
    {
        return ResponseHelper::findSuccess(
            "Expenses",
            ExpenseResource::collection($schedule->expenses)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule, Expense $expense)
    {
        return ResponseHelper::findSuccess(
            "Expense",
            new ExpenseResource($expense)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Schedule $schedule)
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
                'Expense',
                $validator->errors()
            );
        }
        $expense = $schedule->expenses()->create(
            $request->only('reason', 'amount') +
                [
                    'date' => Carbon::now()->format("Y-m-d"),
                    'time' => Carbon::now()->format("H:i:s")
                ]
        );
        return ResponseHelper::createSuccess(
            'Expense',
            new ExpenseResource($expense)
        );
    }
}