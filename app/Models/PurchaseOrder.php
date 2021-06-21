<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time', 'supplier_id'];

    public function getPurchaseOrderNumberAttribute()
    {
        return "PO/" . str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getSupplierTextAttribute()
    {
        return $this->supplier->name;
    }

    public function getTimeTextAttribute()
    {
        return  Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot(['quantity']);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function goodReceives()
    {
        return $this->morphMany(GoodReceive::class, 'supplierable');
    }
}