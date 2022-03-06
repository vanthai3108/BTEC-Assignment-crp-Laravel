<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Information Technology']);
        Category::create(['name' => 'Graphic design']);
        Category::create(['name' => 'Business Administration']);
    }
}
