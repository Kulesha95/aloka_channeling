<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time', 'prescription_id'];

    public function getTotalAttribute()
    {
        return $this->batches->sum(function ($batch) {
            return $batch->pivot->quantity * $batch->pivot->price;
        });
    }

    public function getTotalTextAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getSalesReturnNumberAttribute()
    {
        return "SRN/" . str_pad($this->id, 5, 0, STR_PAD_LEFT);
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
            'price',
        ]);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class)->withTrashed();
    }

    public function batchMovements()
    {
        return $this->morphMany(BatchMovements::class, 'batch_moveable');
    }
}