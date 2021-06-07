<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['channel_type', 'description', 'colour'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function channelReasons()
    {
        return $this->hasMany(ChannelReason::class);
    }
}