<?php

namespace Database\Factories;

use App\Models\ChannelReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChannelReason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason' => $this->faker->sentence(3)
        ];
    }
}