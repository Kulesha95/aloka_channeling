<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'mobile',
        'password',
        'image',
        'user_type_id',
        "api_token"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        return $this->image ?? asset('img/defaults/user.jpg');
    }

    public function adminlte_desc()
    {
        return $this->userType->user_type;
    }

    public function adminlte_profile_url()
    {
        return 'profile';
    }

    public function userType()
    {
        return $this->belongsTo(userType::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}