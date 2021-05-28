<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'channeling_fee',
        'repeat'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDoctorFeeAttribute()
    {
        $doctor = $this->doctor;
        if ($doctor->commission_type == "Fixed") {
            $fee = $doctor->commission_amount;
        } else {
            $fee = $this->channeling_fee * $doctor->commission_amount / 100;
        }
        return  "Rs. " . number_format($fee, 2);
    }

    public function getChannelingCenterFeeAttribute()
    {
        $doctor = $this->doctor;
        if ($doctor->commission_type == "Fixed") {
            $fee =  $this->channeling_fee - $doctor->commission_amount;
        } else {
            $fee = $this->channeling_fee * (100 - $doctor->commission_amount) / 100;
        }
        return  "Rs. " . number_format($fee, 2);
    }

    public function getchannelingFeeTextAttribute()
    {
        return  "Rs. " . number_format($this->channeling_fee, 2);
    }

    public function getTimeAttribute()
    {
        return  Carbon::createFromFormat("H:i:s", $this->time_from)->format('h:i A')
            . " - " . Carbon::createFromFormat("H:i:s", $this->time_to)->format('h:i A');
    }

    public function getScheduleNumberAttribute()
    {
        return "SCH" . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->withTrashed();
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}