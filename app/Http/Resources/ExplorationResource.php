<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExplorationResource extends JsonResource
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
            'date' => $this->date,
            'time' => $this->time,
            'value' => $this->value,
            'value_text' => $this->value_text,
            'comment' => $this->comment,
            'patient_id' => $this->patient_id,
            'exploration_type_id' => $this->exploration_type_id,
            'exploration_type' => $this->explorationType->exploration_type,
        ];
    }
}