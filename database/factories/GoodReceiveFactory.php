<?php

namespace Database\Factories;

use App\Constants\GoodReceives;
use App\Models\GoodReceive;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodReceiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoodReceive::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomDate = $this->faker->dateTimeBetween(
            now()->sub('1 month'),
            now()
        );
        $date = $randomDate->format("Y-m-d");
        $time = $randomDate->format("H:i:s");
        return [
            'supplierable_id' => Supplier::all()->filter(function ($supplier) {
                return $supplier->items->count() > 0;
            })->random()->id,
            'supplierable_Type' => GoodReceives::SUPPLIER,
            'date' => $date,
            'time' => $time,
        ];
    }
}