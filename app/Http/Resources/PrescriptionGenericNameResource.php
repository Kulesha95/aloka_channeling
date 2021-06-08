<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionGenericNameResource extends JsonResource
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
            'generic_name' => $this->pivot->generic_name_text,
            'dosage' => $this->pivot->dosage_text,
            'duration' => $this->pivot->duration_text,
            'directions' => $this->pivot->directions,
        ];
    }
}