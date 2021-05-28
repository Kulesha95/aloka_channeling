<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Items',
            ItemResource::collection(Item::all())
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
        $validator = Validator::make(
            $request->only(['generic_name', 'brand_name', 'reorder_level', 'reorder_quantity', 'item_type_id', 'unit']),
            [
                'generic_name' => 'required',
                'brand_name' => 'required',
                'reorder_level' => 'required',
                'reorder_quantity' => 'required',
                'item_type_id' => 'required',
                'unit' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Item',
                $validator->errors()
            );
        }
        $item = Item::create($request->only(['generic_name', 'brand_name', 'reorder_level', 'reorder_quantity', 'item_type_id', 'unit']));
        return ResponseHelper::createSuccess(
            'Item',
            new ItemResource($item)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return ResponseHelper::findSuccess(
            'Item',
            new ItemResource($item)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validator = Validator::make(
            $request->only(['generic_name', 'brand_name', 'reorder_level', 'reorder_quantity', 'item_type_id', 'unit']),
            [
                'generic_name' => 'required',
                'brand_name' => 'required',
                'reorder_level' => 'required',
                'reorder_quantity' => 'required',
                'item_type_id' => 'required',
                'unit' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Item',
                $validator->errors()
            );
        }
        $item->update($request->only(['generic_name', 'brand_name', 'reorder_level', 'reorder_quantity', 'item_type_id', 'unit']));
        return ResponseHelper::updateSuccess(
            'Item',
            new ItemResource($item)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return ResponseHelper::deleteSuccess('Item');
    }
}