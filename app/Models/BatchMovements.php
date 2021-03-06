<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchMovements extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'from_batch',
        'from_quantity',
        'to',
        'to_batch',
        'to_quantity',
        'date',
        'time',
        'reason',
        'batch_moveable_id',
        'batch_moveable_type'
    ];

    public function batchMoveable()
    {
        return $this->morphTo()->withTrashed();
    }
}