<?php

namespace Database\Seeders;

use App\Constants\Appointments;
use App\Models\Appointment;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (Appointment::all() as $appointment) {
            if ($appointment->status == Appointments::PAID) {
                $appointment->incomes()->create([
                    'date' => $faker->dateTimeBetween(now()->sub('1 week'), now()),
                    'time' => Carbon::parse($faker->dateTimeBetween('2021-01-01 08:30:00', '2021-01-01 22:30:00'))->startOfHour(),
                    'amount' => $appointment->fee,
                    'reason' => $appointment->appointment_number . " - Payment"
                ]);
            }
        };
    }
}