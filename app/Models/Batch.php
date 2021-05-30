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
        'grn_id',
        'grn_qty',
        'stock_qty',
        'sold_qty',
        'damaged_qty',
        'returned_qty',
        'expired_qty',
        'dispose_qty',
        'price',
        'expire_date'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}