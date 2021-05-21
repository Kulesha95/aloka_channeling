<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'time',
        'reason',
        'patient_id',
        'schedule_id',
        'comment',
        'status',
        'number'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}