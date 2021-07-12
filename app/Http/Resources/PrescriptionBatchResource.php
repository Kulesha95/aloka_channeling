<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionBatchResource extends JsonResource
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
            'id' => $this->pivot->batch->id,
            'generic_name' => $this->pivot->batch->item->generic_name_text,
            'brand_name' => $this->pivot->batch->item->brand_name,
            'price' => $this->pivot->batch->price,
            'quantity' => $this->pivot->quantity,
            'price_text' => $this->pivot->batch->price_text,
            'discount_text' => $this->pivot->discount_text,
            'discounted_price_text' => $this->pivot->discounted_price_text,
            'quantity_text' => $this->pivot->quantity_text,
            'total_text' => $this->pivot->total_text,
            'total' => $this->pivot->total
        ];
    }
}