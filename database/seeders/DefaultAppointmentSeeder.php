<?php

namespace Database\Seeders;

use App\Constants\Appointments;
use App\Constants\ExplorationTypes;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Exploration;
use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DefaultAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $doctor = Doctor::find('1');
        $patient = Patient::find('1');
        $schedule = $doctor->schedules
            ->where('date_from', '<=', now()->toDateString())
            ->where('date_to', '>=', now()->toDateString())
            ->filter(function ($schedule) {
                if ($schedule->repeat == 7) {
                    return Carbon::createFromDate($schedule->date_from)->dayOfWeek == Carbon::now()->dayOfWeek;
                }
                return true;
            })->first();
        if (!$schedule) {
            $schedule = Schedule::create([
                'doctor_id' => $doctor->id,
                'date_from' => now()->toDateString(),
                'date_to' =>  now()->toDateString(),
                'time_from' => "08:00:00",
                'time_to' => "22:00:00",
                'channeling_fee' => ceil(($doctor->commission_type == "Fixed"
                    ? $faker->numberBetween($doctor->commission_amount, 3000)
                    : $faker->numberBetween(1000, 3000))
                    / 100) * 100,
                'repeat' => 0
            ]);
            $date = $schedule->date_to;
        } else {
            $schedule->update(['time_from' => "08:00:00", 'time_to' => "22:00:00",]);
            $date = now()->toDateString();
        }


        $appointment = Appointment::create([
            'date' => $date,
            'time' => $schedule->time_from,
            'other' => $faker->sentence(6, true),
            'patient_id' => $patient->id,
            'schedule_id' => $schedule->id,
            'status' => Appointments::PAID,
            'number' => 1
        ]);

        $number = Appointment::where('schedule_id', $schedule->id)->where('id', '<=', $appointment->id)->whereDate('date', $appointment->date)->withTrashed()->count();
        $time = Carbon::createFromFormat("H:i:s", $schedule->time_from)->addMinutes(($number - 1) * Appointments::AVERAGE_APPOINTMENT_TIME)->format("H:i:s");
        $appointment->update(["time" => $time, 'number' => $number]);
        $reasons = $appointment->schedule->doctor->channelType->channelReasons->random(2);
        $appointment->channelReasons()->sync($reasons);
        $appointment->incomes()->create([
            'date' => $date,
            'time' => Carbon::now()->startOfHour(),
            'amount' => $appointment->fee,
            'reason' => $appointment->appointment_number . " - Payment"
        ]);
        Exploration::create([
            'value' => 1.6,
            'date' => $date,
            'time' => $time,
            'patient_id' => $patient->id,
            'exploration_type_id' => ExplorationTypes::HEIGHT,
        ]);
        Exploration::create([
            'value' => 70,
            'date' => $date,
            'time' => $time,
            'patient_id' => $patient->id,
            'exploration_type_id' => ExplorationTypes::WEIGHT,
        ]);
        Exploration::create([
            'value' => number_format(70 / (1.6 * 1.6), 2, '.', ''),
            'date' => $date,
            'time' => $time,
            'patient_id' => $patient->id,
            'exploration_type_id' => ExplorationTypes::BMI,
        ]);
    }
}