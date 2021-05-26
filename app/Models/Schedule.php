<?php

namespace App\Models;

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($schedule) {
            foreach ($schedule->appointments as $appointment) {
                $appointment->delete();
            }
        });
    }

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

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}