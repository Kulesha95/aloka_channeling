<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['item_type', 'description', 'parent_id'];

    public function getClassificationAttribute()
    {
        return ($this->parentItemType && !$this->parentItemType->trashed())
            ? ($this->parentItemType->classification
                ? $this->parentItemType->classification . " | "
                : null)  . $this->parentItemType->item_type
            : null;
    }

    public function parentItemType()
    {
        return $this->belongsTo(ItemType::class, "parent_id")->withTrashed();
    }

    public function childItemTypes()
    {
        return $this->hasMany(ItemType::class, "parent_id");
    }
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}