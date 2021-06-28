<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'good_receive_id',
        'good_receive_quantity',
        'stock_quantity',
        'sold_quantity',
        'returnable_quantity',
        'returned_quantity',
        'dispose_quantity',
        'purchase_quantity',
        'purchase_price',
        'price',
        'expire_date'
    ];

    public function getPriceTextAttribute()
    {
        return  "Rs. " . number_format($this->price, 2);
    }

    public function getPurchasePriceTextAttribute()
    {
        return  "Rs. " . number_format($this->purchase_price, 2);
    }

    public function goodReceive()
    {
        return $this->belongsTo(GoodReceive::class)->withTrashed();
    }

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class)->using(BatchPrescription::class)->withPivot(['quantity']);
    }
}