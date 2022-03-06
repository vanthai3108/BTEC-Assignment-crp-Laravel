<?php

namespace Database\Seeders;

use App\Models\Classs;
use Illuminate\Database\Seeder;

class ClasssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classs::create(['name' => 'BHAF-2005-2.1']);
        Classs::create(['name' => 'BHAF-2005-2.2']);
        Classs::create(['name' => 'BHAF-2005-2.3']);
        Classs::create(['name' => 'BHAF-2005-2.4']);
        Classs::create(['name' => 'BHAF-2005-2.5']);
        Classs::create(['name' => 'BHBF-2005-2.1']);
        Classs::create(['name' => 'BHGF-2005-2.1']);
    }
}
