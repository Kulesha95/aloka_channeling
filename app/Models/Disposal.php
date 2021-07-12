<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time'];

    public function getTotalAttribute()
    {
        return $this->batches->sum(function ($batch) {
            return $batch->pivot->quantity * $batch->purchase_price;
        });
    }

    public function getTotalTextAttribute()
    {
        return "Rs. " . number_format($this->total, 2);
    }

    public function getDisposalNumberAttribute()
    {
        return "DSP/" . str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getTimeTextAttribute()
    {
        return  Carbon::createFromFormat("H:i:s", $this->time)->format('h:i A');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class)->withPivot([
            'quantity',
            'reason',
        ]);
    }

    public function batchMovements()
    {
        return $this->morphMany(BatchMovements::class, 'batch_moveable');
    }
}