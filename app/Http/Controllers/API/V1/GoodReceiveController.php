<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\GoodReceiveResource;
use App\Models\Batch;
use App\Models\GoodReceive;
use App\Models\Supplier;
use Illuminate\Http\Request;

class GoodReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess("Good Receives", GoodReceiveResource::collection(GoodReceive::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = now()->toDateString();
        $time = now()->toTimeString();
        if ($request->has('supplier_id')) {
            $goodReceive = Supplier::find($request->get('supplier_id'))->goodReceives()->create([
                "date" => $date, "time" => $time
            ]);
        }
        $purchaseQuantities = $request->input('received_quantity', []);
        $freeQuantities = $request->input('free_quantity', []);
        $purchasePrices = $request->input('purchase_price', []);
        $sellingPrices = $request->input('selling_price', []);
        $expireDates = $request->input('expire_date', []);
        foreach ($purchaseQuantities as $itemId => $purchaseQuantity) {
            if ($purchaseQuantity == 0) continue;
            Batch::create([
                "item_id" => $itemId,
                "good_receive_id" => $goodReceive->id,
                "good_receive_quantity" => $purchaseQuantity + $freeQuantities[$itemId],
                "stock_quantity" => $purchaseQuantity + $freeQuantities[$itemId],
                "sold_quantity" => 0,
                "damaged_quantity" => 0,
                "returned_quantity" => 0,
                "expired_quantity" => 0,
                "dispose_quantity" => 0,
                "purchase_quantity" => $purchaseQuantity,
                "purchase_price" => $purchasePrices[$itemId],
                "price" => $sellingPrices[$itemId],
                "expire_date" => $expireDates[$itemId],
            ]);
        }
        return ResponseHelper::createSuccess("Goods Receive", $goodReceive);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodsReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function show(GoodReceive $goodReceife)
    {
        return ResponseHelper::findSuccess(
            'Goods Receive',
            new GoodReceiveResource($goodReceife)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodsReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodReceive $goodReceife)
    {
        $goodReceife->delete();
        return ResponseHelper::deleteSuccess('Goods Receive');
    }
}