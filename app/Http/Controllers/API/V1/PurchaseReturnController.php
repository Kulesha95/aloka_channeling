<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseReturnResource;
use App\Models\Batch;
use App\Models\PurchaseReturn;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess("Purchase Returns", PurchaseReturnResource::collection(PurchaseReturn::all()));
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
        $purchaseReturn = PurchaseReturn::create([
            'supplier_id' => $request->get('supplier_id'),
            "date" => $date,
            "time" => $time
        ]);
        foreach ($quantities as $rowId => $quantity) {
            if ($quantity == 0) continue;
            $batch = Batch::find($batches[$rowId]);
            $batch->update([
                'returnable_quantity' => $batch->returnable_quantity - $quantity,
                'returned_quantity' => $batch->returned_quantity + $quantity
            ]);
            $purchaseReturn->batches()->attach([$batch->id => ['quantity' => $quantity, 'reason' => $reasons[$rowId], 'price' => $prices[$rowId]]]);
        }
        return ResponseHelper::createSuccess("Purchase Return", $purchaseReturn);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseReturn $purchaseReturn)
    {
        return ResponseHelper::findSuccess("Purchase Return", $purchaseReturn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->delete();
        return ResponseHelper::deleteSuccess('Purchase Return');
    }
}