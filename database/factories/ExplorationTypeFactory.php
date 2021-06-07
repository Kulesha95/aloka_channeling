<?php

namespace Database\Factories;

use App\Models\ExplorationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExplorationTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExplorationType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exploration_type' => $this->faker->sentence(3),
            'unit' => $this->faker->word(),
            'is_test' => $this->faker->boolean()
        ];
    }
}