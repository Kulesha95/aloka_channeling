<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ExplorationType;
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
        $this->call([
            UserTypeSeeder::class,
            ChannelTypeSeeder::class,
            DefaultUsersSeeder::class,
            UserSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            ScheduleSeeder::class,
            AppointmentSeeder::class,
            IncomeSeeder::class,
            ItemTypeSeeder::class,
            PrescriptionSeeder::class,
            ItemSeeder::class,
            BatchSeeder::class,
            ExplorationTypeSeeder::class
        ]);
    }
}