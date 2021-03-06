<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'telephone', 'address', 'register_number'];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function goodReceives()
    {
        return $this->morphMany(GoodReceive::class, 'supplierable');
    }
}