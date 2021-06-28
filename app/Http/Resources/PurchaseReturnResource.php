<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseReturnResource extends JsonResource
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
            "id" => $this->id,
            "supplier_id" => $this->supplier_id,
            "supplier_text" => $this->supplier_text,
            "purchase_return_number" => $this->purchase_return_number,
            "date" => $this->date,
            "time" => $this->time,
            "total" => $this->total,
            "total_text" => $this->total_text,
        ];
    }
}