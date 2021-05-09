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
            'description' => $this->faker->sentence(20, true),
            'colour' => $this->faker->hexColor(),
        ];
    }

    public function customChannelType($channelType)
    {
        return $this->state(function (array $attributes) use ($channelType) {
            return [
                'channel_type' => $channelType,
            ];
        });
    }
}