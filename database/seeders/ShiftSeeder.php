<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create(['name' => '1', 'start_time' => '08:00:00', 'end_time' => '10:00:00']);
        Shift::create(['name' => '2', 'start_time' => '10:00:00', 'end_time' => '12:00:00']);
        Shift::create(['name' => '3', 'start_time' => '13:00:00', 'end_time' => '15:00:00']);
        Shift::create(['name' => '4', 'start_time' => '15:00:00', 'end_time' => '17:00:00']);
    }
}
