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
            "manage-channelings" => [UserTypes::DOCTOR],
            "manage-item-types" => [UserTypes::SUPER_ADMIN],
            "manage-items" => [UserTypes::SUPER_ADMIN],
            "manage-prescriptions" => [UserTypes::PHARMACIST],
            "manage-payments" => [UserTypes::RECEPTIONIST],
            "manage-generic-names" => [UserTypes::SUPER_ADMIN],
            "manage-exploration-types" => [UserTypes::SUPER_ADMIN],
            "manage-dosage-units" => [UserTypes::SUPER_ADMIN],
            "manage-suppliers" => [UserTypes::SUPER_ADMIN],
            "manage-purchase-orders" => [UserTypes::STORE_KEEPER],
            "manage-goods-receives" => [UserTypes::STORE_KEEPER],
            "manage-sales-returns" => [UserTypes::PHARMACIST],
            "manage-purchase-returns" => [UserTypes::STORE_KEEPER],
            "manage-supplier-payments" => [UserTypes::ADMIN],
            "manage-doctor-payments" => [UserTypes::ADMIN],
            "manage-batch-prices" => [UserTypes::SUPER_ADMIN],
            "generate-reports" => [UserTypes::ADMIN, UserTypes::SUPER_ADMIN, UserTypes::STORE_KEEPER],
            "generate-profit-and-loss-report" => [UserTypes::ADMIN, UserTypes::SUPER_ADMIN],
            "generate-deficit-items-report" => [UserTypes::STORE_KEEPER],
        ];

        foreach ($userAccess as $gate => $userTypes) {
            Gate::define($gate, function (User $user) use ($userTypes) {
                return in_array($user->user_type_id, $userTypes);
            });
        }
    }
}