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
            $coSo = AppConst::CO_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
            $coSo = AppConst::CO_SO_PRODUCT;
        }
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => now()->format('Y-m-d')]);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => now()->format('Y-m-d')]);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 1*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-12']);

        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 3*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 3*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 2*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-12']);

        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 3*$heSo + $coSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 4*$heSo + $coSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 3*$heSo + $coSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 4*$heSo + $coSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 3*$heSo + $coSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 4*$heSo + $coSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 3*$heSo + $coSo, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 3*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 4*$heSo + $coSo, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 3*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 3*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 3*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 3*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 4*$heSo + $coSo, 'shift_id' => 4*$heSo + $coSo, 'location_id' => 1*$heSo + $coSo, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-04']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-07']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-09']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-11']);
        Schedule::create(['course_id' => 9*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 5*$heSo + $coSo, 'date' => '2022-05-11']);

        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 6*$heSo + $coSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-05']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 6*$heSo + $coSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-08']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 6*$heSo + $coSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-10']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 1*$heSo + $coSo, 'location_id' => 6*$heSo + $coSo, 'date' => '2022-05-12']);
        Schedule::create(['course_id' => 11*$heSo + $coSo, 'shift_id' => 2*$heSo + $coSo, 'location_id' => 2*$heSo + $coSo, 'date' => '2022-05-12']);

    }
}
