<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExplorationType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['exploration_type', 'unit', 'is_test'];

    public function getIsTestTextAttribute()
    {
        return $this->is_test ? "Yes" : "No";
    }

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class);
    }
}