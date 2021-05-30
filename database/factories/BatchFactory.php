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
            'grn_qty' => $grn,
            'stock_qty' => $stock,
            'sold_qty' => 0,
            'damaged_qty' => 0,
            'returned_qty' => 0,
            'expired_qty' => 0,
            'dispose_qty' => 0,
            'price' => ceil($this->faker->numberBetween(1, 10)),
            'expire_date' => $this->faker->dateTimeBetween(now()->add('-1 month'), now()->add('+1 year'))
        ];
    }
}