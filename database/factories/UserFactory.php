<?php

namespace Database\Factories;

use App\Constants\UserTypes;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->numberBetween(700000000, 799999999),
            'user_type_id' => UserType::where("id", ">", "3")->get()->random()->id,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            "api_token" => Str::random(80),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function defaultSuperAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => "superadmin",
                'user_type_id' => UserTypes::SUPER_ADMIN
            ];
        });
    }

    public function defaultAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => "admin",
                'user_type_id' => UserTypes::ADMIN
            ];
        });
    }

    public function defaultReceptionist()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => "receptionist",
                'user_type_id' => UserTypes::RECEPTIONIST
            ];
        });
    }

    public function defaultPharmacist()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => "pharmacist",
                'user_type_id' => UserTypes::PHARMACIST
            ];
        });
    }

    public function defaultStoreKeeper()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => "storeKeeper",
                'user_type_id' => UserTypes::STORE_KEEPER
            ];
        });
    }
}