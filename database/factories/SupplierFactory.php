<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            "address" => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->numberBetween(700000000, 799999999),
            'register_number'=>$this->faker->numberBetween(100000, 900000)
        ];
    }
}