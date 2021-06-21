<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemSuppliersResource extends JsonResource
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
            'generic_name' => $this->generic_name_text,
            'brand_name' => $this->brand_name,
            'reorder_quantity' => $this->reorder_quantity,
            'reorder_level' => $this->reorder_level,
            'reorder_level_text' => $this->reorder_level_text,
            'stock' => $this->stock,
            'stock_text' => $this->stock_text,
            'reorder_quantity' => $this->reorder_quantity,
            'suppliers' => SupplierResource::collection($this->suppliers)
        ];
    }
}