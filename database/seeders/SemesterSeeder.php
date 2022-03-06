<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create(['name' => 'Spring 2022']);
        Semester::create(['name' => 'Summer 2022']);
        Semester::create(['name' => 'Fall 2022']);
        Semester::create(['name' => 'Spring 2023']);
    }
}
