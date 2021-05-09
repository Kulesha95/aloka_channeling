<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'qualification',
        'works_at',
        'commission_amount',
        'commission_type',
        'user_id',
        'channel_type_id'
    ];
    
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($doctor) {
            foreach ($doctor->schedules as $schedule) {
                $schedule->delete();
            }
            $doctor->user()->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channelType()
    {
        return $this->belongsTo(ChannelType::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}