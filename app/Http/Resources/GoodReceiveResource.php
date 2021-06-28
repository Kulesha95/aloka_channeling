<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodReceiveResource extends JsonResource
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
            "supplier_name" => $this->supplier_name,
            "good_receive_number" => $this->good_receive_number,
            "date" => $this->date,
            "time" => $this->time,
            "total" => $this->total,
            "total_text" => $this->total_text,
            "paid" => $this->paid,
            "paid_text" => $this->paid_text,
            "balance" => $this->balance,
            "balance_text" => $this->balance_text,
        ];
    }
}