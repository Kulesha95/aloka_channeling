<?php

namespace App\Models;

use App\Constants\Prescriptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time', 'appointment_id', 'prescription_type', 'comment'];

    public function getPrescriptionNumberAttribute()
    {
        return "PRCP/" . str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getPrescriptionTypeTextAttribute()
    {
        return $this->prescription_type == Prescriptions::EXTERNAL_MEDICAL_PRESCRIPTION
            ? "External Medical Prescription"
            : ($this->prescription_type == Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION
                ? "Internal Medical Prescription"
                : "Test Prescription");
    }

    public function getTimeTextAttribute()
    {
        return Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->withTrashed();
    }
}