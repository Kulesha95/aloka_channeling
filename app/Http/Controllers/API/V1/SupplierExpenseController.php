<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\GoodReceive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\GoodReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function index(GoodReceive $goodReceive)
    {
        return ResponseHelper::findSuccess(
            "Expenses",
            ExpenseResource::collection($goodReceive->expenses)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoodReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, GoodReceive $goodReceive)
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
        $expense = $goodReceive->expenses()->create(
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