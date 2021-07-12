<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DisposalResource extends JsonResource
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
            "disposal_number" => $this->disposal_number,
            "date" => $this->date,
            "time" => $this->time,
            "total" => $this->total,
            "total_text" => $this->total_text,
        ];
    }
}