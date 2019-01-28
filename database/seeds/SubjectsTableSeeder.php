<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::insert([
        	['name' => 'Mathematics', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Science', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'English', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Filipino', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Araling Panlipunan', 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
