<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'generic_name_id' => $this->generic_name_id,
            'generic_name_text' => $this->generic_name_text,
            'brand_name' => $this->brand_name,
            'reorder_level' => $this->reorder_level,
            'reorder_level_text' => $this->reorder_level_text,
            'reorder_quantity' => $this->reorder_quantity,
            'reorder_quantity_text' => $this->reorder_quantity_text,
            'item_type_id' => $this->item_type_id,
            'item_type_text' => $this->itemType->item_type,
            'unit' => $this->unit,
            'is_sales_item' => $this->is_sales_item,
            'is_purchase_item' => $this->is_purchase_item
        ];
    }
}