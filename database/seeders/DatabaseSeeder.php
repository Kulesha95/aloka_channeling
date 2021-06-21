<?php

namespace Database\Seeders;

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
                DosageUnitSeeder::class,
                SupplierSeeder::class,
                ItemSeeder::class,
                ExplorationTypeSeeder::class,
                UserSeeder::class,
                DoctorSeeder::class,
                PatientSeeder::class,
                ScheduleSeeder::class,
                AppointmentSeeder::class,
                IncomeSeeder::class,
                PrescriptionSeeder::class,
                DefaultAppointmentSeeder::class,
                DirectionSeeder::class,
                PurchaseOrderSeeder::class,
                GoodReceiveSeeder::class,
                BatchSeeder::class
            ]);
        } else {
            $this->call([
                UserTypeSeeder::class,
                ChannelTypeSeeder::class,
                DefaultUsersSeeder::class,
                ExplorationTypeSeeder::class,
                DirectionSeeder::class
            ]);
        }
    }
}