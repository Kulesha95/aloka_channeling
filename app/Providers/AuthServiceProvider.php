<?php

namespace App\Providers;

use App\Constants\UserTypes;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $userAccess = [
            "manage-channel-types" => [UserTypes::SUPER_ADMIN],
            "manage-doctors" => [UserTypes::ADMIN],
            "manage-schedules" => [UserTypes::ADMIN],
            "manage-user-types" => [UserTypes::SUPER_ADMIN],
            "manage-users" => [UserTypes::SUPER_ADMIN],
            "manage-patients" => [UserTypes::RECEPTIONIST],
            "manage-appointments" => [UserTypes::RECEPTIONIST, UserTypes::PATIENT],
            "view-channeling-calendar" => [UserTypes::RECEPTIONIST, UserTypes::PATIENT],
            "manage-channelings" => [UserTypes::DOCTOR]
        ];

        foreach ($userAccess as $gate => $userTypes) {
            Gate::define($gate, function (User $user) use ($userTypes) {
                return in_array($user->user_type_id, $userTypes);
            });
        }
    }
}