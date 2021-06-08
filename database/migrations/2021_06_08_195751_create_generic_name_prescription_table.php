<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GenericNamePrescription extends Pivot
{
    public function getDosageTextAttribute()
    {
        return number_format($this->dosage, 2) . " " . $this->dosageUnit->unit;
    }

    public function dosageUnit()
    {
        return $this->belongsTo(DosageUnit::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function genericName()
    {
        return $this->belongsTo(GenericName::class);
    }

    public function directions()
    {
        return $this->belongsToMany(Direction::class);
    }
}