<?php

namespace App\Models;

use Carbon\Carbon;
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
        return  number_format($this->amount, 2);
    }

    public function getInvoiceNumberAttribute()
    {
        return  "INV/" . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function getTimeTextAttribute()
    {
        return  Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function incomeable()
    {
        return $this->morphTo();
    }
}