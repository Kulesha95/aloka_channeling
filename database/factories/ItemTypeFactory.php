<?php

namespace Database\Factories;

use App\Models\ItemType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_type' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(5, true),
            'parent_id' => 0,
        ];
    }

    public function childItemTypes()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => ItemType::get()->random()->id,
            ];
        });
    }
}