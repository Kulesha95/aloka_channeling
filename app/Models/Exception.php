<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exception extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['schedule_id', 'date'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}