<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\PurchaseOrders;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DocumentController;
use App\Http\Resources\ItemSuppliersResource;
use App\Http\Resources\PurchaseOrderResource;
use App\Jobs\SendPurchaseOrder;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Notifications\PurchaseOrderCreated;
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
        $quantities = $request->input('quantity', []);
        $date = now()->toDateString();
        $time = now()->toTimeString();
        $purchaseOrder = PurchaseOrder::create([
            'supplier_id' => $request->get('supplier_id'),
            "date" => $date,
            "time" => $time,
            "status" => PurchaseOrders::PENDING
        ]);
        foreach ($quantities as $itemId => $quantity) {
            if ($quantity > 0) {
                $purchaseOrder->items()->attach([$itemId => ["quantity" => $quantity]]);
            }
        }
        $this->dispatch(new SendPurchaseOrder($purchaseOrder->id));
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

    /**
     * Get the items list of the purchase order.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function items(PurchaseOrder $purchaseOrder)
    {
        return ResponseHelper::findSuccess('Items', ItemSuppliersResource::collection($purchaseOrder->items));
    }
}