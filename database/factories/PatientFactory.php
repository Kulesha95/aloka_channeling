<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

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
            'mobile' => $this->faker->numberBetween(700000000, 799999999),
            'user_type_id' => 3,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            "api_token" => Str::random(80),
        ];

        $user = User::create($userData);
        $gender = $this->faker->boolean() ? "Male" : "Female";
        $birthDate = $this->faker->date('Y-m-d', now());

        return [
            "name" =>  $this->faker->firstName($gender) . " " . $this->faker->lastName($gender),
            "address" => $this->faker->address,
            "birth_date" => $birthDate,
            "id_type" => "Passport",
            "id_number" => $this->faker->numberBetween(700000000, 799999999),
            "gender" => $gender,
            "user_id" => $user->id
        ];
    }
}