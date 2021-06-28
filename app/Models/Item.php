<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'generic_name_id',
        'brand_name',
        'reorder_level',
        'reorder_quantity',
        'item_type_id',
        'unit',
        'is_sales_item',
        'is_purchase_item'
    ];

    public function getReorderLevelTextAttribute()
    {
        return number_format($this->reorder_level) . " " . $this->unit;
    }

    public function getReorderQuantityTextAttribute()
    {
        return number_format($this->reorder_quantity) . " " . $this->unit;
    }

    public function getGenericNameTextAttribute()
    {
        return $this->genericName->name;
    }

    public function getStockAttribute()
    {
        return $this->batches->sum('stock_quantity');
    }

    public function getStockTextAttribute()
    {
        return number_format($this->stock) . " " . $this->unit;
    }
    public function getExpiredStockAttribute()
    {
        return $this->batches->where('expire_date', '<=', now()->toDateString())->sum('returnable_quantity');
    }

    public function getExpiredStockTextAttribute()
    {
        return number_format($this->expired_stock) . " " . $this->unit;
    }
    public function getReturnableStockAttribute()
    {
        return $this->batches->sum('returnable_quantity');
    }

    public function getReturnableStockTextAttribute()
    {
        return number_format($this->returnable_stock) . " " . $this->unit;
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class)->withTrashed();
    }

    public function genericName()
    {
        return $this->belongsTo(GenericName::class)->withTrashed();
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class);
    }
}