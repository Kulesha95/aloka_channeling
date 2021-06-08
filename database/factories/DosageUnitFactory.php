<?php

namespace Database\Factories;

use App\Models\DosageUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosageUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DosageUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2, true),
            'unit' => $this->faker->word(),
        ];
    }
}