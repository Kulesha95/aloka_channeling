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
        'reserved_quantity',
        'sold_quantity',
        'returnable_quantity',
        'returned_quantity',
        'dispose_quantity',
        'purchase_quantity',
        'purchase_price',
        'price',
        'expire_date',
        'discount_amount',
        'discount_type',
    ];

    public function getPriceTextAttribute()
    {
        return  "Rs. " . number_format($this->price, 2);
    }

    public function getPurchasePriceTextAttribute()
    {
        return  "Rs. " . number_format($this->purchase_price, 2);
    }

    public function getDiscountAttribute()
    {
        if ($this->discount_type == "Fixed") {
            return $this->discount_amount;
        } else {
            return ($this->discount_amount / 100) * $this->price;
        }
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->price - $this->discount;
    }

    public function getDiscountedPriceTextAttribute()
    {
        return "Rs. " . number_format($this->discounted_price, 2);
    }

    public function getDiscountTextAttribute()
    {
        if ($this->discount_type == "Fixed") {
            return "Rs. " . number_format($this->discount_amount, 2);
        } else {
            return $this->discount_amount . "%";
        }
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