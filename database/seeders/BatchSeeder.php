<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\GoodReceive;
use App\Models\Item;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $goodReceives = GoodReceive::all();
        foreach ($goodReceives as $goodReceive) {
            $items = $goodReceive->supplier->items->toArray();
            for ($i = 0; $i <= $faker->numberBetween(0, $goodReceive->supplier->items->count() - 1); $i++) {
                Batch::factory(1)->customBatch($items[$i]["id"], $goodReceive->id, $items[$i]["reorder_quantity"])->create();
            }
        }
    }
}