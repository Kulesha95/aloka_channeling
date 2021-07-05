<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            "doctor_id" => $this->doctor_id,
            "doctor" => $this->doctor->name,
            "channel_type" => $this->doctor->channelType->channel_type,
            "date_from" => $this->date_from,
            "date_to" => $this->date_to,
            'time_text' => $this->time,
            "time_from" => $this->time_from,
            "time_to" => $this->time_to,
            "channeling_fee" => $this->channeling_fee,
            "repeat" => $this->repeat,
            "repeat_text" => $this->repeat_text,
            "channeling_fee_text" => $this->channeling_fee_text,
            "schedule_number" => $this->schedule_number,
            "balance" => $this->balance,
            "balance_text" => $this->balance_text
        ];
    }
}