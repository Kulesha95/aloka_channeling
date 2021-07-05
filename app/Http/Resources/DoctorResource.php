<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            "username" => $this->user->username,
            "email" => $this->user->email,
            "mobile" => $this->user->mobile,
            "user_type" =>  $this->user->userType->user_type,
            "user_type_id" => $this->user->user_type_id,
            "image" => $this->user->image ?? asset('img/defaults/doctor.jpg'),
            "name" => $this->name,
            "qualification" => $this->qualification,
            "works_at" => $this->works_at,
            "commission_type" => $this->commission_type,
            "commission_amount" => $this->commission_amount,
            "commission" => $this->commission_text,
            "channel_type_id" => $this->channel_type_id,
            "channel_type" =>  $this->channelType->channel_type,
        ];
    }
}