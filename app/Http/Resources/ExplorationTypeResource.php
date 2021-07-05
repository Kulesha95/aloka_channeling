<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExplorationTypeResource extends JsonResource
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
            'exploration_type' => $this->exploration_type,
            'unit' => $this->unit,
            'is_test' => $this->is_test,
            'is_test_text' => $this->is_test_text,
            'is_numeric_value' => $this->is_numeric_value,
            'is_numeric_value_text' => $this->is_numeric_value_text
        ];
    }
}