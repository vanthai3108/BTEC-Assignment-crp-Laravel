<?php

namespace Database\Seeders;

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
        $course = Course::create(['subject_id' => 1, 'class_id' => 1, 'semester_id' => 1, 'trainer_id' => 2, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 1, 'class_id' => 3, 'semester_id' => 1, 'trainer_id' => 2, 'start_date' => '2022-03-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 2, 'class_id' => 2, 'semester_id' => 1, 'trainer_id' => 3, 'start_date' => '2022-03-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 2, 'class_id' => 1, 'semester_id' => 1, 'trainer_id' => 3, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 2, 'class_id' => 5, 'semester_id' => 1, 'trainer_id' => 4, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 3, 'class_id' => 4, 'semester_id' => 1, 'trainer_id' => 4, 'start_date' => '2022-02-01', 'end_date' => '2022-04-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 4, 'class_id' => 6, 'semester_id' => 1, 'trainer_id' => 5, 'start_date' => '2022-02-01', 'end_date' => '2022-03-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 6, 'class_id' => 7, 'semester_id' => 1, 'trainer_id' => 6, 'start_date' => '2022-05-01', 'end_date' => '2022-06-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 7, 'class_id' => 7, 'semester_id' => 2, 'trainer_id' => 2, 'start_date' => '2022-05-01', 'end_date' => '2022-06-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 5, 'class_id' => 6, 'semester_id' => 2, 'trainer_id' => 6, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 3, 'class_id' => 2, 'semester_id' => 2, 'trainer_id' => 5, 'start_date' => '2022-04-01', 'end_date' => '2022-05-01']);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
    }
}
