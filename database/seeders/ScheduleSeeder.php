<?php

namespace Database\Seeders;

use App\Models\AppConst;
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
        if (config('app.env') == 'local') {
            $heSo = AppConst::HE_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
        }
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 1*$heSo, 'date' => now()->format('Y-m-d')]);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 1*$heSo, 'date' => now()->format('Y-m-d')]);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 1*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-12']);

        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 3*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 3*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 2*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-12']);

        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 3*$heSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 4*$heSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 3*$heSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 4*$heSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 3*$heSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 4*$heSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 3*$heSo, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 3*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 4*$heSo, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 3*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 3*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 3*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 3*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 4*$heSo, 'shift_id' => 4*$heSo, 'location_id' => 1*$heSo, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 9*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 5*$heSo, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 6*$heSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 6*$heSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 6*$heSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 1*$heSo, 'location_id' => 6*$heSo, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 11*$heSo, 'shift_id' => 2*$heSo, 'location_id' => 2*$heSo, 'date' => '2022-05-12']);

    }
}
