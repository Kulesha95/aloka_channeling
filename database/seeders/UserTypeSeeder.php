<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultUserTypes = ["Super Admin",  "Doctor", "Patient", "Admin", "Receptionist", "Pharmacist", "Storekeeper"];
        foreach ($defaultUserTypes as $userType) {
            UserType::factory(1)->customUserType($userType)->create();
        }
        
    }
}