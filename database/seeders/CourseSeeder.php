<?php

namespace Database\Seeders;

use App\Models\AppConst;
use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') == 'local') {
             $heSo = AppConst::HE_SO ;
            $coSo = AppConst::CO_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
            $coSo = AppConst::CO_SO_PRODUCT;
        }
        $course = Course::create(['subject_id' => 1*$heSo + $coSo, 'class_id' => 1*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 2*$heSo + $coSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo + $coSo, 10*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 1*$heSo + $coSo, 'class_id' => 3*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 2*$heSo + $coSo, 'start_date' => '2022-03-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([8*$heSo + $coSo, 10*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 2*$heSo + $coSo, 'class_id' => 2*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 3*$heSo + $coSo, 'start_date' => '2022-03-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([12*$heSo + $coSo, 15*$heSo + $coSo, 14*$heSo + $coSo, 16*$heSo + $coSo, 17*$heSo + $coSo, 13*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 2*$heSo + $coSo, 'class_id' => 1*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 3*$heSo + $coSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo + $coSo, 10*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 2*$heSo + $coSo, 'class_id' => 5*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 4*$heSo + $coSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo + $coSo, 10*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 3*$heSo + $coSo, 'class_id' => 4*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 4*$heSo + $coSo, 'start_date' => '2022-02-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([12*$heSo + $coSo, 15*$heSo + $coSo, 14*$heSo + $coSo, 16*$heSo + $coSo, 17*$heSo + $coSo, 13*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 4*$heSo + $coSo, 'class_id' => 6*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 5*$heSo + $coSo, 'start_date' => '2022-02-01', 'end_date' => '2022-03-01']);
        $course->users()->attach([12*$heSo + $coSo, 15*$heSo + $coSo, 14*$heSo + $coSo, 16*$heSo + $coSo, 17*$heSo + $coSo, 13*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 6*$heSo + $coSo, 'class_id' => 7*$heSo + $coSo, 'semester_id' => 1*$heSo + $coSo, 'trainer_id' => 6*$heSo + $coSo, 'start_date' => '2022-05-01', 'end_date' => '2022-06-01']);
        $course->users()->attach([8*$heSo + $coSo, 10*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 7*$heSo + $coSo, 'class_id' => 7*$heSo + $coSo, 'semester_id' => 2*$heSo + $coSo, 'trainer_id' => 2*$heSo + $coSo, 'start_date' => '2022-05-01', 'end_date' => '2022-06-01']);
        $course->users()->attach([16*$heSo + $coSo, 17*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 5*$heSo + $coSo, 'class_id' => 6*$heSo + $coSo, 'semester_id' => 2*$heSo + $coSo, 'trainer_id' => 6*$heSo + $coSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo + $coSo, 10*$heSo + $coSo, 12*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
        $course = Course::create(['subject_id' => 3*$heSo + $coSo, 'class_id' => 2*$heSo + $coSo, 'semester_id' => 2*$heSo + $coSo, 'trainer_id' => 5*$heSo + $coSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([15*$heSo + $coSo, 16*$heSo + $coSo, 17*$heSo + $coSo, 13*$heSo + $coSo, 9*$heSo + $coSo, 11*$heSo + $coSo]);
    }
}
