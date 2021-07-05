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

    public function getFeeAttribute()
    {
        return $this->total;
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
        return "Rs. " . number_format($this->total, 2);
    }

    public function getPaidTextAttribute()
    {
        return "Rs. " . number_format($this->paid, 2);
    }

    public function getBalanceTextAttribute()
    {
        return "Rs. " . number_format($this->balance, 2);
    }

    public function getInvoiceAttribute()
    {
        return $this->incomes->last();
    }

    public function getInvoiceTimeAttribute()
    {
        return $this->invoice ? $this->invoice->time_text : "N/A";
    }

    public function getInvoiceDateAttribute()
    {
        return $this->invoice ? $this->invoice->date : "N/A";
    }

    public function getInvoiceNumberAttribute()
    {
        return $this->invoice ? $this->invoice->invoice_number : "N/A";
    }

    public function getTreatmentsEndDateAttribute()
    {
        $items = $this->genericNames;
        if ($items->count() > 0) {
            $longestMedicine = $items->sortByDesc(function ($item) {
                return $item->pivot->duration * floor(365 / $item->pivot->duration_type);
            })->first();
            return now()
                ->addDays($longestMedicine->pivot->duration * floor(365 / $longestMedicine->pivot->duration_type))
                ->toDateString();
        } else {
            return $this->date;
        }
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->withTrashed();
    }

    public function incomes()
    {
        return $this->morphMany(Income::class, 'incomeable');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class)->using(BatchPrescription::class)->withPivot(['quantity']);
    }

    public function genericNames()
    {
        return $this->belongsToMany(GenericName::class)->using(GenericNamePrescription::class)->withPivot(['dosage', 'dosage_unit_id', 'duration', 'duration_type', 'directions']);
    }

    public function explorationTypes()
    {
        return $this->belongsToMany(ExplorationType::class);
    }

    public function batchMovements()
    {
        return $this->morphMany(BatchMovements::class, 'batch_moveable');
    }
}