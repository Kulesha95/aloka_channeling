<?php

namespace Database\Factories;

use App\Models\ChannelType;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userData = [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->numberBetween(700000000,799999999),
            'user_type_id' => 2,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            "api_token" => Str::random(80),
        ];

        $user = User::create($userData);
        $commissionType = $this->faker->boolean() ? "Fixed" : "Rate";

        return [
            "name" => "Dr." . $this->faker->firstName() . " " . $this->faker->lastName(),
            "qualification" => $this->faker->sentence(4, true),
            "channel_type_id" => ChannelType::all()->random()->id,
            "commission_type" => $commissionType,
            "commission_amount" => $commissionType == "Fixed" ? ceil($this->faker->numberBetween(1000, 2500) / 100) * 100 : ceil($this->faker->numberBetween(50, 80) / 5) * 5,
            "works_at" => $this->faker->sentence(4, true),
            "user_id" => $user->id
        ];
    }
}