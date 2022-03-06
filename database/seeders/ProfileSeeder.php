<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 2]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 3]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 4]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 5]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 6]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 7]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 2]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 3]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 4]);
        
    }
}
