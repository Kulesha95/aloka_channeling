<?php

namespace Database\Factories;

use App\Models\Direction;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Direction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => "",
            'direction' => "",
        ];
    }

    public function customDirection($data)
    {
        return $this->state(function (array $attributes) use ($data) {
            return [
                'code' => $data['code'],
                'direction' => $data['direction'],
            ];
        });
    }
}