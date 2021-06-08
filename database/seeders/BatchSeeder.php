<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Item;
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
        if (env('APP_ENV', "local") == "local") {
            Batch::factory(20)->create();
        } else {
            $items = Item::all();
            foreach ($items as $item) {
                Batch::factory(1)->customBatch($item->id)->create();
            }
        }
    }
}