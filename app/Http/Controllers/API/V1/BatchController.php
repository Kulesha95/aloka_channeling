<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BatchResource;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess('Batches', BatchResource::collection(Batch::all()));
    }

    /**
     * Display the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        return ResponseHelper::findSuccess('Batches', new BatchResource($batch));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $validator = Validator::make(
            $request->only(['price', 'discount_type', 'discount_amount']),
            [
                'price' => 'required',
                'discount_type' => 'required',
                'discount_amount' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Batch',
                $validator->errors()
            );
        }
        $batch->update($request->only(['price', 'discount_type', 'discount_amount']));
        return ResponseHelper::updateSuccess(
            'Batch',
            new BatchResource($batch)
        );
    }

    /**
     * Get stock available batches
     *
     * @return \Illuminate\Http\Response
     */
    public function available()
    {
        $batches = Batch::where('stock_quantity', '>', '0')->get();
        return ResponseHelper::findSuccess('Batches', BatchResource::collection($batches));
    }
}