<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            "user_id" => $this->user_id,
            "username" => $this->user->username,
            "email" => $this->user->email,
            "mobile" => $this->user->mobile,
            "user_type_id" => $this->user->user_type_id,
            "image" => $this->user->image ?? asset('img/defaults/patient.jpg'),
            "name" => $this->name,
            "address" => $this->address,
            "gender" => $this->gender,
            "birth_date" => $this->birth_date,
            "id_number" => $this->id_number,
            "id_type" => $this->id_type,
            "age" => $this->age,
            "age_text" => $this->age_text,
        ];
    }
}