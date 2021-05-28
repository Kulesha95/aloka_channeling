<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getAppointmentNumberAttribute()
    {
        return $this->date .
            "/" . $this->schedule->scheduleNumber .
            "/" . str_pad($this->number, 2, '0', STR_PAD_LEFT);
    }

    public function getNumberTextAttribute()
    {
        return str_pad($this->number, 2, '0', STR_PAD_LEFT);
    }

    public function getFeeAttribute()
    {
        return $this->schedule->channeling_fee;
    }

    public function getPaidAttribute()
    {
        return $this->incomes->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return $this->fee - $this->paid;
    }

    public function getFeeTextAttribute()
    {
        return "Rs. " . number_format($this->fee, 2);
    }

    public function getPaidTextAttribute()
    {
        return "Rs. " . number_format($this->paid, 2);
    }

    public function getBalanceTextAttribute()
    {
        return "Rs. " . number_format($this->balance, 2);
    }

    public function getTimeTextAttribute()
    {
        return  Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class)->withTrashed();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withTrashed();
    }

    public function incomes()
    {
        return $this->morphMany(Income::class, 'incomeable');
    }
}