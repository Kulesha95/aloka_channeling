<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directions = [
            ["code" => "BD", "direction" => "Twice Daily"],
            ["code" => "TDS", "direction" => "Three Times Daily"],
            ["code" => "QDS", "direction" => "Four Times Daily"],
            ["code" => "SOS", "direction" => "When Required"],
            ["code" => "Stat", "direction" => "Immediately"],
            ["code" => "Q.8H", "direction" => "Every 8 Hours"],
            ["code" => "Q.6H", "direction" => "Every 6 Hours"],
            ["code" => "Mane", "direction" => "Morning"],
            ["code" => "Nocte", "direction" => "Night"],
            ["code" => "Vesper", "direction" => "Evening"],
            ["code" => "OD", "direction" => "Every Day"],
            ["code" => "OM", "direction" => "Every Morning"],
            ["code" => "ON", "direction" => "Every Night"],
            ["code" => "EOD", "direction" => "Every Other Day"],
            ["code" => "AC", "direction" => "Before Meal"],
            ["code" => "PC", "direction" => "After Meal"],
            ["code" => "Weekly", "direction" => "Weekly"],
            ["code" => "Monday", "direction" => "Monday"],
            ["code" => "Tuesday", "direction" => "Tuesday"],
            ["code" => "Wednesday", "direction" => "Wednesday"],
            ["code" => "Thursday", "direction" => "Thursday"],
            ["code" => "Friday", "direction" => "Friday"],
            ["code" => "Saturday", "direction" => "Saturday"],
            ["code" => "Sunday", "direction" => "Sunday"],
        ];
        foreach ($directions as $direction) {
            Direction::factory(1)->customDirection($direction)->create();
        }
    }
}