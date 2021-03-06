<?php

namespace App\Models;

use App\Constants\GoodReceives;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodReceive extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'time',
    ];

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($batch) {
            return $batch->pivot->purchase_quantity * $batch->pivot->purchase_price;
        });
    }

    public function getTotalTextAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getPaidAttribute()
    {
        return $this->expenses->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return $this->total - $this->paid;
    }

    public function getFeeTextAttribute()
    {
        return number_format($this->fee, 2);
    }

    public function getPaidTextAttribute()
    {
        return number_format($this->paid, 2);
    }

    public function getBalanceTextAttribute()
    {
        return number_format($this->balance, 2);
    }


    public function getSupplierAttribute()
    {
        return $this->supplierable_type == GoodReceives::PURCHASE_ORDER
            ? $this->supplierable->supplier
            : $this->supplierable;
    }

    public function getSupplierNameAttribute()
    {
        return $this->supplier->name;
    }

    public function getGoodReceiveNumberAttribute()
    {
        return "GRN/" . str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getTimeTextAttribute()
    {
        return  Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function supplierable()
    {
        return $this->morphTo();
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, "batches")->withPivot([
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
        ]);
    }

    public function expenses()
    {
        return $this->morphMany(Expense::class, 'expensable');
    }

    public function batchMovements()
    {
        return $this->morphMany(BatchMovements::class, 'batch_moveable');
    }
}