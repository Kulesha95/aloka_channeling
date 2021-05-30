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
        $explorationTypes = [
            ['exploration_type' => 'Weight', 'unit' => 'Kg'],
            ['exploration_type' => 'Height', 'unit' => 'm'],
            ['exploration_type' => 'BMI', 'unit' => 'Kg/m2']
        ];
        foreach ($explorationTypes as $explorationType) {
            ExplorationType::create($explorationType);
        }
        ExplorationType::factory(2)->create();
    }
}