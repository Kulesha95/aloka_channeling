<?php

namespace Database\Seeders;

use App\Models\GoodReceive;
use Illuminate\Database\Seeder;

class GoodReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodReceive::factory(5)->create();
    }
}