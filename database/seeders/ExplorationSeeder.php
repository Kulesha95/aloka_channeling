<?php

namespace Database\Seeders;

use App\Models\Exploration;
use Illuminate\Database\Seeder;

class ExplorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exploration::factory(50)->create();
    }
}