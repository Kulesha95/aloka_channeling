<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemSuppliersResource;
use App\Models\Item;
use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function index(supplier $supplier)
    {
        return ResponseHelper::findSuccess('Items', ItemSuppliersResource::collection($supplier->items));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, supplier $supplier)
    {
        $supplier->items()->syncWithoutDetaching($request->get('item_id'));
        return ResponseHelper::success('Item has been added successfully', []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier, Item $item)
    {
        $supplier->items()->detach($item->id);
        return ResponseHelper::deleteSuccess('Item');
    }

    /**
     * Get supplier non supplying items
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function nonSupplyingItems(supplier $supplier)
    {
        return ResponseHelper::findSuccess('Items', ItemResource::collection(
            Item::where('is_purchase_item', true)->whereNotIn('id', $supplier->items->pluck('id'))->get()
        ));
    }
}