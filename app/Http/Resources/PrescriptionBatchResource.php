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
            'generic_name' => $this->pivot->batch->item->generic_name_text,
            'brand_name' => $this->pivot->batch->item->brand_name,
            'price_text' => $this->pivot->batch->price_text,
            'quantity_text' => $this->pivot->quantity_text,
            'total_text' => $this->pivot->total_text,
            'total' => $this->pivot->total,
        ];
    }
}