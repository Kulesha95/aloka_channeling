<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrder::class;

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
            'supplier_id' => Supplier::all()->filter(function ($supplier) {
                return $supplier->items->count() > 0;
            })->random()->id,
            'date' => $date,
            'time' => $time,
        ];
    }
}