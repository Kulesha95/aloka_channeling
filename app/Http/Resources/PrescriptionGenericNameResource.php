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
            'generic_name' => $this->pivot->genericName->name,
            'dosage' => $this->pivot->dosage . $this->pivot->dosageUnit->unit,
            'duration' => $this->pivot->duration . "/" . $this->pivot->duration_type,
            'directions' => $this->pivot->directions,
        ];
    }
}