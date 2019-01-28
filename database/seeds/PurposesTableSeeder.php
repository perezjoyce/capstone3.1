<?php

use Illuminate\Database\Seeder;
use App\Purpose;

class PurposesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Purpose::insert([
        	['name' => 'Introduction', 'description' => 'This activity will introduce you to ', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Review', 'description' => 'This activity will serve as your review in ', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Assessment', 'description' => 'This activity will check what you have learned in ', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Evaluation', 'description' => 'This activity will measure your mastery of ', 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
