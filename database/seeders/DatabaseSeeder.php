<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            CampusSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            SubjectSeeder::class,
            ClasssSeeder::class,
            SemesterSeeder::class,
            ShiftSeeder::class,
            LocationSeeder::class,
            CourseSeeder::class,
            ScheduleSeeder::class,
        ]);

    }
}
