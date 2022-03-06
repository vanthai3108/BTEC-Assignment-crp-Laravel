<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create(['name' => 'Hà Nội']);
        Campus::create(['name' => 'Hồ Chí Minh']);
        Campus::create(['name' => 'Cần Thơ']);
        Campus::create(['name' => 'Đà nẵng']);
    }
}
