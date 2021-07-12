<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BatchPrescription extends Pivot
{
    public function getQuantityTextAttribute()
    {
        return number_format($this->quantity, 2) . " " . $this->batch->item->unit;
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->batch->price;
    }

    public function getTotalTextAttribute()
    {
        return "Rs. " . number_format($this->quantity * $this->batch->price, 2);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class)->withTrashed();
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class)->withTrashed();
    }
}