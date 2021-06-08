<?php

namespace Database\Seeders;

use App\Models\DosageUnit;
use Illuminate\Database\Seeder;

class DosageUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DosageUnit::factory(10)->create();
    }
}