<?php

namespace App\Models;

use App\Constants\Prescriptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Prescription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time', 'appointment_id', 'prescription_type', 'comment', 'status'];

    public function getPrescriptionNumberAttribute()
    {
        return "PRCP/" . str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getTotalAttribute()
    {
        return $this->batches->sum(function ($batchItem) {
            return $batchItem->pivot->quantity * $batchItem->pivot->batch->price;
        });
    }

    public function getTotalTextAttribute()
    {
        $total = $this->batches->sum(function ($batchItem) {
            return $batchItem->pivot->quantity * $batchItem->pivot->batch->price;
        });
        return "Rs. " . number_format($total, 2);
    }

    public function getPrescriptionTypeTextAttribute()
    {
        $typesMapping = [
            Prescriptions::EXTERNAL_MEDICAL_PRESCRIPTION => "External Medical Prescription",
            Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION => "Internal Medical Prescription",
            Prescriptions::TEST_PRESCRIPTION => "Test Prescription"
        ];
        return $typesMapping[$this->prescription_type];
    }

    public function getStatusTextAttribute()
    {
        $statusMapping = [
            Prescriptions::NEW_PRESCRIPTION => "New Prescription",
            Prescriptions::PENDING_PRESCRIPTION => "Pending Prescription",
            Prescriptions::CANCELED_PRESCRIPTION => "Canceled Prescription",
            Prescriptions::CONFIRMED_PRESCRIPTION => "Confirmed Prescription",
            Prescriptions::PAID_PRESCRIPTION => "Paid Prescription",
            Prescriptions::ISSUED_PRESCRIPTION => "Issued Prescription"
        ];
        return $statusMapping[$this->status];
    }

    public function getTimeTextAttribute()
    {
        return Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->withTrashed();
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class)->using(BatchPrescription::class)->withPivot(['quantity']);
    }
}