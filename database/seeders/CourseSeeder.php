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
        $course = Course::create(['subject_id' => 1, 'class_id' => 1, 'semester_id' => 1, 'trainer_id' => 2]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 1, 'class_id' => 3, 'semester_id' => 1, 'trainer_id' => 2]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 2, 'class_id' => 2, 'semester_id' => 1, 'trainer_id' => 3]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 2, 'class_id' => 1, 'semester_id' => 1, 'trainer_id' => 3]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 2, 'class_id' => 5, 'semester_id' => 1, 'trainer_id' => 4]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 3, 'class_id' => 4, 'semester_id' => 1, 'trainer_id' => 4]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 4, 'class_id' => 6, 'semester_id' => 1, 'trainer_id' => 5]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 6, 'class_id' => 7, 'semester_id' => 1, 'trainer_id' => 6]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 7, 'class_id' => 7, 'semester_id' => 2, 'trainer_id' => 2]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 5, 'class_id' => 6, 'semester_id' => 2, 'trainer_id' => 6]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
        $course = Course::create(['subject_id' => 3, 'class_id' => 2, 'semester_id' => 2, 'trainer_id' => 5]);
        $course->users()->attach([8, 10, 12, 13, 9, 11]);
    }
}
