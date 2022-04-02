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
            $coSo = AppConst::CO_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
            $coSo = AppConst::CO_SO_PRODUCT;
        }
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 2*$heSo + $coSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 3*$heSo + $coSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 4*$heSo + $coSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 5*$heSo + $coSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 6*$heSo + $coSo]);
        Profile::create(['key' => 'ielts', 'value' => '8.0', 'user_id' => 7*$heSo + $coSo]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 2*$heSo + $coSo]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 3*$heSo + $coSo]);
        Profile::create(['key' => 'hobbies', 'value' => 'listen to music, read book', 'user_id' => 4*$heSo + $coSo]);
        
    }
}
