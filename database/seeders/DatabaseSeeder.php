<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ExplorationType;
use App\Models\GenericName;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV', "local") == "local") {
            $this->call([
                UserTypeSeeder::class,
                ChannelTypeSeeder::class,
                DefaultUsersSeeder::class,
                ItemTypeSeeder::class,
                GenericNameSeeder::class,
                ItemSeeder::class,
                ExplorationTypeSeeder::class,
                BatchSeeder::class,
                UserSeeder::class,
                DoctorSeeder::class,
                PatientSeeder::class,
                ScheduleSeeder::class,
                AppointmentSeeder::class,
                IncomeSeeder::class,
                PrescriptionSeeder::class,
                DefaultAppointmentSeeder::class,
                DirectionSeeder::class
            ]);
        } else {
            $this->call([
                UserTypeSeeder::class,
                ChannelTypeSeeder::class,
                DefaultUsersSeeder::class,
                ItemTypeSeeder::class,
                ItemSeeder::class,
                ExplorationTypeSeeder::class,
                BatchSeeder::class,
                DirectionSeeder::class
            ]);
        }
    }
}