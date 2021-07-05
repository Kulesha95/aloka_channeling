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
        $purchasePrice = ceil($this->faker->numberBetween(1, 10));
        return [
            'item_id' => Item::all()->random()->id,
            'good_receive_id' => 0,
            'good_receive_quantity' => 0,
            'stock_quantity' => 0,
            'reserved_quantity' => 0,
            'sold_quantity' => 0,
            'returnable_quantity' => 0,
            'returned_quantity' => 0,
            'dispose_quantity' => 0,
            'purchase_quantity' => 0,
            'purchase_price' => $purchasePrice,
            'price' => $purchasePrice + $this->faker->numberBetween(1, $purchasePrice),
            'expire_date' => $this->faker->dateTimeBetween(now()->add('-1 month'), now()->add('+1 year'))
        ];
    }

    public function customBatch($itemId, $grnId, $quantity)
    {
        return $this->state(function (array $attributes) use ($itemId, $grnId, $quantity) {
            return [
                'item_id' => $itemId,
                'good_receive_id' => $grnId,
                'purchase_quantity' => $quantity,
                'good_receive_quantity' => $quantity + $this->faker->numberBetween(1, 10),
                'stock_quantity' => $quantity + $this->faker->numberBetween(1, 10),
            ];
        });
    }
}