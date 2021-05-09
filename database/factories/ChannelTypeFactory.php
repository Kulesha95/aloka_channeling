<?php

namespace Database\Factories;

use App\Models\ChannelType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChannelType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_type' => $this->faker->words(2, true),
        ];
    }
}