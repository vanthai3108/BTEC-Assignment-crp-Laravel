<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create(['room' => 'B1', 'building' => 'Detech Tower']);
        Location::create(['room' => 'B2', 'building' => 'Detech Tower']);
        Location::create(['room' => 'B3', 'building' => 'Detech Tower']);
        Location::create(['room' => 'B4', 'building' => 'Detech Tower']);
        Location::create(['room' => 'B5', 'building' => 'Detech Tower']);
        Location::create(['room' => 'L1', 'building' => 'Landmark Tower']);
        Location::create(['room' => 'L2', 'building' => 'Landmark Tower']);
        Location::create(['room' => 'T1', 'building' => 'TechnoPark Tower']);
        Location::create(['room' => 'T2', 'building' => 'TechnoPark Tower']);
        Location::create(['room' => 'T3', 'building' => 'TechnoPark Tower']);
    }
}
