<?php

namespace Database\Factories;

use App\Constants\Appointments;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $schedule = Schedule::all()->random();
        if ($schedule->repeat) {
            $randomDate = $this->faker->dateTimeBetween(
                Carbon::createFromDate($schedule->date_from)->toDateTimeString(),
                Carbon::createFromDate($schedule->date_to)->toDateTimeString()
            );
            $randomDate = $randomDate->format("Y-m-d");
            $randomDate = Carbon::createFromDate($randomDate);
            $scheduleDate = Carbon::createFromDate($schedule->date_from);
            $date = $randomDate->next($scheduleDate->dayName)->format("Y-m-d");
        } else {
            $date = $schedule->date_to;
        }
        $number = 1;
        $time = $schedule->time_from;
        return [
            'date' => $date,
            'time' => $time,
            'other' => $this->faker->sentence(6, true),
            'patient_id' => Patient::all()->random()->id,
            'schedule_id' => $schedule->id,
            'status' => $this->faker->numberBetween(1, 4),
            'number' => $number
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Appointment $appointment) {
            $schedule = $appointment->schedule;
            $number = Appointment::where('schedule_id', $schedule->id)->where('id', '<=', $appointment->id)->whereDate('date', $appointment->date)->withTrashed()->count();
            $time = Carbon::createFromFormat("H:i:s", $schedule->time_from)->addMinutes(($number - 1) * Appointments::AVERAGE_APPOINTMENT_TIME)->format("H:i:s");
            $appointment->update(["time" => $time, 'number' => $number]);
            $reasons = $appointment->schedule->doctor->channelType->channelReasons->random(2);
            $appointment->channelReasons()->sync($reasons);
        });
    }
}