<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisposalResource;
use App\Models\Batch;
use App\Models\Disposal;
use Illuminate\Http\Request;

class DisposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess("Disposals", DisposalResource::collection(Disposal::all()));
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
        $reasons = $request->input('return_reason', []);
        $quantities = $request->input('return_quantity', []);
        $date = now()->toDateString();
        $time = now()->toTimeString();
        $disposal = Disposal::create([
            "date" => $date,
            "time" => $time
        ]);
        foreach ($quantities as $rowId => $quantity) {
            if ($quantity == 0) continue;
            $batch = Batch::find($batches[$rowId]);
            $batch->update([
                'returnable_quantity' => $batch->returnable_quantity - $quantity,
                'disposed_quantity' => $batch->returned_quantity + $quantity
            ]);
            $disposal->batches()->attach([$batch->id => ['quantity' => $quantity, 'reason' => $reasons[$rowId]]]);
            $disposal->batchMovements()->create([
                'from' => "Returnable Stock",
                'from_batch' => $batch->id,
                'from_quantity' => $quantity,
                'to' => "Disposed Stock",
                'to_batch' => $batch->id,
                'to_quantity' => $quantity,
                'date' => $date,
                'time' => $time,
                'reason' => 'Disposal'
            ]);
        }
        return ResponseHelper::createSuccess("Disposal", $disposal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disposal  $disposal
     * @return \Illuminate\Http\Response
     */
    public function show(Disposal $disposal)
    {
        return ResponseHelper::findSuccess("Disposal", $disposal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disposal  $disposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disposal $disposal)
    {
        $disposal->delete();
        return ResponseHelper::deleteSuccess('Disposal');
    }
}