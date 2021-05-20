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
        $this->call([
            UserTypeSeeder::class,
            ChannelTypeSeeder::class,
            DefaultUsersSeeder::class,
            UserSeeder::class,
            DoctorSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
