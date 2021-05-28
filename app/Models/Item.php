<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['generic_name', 'brand_name', 'reorder_level', 'reorder_quantity', 'item_type_id', 'unit'];

    public function getReorderLevelTextAttribute()
    {
        return number_format($this->reorder_level) . " " . $this->unit;
    }

    public function getReorderQuantityTextAttribute()
    {
        return number_format($this->reorder_quantity) . " " . $this->unit;
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class)->withTrashed();
    }
}