<?php

namespace Database\Seeders;

use App\Models\ChannelType;
use Illuminate\Database\Seeder;

class ChannelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultChannelTypes = ["Physician",  "Surgeon", "VOG", "Cardiologist", "Psychiatrist", "Radiologist", "Dermatologist"];
        foreach ($defaultChannelTypes as $channelTypes) {
            if (env('APP_ENV', "local") == "local") {
                ChannelType::factory(1)->customChannelType($channelTypes)->hasChannelReasons(5)->create();
            } else {
                ChannelType::factory(1)->customChannelType($channelTypes)->create();
            }
        }
    }
}