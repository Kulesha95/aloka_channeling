<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenericName extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}