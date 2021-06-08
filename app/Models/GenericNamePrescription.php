<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GenericNamePrescription extends Pivot
{
    public function getGenericNameTextAttribute()
    {
        return $this->genericName->name;
    }

    public function getDosageTextAttribute()
    {
        return $this->dosage . "" . $this->dosageUnit->unit;
    }

    public function getDurationTextAttribute()
    {
        return  $this->duration . "/" . $this->duration_type;
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
}