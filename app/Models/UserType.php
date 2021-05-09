<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_type'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($userType) {
            foreach ($userType->users as $user) {
                $user->delete();
            }
        });
    }


    public function user()
    {
        return $this->hasMany(User::class);
    }
}