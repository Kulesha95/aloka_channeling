<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Purchase Orders',
            PurchaseOrderResource::collection(PurchaseOrder::all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return ResponseHelper::findSuccess(
            'Purchase Order',
            new PurchaseOrderResource($purchaseOrder)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suppliers = $request->input('supplier_id', []);
        $quantities = $request->input('quantity', []);
        $purchaseOrders = [];
        foreach ($quantities as $itemId => $quantity) {
            if ($suppliers[$itemId] == 0) continue;
            $purchaseOrders = Arr::prepend(
                $purchaseOrders,
                Arr::prepend($purchaseOrders[$suppliers[$itemId]] ?? [], ["quantity" => $quantity], $itemId),
                $suppliers[$itemId]
            );
        }
        $date = now()->toDateString();
        $time = now()->toTimeString();
        foreach ($purchaseOrders as $supplierId => $items) {
            $purchaseOrder = PurchaseOrder::create(['supplier_id' => $supplierId, "date" => $date, "time" => $time]);
            $purchaseOrder->items()->sync($items);
        }
        return ResponseHelper::createSuccess("Purchase Orders", []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return ResponseHelper::deleteSuccess('Purchase Order');
    }
}