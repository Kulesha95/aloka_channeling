<?php

namespace Database\Factories;

use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_type' => $this->faker->words(2, true),
        ];
    }

    public function customUserType($userType)
    {
        return $this->state(function (array $attributes) use ($userType){
            return [
                'user_type' => $userType,
            ];
        });
    }
}