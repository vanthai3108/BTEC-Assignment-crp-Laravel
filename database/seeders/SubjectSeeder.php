<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['code' => 'D/615/1618', 'name' => 'Programming', 'sessions' => 30, 'category_id' => 1]);
        Subject::create(['code' => 'H/615/1619', 'name' => 'Networking', 'sessions' => 30, 'category_id' => 1]);
        Subject::create(['code' => 'H/615/1619', 'name' => 'Database Design & Development', 'sessions' => 30, 'category_id' => 1]);
        Subject::create(['code' => 'D/615/3532', 'name' => 'Printmaking', 'sessions' => 30, 'category_id' => 2]);
        Subject::create(['code' => 'Y/615/3562', 'name' => 'Art Direction', 'sessions' => 30, 'category_id' => 2]);
        Subject::create(['code' => 'H/508/0489', 'name' => 'Management Accounting', 'sessions' => 30, 'category_id' => 3]);
        Subject::create(['code' => 'D/508/0491', 'name' => 'Business Law', 'sessions' => 30, 'category_id' => 3]);
    }
}
