<?php

namespace App\Models;

use App\Constants\UserTypes;
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

    public function getIsSuperAdminAttribute()
    {
        return $this->user_type_id === UserTypes::SUPER_ADMIN;
    }

    public function getIsAdminAttribute()
    {
        return $this->user_type_id === UserTypes::ADMIN;
    }

    public function getIsDoctorAttribute()
    {
        return $this->user_type_id === UserTypes::DOCTOR;
    }

    public function getIsPatientAttribute()
    {
        return $this->user_type_id === UserTypes::PATIENT;
    }

    public function getIspharmacistAttribute()
    {
        return $this->user_type_id === UserTypes::PHARMACIST;
    }

    public function getIsReceptionistAttribute()
    {
        return $this->user_type_id === UserTypes::RECEPTIONIST;
    }

    public function getIsStoreKeeperAttribute()
    {
        return $this->user_type_id === UserTypes::STORE_KEEPER;
    }

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
        return $this->belongsTo(userType::class)->withTrashed();
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return "+94" . $this->mobile;
    }
}