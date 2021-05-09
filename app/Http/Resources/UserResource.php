<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "username" => $this->username,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "user_type" => $this->userType ? $this->userType->user_type : "<span class='badge badge-pill badge-danger'>Deleted</span>",
            "user_type_id" => $this->user_type_id,
            "image" => $this->image ?? asset('img/defaults/user.jpg')
        ];
    }
}