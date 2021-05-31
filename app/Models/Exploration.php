<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exploration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time', 'value', 'comment', 'prescription_id', 'patient_id', 'exploration_type_id'];

    public function getValueTextAttribute()
    {
        return $this->value . $this->explorationType->unit;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withTrashed();
    }

    public function explorationType()
    {
        return $this->belongsTo(ExplorationType::class)->withTrashed();
    }
}