<?php

namespace Database\Seeders;

use App\Models\ItemType;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemType::factory(5)->create();
        ItemType::factory(5)->childItemTypes()->create();
        ItemType::factory(5)->childItemTypes()->create();
        ItemType::factory(5)->childItemTypes()->create();
        ItemType::factory(5)->childItemTypes()->create();
    }
}