<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemTypeResource extends JsonResource
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
            "item_type" => $this->item_type,
            "description" => $this->description,
            "parent_id" => $this->parent_id,
            "parent" => $this->parentItemType ? $this->parentItemType->item_type : __('ap/texts.parentItemType'),
            "classification" => $this->classification,
        ];
    }
}