<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
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
            "reason" => $this->reason,
            "amount" => $this->amount,
            "amount_text" => $this->amount_text,
            "invoice_number" => $this->invoice_number,
        ];
    }
}