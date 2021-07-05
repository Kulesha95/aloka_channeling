<?php

namespace Database\Factories;

use App\Models\Exploration;
use App\Models\ExplorationType;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExplorationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exploration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->numberBetween(1, 100),
            'date' =>  $this->faker->dateTimeBetween(now()->subMonth(), now()->addMonth()),
            'time' => $this->faker->time(),
            'comment' => null,
            'patient_id' => Patient::all()->random(),
            'prescription_id' => null,
            'exploration_type_id' => ExplorationType::all()->random()
        ];
    }
}