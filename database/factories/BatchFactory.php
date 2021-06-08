<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Batch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $grn = ceil($this->faker->numberBetween(100, 1000) / 50) * 50;
        $stock = ceil($this->faker->numberBetween(100, $grn) / 50) * 50;
        return [
            'item_id' => Item::all()->random()->id,
            'grn_id' => 0,
            'grn_quantity' => $grn,
            'stock_quantity' => $stock,
            'sold_quantity' => 0,
            'damaged_quantity' => 0,
            'returned_quantity' => 0,
            'expired_quantity' => 0,
            'dispose_quantity' => 0,
            'price' => ceil($this->faker->numberBetween(1, 10)),
            'expire_date' => $this->faker->dateTimeBetween(now()->add('-1 month'), now()->add('+1 year'))
        ];
    }

    public function customBatch($itemId)
    {
        return $this->state(function (array $attributes) use ($itemId) {
            return [
                'item_id' => $itemId,
            ];
        });
    }
}