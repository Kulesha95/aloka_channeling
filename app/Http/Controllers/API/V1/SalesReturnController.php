<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesReturnResource;
use App\Models\Batch;
use App\Models\SalesReturn;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess("Sales Returns", SalesReturnResource::collection(SalesReturn::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $batches = $request->input('batch_id', []);
        $prices = $request->input('return_price', []);
        $reasons = $request->input('return_reason', []);
        $quantities = $request->input('return_quantity', []);
        $date = now()->toDateString();
        $time = now()->toTimeString();
        $salesReturn = SalesReturn::create([
            'prescription_id' => $request->get('prescription_id'),
            "date" => $date,
            "time" => $time
        ]);
        foreach ($quantities as $rowId => $quantity) {
            if ($quantity == 0) continue;
            $batch = Batch::find($batches[$rowId]);
            $batch->update(['sales_returned_quantity' => $batch->sales_returned_quantity + $quantity]);
            $salesReturn->batches()->attach([$batch->id => ['quantity' => $quantity, 'reason' => $reasons[$rowId], 'price' => $prices[$rowId]]]);
        }
        return ResponseHelper::createSuccess("Sales Return", $salesReturn);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesReturn  $salesReturn
     * @return \Illuminate\Http\Response
     */
    public function show(SalesReturn $salesReturn)
    {
        return ResponseHelper::findSuccess("Sales Return", $salesReturn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesReturn  $salesReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesReturn $salesReturn)
    {
        $salesReturn->delete();
        return ResponseHelper::deleteSuccess('Sales Return');
    }
}