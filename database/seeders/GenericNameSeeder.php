<?php

namespace Database\Seeders;

use App\Models\GenericName;
use Illuminate\Database\Seeder;

class GenericNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GenericName::factory(30)->create();
    }
}