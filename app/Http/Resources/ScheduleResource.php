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
        if ($this->repeat === 7) {
            $repeat_text = Carbon::createFromDate($this->date_from)->dayName;
        } else {
            $repeat_text = $this->date_to;
        }
        return [
            "id" => $this->id,
            "doctor_id" => $this->doctor_id,
            "doctor" => $this->doctor->name,
            "channel_type" => $this->doctor->channelType->channel_type,
            "date_from" => $this->date_from,
            "date_to" => $this->date_to,
            'time' => Carbon::createFromFormat("H:i:s", $this->time_from)->format('h:iA') . " - " . Carbon::createFromFormat("H:i:s", $this->time_to)->format('h:iA'),
            "time_from" => $this->time_from,
            "time_to" => $this->time_to,
            "channeling_fee" => $this->channeling_fee,
            "repeat" => $this->repeat,
            "repeat_text" => $repeat_text,
            "channeling_fee_text" => "Rs." . $this->channeling_fee,
        ];
    }
}