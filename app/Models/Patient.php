<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "birth_date", "gender", "address", "id_type", "id_number", "user_id"];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($patient) {
            $patient->user->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}