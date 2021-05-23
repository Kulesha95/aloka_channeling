<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'time',
        'reason',
        'amount',
    ];

    public function getAmountTextAttribute()
    {
        return  "Rs. " . number_format($this->amount, 2);
    }

    public function incomeable()
    {
        return $this->morphTo();
    }
}