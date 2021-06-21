<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        PurchaseOrder::factory(5)->create();
        $purchaseOrders = PurchaseOrder::all();
        foreach ($purchaseOrders as $purchaseOrder) {
            $items = $purchaseOrder->supplier->items->toArray();
            for ($i = 0; $i <= $faker->numberBetween(0, $purchaseOrder->supplier->items->count() - 1); $i++) {
                $purchaseOrder->items()->attach([$items[$i]["id"] => ["quantity" => $items[$i]["reorder_quantity"]]]);
            }
        }
    }
}