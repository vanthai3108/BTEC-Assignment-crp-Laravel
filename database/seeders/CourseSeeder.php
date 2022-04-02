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
            $heSo = AppConst::HE_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
        }
        $course = Course::create(['subject_id' => 1*$heSo, 'class_id' => 1*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 2*$heSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo, 10*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 1*$heSo, 'class_id' => 3*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 2*$heSo, 'start_date' => '2022-03-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([8*$heSo, 10*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 2*$heSo, 'class_id' => 2*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 3*$heSo, 'start_date' => '2022-03-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([12*$heSo, 15*$heSo, 14*$heSo, 16*$heSo, 17*$heSo, 13*$heSo]);
        $course = Course::create(['subject_id' => 2*$heSo, 'class_id' => 1*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 3*$heSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo, 10*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 2*$heSo, 'class_id' => 5*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 4*$heSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo, 10*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 3*$heSo, 'class_id' => 4*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 4*$heSo, 'start_date' => '2022-02-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([12*$heSo, 15*$heSo, 14*$heSo, 16*$heSo, 17*$heSo, 13*$heSo]);
        $course = Course::create(['subject_id' => 4*$heSo, 'class_id' => 6*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 5*$heSo, 'start_date' => '2022-02-01', 'end_date' => '2022-03-01']);
        $course->users()->attach([12*$heSo, 15*$heSo, 14*$heSo, 16*$heSo, 17*$heSo, 13*$heSo]);
        $course = Course::create(['subject_id' => 6*$heSo, 'class_id' => 7*$heSo, 'semester_id' => 1*$heSo, 'trainer_id' => 6*$heSo, 'start_date' => '2022-05-01', 'end_date' => '2022-06-01']);
        $course->users()->attach([8*$heSo, 10*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 7*$heSo, 'class_id' => 7*$heSo, 'semester_id' => 2*$heSo, 'trainer_id' => 2*$heSo, 'start_date' => '2022-05-01', 'end_date' => '2022-06-01']);
        $course->users()->attach([16*$heSo, 17*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 5*$heSo, 'class_id' => 6*$heSo, 'semester_id' => 2*$heSo, 'trainer_id' => 6*$heSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8*$heSo, 10*$heSo, 12*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
        $course = Course::create(['subject_id' => 3*$heSo, 'class_id' => 2*$heSo, 'semester_id' => 2*$heSo, 'trainer_id' => 5*$heSo, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([15*$heSo, 16*$heSo, 17*$heSo, 13*$heSo, 9*$heSo, 11*$heSo]);
    }
}
