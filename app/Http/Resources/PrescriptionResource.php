<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
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
            "prescription_type" => $this->prescription_type,
            "prescription_type_text" => $this->prescription_type_text,
            "comment" => $this->comment,
            "date" => $this->date,
            "time" => $this->time,
            "appointment_id" => $this->appointment_id,
            "prescription_number" => $this->prescription_number,
            "status" => $this->status,
            "status_text" => $this->status_text,
            "total" => $this->total,
            "paid" => $this->paid,
            "balance" => $this->balance,
            "total_text" => $this->fee_text,
            "paid_text" => $this->paid_text,
            "balance_text" => $this->balance_text,
            "total_text" => $this->total_text,
            "exploration_types" => $this->explorationTypes->pluck('id'),
        ];
    }
}