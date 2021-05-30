<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
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
            'item_id' => $this->item_id,
            'item_generic_name' => $this->item->generic_name,
            'item_brand_name' => $this->item->brand_name,
            'item_unit' => $this->item->unit,
            'grn_id' => $this->grn_id,
            'grn_qty' => $this->grn_qty,
            'stock_qty' => $this->stock_qty,
            'sold_qty' => $this->sold_qty,
            'damaged_qty' => $this->damaged_qty,
            'returned_qty' => $this->returned_qty,
            'expired_qty' => $this->expired_qty,
            'dispose_qty' => $this->dispose_qty,
            'price' => $this->price,
            'expire_date' => $this->expire_date
        ];
    }
}