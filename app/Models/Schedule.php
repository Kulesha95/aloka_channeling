<?php

namespace App\Models;

use App\Constants\Appointments;
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

    public function getBalanceAttribute()
    {
        $total = $this->appointments->whereIn('status', [
            Appointments::COMPLETED,
            Appointments::PENDING,
        ])->count() * $this->doctor_fee;
        $paid = $this->expenses->sum('amount');
        return $total - $paid;
    }

    public function getBalanceTextAttribute()
    {
        return "Rs. " . number_format($this->balance, 2);
    }

    public function getDoctorFeeAttribute()
    {
        $doctor = $this->doctor;
        if ($doctor->commission_type == "Fixed") {
            $fee = $doctor->commission_amount;
        } else {
            $fee = $this->channeling_fee * $doctor->commission_amount / 100;
        }
        return  $fee;
    }

    public function getDoctorFeeTextAttribute()
    {
        return  "Rs. " . number_format($this->doctor_fee, 2);
    }

    public function getChannelingCenterFeeAttribute()
    {
        $doctor = $this->doctor;
        if ($doctor->commission_type == "Fixed") {
            $fee =  $this->channeling_fee - $doctor->commission_amount;
        } else {
            $fee = $this->channeling_fee * (100 - $doctor->commission_amount) / 100;
        }
        return  $fee;
    }

    public function getChannelingCenterFeeTextAttribute()
    {
        return  "Rs. " . number_format($this->channeling_center_fee, 2);
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

    public function getRepeatTextAttribute()
    {
        if ($this->repeat === 7) {
            return Carbon::createFromDate($this->date_from)->dayName;
        } else {
            return $this->date_to;
        }
    }

    public function getBalanceOnTime($date, $time)
    {
        $total = $this->appointments->whereIn('status', [
            Appointments::COMPLETED,
            Appointments::PENDING,
        ])->where('date', '<=', $date)->count() * $this->doctor_fee;
        $paid = $this->expenses->where('created_at', '<', $date . " " . $time)->sum('amount');
        return $total - $paid;
    }

    public function getBalanceOnTimeText($date, $time)
    {
        return "Rs. " . number_format($this->getBalanceOnTime($date, $time), 2);
    }

    public function getBalanceAfterPayment($date, $time, $expenseId)
    {
        return $this->getBalanceOnTime($date, $time) - Expense::find($expenseId)->amount;
    }

    public function getBalanceAfterPaymentText($date, $time, $expenseId)
    {
        return "Rs. " . number_format($this->getBalanceAfterPayment($date, $time, $expenseId), 2);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->withTrashed();
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function expenses()
    {
        return $this->morphMany(Expense::class, 'expensable');
    }
}