<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert([
        	['name' => 'Grade 4', 'category_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grade 5', 'category_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grade 6', 'category_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grade 7', 'category_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grade 8', 'category_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grade 9', 'category_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grade 10', 'category_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
            ['name' => 'Grade 11', 'category_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
            ['name' => 'Grade 12', 'category_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],

        ]);
    }
}
