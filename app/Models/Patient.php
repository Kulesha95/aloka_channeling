<?php

namespace App\Models;

use App\Constants\ExplorationTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "birth_date", "gender", "address", "id_type", "id_number", "user_id"];

    public function getAgeAttribute()
    {
        return Carbon::createFromDate($this->birth_date)->age;
    }

    public function getAgeTextAttribute()
    {
        return $this->age . " Years";
    }

    public function getWeightAttribute()
    {
        $exploration = $this->explorations()->where('exploration_type_id', ExplorationTypes::WEIGHT)->orderBy('date')->orderBy('time')->get()->last();
        return $exploration ? $exploration->value_text : "N\A";
    }

    public function getHeightAttribute()
    {
        $exploration = $this->explorations()->where('exploration_type_id', ExplorationTypes::HEIGHT)->orderBy('date')->orderBy('time')->get()->last();
        return $exploration ? $exploration->value_text : "N\A";
    }

    public function getBmiAttribute()
    {
        $exploration = $this->explorations()->where('exploration_type_id', ExplorationTypes::BMI)->orderBy('date')->orderBy('time')->get()->last();
        return $exploration ? $exploration->value_text : "N\A";
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function explorations()
    {
        return $this->hasMany(Exploration::class);
    }
}