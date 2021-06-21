<?php

namespace Database\Seeders;

use App\Constants\UserTypes;
use App\Models\ChannelType;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->defaultSuperAdmin()->create();
        User::factory(1)->defaultAdmin()->create();
        User::factory(1)->defaultReceptionist()->create();
        User::factory(1)->defaultPharmacist()->create();
        User::factory(1)->defaultStoreKeeper()->create();

        $userData = [
            'name' => "John Doe",
            'username' => "doctor",
            'email' => "john.doe@example.com",
            'mobile' => 757895868,
            'user_type_id' => UserTypes::DOCTOR,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            "api_token" => Str::random(80),
        ];

        $user = User::create($userData);

        Doctor::create([
            "name" => "Dr.John Doe",
            "qualification" => "MBBS",
            "channel_type_id" => ChannelType::all()->random()->id,
            "commission_type" => "Fixed",
            "commission_amount" => 1500,
            "works_at" => "General Hospital",
            "user_id" => $user->id
        ]);

        $userData = [
            'name' => "Philip Jane",
            'username' => "patient",
            'email' => "philip.jane@example.com",
            'mobile' => 757895868,
            'user_type_id' => UserTypes::PATIENT,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            "api_token" => Str::random(80),
        ];

        $user = User::create($userData);

        Patient::create([
            "name" => "Philip Jane",
            "Address" => "No 10, Main Street, California",
            "birth_date" => "1956-05-16",
            "id_number" => "5491649569560",
            "id_type" => "passport",
            "gender" => "Male",
            "user_id" => $user->id
        ]);
    }
}