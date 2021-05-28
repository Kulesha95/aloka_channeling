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
            Appointments::REJECTED => "Rejected Appointment",
            Appointments::PAID => "Paid Appointment",
            Appointments::PENDING => "Reports Pending Appointment",
        ];
        return [
            "id" => $this->id,
            "appointment_number" => $this->appointment_number,
            "number" => $this->number,
            "date" => $this->date,
            "time" => $this->time,
            "reason" => $this->reason,
            "patient_id" => $this->patient_id,
            "patient" => $this->patient->name . " - " . $this->patient->id_number,
            "schedule_id" => $this->schedule_id,
            "doctor" => $this->schedule->doctor->name . " - " . $this->schedule->doctor->channelType->channel_type,
            "comment" => $this->comment,
            "status" => $this->status,
            "status_text" => $status[$this->status],
            "fee" => $this->fee,
            "paid" => $this->paid,
            "balance" => $this->balance,
            "fee_text" => $this->fee_text,
            "paid_text" => $this->paid_text,
            "balance_text" => $this->balance_text,
            "number_text" => $this->number_text,
        ];
    }
}