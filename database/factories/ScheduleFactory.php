<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dateFrom = $this->faker->dateTimeBetween(now()->sub('1 year'), now()->add('1 year'));
        $timeFrom = $this->faker->dateTimeBetween('2021-01-01 16:30:00', '2021-01-01 18:30:00');
        $doctor = Doctor::all()->random();
        return [
            'doctor_id' => $doctor->id,
            'date_from' => $dateFrom,
            'date_to' =>  $this->faker->dateTimeBetween($dateFrom, now()->add('1 year')),
            'time_from' => Carbon::parse($timeFrom)->startOfHour(),
            'time_to' => Carbon::parse(
                $this->faker->dateTimeInInterval(
                    Carbon::parse($timeFrom)->add('1 hour'),
                    '+5 hours'
                )
            )->startOfHour(),
            'channeling_fee' => ceil(($doctor->commission_type == "Fixed"
                ? $this->faker->numberBetween($doctor->commission_amount, 3000)
                : $this->faker->numberBetween(1000, 3000))
                / 100) * 100,
            'repeat' => $this->faker->boolean() ? 7 : 0
        ];
    }
}