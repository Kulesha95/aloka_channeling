<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\PurchaseOrders;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\GoodReceiveResource;
use App\Models\Batch;
use App\Models\GoodReceive;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        if ($request->get('purchase_order_id') > 0) {
            $goodReceive = PurchaseOrder::find($request->get('purchase_order_id'))->goodReceives()->create([
                "date" => $date, "time" => $time
            ]);
        } else {
            $goodReceive = Supplier::find($request->get('supplier_id'))->goodReceives()->create([
                "date" => $date, "time" => $time
            ]);
        }
        $items = $request->input('item_id', []);
        $purchaseQuantities = $request->input('received_quantity', []);
        $freeQuantities = $request->input('free_quantity', []);
        $purchasePrices = $request->input('purchase_price', []);
        $sellingPrices = $request->input('selling_price', []);
        $expireDates = $request->input('expire_date', []);
        foreach ($purchaseQuantities as $rowId => $purchaseQuantity) {
            if ($purchaseQuantity == 0) continue;
            Batch::create([
                "item_id" => $items[$rowId],
                "good_receive_id" => $goodReceive->id,
                "good_receive_quantity" => $purchaseQuantity + $freeQuantities[$rowId],
                "stock_quantity" => $purchaseQuantity + $freeQuantities[$rowId],
                "sold_quantity" => 0,
                "sales_returned_quantity" => 0,
                "purchase_returned_quantity" => 0,
                "dispose_quantity" => 0,
                "purchase_quantity" => $purchaseQuantity,
                "purchase_price" => $purchasePrices[$rowId],
                "price" => $sellingPrices[$rowId],
                "expire_date" => $expireDates[$rowId],
            ]);
        }
        if ($request->get('purchase_order_id') > 0) {
            $status = PurchaseOrders::COMPLETED;
            $purchaseOrderItems = $goodReceive->supplierable->items->mapWithKeys(function ($purchaseOrderItem) {
                return [$purchaseOrderItem->id => $purchaseOrderItem->pivot->quantity];
            });
            $goodReceiveItems = $goodReceive->supplierable->batches->groupBy('item_id')->mapWithKeys(function ($goodReceiveItemCollection) {
                return [$goodReceiveItemCollection->first()->item_id => $goodReceiveItemCollection->sum('purchase_quantity')];
            });
            foreach ($purchaseOrderItems as $itemId => $quantity) {
                if (!(Arr::exists($goodReceiveItems, $itemId) && $goodReceiveItems[$itemId] >= $purchaseOrderItems[$itemId])) {
                    $status = PurchaseOrders::PARTIAL_COMPLETED;
                    break;
                }
            }
            $goodReceive->supplierable->update(['status' => $status]);
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