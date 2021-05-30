<?php

namespace Database\Seeders;

use App\Models\ExplorationType;
use Illuminate\Database\Seeder;

class ExplorationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExplorationType::factory(10)->create();
    }
}