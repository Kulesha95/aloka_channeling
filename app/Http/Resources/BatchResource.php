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
            'id' => $this->id,
            'item_id' => $this->item_id,
            'item_generic_name' => $this->item->generic_name_text,
            'item_brand_name' => $this->item->brand_name,
            'item_unit' => $this->item->unit,
            'good_receive_id' => $this->good_receive_id,
            'good_receive_quantity' => $this->good_receive_quantity,
            'stock_quantity' => $this->stock_quantity,
            'sold_quantity' => $this->sold_quantity,
            'damaged_quantity' => $this->damaged_quantity,
            'returned_quantity' => $this->returned_quantity,
            'expired_quantity' => $this->expired_quantity,
            'dispose_quantity' => $this->dispose_quantity,
            'price' => $this->price,
            'expire_date' => $this->expire_date
        ];
    }
}