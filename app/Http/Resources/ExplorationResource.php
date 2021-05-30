<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exploration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'time', 'value', 'comment', 'prescription_id', 'patient_id', 'exploration_type_id'];
}