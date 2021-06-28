<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesReturnResource extends JsonResource
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
            "sales_return_number" => $this->sales_return_number,
            "total" => $this->total,
            "total_text" => $this->total_text,
            "prescription_number" => $this->prescription->prescription_number
        ];
    }
}