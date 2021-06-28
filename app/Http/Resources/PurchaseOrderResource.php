<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            "date" => $this->date,
            "time" => $this->time,
            "supplier_id" => $this->supplier_id,
            "supplier_text" => $this->supplier_text,
            "purchase_order_number" => $this->purchase_order_number,
            "status" => $this->status,
            "status_text" => $this->status_text
        ];
    }
}