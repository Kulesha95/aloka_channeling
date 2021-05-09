<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['channel_type', 'description', 'colour'];
    
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($channelType) {
            foreach ($channelType->doctors as $doctor) {
                $doctor->delete();
            }
        });
    }


    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}