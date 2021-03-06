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
        return $this->quantity * $this->discounted_price;
    }

    public function getTotalTextAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getDiscountTextAttribute()
    {
        return $this->discount ? $this->batch->discount_text : '-';
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->discount ? $this->batch->discounted_price : $this->batch->price;
    }

    public function getDiscountedPriceTextAttribute()
    {
        return number_format($this->discounted_price, 2);
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