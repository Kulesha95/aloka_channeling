<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemTypeResource;
use App\Models\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Item Types',
            ItemTypeResource::collection(ItemType::all())
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
            $request->only(['item_type', 'description', 'parent_id']),
            [
                'item_type' => "required",
                'description' => "required",
                'parent_id' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Item Type',
                $validator->errors()
            );
        }
        $itemType = ItemType::create($request->only(['item_type', 'description', 'parent_id']));
        return ResponseHelper::createSuccess(
            'Item Type',
            new ItemTypeResource($itemType)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function show(ItemType $itemType)
    {
        return ResponseHelper::findSuccess(
            'Item Type',
            new ItemTypeResource($itemType)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemType $itemType)
    {
        $validator = Validator::make(
            $request->only(['item_type', 'description', 'parent_id']),
            [
                'item_type' => "required",
                'description' => "required",
                'parent_id' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Item Type',
                $validator->errors()
            );
        }
        $itemType->update($request->only(['item_type', 'description', 'parent_id']));
        return ResponseHelper::updateSuccess(
            'Item Type',
            new ItemTypeResource($itemType)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemType $itemType)
    {
        $itemType->delete();
        return ResponseHelper::deleteSuccess('Item Type');
    }
}