<?php

namespace Database\Seeders;

use App\Models\AppConst;
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
        if (config('app.env') == 'local') {
            $heSo = AppConst::HE_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
        }
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 2*$heSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 3*$heSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 4*$heSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 5*$heSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 6*$heSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 7*$heSo]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 2*$heSo]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 3*$heSo]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 4*$heSo]);
        
    }
}
