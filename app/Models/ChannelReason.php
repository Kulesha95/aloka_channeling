<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelReason extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["reason"];

    public function channelType()
    {
        return $this->belongsTo(ChannelType::class)->withTrashed();
    }   

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }
}