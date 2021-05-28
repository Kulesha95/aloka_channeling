<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'generic_name' => $this->faker->sentence(3, true),
            'brand_name' => $this->faker->sentence(3, true),
            'reorder_level' => ceil($this->faker->numberBetween(100, 1000) / 50) * 50,
            'reorder_quantity' => ceil($this->faker->numberBetween(100, 1000) / 100) * 100,
            'item_type_id' => ItemType::all()->random()->id,
            'unit' => $this->faker->word()
        ];
    }
}