<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
        	['name' => 'Elementary', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Junior High', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'My Courses', 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
