<?php

namespace App\Http\Resources;

use App\Constants\Appointments;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $status = [
            Appointments::NEW => "New Appointment",
            Appointments::COMPLETED => "Completed Appointment",
            Appointments::CONFIRMED => "Confirmed Appointment",
            Appointments::PAID => "Paid Appointment",
            Appointments::PENDING => "Reports Pending Appointment",
        ];
        return [
            "id" => $this->id,
            "appointment_number" => $this->date .
                "/SCH" . str_pad($this->schedule_id, 5, '0', STR_PAD_LEFT)  .
                "/" . str_pad($this->number, 2, '0', STR_PAD_LEFT),
            "number" => $this->number,
            "date" => $this->date,
            "time" => $this->time,
            "reason" => $this->reason,
            "patient_id" => $this->patient_id,
            "patient" => $this->patient->name . " - " . $this->patient->id_number,
            "schedule_id" => $this->schedule_id,
            "doctor" => $this->schedule->doctor->name . " - " . $this->schedule->doctor->channelType->channel_type,
            "comment" => $this->comment,
            "status" => $status[$this->status],
            "fee" => "Rs. " . number_format($this->schedule->channeling_fee, 2),
            "paid" => $this->status,
            "pending" => $this->status,
        ];
    }
}