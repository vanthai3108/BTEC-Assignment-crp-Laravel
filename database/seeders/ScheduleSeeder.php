<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create(['course_id' => 1, 'shift_id' => 1, 'location_id' => 1, 'date' => now()->format('Y-m-d')]);
        Schedule::create(['course_id' => 1, 'shift_id' => 2, 'location_id' => 1, 'date' => now()->format('Y-m-d')]);
        Schedule::create(['course_id' => 1, 'shift_id' => 1, 'location_id' => 1, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 1, 'shift_id' => 2, 'location_id' => 1, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 1, 'shift_id' => 1, 'location_id' => 1, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 1, 'shift_id' => 2, 'location_id' => 1, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 1, 'shift_id' => 1, 'location_id' => 1, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 1, 'shift_id' => 2, 'location_id' => 1, 'date' => '2022-05-12']);

        Schedule::create(['course_id' => 2, 'shift_id' => 3, 'location_id' => 2, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 2, 'shift_id' => 4, 'location_id' => 2, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 2, 'shift_id' => 3, 'location_id' => 2, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 2, 'shift_id' => 4, 'location_id' => 2, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 2, 'shift_id' => 4, 'location_id' => 2, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 2, 'shift_id' => 2, 'location_id' => 2, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 2, 'shift_id' => 4, 'location_id' => 2, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 2, 'shift_id' => 2, 'location_id' => 2, 'date' => '2022-05-12']);

        Schedule::create(['course_id' => 3, 'shift_id' => 1, 'location_id' => 3, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 3, 'shift_id' => 2, 'location_id' => 4, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 3, 'shift_id' => 1, 'location_id' => 3, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 3, 'shift_id' => 2, 'location_id' => 4, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 3, 'shift_id' => 1, 'location_id' => 3, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 3, 'shift_id' => 2, 'location_id' => 4, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 3, 'shift_id' => 1, 'location_id' => 3, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 3, 'shift_id' => 2, 'location_id' => 4, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 4, 'shift_id' => 3, 'location_id' => 1, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 4, 'shift_id' => 4, 'location_id' => 1, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 4, 'shift_id' => 3, 'location_id' => 1, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 4, 'shift_id' => 4, 'location_id' => 1, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 4, 'shift_id' => 3, 'location_id' => 1, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 4, 'shift_id' => 4, 'location_id' => 1, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 4, 'shift_id' => 3, 'location_id' => 1, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 4, 'shift_id' => 4, 'location_id' => 1, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 9, 'shift_id' => 1, 'location_id' => 5, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 9, 'shift_id' => 2, 'location_id' => 5, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 9, 'shift_id' => 1, 'location_id' => 5, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 9, 'shift_id' => 2, 'location_id' => 5, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 9, 'shift_id' => 1, 'location_id' => 5, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 9, 'shift_id' => 2, 'location_id' => 5, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 9, 'shift_id' => 1, 'location_id' => 5, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 9, 'shift_id' => 2, 'location_id' => 5, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 11, 'shift_id' => 1, 'location_id' => 6, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 11, 'shift_id' => 2, 'location_id' => 2, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 11, 'shift_id' => 1, 'location_id' => 6, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 11, 'shift_id' => 2, 'location_id' => 2, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 11, 'shift_id' => 1, 'location_id' => 6, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 11, 'shift_id' => 2, 'location_id' => 2, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 11, 'shift_id' => 1, 'location_id' => 6, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 11, 'shift_id' => 2, 'location_id' => 2, 'date' => '2022-05-12']);

    }
}
