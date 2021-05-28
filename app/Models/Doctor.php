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

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function channelType()
    {
        return $this->belongsTo(ChannelType::class)->withTrashed();
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}